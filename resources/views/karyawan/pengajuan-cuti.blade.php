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

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div
            class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-red-50/80 via-slate-50/20 to-red-50/10 min-h-full">
            <!-- Welcome Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Pengajuan Cuti</h1>
                <p class="text-sm text-gray-500">Ajukan cuti tahunan, sakit, atau khusus</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Pengajuan -->
                <div
                    class="lg:col-span-2 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div
                        class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 via-slate-50/20 to-slate-50/15">
                        <h3 class="text-sm font-semibold text-gray-800">Ajukan Cuti Baru</h3>
                    </div>
                    <div class="p-6">
                        <form id="cutiForm" class="space-y-5">
                            <!-- Jenis Cuti -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Jenis Cuti</label>
                                <select id="jenis" name="jenis"
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/60 transition-all duration-300 text-sm text-gray-700">
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
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/40 focus:border-red-300/60 transition-all duration-300 text-sm resize-none text-gray-700 placeholder-gray-400"></textarea>
                            </div>

                            <!-- Info -->
                            <div
                                class="bg-gradient-to-r from-red-50/40 to-slate-50/30 border border-red-200/30 rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-1.5 bg-red-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-red-500/70" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        <span class="font-medium text-gray-700">Catatan:</span> Sisa cuti tahunan Anda
                                        <strong id="sisaCutiLabel" class="text-red-600/80">8 hari</strong>. Pastikan
                                        pengajuan tidak melebihi jumlah sisa cuti.
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="flex gap-3 pt-2">
                                <button type="submit" id="submitCuti"
                                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-400 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-500 shadow-sm hover:shadow-md transition-all duration-300 text-sm">
                                    Ajukan Cuti
                                </button>
                                <button type="reset"
                                    class="flex-1 px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>

                        <div id="cutiAlert" class="hidden mt-4"></div>

                        <!-- Debug panel for auth checks (visible only in dev) -->

                    </div>
                </div>

                <!-- Info Card -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 to-slate-50/20">
                        <h3 class="text-sm font-semibold text-gray-800">Informasi Cuti</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-2">Sisa Cuti Tahunan
                            </p>
                            <p
                                class="text-2xl font-semibold bg-gradient-to-r from-red-500/80 to-red-400/70 bg-clip-text text-transparent">
                                8 hari</p>
                            <div class="mt-3 bg-gray-100/30 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-400/60 to-red-400/50 h-2 rounded-full transition-all duration-500 shadow-sm"
                                    style="width: 67%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Digunakan 4 dari 12 hari</p>
                        </div>
                        <div class="border-t border-gray-100/50 pt-5">
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Kebijakan Cuti</p>
                            <ul class="space-y-2.5 text-xs text-gray-600">
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/70 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Pengajuan minimal 3 hari sebelumnya</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/70 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Max 5 hari dalam satu pengajuan</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/70 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Approval dari direktur</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-400/70 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Cuti tidak bisa dibatalkan 1 hari sebelumnya</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pengajuan Cuti -->
            <div
                class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div
                    class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 via-slate-50/20 to-red-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Cuti</h3>
                </div>
                <div id="riwayatList" class="divide-y divide-gray-100/50">
                    <!-- Item 1 - Approved -->
                    <div
                        class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Cuti Tahunan</p>
                                        <p class="text-xs text-gray-500 mt-0.5">3 hari • 10 - 12 Januari 2026</p>
                                    </div>
                                    <span
                                        class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diproses oleh: Direktur • 7 Januari 2026</p>
                                <button
                                    class="text-xs text-red-600/90 hover:text-red-700 font-medium transition-colors">Lihat
                                    Detail →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 - Pending -->
                    <div
                        class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Cuti Sakit</p>
                                        <p class="text-xs text-gray-500 mt-0.5">1 hari • 5 Januari 2026</p>
                                    </div>
                                    <span
                                        class="px-2.5 py-0.5 bg-red-50/70 text-red-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Menunggu</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: 4 Januari 2026</p>
                                <div class="flex gap-3">
                                    <button
                                        class="text-xs text-red-600/90 hover:text-red-700 font-medium transition-colors">Lihat
                                        Detail →</button>
                                    <button
                                        class="text-xs text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Batalkan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 - Rejected -->
                    <div
                        class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Cuti Khusus</p>
                                        <p class="text-xs text-gray-500 mt-0.5">2 hari • 2 - 3 Januari 2026</p>
                                    </div>
                                    <span
                                        class="px-2.5 py-0.5 bg-red-50/70 text-red-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Ditolak</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Alasan: Bentrok dengan jadwal rapat penting</p>
                                <div class="flex gap-3">
                                    <button
                                        class="text-xs text-red-600/90 hover:text-red-700 font-medium transition-colors">Lihat
                                        Detail →</button>
                                    <button
                                        class="text-xs text-red-600/90 hover:text-red-700 font-medium transition-colors">Ajukan
                                        Ulang</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 - Approved -->
                    <div
                        class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Cuti Tahunan</p>
                                        <p class="text-xs text-gray-500 mt-0.5">5 hari • 16 - 20 Desember 2025</p>
                                    </div>
                                    <span
                                        class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diproses oleh: Direktur • 10 Desember 2025</p>
                                <button
                                    class="text-xs text-red-600/90 hover:text-red-700 font-medium transition-colors">Lihat
                                    Detail →</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            (async function() {
                const form = document.getElementById('cutiForm');
                const alertBox = document.getElementById('cutiAlert');
                const submitBtn = document.getElementById('submitCuti');

                // Spinner element
                const submitSpinner = document.createElement('span');
                submitSpinner.className =
                    'hidden ms-3 inline-block w-4 h-4 border-2 border-t-2 border-gray-200 rounded-full animate-spin';
                submitBtn.parentNode.insertBefore(submitSpinner, submitBtn.nextSibling);

                function setSubmitting(isSubmitting) {
                    if (isSubmitting) {
                        submitBtn.setAttribute('disabled', 'disabled');
                        submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
                        submitSpinner.classList.remove('hidden');
                    } else {
                        submitBtn.removeAttribute('disabled');
                        submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                        submitSpinner.classList.add('hidden');
                    }
                }

                // Get API token from session and store in localStorage
                async function ensureApiToken() {
                    let token = window.localStorage ? window.localStorage.getItem('api_token') : null;
                    if (token) return token;

                    try {
                        console.debug('[cuti] Requesting /session/api-token');
                        const tokenRes = await fetch('/session/api-token', {
                            credentials: 'same-origin'
                        });
                        console.debug('[cuti] session token response', tokenRes.status);
                        if (tokenRes.ok) {
                            const json = await tokenRes.json();
                            console.debug('[cuti] received session api token', json.token ? 'OK' : 'missing');
                            if (window.localStorage) window.localStorage.setItem('api_token', json.token);
                            return json.token;
                        } else {
                            console.debug('[cuti] session api token not granted (status)', tokenRes.status);
                            return null;
                        }
                    } catch (e) {
                        console.debug('[cuti] session api token not available', e);
                        return null;
                    }
                }

                // Helper to get auth headers
                function getAuthHeaders() {
                    const token = window.localStorage ? window.localStorage.getItem('api_token') : null;
                    const headers = {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    };
                    if (token) {
                        headers['Authorization'] = 'Bearer ' + token;
                    }
                    // Add CSRF token for web routes
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrfToken) {
                        headers['X-CSRF-TOKEN'] = csrfToken;
                    }
                    return headers;
                }

                function showAlert(type, message) {
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

                // Fetch and render riwayat from server
                async function fetchRiwayat(page = 1) {
                    function formatDate(d, withTime = false) {
                        if (!d) return '';
                        const dt = new Date(d);
                        if (isNaN(dt)) return d;
                        if (withTime) return dt.toLocaleString('id-ID', {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        return dt.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    }

                    function truncate(str, n = 140) {
                        if (!str) return '';
                        return str.length > n ? str.slice(0, n) + '…' : str;
                    }

                    try {
                        const resp = await fetch('/karyawan/api/requests?page=' + page, {
                            credentials: 'same-origin',
                            headers: getAuthHeaders()
                        });
                        if (!resp.ok) throw new Error('Failed to fetch riwayat');
                        const json = await resp.json();
                        const items = json.data || json;
                        const container = document.getElementById('riwayatList');
                        if (!container) return;

                        container.innerHTML = '';
                        if (!items || !items.length) {
                            container.innerHTML =
                                '<div class="px-6 py-4 text-xs text-gray-400">Belum ada pengajuan.</div>';
                            // also refresh displayed sisa cuti in case approvals happened
                            await fetchProfile().catch(() => {});
                            return;
                        }

                        items.forEach(i => {
                            const status = i.status || 'Pending';
                            const statusMap = {
                                'Disetujui': 'bg-green-100 text-green-800 ring-1 ring-green-100',
                                'Ditolak': 'bg-red-100 text-red-800 ring-1 ring-red-100',
                                'Pending': 'bg-yellow-100 text-yellow-800 ring-1 ring-yellow-100'
                            };
                            const statusClass = statusMap[status] ||
                                'bg-gray-100 text-gray-800 ring-1 ring-gray-100';

                            // badge with small icon
                            const badgeIcon = status === 'Disetujui' ? `
                                        <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 6.293a1 1 0 00-1.414-1.414L8 12.172 4.707 8.879a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8z" clip-rule="evenodd"/></svg>
                                    ` : status === 'Ditolak' ? `
                                        <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    ` : `
                                        <svg class="w-3 h-3 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    `;

                            const badgeHtml =
                                `<span class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-xs font-semibold shadow-sm ${statusClass}">${badgeIcon}<span>${status}</span></span>`;

                            // icon per status
                            const iconHtml = status === 'Disetujui' ? `
                                        <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </div>
                                    ` : status === 'Ditolak' ? `
                                        <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </div>
                                    ` : `
                                        <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                    `;

                            let durasi = i.durasi_hari || 1;
                            if (!i.durasi_hari && i.tanggal_mulai && i.tanggal_selesai) {
                                const a = new Date(i.tanggal_mulai);
                                const b = new Date(i.tanggal_selesai);
                                durasi = Math.floor((b - a) / (24 * 3600 * 1000)) + 1;
                            }

                            const tanggalMulai = formatDate(i.tanggal_mulai);
                            const tanggalSelesai = formatDate(i.tanggal_selesai);
                            const createdAt = formatDate(i.created_at, true);
                            const alasanShort = truncate(i.alasan || '', 140);
                            const detailId = 'cuti-detail-' + (i.id || Math.random().toString(36).slice(2,
                                9));

                            const itemId = 'cuti-item-' + (i.id || Math.random().toString(36).slice(2, 9));
                            const div = document.createElement('div');
                            div.id = itemId;
                            div.className = 'mb-3';
                            div.innerHTML = `
                                <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-start gap-4">
                                        ${iconHtml}
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-800">${i.jenis}</p>
                                                    <p class="text-xs text-gray-500 mt-1">${durasi} hari • ${tanggalMulai}${tanggalSelesai ? ' - ' + tanggalSelesai : ''}</p>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    ${badgeHtml}
                                                    ${status === 'Pending' ? `
                                                                        <div class="flex items-center gap-2">
                                                                            <button data-action="edit" data-id="${i.id}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-200">
                                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/></svg>
                                                                                <span>Ubah</span>
                                                                            </button>
                                                                            <button data-action="cancel" data-id="${i.id}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-700 hover:bg-red-100 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                                                <span>Batalkan</span>
                                                                            </button>
                                                                        </div>
                                                                    ` : ''}
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-700 mt-3">${alasanShort} ${i.alasan && (i.alasan || '').length > 140 ? `<a href="#" data-toggle="${detailId}" class="text-sm text-indigo-600 hover:underline">Lihat</a>` : ''}</p>
                                            <div id="${detailId}" class="hidden mt-2 text-sm text-gray-700 border-l-2 border-gray-100 pl-3">${(i.alasan || '').replace(/\n/g, '<br>')}</div>
                                            <div class="mt-3 text-xs text-gray-400">Diajukan: ${createdAt}</div>
                                        </div>
                                    </div>
                                </div>`;

                            container.appendChild(div);
                        });
                        // after rendering, refresh profile (sisa cuti)
                        await fetchProfile().catch(() => {});
                    } catch (err) {
                        console.debug('[cuti] fetchRiwayat error', err);
                        const container = document.getElementById('riwayatList');
                        if (container) {
                            container.innerHTML =
                                '<div class="px-6 py-4 text-xs text-red-400">Gagal memuat riwayat.</div>';
                        }
                    }
                }

                // delegated click handler (toggle details, edit, cancel)
                document.addEventListener('click', async function(e) {
                    const t = e.target;
                    if (!t || !t.dataset) return;

                    // detail toggle
                    const toggle = t.dataset.toggle;
                    if (toggle) {
                        e.preventDefault();
                        const el = document.getElementById(toggle);
                        if (el) el.classList.toggle('hidden');
                        return;
                    }

                    const action = t.dataset.action;
                    const id = t.dataset.id;
                    if (!action || !id) return;

                    // cancel (open confirmation modal)
                    if (action === 'cancel') {
                        openCancelModal(id);
                        return;
                    }

                    // edit (open modal)
                    if (action === 'edit') {
                        const item = document.getElementById('cuti-item-' + id);
                        if (!item) return;
                        // fetch current data (could use cached data; fetch single)
                        try {
                            const resp = await fetch('/karyawan/api/requests?page=1', {
                                credentials: 'same-origin',
                                headers: getAuthHeaders()
                            });
                            if (!resp.ok) throw resp;
                            const json = await resp.json();
                            const items = json.data || json;
                            const record = items.find(r => String(r.id) === String(id));
                            if (!record) {
                                showAlert('error', 'Data tidak ditemukan.');
                                return;
                            }

                            // open edit modal populated with record
                            openEditModal(record);
                        } catch (err) {
                            console.debug('edit fetch error', err);
                            showAlert('error', 'Gagal menyiapkan form edit.');
                        }
                        return;
                    }

                    // cancel-edit (remove inline edit)
                    if (action === 'cancel-edit') {
                        const item = document.getElementById('cuti-item-' + id);
                        if (!item) return;
                        const existing = item.querySelector('.edit-block');
                        if (existing) existing.remove();
                        return;
                    }
                });

                // Fetch user profile (to update sisa cuti label)
                async function fetchProfile() {
                    try {
                        const res = await fetch('/karyawan/api/profile', {
                            credentials: 'same-origin',
                            headers: getAuthHeaders()
                        });
                        if (!res.ok) throw res;
                        const json = await res.json();
                        const sisaEl = document.getElementById('sisaCutiLabel');
                        if (sisaEl) sisaEl.textContent = (json.sisa_cuti !== undefined ? json.sisa_cuti : '0') +
                            ' hari';
                        if (window.localStorage) {
                            if (json.sisa_cuti !== undefined) window.localStorage.setItem('sisa_cuti', String(json
                                .sisa_cuti));
                            if (json.cuti_entitlement !== undefined) window.localStorage.setItem('cuti_entitlement',
                                String(json.cuti_entitlement));
                            if (json.cuti_used !== undefined) window.localStorage.setItem('cuti_used', String(json
                                .cuti_used));
                        }
                        return json;
                    } catch (err) {
                        console.debug('[cuti] fetchProfile error', err);
                    }
                }

                // Form submit handler
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const data = {
                        jenis: document.getElementById('jenis').value,
                        tanggal_mulai: document.getElementById('tanggal_mulai').value,
                        tanggal_selesai: document.getElementById('tanggal_selesai').value,
                        alasan: document.getElementById('alasan').value,
                    };

                    try {
                        setSubmitting(true);

                        // Ensure CSRF cookie
                        await fetch('/sanctum/csrf-cookie', {
                            credentials: 'same-origin'
                        });

                        // Ensure API token
                        const token = await ensureApiToken();
                        console.debug('[cuti] api token after ensure:', token ? 'present' : 'missing');

                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');
                        const headers = {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        };
                        if (token) headers['Authorization'] = 'Bearer ' + token;

                        const res = await fetch('/karyawan/api/requests', {
                            method: 'POST',
                            headers,
                            credentials: 'same-origin',
                            body: JSON.stringify(data)
                        });

                        if (!res.ok) {
                            // Handle 401 with retry
                            if (res.status === 401) {
                                try {
                                    const tokenRes = await fetch('/session/api-token', {
                                        credentials: 'same-origin'
                                    });
                                    if (tokenRes.ok) {
                                        const tokenJson = await tokenRes.json();
                                        if (window.localStorage) window.localStorage.setItem('api_token',
                                            tokenJson.token);
                                        headers['Authorization'] = 'Bearer ' + tokenJson.token;

                                        const retry = await fetch('/karyawan/api/requests', {
                                            method: 'POST',
                                            headers,
                                            credentials: 'same-origin',
                                            body: JSON.stringify(data)
                                        });

                                        if (!retry.ok) {
                                            if (retry.status === 401) {
                                                showAlert('error',
                                                    'Sesi tidak valid. Silakan <a href="/login" class="underline">login</a> kembali.'
                                                );
                                                return;
                                            }
                                            const e1 = await retry.json().catch(() => ({
                                                message: 'Terjadi kesalahan'
                                            }));
                                            showAlert('error', e1.message || (e1.errors ? Object.values(e1
                                                .errors).flat().join('<br>') : 'Validasi gagal'));
                                            return;
                                        }
                                        // Success after retry
                                        await fetchRiwayat();
                                        showAlert('success',
                                            '✅ Pengajuan cuti berhasil dikirim. Menunggu persetujuan.');
                                        form.reset();
                                        // refresh profile (sisa cuti) just in case
                                        await fetchProfile().catch(() => {});
                                        return;
                                    }
                                } catch (e) {
                                    console.debug('[cuti] Retry token fetch failed', e);
                                }
                                showAlert('error',
                                    'Anda belum terautentikasi. Silakan login dan coba lagi.');
                                return;
                            }

                            const err = await res.json().catch(() => ({
                                message: 'Terjadi kesalahan'
                            }));
                            showAlert('error', err.message || (err.errors ? Object.values(err.errors).flat()
                                .join('<br>') : 'Validasi gagal'));
                            return;
                        }

                        // Success
                        await fetchRiwayat();
                        showAlert('success', '✅ Pengajuan cuti berhasil dikirim. Menunggu persetujuan.');
                        form.reset();
                        // refresh profile (sisa cuti)
                        await fetchProfile().catch(() => {});
                    } catch (err) {
                        console.error('[cuti] Form submit error:', err);
                        showAlert('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
                    } finally {
                        setSubmitting(false);
                    }
                });

                // Initial load: ensure token, fetch profile and riwayat
                await ensureApiToken();
                await fetchProfile();
                await fetchRiwayat();

                // periodic refresh of profile (sisa cuti) and riwayat
                setInterval(async function() {
                    await fetchProfile().catch(() => {});
                }, 60 * 1000);

                // Debug panel

                let currentEditRecord = null;
                let currentCancelId = null;

                function openEditModal(record) {
                    currentEditRecord = record;
                    document.getElementById('editModal').classList.remove('hidden');
                    document.getElementById('modalEditJenis').value = record.jenis || '';
                    document.getElementById('modalEditTanggalMulai').value = record.tanggal_mulai ? record.tanggal_mulai
                        .split('T')[0] : '';
                    document.getElementById('modalEditTanggalSelesai').value = record.tanggal_selesai ? record
                        .tanggal_selesai.split('T')[0] : '';
                    document.getElementById('modalEditAlasan').value = record.alasan || '';
                    document.getElementById('modalEditSaveBtn').disabled = false;
                    document.getElementById('modalEditJenis').focus();
                }

                function closeEditModal() {
                    currentEditRecord = null;
                    document.getElementById('editModal').classList.add('hidden');
                }

                async function submitEditModal() {
                    if (!currentEditRecord) return;
                    const id = currentEditRecord.id;
                    const jenis = document.getElementById('modalEditJenis').value;
                    const tanggal_mulai = document.getElementById('modalEditTanggalMulai').value;
                    const tanggal_selesai = document.getElementById('modalEditTanggalSelesai').value;
                    const alasan = document.getElementById('modalEditAlasan').value;
                    if (!jenis || !tanggal_mulai || !tanggal_selesai || alasan.trim().length < 5) {
                        showAlert('error', 'Isi semua field dan alasan minimal 5 karakter');
                        return;
                    }
                    try {
                        const headers = getAuthHeaders();
                        headers['Content-Type'] = 'application/json';
                        const resp = await fetch('/karyawan/api/requests/' + id, {
                            method: 'PUT',
                            credentials: 'same-origin',
                            headers,
                            body: JSON.stringify({
                                jenis,
                                tanggal_mulai,
                                tanggal_selesai,
                                alasan
                            })
                        });
                        if (!resp.ok) {
                            const json = await resp.json().catch(() => ({
                                message: 'Gagal menyimpan'
                            }));
                            showAlert('error', json.message || 'Gagal menyimpan perubahan.');
                            return;
                        }
                        closeEditModal();
                        showAlert('success', 'Perubahan tersimpan.');
                        await fetchRiwayat();
                        await fetchProfile().catch(() => {});
                    } catch (err) {
                        console.error('submitEditModal error', err);
                        showAlert('error', 'Gagal menyimpan perubahan.');
                    }
                }

                function openCancelModal(id) {
                    currentCancelId = id;
                    document.getElementById('cancelModal').classList.remove('hidden');
                    document.getElementById('cancelReason').value = '';
                    document.getElementById('cancelConfirmBtn').disabled = false;
                }

                function closeCancelModal() {
                    currentCancelId = null;
                    document.getElementById('cancelModal').classList.add('hidden');
                }

                async function submitCancelModal() {
                    if (!currentCancelId) return;
                    const reason = document.getElementById('cancelReason').value.trim();
                    try {
                        const headers = getAuthHeaders();
                        headers['Content-Type'] = 'application/json';
                        if (reason) headers['X-Cancel-Reason'] = reason;
                        const resp = await fetch('/karyawan/api/requests/' + currentCancelId, {
                            method: 'DELETE',
                            credentials: 'same-origin',
                            headers
                        });
                        if (!resp.ok) {
                            const json = await resp.json().catch(() => ({
                                message: 'Gagal'
                            }));
                            showAlert('error', json.message || 'Gagal membatalkan pengajuan.');
                            return;
                        }
                        closeCancelModal();
                        showAlert('success', 'Pengajuan dibatalkan.');
                        const el = document.getElementById('cuti-item-' + currentCancelId);
                        if (el) el.remove();
                        await fetchProfile().catch(() => {});
                        await fetchRiwayat();
                    } catch (err) {
                        console.error('submitCancelModal error', err);
                        showAlert('error', 'Gagal membatalkan pengajuan.');
                    }
                }

                // Expose modal helpers globally so inline onclick attributes work
                window.openEditModal = openEditModal;
                window.closeEditModal = closeEditModal;
                window.submitEditModal = submitEditModal;
                window.openCancelModal = openCancelModal;
                window.closeCancelModal = closeCancelModal;
                window.submitCancelModal = submitCancelModal;




                async function refreshSessionToken(showToast = true) {
                    try {
                        const tokenRes = await fetch('/session/api-token', {
                            credentials: 'same-origin'
                        });
                        if (tokenRes.ok) {
                            const json = await tokenRes.json();
                            if (window.localStorage) window.localStorage.setItem('api_token', json.token);
                            if (showToast) showAlert('success', 'Token session berhasil diperoleh.');
                        } else {
                            if (showToast) showAlert('error', 'Tidak dapat mengambil token session: ' + tokenRes
                                .status);
                        }
                    } catch (e) {
                        if (showToast) showAlert('error', 'Gagal menghubungi server untuk token session.');
                        console.debug('[cuti] session token fetch error', e);
                    }
                }

                // debug buttons removed in production


            })();
        </script>

        <!-- Edit Modal -->
        <div id="editModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Ubah Pengajuan</h3>
                    </div>
                    <button onclick="closeEditModal()" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-xs text-gray-500">Jenis</label>
                        <select id="modalEditJenis" class="w-full mt-1 px-3 py-2 border rounded-lg">
                            <option value="">Pilih jenis</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                            <option value="Cuti Darurat">Cuti Darurat</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500">Tanggal Mulai</label>
                            <input id="modalEditTanggalMulai" type="date"
                                class="w-full mt-1 px-3 py-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500">Tanggal Selesai</label>
                            <input id="modalEditTanggalSelesai" type="date"
                                class="w-full mt-1 px-3 py-2 border rounded-lg">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500">Alasan</label>
                        <textarea id="modalEditAlasan" rows="4" class="w-full mt-1 px-3 py-2 border rounded-lg"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeEditModal()"
                        class="px-4 py-2 rounded-lg bg-white border text-gray-700">Batal</button>
                    <button id="modalEditSaveBtn" onclick="submitEditModal()"
                        class="px-4 py-2 rounded-lg bg-green-600 text-white">Simpan</button>
                </div>
            </div>
        </div>

        <!-- Cancel Confirmation Modal -->
        <div id="cancelModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold">Batalkan Pengajuan</h3>
                    </div>
                    <button onclick="closeCancelModal()" class="text-gray-500 hover:text-gray-700">✕</button>
                </div>
                <div class="p-6 space-y-3">
                    <p class="text-sm text-gray-600">Masukkan alasan pembatalan (opsional):</p>
                    <textarea id="cancelReason" rows="3" class="w-full mt-1 px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div class="px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeCancelModal()"
                        class="px-4 py-2 rounded-lg bg-white border text-gray-700">Batal</button>
                    <button id="cancelConfirmBtn" onclick="submitCancelModal()"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white">Konfirmasi</button>
                </div>
            </div>
        </div>

</x-app-layout>
