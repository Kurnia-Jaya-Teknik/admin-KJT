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
        <div
            class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-red-50/60 via-slate-50/20 to-gray-50/5 min-h-full">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Ijin Sakit</h1>
                <p class="text-sm text-gray-500">Ajukan ijin sakit. Lampirkan <strong>surat dokter</strong> (wajib).</p>
            </div>

            <div class="bg-white/95 rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800">FORMULIR IJIN SAKIT</h2>
                </div>
                <div class="p-8">
                    <form id="ijinForm" class="space-y-6" enctype="multipart/form-data">
                        <div id="ijinAlert" class="hidden"></div>

                        <div class="text-sm text-gray-700 mb-6">
                            <p class="font-semibold mb-4">Yang bertanda tangan di bawah ini:</p>
                        </div>

                        <div class="grid grid-cols-12 gap-4 items-center mb-4">
                            <div class="col-span-4">
                                <label class="text-sm font-medium text-gray-700">Nama</label>
                            </div>
                            <div class="col-span-8">
                                <div class="border-b-2 border-gray-300 px-2 py-1 text-sm text-gray-600">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 items-center mb-4">
                            <div class="col-span-4">
                                <label class="text-sm font-medium text-gray-700">Jabatan/Divisi</label>
                            </div>
                            <div class="col-span-8">
                                <div class="border-b-2 border-gray-300 px-2 py-1 text-sm text-gray-600">
                                    {{ auth()->user()->departemen->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        {{-- Hidden jenis = Ijin Sakit --}}
                        <input type="hidden" name="jenis" value="Ijin Sakit">

                        <!-- Tanggal Ijin -->
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <p class="text-sm font-semibold text-gray-700 mb-4">Periode Ijin Sakit</p>

                            <div class="grid grid-cols-12 gap-4 items-center mb-4">
                                <div class="col-span-3">
                                    <label class="text-sm font-medium text-gray-700">Mulai Tanggal</label>
                                </div>
                                <div class="col-span-3">
                                    <input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                                </div>
                                <div class="col-span-2">
                                    <span class="text-sm text-gray-600">Tahun</span>
                                </div>
                                <div class="col-span-4">
                                    <input type="text" placeholder="20__"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm" disabled>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-4 items-center mb-4">
                                <div class="col-span-3">
                                    <label class="text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                </div>
                                <div class="col-span-3">
                                    <input id="tanggal_selesai" name="tanggal_selesai" type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                                </div>
                                <div class="col-span-2">
                                    <span class="text-sm text-gray-600">Tahun</span>
                                </div>
                                <div class="col-span-4">
                                    <input type="text" placeholder="20__"
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm" disabled>
                                </div>
                            </div>

                            <div id="tanggal-error" class="text-red-500 text-xs mt-2 hidden"></div>
                        </div>

                        <!-- Keterangan -->
                        <div class="border-t border-gray-200 pt-6 mb-6">
                            <label class="text-sm font-medium text-gray-700 mb-2 block">Keterangan / Alasan</label>
                            <textarea id="alasan" name="alasan" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm resize-none"></textarea>
                        </div>

                        <!-- Lampiran (opsional) -->
                        <div class="grid grid-cols-12 gap-4 items-center mb-4">
                            <div class="col-span-4">
                                <label class="text-sm font-medium text-gray-700">Lampiran (surat dokter)</label>
                                <p class="text-xs text-gray-400 mt-1">Upload surat dokter (PDF atau gambar). File wajib
                                    dilampirkan dan maksimal 10MB.</p>
                            </div>
                            <div class="col-span-8">
                                <div class="flex items-center gap-3">
                                    <label for="bukti" id="buktiLabel"
                                        class="px-3 py-2 bg-white border border-gray-300 rounded text-sm cursor-pointer hover:bg-gray-50">Pilih
                                        file surat dokter…</label>
                                    <span id="buktiName" class="text-sm text-gray-600">Belum ada file dipilih</span>
                                </div>
                                <input type="file" id="bukti" name="bukti" accept="image/*,.pdf" required
                                    class="sr-only" />
                            </div>
                        </div>



                        <!-- Telepon -->
                        <div class="grid grid-cols-12 gap-4 items-center mb-6">
                            <div class="col-span-4">
                                <label class="text-sm font-medium text-gray-700">Telp. Yang bisa dihubungi</label>
                            </div>
                            <div class="col-span-8">
                                <input type="tel" id="telp" name="telp"
                                    placeholder="Nomor telepon / kontak yang bisa dihubungi"
                                    value="{{ old('telp', auth()->user()->phone ?? '') }}"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm" />
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3 pt-4 border-t border-gray-200">
                            <button type="submit" id="submitIjin"
                                class="flex-1 px-4 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-all duration-300 text-sm">
                                Ajukan Ijin Sakit
                            </button>
                            <button type="reset"
                                class="flex-1 px-4 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300 text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Pengajuan Cuti (reuse same riwayat listing) -->
            <div
                class="mt-8 bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                <div
                    class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/40 via-slate-50/20 to-slate-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Ijin Sakit</h3>
                </div>
                <div id="riwayatList" class="divide-y divide-gray-100/50"></div>
                <div id="riwayatPagination"
                    class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50"></div>
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
                        `<div class="w-3 h-3 mt-1 rounded-full ${type==='success'?'bg-emerald-500':'bg-red-500'}"></div><div><p class="font-medium text-sm text-gray-800">${message}</p></div>`;
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
                    el.classList.add('mt-4', 'p-3', 'rounded-lg');
                    if (type === 'success') {
                        el.classList.add('bg-green-50', 'border', 'border-green-200', 'text-green-700');
                    } else {
                        el.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-700');
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
                            const statusColor = st === 'disetujui' ? 'green' : isPending ? 'yellow' : 'red';
                            const statusLabel = st === 'disetujui' ? 'Disetujui' : isPending ? 'Menunggu' :
                                'Ditolak';
                            const tanggalMulai = i.tanggal_mulai ? new Date(i.tanggal_mulai).toLocaleDateString(
                                'id-ID') : '-';
                            const tanggalSelesai = i.tanggal_selesai ? new Date(i.tanggal_selesai)
                                .toLocaleDateString('id-ID') : '-';

                            return `<div id="${itemId}" class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md transition-all duration-300 group">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between mb-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Ijin Sakit</p>
                                                <p class="text-xs text-gray-500 mt-0.5">${tanggalMulai} - ${tanggalSelesai}</p>
                                            </div>
                                            <span class="px-2.5 py-0.5 bg-${statusColor}-50/70 text-${statusColor}-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">${statusLabel}</span>
                                        </div>
                                        <p class="text-xs text-gray-400 mb-2">Alasan: <strong class="text-gray-600">${i.alasan || '-'}</strong></p>
                                        <button class="text-xs text-${statusColor}-600/90 hover:text-${statusColor}-700 font-medium transition-colors">Lihat Detail →</button>
                                    </div>
                                </div>
                            </div>`;
                        }).join('');

                        // render pagination
                        if (pagination && pagination.last_page > 1) {
                            const buttons = [];
                            for (let p = 1; p <= pagination.last_page; p++) {
                                buttons.push(
                                    `<button class="px-3 py-2 rounded-xl ${p === page ? 'bg-gradient-to-r from-red-500 to-green-400 text-white shadow-sm' : 'border border-gray-200/60 text-gray-600 hover:bg-white/80'} transition-all duration-300 text-sm" data-page="${p}">${p}</button>`
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
                                err.textContent = 'Isi tanggal mulai dan tanggal selesai';
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
                                msgEl.textContent = 'Lampirkan surat dokter (file wajib).';
                                msgEl.classList.remove('hidden');
                                msgEl.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-700');
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
                                    msgEl.textContent = errMsg;
                                    msgEl.classList.remove('hidden');
                                    msgEl.classList.add('bg-red-50', 'border', 'border-red-200',
                                    'text-red-700');
                                }
                                return;
                            }

                            showToast('success', 'Pengajuan ijin sakit berhasil dikirim.');
                            form.reset();
                            // reset filename label
                            const buktiName = document.getElementById('buktiName');
                            if (buktiName) buktiName.textContent = 'Belum ada file dipilih';
                            // refresh riwayat
                            await fetchRiwayat();
                        } catch (err) {
                            console.error('submit ijin error', err);
                            const msgEl = document.getElementById('ijinAlert');
                            if (msgEl) {
                                msgEl.textContent = 'Terjadi kesalahan sistem.';
                                msgEl.classList.remove('hidden');
                                msgEl.classList.add('bg-red-50', 'border', 'border-red-200', 'text-red-700');
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
