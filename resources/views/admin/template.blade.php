<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Template Surat
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header with Button -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Template Surat</h1>
                    <p class="text-gray-600 mt-1">Kelola template surat untuk mempercepat pembuatan</p>
                </div>
                <button onclick="openTambahTemplateModal()"
                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Template Baru
                </button>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Template</label>
                        <input type="text" placeholder="Ketik nama template..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Total Template</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Template Aktif</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">11</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Digunakan Bulan Ini</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">36</p>
                </div>
            </div>

            <!-- Template List Grid -->
            <div id="templateGrid" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Template Card 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Keterangan Kerja</h3>
                            <p class="text-sm text-gray-600 mt-1">Template standar untuk surat keterangan kerja</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        Kepada Yth. [TUJUAN]

                        Dengan hormat,
                        Kami, [PERUSAHAAN] menerangkan bahwa [NAMA KARYAWAN] adalah karyawan kami...
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(1)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(1)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(1)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Pengajuan Cuti</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk pengajuan cuti resmi</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        PENGAJUAN CUTI

                        Nama Karyawan : [NAMA]
                        Jenis Cuti : [JENIS]
                        Tanggal Mulai : [TGL-MULAI]
                        Tanggal Selesai: [TGL-SELESAI]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(2)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(2)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(2)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 3 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Izin Sakit</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk surat izin sakit</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        SURAT IZIN SAKIT

                        Nama Karyawan : [NAMA]
                        Tanggal : [TANGGAL-SAKIT]
                        Keterangan : [KETERANGAN]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(3)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(3)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(3)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 4 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Rekomendasi</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk surat rekomendasi kerja</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Nonaktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        Dengan hormat,
                        [ISI REKOMENDASI]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(4)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(4)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Aktifkan</button>
                        <button onclick="openDeleteTemplateModal(4)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-gray-600" id="templateCount">Menampilkan 0 template</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50"
                        disabled>Sebelumnya</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Berikutnya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Tambah Template -->
    <div id="tambahTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="tambahTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Template Surat Baru</h3>
                <button onclick="closeTambahTemplateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Template</label>
                        <input type="text" placeholder="Nama template"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih Jenis</option>
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                            <option value="lain">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fields Template</label>
                        <div class="flex gap-2 mb-2">
                            <select id="newFieldType" class="px-3 py-2 border rounded">
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                            </select>
                            <input id="newFieldLabel" placeholder="Label (contoh: Nama)"
                                class="px-3 py-2 border rounded" />
                            <input id="newFieldKey" placeholder="Key (contoh: NAMA)"
                                class="px-3 py-2 border rounded w-36" />
                            <input id="newFieldOptions" placeholder="Options (jika select, gunakan , pemisah)"
                                class="px-3 py-2 border rounded w-64" />
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                <input id="newFieldRequired" type="checkbox"
                                    class="h-4 w-4 border-gray-300 rounded" /> <span>Wajib</span>
                            </label>
                            <button id="addFieldBtn" class="px-3 py-2 bg-indigo-600 text-white rounded">Tambah
                                Field</button>
                        </div>
                        <div id="templateFieldsList" class="space-y-2 mb-3">
                            <p class="text-xs text-gray-500">Belum ada field.</p>
                        </div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Template</label>
                        <textarea id="tambahTemplateContent" placeholder="Ketik isi template..." rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"></textarea>
                        <p class="text-xs text-gray-500 mt-2">Gunakan tombol <strong>Sisipi Placeholder</strong> untuk
                            menambahkan placeholder sesuai key field.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeTambahTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan
                    Template</button>
            </div>
        </div>
    </div>

    <!-- Modal: Edit Template -->
    <div id="editTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="editTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Edit Template</h3>
                <button onclick="closeEditTemplateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Template</label>
                        <input type="text" placeholder="Nama template"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fields Template</label>
                        <div class="flex gap-2 mb-2">
                            <select id="editNewFieldType" class="px-3 py-2 border rounded">
                                <option value="text">Text</option>
                                <option value="textarea">Textarea</option>
                                <option value="date">Date</option>
                                <option value="select">Select</option>
                            </select>
                            <input id="editNewFieldLabel" placeholder="Label (contoh: Nama)"
                                class="px-3 py-2 border rounded" />
                            <input id="editNewFieldKey" placeholder="Key (contoh: NAMA)"
                                class="px-3 py-2 border rounded w-36" />
                            <input id="editNewFieldOptions" placeholder="Options (jika select, gunakan , pemisah)"
                                class="px-3 py-2 border rounded w-64" />
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                <input id="editNewFieldRequired" type="checkbox"
                                    class="h-4 w-4 border-gray-300 rounded" /> <span>Wajib</span>
                            </label>
                            <button id="editAddFieldBtn" class="px-3 py-2 bg-indigo-600 text-white rounded">Tambah
                                Field</button>
                        </div>
                        <div id="editTemplateFieldsList" class="space-y-2 mb-3">
                            <p class="text-xs text-gray-500">Belum ada field.</p>
                        </div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Template</label>
                        <textarea id="editTemplateContent" placeholder="Ketik isi template..." rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"></textarea>
                        <p class="text-xs text-gray-500 mt-2">Gunakan tombol <strong>Sisipi Placeholder</strong> untuk
                            menambahkan placeholder sesuai key field.</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeEditTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Toggle Status -->
    <div id="toggleStatusModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="toggleStatusModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Ubah Status Template?</h3>
                <p class="text-gray-600 text-center mb-6">Ubah status template aktif/nonaktif?</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeToggleStatusModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">Ya,
                    Ubah Status</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Hapus -->
    <div id="deleteTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="deleteTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Hapus Template?</h3>
                <p class="text-gray-600 text-center mb-6">Template akan dihapus permanen. Aksi ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeDeleteTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.25.1/lts/ckeditor.js"></script>
    <script>
        function openTambahTemplateModal() {
            document.getElementById('tambahTemplateModal').classList.remove('hidden');
            // init editor if not ready
            try {
                if (!CKEDITOR.instances['tambahTemplateContent']) CKEDITOR.replace('tambahTemplateContent', {
                    height: 240
                });
            } catch (e) {}
        }

        function closeTambahTemplateModal() {
            document.getElementById('tambahTemplateModal').classList.add('hidden');
            try {
                if (CKEDITOR.instances['tambahTemplateContent']) CKEDITOR.instances['tambahTemplateContent'].destroy(true);
            } catch (e) {}
        }

        function openEditTemplateModal(id) {
            // load template data
            fetch(`/admin/template/${id}`, {
                    credentials: 'same-origin'
                })
                .then(r => r.json()).then(resp => {
                    const tpl = resp.data;
                    const modal = document.getElementById('editTemplateModal');
                    modal.querySelector('input[placeholder="Nama template"]').value = tpl.name || '';
                    modal.querySelector('select').value = tpl.jenis || '';
                    // init editor and set data
                    try {
                        if (CKEDITOR.instances['editTemplateContent']) CKEDITOR.instances['editTemplateContent']
                            .destroy(true);
                        CKEDITOR.replace('editTemplateContent', {
                            height: 240
                        });
                        CKEDITOR.instances['editTemplateContent'].setData(tpl.content || '');
                    } catch (e) {
                        modal.querySelector('textarea').value = tpl.content || '';
                    }
                    modal.dataset.editing = tpl.id;

                    // populate schema fields into editTemplateFields
                    window.editTemplateFields = tpl.schema || [];
                    renderTemplateFields(document.getElementById('editTemplateFieldsList'), window.editTemplateFields);

                    modal.classList.remove('hidden');
                }).catch(err => {
                    console.error('load tpl', err);
                    alert('Gagal memuat template');
                });
        }

        function closeEditTemplateModal() {
            const modal = document.getElementById('editTemplateModal');
            delete modal.dataset.editing;
            document.getElementById('editTemplateModal').classList.add('hidden');
        }

        function openToggleStatusModal(id) {
            document.getElementById('toggleStatusModal').dataset.tpl = id;
            document.getElementById('toggleStatusModal').classList.remove('hidden');
        }

        function closeToggleStatusModal() {
            delete document.getElementById('toggleStatusModal').dataset.tpl;
            document.getElementById('toggleStatusModal').classList.add('hidden');
        }

        function openDeleteTemplateModal(id) {
            document.getElementById('deleteTemplateModal').dataset.tpl = id;
            document.getElementById('deleteTemplateModal').classList.remove('hidden');
        }

        function closeDeleteTemplateModal() {
            delete document.getElementById('deleteTemplateModal').dataset.tpl;
            document.getElementById('deleteTemplateModal').classList.add('hidden');
        }

        // CRUD actions
        function fetchTemplates() {
            fetch('/admin/template/list', {
                    credentials: 'same-origin'
                })
                .then(r => r.json()).then(resp => {
                    const list = resp.data || [];
                    renderTemplates(list);
                }).catch(err => console.error('fetch templates', err));
        }

        function renderTemplates(list) {
            const grid = document.getElementById('templateGrid');
            const countEl = document.getElementById('templateCount');
            grid.innerHTML = '';
            countEl.innerText = `Menampilkan ${list.length} template`;
            list.forEach(t => {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-lg shadow-sm border border-gray-200 p-6';
                card.innerHTML = `
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">${escapeHtml(t.name)}</h3>
                            <p class="text-sm text-gray-600 mt-1">${escapeHtml(t.jenis || '')}</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${t.is_active? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">${t.is_active? 'Aktif' : 'Nonaktif'}</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">${escapeHtml((t.content||'').substring(0,800))}</div>
                    <div class="flex gap-2">
                        <button data-id="${t.id}" class="editBtn flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button data-id="${t.id}" class="toggleBtn flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">${t.is_active? 'Nonaktifkan' : 'Aktifkan'}</button>
                        <button data-id="${t.id}" class="delBtn px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                `;
                grid.appendChild(card);
            });

            // attach events
            grid.querySelectorAll('.editBtn').forEach(b => b.addEventListener('click', (e) => openEditTemplateModal(e
                .currentTarget.dataset.id)));
            grid.querySelectorAll('.toggleBtn').forEach(b => b.addEventListener('click', (e) => toggleStatus(e.currentTarget
                .dataset.id)));
            grid.querySelectorAll('.delBtn').forEach(b => b.addEventListener('click', (e) => openDeleteTemplateModal(e
                .currentTarget.dataset.id)));
        }

        function toggleStatus(id) {
            // fetch, flip, update
            fetch(`/admin/template/${id}`, {
                credentials: 'same-origin'
            }).then(r => r.json()).then(resp => {
                const tpl = resp.data;
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                fetch(`/admin/template/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        name: tpl.name,
                        jenis: tpl.jenis,
                        content: tpl.content,
                        is_active: !tpl.is_active
                    }),
                    credentials: 'same-origin'
                }).then(() => fetchTemplates());
            });
        }

        // Template fields helpers
        function renderTemplateFields(listEl, fields) {
            listEl.innerHTML = '';
            if (!fields || !fields.length) {
                listEl.innerHTML = '<p class="text-xs text-gray-500">Belum ada field.</p>';
                return;
            }
            fields.forEach((f, idx) => {
                const div = document.createElement('div');
                div.className = 'flex items-center gap-2 bg-gray-50 p-2 rounded';
                div.innerHTML = `
                    <div class="flex-1">
                        <div class="text-sm font-medium">${escapeHtml(f.label || f.key || '(tanpa label)')}</div>
                        <div class="text-xs text-gray-500">${escapeHtml(f.type)} ${f.options? (' - ' + escapeHtml(f.options.join(','))) : ''}</div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button data-idx="${idx}" class="moveUpBtn px-2 py-1 bg-white border rounded">↑</button>
                        <button data-idx="${idx}" class="moveDownBtn px-2 py-1 bg-white border rounded">↓</button>
                        <button data-idx="${idx}" class="insertPhBtn px-2 py-1 bg-indigo-50 text-indigo-700 rounded">Sisipi Placeholder</button>
                        <button data-idx="${idx}" class="delFieldBtn px-2 py-1 bg-red-50 text-red-700 rounded">Hapus</button>
                    </div>
                `;
                listEl.appendChild(div);
            });
            // attach events
            listEl.querySelectorAll('.moveUpBtn').forEach(b => b.addEventListener('click', function() {
                const i = parseInt(this.dataset.idx, 10);
                if (i <= 0) return;
                fields.splice(i - 1, 0, fields.splice(i, 1)[0]);
                renderTemplateFields(listEl, fields);
            }));
            listEl.querySelectorAll('.moveDownBtn').forEach(b => b.addEventListener('click', function() {
                const i = parseInt(this.dataset.idx, 10);
                if (i >= fields.length - 1) return;
                fields.splice(i + 1, 0, fields.splice(i, 1)[0]);
                renderTemplateFields(listEl, fields);
            }));
            listEl.querySelectorAll('.delFieldBtn').forEach(b => b.addEventListener('click', function() {
                const i = parseInt(this.dataset.idx, 10);
                if (!confirm('Hapus field?')) return;
                fields.splice(i, 1);
                renderTemplateFields(listEl, fields);
            }));
            listEl.querySelectorAll('.insertPhBtn').forEach(b => b.addEventListener('click', function() {
                const i = parseInt(this.dataset.idx, 10);
                const f = fields[i];
                const key = f.key || f.label || 'FIELD' + i;
                try {
                    if (CKEDITOR.instances['tambahTemplateContent']) {
                        CKEDITOR.instances['tambahTemplateContent'].insertHtml('{{ '+key.toUpperCase()+' }}');
                    }
                    if (CKEDITOR.instances['editTemplateContent']) {
                        CKEDITOR.instances['editTemplateContent'].insertHtml('{{ '+key.toUpperCase()+' }}');
                    }
                } catch (e) {}
            }));

            // toggle required
            listEl.querySelectorAll('.toggleReqBtn').forEach(b => b.addEventListener('click', function() {
                const i = parseInt(this.dataset.idx, 10);
                fields[i].required = !fields[i].required;
                renderTemplateFields(listEl, fields);
            }));
        }

        // collect schema array from list
        function collectSchemaFromList(listEl) {
            const out = [];
            const children = Array.from(listEl.children).filter(c => !c.classList.contains('text-xs'));
            children.forEach((c, idx) => {
                const label = c.querySelector('.text-sm')?.innerText || '';
                const typeText = c.querySelector('.text-xs')?.innerText || '';
                // parse type and options back is brittle; instead we store fields in a window var when creating
            });
            return window.currentTemplateFields || [];
        }

        // Add field handlers for Add Modal
        window.currentTemplateFields = window.currentTemplateFields || [];
        document.getElementById('addFieldBtn')?.addEventListener('click', function() {
            const type = document.getElementById('newFieldType').value;
            const label = document.getElementById('newFieldLabel').value.trim();
            const key = document.getElementById('newFieldKey').value.trim().toUpperCase();
            const opts = document.getElementById('newFieldOptions').value.trim();
            const required = !!document.getElementById('newFieldRequired')?.checked;
            if (!label || !key) return alert('Label dan Key harus diisi');
            const field = {
                type: type,
                label: label,
                key: key,
                required: required,
                options: (type === 'select' && opts ? opts.split(',').map(s => s.trim()) : [])
            };
            window.currentTemplateFields.unshift(field);
            renderTemplateFields(document.getElementById('templateFieldsList'), window.currentTemplateFields);
            document.getElementById('newFieldLabel').value = '';
            document.getElementById('newFieldKey').value = '';
            document.getElementById('newFieldOptions').value = '';
            document.getElementById('newFieldRequired').checked = false;
        });

        // Add field handlers for Edit Modal
        window.editTemplateFields = window.editTemplateFields || [];
        document.getElementById('editAddFieldBtn')?.addEventListener('click', function() {
            const type = document.getElementById('editNewFieldType').value;
            const label = document.getElementById('editNewFieldLabel').value.trim();
            const key = document.getElementById('editNewFieldKey').value.trim().toUpperCase();
            const opts = document.getElementById('editNewFieldOptions').value.trim();
            const required = !!document.getElementById('editNewFieldRequired')?.checked;
            if (!label || !key) return alert('Label dan Key harus diisi');
            const field = {
                type: type,
                label: label,
                key: key,
                required: required,
                options: (type === 'select' && opts ? opts.split(',').map(s => s.trim()) : [])
            };
            window.editTemplateFields.unshift(field);
            renderTemplateFields(document.getElementById('editTemplateFieldsList'), window.editTemplateFields);
            document.getElementById('editNewFieldLabel').value = '';
            document.getElementById('editNewFieldKey').value = '';
            document.getElementById('editNewFieldOptions').value = '';
            document.getElementById('editNewFieldRequired').checked = false;
        });

        // Save new template (include schema)
        document.querySelector('#tambahTemplateModal button.bg-indigo-600')?.addEventListener('click', function() {
            const modal = document.getElementById('tambahTemplateModal');
            const name = modal.querySelector('input[placeholder="Nama template"]').value.trim();
            const jenis = modal.querySelector('select').value;
            let content = '';
            try {
                if (CKEDITOR.instances['tambahTemplateContent']) content = CKEDITOR.instances[
                    'tambahTemplateContent'].getData();
            } catch (e) {
                content = modal.querySelector('#tambahTemplateContent').value;
            }
            const schema = window.currentTemplateFields || [];
            if (!name) return alert('Nama template harus diisi');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/admin/template', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    name,
                    jenis,
                    content,
                    schema
                }),
                credentials: 'same-origin'
            }).then(r => r.json()).then(() => {
                closeTambahTemplateModal();
                window.currentTemplateFields = [];
                renderTemplateFields(document.getElementById('templateFieldsList'), window
                    .currentTemplateFields);
                fetchTemplates();
            }).catch(err => {
                console.error(err);
                alert('Gagal menyimpan')
            });
        });

        // Save edit (include schema)
        document.querySelector('#editTemplateModal button.bg-indigo-600')?.addEventListener('click', function() {
            const modal = document.getElementById('editTemplateModal');
            const id = modal.dataset.editing;
            const name = modal.querySelector('input[placeholder="Nama template"]').value.trim();
            const jenis = modal.querySelector('select').value;
            let content = '';
            try {
                if (CKEDITOR.instances['editTemplateContent']) content = CKEDITOR.instances['editTemplateContent']
                    .getData();
            } catch (e) {
                content = modal.querySelector('#editTemplateContent').value;
            }
            const schema = window.editTemplateFields || [];
            if (!name) return alert('Nama template harus diisi');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/admin/template/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    name,
                    jenis,
                    content,
                    schema
                }),
                credentials: 'same-origin'
            }).then(r => r.json()).then(() => {
                closeEditTemplateModal();
                window.editTemplateFields = [];
                fetchTemplates();
            }).catch(err => {
                console.error(err);
                alert('Gagal update')
            });
        });

        // When loading template into edit modal, populate field list
        // (this was added earlier in openEditTemplateModal)



        // Delete confirm
        document.querySelector('#deleteTemplateModal button.bg-red-600')?.addEventListener('click', function() {
            const id = document.getElementById('deleteTemplateModal').dataset.tpl;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/admin/template/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                credentials: 'same-origin'
            }).then(() => {
                closeDeleteTemplateModal();
                fetchTemplates();
            }).catch(err => {
                console.error(err);
                alert('Gagal hapus')
            });
        });

        // Close modal when clicking outside (scoped to .js-modal) and close on Escape
        document.querySelectorAll('.js-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.js-modal').forEach(m => m.classList.add('hidden'));
            }
        });

        // init
        document.addEventListener('DOMContentLoaded', function() {
            fetchTemplates();
        });

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.replace(/[&<"']/g, function(m) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '"': '&quot;',
                    '\'': '&#39;'
                } [m]);
            });
        }
    </script>
</x-app-layout>
