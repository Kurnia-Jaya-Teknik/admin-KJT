<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ijin Sakit
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Toast container -->
    <div id="ijinToast" class="fixed top-6 right-6 z-50 hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50 min-h-full">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="relative overflow-hidden rounded-2xl shadow-sm mb-6 border-0">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-600 via-red-500 to-gray-600"></div>
                    <div class="absolute top-0 right-0 w-80 h-80 bg-white/8 rounded-full -mr-40 -mt-40 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-white/4 rounded-full -ml-32 -mb-32 blur-3xl"></div>
                    <div class="relative px-8 py-6 md:py-8">
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Ijin Sakit</h1>
                        <p class="text-white/85 text-sm md:text-base font-normal">Ajukan ijin sakit dengan lampiran <span class="font-semibold text-white">surat dokter</span> yang sah.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                <div class="px-8 py-6 border-b border-gray-200/30 bg-gradient-to-r from-red-50/80 via-red-50/50 to-gray-50/30">
                    <h2 class="text-lg font-semibold text-gray-800">Formulir Pengajuan Ijin Sakit</h2>
                </div>
                <div class="p-8">
                    <form id="ijinForm" class="space-y-6" enctype="multipart/form-data">
                        <div id="ijinAlert" class="hidden"></div>

                        <div class="text-base text-gray-700 mb-6 p-4 rounded-xl bg-red-50/40 border border-red-200/30">
                            <p class="font-medium text-gray-800">Yang bertanda tangan di bawah ini:</p>
                        </div>

                        <!-- User Info - Display only -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-200/30">
                            <div>
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2 block">Nama Karyawan</label>
                                <div class="px-4 py-3 rounded-lg bg-gray-50/80 border border-gray-200/50 text-base font-medium text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2 block">Jabatan / Divisi</label>
                                <div class="px-4 py-3 rounded-lg bg-gray-50/80 border border-gray-200/50 text-base font-medium text-gray-800">
                                    {{ auth()->user()->departemen->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Hidden jenis = Ijin Sakit --}}
                        <input type="hidden" name="jenis" value="Ijin Sakit">

                        <!-- Periode Ijin Sakit -->
                        <div class="pt-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                Periode Ijin Sakit
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2 block">Tanggal Mulai</label>
                                    <input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                        class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base bg-white/60 focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-200/30 transition-all duration-200 font-medium text-gray-800">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2 block">Tanggal Selesai</label>
                                    <input id="tanggal_selesai" name="tanggal_selesai" type="date"
                                        class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base bg-white/60 focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-200/30 transition-all duration-200 font-medium text-gray-800">
                                </div>
                            </div>

                            <div id="tanggal-error" class="text-red-500/80 text-sm mt-3 hidden font-medium"></div>
                        </div>

                        <!-- Keterangan -->
                        <div class="pt-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                Keterangan / Alasan
                            </h3>
                            <textarea id="alasan" name="alasan" rows="4" placeholder="Uraikan kondisi kesehatan dan alasan pengajuan ijin sakit..."
                                class="w-full px-4 py-3 border border-gray-300/60 rounded-lg text-base bg-white/60 focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-200/30 transition-all duration-200 resize-none font-normal text-gray-800 placeholder-gray-400"></textarea>
                        </div>

                        <!-- Lampiran (Surat Dokter) -->
                        <div class="pt-6 border-t border-gray-200/30">
                            <h3 class="text-base font-semibold text-gray-800 mb-4">
                                Upload Surat Dokter <span class="text-red-500 text-sm font-bold">(WAJIB)</span>
                            </h3>
                            <p class="text-sm text-gray-500 mb-4">Upload file surat keterangan dari dokter (PDF atau gambar). File maksimal 10 MB.</p>
                            <div class="flex items-center gap-4 p-4 rounded-lg bg-red-50/40 border-2 border-dashed border-red-300/50 hover:border-red-400/70 transition-all duration-300 cursor-pointer group"
                                onclick="document.getElementById('bukti').click()">
                                <div class="w-12 h-12 rounded-lg bg-red-500/15 flex items-center justify-center group-hover:bg-red-500/25 transition-colors">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-base font-medium text-gray-800">
                                        <span id="buktiName">Klik atau drag file surat dokter di sini</span>
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">Tipe: PDF, JPG, PNG | Max: 10 MB</p>
                                </div>
                                <input type="file" id="bukti" name="bukti" accept="image/*,.pdf" required
                                    class="sr-only" />
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="pt-6 border-t border-gray-200/30">
                            <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2 block">Telepon Yang Bisa Dihubungi</label>
                            <input type="tel" id="telp" name="telp"
                                placeholder="Contoh: 081234567890"
                                value="{{ old('telp', auth()->user()->phone ?? '') }}"
                                class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base bg-white/60 focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-200/30 transition-all duration-200 font-medium text-gray-800" />
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200/30">
                            <button type="submit" id="submitIjin"
                                class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 active:scale-95 text-white font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-300 text-base">
                                Ajukan Ijin Sakit
                            </button>
                            <button type="reset"
                                class="flex-1 px-4 py-3 bg-gray-200/80 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300 text-base">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Pengajuan Ijin Sakit -->
            <div
                class="mt-10 bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                <div
                    class="px-8 py-5 border-b border-gray-200/30 bg-gradient-to-r from-red-50/80 via-red-50/50 to-gray-50/30">
                    <h3 class="text-lg font-semibold text-gray-800">
                        Riwayat Pengajuan Ijin Sakit
                    </h3>
                </div>
                <div id="riwayatList" class="divide-y divide-gray-100/50"></div>
                <div id="riwayatPagination"
                    class="px-8 py-4 border-t border-gray-200/30 flex items-center justify-center gap-2 bg-gray-50/50"></div>
            </div>

            <!-- Detail Modal -->
            <div id="detailModal" class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center p-4 backdrop-blur-sm">
                <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 max-w-2xl w-full animate-in fade-in zoom-in-95 duration-300 max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="sticky top-0 px-8 py-6 border-b border-red-800/20 bg-gradient-to-r from-red-600 to-red-700 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div id="detailStatusBg" class="w-12 h-12 rounded-lg bg-white/20 border border-white/30 flex items-center justify-center text-2xl"></div>
                            <div>
                                <p class="text-sm text-white/80 font-medium">Status Pengajuan</p>
                                <p id="detailStatus" class="text-lg font-bold text-white">Menunggu</p>
                            </div>
                        </div>
                        <button onclick="closeDetailModal()" type="button" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/20 text-white/90 hover:text-white transition-all duration-200 backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="px-8 py-8 space-y-6">
                        <!-- Periode -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-4 rounded-xl bg-red-50/40 border border-red-200/30">
                                <p class="text-xs text-red-600 font-semibold uppercase tracking-wide mb-2">Tanggal Mulai</p>
                                <p id="detailTanggalMulai" class="text-base font-semibold text-gray-800">-</p>
                            </div>
                            <div class="p-4 rounded-xl bg-red-50/40 border border-red-200/30">
                                <p class="text-xs text-red-600 font-semibold uppercase tracking-wide mb-2">Tanggal Selesai</p>
                                <p id="detailTanggalSelesai" class="text-base font-semibold text-gray-800">-</p>
                            </div>
                            <div class="p-4 rounded-xl bg-red-50/40 border border-red-200/30">
                                <p class="text-xs text-red-600 font-semibold uppercase tracking-wide mb-2">Durasi</p>
                                <p id="detailDurasi" class="text-base font-semibold text-gray-800">-</p>
                            </div>
                        </div>

                        <!-- Alasan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Alasan / Keterangan</label>
                            <div class="p-4 rounded-xl bg-gray-50/60 border border-gray-200/50">
                                <p id="detailAlasan" class="text-base text-gray-700 leading-relaxed whitespace-pre-wrap">-</p>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Nomor Telepon</label>
                            <div class="p-4 rounded-xl bg-gray-50/60 border border-gray-200/50">
                                <p id="detailTelp" class="text-base text-gray-700 font-medium">-</p>
                            </div>
                        </div>

                        <!-- Surat Dokter -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Surat Dokter</label>
                            <button id="detailBuktiBtn" type="button" class="hidden w-full px-6 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Lihat Surat Dokter
                            </button>
                            <div class="p-4 rounded-xl bg-gray-50/60 border border-gray-200/50 hidden" id="detailBuktiEmpty">
                                <p class="text-base text-gray-500 text-center">Tidak ada surat dokter</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="sticky bottom-0 px-8 py-5 border-t border-gray-200 bg-gray-50/80 flex items-center justify-end gap-3">
                        <button type="button" onclick="closeDetailModal()" class="flex items-center gap-2 px-6 py-3 rounded-xl border-2 border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md text-base">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                const API_BASE_RAW = "{{ rtrim(request()->getSchemeAndHttpHost() . request()->getBaseUrl(), '/') }}";
                const API_BASE = (API_BASE_RAW && API_BASE_RAW.indexOf('{{') === -1) ? API_BASE_RAW : (window.location
                    .origin + window.location.pathname.replace(/\/[^\/]*$/, ''));

                function apiPath(path) {
                    if (path.startsWith('/api/') || path.startsWith('/session/')) return window.location.origin + path;
                    return API_BASE + path;
                }

                function getAuthHeaders() {
                    const token = window.localStorage ? window.localStorage.getItem('api_token') : null;
                    const headers = {};
                    if (token) headers['Authorization'] = 'Bearer ' + token;
                    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    if (csrf) headers['X-CSRF-TOKEN'] = csrf;
                    return headers;
                }

                // File input UI handling for lampiran
                const buktiInput = document.getElementById('bukti');
                const buktiName = document.getElementById('buktiName');
                const buktiLabel = document.getElementById('buktiLabel');
                if (buktiInput) {
                    buktiInput.addEventListener('change', function(e) {
                        const file = this.files && this.files[0];
                        if (!file) {
                            buktiName.textContent = 'Belum ada file dipilih';
                            return;
                        }
                        // simple validation
                        const maxBytes = 10 * 1024 * 1024; // 10MB
                        const ext = (file.name.split('.').pop() || '').toLowerCase();
                        const allowed = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'pdf'];
                        if (file.size > maxBytes) {
                            buktiName.textContent = '❌ File terlalu besar (max 10MB)';
                            this.value = '';
                            return;
                        }
                        if (!allowed.includes(ext)) {
                            buktiName.textContent = '❌ Tipe file tidak didukung';
                            this.value = '';
                            return;
                        }
                        buktiName.textContent = file.name;
                    });

                    // clicking the label should open file dialog; label already points to input via for="#bukti"
                }

                function showToast(type, message) {
                    const div = document.createElement('div');
                    div.className =
                        'max-w-sm w-full bg-white shadow-lg rounded-xl p-4 border flex items-start gap-3 animate-in fade-in';
                    div.innerHTML =
                        `<div class="w-3 h-3 mt-1 rounded-full flex-shrink-0 ${type==='success'?'bg-emerald-500':'bg-red-500'}"></div><div><p class="font-medium text-sm text-gray-800">${message}</p></div>`;
                    const toastContainer = document.getElementById('ijinToast');
                    toastContainer.appendChild(div);
                    toastContainer.classList.remove('hidden');
                    setTimeout(() => {
                        div.remove();
                        if (!toastContainer.children.length) toastContainer.classList.add('hidden');
                    }, 4500);
                }

                function showAlert(type, message) {
                    const el = document.getElementById('ijinAlert');
                    if (!el) return showToast(type, message);
                    el.className = '';
                    el.classList.add('mt-4', 'p-4', 'rounded-lg', 'border', 'text-sm', 'font-medium');
                    if (type === 'success') {
                        el.classList.add('bg-emerald-50/80', 'border-emerald-200/50', 'text-emerald-700');
                    } else {
                        el.classList.add('bg-red-50/80', 'border-red-200/50', 'text-red-700');
                    }
                    el.innerHTML = message;
                    el.classList.remove('hidden');
                    setTimeout(() => {
                        el.classList.add('hidden');
                    }, 6000);
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

                function setSubmitting(s) {
                    const btn = document.getElementById('submitIjin');
                    if (!btn) return;
                    if (s) {
                        btn.setAttribute('disabled', 'disabled');
                        btn.classList.add('opacity-60', 'cursor-not-allowed');
                    } else {
                        btn.removeAttribute('disabled');
                        btn.classList.remove('opacity-60', 'cursor-not-allowed');
                    }
                }



                // Fetch riwayat pengajuan ijin sakit
                async function fetchRiwayat(page = 1) {
                    const container = document.getElementById('riwayatList');
                    const paginationEl = document.getElementById('riwayatPagination');

                    if (!container) return;

                    try {
                        await ensureApiToken();
                        const headers = getAuthHeaders();
                        const res = await fetch(apiPath(`/api/employee/requests?page=${page}&type=Ijin%20Sakit`), {
                            credentials: 'same-origin',
                            headers
                        });
                        if (!res.ok) throw new Error('Gagal memuat riwayat');

                        const data = await res.json();
                        const requests = data.data || [];
                        const pagination = data.meta || {};

                        // render items
                        container.innerHTML = requests.map(i => {
                            const itemId = 'riwayat-item-' + (i.id || Math.random().toString(36).slice(2, 9));
                            const st = (i.status || '').toString().toLowerCase();
                            const isPending = (st === 'pending' || st === 'menunggu');
                            const statusColor = st === 'disetujui' ? 'emerald' : isPending ? 'amber' : 'red';
                            const statusBg = st === 'disetujui' ? 'bg-emerald-50/60' : isPending ? 'bg-amber-50/60' : 'bg-red-50/60';
                            const statusBorder = st === 'disetujui' ? 'border-emerald-200/50' : isPending ? 'border-amber-200/50' : 'border-red-200/50';
                            const statusIcon = st === 'disetujui' ? '✓' : isPending ? '⏳' : '✕';
                            const statusLabel = st === 'disetujui' ? 'Disetujui' : isPending ? 'Menunggu' :
                                'Ditolak';
                            const tanggalMulai = i.tanggal_mulai ? new Date(i.tanggal_mulai).toLocaleDateString(
                                'id-ID') : '-';
                            const tanggalSelesai = i.tanggal_selesai ? new Date(i.tanggal_selesai)
                                .toLocaleDateString('id-ID') : '-';

                            return `<div id="${itemId}" class="bg-white/60 backdrop-blur-sm p-5 hover:bg-white/90 transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl ${statusBg} ${statusBorder} border flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 text-lg font-semibold text-${statusColor}-600">
                                        ${statusIcon}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-3 mb-2">
                                            <div>
                                                <p class="text-base font-semibold text-gray-800">Ijin Sakit</p>
                                                <p class="text-sm text-gray-500 mt-1">${tanggalMulai} – ${tanggalSelesai}</p>
                                            </div>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-${statusColor}-100/70 text-${statusColor}-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">${statusLabel}</span>
                                        </div>
                                        <p class="text-base text-gray-600 mb-3 line-clamp-2">${i.alasan || '-'}</p>
                                        <button type="button" class="btn-detail px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-200 shadow-sm hover:shadow-md bg-red-600 text-white hover:bg-red-700" data-ijin-id="${i.id}" data-ijin-data='${JSON.stringify(i)}'>Lihat Detail</button>
                                    </div>
                                </div>
                            </div>`;
                        }).join('');

                        // render pagination
                        if (pagination && pagination.last_page > 1) {
                            const buttons = [];
                            for (let p = 1; p <= pagination.last_page; p++) {
                                buttons.push(
                                    `<button class="px-3 py-2 rounded-lg font-medium text-sm transition-all duration-300 ${p === page ? 'bg-gradient-to-r from-red-600 to-rose-600 text-white shadow-md hover:shadow-lg' : 'border border-gray-300/60 text-gray-600 hover:bg-gray-100 hover:border-gray-400'}" data-page="${p}">${p}</button>`
                                    );
                            }
                            paginationEl.innerHTML = buttons.join('');
                            document.querySelectorAll('#riwayatPagination button').forEach(b => b.addEventListener(
                                'click', () => fetchRiwayat(parseInt(b.getAttribute('data-page')))));
                        } else {
                            paginationEl.innerHTML = '';
                        }
                    } catch (e) {
                        console.debug('fetchRiwayat error', e);
                        container.innerHTML = '<div class="px-6 py-4 text-xs text-red-400">Gagal memuat riwayat.</div>';
                    }
                }

                // Load riwayat on page load
                if (document.getElementById('riwayatList')) {
                    fetchRiwayat();
                }

                // Modal detail handler
                function openDetailModal(data) {
                    const modal = document.getElementById('detailModal');
                    if (!modal) return;

                    // Format dates
                    const tanggalMulai = data.tanggal_mulai ? new Date(data.tanggal_mulai).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }) : '-';
                    const tanggalSelesai = data.tanggal_selesai ? new Date(data.tanggal_selesai).toLocaleDateString('id-ID', {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }) : '-';

                    // Calculate days
                    let durasi = '-';
                    if (data.tanggal_mulai && data.tanggal_selesai) {
                        const start = new Date(data.tanggal_mulai);
                        const end = new Date(data.tanggal_selesai);
                        const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                        durasi = `${days} hari`;
                    }

                    // Status styling
                    const st = (data.status || '').toString().toLowerCase();
                    const statusMap = {
                        'pending': { label: 'Menunggu', color: 'amber', icon: '⏳' },
                        'disetujui': { label: 'Disetujui', color: 'emerald', icon: '✓' },
                        'ditolak': { label: 'Ditolak', color: 'red', icon: '✕' }
                    };
                    const statusInfo = statusMap[st] || { label: data.status || '-', color: 'gray', icon: '?' };

                    // Populate modal
                    document.getElementById('detailStatus').textContent = statusInfo.label;
                    document.getElementById('detailStatusBg').className = `w-12 h-12 rounded-lg bg-${statusInfo.color}-50/60 border border-${statusInfo.color}-200/50 flex items-center justify-center text-2xl`;
                    document.getElementById('detailStatusBg').textContent = statusInfo.icon;
                    document.getElementById('detailTanggalMulai').textContent = tanggalMulai;
                    document.getElementById('detailTanggalSelesai').textContent = tanggalSelesai;
                    document.getElementById('detailDurasi').textContent = durasi;
                    document.getElementById('detailAlasan').textContent = data.alasan || '-';
                    document.getElementById('detailTelp').textContent = data.telp || '-';

                    // Show bukti button if exists
                    const buktiBtn = document.getElementById('detailBuktiBtn');
                    if (data.bukti) {
                        buktiBtn.classList.remove('hidden');
                        buktiBtn.onclick = () => {
                            window.open(`/files/bukti/${data.bukti.split('/').pop()}`, '_blank');
                        };
                    } else {
                        buktiBtn.classList.add('hidden');
                    }

                    modal.classList.remove('hidden');
                }

                function closeDetailModal() {
                    const modal = document.getElementById('detailModal');
                    if (modal) modal.classList.add('hidden');
                }

                // Event delegation for detail buttons
                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('btn-detail')) {
                        e.preventDefault();
                        try {
                            const data = JSON.parse(e.target.getAttribute('data-ijin-data'));
                            openDetailModal(data);
                        } catch (err) {
                            console.error('Error parsing ijin data:', err);
                            alert('Gagal membuka detail');
                        }
                    }
                    
                    // Handle close button clicks for detail modal
                    if (e.target && e.target.closest('button[onclick*="closeDetailModal"]')) {
                        e.preventDefault();
                        closeDetailModal();
                    }
                });

                // Close modal when clicking outside (backdrop)
                const detailModal = document.getElementById('detailModal');
                if (detailModal) {
                    detailModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeDetailModal();
                        }
                    });
                }

                // form submit handler
                const form = document.getElementById('ijinForm');
                if (form) {
                    document.getElementById('tanggal_mulai')?.addEventListener('change', function() {
                        /* noop */ });
                    document.getElementById('tanggal_selesai')?.addEventListener('change', function() {
                        /* noop */ });

                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const tanggal_mulai = document.getElementById('tanggal_mulai')?.value;
                        const tanggal_selesai = document.getElementById('tanggal_selesai')?.value;
                        const alasan = document.getElementById('alasan')?.value;
                        const telp = document.getElementById('telp')?.value;
                        const buktiEl = document.getElementById('bukti');

                        if (!tanggal_mulai || !tanggal_selesai) {
                            const err = document.getElementById('tanggal-error');
                            if (err) {
                                err.textContent = '⚠️ Isi tanggal mulai dan tanggal selesai';
                                err.classList.remove('hidden');
                            }
                            return;
                        } else {
                            const err = document.getElementById('tanggal-error');
                            if (err) err.classList.add('hidden');
                        }

                        // require bukti (surat dokter)
                        if (!buktiEl || !buktiEl.files || !buktiEl.files[0]) {
                            const msgEl = document.getElementById('ijinAlert');
                            if (msgEl) {
                                msgEl.textContent = '❌ Lampirkan surat dokter (file wajib).';
                                msgEl.classList.remove('hidden');
                                msgEl.classList.add('bg-red-50/80', 'border-red-200/50', 'text-red-700');
                            }
                            return;
                        } else {
                            const msgEl = document.getElementById('ijinAlert');
                            if (msgEl) msgEl.classList.add('hidden');
                        }

                        // build FormData
                        const formData = new FormData();
                        formData.append('jenis', 'Ijin Sakit');
                        formData.append('tanggal_mulai', tanggal_mulai);
                        formData.append('tanggal_selesai', tanggal_selesai);
                        formData.append('alasan', alasan);
                        if (telp) formData.append('telp', telp);
                        formData.append('bukti', buktiEl.files[0]);

                        // send via multipart form
                        try {
                            setSubmitting(true);
                            await fetch('/sanctum/csrf-cookie', {
                                credentials: 'same-origin'
                            });
                            await ensureApiToken();
                            const headers = getAuthHeaders();
                            // do not set Content-Type header so browser sets multipart boundary
                            const res = await fetch(apiPath('/api/employee/requests'), {
                                method: 'POST',
                                headers,
                                credentials: 'same-origin',
                                body: formData
                            });

                            if (!res.ok) {
                                const text = await res.text().catch(() => null);
                                let errMsg = 'Terjadi kesalahan';
                                try {
                                    const obj = text ? JSON.parse(text) : null;
                                    errMsg = (obj && (obj.message || obj.error)) ? (obj.message || obj.error) :
                                        (text || errMsg);
                                } catch (e) {
                                    errMsg = text || errMsg;
                                }
                                const msgEl = document.getElementById('ijinAlert');
                                if (msgEl) {
                                    msgEl.textContent = '❌ ' + errMsg;
                                    msgEl.classList.remove('hidden');
                                    msgEl.classList.add('bg-red-50/80', 'border-red-200/50', 'text-red-700');
                                }
                                return;
                            }

                            showToast('success', '✓ Pengajuan ijin sakit berhasil dikirim.');
                            form.reset();
                            // reset filename label
                            const buktiName = document.getElementById('buktiName');
                            if (buktiName) buktiName.textContent = 'Klik atau drag file surat dokter di sini';
                            // refresh riwayat
                            await fetchRiwayat();
                        } catch (err) {
                            console.error('submit ijin error', err);
                            const msgEl = document.getElementById('ijinAlert');
                            if (msgEl) {
                                msgEl.textContent = '❌ Terjadi kesalahan sistem.';
                                msgEl.classList.remove('hidden');
                                msgEl.classList.add('bg-red-50/80', 'border-red-200/50', 'text-red-700');
                            }
                        } finally {
                            setSubmitting(false);
                        }
                    });
                }


            })();
        </script>
    @endpush
</x-app-layout>
