<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Surat Resmi') }}
        </h2>
    </x-slot>

    <!-- Load CKEditor early so it's available for all scripts below -->
    <script src="https://cdn.ckeditor.com/4.25.1/lts/ckeditor.js"></script>

    <!-- CRITICAL: Define modal functions EARLY so onclick handlers can access them -->
    <script>
        function openModalSurat() {
            const modal = document.getElementById('modalSurat');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                // Auto-fill tanggal dengan hari ini
                const tanggalInput = document.getElementById('tanggalSurat');
                if (tanggalInput) {
                    tanggalInput.valueAsDate = new Date();
                }
                const title = document.getElementById('modal-title');
                if (title) title.innerText = 'Buat Surat Resmi';
                document.body.classList.add('modal-open');
                try {
                    renderTemplateSections([]);
                    initializeSignatures(); // Initialize multiple signatures section
                    fetchKopList(); // Load list of existing kop surat
                } catch (e) {}
                if (document.getElementById('formSteps')) document.body.classList.add('modal-hid-footer');
                window.currentRequest = null;
                document.body.style.overflow = 'hidden';

                // Attach preview listeners and trigger initial preview
                setTimeout(() => {
                    try {
                        if (typeof attachPreviewListeners === 'function') attachPreviewListeners();
                        if (typeof window.updateFormPreview === 'function') window.updateFormPreview();
                    } catch (e) {
                        console.warn('Preview init error:', e);
                    }
                }, 100);
            }
        }

        function openModalBuatSurat() {
            try {
                const nomorEl = document.getElementById('nomorSurat');
                const tanggalEl = document.getElementById('tanggalSurat');
                const jenisEl = document.getElementById('jenisSurat');
                const karyawanEl = document.getElementById('karyawanSurat');
                const tujuanEl = document.getElementById('tujuanSurat');
                const isiEl = document.getElementById('isiSurat');
                const jabatanEl = document.getElementById('jabatanSurat');
                const departemenEl = document.getElementById('departemenSurat');

                if (nomorEl) nomorEl.value = '';
                if (tanggalEl) tanggalEl.valueAsDate = new Date();
                if (jenisEl) jenisEl.value = '';
                if (karyawanEl) karyawanEl.value = '';
                if (tujuanEl) tujuanEl.value = '';
                if (isiEl) isiEl.value = '';
                if (jabatanEl) jabatanEl.value = '';
                if (departemenEl) departemenEl.value = '';

                document.getElementById('step-1')?.classList.remove('hidden');
                document.getElementById('step-2')?.classList.add('hidden');
                document.getElementById('step-3')?.classList.add('hidden');

                window.editingSuratTemplateIndex = null;
                try {
                    window.adHocInformasiFields = [];
                    if (window.renderInformasiCustomFields) window.renderInformasiCustomFields();
                } catch (e) {}

                if (typeof populateSuratTemplateSelect === 'function') populateSuratTemplateSelect();
                if (typeof renderTemplateManager === 'function') renderTemplateManager();

                const templateManager = document.getElementById('templateManager');
                if (templateManager) templateManager.classList.add('hidden');

                openModalSurat();
            } catch (error) {
                console.error('Error opening modal:', error);
                alert('Terjadi kesalahan saat membuka form. Silakan refresh halaman.');
            }
        }

        function closeModalSurat() {
            const modal = document.getElementById('modalSurat');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.classList.remove('modal-open');
                document.body.classList.remove('modal-hid-footer');
                document.body.style.overflow = '';
            }
        }

        // ===== REAL-TIME PREVIEW FUNCTION (Moved to early block for availability) =====
        function updateFormPreview() {
            try {
                console.log('[Preview] updateFormPreview called');
                const nomor = document.getElementById('nomorSurat')?.value || '';
                const tanggal = document.getElementById('tanggalSurat')?.value || '';
                const karyawan = document.getElementById('karyawanSurat')?.value || '';
                const jabatan = document.getElementById('jabatanSurat')?.value || '';
                const departemen = document.getElementById('departemenSurat')?.value || '';
                const tujuan = document.getElementById('tujuanSurat')?.value || '';
                const jenis = document.getElementById('jenisSurat')?.value || '';

                let sections = [];
                let additionalFields = {};

                try {
                    if (typeof window.getSuratSections === 'function') {
                        sections = window.getSuratSections();
                    }
                } catch (e) {
                    console.warn('getSuratSections error:', e);
                }

                try {
                    if (typeof window.getAdditionalFields === 'function') {
                        additionalFields = window.getAdditionalFields();
                    }
                } catch (e) {
                    console.warn('getAdditionalFields error:', e);
                }

                let preview = '<div class="space-y-4">';
                const hasData = nomor || tanggal || karyawan || jabatan || departemen || tujuan || jenis || sections
                    .length > 0;

                if (!hasData) {
                    const previewEl = document.getElementById('suratPreview');
                    if (previewEl) {
                        previewEl.innerHTML = `<div class="text-center text-red-300 py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-sm text-red-500 font-medium">Mulai isi form untuk melihat pratayang</p>
                        </div>`;
                    }
                    return;
                }

                const kopSelected = document.getElementById('kopSuratSelect')?.value;
                if (kopSelected) {
                    const kopOpt = document.getElementById('kopSuratSelect')?.selectedOptions?.[0];
                    const kopUrl = kopOpt?.dataset?.url || '';
                    if (kopUrl) {
                        const fileName = kopUrl.split('/').pop();
                        const fileExt = fileName.split('.').pop().toLowerCase();

                        // Display kop based on file type
                        if (['pdf'].includes(fileExt)) {
                            preview +=
                                '<div class="text-center text-sm text-gray-500 mb-6 p-4 border-b-2 border-rose-200/30">[Kop Surat: ' +
                                window.escapeHtml(fileName) + ' - PDF]</div>';
                        } else if (['doc', 'docx', 'odt', 'txt', 'xls', 'xlsx', 'ods', 'ppt', 'pptx', 'odp'].includes(
                                fileExt)) {
                            preview +=
                                '<div class="text-center text-sm text-gray-500 mb-6 p-4 border-b-2 border-rose-200/30">[Kop Surat: ' +
                                window.escapeHtml(fileName) + ']</div>';
                        } else if (['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'tiff'].includes(fileExt)) {
                            preview +=
                                `<div class="text-center mb-6 pb-4 border-b-2 border-rose-200/30"><img src="${kopUrl}" alt="kop" style="max-height:100px; object-fit:contain;" /></div>`;
                        } else {
                            preview +=
                                '<div class="text-center text-sm text-gray-500 mb-6 p-4 border-b-2 border-rose-200/30">[Kop Surat: ' +
                                window.escapeHtml(fileName) + ']</div>';
                        }
                    }
                }

                if (nomor || tanggal) {
                    preview += `<div class="text-right text-sm border-b-2 border-red-100 pb-4 mb-4">
                        ${nomor ? `<p><strong>Nomor:</strong> ${window.escapeHtml ? window.escapeHtml(nomor) : nomor}</p>` : ''}
                        ${tanggal ? `<p><strong>Tanggal:</strong> ${window.formatDate ? window.formatDate(new Date(tanggal)) : tanggal}</p>` : ''}
                    </div>`;
                }

                if (tujuan) {
                    preview += `<div class="text-sm mb-4">
                        <p><strong>Kepada Yth.:</strong></p>
                        <p>${window.escapeHtml ? window.escapeHtml(tujuan) : tujuan}</p>
                    </div>`;
                }

                preview += `<div class="text-sm mb-4"><p>Dengan hormat,</p></div>`;

                if (jenis) {
                    preview += `<div class="text-sm mb-4 p-3 bg-rose-50/40 rounded-lg border border-rose-200/40">
                        <p><strong>Jenis Surat:</strong> ${window.escapeHtml ? window.escapeHtml(jenis) : jenis}</p>
                    </div>`;
                }

                if (karyawan || jabatan || departemen) {
                    preview += `<div class="text-sm mb-4 p-3 bg-gray-50 rounded border border-gray-200">
                        ${karyawan ? `<p><strong>Nama:</strong> ${window.escapeHtml ? window.escapeHtml(karyawan) : karyawan}</p>` : ''}
                        ${jabatan ? `<p><strong>Jabatan:</strong> ${window.escapeHtml ? window.escapeHtml(jabatan) : jabatan}</p>` : ''}
                        ${departemen ? `<p><strong>Departemen:</strong> ${window.escapeHtml ? window.escapeHtml(departemen) : departemen}</p>` : ''}
                    </div>`;
                }

                // Add Informasi Umum custom fields to preview
                let informasiUmumPreview = '';
                if (window.informasiUmumCustomFields && window.informasiUmumCustomFields.length > 0) {
                    window.informasiUmumCustomFields.forEach(field => {
                        const inputId = `informasi_umum_${field.key}`;
                        const value = document.getElementById(inputId)?.value || '';
                        if (value) {
                            informasiUmumPreview +=
                                `<p><strong>${window.escapeHtml ? window.escapeHtml(field.label) : field.label}:</strong> ${window.escapeHtml ? window.escapeHtml(value) : value}</p>`;
                        }
                    });
                }

                if (informasiUmumPreview) {
                    preview += `<div class="text-sm mb-4 p-3 bg-white border border-gray-200/50 rounded-lg">
                        ${informasiUmumPreview}
                    </div>`;
                }

                const additionalFieldsKeys = Object.keys(additionalFields);
                if (additionalFieldsKeys.length > 0) {
                    preview += `<div class="text-sm mb-4 p-3 bg-gray-50 rounded">
                        ${additionalFieldsKeys.map(key => {
                            const val = additionalFields[key];
                            const escaped = window.escapeHtml ? window.escapeHtml(val) : val;
                            return `<p><strong>${window.escapeHtml ? window.escapeHtml(key) : key}:</strong> ${escaped}</p>`;
                        }).join('')}
                    </div>`;
                }

                if (sections && sections.length > 0) {
                    preview += `<div class="text-sm mt-6 leading-relaxed space-y-3">`;
                    sections.forEach(section => {
                        if (section.title) {
                            preview +=
                                `<h4 class="font-bold mt-4 mb-2 text-red-700">${window.escapeHtml ? window.escapeHtml(section.title) : section.title}</h4>`;
                        }
                        if (section.content) {
                            const escaped = window.escapeHtml ? window.escapeHtml(section.content) : section
                                .content;
                            preview += `<p>${escaped.replace(/\n/g, '<br>')}</p>`;
                        }
                    });
                    preview += `</div>`;
                }

                const namaPenanda = document.getElementById('namaPenandaTangan')?.value || '';
                const jabatanPenanda = document.getElementById('jabatanPenandaTangan')?.value || '';
                const tempatTanda = document.getElementById('tempatTandaTangan')?.value || '';
                const greetingText = document.getElementById('greetingText')?.value ||
                    'Demikian surat ini kami buat untuk dapat dipergunakan sebagaimana mestinya.';

                // Get all signatures from dynamic fields
                const signatures = getSignaturesData();

                preview += `<div class="text-sm mt-8 pt-6 border-t-2 border-rose-200/30">
                    <p>${window.escapeHtml ? window.escapeHtml(greetingText) : greetingText}</p>
                    <div class="mt-8">
                        <p>Hormat kami,</p>
                        ${tempatTanda ? `<div class="mt-2">
                                    <p class="text-xs">${window.escapeHtml ? window.escapeHtml(tempatTanda) : tempatTanda}, _______________</p>
                                </div>` : ''}
                        <div class="mt-8 ${signatures.length === 1 ? 'flex justify-end' : 'grid grid-cols-' + (signatures.length > 2 ? '3' : '2') + ' gap-6'}">
                            ${signatures.map(sig => `
                                        <div class="${signatures.length === 1 ? 'text-right w-32' : 'text-center'}">
                                            <div class="mb-2">
                                                <p class="border-t-2 border-gray-800" style="min-width:120px;"></p>
                                            </div>
                                            <div class="mt-8">
                                                <p class="font-semibold text-xs">${window.escapeHtml ? window.escapeHtml(sig.name) : sig.name}</p>
                                                ${sig.position ? `<p class="text-xs text-gray-600">${window.escapeHtml ? window.escapeHtml(sig.position) : sig.position}</p>` : ''}
                                            </div>
                                        </div>
                                    `).join('')}
                        </div>
                    </div>
                </div>`;

                preview += '</div>';

                const previewEl = document.getElementById('suratPreview');
                if (previewEl) {
                    previewEl.innerHTML = preview;
                }
            } catch (error) {
                console.error('updateFormPreview error:', error);
            }
        }

        // ===== MULTIPLE SIGNATURES MANAGEMENT =====
        let signatureCounter = 0;

        function initializeSignatures() {
            const container = document.getElementById('signatureFieldsContainer');
            if (!container) return;

            // Add one default signature field if empty
            if (container.children.length === 0) {
                addSignatureField();
            }
        }

        function addSignatureField() {
            const container = document.getElementById('signatureFieldsContainer');
            if (!container) return;

            signatureCounter++;
            const fieldId = 'signature_' + signatureCounter;

            const fieldDiv = document.createElement('div');
            fieldDiv.id = fieldId;
            fieldDiv.className =
                'p-6 bg-gradient-to-br from-red-50/40 to-red-50/20 border-2 border-red-200/50 rounded-2xl shadow-sm hover:shadow-md transition-shadow';
            fieldDiv.innerHTML = `
                <div class="flex gap-3 mb-5 items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-red-600/80 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                            ${signatureCounter}
                        </div>
                        <h4 class="font-semibold text-gray-800 text-sm">Penandatangan</h4>
                    </div>
                    ${container.children.length > 0 ? `<button type="button" onclick="removeSignatureField('${fieldId}')" class="px-3 py-1.5 bg-gradient-to-r from-red-500/80 to-red-600/70 text-white rounded-lg text-xs hover:shadow-sm transition font-medium">✕ Hapus</button>` : ''}
                </div>
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Nama Penandatangan *</label>
                        <input type="text" placeholder="Contoh: Budi Santoso" oninput="updateFormPreview()" onchange="updateFormPreview()" 
                               class="w-full px-4 py-2.5 border-2 border-red-200/60 rounded-xl focus:ring-2 focus:ring-red-400/50 focus:border-red-300 bg-white hover:bg-gray-50 text-sm font-medium transition" 
                               data-signature-name="${fieldId}" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide">Jabatan *</label>
                        <input type="text" placeholder="Contoh: Direktur Utama" oninput="updateFormPreview()" onchange="updateFormPreview()" 
                               class="w-full px-4 py-2.5 border-2 border-red-200/60 rounded-xl focus:ring-2 focus:ring-red-400/50 focus:border-red-300 bg-white hover:bg-gray-50 text-sm font-medium transition" 
                               data-signature-position="${fieldId}" />
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3">Isi nama dan jabatan penandatangan. Data akan ditampilkan di preview surat.</p>
            `;

            container.appendChild(fieldDiv);
            updateFormPreview();
        }

        function removeSignatureField(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                field.remove();
                updateFormPreview();
            }
        }

        function getSignaturesData() {
            const signatures = [];
            const container = document.getElementById('signatureFieldsContainer');
            if (!container) return [{
                name: 'Direktur Utama',
                position: ''
            }];

            container.querySelectorAll('[data-signature-name]').forEach(nameEl => {
                const fieldId = nameEl.dataset.signatureName;
                const posEl = container.querySelector(`[data-signature-position="${fieldId}"]`);

                const name = (nameEl.value || '').trim();
                const position = posEl ? (posEl.value || '').trim() : '';

                // Include signature if at least name or position is filled
                if (name || position) {
                    signatures.push({
                        name: name || 'Penandatangan',
                        position: position
                    });
                }
            });

            // If no signatures filled, return default
            return signatures.length > 0 ? signatures : [{
                name: 'Direktur Utama',
                position: ''
            }];
        }

        // ===== ADD SURAT SECTION FUNCTION =====
        function addSuratSection(title = '', content = '', sectionId = null) {
            const container = document.getElementById('suratSections');
            const uniqueId = sectionId || 'section_' + Date.now();

            const sectionDiv = document.createElement('div');
            sectionDiv.id = uniqueId;
            sectionDiv.className = 'p-5 bg-rose-50/40 border-2 border-rose-200/40 rounded-2xl shadow-sm';
            sectionDiv.innerHTML = `
                <div class="flex gap-2 mb-4 items-center">
                    <input type="text" placeholder="Judul Section (misal: Ketentuan Umum, Penutup, dll)" 
                           value="${title}" oninput="updateFormPreview()" onchange="updateFormPreview()" 
                           class="flex-1 px-3 py-2 border-2 border-red-300 rounded font-medium text-sm focus:ring-2 focus:ring-red-500" 
                           data-section-title="${uniqueId}" />
                    <button type="button" onclick="removeSuratSection('${uniqueId}')" 
                            class="px-3 py-2 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition">✕ Hapus</button>
                </div>
                <textarea placeholder="Isi section..." oninput="updateFormPreview()" onchange="updateFormPreview()" 
                          class="w-full px-3 py-2 border-2 border-red-300 rounded text-sm focus:ring-2 focus:ring-red-500" 
                          rows="5" 
                          data-section-content="${uniqueId}">${content}</textarea>
            `;
            if (container) container.appendChild(sectionDiv);
            updateFormPreview();
        }

        function removeSuratSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.remove();
                updateFormPreview();
            }
        }

        function getSuratSections() {
            const container = document.getElementById('suratSections');
            const sections = [];
            if (!container) return sections;

            container.querySelectorAll('div[id^="section_"]').forEach(sectionDiv => {
                const titleInput = sectionDiv.querySelector('[data-section-title]');
                const contentInput = sectionDiv.querySelector('[data-section-content]');
                const title = titleInput?.value?.trim() || '';
                const content = contentInput?.value?.trim() || '';
                if (title || content) sections.push({
                    title,
                    content
                });
            });
            return sections;
        }

        // Make functions globally accessible immediately
        window.openModalSurat = openModalSurat;
        window.openModalBuatSurat = openModalBuatSurat;
        window.closeModalSurat = closeModalSurat;
        window.updateFormPreview = updateFormPreview;
        window.addSuratSection = addSuratSection;
        window.removeSuratSection = removeSuratSection;
        window.getSuratSections = getSuratSections;

        // Upload Kop Surat - Define EARLY so it's available for addEventListener
        function uploadKop(e) {
            const fileInput = e.target || document.getElementById('kopUploadInput');
            const file = fileInput.files && fileInput.files[0];
            if (!file) return;

            const statusEl = document.getElementById('kopUploadStatus');

            // Validation: Check file size (max 10MB = 10240KB)
            if (file.size > 10 * 1024 * 1024) {
                if (statusEl) statusEl.innerHTML = '<span class="text-red-600">❌ File terlalu besar. Maksimal 10MB.</span>';
                if (fileInput) fileInput.value = '';
                return;
            }

            // Validation: RELAXED - support any common file format
            // Block only dangerous file extensions
            const blockedExtensions = ['exe', 'bat', 'cmd', 'com', 'scr', 'vbs', 'sh', 'jar'];
            const fileExt = file.name.split('.').pop().toLowerCase();
            if (blockedExtensions.includes(fileExt)) {
                if (statusEl) statusEl.innerHTML = '<span class="text-red-600">❌ Tipe file tidak aman.</span>';
                if (fileInput) fileInput.value = '';
                return;
            }

            if (statusEl) statusEl.innerHTML = '<span class="text-blue-600">⏳ Mengunggah...</span>';

            const form = new FormData();
            form.append('file', file);

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

            fetch('/admin/kop-surat', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: form,
                    credentials: 'same-origin'
                }).then(r => {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(data => {
                    if (data && data.success && data.data) {
                        // append and select
                        const sel = document.getElementById('kopSuratSelect');
                        const opt = document.createElement('option');
                        opt.value = data.data.id;
                        opt.text = data.data.name;
                        opt.dataset.url = data.data.url || '';
                        opt.dataset.isTemplate = data.data.is_template ? '1' : '0';
                        if (data.data.placeholders) {
                            opt.dataset.placeholders = JSON.stringify(data.data.placeholders || []);
                        }
                        if (sel) {
                            sel.prepend(opt);
                            sel.value = data.data.id;
                            // Trigger preview update
                            if (window.updateKopPreview) window.updateKopPreview();
                            if (window.updateFormPreview) window.updateFormPreview();
                        }
                        if (statusEl) statusEl.innerHTML =
                            '<span class="text-green-600">✅ Kop berhasil diunggah.</span>';
                    } else {
                        const errorMsg = data && data.message ? data.message : 'Gagal mengunggah';
                        if (statusEl) statusEl.innerHTML = '<span class="text-red-600">❌ ' + errorMsg + '</span>';
                    }
                    // clear file input
                    if (fileInput) fileInput.value = '';
                })
                .catch(err => {
                    console.error('uploadKop error', err);
                    const errorMsg = err.message || 'Gagal mengunggah';
                    if (statusEl) statusEl.innerHTML = '<span class="text-red-600">❌ ' + errorMsg + '</span>';
                    if (fileInput) fileInput.value = '';
                });
        }

        window.uploadKop = uploadKop;
    </script>
    <style>
        /* Hide the 'Buat Surat Baru' header button while modal is open */
        body.modal-open #btnBuatSurat {
            display: none !important;
        }

        /* Step card styling for compact, clean layout */
        .step {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .step h3 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #formSteps .step+.step {
            margin-top: 0.75rem;
        }

        /* Hide modal footer when using multi-step form for clarity (JS toggles) */
        .modal-hid-footer #modalFooter {
            display: none !important;
        }
    </style>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="py-8 min-h-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="mb-8">
                    <div
                        class="bg-gradient-to-br from-rose-500/90 via-red-500/80 to-slate-300/70 rounded-3xl shadow-sm p-6 sm:p-8 backdrop-blur-md border border-rose-400/20">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">

                            <div class="flex items-center gap-4">
                                <div class="bg-white/80 p-3 rounded-2xl shadow-sm">
                                    <svg class="w-8 h-8 text-red-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>

                                <div>
                                    <h1 class="text-3xl font-bold text-white drop-shadow">
                                        Manajemen Surat Resmi
                                    </h1>
                                    <p class="text-white/90 mt-1">
                                        Kelola surat resmi yang telah disetujui direktur
                                    </p>
                                </div>
                            </div>

                            <button id="btnBuatSurat" onclick="openModalBuatSurat()"
                                class="inline-flex items-center px-5 py-3 bg-white text-red-700 font-semibold rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-all duration-200 whitespace-nowrap relative z-50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Surat Baru
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Tabs Navigation -->
                <div class="mb-8">
                    <div class="bg-white rounded-3xl shadow-md p-3 border border-gray-100/50 backdrop-blur-sm">
                        <nav class="flex space-x-2" aria-label="Tabs">
                            <button onclick="switchTab('permintaan')" id="tab-permintaan"
                                class="group inline-flex items-center px-5 py-3 rounded-2xl font-medium text-sm bg-rose-50/50 text-rose-700/90 whitespace-nowrap focus:outline-none transition-all border-b-2 border-rose-400/40 shadow-sm hover:shadow-md">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                                <span>Permintaan Disetujui</span>
                            </button>
                            <button onclick="switchTab('daftar')" id="tab-daftar"
                                class="group inline-flex items-center px-5 py-3 rounded-2xl font-medium text-sm text-gray-600 hover:bg-gray-50/60 hover:text-gray-900 whitespace-nowrap focus:outline-none transition-all">
                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                </svg>
                                <span>Daftar Surat Terbit</span>
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- TAB 1: Permintaan Surat Disetujui Direktur -->
                <div id="content-permintaan" class="block">
                    <!-- Info Banner -->
                    <div class="bg-rose-50/40 border-l-4 border-rose-300/40 p-4 mb-6 rounded-2xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-rose-400/50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-rose-700/60">Tampilan ini menunjukkan permintaan surat dari
                                    karyawan
                                    yang telah disetujui Direktur dan siap diterbitkan oleh Admin HRD.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div
                        class="bg-white shadow-md rounded-3xl border border-gray-100/50 mb-6 overflow-hidden backdrop-blur-sm">
                        <div class="px-6 py-5">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Filter & Pencarian</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <x-label for="search_employee" value="Cari Karyawan atau Keperluan" />
                                    <x-input id="search_employee" type="text" class="mt-1 block w-full rounded-2xl"
                                        placeholder="Ketik nama karyawan..." />
                                </div>
                                <div>
                                    <x-label for="filter_type" value="Jenis Permintaan" />
                                    <select id="filter_type"
                                        class="mt-1 block w-full border-gray-200/50 focus:border-red-500 focus:ring-red-500 rounded-2xl shadow-sm px-4 py-3 text-base bg-white/70 hover:bg-white transition-colors">
                                        <option value="">Pilih Jenis</option>
                                        <option value="cuti">Cuti</option>
                                        <option value="lembur">Lembur</option>
                                        <option value="resmi">Resmi</option>
                                        <option value="lain">Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="filter_date" value="Tanggal Disetujui" />
                                    <x-input id="filter_date" type="date" class="mt-1 block w-full rounded-2xl" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Card 1: Menunggu Dibuat -->
                        <div class="bg-white rounded-3xl shadow-md border border-red-100/50 hover:shadow-lg hover:border-red-200/60 transition-all duration-300 stats-card cursor-pointer backdrop-blur-sm"
                            role="button" tabindex="0" onclick="cardFilter('permintaan','Menunggu Dibuat', this)"
                            data-status="Menunggu Dibuat" aria-pressed="false">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="p-3.5 bg-red-100/60 rounded-2xl">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Menunggu Dibuat</p>
                                            <p class="text-xs text-gray-500">Butuh perhatian</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-4xl font-bold text-gray-800" id="count-pending">12</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Sedang Diproses -->
                        <div class="bg-white rounded-3xl shadow-md border border-gray-100/50 hover:shadow-lg hover:border-gray-200/60 transition-all duration-300 stats-card cursor-pointer backdrop-blur-sm"
                            role="button" tabindex="0" onclick="cardFilter('permintaan','Sedang Diproses', this)"
                            data-status="Sedang Diproses" aria-pressed="false">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-3 bg-red-100/60 rounded-2xl">
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Sedang Diproses</p>
                                            <p class="text-xs text-gray-500">Dalam pengerjaan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-4xl font-bold text-gray-800" id="count-processing">3</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Telah Diterbitkan -->
                        <div class="bg-white rounded-3xl shadow-md border border-gray-100/50 hover:shadow-lg hover:border-gray-200/60 transition-all duration-300 stats-card cursor-pointer backdrop-blur-sm"
                            role="button" tabindex="0" onclick="cardFilter('daftar','Telah Diterbitkan', this)"
                            data-status="Telah Diterbitkan" aria-pressed="false">
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-3 bg-gray-100/60 rounded-2xl">
                                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-600">Telah Diterbitkan</p>
                                            <p class="text-xs text-gray-500">Bulan ini</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-4xl font-bold text-gray-800" id="count-published">28</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Queue Table -->
                    <div
                        class="bg-white shadow-md rounded-3xl overflow-hidden border border-gray-100/50 backdrop-blur-sm">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200/50">
                                <thead
                                    class="bg-gradient-to-r from-rose-50/40 to-rose-100/30 border-b-2 border-rose-200/30">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Karyawan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Jenis Permintaan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Keperluan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Disetujui Tgl
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100/50">
                                    <!-- Item 1 -->
                                    <tr class="hover:bg-red-50/30 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-red-600 font-medium text-xs">AR</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Ahmad Rizki</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Cuti</td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700">Cuti Tahunan 5 Hari</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Menunggu Dibuat
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button onclick="buatSurat('Ahmad Rizki', 'Cuti')"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-2xl hover:from-red-600 hover:to-red-700 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Buat Surat
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 2 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-pink-100 flex items-center justify-center">
                                                        <span class="text-pink-600 font-medium text-xs">SN</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Siti Nurhaliza</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Lembur</td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700">Lembur 8 Jam</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Sedang Diproses
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button onclick="lanjutkanSurat('Siti Nurhaliza', 'Lembur')"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-medium rounded-2xl hover:from-gray-600 hover:to-gray-700 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                                Lanjutkan
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 3 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-red-600 font-medium text-xs">BS</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Resmi</td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700">Izin Keluar Jam Kerja</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Menunggu Dibuat
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button onclick="buatSurat('Budi Santoso', 'Resmi')"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-2xl hover:from-red-600 hover:to-red-700 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Buat Surat
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 4 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                        <span class="text-red-600 font-medium text-xs">RW</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Rina Wijaya</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Cuti</td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700">Cuti Sakit 3 Hari</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">13 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Menunggu Dibuat
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button onclick="buatSurat('Rina Wijaya', 'Cuti')"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-2xl hover:from-red-600 hover:to-red-700 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Buat Surat
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Item 5 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                                        <span class="text-yellow-600 font-medium text-xs">DG</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">Dedi Gunawan</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Cuti</td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-700">Cuti Tahunan 7 Hari</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">09 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Menunggu Dibuat
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button onclick="buatSurat('Dedi Gunawan', 'Cuti')"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-2xl hover:from-red-600 hover:to-red-700 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Buat Surat
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: Daftar Surat Diterbitkan -->
                <div id="content-daftar" class="hidden">
                    <!-- Surat Menunggu Pengiriman -->
                    <div class="bg-white shadow-md rounded-3xl border border-gray-100/50 mb-6 overflow-hidden">
                        <div class="px-6 py-4">
                            <h3 class="text-base font-medium text-gray-900 mb-3">Surat Menunggu Pengiriman</h3>
                            <div id="pendingSuratContainer" class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Nomor</th>
                                            <th
                                                class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Perihal</th>
                                            <th
                                                class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Karyawan</th>
                                            <th
                                                class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-2 text-center text-xs font-medium text-gray-500 uppercase">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pendingSuratTableBody" class="bg-white divide-y divide-gray-100">
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-sm text-gray-500">Memuat...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Info Banner -->
                    <div class="bg-gray-50/60 border-l-4 border-gray-400/50 p-4 mb-6 rounded-2xl">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-gray-400/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-gray-700/80">Daftar surat resmi yang telah diterbitkan oleh
                                    Admin
                                    HRD. Surat ini tersedia untuk diambil karyawan dan dilaporkan ke Direktur.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div
                        class="bg-white shadow-md rounded-3xl border border-gray-100/50 mb-6 overflow-hidden backdrop-blur-sm">
                        <div class="px-6 py-5">
                            <h3 class="text-base font-medium text-gray-900 mb-4">Filter & Pencarian</h3>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="md:col-span-2">
                                    <x-label for="search_surat" value="Cari Nomor Surat atau Karyawan" />
                                    <x-input id="search_surat" type="text" class="mt-1 block w-full rounded-2xl"
                                        placeholder="Cari..." />
                                </div>
                                <div>
                                    <x-label for="filter_type_publish" value="Jenis Surat" />
                                    <select id="filter_type_publish"
                                        class="mt-1 block w-full border-gray-200/50 focus:border-red-500 focus:ring-red-500 rounded-2xl shadow-sm px-4 py-3 text-base bg-white/70 hover:bg-white transition-colors">
                                        <option value="">Pilih Jenis</option>
                                        <option value="cuti">Cuti</option>
                                        <option value="lembur">Lembur</option>
                                        <option value="resmi">Resmi</option>
                                    </select>
                                </div>
                                <div>
                                    <x-label for="filter_date_publish" value="Tanggal Terbit" />
                                    <x-input id="filter_date_publish" type="date"
                                        class="mt-1 block w-full rounded-2xl" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                        <div
                            class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border border-green-100">
                            <div class="px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-green-700">Total Surat Diterbitkan Bulan Ini
                                        </p>
                                        <p class="text-3xl font-bold text-green-600 mt-2">28</p>
                                        <p class="text-xs text-green-500 mt-1">Januari 2026</p>
                                    </div>
                                    <div
                                        class="p-4 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl shadow-md">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gradient-to-br from-red-50 to-gray-50 rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 border border-red-100">
                            <div class="px-6 py-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-blue-700">Belum Diambil Karyawan</p>
                                        <p class="text-3xl font-bold text-blue-600 mt-2">5</p>
                                        <p class="text-xs text-blue-500 mt-1">Perlu tindak lanjut</p>
                                    </div>
                                    <div class="p-4 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-md">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Published Surat Table -->
                    <div
                        class="bg-white shadow-md rounded-3xl overflow-hidden border border-gray-100/50 backdrop-blur-sm">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200/50">
                                <thead
                                    class="bg-gradient-to-r from-rose-50/40 to-rose-100/30 border-b-2 border-rose-200/30">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            No. Surat
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Jenis
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Karyawan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Tgl Terbit
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-red-700 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100/50">
                                    <tr class="hover:bg-red-50/30 transition-colors duration-200">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">
                                            SK-2026-001</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Resmi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Ahmad Rizki</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Telah Diterbitkan
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <x-secondary-button class="!py-2 !px-4">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </x-secondary-button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">
                                            SK-2026-002</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Lembur</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Siti Nurhaliza
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Telah Diterbitkan
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <x-secondary-button class="!py-2 !px-4">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </x-secondary-button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">
                                            SK-2026-003</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Resmi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Budi Santoso</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11 Jan 2026</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Telah Diterbitkan
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <x-secondary-button class="!py-2 !px-4">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat
                                            </x-secondary-button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Buat/Edit Surat with Better Custom Style -->
        <!-- Modal: Buat/Edit Surat -->
        <div id="modalSurat" class="hidden fixed inset-0 z-50 flex items-center justify-center"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- Semi-dark blurred overlay (click to close) -->
            <div class="fixed inset-0 bg-black/40 backdrop-blur-md"
                style="backdrop-filter: blur(10px) brightness(60%); -webkit-backdrop-filter: blur(10px) brightness(60%); background-color: rgba(0,0,0,0.4);"
                aria-hidden="true" onclick="closeModalSurat()"></div>

            <div
                class="relative bg-white rounded-xl shadow-2xl w-full h-full lg:h-auto lg:max-w-7xl lg:max-h-[92vh] overflow-hidden z-10 flex flex-col">
                <!-- Header -->
                <div
                    class="px-8 py-6 border-b border-gray-200 flex justify-between items-center bg-white flex-shrink-0">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Buat Surat Resmi</h2>
                        <p class="text-sm text-gray-600 mt-1">Lengkapi semua field untuk membuat surat resmi baru</p>
                    </div>
                    <button onclick="closeModalSurat()"
                        class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-2xl p-2 transition flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Content - Flex to take remaining space -->
                <div class="flex-1 overflow-hidden flex flex-col">
                    <!-- SINGLE PAGE FORM: Left form + Right Preview - Google Form Style -->
                    <div id="formSteps"
                        class="grid grid-cols-1 lg:grid-cols-3 gap-0 flex-1 overflow-hidden bg-gray-100 w-full h-full">

                        <!-- LEFT COLUMN: Form Inputs - Google Form Style with proper scroll -->
                        <div class="lg:col-span-2 flex flex-col overflow-y-auto h-full">

                            <!-- Kop Surat Section -->
                            <div class="bg-gradient-to-b from-red-50 to-gray-50 border-b-2 border-red-300 p-8">
                                <div class="max-w-2xl">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <h2 class="text-2xl font-bold text-gray-900">Kop Surat</h2>
                                    </div>
                                    <p class="text-gray-600 mb-6 ml-13">Pilih atau unggah kop surat perusahaan</p>

                                    <div class="flex gap-3 items-center mb-4">
                                        <select id="kopSuratSelect" onchange="updateFormPreview()"
                                            class="flex-1 px-4 py-2.5 border-2 border-red-300/50 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 text-gray-900 font-medium hover:bg-white">
                                            <option value="">-- Pilih Kop Surat (Default) --</option>
                                        </select>
                                        <input id="kopUploadInput" type="file"
                                            accept=".jpg,.jpeg,.png,.svg,.pdf,.docx,.xlsx,.pptx,.doc,.xls,.ppt,.gif,.bmp,.tiff,.txt,.odt,.ods,.odp"
                                            class="hidden" />
                                        <button type="button"
                                            onclick="document.getElementById('kopUploadInput').click()"
                                            title="Unggah berbagai jenis file (JPG, PNG, PDF, DOCX, XLSX, PPTX, dll)"
                                            class="px-4 py-2.5 bg-gradient-to-r from-red-500/80 to-red-600/80 border border-transparent rounded-2xl text-white hover:shadow-md transition font-medium text-sm flex items-center gap-2"><svg
                                                class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-6" />
                                            </svg> Unggah</button>
                                    </div>
                                    <div id="kopPreview"
                                        class="text-sm text-gray-600 mb-4 p-4 bg-white rounded-2xl border-2 border-dashed border-red-300/40 min-h-24 flex items-center justify-center">
                                        Tidak ada kop dipilih</div>
                                    <div id="kopTemplateFields" class="space-y-4 mb-6"></div>
                                    <div id="kopUploadStatus" class="text-xs font-medium h-5"></div>
                                </div>
                            </div>

                            <!-- Form Sections -->
                            <div class="divide-y divide-gray-200 flex-1">

                                <!-- Section 1: Jenis Surat -->
                                <div class="bg-white p-8 border-b-2 border-red-100">
                                    <div class="max-w-2xl">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">1</span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900">Jenis Surat</h3>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-6 ml-11">Pilih jenis surat yang akan dibuat
                                        </p>

                                        <select id="jenisSurat" oninput="updateFormPreview()"
                                            onchange="updateFormPreview()"
                                            class="w-full px-4 py-3 border-2 border-rose-200/30 rounded-2xl focus:ring-2 focus:ring-rose-400/50 focus:border-rose-400/50 transition bg-white/70 text-gray-900 font-medium hover:bg-white">
                                            <option value="">-- Pilih Jenis Surat --</option>
                                            <option value="pkwt">PKWT (Perjanjian Kerja Waktu Tertentu)</option>
                                            <option value="pkwtt">PKWTT (Perjanjian Kerja Waktu Tidak Tertentu)
                                            </option>
                                            <option value="magang">Surat Balasan Magang</option>
                                            <option value="jalan">Surat Jalan</option>
                                            <option value="cuti">Surat Pengajuan Cuti</option>
                                            <option value="lembur">Surat Pengajuan Lembur</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Section 2: Informasi Umum -->
                                <div class="bg-white p-8 border-b-2 border-red-100">
                                    <div class="max-w-2xl">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">2</span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900">Informasi Umum</h3>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-6 ml-11">Isi data identitas surat dan
                                            penerima</p>

                                        <!-- Nomor Surat -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Nomor Surat
                                                *</label>
                                            <input type="text" id="nomorSurat" placeholder="Contoh: 001/HR/2026"
                                                oninput="updateFormPreview()" onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                            <p class="text-xs text-red-600 mt-1">Format: Nomor/Departemen/Tahun</p>
                                        </div>

                                        <!-- Tanggal Surat -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Tanggal Surat
                                                *</label>
                                            <input type="date" id="tanggalSurat" oninput="updateFormPreview()"
                                                onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Nama Karyawan -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Nama Karyawan
                                                *</label>
                                            <input type="text" id="karyawanSurat" placeholder="Nama lengkap"
                                                oninput="updateFormPreview()" onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Jabatan -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Jabatan</label>
                                            <input type="text" id="jabatanSurat" placeholder="Misal: Manager IT"
                                                oninput="updateFormPreview()" onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Departemen -->
                                        <div class="mb-6">
                                            <label
                                                class="block text-sm font-medium text-gray-900 mb-2">Departemen</label>
                                            <input type="text" id="departemenSurat" placeholder="Misal: HR, IT"
                                                oninput="updateFormPreview()" onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Tujuan Surat -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Tujuan
                                                Surat</label>
                                            <input type="text" id="tujuanSurat"
                                                placeholder="Ke mana surat ditujukan" oninput="updateFormPreview()"
                                                onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Custom Fields for Informasi Umum -->
                                        <div id="customInformasiUmumFields" class="space-y-4 mb-6"></div>

                                        <!-- Add Section Button -->
                                        <button type="button" onclick="addCustomInformasiUmumField()"
                                            class="px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-500/80 text-white rounded-2xl hover:shadow-sm transition font-medium text-sm">+
                                            Tambah Field</button>
                                    </div>
                                </div>

                                <!-- Section 3: Isi Surat (Section-Based) -->
                                <div class="bg-white p-8 border-b-2 border-red-100">
                                    <div class="max-w-2xl">
                                        <div class="flex items-center justify-between mb-6">
                                            <div>
                                                <div class="flex items-center gap-3 mb-2">
                                                    <div
                                                        class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                                        <span class="text-white text-sm font-bold">3</span>
                                                    </div>
                                                    <h3 class="text-lg font-bold text-gray-900">Isi Surat</h3>
                                                </div>
                                                <p class="text-sm text-gray-500 ml-11">Kelola isi surat dalam bentuk
                                                    section</p>
                                            </div>
                                            <button type="button" onclick="addSuratSection()"
                                                class="px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-500/80 text-white rounded-2xl hover:shadow-sm transition font-medium text-sm">+
                                                Section</button>
                                        </div>

                                        <div id="suratSections" class="space-y-4">
                                            <!-- Dynamic sections will be added here -->
                                        </div>
                                        <p class="text-xs text-gray-500 mt-4">Setiap section terdiri dari judul dan
                                            isi. Tambahkan section sesuai struktur surat Anda.</p>
                                    </div>
                                </div>

                                <!-- Section 3.5: Penutup Surat -->
                                <div class="bg-white p-8 border-b-2 border-red-100">
                                    <div class="max-w-2xl">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white text-sm font-bold">3.5</span>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900">Penutup Surat</h3>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-6 ml-11">Tuliskan kalimat penutup setelah
                                            "Hormat kami,"</p>

                                        <!-- Greeting Text -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Teks Penutup
                                                (setelah Hormat kami,)</label>
                                            <textarea id="greetingText"
                                                placeholder="Contoh: Demikian surat ini kami buat untuk dapat dipergunakan sebagaimana mestinya."
                                                oninput="updateFormPreview()" onchange="updateFormPreview()" rows="3"
                                                class="w-full px-4 py-3 border-2 border-red-200/40 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition bg-white/70 hover:bg-white resize-none"></textarea>
                                            <p class="text-xs text-gray-500 mt-1">Default: Demikian surat ini kami buat
                                                untuk dapat dipergunakan sebagaimana mestinya.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 4: Tanda Tangan -->
                                <div class="bg-white p-8 border-b-2 border-red-100">
                                    <div class="max-w-2xl">
                                        <div class="flex items-center justify-between gap-3 mb-2">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                                    <span class="text-white text-sm font-bold">4</span>
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-900">Tanda Tangan &
                                                    Penandatangan</h3>
                                            </div>
                                            <button type="button" onclick="addSignatureField()"
                                                class="px-3 py-1.5 bg-gradient-to-r from-red-500/85 to-red-600/75 text-white rounded-xl hover:shadow-sm transition font-medium text-sm flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Penandatangan
                                            </button>
                                        </div>
                                        <p class="text-sm text-gray-500 mb-6 ml-11">Bisa menambahkan 1 atau lebih
                                            penandatangan surat</p>

                                        <!-- Tempat Tanda Tangan -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-900 mb-2">Tempat Tanda
                                                Tangan</label>
                                            <input type="text" id="tempatTandaTangan" placeholder="Misal: Jakarta"
                                                oninput="updateFormPreview()" onchange="updateFormPreview()"
                                                class="w-full px-4 py-3 border-2 border-rose-200/30 rounded-2xl focus:ring-2 focus:ring-rose-400/50 focus:border-rose-400/50 transition bg-white/70 hover:bg-white" />
                                        </div>

                                        <!-- Daftar Penandatangan -->
                                        <div id="signatureFieldsContainer" class="space-y-6">
                                            <!-- Signature Fields akan ditambahkan di sini dengan JS -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Template Fields Dynamic -->
                                <div id="suratTemplateFields" class="bg-white p-8 border-b-2 border-red-100"></div>
                                <div id="templateDynamicForm" class="bg-white p-8 border-b-2 border-red-100"></div>
                            </div>

                            <!-- Mobile Action Buttons (Bottom Sticky) -->
                            <div
                                class="lg:hidden bg-white p-8 border-t-2 border-red-100 flex gap-3 justify-start sticky bottom-0 z-20">
                                <button type="button" onclick="closeModalSurat()"
                                    class="px-6 py-3 border-2 border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">Batal</button>
                                <button type="button" id="previewLetterBtn" onclick="previewLetter()"
                                    class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-medium">Pratayang</button>
                                <button type="button" onclick="simpanSurat()"
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">Terbitkan
                                    Surat</button>
                            </div>
                        </div>

                        <!-- RIGHT COLUMN: Real-time Preview -->
                        <div
                            class="hidden lg:flex flex-col bg-gradient-to-b from-red-50 to-gray-50 border-l-2 border-red-300 h-full overflow-hidden">
                            <div class="flex-1 overflow-y-auto flex flex-col">
                                <!-- Preview Header -->
                                <div
                                    class="bg-gradient-to-r from-rose-500/50 to-red-400/50 border-b-2 border-rose-300/30 p-5 flex-shrink-0 shadow-sm rounded-t-2xl">
                                    <h3 class="font-bold text-white text-lg">📄 Pratayang Surat</h3>
                                    <p class="text-red-100 text-xs mt-1">Diperbarui secara real-time</p>
                                </div>

                                <!-- Preview Content -->
                                <div class="flex-1 overflow-y-auto p-6">
                                    <div id="suratPreview"
                                        class="bg-white p-8 rounded-lg shadow-md border-2 border-red-300 font-serif text-sm text-gray-900 min-h-full">
                                        <div class="text-center text-red-300 py-12">
                                            <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="text-sm text-red-500 font-medium">Mulai isi form untuk melihat
                                                pratayang</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Actions -->
                                <div
                                    class="border-t-2 border-red-300/30 bg-white p-4 sticky bottom-0 shadow-md rounded-b-3xl">
                                    <button type="button" id="generatePdfBtn" onclick="generatePdf()"
                                        class="w-full px-4 py-3 bg-gradient-to-r from-red-500/80 to-red-500/80 text-white rounded-2xl hover:shadow-sm transition font-medium text-sm">📄
                                        Download PDF</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Desktop Action Buttons - FIXED FOOTER -->
                <div
                    class="hidden lg:flex gap-3 justify-start bg-white border-t-2 border-red-200/30 p-8 flex-shrink-0">
                    <button type="button" onclick="closeModalSurat()"
                        class="px-6 py-3 border-2 border-gray-300 rounded-2xl text-gray-700 hover:bg-gray-50 transition font-medium">Batal</button>
                    <button type="button" id="previewLetterBtn" onclick="previewLetter()"
                        class="px-6 py-3 bg-gray-600 text-white rounded-2xl hover:bg-gray-700 transition font-medium">Pratayang</button>
                    <button type="button" onclick="simpanSurat()"
                        class="px-6 py-3 bg-red-600 text-white rounded-2xl hover:bg-red-700 transition font-medium">Terbitkan
                        Surat</button>
                </div>
            </div>

            <!-- Footer - Hidden by default, shown only when needed -->
            <div id="modalFooter" class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <button onclick="closeModalSurat()"
                    class="px-4 py-2 border border-gray-300 rounded-2xl text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button onclick="simpanSurat()"
                    class="px-4 py-2 bg-red-600 text-white rounded-2xl hover:bg-red-700 transition-colors font-medium">Terbitkan
                    Surat</button>
            </div>
        </div>
    </div>
    </div>

    <script>
        function switchTab(tab) {
            // Hide all content
            document.getElementById('content-permintaan').classList.add('hidden');
            document.getElementById('content-daftar').classList.add('hidden');

            // Reset all tabs - updated for new tab style
            const tabs = ['tab-permintaan', 'tab-daftar'];
            tabs.forEach(tabId => {
                const tabEl = document.getElementById(tabId);
                tabEl.classList.remove('bg-rose-50/50', 'text-rose-700/90');
                tabEl.classList.add('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
            });

            // Show selected content and activate tab
            document.getElementById('content-' + tab).classList.remove('hidden');
            const activeTab = document.getElementById('tab-' + tab);
            activeTab.classList.remove('text-gray-600', 'hover:bg-gray-50', 'hover:text-gray-900');
            activeTab.classList.add('bg-rose-50/50', 'text-rose-700/90');
        }

        // Assign remaining global functions (modal functions already assigned above)
        function buatSurat(karyawan, jenis) {
            // Store context so we can remove/move request row when published
            window.currentRequest = {
                karyawan: karyawan,
                jenis: jenis
            };
            openModalSurat();
            document.getElementById('karyawanSurat').value = karyawan;
            // keep select values as short form (cuti/lembur/resmi)
            document.getElementById('jenisSurat').value = jenis.toLowerCase();
        }

        function lanjutkanSurat(karyawan, jenis) {
            buatSurat(karyawan, jenis);
        }

        function simpanSurat() {
            const nomorEl = document.getElementById('nomorSurat');
            const tanggalEl = document.getElementById('tanggalSurat');
            const jenisEl = document.getElementById('jenisSurat');
            const karyawanEl = document.getElementById('karyawanSurat');
            const tujuanEl = document.getElementById('tujuanSurat');
            const isiEl = document.getElementById('isiSurat');
            const kopSelect = document.getElementById('kopSuratSelect');

            const nomor = nomorEl.value ? nomorEl.value.trim() : '';
            const tanggal = tanggalEl.value ? new Date(tanggalEl.value) : new Date();
            const jenis = jenisEl.value || 'resmi';
            const karyawan = karyawanEl.value.trim();

            if (!nomor) {
                alert('Nomor surat harus diisi');
                return;
            }
            const tujuan = tujuanEl.value.trim();
            // read content from CKEditor if available
            let isi = '';
            if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) {
                isi = CKEDITOR.instances.isiSurat.getData().trim();
            } else {
                isi = isiEl.value.trim();
            }
            const kopId = kopSelect?.value || '';
            const kopName = kopSelect?.selectedOptions?.[0]?.text || '';

            if (!karyawan) {
                alert('Nama karyawan harus diisi');
                return;
            }

            // POST to server to create surat and optionally generate filled document
            // include sections if present and ensure isi contains assembled sections
            const sections = getSectionsData();
            let finalIsi = isi;
            if (sections && sections.length) {
                finalIsi = sections.map(s => {
                    const title = s.title ? `<h3>${escapeHtml(s.title)}</h3>` : '';
                    const content = s.content || '';
                    return title + content + '<br/>';
                }).join('');
            }

            const payload = {
                nomor: nomor,
                tanggal: tanggalEl.value,
                jenis: jenis,
                karyawan: karyawan,
                jabatan: document.getElementById('jabatanSurat')?.value || '',
                departemen: document.getElementById('departemenSurat')?.value || '',
                tujuan: tujuan,
                isi: finalIsi,
                sections: sections,
                kop_surat_id: kopSelect?.value || null,
                placeholders: {},
                details: collectJenisData(),
                signatures: getSignaturesData(), // Add multiple signatures
                tempat_tanda_tangan: document.getElementById('tempatTandaTangan')?.value ||
                    '', // Add signature location
                greeting_text: document.getElementById('greetingText')?.value ||
                    'Demikian surat ini kami buat untuk dapat dipergunakan sebagaimana mestinya.', // Add greeting text
            };
            // helper to find the newly created row
            let lastCreatedSuratNomor = null;

            // disable button visual early to prevent double submits
            const btn = document.querySelector('button[onclick="simpanSurat()"]');
            if (btn) btn.disabled = true;

            // collect placeholders inputs (kop template)
            document.querySelectorAll('#kopTemplateFields [data-ph]').forEach(i => {
                payload.placeholders[i.dataset.ph] = i.value || '';
            });
            // collect placeholders from surat template fields (if any)
            document.querySelectorAll('#suratTemplateFields [data-tplph]').forEach(i => {
                payload.placeholders[i.dataset.tplph] = i.value || '';
            });

            // validate required schema-driven fields
            const missingReq = Array.from(document.querySelectorAll(
                '#templateDynamicForm [data-schema-required="1"], #informasiCustomFields [data-schema-required="1"]'
            )).filter(i => !((i.value || '').toString().trim().length));
            if (missingReq.length) {
                if (btn) btn.disabled = false;
                alert('Harap lengkapi semua field wajib pada Form Template.');
                return;
            }

            // collect schema-driven form values (including Informasi Umum custom fields)
            document.querySelectorAll('#templateDynamicForm [data-schema-key], #informasiCustomFields [data-schema-key]')
                .forEach(i => {
                    const k = i.dataset.schemaKey;
                    let v = '';
                    if (i.tagName === 'INPUT' || i.tagName === 'SELECT' || i.tagName === 'TEXTAREA') v = i.value || '';
                    payload.placeholders[k.toUpperCase()] = v;
                });

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

            fetch('/admin/surat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(payload),
                    credentials: 'same-origin'
                }).then(r => r.json())
                .then(data => {
                    if (data && data.ok && data.surat) {
                        const s = data.surat;
                        // record nomor for later template fill
                        lastCreatedSuratNomor = s.nomor_surat || nomor;
                        if (tbodyPub) {
                            const tr = document.createElement('tr');
                            tr.className = 'hover:bg-gray-50';
                            tr.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">${s.nomor_surat || nomor}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${capitalize(s.jenis || jenis)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${escapeHtml(karyawan)}${kopName ? `<div class="text-xs text-gray-400 mt-1">${escapeHtml(kopName)}</div>` : ''}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatDate(tanggal)}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Telah Diterbitkan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="${s.generated_file_url || '#'}" target="_blank" class="text-red-600 hover:underline">Lihat</a>
                                </td>
                            `;
                            tbodyPub.prepend(tr);

                            // update published count
                            const pubCountEl = document.getElementById('count-published');
                            if (pubCountEl) pubCountEl.innerText = (parseInt(pubCountEl.innerText || '0') + 1)
                                .toString();
                        }

                        // close modal
                        closeModalSurat();
                    } else {
                        alert('Gagal menerbitkan surat.');
                        console.error('Surat store response', data);
                    }
                }).catch(err => {
                    console.error('simpanSurat post error', err);
                    alert('Gagal menerbitkan surat. Periksa console.');
                }).finally(() => {
                    if (btn) btn.disabled = false;
                });
            // If selected kop is a template, try to generate filled document on the server
            if (kopId) {
                const selectedOpt = document.getElementById('kopSuratSelect').selectedOptions[0];
                const isTemplate = selectedOpt?.dataset?.istemplate === '1' || selectedOpt?.dataset?.isTemplate === '1';
                if (isTemplate) {
                    // collect placeholder inputs
                    const inputs = document.querySelectorAll('#kopTemplateFields [data-ph]');
                    const payload = {};
                    inputs.forEach(i => {
                        const key = i.dataset.ph;
                        payload[key] = i.value || '';
                    });
                    // include common fields
                    payload['NOMOR'] = nomor;
                    payload['TANGGAL'] = formatDate(tanggal);
                    payload['KARYAWAN'] = karyawan;
                    payload['TUJUAN'] = tujuan;
                    payload['ISI'] = isi;

                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

                    fetch(`/admin/kop-surat/${kopId}/fill`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify(payload),
                            credentials: 'same-origin'
                        }).then(r => r.json())
                        .then(data => {
                            if (data && data.success && data.url) {
                                // Try to attach link to the newly added row in published table
                                let appended = false;
                                const rows = document.querySelectorAll('#content-daftar table tbody tr');
                                for (const row of rows) {
                                    const nomorCell = row.querySelector('td:nth-child(1)')?.innerText?.trim() || '';
                                    const karyawanCell = row.querySelector('td:nth-child(3)')?.innerText?.trim() || '';
                                    if ((lastCreatedSuratNomor && nomorCell === lastCreatedSuratNomor) || (karyawan &&
                                            karyawanCell.indexOf(karyawan) !== -1)) {
                                        const link = document.createElement('a');
                                        link.href = data.url;
                                        link.target = '_blank';
                                        link.className = 'text-red-600 ml-2 underline text-sm';
                                        link.innerText = 'Download Dokumen';
                                        row.querySelector('td:last-child').appendChild(link);
                                        appended = true;
                                        break;
                                    }
                                }
                                if (!appended) {
                                    // fallback: open the file
                                    window.open(data.url, '_blank');
                                }
                            } else {
                                console.warn('Template generation failed', data);
                            }
                        }).catch(err => console.error('fill error', err));
                }
            }

            // If this was opened from an existing request, remove that request row and decrement counts
            if (window.currentRequest) {
                const tbodyReq = document.querySelector('#content-permintaan table tbody');
                if (tbodyReq) {
                    const rows = tbodyReq.querySelectorAll('tr');
                    for (const row of rows) {
                        const name = (row.querySelector('td:nth-child(1) .text-sm')?.innerText || '').trim();
                        const jenisText = (row.querySelector('td:nth-child(2)')?.innerText || '').trim().toLowerCase();
                        if (name === window.currentRequest.karyawan && jenisText.indexOf(window.currentRequest.jenis
                                .toLowerCase()) !== -1) {
                            // find status cell to adjust counts
                            const statusText = (row.querySelector('td:nth-child(5)')?.innerText || '').trim();
                            row.remove();
                            // decrement pending/processing counts accordingly
                            if (statusText.indexOf('Menunggu') !== -1) {
                                const pendingEl = document.getElementById('count-pending');
                                if (pendingEl) pendingEl.innerText = Math.max(0, parseInt(pendingEl.innerText || '0') - 1)
                                    .toString();
                            } else if (statusText.indexOf('Sedang') !== -1) {
                                const procEl = document.getElementById('count-processing');
                                if (procEl) procEl.innerText = Math.max(0, parseInt(procEl.innerText || '0') - 1)
                                    .toString();
                            }
                            break;
                        }
                    }
                }
            }

            // show banner message via Alpine component
            window.dispatchEvent(new CustomEvent('banner-message', {
                detail: {
                    style: 'success',
                    message: 'Surat berhasil diterbitkan.'
                }
            }));

            closeModalSurat();
        }

        function generateNomorSurat() {
            // kept for backward compatibility but we no longer auto-fill nomor
            const now = new Date();
            const y = now.getFullYear();
            const t = String(now.getTime()).slice(-4);
            return `SK-${y}-${t}`;
        }

        function generateNomorFromTemplate(template) {
            const now = new Date();
            const YEAR = now.getFullYear();
            const MONTH = String(now.getMonth() + 1).padStart(2, '0');
            const DAY = String(now.getDate()).padStart(2, '0');
            const SEQ = String(now.getTime()).slice(-4);
            const KARYAWAN = document.getElementById('karyawanSurat')?.value.trim() || '';
            let out = template.replace(/{YEAR}/g, YEAR)
                .replace(/{MONTH}/g, MONTH)
                .replace(/{DAY}/g, DAY)
                .replace(/{SEQ}/g, SEQ)
                .replace(/{KARYAWAN}/g, KARYAWAN);
            return out;
        }

        function renderNomorTemplateControls() {
            const ck = document.getElementById('useNomorTemplate');
            const ctr = document.getElementById('nomorTemplateControls');
            const input = document.getElementById('nomorTemplateInput');
            // load saved template if present
            const saved = localStorage.getItem('nomorTemplate');
            if (input && saved && !input.value) input.value = saved;
            if (ck && ctr) {
                if (ck.checked) ctr.classList.remove('hidden');
                else ctr.classList.add('hidden');
            }
        }

        // Dynamic 'Jenis Surat' fields rendering and template support
        function renderJenisFields(type, values = {}) {
            const container = document.getElementById('jenisFields');
            if (!container) return;
            let html = '';
            const v = (k) => (values && values[k] !== undefined ? values[k] : '');

            if (!type) {
                container.innerHTML = '<p class="text-sm text-gray-500">Pilih jenis surat untuk melihat field terkait.</p>';
                return;
            }

            switch (type) {
                case 'pkwt':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Mulai Kontrak</label>
                                        <input type="date" data-dyn="tanggal_mulai_kontrak" value="${v('tanggal_mulai_kontrak')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Berakhir Kontrak</label>
                                        <input type="date" data-dyn="tanggal_akhir_kontrak" value="${v('tanggal_akhir_kontrak')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Durasi Kontrak</label>
                                        <input type="text" data-dyn="durasi_kontrak" value="${v('durasi_kontrak')}" placeholder="Contoh: 1 tahun" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Gaji</label>
                                        <input type="number" data-dyn="gaji" value="${v('gaji')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Jam Kerja</label>
                                        <input type="text" data-dyn="jam_kerja" value="${v('jam_kerja')}" placeholder="Contoh: 09:00-17:00" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                </div>`;
                    break;
                case 'pkwtt':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Mulai Kerja</label>
                                        <input type="date" data-dyn="tanggal_mulai_kerja" value="${v('tanggal_mulai_kerja')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Status Karyawan Tetap</label>
                                        <select data-dyn="status_karyawan_tetap" class="w-full px-3 py-2 border rounded"><option value="">Pilih</option><option value="ya" ${v('status_karyawan_tetap')==='ya'?'selected':''}>Ya</option><option value="tidak" ${v('status_karyawan_tetap')==='tidak'?'selected':''}>Tidak</option></select>
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Gaji</label>
                                        <input type="number" data-dyn="gaji" value="${v('gaji')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Jam Kerja</label>
                                        <input type="text" data-dyn="jam_kerja" value="${v('jam_kerja')}" placeholder="Contoh: 09:00-17:00" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                </div>`;
                    break;
                case 'magang':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Asal Sekolah / Kampus</label>
                                        <input type="text" data-dyn="asal_sekolah" value="${v('asal_sekolah')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Periode Magang</label>
                                        <input type="text" data-dyn="periode_magang" value="${v('periode_magang')}" placeholder="Contoh: Jan 2026 - Mar 2026" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Posisi Magang</label>
                                        <input type="text" data-dyn="posisi_magang" value="${v('posisi_magang')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Pembimbing</label>
                                        <input type="text" data-dyn="pembimbing" value="${v('pembimbing')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                </div>`;
                    break;
                case 'jalan':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Tujuan</label>
                                        <input type="text" data-dyn="tujuan_jalan" value="${v('tujuan_jalan')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Berangkat</label>
                                        <input type="date" data-dyn="tanggal_berangkat" value="${v('tanggal_berangkat')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Kembali</label>
                                        <input type="date" data-dyn="tanggal_kembali" value="${v('tanggal_kembali')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Kendaraan</label>
                                        <input type="text" data-dyn="kendaraan" value="${v('kendaraan')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Keperluan</label>
                                        <input type="text" data-dyn="keperluan" value="${v('keperluan')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                </div>`;
                    break;
                case 'cuti':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Jenis Cuti</label>
                                        <input type="text" data-dyn="jenis_cuti" value="${v('jenis_cuti')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Mulai</label>
                                        <input type="date" data-dyn="tanggal_mulai_cuti" value="${v('tanggal_mulai_cuti')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Selesai</label>
                                        <input type="date" data-dyn="tanggal_selesai_cuti" value="${v('tanggal_selesai_cuti')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Total Hari</label>
                                        <input type="number" data-dyn="total_hari" value="${v('total_hari')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                </div>`;
                    break;
                case 'lembur':
                    html += `<div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-700">Tanggal Lembur</label>
                                        <input type="date" data-dyn="tanggal_lembur" value="${v('tanggal_lembur')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Jam Mulai</label>
                                        <input type="time" data-dyn="jam_mulai" value="${v('jam_mulai')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Jam Selesai</label>
                                        <input type="time" data-dyn="jam_selesai" value="${v('jam_selesai')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-700">Total Jam</label>
                                        <input type="number" data-dyn="total_jam" value="${v('total_jam')}" class="w-full px-3 py-2 border rounded" />
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-sm text-gray-700">Alasan Lembur</label>
                                        <textarea data-dyn="alasan_lembur" class="w-full px-3 py-2 border rounded">${v('alasan_lembur')}</textarea>
                                    </div>
                                </div>`;
                    break;
                default:
                    html += '<p class="text-sm text-gray-500">Tidak ada field khusus untuk jenis ini.</p>';
            }

            container.innerHTML = html;
        }

        function collectJenisData() {
            const container = document.getElementById('jenisFields');
            if (!container) return {};
            const out = {};
            container.querySelectorAll('[data-dyn]').forEach(el => {
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA' || el.tagName === 'SELECT') {
                    out[el.dataset.dyn] = el.value;
                }
            });
            return out;
        }

        function loadSuratTemplates() {
            try {
                const raw = localStorage.getItem('suratTemplates');
                return raw ? JSON.parse(raw) : [];
            } catch (e) {
                return [];
            }
        }

        function renderTemplateManager() {
            const ul = document.getElementById('suratTemplateList');
            if (!ul) return;
            const arr = loadSuratTemplates();
            ul.innerHTML = '';
            if (!arr.length) {
                ul.innerHTML = '<li class="text-sm text-gray-500">Belum ada template tersimpan.</li>';
                return;
            }
            arr.forEach((t, idx) => {
                const li = document.createElement('li');
                li.className = 'flex items-center justify-between bg-white p-2 rounded';
                li.innerHTML = `<div class="text-sm">${escapeHtml(t.name)} <span class="text-xs text-gray-400">(${t.jenis})</span></div>
                                    <div class="flex gap-2">
                                        <button data-idx="${idx}" class="applyTpl px-2 py-1 text-xs bg-red-50 text-red-700 rounded">Apply</button>
                                        <button data-idx="${idx}" class="editTpl px-2 py-1 text-xs bg-white border rounded">Edit</button>
                                        <button data-idx="${idx}" class="delTpl px-2 py-1 text-xs bg-red-50 text-red-700 rounded">Hapus</button>
                                    </div>`;
                ul.appendChild(li);
            });
            // attach events
            ul.querySelectorAll('.applyTpl').forEach(b => b.addEventListener('click', function() {
                const idx = parseInt(this.dataset.idx, 10);
                applySuratTemplate(idx);
            }));
            ul.querySelectorAll('.editTpl').forEach(b => b.addEventListener('click', function() {
                const idx = parseInt(this.dataset.idx, 10);
                editSuratTemplate(idx);
            }));
            ul.querySelectorAll('.delTpl').forEach(b => b.addEventListener('click', function() {
                const idx = parseInt(this.dataset.idx, 10);
                if (!confirm('Hapus template ini?')) return;
                deleteSuratTemplate(idx);
            }));
        }

        function editSuratTemplate(index) {
            // load and go to step-2 for editing
            applySuratTemplate(index);
            window.editingSuratTemplateIndex = index;
        }

        function deleteSuratTemplate(index) {
            const arr = loadSuratTemplates();
            if (index < 0 || index >= arr.length) return;
            arr.splice(index, 1);
            try {
                localStorage.setItem('suratTemplates', JSON.stringify(arr));
            } catch (e) {}
            // clear editing index if it referred to deleted item
            if (typeof window.editingSuratTemplateIndex === 'number') {
                if (window.editingSuratTemplateIndex === index) window.editingSuratTemplateIndex = null;
                else if (window.editingSuratTemplateIndex > index) window.editingSuratTemplateIndex--;
            }
            populateSuratTemplateSelect();
            renderTemplateManager();
        }

        function createNewTemplateForSelectedJenis() {
            const jenis = document.getElementById('jenisSurat')?.value || '';
            if (!jenis) return alert('Pilih jenis surat dulu sebelum membuat template baru.');
            const name = prompt('Nama template baru (contoh: PKWT - 1 Tahun):');
            if (!name) return;
            const arr = loadSuratTemplates();
            const tpl = {
                name: name,
                jenis: jenis,
                data: {
                    nomor: '',
                    tanggal: '',
                    karyawan: '',
                    jabatan: '',
                    departemen: '',
                    jenis_fields: {},
                    tujuan: '',
                    isi: ''
                }
            };
            arr.unshift(tpl);
            try {
                localStorage.setItem('suratTemplates', JSON.stringify(arr));
            } catch (e) {}
            populateSuratTemplateSelect();
            renderTemplateManager();
            // open the newly created template for editing
            editSuratTemplate(0);
        }

        function saveSuratTemplate(name, index = null) {
            const jenis = document.getElementById('jenisSurat')?.value || '';
            if (!jenis) return alert('Pilih jenis surat terlebih dahulu untuk menyimpan template.');
            // prefer CKEditor content and include per-section data if any
            let isiVal = '';
            try {
                isiVal = (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) ? CKEDITOR.instances
                    .isiSurat.getData() : document.getElementById('isiSurat')?.value || '';
            } catch (e) {
                isiVal = document.getElementById('isiSurat')?.value || '';
            }
            const sections = (typeof getSectionsData === 'function') ? getSectionsData() : [];

            const template = {
                name: name,
                jenis: jenis,
                data: {
                    nomor: document.getElementById('nomorSurat')?.value || '',
                    tanggal: document.getElementById('tanggalSurat')?.value || '',
                    karyawan: document.getElementById('karyawanSurat')?.value || '',
                    jabatan: document.getElementById('jabatanSurat')?.value || '',
                    departemen: document.getElementById('departemenSurat')?.value || '',
                    jenis_fields: collectJenisData(),
                    tujuan: document.getElementById('tujuanSurat')?.value || '',
                    isi: isiVal,
                    sections: sections
                }
            };
            const arr = loadSuratTemplates();
            if (index !== null && index >= 0 && index < arr.length) {
                // update
                arr[index] = template;
            } else {
                // create new (prepend)
                arr.unshift(template);
            }
            try {
                localStorage.setItem('suratTemplates', JSON.stringify(arr));
            } catch (e) {}
            populateSuratTemplateSelect();
            renderTemplateManager();
            window.editingSuratTemplateIndex = null;
            alert('Template tersimpan.');
        }

        function populateSuratTemplateSelect() {
            const sel = document.getElementById('suratTemplateSelect');
            if (!sel) return;
            sel.innerHTML = '<option value="">-- Pilih Template (opsional) --</option>';
            // first load server templates
            const statusEl = document.getElementById('templateLoadStatus');
            if (statusEl) statusEl.innerText = 'Memuat template...';
            fetch('/admin/template/list', {
                    credentials: 'same-origin'
                })
                .then(r => {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(resp => {
                    const list = resp.data || [];
                    // clear previous server options
                    // keep the default option
                    sel.querySelectorAll('option:not([value=""])').forEach(o => o.remove());
                    list.forEach(t => {
                        const opt = document.createElement('option');
                        opt.value = t.id; // use id to indicate server template
                        opt.text = `${t.name} (${t.jenis || ''})`;
                        sel.appendChild(opt);
                    });
                    // then append local templates for backward compatibility
                    const arr = loadSuratTemplates();
                    arr.forEach((t, idx) => {
                        const opt = document.createElement('option');
                        opt.value = 'local-' + idx;
                        opt.text = `${t.name} (${t.jenis})`;
                        sel.appendChild(opt);
                    });
                    if (statusEl) statusEl.innerText = `Memuat ${list.length} template dari server.`;
                    renderTemplateManager();
                }).catch(err => {
                    console.error('fetch templates error', err);
                    if (statusEl) statusEl.innerText = 'Gagal memuat template dari server. Menggunakan template lokal.';
                    // fallback to local only
                    const arr = loadSuratTemplates();
                    arr.forEach((t, idx) => {
                        const opt = document.createElement('option');
                        opt.value = idx;
                        opt.text = `${t.name} (${t.jenis})`;
                        sel.appendChild(opt);
                    });
                    renderTemplateManager();
                });
        }

        function applySuratTemplate(index) {
            const arr = loadSuratTemplates();
            const t = arr[index];
            if (!t) return;
            const d = t.data || {};
            if (d.nomor) document.getElementById('nomorSurat').value = d.nomor;
            if (d.tanggal) document.getElementById('tanggalSurat').value = d.tanggal;
            if (d.karyawan) document.getElementById('karyawanSurat').value = d.karyawan;
            if (d.jabatan) document.getElementById('jabatanSurat').value = d.jabatan;
            if (d.departemen) document.getElementById('departemenSurat').value = d.departemen;
            // set jenis select and render fields
            const jenisSel = document.getElementById('jenisSurat');
            if (jenisSel) jenisSel.value = t.jenis;
            renderJenisFields(t.jenis, d.jenis_fields || {});
            if (d.tujuan) document.getElementById('tujuanSurat').value = d.tujuan;
            if (d.isi) {
                // If template has flat isi, put into a single section editor
                // Create a temporary section view
                renderTemplateSections([{
                    title: 'Isi',
                    content: d.isi
                }], true);
            }

            // If template has schema.sections, render them
            if (t.schema && Array.isArray(t.schema)) {
                // Some templates store sections in schema (we expect objects with title and content)
                const sections = t.schema.filter(s => s.type && s.type === 'section').map(s => ({
                    title: s.key || s.label || 'Section',
                    content: s.content || ''
                }));
                if (sections.length) renderTemplateSections(sections);
            }

            // render schema-driven form fields for local templates (if any)
            const schemaForm = document.getElementById('templateDynamicForm');
            if (schemaForm) {
                schemaForm.innerHTML = '';
                const schema = t.schema || [];
                if (schema.length) {
                    let html = '<p class="text-sm font-medium text-gray-700">Form dari Template</p>';
                    schema.forEach(f => {
                        const key = f.key || '';
                        const label = f.label || key;
                        const type = f.type || 'text';
                        const required = f.required ? true : false;
                        const reqLabel = required ? ' <span class="text-red-600">*</span>' : '';
                        const reqAttr = required ? ' data-schema-required="1" required' : '';
                        html += '<div class="grid grid-cols-2 gap-2 items-center mt-2">' +
                            `<label class="text-sm text-gray-700">${label}${reqLabel}</label>`;
                        if (type === 'text') html +=
                            `<input type="text" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                        else if (type === 'textarea') html +=
                            `<textarea data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"></textarea>`;
                        else if (type === 'date') html +=
                            `<input type="date" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                        else if (type === 'select') {
                            const opts = (f.options || []).map(o => `<option value="${o}">${o}</option>`).join('');
                            html +=
                                `<select data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full">${opts}</select>`;
                        } else html +=
                            `<input type="text" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                        html += '</div>';
                    });
                    schemaForm.innerHTML = html;
                }
            }

            // show step-2 (informasi umum) so admin can review/edit before continuing
            document.getElementById('step-1')?.classList.add('hidden');
            document.getElementById('step-2')?.classList.remove('hidden');
        }

        function formatDate(dt) {
            return dt.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
        }

        function capitalize(s) {
            if (!s) return s;
            return s.charAt(0).toUpperCase() + s.slice(1);
        }

        function escapeHtml(unsafe) {
            return unsafe.replace(/[&<"']/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '"': '&quot;',
                    '\'': '&#39;'
                } [m]);
            });
        }

        // Render sections editor inside the modal. Accepts an array of {title, content}.
        function renderTemplateSections(sections = [], single = false) {
            console.log('renderTemplateSections called, sections:', (sections && sections.length) || 0, 'single:', single);
            const container = document.getElementById('sectionsEditor');
            if (!container) {
                console.warn('renderTemplateSections: #sectionsEditor not found');
                return;
            }
            // Cleanup existing section CKEditor instances
            try {
                Object.keys(CKEDITOR.instances || {}).forEach(k => {
                    if (k && k.indexOf('section_') === 0) {
                        try {
                            CKEDITOR.instances[k].destroy(true);
                        } catch (e) {
                            /* ignore */
                        }
                        try {
                            delete CKEDITOR.instances[k];
                        } catch (e) {}
                    }
                });
            } catch (e) {}

            // Normalize sections array
            window.currentSections = Array.isArray(sections) ? sections.map(s => ({
                title: s.title || '',
                content: s.content || ''
            })) : [];

            container.innerHTML = '';

            if (window.currentSections.length === 0 && !single) {
                container.innerHTML =
                    '<p class="text-xs text-gray-500 py-8 text-center">Belum ada section. Klik tombol "Tambah Section" untuk membuat section baru.</p>';
            }

            window.currentSections.forEach((s, idx) => {
                const wrap = document.createElement('div');
                wrap.className =
                    'bg-gradient-to-br from-red-50 to-gray-50 p-4 border-l-4 border-red-500 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-move';
                wrap.setAttribute('data-section-index', idx);
                wrap.setAttribute('draggable', 'true');

                const header = document.createElement('div');
                header.className = 'flex items-center gap-3 mb-3';
                header.innerHTML = `
                        <div class="text-xl cursor-grab active:cursor-grabbing text-gray-400 hover:text-gray-600" title="Drag untuk reorder">⋮⋮</div>
                        <span class="px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded">Section ${idx + 1}</span>
                        <input type="text" class="section-title flex-1 px-3 py-1 border border-gray-300 rounded text-sm font-medium" placeholder="Judul section (misal: Isi Surat, Penutup, dll)" value="${escapeHtml(s.title)}" />
                        <button type="button" class="text-red-500 hover:text-red-700 hover:bg-red-50 px-3 py-1 rounded transition" onclick="removeSection(${idx})" title="Hapus section ini">✕</button>
                    `;
                wrap.appendChild(header);

                const editorWrap = document.createElement('div');
                editorWrap.className = 'bg-white rounded border border-gray-200 p-2';
                const textarea = document.createElement('textarea');
                textarea.id = 'section_' + idx;
                textarea.className = 'w-full';
                textarea.value = s.content || '';
                editorWrap.appendChild(textarea);
                wrap.appendChild(editorWrap);

                container.appendChild(wrap);

                // Add drag event listeners
                wrap.addEventListener('dragstart', (e) => {
                    e.dataTransfer.effectAllowed = 'move';
                    e.dataTransfer.setData('text/html', wrap.innerHTML);
                    wrap.style.opacity = '0.5';
                    wrap.classList.add('dragging');
                });
                wrap.addEventListener('dragend', (e) => {
                    wrap.style.opacity = '1';
                    wrap.classList.remove('dragging');
                });
            });

            // Initialize CKEditor for each textarea
            window.currentSections.forEach((_, idx) => {
                try {
                    CKEDITOR.replace('section_' + idx, {
                        height: 150,
                        toolbar: [{
                                name: 'basicstyles',
                                items: ['Bold', 'Italic', 'Underline']
                            },
                            {
                                name: 'paragraph',
                                items: ['BulletedList', 'NumberedList', '-', 'Outdent', 'Indent']
                            },
                            {
                                name: 'links',
                                items: ['Link', 'Unlink']
                            },
                        ]
                    });
                } catch (e) {
                    console.error('init section editor', e);
                }
            });
        }

        function removeSection(idx) {
            if (!window.currentSections) return;
            window.currentSections.splice(idx, 1);
            renderTemplateSections(window.currentSections);
        }

        // ========== DYNAMIC ADDITIONAL FIELDS ==========
        function addAdditionalField(label = '', value = '', fieldId = null) {
            const container = document.getElementById('additionalFields');
            const uniqueId = fieldId || 'field_' + Date.now();

            const fieldDiv = document.createElement('div');
            fieldDiv.id = uniqueId;
            fieldDiv.className = 'p-4 bg-gray-50/60 border border-gray-200/50 rounded-2xl shadow-sm';
            fieldDiv.innerHTML = `
                    <div class="flex gap-3 mb-3">
                        <input type="text" placeholder="Label (misal: Lokasi Kerja, Nama Proyek)" value="${label}" 
                               onchange="updateFormPreview()" 
                               class="flex-1 px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors" 
                               data-field-label="${uniqueId}" />
                        <button type="button" onclick="removeAdditionalField('${uniqueId}')" 
                                class="px-3 py-2 bg-red-400/60 text-white rounded-2xl text-sm hover:bg-red-400/80 transition-colors">✕ Hapus</button>
                    </div>
                    <textarea placeholder="Nilai/Isi field" onchange="updateFormPreview()" 
                              class="w-full px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors" 
                              rows="2" 
                              data-field-value="${uniqueId}">${value}</textarea>
                `;
            container.appendChild(fieldDiv);
            updateFormPreview();
        }

        function removeAdditionalField(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                field.remove();
                updateFormPreview();
            }
        }

        function getAdditionalFields() {
            const container = document.getElementById('additionalFields');
            const fields = {};
            if (!container) return fields;

            container.querySelectorAll('div[id^="field_"]').forEach(fieldDiv => {
                const labelInput = fieldDiv.querySelector('[data-field-label]');
                const valueInput = fieldDiv.querySelector('[data-field-value]');
                const label = labelInput?.value?.trim() || '';
                const value = valueInput?.value?.trim() || '';
                if (label) fields[label] = value;
            });
            return fields;
        }

        // ========== SECTION-BASED CONTENT EDITOR ==========
        function getSectionsData() {
            const out = [];
            document.querySelectorAll('#sectionsEditor [data-section-index]').forEach(s => {
                const idx = s.dataset.sectionIndex;
                let content = '';
                try {
                    if (CKEDITOR.instances['section_' + idx]) {
                        content = CKEDITOR.instances['section_' + idx].getData();
                    }
                } catch (e) {
                    content = s.querySelector('textarea')?.value || '';
                }
                const title = s.querySelector('.section-title')?.value || '';
                out.push({
                    title: title,
                    content: content
                });
            });
            return out;
        }

        // ========== DYNAMIC ADDITIONAL FIELDS ==========
        function addAdditionalField(label = '', value = '', fieldId = null) {
            const kopSel = document.getElementById('kopSuratSelect');
            const kopOpt = kopSel?.selectedOptions?.[0];
            const kopUrl = kopOpt?.dataset?.url || null;
            const nomor = document.getElementById('nomorSurat')?.value || '';
            const tanggal = document.getElementById('tanggalSurat')?.value || '';
            const karyawan = document.getElementById('karyawanSurat')?.value || '';
            const jabatan = document.getElementById('jabatanSurat')?.value || '';
            const departemen = document.getElementById('departemenSurat')?.value || '';
            const tujuan = document.getElementById('tujuanSurat')?.value || '';

            // assemble isi from sections
            let assembled = '';
            const sects = document.querySelectorAll('#sectionsEditor [data-section-index]');
            if (sects.length) {
                sects.forEach(s => {
                    const idx = s.dataset.sectionIndex;
                    let c = '';
                    try {
                        if (CKEDITOR.instances['section_' + idx]) {
                            c = CKEDITOR.instances['section_' + idx].getData();
                        }
                    } catch (e) {
                        c = s.querySelector('textarea')?.value || '';
                    }
                    const title = s.querySelector('.section-title')?.value || '';
                    if (title) assembled += `<h3>${escapeHtml(title)}</h3>`;
                    assembled += c + '<br/>';
                });
            } else {
                if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) assembled = CKEDITOR.instances
                    .isiSurat.getData();
                else assembled = document.getElementById('isiSurat')?.value || '';
            }

            const html = `
                <html>
                <head>
                <title>Pratayang Surat</title>
                <meta charset="utf-8">
                <style>body{font-family: Arial, Helvetica, sans-serif; padding:40px; color:#111} .kop{ text-align:center; margin-bottom:20px } .nomor{margin-top:10px;margin-bottom:10px} .content{margin-top:20px} .ttd{margin-top:60px;text-align:right} h3{margin:10px 0 6px}</style>
                </head>
                <body>
                    <div class="kop">
                        ${kopUrl ? `<img src="${kopUrl}" alt="kop" style="max-height:120px; object-fit:contain;" />` : `<div style="font-weight:bold; font-size:18px">Kop Surat Perusahaan</div>`}
                        <div class="nomor">Nomor: <strong>${escapeHtml(nomor)}</strong> &nbsp; &nbsp; Tanggal: ${escapeHtml(tanggal)}</div>
                        <div>Perihal: <strong>${escapeHtml(tujuan)}</strong></div>
                    </div>
                    <div>
                        <p>Kepada Yth.,</p>
                        <p><strong>${escapeHtml(karyawan)}</strong> &nbsp; ${escapeHtml(jabatan)} ${escapeHtml(departemen)}</p>
                    </div>
                    <div class="content">${assembled}</div>
                    <div class="ttd">Hormat kami,<br><br><br>__________________<br>Admin HRD</div>
                </body>
                </html>`;

            const w = window.open('', '_blank');
            w.document.open();
            w.document.write(html);
            w.document.close();

            // also update preview box in modal
            const previewBox = document.getElementById('suratPreview');
            if (previewBox) previewBox.innerHTML = assembled;
        }

        // Generate PDF on server from current fields, returns URL to generated PDF
        function generatePdf() {
            const nomor = document.getElementById('nomorSurat')?.value || '';
            const tanggal = document.getElementById('tanggalSurat')?.value || '';
            const jenis = document.getElementById('jenisSurat')?.value || '';
            const karyawan = document.getElementById('karyawanSurat')?.value || '';
            const tujuan = document.getElementById('tujuanSurat')?.value || '';
            const kopId = document.getElementById('kopSuratSelect')?.value || null;
            let isi = '';
            if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) {
                isi = CKEDITOR.instances.isiSurat.getData();
            } else {
                isi = document.getElementById('isiSurat')?.value || '';
            }

            // collect sections if any and build final isi to send to server
            const sections = getSectionsData();
            let finalIsi = isi;
            if (sections && sections.length) {
                finalIsi = sections.map(s => {
                    const title = s.title ? `<h3>${escapeHtml(s.title)}</h3>` : '';
                    const content = s.content || '';
                    return title + content + '<br/>';
                }).join('');
            }

            const payload = {
                nomor,
                tanggal,
                jenis,
                karyawan,
                tujuan,
                isi: finalIsi,
                sections: sections,
                kop_surat_id: kopId,
                jabatan: document.getElementById('jabatanSurat')?.value || '',
                departemen: document.getElementById('departemenSurat')?.value || '',
                placeholders: {}
            };
            // collect placeholders
            document.querySelectorAll('#kopTemplateFields [data-ph]').forEach(i => {
                payload.placeholders[i.dataset.ph] = i.value || '';
            });
            document.querySelectorAll('#suratTemplateFields [data-tplph]').forEach(i => {
                payload.placeholders[i.dataset.tplph] = i.value || '';
            });
            // collect schema-driven form values
            document.querySelectorAll('#templateDynamicForm [data-schema-key]').forEach(i => {
                const k = i.dataset.schemaKey;
                let v = '';
                if (i.tagName === 'INPUT' || i.tagName === 'SELECT' || i.tagName === 'TEXTAREA') v = i.value || '';
                payload.placeholders[k.toUpperCase()] = v;
            });
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const btn = document.getElementById('generatePdfBtn');
            if (btn) btn.disabled = true;

            fetch('/admin/surat/preview-pdf', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(payload),
                    credentials: 'same-origin'
                }).then(r => r.json())
                .then(data => {
                    if (data && data.ok && data.url) {
                        window.open(data.url, '_blank');
                    } else {
                        alert('Gagal membuat PDF preview.');
                        console.error('generatePdf response', data);
                    }
                }).catch(err => {
                    console.error('generatePdf error', err);
                    alert('Gagal membuat PDF preview. Periksa console.');
                }).finally(() => {
                    if (btn) btn.disabled = false;
                });
        }

        // Kop Surat (AJAX): fetch list and upload
        function fetchKopList() {
            fetch('/admin/kop-surat', {
                    credentials: 'same-origin'
                })
                .then(res => res.json())
                .then(list => {
                    const sel = document.getElementById('kopSuratSelect');
                    if (!sel) return;
                    // clear options except default
                    sel.innerHTML = '<option value="">-- Pilih Kop Surat (Default) --</option>';
                    list.forEach(item => {
                        const opt = document.createElement('option');
                        opt.value = item.id;
                        opt.text = item.name;
                        opt.dataset.url = item.url || '';
                        opt.dataset.isTemplate = item.is_template ? '1' : '0';
                        if (item.placeholders) {
                            opt.dataset.placeholders = JSON.stringify(item.placeholders);
                        }
                        sel.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error('fetchKopList error', err);
                });
        }

        function updateKopPreview() {
            const sel = document.getElementById('kopSuratSelect');
            const preview = document.getElementById('kopPreview');
            if (!sel || !preview) return;
            const opt = sel.selectedOptions && sel.selectedOptions[0];
            if (!opt || !opt.dataset.url) {
                preview.innerHTML = 'Tidak ada kop dipilih.';
                updateFormPreview();
                return;
            }
            const url = opt.dataset.url;
            const fileName = url.split('/').pop();
            const fileExt = fileName.split('.').pop().toLowerCase();

            // Display based on file type
            if (['pdf'].includes(fileExt)) {
                // PDF
                preview.innerHTML =
                    `<a href="${url}" target="_blank" class="inline-flex items-center gap-2 text-red-600 underline hover:text-red-700"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/></svg>Lihat kop (PDF)</a>`;
            } else if (['doc', 'docx', 'odt', 'txt'].includes(fileExt)) {
                // Document
                preview.innerHTML =
                    `<div class="inline-flex items-center gap-2 text-blue-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/></svg><span>${fileName}</span></div>`;
            } else if (['xls', 'xlsx', 'ods'].includes(fileExt)) {
                // Spreadsheet
                preview.innerHTML =
                    `<div class="inline-flex items-center gap-2 text-green-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/></svg><span>${fileName}</span></div>`;
            } else if (['ppt', 'pptx', 'odp'].includes(fileExt)) {
                // Presentation
                preview.innerHTML =
                    `<div class="inline-flex items-center gap-2 text-orange-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/></svg><span>${fileName}</span></div>`;
            } else if (['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'tiff'].includes(fileExt)) {
                // Image
                preview.innerHTML = `<img src="${url}" alt="kop" class="h-24 object-contain border rounded"/>`;
            } else {
                // Unknown file type
                preview.innerHTML =
                    `<div class="inline-flex items-center gap-2 text-gray-600"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/></svg><span>${fileName}</span></div>`;
            }

            // Update main preview immediately when kop is selected
            updateFormPreview();

            // if template, load placeholders
            const fields = document.getElementById('kopTemplateFields');
            if (opt && opt.dataset && opt.dataset.isTemplate === '1') {
                // populate template fields if placeholders present
                const ph = opt.dataset.placeholders ? JSON.parse(opt.dataset.placeholders) : [];
                if (fields) {
                    if (!ph.length) {
                        fields.innerHTML = '';
                    } else {
                        let html = '<p class="text-sm font-medium text-gray-700">Template Fields</p>';
                        ph.forEach(name => {
                            html += '<div class="grid grid-cols-2 gap-2 items-center">' +
                                '<label class="text-sm text-gray-700">' + name + '</label>' +
                                '<input type="text" data-ph="' + name +
                                '" class="px-3 py-2 border rounded w-full"/>' +
                                '</div>';
                        });
                        fields.innerHTML = html;
                    }
                }
            } else {
                if (fields) fields.innerHTML = '';
            }
        }

        function loadKopPlaceholders(kopId) {
            const fields = document.getElementById('kopTemplateFields');
            if (!kopId) {
                if (fields) fields.innerHTML = '';
                return;
            }
            fetch(`/admin/kop-surat/${kopId}/placeholders`, {
                    credentials: 'same-origin'
                })
                .then(r => r.json())
                .then(data => {
                    const ph = data.placeholders || [];
                    if (!fields) return;
                    if (!ph.length) {
                        fields.innerHTML = '';
                        return;
                    }
                    let html = '<p class="text-sm font-medium text-gray-700">Template Fields</p>';
                    ph.forEach(name => {
                        html += '<div class="grid grid-cols-2 gap-2 items-center">' +
                            '<label class="text-sm text-gray-700">' + name + '</label>' +
                            '<input type="text" data-ph="' + name +
                            '" class="px-3 py-2 border rounded w-full"/>' +
                            '</div>';
                    });
                    fields.innerHTML = html;
                })
                .catch(err => console.error('loadKopPlaceholders', err));
        }

        // Client-side filtering for request and published tables
        function cardFilter(targetTab, status, el) {
            // Toggle visual active on cards
            const isActive = el.classList.contains('ring-2');
            document.querySelectorAll('.stats-card').forEach(c => {
                c.classList.remove('ring-2', 'ring-offset-2', 'ring-red-200');
                c.setAttribute('aria-pressed', 'false');
            });
            if (!isActive) {
                el.classList.add('ring-2', 'ring-offset-2', 'ring-red-200');
                el.setAttribute('aria-pressed', 'true');
            }

            switchTab(targetTab);

            // Apply appropriate filter
            if (targetTab === 'permintaan') {
                // if toggled off, pass null to clear status filter
                filterRequests(null, null, null, isActive ? null : status);
            } else {
                filterPublished(null, null, null, isActive ? null : status);
            }
        }

        function filterRequests(search, type, date, status) {
            const tbody = document.querySelector('#content-permintaan table tbody');
            if (!tbody) return;
            const rows = tbody.querySelectorAll('tr');
            const q = (search ?? document.getElementById('search_employee').value).toLowerCase().trim();
            const t = (type ?? document.getElementById('filter_type').value).toLowerCase();
            const d = (date ?? document.getElementById('filter_date').value);
            const s = status ?? null;
            rows.forEach(row => {
                const name = (row.querySelector('td:nth-child(1) .text-sm')?.innerText ?? '').toLowerCase();
                const jenis = (row.querySelector('td:nth-child(2)')?.innerText ?? '').toLowerCase();
                const keperluan = (row.querySelector('td:nth-child(3) .text-sm')?.innerText ?? '').toLowerCase();
                const tanggal = (row.querySelector('td:nth-child(4)')?.innerText ?? '').toLowerCase();
                const statusText = (row.querySelector('td:nth-child(5)')?.innerText ?? '').trim();
                let visible = true;
                if (q) visible = (name.indexOf(q) !== -1) || (keperluan.indexOf(q) !== -1);
                if (t && visible) visible = jenis.indexOf(t) !== -1;
                if (d && visible) visible = tanggal.indexOf(d) !== -1;
                if (s && visible) visible = statusText.indexOf(s) === -1 ? false : true;
                row.style.display = visible ? '' : 'none';
            });
        }

        function filterPublished(search, type, date, status) {
            const tbody = document.querySelector('#content-daftar table tbody');
            if (!tbody) return;
            const rows = tbody.querySelectorAll('tr');
            const q = (search ?? document.getElementById('search_surat').value).toLowerCase().trim();
            const t = (type ?? document.getElementById('filter_type_publish').value).toLowerCase();
            const d = (date ?? document.getElementById('filter_date_publish').value);
            const s = status ?? null;
            rows.forEach(row => {
                const nomor = (row.querySelector('td:nth-child(1)')?.innerText ?? '').toLowerCase();
                const jenis = (row.querySelector('td:nth-child(2)')?.innerText ?? '').toLowerCase();
                const karyawan = (row.querySelector('td:nth-child(3)')?.innerText ?? '').toLowerCase();
                const tanggal = (row.querySelector('td:nth-child(4)')?.innerText ?? '').toLowerCase();
                const statusText = (row.querySelector('td:nth-child(5)')?.innerText ?? '').trim();
                let visible = true;
                if (q) visible = (nomor.indexOf(q) !== -1) || (karyawan.indexOf(q) !== -1);
                if (t && visible) visible = jenis.indexOf(t) !== -1;
                if (d && visible) visible = tanggal.indexOf(d) !== -1;
                if (s && visible) visible = statusText.indexOf(s) === -1 ? false : true;
                row.style.display = visible ? '' : 'none';
            });
        }

        // Close modal when clicking outside or pressing Escape
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize CKEditor for isiSurat (WYSIWYG)
            if (window.CKEDITOR && CKEDITOR.replace) {
                try {
                    if (CKEDITOR.instances.isiSurat) CKEDITOR.instances.isiSurat.destroy(true);
                    CKEDITOR.replace('isiSurat', {
                        height: 220
                    });
                } catch (e) {
                    console.warn('CKEditor init failed', e);
                }
            } else {
                console.warn('CKEditor not found on page');
            }

            // Ensure Add Section button works even if inserted from server-side or inserted earlier
            const addSectionBtn = document.getElementById('addSectionBtn');
            if (addSectionBtn) {
                addSectionBtn.addEventListener('click', function() {
                    if (!window.currentSections) window.currentSections = [];
                    window.currentSections.push({
                        title: '',
                        content: ''
                    });
                    renderTemplateSections(window.currentSections);
                });
            }
            const modal = document.getElementById('modalSurat');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) closeModalSurat();
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') closeModalSurat();
            });

            // Attach filter events
            const searchEmp = document.getElementById('search_employee');
            if (searchEmp) searchEmp.addEventListener('input', () => filterRequests());
            const filterType = document.getElementById('filter_type');
            if (filterType) filterType.addEventListener('change', () => filterRequests());
            const filterDate = document.getElementById('filter_date');
            if (filterDate) filterDate.addEventListener('change', () => filterRequests());

            const searchSur = document.getElementById('search_surat');
            if (searchSur) searchSur.addEventListener('input', () => filterPublished());
            const filterTypePub = document.getElementById('filter_type_publish');
            if (filterTypePub) filterTypePub.addEventListener('change', () => filterPublished());
            const filterDatePub = document.getElementById('filter_date_publish');
            if (filterDatePub) filterDatePub.addEventListener('change', () => filterPublished());

            // Kop surat: upload and select
            const kopInput = document.getElementById('kopUploadInput');
            if (kopInput) kopInput.addEventListener('change', uploadKop);
            const kopSelect = document.getElementById('kopSuratSelect');
            if (kopSelect) kopSelect.addEventListener('change', () => {
                updateKopPreview();
                loadKopPlaceholders(kopSelect.value);
            });
            // Nomor template controls
            const useNomorTemplate = document.getElementById('useNomorTemplate');
            const nomorTplInput = document.getElementById('nomorTemplateInput');
            const nomorTplPreviewBtn = document.getElementById('nomorTemplatePreviewBtn');
            const nomorTplApplyBtn = document.getElementById('nomorTemplateApplyBtn');
            if (useNomorTemplate) useNomorTemplate.addEventListener('change', renderNomorTemplateControls);
            if (nomorTplPreviewBtn) nomorTplPreviewBtn.addEventListener('click', () => {
                const tpl = nomorTplInput ? nomorTplInput.value.trim() : '';
                const preview = document.getElementById('nomorTemplatePreview');
                if (!tpl) {
                    if (preview) preview.innerText = 'Template kosong';
                    return;
                }
                if (preview) preview.innerText = generateNomorFromTemplate(tpl);
            });
            if (nomorTplApplyBtn) nomorTplApplyBtn.addEventListener('click', () => {
                const tpl = nomorTplInput ? nomorTplInput.value.trim() : '';
                if (!tpl) {
                    alert('Template kosong');
                    return;
                }
                const gen = generateNomorFromTemplate(tpl);
                const nomorEl = document.getElementById('nomorSurat');
                if (nomorEl) nomorEl.value = gen;
                // persist template
                try {
                    localStorage.setItem('nomorTemplate', tpl);
                } catch (e) {}
            });
            // initialize template UI state
            renderNomorTemplateControls();

            // Initial load
            fetchKopList();
            updateKopPreview();

            // Load and manage pending surats (created automatically when direktur approves cuti/lembur)
            async function loadPendingSurats() {
                try {
                    const res = await fetch('/admin/surat/pending/list', {
                        credentials: 'same-origin'
                    });
                    const data = await res.json();
                    const tbody = document.getElementById('pendingSuratTableBody');
                    if (!tbody) return;
                    tbody.innerHTML = '';
                    if (data && data.ok && Array.isArray(data.list) && data.list.length) {
                        for (const s of data.list) {
                            const tr = document.createElement('tr');
                            tr.className = 'hover:bg-gray-50';
                            const nomor = s.nomor_surat || '-';
                            const perihal = s.perihal || '-';
                            const tanggal = new Date(s.created_at).toLocaleDateString();
                            const karyawan = s.user_name || s.user_id || '';

                            // Link ke pengajuan cuti jika ada
                            let cutiLink = '';
                            if (s.referensi_type && s.referensi_type.includes('Cuti') && s.referensi_id) {
                                cutiLink =
                                    `<a href="/admin/cuti" class="ml-2 text-blue-600 hover:text-blue-800 text-xs" title="Lihat Pengajuan Cuti #${s.referensi_id}">📋 Cuti #${s.referensi_id}</a>`;
                            }

                            tr.innerHTML = `
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-medium text-gray-900">${escapeHtml(nomor)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${escapeHtml(perihal)}${cutiLink}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">${escapeHtml(karyawan)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${escapeHtml(tanggal)}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <button class="inline-flex items-center px-3 py-1.5 mr-2 bg-white border rounded text-sm" onclick="previewSurat(${s.id})">Preview</button>
                                    <button class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded text-sm" onclick="openSendModal(${s.id})">Kirim</button>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        }
                    } else {
                        tbody.innerHTML =
                            '<tr><td colspan="5" class="px-6 py-4 text-sm text-gray-500">Tidak ada surat menunggu pengiriman.</td></tr>';
                    }
                } catch (e) {
                    console.error('loadPendingSurats error', e);
                }
            }

            window.previewSurat = async function(id) {
                try {
                    const r = await fetch(`/admin/surat/${id}`, {
                        credentials: 'same-origin'
                    });
                    if (r.ok) {
                        const json = await r.json();
                        const w = window.open('', '_blank');
                        w.document.write('<html><head><title>Preview Surat</title></head><body>' + (json
                            .surat?.isi_surat || '') + '</body></html>');
                        return;
                    }
                } catch (e) {
                    console.error('previewSurat', e);
                }
                alert('Gagal memuat preview.');
            };

            window.openSendModal = async function(id) {
                try {
                    const r = await fetch(`/admin/surat/${id}`, {
                        credentials: 'same-origin'
                    });
                    let isi = '';
                    if (r.ok) {
                        const json = await r.json();
                        isi = json.surat?.isi_surat || '';
                    }
                    let modal = document.getElementById('modalSendSurat');
                    if (!modal) {
                        modal = document.createElement('div');
                        modal.id = 'modalSendSurat';
                        modal.className =
                            'fixed inset-0 z-50 bg-black/40 flex items-center justify-center hidden';
                        modal.innerHTML = `
                            <div class="bg-white rounded-2xl w-11/12 max-w-2xl p-6">
                                <h3 class="text-lg font-medium mb-3">Kirim Surat</h3>
                                <textarea id="modalSendIsi" rows="12" class="w-full px-3 py-2 border rounded mb-4 text-sm">${isi}</textarea>
                                <div class="flex justify-end gap-3">
                                    <button onclick="closeSendModal()" class="px-4 py-2 rounded bg-gray-200">Batal</button>
                                    <button onclick="sendSurat(${id})" class="px-4 py-2 rounded bg-green-600 text-white">Kirim</button>
                                </div>
                            </div>`;
                        document.body.appendChild(modal);
                    } else {
                        document.getElementById('modalSendIsi').value = isi;
                        modal.classList.remove('hidden');
                    }
                    modal.classList.remove('hidden');
                    document.body.classList.add('modal-open');
                } catch (e) {
                    console.error('openSendModal', e);
                    alert('Gagal membuka modal kirim.');
                }
            };

            window.closeSendModal = function() {
                const modal = document.getElementById('modalSendSurat');
                if (modal) modal.classList.add('hidden');
                document.body.classList.remove('modal-open');
            };

            window.sendSurat = async function(id) {
                const isi = document.getElementById('modalSendIsi')?.value || '';
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                try {
                    const res = await fetch(`/admin/surat/${id}/kirim`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            isi
                        })
                    });
                    const data = await res.json();
                    if (data && data.ok) {
                        alert('Surat berhasil dikirim.');
                        closeSendModal();
                        await loadPendingSurats();
                    } else {
                        alert('Gagal mengirim surat.');
                        console.error('sendSurat', data);
                    }
                } catch (e) {
                    console.error('sendSurat error', e);
                    alert('Gagal mengirim surat.');
                }
            };

            // load pending on page ready
            setTimeout(() => {
                try {
                    loadPendingSurats();
                } catch (e) {}
            }, 400);

            // Single-page form - no step navigation needed, just render jenis fields when changed
            const jenisSelect = document.getElementById('jenisSurat');
            const suratTemplateSelect = document.getElementById('suratTemplateSelect');
            const saveAsTemplateBtn = document.getElementById('saveAsTemplateBtn');
            const saveTemplateConfirm = document.getElementById('saveTemplateConfirm');

            if (jenisSelect) jenisSelect.addEventListener('change', function() {
                renderJenisFields(this.value);
            });

            // Template select and save
            // Load templates from server
            populateSuratTemplateSelect();
            if (suratTemplateSelect) suratTemplateSelect.addEventListener('change', function() {
                const val = this.value;
                if (val === '') return;
                // value is template id (when loaded from server) or local index
                if (String(val).match(/^\d+$/)) {
                    fetch(`/admin/template/${val}`, {
                            credentials: 'same-origin'
                        })
                        .then(r => r.json()).then(resp => {
                            const t = resp.data;
                            // apply server-side template
                            document.getElementById('nomorSurat').value = t.slug || '';
                            if (t.jenis) document.getElementById('jenisSurat').value = t.jenis;
                            document.getElementById('karyawanSurat').value = '';
                            // set WYSIWYG content
                            if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat)
                                CKEDITOR.instances.isiSurat.setData(t.content || '');
                            renderJenisFields(t.jenis || '');
                            // render placeholders area
                            const fields = document.getElementById('suratTemplateFields');
                            if (fields) {
                                fields.innerHTML = '';
                                const ph = t.placeholders || [];
                                if (ph.length) {
                                    let html =
                                        '<p class="text-sm font-medium text-gray-700">Fields dari Template</p>';
                                    ph.forEach(name => {
                                        html +=
                                            '<div class="grid grid-cols-2 gap-2 items-center mt-2">' +
                                            '<label class="text-sm text-gray-700">' + name +
                                            '</label>' +
                                            '<input type="text" data-tplph="' + name +
                                            '" class="px-3 py-2 border rounded w-full"/>' +
                                            '</div>';
                                    });
                                    fields.innerHTML = html;
                                }
                            }

                            // render sections if present in the template schema (type 'section'), otherwise fall back to single content
                            try {
                                const sectionsFromSchema = (t.schema || []).filter(s => s.type ===
                                    'section').map(s => ({
                                    title: s.key || s.label || 'Isi',
                                    content: s.content || ''
                                }));
                                if (sectionsFromSchema.length) {
                                    renderTemplateSections(sectionsFromSchema);
                                } else if (t.content) {
                                    renderTemplateSections([{
                                        title: 'Isi',
                                        content: t.content
                                    }], true);
                                } else {
                                    // clear any existing sections
                                    renderTemplateSections([]);
                                }
                            } catch (e) {
                                console.error('render sections', e);
                            }

                            // render schema-driven form fields (if any)
                            const schemaForm = document.getElementById('templateDynamicForm');
                            if (schemaForm) {
                                schemaForm.innerHTML = '';
                                const schema = t.schema || [];
                                if (schema.length) {
                                    let html =
                                        '<p class="text-sm font-medium text-gray-700">Form dari Template</p>';
                                    schema.forEach(f => {
                                        const key = f.key || '';
                                        const label = f.label || key;
                                        const type = f.type || 'text';
                                        const required = f.required ? true : false;
                                        const reqLabel = required ?
                                            ' <span class="text-red-600">*</span>' : '';
                                        const reqAttr = required ?
                                            ' data-schema-required="1" required' : '';
                                        html +=
                                            '<div class="grid grid-cols-2 gap-2 items-center mt-2">' +
                                            `<label class="text-sm text-gray-700">${label}${reqLabel}</label>`;
                                        if (type === 'text') html +=
                                            `<input type="text" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                                        else if (type === 'textarea') html +=
                                            `<textarea data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"></textarea>`;
                                        else if (type === 'date') html +=
                                            `<input type="date" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                                        else if (type === 'select') {
                                            const opts = (f.options || []).map(o =>
                                                `<option value="${o}">${o}</option>`).join(
                                                '');
                                            html +=
                                                `<select data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full">${opts}</select>`;
                                        } else html +=
                                            `<input type="text" data-schema-key="${key}"${reqAttr} class="px-3 py-2 border rounded w-full"/>`;
                                        html += '</div>';
                                    });
                                    schemaForm.innerHTML = html;
                                }
                            }

                            // clear any ad-hoc informasi fields added earlier (we load template as source-of-truth)
                            try {
                                window.adHocInformasiFields = [];
                                if (window.renderInformasiCustomFields) window
                                    .renderInformasiCustomFields();
                            } catch (e) {}
                        }).catch(err => {
                            console.error('apply template', err);
                        });
                } else if (String(val).startsWith('local-')) {
                    const idx = parseInt(val.split('-')[1], 10);
                    if (!isNaN(idx)) applySuratTemplate(idx);
                } else {
                    const idx = parseInt(val, 10);
                    if (!isNaN(idx)) applySuratTemplate(idx);
                }
            });

            // Add server-side 'Save as Template' support
            if (saveTemplateConfirm) saveTemplateConfirm.addEventListener('click', function() {
                const name = prompt('Nama template yang ingin disimpan:');
                if (!name) return;
                const payload = {
                    name: name,
                    jenis: document.getElementById('jenisSurat')?.value || '',
                    content: (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) ?
                        CKEDITOR.instances.isiSurat.getData() : document.getElementById('isiSurat')
                        ?.value || ''
                };
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch('/admin/template', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify(payload),
                    credentials: 'same-origin'
                }).then(r => r.json()).then(() => {
                    alert('Template disimpan di server');
                    populateSuratTemplateSelect();
                }).catch(e => {
                    console.error('save tpl', e);
                    alert('Gagal menyimpan template');
                });
            });
            if (saveAsTemplateBtn) saveAsTemplateBtn.addEventListener('click', function() {
                const name = prompt('Nama template yang ingin disimpan (contoh: PKWT - 1 Tahun):');
                if (!name) return;
                saveSuratTemplate(name);
            });
            if (saveTemplateConfirm) saveTemplateConfirm.addEventListener('click', function() {
                const name = prompt('Nama template yang ingin disimpan:');
                if (!name) return;
                // if editing existing, update that index
                const idx = window.editingSuratTemplateIndex;
                saveSuratTemplate(name, (typeof idx === 'number' ? idx : null));
            });

            const openTemplateManagerBtn = document.getElementById('openTemplateManager');
            const templateManager = document.getElementById('templateManager');
            const createTemplateBtn = document.getElementById('createTemplateBtn');
            const refreshTemplatesBtn = document.getElementById('refreshTemplatesBtn');
            if (openTemplateManagerBtn && templateManager) openTemplateManagerBtn.addEventListener('click',
                function() {
                    templateManager.classList.toggle('hidden');
                });
            if (createTemplateBtn) createTemplateBtn.addEventListener('click', function() {
                openTemplateModalFromSurat();
            });

            // Open the Add Template modal prefilled with current Surat modal values (jenis, content, fields)
            function openTemplateModalFromSurat() {
                const jenis = document.getElementById('jenisSurat')?.value || '';
                if (!jenis) return alert('Pilih jenis surat dahulu sebelum membuat template.');
                // open add modal
                openTambahTemplateModal();
                const modal = document.getElementById('tambahTemplateModal');
                // prefill name
                modal.querySelector('input[placeholder="Nama template"]').value =
                    `${jenis} - Template ${new Date().toISOString().slice(0,10)}`;
                // set jenis select in modal
                modal.querySelector('select').value = jenis;

                // set content from main CKEditor
                let content = '';
                try {
                    if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.isiSurat) content = CKEDITOR
                        .instances.isiSurat.getData();
                } catch (e) {}
                try {
                    if (CKEDITOR.instances['tambahTemplateContent']) {
                        CKEDITOR.instances['tambahTemplateContent'].setData(content);
                    } else {
                        modal.querySelector('#tambahTemplateContent').value = content;
                    }
                } catch (e) {
                    modal.querySelector('#tambahTemplateContent').value = content;
                }

                // collect current dynamic form fields and convert to schema (include informasiCustomFields)
                const schemaFields = [];
                document.querySelectorAll(
                    '#templateDynamicForm [data-schema-key], #informasiCustomFields [data-schema-key]').forEach(
                    el => {
                        const key = el.dataset.schemaKey || '';
                        if (!key) return;
                        let type = 'text';
                        let options = [];
                        const required = !!(el.dataset.schemaRequired === '1');
                        if (el.tagName === 'SELECT') {
                            type = 'select';
                            options = Array.from(el.querySelectorAll('option')).map(o => o.value).filter(v =>
                                v);
                        } else if (el.tagName === 'TEXTAREA') type = 'textarea';
                        else if (el.type === 'date') type = 'date';
                        else type = 'text';
                        schemaFields.push({
                            key: key,
                            label: key.replaceAll('_', ' '),
                            type: type,
                            options: options,
                            required: required
                        });
                    });

                // populate currentTemplateFields and render
                window.currentTemplateFields = schemaFields;
                renderTemplateFields(document.getElementById('templateFieldsList'), window.currentTemplateFields);
            }
            if (refreshTemplatesBtn) refreshTemplatesBtn.addEventListener('click', function() {
                populateSuratTemplateSelect();
                renderTemplateManager();
            });
            // ensure manager initially rendered
            renderTemplateManager();

            // Init Informasi Umum ad-hoc custom fields (add/edit/delete on the fly)
            window.adHocInformasiFields = window.adHocInformasiFields || [];
            window.renderInformasiCustomFields = function() {
                const listEl = document.getElementById('informasiCustomFields');
                if (!listEl) return;
                listEl.innerHTML = '';
                if (!window.adHocInformasiFields.length) {
                    listEl.innerHTML = '<p class="text-xs text-gray-500">Belum ada field kustom.</p>';
                    return;
                }
                window.adHocInformasiFields.forEach((f, idx) => {
                    const row = document.createElement('div');
                    row.className = 'flex items-center gap-2 bg-gray-50 p-2 rounded';
                    let inputHtml = '';
                    if (f.type === 'text') inputHtml =
                        `<input data-schema-key="${f.key}" ${f.required? 'data-schema-required="1"' : ''} placeholder="${escapeHtml(f.label)}" class="px-3 py-2 border rounded w-full"/>`;
                    else if (f.type === 'textarea') inputHtml =
                        `<textarea data-schema-key="${f.key}" ${f.required? 'data-schema-required="1"' : ''} class="px-3 py-2 border rounded w-full" placeholder="${escapeHtml(f.label)}"></textarea>`;
                    else if (f.type === 'date') inputHtml =
                        `<input type="date" data-schema-key="${f.key}" ${f.required? 'data-schema-required="1"' : ''} class="px-3 py-2 border rounded w-full"/>`;
                    else if (f.type === 'select') {
                        const opts = (f.options || []).map(o =>
                            `<option value="${escapeHtml(o)}">${escapeHtml(o)}</option>`).join('');
                        inputHtml =
                            `<select data-schema-key="${f.key}" ${f.required? 'data-schema-required="1"' : ''} class="px-3 py-2 border rounded w-full">${opts}</select>`;
                    }
                    row.innerHTML =
                        `<div class="flex-1">${inputHtml}</div><div class="flex gap-2"><button data-idx="${idx}" class="delInfoFieldBtn px-3 py-1 bg-red-50 text-red-700 rounded">Hapus</button></div>`;
                    listEl.appendChild(row);
                });
                listEl.querySelectorAll('.delInfoFieldBtn').forEach(b => b.addEventListener('click',
                    function() {
                        const i = parseInt(this.dataset.idx, 10);
                        window.adHocInformasiFields.splice(i, 1);
                        window.renderInformasiCustomFields();
                    }));
            };

            // bind add/cancel/toggle
            document.getElementById('toggleAddInformasiFieldBtn')?.addEventListener('click', function() {
                document.getElementById('addInformasiFieldForm')?.classList.toggle('hidden');
            });
            document.getElementById('cancelInformasiFieldBtn')?.addEventListener('click', function() {
                document.getElementById('addInformasiFieldForm')?.classList.add('hidden');
            });
            document.getElementById('addInformasiFieldBtn')?.addEventListener('click', function() {
                const type = document.getElementById('informasiNewFieldType').value;
                const label = document.getElementById('informasiNewFieldLabel').value.trim();
                const key = (document.getElementById('informasiNewFieldKey').value.trim() || label ||
                    'FIELD').toUpperCase();
                const opts = document.getElementById('informasiNewFieldOptions').value.trim();
                const required = !!document.getElementById('informasiNewFieldRequired').checked;
                if (!label || !key) return alert('Label dan Key harus diisi');
                // ensure unique key
                const existing = window.adHocInformasiFields.concat(Array.from(document.querySelectorAll(
                    '#templateDynamicForm [data-schema-key]')).map(el => el.dataset.schemaKey)).map(k =>
                    k?.toUpperCase());
                if (existing.indexOf(key) !== -1) return alert('Key sudah ada, gunakan key lain.');
                const field = {
                    type: type,
                    label: label,
                    key: key,
                    options: (type === 'select' && opts ? opts.split(',').map(s => s.trim()) : []),
                    required: required
                };
                window.adHocInformasiFields.push(field);
                document.getElementById('informasiNewFieldLabel').value = '';
                document.getElementById('informasiNewFieldKey').value = '';
                document.getElementById('informasiNewFieldOptions').value = '';
                document.getElementById('informasiNewFieldRequired').checked = false;
                document.getElementById('addInformasiFieldForm')?.classList.add('hidden');
                window.renderInformasiCustomFields();
            });

            // Fallback: bind header button to modal (in case inline handler fails)
            const btnBuat = document.getElementById('btnBuatSurat');
            if (btnBuat) {
                btnBuat.addEventListener('click', function(e) {
                    console.log('btnBuat clicked');
                    e.preventDefault();
                    if (typeof window.openModalBuatSurat === 'function') {
                        window.openModalBuatSurat();
                    } else {
                        console.error('openModalBuatSurat not available');
                    }
                });
            }
            // capture-phase handler to ensure clicks reach us even if overlay stops propagation
            document.addEventListener('click', function(e) {
                const btn = document.getElementById('btnBuatSurat');
                if (!btn) return;
                const rect = btn.getBoundingClientRect();
                const x = e.clientX,
                    y = e.clientY;
                if (x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom) {
                    console.log('capture-phase click near btnBuat', {
                        x,
                        y,
                        rect
                    });
                    if (typeof window.openModalBuatSurat === 'function') window.openModalBuatSurat();
                }
            }, true);

            // Make cards keyboard accessible
            document.querySelectorAll('.stats-card').forEach(card => {
                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });

            // Initialize filters
            filterRequests();
            filterPublished();
        });

        // ===== ATTACH EVENT LISTENERS FOR REAL-TIME PREVIEW =====
        function attachPreviewListeners() {
            const inputs = document.querySelectorAll(
                '#nomorSurat, #tanggalSurat, #karyawanSurat, #jabatanSurat, #departemenSurat, #tujuanSurat, #jenisSurat, #kopSuratSelect, #isiSurat, [data-section-title], [data-section-content], [data-field-label], [data-field-value]'
            );
            inputs.forEach(input => {
                input.removeEventListener('input', updateFormPreview);
                input.removeEventListener('change', updateFormPreview);
                input.addEventListener('input', updateFormPreview);
                input.addEventListener('change', updateFormPreview);
            });
        }

        // Re-attach listeners when new elements are added (sections/fields)
        const originalAddSuratSection = window.addSuratSection;
        window.addSuratSection = function(...args) {
            originalAddSuratSection.apply(this, args);
            setTimeout(() => attachPreviewListeners(), 100);
        };

        const originalAddAdditionalField = window.addAdditionalField;
        window.addAdditionalField = function(...args) {
            originalAddAdditionalField.apply(this, args);
            setTimeout(() => attachPreviewListeners(), 100);
        };

        // Custom field manager
        let customFieldsData = [];

        function renderCustomFields() {
            const container = document.getElementById('informasiCustomFields');
            if (!container) return;

            if (customFieldsData.length === 0) {
                container.innerHTML = '';
                return;
            }

            let html = '';
            customFieldsData.forEach((field, idx) => {
                html += `<div class="p-4 bg-white border border-gray-200/50 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="font-semibold text-gray-900">${escapeHtml(field.label)}</h4>
                        <button type="button" onclick="removeCustomField(${idx})" class="text-rose-500/80 hover:text-rose-600/90 text-sm font-medium">Hapus</button>
                    </div>
                    <div>`;

                if (field.type === 'text') {
                    html +=
                        `<input type="text" placeholder="${escapeHtml(field.label)}" data-schema-key="${field.key}" ${field.required ? 'required' : ''} class="w-full px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors" />`;
                } else if (field.type === 'textarea') {
                    html +=
                        `<textarea placeholder="${escapeHtml(field.label)}" data-schema-key="${field.key}" ${field.required ? 'required' : ''} rows="3" class="w-full px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors"></textarea>`;
                } else if (field.type === 'date') {
                    html +=
                        `<input type="date" data-schema-key="${field.key}" ${field.required ? 'required' : ''} class="w-full px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors" />`;
                } else if (field.type === 'select') {
                    const options = field.options || [];
                    html += `<select data-schema-key="${field.key}" ${field.required ? 'required' : ''} class="w-full px-3 py-2 border border-gray-300/50 rounded-xl text-sm bg-white/70 hover:bg-white transition-colors">
                        <option value="">-- Pilih ${escapeHtml(field.label)} --</option>`;
                    options.forEach(opt => {
                        html += `<option value="${escapeHtml(opt)}">${escapeHtml(opt)}</option>`;
                    });
                    html += `</select>`;
                }

                html += `</div></div>`;
            });

            container.innerHTML = html;
        }

        function removeCustomField(idx) {
            customFieldsData.splice(idx, 1);
            renderCustomFields();
        }

        function addCustomField() {
            const type = document.getElementById('informasiNewFieldType')?.value || 'text';
            const label = document.getElementById('informasiNewFieldLabel')?.value?.trim() || '';
            const key = document.getElementById('informasiNewFieldKey')?.value?.trim() || '';
            const options = document.getElementById('informasiNewFieldOptions')?.value?.trim()?.split(',').map(o => o
                .trim()).filter(o => o) || [];
            const required = document.getElementById('informasiNewFieldRequired')?.checked || false;

            if (!label || !key) {
                alert('Label dan Kunci field harus diisi');
                return;
            }

            customFieldsData.push({
                type,
                label,
                key,
                options,
                required
            });
            renderCustomFields();

            // Reset form
            document.getElementById('informasiNewFieldType').value = 'text';
            document.getElementById('informasiNewFieldLabel').value = '';
            document.getElementById('informasiNewFieldKey').value = '';
            document.getElementById('informasiNewFieldOptions').value = '';
            document.getElementById('informasiNewFieldRequired').checked = false;
            document.getElementById('addInformasiFieldForm').classList.add('hidden');
        }

        // Setup custom field form toggle
        function setupCustomFieldForm() {
            const toggleBtn = document.getElementById('toggleAddInformasiFieldBtn');
            const form = document.getElementById('addInformasiFieldForm');
            const addBtn = document.getElementById('addInformasiFieldBtn');
            const cancelBtn = document.getElementById('cancelInformasiFieldBtn');
            const typeSelect = document.getElementById('informasiNewFieldType');
            const optionsContainer = document.getElementById('optionsContainer');

            if (!toggleBtn || !form) return;

            toggleBtn.addEventListener('click', () => {
                form.classList.toggle('hidden');
            });

            if (addBtn) addBtn.addEventListener('click', addCustomField);

            if (cancelBtn) cancelBtn.addEventListener('click', () => {
                form.classList.add('hidden');
            });

            if (typeSelect) {
                typeSelect.addEventListener('change', (e) => {
                    if (optionsContainer) {
                        if (e.target.value === 'select') {
                            optionsContainer.classList.remove('hidden');
                        } else {
                            optionsContainer.classList.add('hidden');
                        }
                    }
                });
            }
        }

        // Simple custom field manager for Informasi Umum
        window.informasiUmumCustomFields = [];

        window.addCustomInformasiUmumField = function() {
            const fieldName = prompt('Masukkan nama field (misal: Lokasi, Proyek, Catatan):');
            if (!fieldName || !fieldName.trim()) return;

            const fieldKey = fieldName.toLowerCase().replace(/\s+/g, '_');
            window.informasiUmumCustomFields.push({
                label: fieldName.trim(),
                key: fieldKey
            });
            window.renderInformasiUmumCustomFields();
            updateFormPreview();
        };

        window.renderInformasiUmumCustomFields = function() {
            const container = document.getElementById('customInformasiUmumFields');
            if (!container) return;

            let html = '';
            window.informasiUmumCustomFields.forEach((field, idx) => {
                html += `
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">${escapeHtml(field.label)}</label>
                        <div class="flex gap-3">
                            <input type="text" id="informasi_umum_${field.key}" placeholder="Isi ${escapeHtml(field.label)}" 
                                   oninput="updateFormPreview()" onchange="updateFormPreview()"
                                   class="flex-1 px-4 py-3 border-2 border-rose-200/30 rounded-2xl focus:ring-2 focus:ring-rose-400/50 focus:border-rose-400/50 transition bg-white/70 hover:bg-white" />
                            <button type="button" onclick="window.removeInformasiUmumField(${idx})"
                                    class="px-4 py-3 bg-rose-100/30 text-rose-500/80 rounded-2xl hover:bg-rose-100/50 transition text-sm font-medium">Hapus</button>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        };

        window.removeInformasiUmumField = function(idx) {
            window.informasiUmumCustomFields.splice(idx, 1);
            window.renderInformasiUmumCustomFields();
            updateFormPreview();
        };

        // Helper functions
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function formatDate(date) {
            if (!date) return '';
            const d = new Date(date);
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
        }

        // Initialize on modal open
        const originalOpenModal = window.openModalSurat;
        window.openModalSurat = function() {
            if (originalOpenModal) originalOpenModal();
            setTimeout(() => {
                console.log('Initializing preview listeners on modal open');
                attachPreviewListeners();
                setupCustomFieldForm();
                updateFormPreview();
            }, 100);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Page loaded, attaching preview listeners');
            attachPreviewListeners();
            setupCustomFieldForm();
        });

        (function() {
            console.log('surat modal failsafe init');

            function ensureSectionUI() {
                const container = document.getElementById('sectionsEditor');
                if (!container) return;
                console.log('ensureSectionUI: sectionsEditor present');
                if (!document.getElementById('addSectionBtn')) {
                    const addBtn = document.createElement('button');
                    addBtn.type = 'button';
                    addBtn.id = 'addSectionBtn';
                    addBtn.className = 'px-3 py-1 bg-white border rounded text-sm';
                    addBtn.innerText = 'Tambah Section';
                    addBtn.addEventListener('click', function() {
                        if (!window.currentSections) window.currentSections = [];
                        window.currentSections.push({
                            title: '',
                            content: ''
                        });
                        if (typeof renderTemplateSections === 'function') renderTemplateSections(window
                            .currentSections);
                        else console.warn('renderTemplateSections not available yet');
                    });

                    // Prefer inserting before preview buttons if present
                    const actionGroup = container.nextElementSibling;
                    if (actionGroup) actionGroup.insertBefore(addBtn, actionGroup.firstChild);
                    else container.parentNode.insertBefore(addBtn, container.nextSibling);
                    console.log('ensureSectionUI: addSectionBtn inserted');
                } else {
                    // ensure it is visible
                    const btn = document.getElementById('addSectionBtn');
                    btn.style.display = '';
                }
            }

            // run immediately
            try {
                ensureSectionUI();
            } catch (e) {
                console.error('ensureSectionUI failed', e);
            }

            // observe DOM for changes (modal open/close) and ensure button exists
            const mo = new MutationObserver(function() {
                try {
                    ensureSectionUI();
                } catch (e) {
                    console.error(e);
                }
            });
            mo.observe(document.body, {
                childList: true,
                subtree: true,
                attributes: true
            });

            // global error capture to help debugging
            window.addEventListener('error', function(ev) {
                console.error('Global error captured:', ev.message, ev.filename, ev.lineno, ev.error);
            });
        })();

        // Final assignment of all remaining global functions after they are defined
        if (typeof simpanSurat === 'function') window.simpanSurat = simpanSurat;
        if (typeof addAdditionalField === 'function') window.addAdditionalField = addAdditionalField;
        if (typeof removeAdditionalField === 'function') window.removeAdditionalField = removeAdditionalField;
        if (typeof getAdditionalFields === 'function') window.getAdditionalFields = getAdditionalFields;
        if (typeof addSuratSection === 'function') window.addSuratSection = addSuratSection;
        if (typeof removeSuratSection === 'function') window.removeSuratSection = removeSuratSection;
        if (typeof getSuratSections === 'function') window.getSuratSections = getSuratSections;
        if (typeof previewLetter === 'function') window.previewLetter = previewLetter;
        if (typeof generatePdf === 'function') window.generatePdf = generatePdf;
        if (typeof updateKopPreview === 'function') window.updateKopPreview = updateKopPreview;
        if (typeof buatSurat === 'function') window.buatSurat = buatSurat;
        if (typeof escapeHtml === 'function') window.escapeHtml = escapeHtml;
        if (typeof formatDate === 'function') window.formatDate = formatDate;
        if (typeof addCustomInformasiUmumField === 'function') window.addCustomInformasiUmumField =
            addCustomInformasiUmumField;
        if (typeof renderInformasiUmumCustomFields === 'function') window.renderInformasiUmumCustomFields =
            renderInformasiUmumCustomFields;
        if (typeof removeInformasiUmumField === 'function') window.removeInformasiUmumField = removeInformasiUmumField;
    </script>
</x-app-layout>
