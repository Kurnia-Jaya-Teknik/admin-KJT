<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Cuti
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Toast container -->
    <div id="cutiToast" class="fixed top-6 right-6 z-50 hidden"></div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div
            class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-red-50/60 via-slate-50/20 to-gray-50/5 min-h-full">
            <!-- Welcome Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Pengajuan Cuti</h1>
                <p class="text-sm text-gray-500">Ajukan cuti tahunan, sakit, atau khusus</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Pengajuan -->
                <div
                    class="lg:col-span-2 bg-white/90 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div
                        class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/40 via-slate-50/30 to-slate-50/20">
                        <h3 class="text-sm font-semibold text-gray-800">Ajukan Cuti Baru</h3>
                    </div>
                    <div class="p-6">
                        <form id="cutiForm" class="space-y-5">
                            <div id="cutiAlert" class="hidden"></div>
                            <!-- Jenis Cuti -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Jenis Cuti</label>
                                <select id="jenis" name="jenis"
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/40 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/50 transition-all duration-300 text-sm text-gray-700 hover:bg-white">
                                    <option selected disabled value="">Pilih jenis cuti</option>
                                    <option value="Cuti Tahunan">Cuti Tahunan</option>
                                    <option value="Cuti Sakit">Cuti Sakit</option>
                                    <option value="Cuti Darurat">Cuti Darurat</option>
                                </select>
                            </div>

                            <!-- Tanggal Mulai & Selesai -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2.5">Tanggal Mulai</label>
                                    <input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                        class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/60 transition-all duration-300 text-sm text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2.5">Tanggal
                                        Selesai</label>
                                    <input id="tanggal_selesai" name="tanggal_selesai" type="date"
                                        class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/60 transition-all duration-300 text-sm text-gray-700">
                                </div>
                            </div>

                            <!-- Alasan -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Alasan /
                                    Keterangan</label>
                                <textarea id="alasan" name="alasan" rows="4" placeholder="Jelaskan alasan pengajuan cuti Anda..."
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/40 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/50 transition-all duration-300 text-sm resize-none text-gray-700 placeholder-gray-400 hover:bg-white"></textarea>
                            </div>

                            <!-- Info -->
                            <div
                                class="bg-gradient-to-r from-red-50/40 to-slate-50/30 border border-red-200/30 rounded-2xl p-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-1.5 bg-red-100/40 rounded-2xl flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-red-400/60" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        <span class="font-medium text-gray-700">Catatan:</span> Sisa cuti tahunan Anda
                                        <strong class="text-red-500/80">8 hari</strong>. Pastikan pengajuan tidak
                                        melebihi jumlah sisa cuti.
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="flex gap-3 pt-2">
                                <button type="submit" id="submitCuti"
                                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500/85 to-red-600/75 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-600 shadow-sm hover:shadow-md transition-all duration-300 text-sm">
                                    Ajukan Cuti
                                </button>
                                <button type="reset"
                                    class="flex-1 px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div
                    class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/40 to-slate-50/20">
                        <h3 class="text-sm font-semibold text-gray-800">Informasi Cuti</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-2">Sisa Cuti Tahunan
                            </p>
                            <p
                                class="text-2xl font-semibold bg-gradient-to-r from-red-500/70 to-red-600/60 bg-clip-text text-transparent">
                                8 hari</p>
                            <div class="mt-3 bg-gray-100/30 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-500/60 to-red-400/50 h-2 rounded-full transition-all duration-500 shadow-sm"
                                    style="width: 67%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Digunakan 4 dari 12 hari</p>
                        </div>
                        <div class="border-t border-gray-100/50 pt-5">
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Kebijakan Cuti</p>
                            <ul class="space-y-2.5 text-xs text-gray-600">
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/50 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Pengajuan minimal 3 hari sebelumnya</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/50 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Max 5 hari dalam satu pengajuan</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/50 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Approval dari direktur</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/50 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Cuti tidak bisa dibatalkan 1 hari sebelumnya</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pengajuan Cuti -->
            <div
                class="mt-8 bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                <div
                    class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/40 via-slate-50/20 to-slate-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Cuti</h3>
                </div>
                <div id="riwayatList" class="divide-y divide-gray-100/50"></div>
                <div id="riwayatPagination"
                    class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50"></div>
                <!-- Static example items removed — content rendered dynamically from API -->
            </div>
        </div>
    </div>

    <!-- Toast container (for popups) -->
    <div id="cutiToast" class="fixed bottom-6 right-6 w-full max-w-xs hidden z-50 space-y-3"></div>
    </div>
    @push('scripts')
        <script>
            (function() {
                const API_BASE_RAW = "{{ rtrim(request()->getSchemeAndHttpHost() . request()->getBaseUrl(), '/') }}";
                const API_BASE = (API_BASE_RAW && API_BASE_RAW.indexOf('{{') === -1) ? API_BASE_RAW : (window.location
                    .origin + window.location.pathname.replace(/\/[^\/]*$/, ''));
                console.debug('[cuti] API_BASE', API_BASE);

                function apiPath(path) {
                    if (path.startsWith('/api/') || path.startsWith('/session/')) return window.location.origin + path;
                    return API_BASE + path;
                }

                const form = document.getElementById('cutiForm');
                const alertBox = document.getElementById('cutiAlert');
                const submitBtn = document.getElementById('submitCuti');

                const toastContainer = document.getElementById('cutiToast');

                function showToast(type, message) {
                    const div = document.createElement('div');
                    div.className =
                        'max-w-sm w-full bg-white shadow-lg rounded-xl p-4 border flex items-start gap-3 animate-in fade-in';
                    div.innerHTML =
                        `<div class="w-3 h-3 mt-1 rounded-full ${type==='success'?'bg-emerald-500':'bg-red-500'}"></div><div><p class="font-medium text-sm text-gray-800">${message}</p></div>`;
                    toastContainer.appendChild(div);
                    toastContainer.classList.remove('hidden');
                    setTimeout(() => {
                        div.remove();
                        if (!toastContainer.children.length) toastContainer.classList.add('hidden');
                    }, 4500);
                }

                function showAlert(type, message) {
                    if (!alertBox) return showToast(type, message);
                    alertBox.className = '';
                    alertBox.classList.add('mt-4', 'p-3', 'rounded-lg');
                    if (type === 'success') {
                        alertBox.classList.add('bg-green-50', 'border', 'border-green-200', 'text-green-700');
                    } else {
                        alertBox.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-700');
                    }
                    alertBox.innerHTML = message;
                    alertBox.classList.remove('hidden');
                    setTimeout(() => {
                        alertBox.classList.add('hidden');
                    }, 6000);
                }

                // spinner
                const submitSpinner = document.createElement('span');
                submitSpinner.className =
                    'ml-2 inline-block w-4 h-4 border-2 border-t-2 border-gray-200 rounded-full animate-spin hidden';
                submitSpinner.setAttribute('role', 'status');
                submitSpinner.setAttribute('aria-hidden', 'true');
                submitBtn && submitBtn.parentNode.insertBefore(submitSpinner, submitBtn.nextSibling);

                function setSubmitting(s) {
                    if (!submitBtn) return;
                    if (s) {
                        submitBtn.setAttribute('disabled', 'disabled');
                        submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
                        submitSpinner.classList.remove('hidden');
                    } else {
                        submitBtn.removeAttribute('disabled');
                        submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                        submitSpinner.classList.add('hidden');
                    }
                }

                // Update duration display in the edit modal (inclusive)
                function updateEditDurasi() {
                    try {
                        const start = document.getElementById('editTanggalMulai')?.value;
                        const end = document.getElementById('editTanggalSelesai')?.value;
                        const label = document.getElementById('editDurasiLabel');
                        if (!label) return;
                        if (!start || !end) {
                            label.textContent = '-';
                            return;
                        }
                        const s = new Date(start);
                        const e = new Date(end);
                        if (isNaN(s) || isNaN(e) || e < s) {
                            label.textContent = '-';
                            return;
                        }
                        const diff = Math.round((e - s) / (1000 * 60 * 60 * 24)) + 1;
                        label.textContent = diff + ' hari';
                    } catch (err) {
                        console.debug('updateEditDurasi', err);
                    }
                }

                function showModalError(msg) {
                    const el = document.getElementById('editCutiError');
                    if (!el) return;
                    el.classList.remove('hidden');
                    el.classList.add('mt-2', 'p-2', 'rounded-md', 'bg-red-50', 'border', 'border-red-200', 'text-red-700');
                    el.textContent = msg;
                }

                function clearModalError() {
                    const el = document.getElementById('editCutiError');
                    if (!el) return;
                    el.textContent = '';
                    el.classList.add('hidden');
                    el.classList.remove('mt-2', 'p-2', 'rounded-md', 'bg-red-50', 'border', 'border-red-200',
                        'text-red-700');
                }

                async function ensureApiToken() {
                    let token = window.localStorage ? window.localStorage.getItem('api_token') : null;
                    if (token) return token;
                    try {
                        const res = await fetch(apiPath('/session/api-token'), {
                            credentials: 'same-origin'
                        });
                        if (res.ok) {
                            const json = await res.json();
                            if (json.token && window.localStorage) window.localStorage.setItem('api_token', json.token);
                            return json.token;
                        }
                    } catch (e) {
                        console.debug('no session token', e);
                    }
                    return null;
                }

                function getAuthHeaders() {
                    const token = window.localStorage ? window.localStorage.getItem('api_token') : null;
                    const headers = {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    };
                    if (token) headers['Authorization'] = 'Bearer ' + token;
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrf) headers['X-CSRF-TOKEN'] = csrf;
                    return headers;
                }

                // Local cache for requests fetched by fetchRiwayat
                const requestsCache = {};

                function toIsoDate(value) {
                    if (!value) return '';
                    // handles '2026-01-26T00:00:00.000000Z' and timestamps
                    if (typeof value === 'string' && value.indexOf('T') !== -1) return value.split('T')[0];
                    // fallback: try Date
                    try {
                        const d = new Date(value);
                        if (!isNaN(d)) return d.toISOString().slice(0, 10);
                    } catch (e) {
                        /* ignore */
                    }
                    return value;
                }

                async function fetchProfile() {
                    try {
                        const res = await fetch(apiPath('/api/employee/profile'), {
                            credentials: 'same-origin',
                            headers: getAuthHeaders()
                        });
                        if (!res.ok) return;
                        const json = await res.json();
                        const sisaEl = document.querySelector('#sisaCutiLabel');
                        if (sisaEl) sisaEl.textContent = (json.sisa_cuti !== undefined ? json.sisa_cuti : '0') +
                            ' hari';
                    } catch (e) {
                        console.debug('fetchProfile', e);
                    }
                }

                async function fetchRiwayat(page = 1) {
                    const container = document.getElementById('riwayatList');
                    const paginationEl = document.getElementById('riwayatPagination');
                    if (!container) return;
                    container.innerHTML = '<div class="px-6 py-4 text-xs text-gray-400">Memuat...</div>';
                    try {
                        const res = await fetch(apiPath('/api/employee/requests') + '?page=' + (page || 1), {
                            credentials: 'same-origin',
                            headers: getAuthHeaders()
                        });
                        if (!res.ok) throw new Error('Gagal memuat riwayat');
                        const json = await res.json();
                        const items = json.data || json;

                        container.innerHTML = '';
                        if (!items || !items.length) {
                            container.innerHTML =
                                '<div class="px-6 py-4 text-xs text-gray-400">Belum ada pengajuan.</div>';
                            if (paginationEl) paginationEl.innerHTML = '';
                            await fetchProfile().catch(() => {});
                            return;
                        }

                        items.forEach(i => {
                            const itemId = 'riwayat-item-' + (i.id || Math.random().toString(36).slice(2, 9));
                            const status = i.status || 'Pending';

                            // Status colors and badge classes
                            let statusBadgeClass = 'bg-amber-50/70 text-amber-600/80';
                            let hoverClass = 'hover:from-red-50/30';
                            let iconBg = 'from-red-50/60 to-red-50/40';
                            let iconColor = 'text-red-500/70';
                            let iconSvg =
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';

                            if (status === 'Disetujui') {
                                statusBadgeClass = 'bg-green-50/70 text-green-600/80';
                                hoverClass = 'hover:from-green-50/30';
                                iconBg = 'from-green-50/60 to-green-50/40';
                                iconColor = 'text-green-500/70';
                                iconSvg =
                                    '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>';
                            } else if (status === 'Ditolak') {
                                statusBadgeClass = 'bg-red-50/70 text-red-500/80';
                                hoverClass = 'hover:from-red-50/30';
                                iconBg = 'from-red-50/60 to-red-50/40';
                                iconColor = 'text-red-500/70';
                                iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                            }

                            const tanggal = i.tanggal_mulai ? new Date(i.tanggal_mulai).toLocaleDateString(
                                'id-ID') : '-';
                            const durasi = i.durasi_hari ? (i.durasi_hari + ' hari') : '-';
                            const tanggalSelesai = i.tanggal_selesai || i.tanggal_mulai || '';
                            const diajukan = i.created_at ? new Date(i.created_at).toLocaleDateString('id-ID') :
                                '-';

                            const html = `
                    <div id="${itemId}" class="px-6 py-4 hover:bg-gradient-to-r ${hoverClass} hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br ${iconBg} flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 ${iconColor}" fill="${status === 'Disetujui' ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                    ${iconSvg}
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">${i.jenis || '-'}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">${durasi} • ${tanggal}</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 ${statusBadgeClass} text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">${status}</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: ${diajukan}</p>
                                <p class="text-sm text-gray-600 mb-2 truncate">${i.alasan || '-'}</p>
                                <div class="flex gap-3">
                                    ${status === 'Pending' ? `
                                                                <button data-action="edit-cuti" data-id="${i.id}" data-jenis="${i.jenis || ''}" data-tanggal-mulai="${i.tanggal_mulai || ''}" data-tanggal-selesai="${tanggalSelesai}" data-alasan="${i.alasan || ''}" class="text-xs text-indigo-600 hover:underline font-medium">Ubah</button>
                                                                <button data-action="delete-cuti" data-id="${i.id}" class="text-xs text-red-600 hover:underline font-medium">Hapus</button>
                                                            ` : ''}
                                    <button class="text-xs text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Lihat Detail →</button>
                                </div>
                            </div>
                        </div>
                    </div>`;

                            // cache the item for quick edit popup (avoid calling non-existing GET /{id})
                            try {
                                if (i && i.id) requestsCache[i.id] = i;
                            } catch (e) {
                                /* ignore */
                            }
                            container.insertAdjacentHTML('beforeend', html);
                        });

                        // render pagination if available
                        if (paginationEl) {
                            const meta = json.meta || json.pagination || null;
                            if (meta && (meta.last_page && meta.last_page > 1 || meta.total && meta.per_page)) {
                                const current = meta.current_page || meta.current_page || 1;
                                const last = meta.last_page || Math.ceil((meta.total || items.length) / (meta
                                    .per_page || items.length));
                                let leftHtml =
                                    `<div class="text-sm text-gray-600">Halaman ${current} dari ${last}</div>`;
                                let rightHtml = '<div class="flex gap-2">';
                                if (current > 1) rightHtml +=
                                    `<button data-page="${current-1}" class="px-3 py-1 rounded border text-sm">Sebelumnya</button>`;
                                if (current < last) rightHtml +=
                                    `<button data-page="${current+1}" class="px-3 py-1 rounded border text-sm">Selanjutnya</button>`;
                                rightHtml += '</div>';
                                paginationEl.innerHTML =
                                    `<div class="flex items-center justify-between">${leftHtml}${rightHtml}</div>`;
                                paginationEl.querySelectorAll('button[data-page]').forEach(b => b.addEventListener(
                                    'click', () => fetchRiwayat(parseInt(b.getAttribute('data-page')))));
                            } else {
                                paginationEl.innerHTML = '';
                            }
                        }

                    } catch (e) {
                        console.debug('fetchRiwayat error', e);
                        container.innerHTML = '<div class="px-6 py-4 text-xs text-red-400">Gagal memuat riwayat.</div>';
                        if (paginationEl) paginationEl.innerHTML = '';
                    }
                }

                if (form) {
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();
                        const data = {
                            jenis: document.getElementById('jenis')?.value,
                            tanggal_mulai: document.getElementById('tanggal_mulai')?.value,
                            tanggal_selesai: document.getElementById('tanggal_selesai')?.value,
                            alasan: document.getElementById('alasan')?.value,
                        };

                        try {
                            setSubmitting(true);
                            // ensure csrf cookie
                            await fetch('/sanctum/csrf-cookie', {
                                credentials: 'same-origin'
                            });
                            const token = await ensureApiToken();
                            const headers = getAuthHeaders();
                            if (token) headers['Authorization'] = 'Bearer ' + token;
                            const res = await fetch(apiPath('/api/employee/requests'), {
                                method: 'POST',
                                headers,
                                credentials: 'same-origin',
                                body: JSON.stringify(data)
                            });
                            if (!res.ok) {
                                if (res.status === 401) {
                                    showAlert('error', 'Sesi tidak valid. Silakan login ulang.');
                                    window.location.href = '/login';
                                    return;
                                }
                                const err = await res.json().catch(() => ({
                                    message: 'Terjadi kesalahan'
                                }));
                                showAlert('error', err.message || 'Validasi gagal');
                                return;
                            }
                            const json = await res.json();
                            showToast('success', 'Pengajuan cuti berhasil dikirim.');
                            form.reset();
                            await fetchRiwayat();
                            await fetchProfile();
                        } catch (err) {
                            console.error(err);
                            showAlert('error', 'Terjadi kesalahan sistem');
                        } finally {
                            setSubmitting(false);
                        }
                    });

                    // initial load
                    (async () => {
                        await ensureApiToken();
                        await fetchProfile();
                        await fetchRiwayat();
                    })();

                    // Delegated click handler for riwayat actions (cancel)
                    document.addEventListener('click', async function(e) {
                        const btn = e.target.closest('[data-action="cancel"]');
                        if (!btn) return;
                        const id = btn.getAttribute('data-id');
                        if (!id) return;
                        if (!confirm('Yakin ingin membatalkan pengajuan ini?')) return;
                        try {
                            setSubmitting(true);
                            const res = await fetch(apiPath('/api/employee/requests/' + id), {
                                method: 'DELETE',
                                headers: getAuthHeaders(),
                                credentials: 'same-origin'
                            });
                            if (!res.ok) {
                                const err = await res.json().catch(() => ({
                                    message: 'Gagal membatalkan'
                                }));
                                showAlert('error', err.message || 'Gagal membatalkan pengajuan');
                                return;
                            }
                            showToast('success', 'Pengajuan berhasil dibatalkan.');
                            const el = document.getElementById('riwayat-item-' + id);
                            if (el) el.remove();
                            await fetchProfile();
                        } catch (err) {
                            console.error(err);
                            showAlert('error', 'Gagal membatalkan pengajuan.');
                        } finally {
                            setSubmitting(false);
                        }
                    });

                    // Delegated click handler for edit cuti
                    document.addEventListener('click', function(e) {
                        const editBtn = e.target.closest('[data-action="edit-cuti"]');
                        if (editBtn) {
                            const id = editBtn.getAttribute('data-id');
                            if (!id) return;

                            try {
                                // Use cached item first (fetchRiwayat populates requestsCache). If not available fallback to attributes.
                                let payload = requestsCache[id] || {
                                    id,
                                    jenis: editBtn.getAttribute('data-jenis') || '',
                                    tanggal_mulai: editBtn.getAttribute('data-tanggal-mulai') || '',
                                    tanggal_selesai: editBtn.getAttribute('data-tanggal-selesai') || editBtn
                                        .getAttribute('data-tanggal-mulai') || '',
                                    alasan: editBtn.getAttribute('data-alasan') || ''
                                };

                                // If payload has nested data, normalize (same as earlier normalization)
                                if (payload && typeof payload === 'object' && payload.data) payload = payload.data;
                                if (!payload) payload = {};

                                document.getElementById('editCutiId').value = payload.id || id;
                                document.getElementById('editJenis').value = payload.jenis || '';
                                // normalize ISO timestamps to yyyy-MM-dd for date inputs
                                document.getElementById('editTanggalMulai').value = toIsoDate(payload
                                    .tanggal_mulai || payload.tanggal_mulai_raw || '');
                                document.getElementById('editTanggalSelesai').value = toIsoDate(payload
                                    .tanggal_selesai || payload.tanggal_selesai_raw || '');
                                document.getElementById('editAlasan').value = payload.alasan || '';

                                clearModalError();
                                updateEditDurasi();

                                document.getElementById('editCutiModal').classList.remove('hidden');
                                setTimeout(() => document.getElementById('editJenis')?.focus(), 100);
                            } catch (err) {
                                console.error('prepare edit payload', err);
                                showAlert('error', 'Gagal menyiapkan form edit.');
                            }
                        }

                        const deleteBtn = e.target.closest('[data-action="delete-cuti"]');
                        if (deleteBtn) {
                            const id = deleteBtn.getAttribute('data-id');
                            if (!id) return;

                            // prepare payload from cache or attributes and open confirmation modal
                            const payload = requestsCache[id] || {
                                id,
                                jenis: deleteBtn.getAttribute('data-jenis') || '',
                                tanggal_mulai: deleteBtn.getAttribute('data-tanggal-mulai') || '',
                                tanggal_selesai: deleteBtn.getAttribute('data-tanggal-selesai') || deleteBtn
                                    .getAttribute('data-tanggal-mulai') || '',
                                alasan: deleteBtn.getAttribute('data-alasan') || ''
                            };

                            document.getElementById('confirmDeleteId').value = id;
                            document.getElementById('confirmDeleteJenis').textContent = payload.jenis || '-';
                            const tMulai = toIsoDate(payload.tanggal_mulai || '');
                            const tSelesai = toIsoDate(payload.tanggal_selesai || '');
                            document.getElementById('confirmDeleteTanggal').textContent = tMulai ? (tMulai + (
                                tSelesai ? ' → ' + tSelesai : '')) : '-';
                            document.getElementById('confirmDeleteAlasan').textContent = payload.alasan || '-';
                            const delErr = document.getElementById('deleteError');
                            if (delErr) {
                                delErr.textContent = '';
                                delErr.classList.add('hidden');
                            }

                            document.getElementById('confirmDeleteModal').classList.remove('hidden');
                            setTimeout(() => document.querySelector(
                                '#confirmDeleteModal [data-action="confirm-delete"]')?.focus(), 120);
                        }

                        // Close modal (edit)
                        if (e.target.closest('[data-action="close-edit-modal"]')) {
                            document.getElementById('editCutiModal').classList.add('hidden');
                        }

                        // Close modal (delete)
                        if (e.target.closest('[data-action="close-delete-modal"]')) {
                            document.getElementById('confirmDeleteModal').classList.add('hidden');
                        }

                        // Confirm delete (from modal)
                        if (e.target.closest('[data-action="confirm-delete"]')) {
                            e.preventDefault();
                            const id = document.getElementById('confirmDeleteId').value;
                            if (!id) return;

                            (async () => {
                                try {
                                    setSubmitting(true);
                                    const res = await fetch(apiPath('/api/employee/requests/' + id), {
                                        method: 'DELETE',
                                        headers: getAuthHeaders(),
                                        credentials: 'same-origin'
                                    });
                                    if (!res.ok) {
                                        const body = await res.json().catch(() => ({}));
                                        if (res.status === 422 && body.errors) {
                                            const messages = Object.values(body.errors).flat().join(' ');
                                            const delErrEl = document.getElementById('deleteError');
                                            if (delErrEl) {
                                                delErrEl.textContent = messages || (body.message ||
                                                    'Validasi gagal');
                                                delErrEl.classList.remove('hidden');
                                            }
                                            return;
                                        }
                                        if (res.status === 401) {
                                            showAlert('error', 'Sesi tidak valid. Silakan login ulang.');
                                            window.location.href = '/login';
                                            return;
                                        }
                                        showAlert('error', body.message || 'Gagal menghapus pengajuan');
                                        return;
                                    }
                                    showToast('success', 'Pengajuan berhasil dihapus.');
                                    document.getElementById('confirmDeleteModal').classList.add('hidden');
                                    await fetchRiwayat();
                                    await fetchProfile();
                                } catch (err) {
                                    console.error(err);
                                    showAlert('error', 'Gagal menghapus pengajuan.');
                                } finally {
                                    setSubmitting(false);
                                }
                            })();
                        }

                        // Save edit
                        if (e.target.closest('[data-action="save-edit-cuti"]')) {
                            e.preventDefault();
                            const id = document.getElementById('editCutiId').value;
                            const data = {
                                jenis: document.getElementById('editJenis').value,
                                tanggal_mulai: document.getElementById('editTanggalMulai').value,
                                tanggal_selesai: document.getElementById('editTanggalSelesai').value,
                                alasan: document.getElementById('editAlasan').value,
                            };

                            (async () => {
                                try {
                                    setSubmitting(true);
                                    const res = await fetch(apiPath('/api/employee/requests/' + id), {
                                        method: 'PUT',
                                        headers: getAuthHeaders(),
                                        credentials: 'same-origin',
                                        body: JSON.stringify(data)
                                    });
                                    if (!res.ok) {
                                        const body = await res.json().catch(() => ({}));
                                        // validation errors
                                        if (res.status === 422 && body.errors) {
                                            const messages = Object.values(body.errors).flat().join(' ');
                                            showModalError(messages || (body.message || 'Validasi gagal'));
                                            return;
                                        }
                                        if (res.status === 401) {
                                            showAlert('error', 'Sesi tidak valid. Silakan login ulang.');
                                            window.location.href = '/login';
                                            return;
                                        }
                                        showAlert('error', body.message || 'Gagal mengubah pengajuan');
                                        return;
                                    }
                                    showToast('success', 'Pengajuan berhasil diubah.');
                                    document.getElementById('editCutiModal').classList.add('hidden');
                                    await fetchRiwayat();
                                    await fetchProfile();
                                } catch (err) {
                                    console.error(err);
                                    showAlert('error', 'Gagal mengubah pengajuan.');
                                } finally {
                                    setSubmitting(false);
                                }
                            })();
                        }
                    });
                }
            })();
        </script>
    @endpush

    <!-- Edit Cuti Modal (compact) -->
    <div id="editCutiModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-[720px] w-full mx-4 sm:mx-6 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Edit Pengajuan Cuti</h3>
                <button data-action="close-edit-modal" aria-label="Tutup modal"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="space-y-3">
                <input type="hidden" id="editCutiId">
                <div id="editCutiError" class="hidden"></div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Jenis Cuti</label>
                    <select id="editJenis" name="jenis"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                        <option value="">Pilih jenis cuti</option>
                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                        <option value="Cuti Sakit">Cuti Sakit</option>
                        <option value="Cuti Darurat">Cuti Darurat</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="editTanggalMulai" name="tanggal_mulai"
                            onchange="updateEditDurasi()"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="editTanggalSelesai" name="tanggal_selesai"
                            onchange="updateEditDurasi()"
                            class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Durasi</label>
                        <div id="editDurasiLabel" class="text-sm text-gray-700">-</div>
                    </div>
                    <div class="text-right text-xs text-gray-500">Catatan: durasi inklusif</div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Alasan</label>
                    <textarea id="editAlasan" rows="3" name="alasan"
                        class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm resize-none"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" data-action="save-edit-cuti"
                        class="flex-1 px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg text-sm">Simpan
                        Perubahan</button>
                    <button type="button" data-action="close-edit-modal"
                        class="flex-1 px-3 py-2 bg-white border border-gray-200 text-gray-600 font-medium rounded-lg text-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Delete Modal (compact) -->
    <div id="confirmDeleteModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 sm:mx-6 p-4 sm:p-5">
            <div class="flex items-start justify-between mb-2">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Hapus Pengajuan</h3>
                    <p class="text-sm text-gray-600 mt-1">Anda akan menghapus pengajuan berikut:</p>
                </div>
                <button data-action="close-delete-modal" aria-label="Tutup"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <input type="hidden" id="confirmDeleteId">
            <div class="space-y-2 text-sm text-gray-700">
                <div><strong>Jenis:</strong> <span id="confirmDeleteJenis">-</span></div>
                <div><strong>Tanggal:</strong> <span id="confirmDeleteTanggal">-</span></div>
                <div><strong>Alasan:</strong>
                    <div id="confirmDeleteAlasan" class="text-sm text-gray-600 mt-1">-</div>
                </div>
                <div id="deleteError"
                    class="hidden mt-2 p-2 rounded-md bg-red-50 border border-red-200 text-red-700 text-sm"></div>
            </div>
            <div class="flex gap-3 pt-4">
                <button data-action="confirm-delete"
                    class="flex-1 px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg text-sm">Hapus</button>
                <button data-action="close-delete-modal"
                    class="flex-1 px-3 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm">Batal</button>
            </div>
        </div>
    </div>

</x-app-layout>
