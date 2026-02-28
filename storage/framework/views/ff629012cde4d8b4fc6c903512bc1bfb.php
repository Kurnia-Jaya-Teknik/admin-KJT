<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Cuti
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Toast container -->
    <div id="cutiToast" class="fixed top-6 right-6 z-50 hidden"></div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50 min-h-full">
            <!-- Page Header with Gradient Banner -->
            <div class="mb-8 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-600 rounded-3xl blur-2xl opacity-10"></div>
                <div class="relative bg-gradient-to-r from-blue-600/95 via-cyan-500/90 to-teal-600/85 rounded-3xl p-8 overflow-hidden">
                    <div class="absolute top-4 right-8 opacity-20">
                        <div class="w-32 h-32 bg-white rounded-full blur-3xl"></div>
                    </div>
                    <div class="absolute bottom-2 left-4 opacity-15">
                        <div class="w-24 h-24 bg-white rounded-full blur-2xl"></div>
                    </div>
                    <div class="relative">
                        <h1 class="text-3xl font-bold text-white mb-2">🗓️ Pengajuan Cuti</h1>
                        <p class="text-blue-50/90 text-sm">Ajukan cuti tahunan atau khusus dengan mudah</p>
                    </div>
                </div>
            </div>

            <!-- Form Pengajuan - Modern Style -->
            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200/30 bg-gradient-to-r from-blue-50/80 via-cyan-50/50 to-teal-50/30">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">📋 Formulir Pengajuan Cuti</h2>
                </div>
                <div class="p-8">
                    <form id="cutiForm" class="space-y-6">
                        <div id="cutiAlert" class="hidden"></div>

                        <!-- User Info Section -->
                        <div class="mb-6 p-6 bg-gradient-to-br from-blue-50/60 to-cyan-50/40 rounded-xl border border-blue-200/30">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">👤 Nama</label>
                                    <div class="px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-lg text-base text-gray-700 font-medium">
                                        <?php echo e(auth()->user()->name); ?>

                                    </div>
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">🏢 Divisi</label>
                                    <div class="px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-lg text-base text-gray-700 font-medium">
                                        <?php echo e(auth()->user()->departemen->nama ?? '-'); ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Masuk ke Perusahaan -->
                        

                        <!-- Jenis Cuti Section -->
                        <div class="mb-6 p-6 bg-white/80 border border-gray-200/40 rounded-xl">
                            <p class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">📌 Jenis Pengajuan Cuti</p>
                            <div class="flex flex-col sm:flex-row gap-6">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="radio" id="jenis-tahunan" name="jenis" value="Cuti Tahunan"
                                            class="w-4 h-4 text-blue-500 cursor-pointer">
                                    </div>
                                    <span class="text-base text-gray-700 group-hover:text-blue-600 transition-colors">Cuti Tahunan</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative flex items-center">
                                        <input type="radio" id="jenis-lainnya" name="jenis" value="Cuti Khusus"
                                            class="w-4 h-4 text-blue-500 cursor-pointer">
                                    </div>
                                    <span class="text-base text-gray-700 group-hover:text-blue-600 transition-colors">Cuti Khusus / Darurat</span>
                                </label>
                            </div>
                            <div id="jenis-error" class="text-red-500/80 text-sm mt-3 hidden font-medium"></div>
                        </div>

                        <!-- Date Range Section -->
                        <div class="mb-6 p-6 bg-white/80 border border-gray-200/40 rounded-xl">
                            <p class="text-base font-semibold text-gray-700 mb-6 flex items-center gap-2">📅 Periode Cuti</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">Mulai Tanggal</label>
                                    <input id="tanggal_mulai" name="tanggal_mulai" type="date"
                                        class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base focus:bg-white focus:border-blue-400/60 focus:ring-2 focus:ring-blue-200/30 transition-all">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-gray-600 uppercase tracking-wide block mb-2">Sampai Tanggal</label>
                                    <input id="tanggal_selesai" name="tanggal_selesai" type="date"
                                        class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base focus:bg-white focus:border-blue-400/60 focus:ring-2 focus:ring-blue-200/30 transition-all">
                                </div>
                            </div>

                            <div class="bg-blue-50/60 border border-blue-200/40 rounded-lg p-4 mb-2">
                                <p class="text-base font-semibold text-gray-700">📊 Total Hari Cuti: <span id="editDurasiLabel" class="text-blue-600 font-bold">-</span></p>
                            </div>
                            <div id="tanggal-error" class="text-red-500/80 text-sm mt-3 hidden font-medium"></div>
                        </div>

                        <!-- Alasan Section -->
                        <div class="mb-6 p-6 bg-white/80 border border-gray-200/40 rounded-xl">
                            <label class="text-base font-semibold text-gray-700 mb-3 flex items-center gap-2">📝 Keterangan / Alasan</label>
                            <textarea id="alasan" name="alasan" rows="4" placeholder="Jelaskan alasan atau keterangan cuti Anda..."
                                class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base resize-none focus:bg-white focus:border-blue-400/60 focus:ring-2 focus:ring-blue-200/30 transition-all"></textarea>
                        </div>

                        <!-- Pelimpahan Tugas (by department) -->
                        <div class="grid grid-cols-12 gap-4 items-center mb-4">
                            <div class="col-span-4">
                                <label class="text-sm font-medium text-gray-700">Pelimpahan Tugas (berdasarkan
                                    divisi)</label>
                                <p class="text-xs text-gray-400 mt-1">Pilih divisi, lalu pilih karyawan dari divisi
                                    tersebut untuk dilimpahkan tugasnya.</p>
                            </div>
                            <div class="col-span-8">
                                <div class="grid grid-cols-12 gap-4 mb-2">
                                    <div class="col-span-6">
                                        <select id="filter_departemen"
                                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm">
                                            <option value="">-- Semua Divisi --</option>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departemens ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($d->id); ?>"
                                                    <?php if(auth()->user()->departemen_id == $d->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($d->nama); ?> (<?php echo e($d->kode); ?>)</option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-span-6 text-right">
                                        <button type="button" id="clearPelimpahan"
                                            class="px-3 py-2 rounded bg-gray-100 text-sm">Bersihkan</button>
                                    </div>
                                </div>

                                <!-- Search input + suggestion list (professional tagging) -->
                                <div class="relative">
                                    <input id="pelimpahan_search" type="text"
                                        placeholder="Cari rekan untuk dilimpahkan..."
                                        class="w-full px-3 py-2 border border-gray-300 rounded text-sm"
                                        autocomplete="off" />
                                    <ul id="pelimpahan_suggestions"
                                        class="hidden absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded shadow-sm max-h-48 overflow-auto text-sm">
                                    </ul>
                                </div>

                                <!-- Selected chips -->
                                <div id="pelimpahan_chips" class="flex flex-wrap gap-2 mt-2"></div>

                                <!-- Hidden inputs for selected IDs (form submission) -->
                                <div id="pelimpahan_hidden_inputs"></div>

                                <p class="text-xs text-gray-400 mt-1">Tip: ketik nama rekan, lalu klik dari daftar
                                    untuk menambah. Klik tanda × untuk menghapus.</p>
                            </div>
                        </div>

                        <!-- Phone Section -->
                        <div class="mb-6 p-6 bg-white/80 border border-gray-200/40 rounded-xl">
                            <label class="text-base font-semibold text-gray-700 mb-3 flex items-center gap-2">☎️ Telepon Yang Bisa Dihubungi</label>
                            <input type="tel" id="telp" name="telp"
                                placeholder="Contoh: 082123456789"
                                value="<?php echo e(old('telp', auth()->user()->phone ?? '')); ?>"
                                class="w-full px-4 py-2.5 border border-gray-300/60 rounded-lg text-base focus:bg-white focus:border-blue-400/60 focus:ring-2 focus:ring-blue-200/30 transition-all" />
                        </div>

                        <!-- Info Box & Buttons -->
                        <div class="mb-6">
                            <div class="bg-gradient-to-r from-blue-50/80 to-cyan-50/60 border border-blue-200/50 rounded-xl p-4 mb-6">
                                <p class="text-base font-semibold text-gray-700">
                                    ✓ Sisa Cuti Tahun Ini: <span id="sisaCutiLabel" class="text-blue-600 font-bold">-</span> hari
                                </p>
                            </div>

                            <div class="flex gap-3 pt-6 border-t border-gray-200/30">
                                <button type="submit" id="submitCuti"
                                    class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 active:scale-95 text-white font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-300 text-base">
                                    Ajukan Cuti
                                </button>
                                <button type="reset"
                                    class="flex-1 px-4 py-3 bg-gray-200/80 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300 text-base">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Pengajuan Cuti -->
            <div
                class="mt-8 bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                <div
                    class="px-6 py-3.5 border-b border-gray-200/30 bg-gradient-to-r from-blue-50/80 via-cyan-50/50 to-teal-50/30">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">📋 Riwayat Pengajuan Cuti</h3>
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
    <?php $__env->startPush('scripts'); ?>
        <script>
            (function() {
                const API_BASE_RAW = <?php echo json_encode(rtrim(request()->getSchemeAndHttpHost() . request()->getBaseUrl(), '/')); ?>;
                const API_BASE = (API_BASE_RAW && API_BASE_RAW.indexOf(String.fromCharCode(123, 123)) === -1) ?
                    API_BASE_RAW : (window.location.origin + window.location.pathname.substring(0, window.location.pathname
                        .lastIndexOf(String.fromCharCode(47))));
                console.debug("[cuti] API_BASE", API_BASE);

                function apiPath(path) {
                    if (path.startsWith("/api/") || path.startsWith("/session/")) return window.location.origin + path;
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
                        // Filter hanya cuti (bukan Ijin Sakit)
                        const res = await fetch(apiPath('/api/employee/requests') + '?page=' + (page || 1) +
                            '&exclude_type=Ijin%20Sakit', {
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
                            let hoverClass = 'hover:from-blue-50/30';
                            let iconBg = 'from-amber-50/60 to-amber-50/40';
                            let iconColor = 'text-amber-600/70';
                            let statusEmoji = '⏳';
                            let iconSvg =
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>';

                            if (status === 'Disetujui') {
                                statusBadgeClass = 'bg-emerald-50/70 text-emerald-600/80';
                                hoverClass = 'hover:from-emerald-50/30';
                                iconBg = 'from-emerald-50/60 to-emerald-50/40';
                                iconColor = 'text-emerald-500/70';
                                statusEmoji = '✓';
                                iconSvg =
                                    '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>';
                            } else if (status === 'Ditolak') {
                                statusBadgeClass = 'bg-red-50/70 text-red-500/80';
                                hoverClass = 'hover:from-red-50/30';
                                iconBg = 'from-red-50/60 to-red-50/40';
                                iconColor = 'text-red-500/70';
                                statusEmoji = '✕';
                                iconSvg =
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
                            }

                            const tanggal = i.tanggal_mulai ? new Date(i.tanggal_mulai).toLocaleDateString(
                                'id-ID') : '-';
                            const durasi = i.durasi_hari ? (i.durasi_hari + ' hari') : '-';
                            const tanggalSelesai = i.tanggal_selesai || i.tanggal_mulai || '';
                            const diajukan = i.created_at ? new Date(i.created_at).toLocaleDateString('id-ID') :
                                '-';

                            // Build delegated users list
                            let delegatedHtml = '';
                            if (i.delegated_users && i.delegated_users.length > 0) {
                                const names = i.delegated_users.map(u => u.name).join(', ');
                                delegatedHtml =
                                    `<p class="text-sm text-gray-500 mb-2">📋 Dilimpahkan ke: <span class="font-medium text-gray-700">${names}</span></p>`;
                            }

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
                                        <p class="text-base font-medium text-gray-800">${i.jenis || '-'}</p>
                                        <p class="text-sm text-gray-500 mt-0.5">${durasi} • ${tanggal}</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 ${statusBadgeClass} text-sm font-semibold rounded-full shadow-sm flex-shrink-0 ml-2">${statusEmoji} ${status}</span>
                                </div>
                                <p class="text-sm text-gray-500 mb-2">📅 Diajukan: ${diajukan}</p>
                                <p class="text-base text-gray-600 mb-2 line-clamp-2">${i.alasan || '-'}</p>
                                ${delegatedHtml}
                                ${i.bukti ? `<p class="text-base mb-2"><a href="${window.location.origin + '/storage/' + encodeURIComponent(i.bukti)}" target="_blank" class="text-base text-indigo-600 underline">Lihat Lampiran (Surat Dokter)</a></p>` : ''}
                                <div class="flex gap-3">
                                    ${status === 'Pending' ? `
                                        <button data-action="edit-cuti" data-id="${i.id}" data-jenis="${i.jenis || ''}" data-tanggal-mulai="${i.tanggal_mulai || ''}" data-tanggal-selesai="${tanggalSelesai}" data-alasan="${i.alasan || ''}" data-telp="${i.telp || ''}" class="text-sm text-blue-600 hover:text-blue-700 font-medium transition-colors">✏️ Ubah</button>
                                        <button data-action="delete-cuti" data-id="${i.id}" class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">🗑️ Hapus</button>
                                    ` : ''}
                                    <button data-action="view-detail" data-id="${i.id}" class="text-sm text-gray-600 hover:text-gray-800 font-medium transition-colors">👁️ Detail</button>
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
                                    `<div class="text-base text-gray-600">Halaman ${current} dari ${last}</div>`;
                                let rightHtml = '<div class="flex gap-2">';
                                if (current > 1) rightHtml +=
                                    `<button data-page="${current-1}" class="px-3 py-1.5 rounded-lg border border-gray-300/60 text-base text-gray-700 hover:bg-gray-100 transition-colors">← Sebelumnya</button>`;
                                if (current < last) rightHtml +=
                                    `<button data-page="${current+1}" class="px-3 py-1.5 rounded-lg border border-gray-300/60 text-base text-gray-700 hover:bg-gray-100 transition-colors">Selanjutnya →</button>`;
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
                    // Update durasi when dates change
                    document.getElementById('tanggal_mulai')?.addEventListener('change', updateEditDurasi);
                    document.getElementById('tanggal_selesai')?.addEventListener('change', updateEditDurasi);

                    // helper to actually send cuti data to server
                    async function sendCuti(data, modalEl) {
                        try {
                            console.debug('sendCuti payload', data);
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
                                // Try to get text body for debugging (may be HTML / stack trace)
                                const text = await res.text().catch(() => null);
                                console.error('sendCuti response error', res.status, text);
                                if (res.status === 401) {
                                    showAlert('error', 'Sesi tidak valid. Silakan login ulang.');
                                    window.location.href = '/login';
                                    return;
                                }
                                // If JSON, parse message; otherwise show text
                                let errMsg = 'Terjadi kesalahan';
                                try {
                                    const obj = text ? JSON.parse(text) : null;
                                    errMsg = (obj && (obj.message || obj.error)) ? (obj.message || obj.error) : (text ||
                                        errMsg);
                                } catch (e) {
                                    errMsg = text || errMsg;
                                }
                                showAlert('error', errMsg || 'Validasi gagal (lihat console untuk detail)');
                                return;
                            }
                            const json = await res.json();
                            showToast('success', 'Pengajuan cuti berhasil dikirim.');
                            form.reset();
                            await fetchRiwayat();
                            await fetchProfile();
                            if (modalEl) modalEl.classList.add('hidden');
                            // clear selected chips after successful submission
                            if (window.clearPelimpahanSelected) window.clearPelimpahanSelected();
                        } catch (err) {
                            console.error('sendCuti exception', err);
                            showAlert('error', 'Terjadi kesalahan sistem (cek console)');
                        } finally {
                            setSubmitting(false);
                        }
                    }

                    // submit handler with confirmation modal when delegation selected
                    form.addEventListener('submit', async function(e) {
                        e.preventDefault();
                        const jenisRadio = document.querySelector('input[name="jenis"]:checked');

                        // Validate jenis
                        if (!jenisRadio || !jenisRadio.value) {
                            const err = document.getElementById('jenis-error');
                            if (err) {
                                err.textContent = 'Pilih jenis cuti terlebih dahulu';
                                err.classList.remove('hidden');
                            }
                            return;
                        } else {
                            const err = document.getElementById('jenis-error');
                            if (err) err.classList.add('hidden');
                        }

                        // build selected ids from hidden inputs or global set
                        const selectedIds = Array.from((window.pelimpahanSelectedIds || new Set()));
                        const data = {
                            jenis: jenisRadio.value,
                            tanggal_mulai: document.getElementById('tanggal_mulai')?.value,
                            tanggal_selesai: document.getElementById('tanggal_selesai')?.value,
                            alasan: document.getElementById('alasan')?.value,
                            telp: document.getElementById('telp')?.value,
                            dilimpahkan_ke: selectedIds.map(id => parseInt(id)),
                        };

                        // Validate dates
                        if (!data.tanggal_mulai || !data.tanggal_selesai) {
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

                        // Validate date order (tanggal_selesai >= tanggal_mulai)
                        try {
                            const sDate = new Date(data.tanggal_mulai);
                            const eDate = new Date(data.tanggal_selesai);
                            if (isNaN(sDate) || isNaN(eDate) || eDate < sDate) {
                                const err = document.getElementById('tanggal-error');
                                if (err) {
                                    err.textContent = 'Tanggal selesai harus sama atau setelah tanggal mulai';
                                    err.classList.remove('hidden');
                                }
                                return;
                            } else {
                                const err = document.getElementById('tanggal-error');
                                if (err) err.classList.add('hidden');
                            }
                        } catch (ex) {
                            // ignore parsing errors here; server will validate
                        }

                        // If there are delegated users, show confirmation modal
                        if (data.dilimpahkan_ke && data.dilimpahkan_ke.length > 0) {
                            const modal = document.getElementById('confirmDelegationModal');
                            const list = document.getElementById('delegationList');
                            list.innerHTML = '';
                            // list selected names
                            data.dilimpahkan_ke.forEach(id => {
                                const li = document.createElement('li');
                                li.textContent = getPelimpahanNameById(id);
                                list.appendChild(li);
                            });
                            modal.classList.remove('hidden');
                            // store pending data on modal element
                            modal._pendingData = data;
                            return;
                        }

                        // otherwise send immediately
                        await sendCuti(data);
                    });

                    // modal button handlers (confirm / cancel)
                    document.addEventListener('click', function(e) {
                        const modal = document.getElementById('confirmDelegationModal');
                        if (!modal) return;

                        if (e.target.closest('[data-action="close-delegation-modal"]') || e.target.closest(
                                '[data-action="cancel-delegation"]')) {
                            modal.classList.add('hidden');
                            modal._pendingData = null;
                            return;
                        }

                        if (e.target.closest('[data-action="confirm-delegation"]')) {
                            console.debug('confirm-delegation clicked', modal._pendingData);
                            const pending = modal._pendingData;
                            if (pending) {
                                sendCuti(pending, modal);
                                modal._pendingData = null;
                            }
                            return;
                        }
                    });

                    // initial load
                    (async () => {
                        await ensureApiToken();
                        await fetchProfile();
                        await fetchRiwayat();

                        // Setup department filter + search + chips for pelimpahan (modern UI)
                        try {
                            const filterSelect = document.getElementById('filter_departemen');
                            const searchInput = document.getElementById('pelimpahan_search');
                            const suggestionsEl = document.getElementById('pelimpahan_suggestions');
                            const chipsContainer = document.getElementById('pelimpahan_chips');
                            const hiddenInputs = document.getElementById('pelimpahan_hidden_inputs');
                            const clearBtn = document.getElementById('clearPelimpahan');

                            window.pelimpahanEmployeesList = <?php echo json_encode(
                                ($employees ?? collect())->map(function ($e) {
                                    return [
                                        'id' => $e->id,
                                        'name' => $e->name,
                                        'departemen_id' => $e->departemen_id,
                                        'departemen_name' => $e->departemen->nama ?? '',
                                    ];
                                }),
                            ); ?>;

                            window.currentUserId = <?php echo e(Auth::id()); ?>; // ID user yang sedang login
                            window.pelimpahanSelectedIds = window.pelimpahanSelectedIds || new Set();

                            // expose helper to resolve name globally
                            window.getPelimpahanNameById = function(id) {
                                const e = (window.pelimpahanEmployeesList || []).find(x => String(x.id) ===
                                    String(id));
                                return e ? e.name : String(id);
                            }

                            function renderSuggestions(list) {
                                suggestionsEl.innerHTML = '';
                                if (!list || !list.length) {
                                    suggestionsEl.classList.add('hidden');
                                    return;
                                }
                                list.forEach(emp => {
                                    const li = document.createElement('li');
                                    li.className = 'px-3 py-2 hover:bg-gray-50 cursor-pointer';
                                    li.textContent = emp.name + (emp.departemen_name ? (' (' + emp
                                        .departemen_name + ')') : '');
                                    li.addEventListener('click', function() {
                                        addSelected(emp);
                                    });
                                    suggestionsEl.appendChild(li);
                                });
                                suggestionsEl.classList.remove('hidden');
                            }

                            function updateSuggestions() {
                                const deptId = filterSelect ? filterSelect.value : '';
                                const q = (searchInput ? searchInput.value.toLowerCase().trim() : '');
                                const listSource = (window.pelimpahanEmployeesList || []);
                                const matches = listSource.filter(emp => {
                                    // Tidak bisa melimpahkan ke diri sendiri
                                    const empId = String(emp.id);
                                    const currentId = String(window.currentUserId || '');
                                    if (empId === currentId) return false;
                                    if ((window.pelimpahanSelectedIds || new Set()).has(String(emp.id)))
                                        return false;
                                    if (deptId && String(emp.departemen_id) !== String(deptId))
                                        return false;
                                    if (!q) return true;
                                    return emp.name.toLowerCase().includes(q) || (emp.departemen_name || '')
                                        .toLowerCase().includes(q);
                                });
                                renderSuggestions(matches);
                            }

                            function addSelected(emp) {
                                // Validasi tidak bisa melimpahkan ke diri sendiri
                                if (String(emp.id) === String(window.currentUserId || "")) {
                                    showAlert("error", "Tidak dapat melimpahkan tugas ke diri sendiri.");
                                    return;
                                }
                                if ((window.pelimpahanSelectedIds || new Set()).has(String(emp.id))) return;
                                window.pelimpahanSelectedIds.add(String(emp.id));
                                // chip
                                const chip = document.createElement('div');
                                chip.className =
                                    'px-3 py-1 rounded-full bg-gray-100 text-sm flex items-center gap-2';
                                chip.setAttribute('data-id', emp.id);
                                const span = document.createElement('span');
                                span.textContent = emp.name;
                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'text-xs text-gray-500 hover:text-gray-700';
                                btn.innerHTML = '&times;';
                                btn.addEventListener('click', function() {
                                    removeSelected(emp.id);
                                });
                                chip.appendChild(span);
                                chip.appendChild(btn);
                                chipsContainer.appendChild(chip);
                                // hidden input
                                const hi = document.createElement('input');
                                hi.type = 'hidden';
                                hi.name = 'dilimpahkan_ke[]';
                                hi.value = emp.id;
                                hi.setAttribute('data-id', emp.id);
                                hiddenInputs.appendChild(hi);
                                // reset search and suggestions
                                if (searchInput) searchInput.value = '';
                                suggestionsEl.classList.add('hidden');
                            }

                            function removeSelected(id) {
                                (window.pelimpahanSelectedIds || new Set()).delete(String(id));
                                const chip = chipsContainer.querySelector('[data-id="' + id + '"]');
                                if (chip) chip.remove();
                                const hi = hiddenInputs.querySelector('input[data-id="' + id + '"]');
                                if (hi) hi.remove();
                            }

                            function clearSelected() {
                                (window.pelimpahanSelectedIds || new Set()).clear();
                                chipsContainer.innerHTML = '';
                                hiddenInputs.innerHTML = '';
                                if (searchInput) searchInput.value = '';
                                if (filterSelect) filterSelect.value = '';
                                suggestionsEl.classList.add('hidden');
                            }

                            // wire events
                            filterSelect && filterSelect.addEventListener('change', updateSuggestions);
                            searchInput && searchInput.addEventListener('input', updateSuggestions);
                            // show suggestions on focus
                            searchInput && searchInput.addEventListener('focus', updateSuggestions);

                            // click outside suggestions to close
                            document.addEventListener('click', function(e) {
                                if (!e.target.closest('#pelimpahan_search') && !e.target.closest(
                                        '#pelimpahan_suggestions')) {
                                    suggestionsEl.classList.add('hidden');
                                }
                            });

                            clearBtn && clearBtn.addEventListener('click', function() {
                                clearSelected();
                            });

                            // expose clear function globally so sendCuti can reset tags after success
                            window.clearPelimpahanSelected = clearSelected;

                            // initial suggestions state
                            updateSuggestions();
                        } catch (e) {
                            console.debug('setup pelimpahan filter', e);
                        }
                    })();

                    // Setup pelimpahan controls for the EDIT modal (separate namespace)
                    (function() {
                        try {
                            const searchInput = document.getElementById('edit_pelimpahan_search');
                            const filterSelect = document.getElementById('edit_pelimpahan_filter');
                            const suggestionsEl = document.getElementById('edit_pelimpahan_suggestions');
                            const chipsContainer = document.getElementById('edit_pelimpahan_chips');
                            const hiddenInputs = document.getElementById('edit_pelimpahan_hidden_inputs');
                            const clearBtn = document.getElementById('edit_pelimpahan_clear');

                            window.editPelimpahanSelectedIds = window.editPelimpahanSelectedIds || new Set();

                            function renderSuggestions(list) {
                                if (!suggestionsEl) return;
                                suggestionsEl.innerHTML = '';
                                if (!Array.isArray(list) || list.length === 0) {
                                    suggestionsEl.classList.add('hidden');
                                    return;
                                }
                                list.slice(0, 20).forEach(u => {
                                    const el = document.createElement('div');
                                    el.className = 'px-3 py-2 text-sm hover:bg-gray-50 cursor-pointer';
                                    el.textContent = u.name + ' — ' + (u.departemen || u.division || '-');
                                    el.setAttribute('data-id', u.id);
                                    el.addEventListener('click', function() {
                                        editAddSelected(u.id);
                                    });
                                    suggestionsEl.appendChild(el);
                                });
                                suggestionsEl.classList.remove('hidden');
                            }

                            function updateSuggestions() {
                                try {
                                    const q = (searchInput && searchInput.value || '').trim().toLowerCase();
                                    const filter = (filterSelect && filterSelect.value || '').toLowerCase();
                                    let list = (window.pelimpahanEmployeesList || []).filter(u => {
                                        if (!u) return false;
                                        // Tidak bisa melimpahkan ke diri sendiri
                                        if (String(u.id) === String(window.currentUserId || '')) return false;
                                        if (filter && (u.departemen || '').toLowerCase() !== filter)
                                            return false;
                                        if (!q) return true;
                                        return (u.name || '').toLowerCase().indexOf(q) !== -1 || (u.email || '')
                                            .toLowerCase().indexOf(q) !== -1;
                                    });
                                    // exclude already selected
                                    list = list.filter(u => !(window.editPelimpahanSelectedIds || new Set()).has(String(
                                        u.id)));
                                    renderSuggestions(list);
                                } catch (err) {
                                    console.debug('edit updateSuggestions', err);
                                }
                            }

                            function createChip(u) {
                                const chip = document.createElement('div');
                                chip.className = 'px-2 py-1 bg-gray-100 rounded-full text-sm flex items-center gap-2';
                                chip.setAttribute('data-id', u.id);
                                chip.innerHTML = '<span>' + (u.name || 'User') + '</span>' +
                                    '<button type="button" class="ml-2 text-xs text-gray-500" data-action="edit-remove-pelimpahan">&times;</button>';
                                return chip;
                            }

                            window.editAddSelected = function(id) {
                                id = String(id);
                                // Validasi tidak bisa melimpahkan ke diri sendiri
                                if (id === String(window.currentUserId || "")) {
                                    showAlert("error", "Tidak dapat melimpahkan tugas ke diri sendiri.");
                                    return;
                                }
                                window.editPelimpahanSelectedIds = window.editPelimpahanSelectedIds || new Set();
                                if (window.editPelimpahanSelectedIds.has(id)) return;
                                const u = (window.pelimpahanEmployeesList || []).find(x => String(x.id) === String(
                                    id));
                                if (!u) return;
                                window.editPelimpahanSelectedIds.add(String(id));
                                if (chipsContainer) chipsContainer.appendChild(createChip(u));
                                if (hiddenInputs) {
                                    const hi = document.createElement('input');
                                    hi.type = 'hidden';
                                    hi.name = 'dilimpahkan_ke[]';
                                    hi.setAttribute('data-id', id);
                                    hi.value = id;
                                    hiddenInputs.appendChild(hi);
                                }
                                // refresh suggestions
                                updateSuggestions();
                            };

                            window.editRemoveSelected = function(id) {
                                id = String(id);
                                window.editPelimpahanSelectedIds = window.editPelimpahanSelectedIds || new Set();
                                window.editPelimpahanSelectedIds.delete(String(id));
                                const chip = chipsContainer && chipsContainer.querySelector('[data-id="' + id +
                                    '"]');
                                if (chip) chip.remove();
                                const hi = hiddenInputs && hiddenInputs.querySelector('input[data-id="' + id +
                                    '"]');
                                if (hi) hi.remove();
                                updateSuggestions();
                            };

                            window.editClearSelected = function() {
                                window.editPelimpahanSelectedIds = new Set();
                                if (chipsContainer) chipsContainer.innerHTML = '';
                                if (hiddenInputs) hiddenInputs.innerHTML = '';
                                if (searchInput) searchInput.value = '';
                                if (filterSelect) filterSelect.value = '';
                                suggestionsEl && suggestionsEl.classList.add('hidden');
                            };

                            // delegate remove click
                            document.addEventListener('click', function(e) {
                                const rem = e.target.closest('[data-action="edit-remove-pelimpahan"]');
                                if (rem) {
                                    const id = rem.closest('[data-id]')?.getAttribute('data-id');
                                    if (id) window.editRemoveSelected(id);
                                }
                            });

                            filterSelect && filterSelect.addEventListener('change', updateSuggestions);
                            searchInput && searchInput.addEventListener('input', updateSuggestions);
                            searchInput && searchInput.addEventListener('focus', updateSuggestions);
                            clearBtn && clearBtn.addEventListener('click', function() {
                                window.editClearSelected();
                            });

                            // click outside suggestions close
                            document.addEventListener('click', function(e) {
                                if (!e.target.closest('#edit_pelimpahan_search') && !e.target.closest(
                                        '#edit_pelimpahan_suggestions')) {
                                    suggestionsEl && suggestionsEl.classList.add('hidden');
                                }
                            });

                            // initial
                            updateSuggestions();
                        } catch (e) {
                            console.debug('setup edit pelimpahan', e);
                        }
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

                    // Delegated click handler for edit / view detail cuti
                    document.addEventListener('click', function(e) {
                        const viewBtn = e.target.closest('[data-action="view-detail"]');
                        if (viewBtn) {
                            const id = viewBtn.getAttribute('data-id');
                            if (!id) return;
                            try {
                                let payload = requestsCache[id] || {
                                    id
                                };
                                if (payload && typeof payload === 'object' && payload.data) payload = payload.data;
                                // normalize
                                const name = payload.user?.name || payload.name || '-';
                                const jenis = payload.jenis || '-';
                                const tMulai = toIsoDate(payload.tanggal_mulai || '');
                                const tSelesai = toIsoDate(payload.tanggal_selesai || '');
                                let durasi = '-';
                                try {
                                    if (tMulai && tSelesai) {
                                        const s = new Date(tMulai);
                                        const eDate = new Date(tSelesai);
                                        if (!isNaN(s) && !isNaN(eDate) && eDate >= s) {
                                            durasi = (Math.round((eDate - s) / (1000 * 60 * 60 * 24)) + 1) +
                                                ' hari';
                                        }
                                    }
                                } catch (err) {
                                    /* ignore */
                                }

                                document.getElementById('detailPengaju').textContent = name;
                                document.getElementById('detailJenis').textContent = jenis;
                                document.getElementById('detailTanggal').textContent = (tMulai || '-') + (tSelesai ?
                                    (' — ' + tSelesai) : '');
                                document.getElementById('detailDurasi').textContent = durasi;
                                document.getElementById('detailTelp').textContent = payload.telp || '-';
                                document.getElementById('detailAlasan').textContent = payload.alasan || '-';
                                document.getElementById('detailStatus').textContent = payload.status || '-';

                                // pelimpahan list
                                const pelEl = document.getElementById('detailPelimpahan');
                                if (pelEl) {
                                    pelEl.innerHTML = '';
                                    // Use delegated_users from API if available
                                    if (payload.delegated_users && Array.isArray(payload.delegated_users) && payload
                                        .delegated_users.length > 0) {
                                        payload.delegated_users.forEach(user => {
                                            const li = document.createElement('li');
                                            li.textContent = user.name + (user.email ? ' (' + user.email +
                                                ')' : '');
                                            pelEl.appendChild(li);
                                        });
                                    } else {
                                        // Fallback to old method
                                        const arr = payload.dilimpahkan_ke || [];
                                        if (Array.isArray(arr) && arr.length) {
                                            arr.forEach(id => {
                                                const u = (window.pelimpahanEmployeesList || []).find(x =>
                                                    String(x.id) === String(id));
                                                const li = document.createElement('li');
                                                li.textContent = u ? (u.name + ' — ' + (u.departemen ||
                                                        '')) :
                                                    String(id);
                                                pelEl.appendChild(li);
                                            });
                                        } else {
                                            pelEl.innerHTML = '<li>-</li>';
                                        }
                                    }
                                }

                                document.getElementById('detailCutiModal').classList.remove('hidden');
                            } catch (err) {
                                console.error('view detail', err);
                                showAlert('error', 'Gagal menampilkan detail.');
                            }
                            return;
                        }

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
                                document.getElementById('editTelp').value = payload.telp || payload.phone || '';
                                document.getElementById('editAlasan').value = payload.alasan || '';

                                clearModalError();
                                updateEditDurasi();

                                // initialize edit pelimpahan selections if available
                                try {
                                    window.editPelimpahanSelectedIds = window.editPelimpahanSelectedIds ||
                                        new Set();
                                    // clear any previous selections in edit UI
                                    const editChipsContainer = document.getElementById('edit_pelimpahan_chips');
                                    const editHiddenInputs = document.getElementById(
                                        'edit_pelimpahan_hidden_inputs');
                                    if (editChipsContainer) editChipsContainer.innerHTML = '';
                                    if (editHiddenInputs) editHiddenInputs.innerHTML = '';

                                    const arr = (payload && payload.dilimpahkan_ke) || [];
                                    if (Array.isArray(arr)) {
                                        arr.forEach(id => {
                                            try {
                                                // Jangan load diri sendiri dari data lama
                                                if (String(id) !== String(window.currentUserId || '')) {
                                                    editAddSelected(id);
                                                }
                                            } catch (e) {}
                                        });
                                    }
                                } catch (e) {
                                    console.debug('init edit pelimpahan', e);
                                }

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

                        // Close modal (detail)
                        if (e.target.closest('[data-action="close-detail-modal"]')) {
                            document.getElementById('detailCutiModal').classList.add('hidden');
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
                                telp: document.getElementById('editTelp').value,
                                dilimpahkan_ke: Array.from(window.editPelimpahanSelectedIds || []).map(x =>
                                    Number(x))
                            };

                            // client-side date order validation
                            if (data.tanggal_mulai && data.tanggal_selesai) {
                                const s = new Date(data.tanggal_mulai);
                                const e = new Date(data.tanggal_selesai);
                                if (isNaN(s) || isNaN(e) || e < s) {
                                    showModalError('Tanggal selesai harus sama atau setelah tanggal mulai.');
                                    return;
                                }
                            }

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
    <?php $__env->stopPush(); ?>

    <!-- Delegation Confirmation Modal -->
    <div id="confirmDelegationModal"
        class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Konfirmasi Pelimpahan Tugas</h3>
                <button data-action="close-delegation-modal" aria-label="Tutup modal"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="delegationModalBody" class="text-sm text-gray-700 mb-4">
                <p>Anda akan melimpahkan tugas sementara ke:</p>
                <ul id="delegationList" class="list-disc list-inside mt-2 text-sm text-gray-800"></ul>
            </div>
            <div class="flex items-center justify-end gap-3">
                <button data-action="cancel-delegation"
                    class="px-4 py-2 rounded bg-gray-100 text-sm text-gray-700">Tidak</button>
                <button data-action="confirm-delegation"
                    class="px-4 py-2 rounded bg-red-600 text-sm text-white">Yakin</button>
            </div>
        </div>
    </div>

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

                <!-- Pelimpahan (edit modal) -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Pelimpahan Tugas (sementara)</label>
                    <div class="flex gap-2 mb-2">
                        <select id="edit_pelimpahan_filter" class="text-xs px-2 py-1 border rounded bg-white">
                            <option value="">Semua divisi</option>
                            <option value="mekanik">Mekanik</option>
                            <option value="elektrik">Elektrik</option>
                            <option value="cleaning">Cleaning</option>
                        </select>
                        <div class="flex-1 relative">
                            <input id="edit_pelimpahan_search" placeholder="Cari karyawan untuk dilimpahkan..."
                                class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-sm" />
                            <div id="edit_pelimpahan_suggestions"
                                class="hidden absolute left-0 right-0 mt-1 bg-white border border-gray-100 rounded shadow-sm z-20">
                            </div>
                        </div>
                        <button id="edit_pelimpahan_clear" type="button"
                            class="px-3 py-2 border rounded text-sm">Bersihkan</button>
                    </div>
                    <div id="edit_pelimpahan_chips" class="flex gap-2 flex-wrap mb-2"></div>
                    <div id="edit_pelimpahan_hidden_inputs"></div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Telp yang bisa dihubungi</label>
                    <input type="tel" id="editTelp" name="telp"
                        placeholder="Nomor telepon / kontak yang bisa dihubungi"
                        class="w-full px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm" />
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

    <!-- Detail Cuti Modal -->
    <div id="detailCutiModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-[720px] w-full mx-4 sm:mx-6 p-4 sm:p-6">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-gray-800">Detail Pengajuan Cuti</h3>
                <button data-action="close-detail-modal" aria-label="Tutup modal"
                    class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-2 text-sm text-gray-700">
                <div><strong>Pengaju:</strong> <span id="detailPengaju">-</span></div>
                <div><strong>Jenis:</strong> <span id="detailJenis">-</span></div>
                <div><strong>Tanggal:</strong> <span id="detailTanggal">-</span></div>
                <div><strong>Durasi:</strong> <span id="detailDurasi">-</span></div>
                <div><strong>Telp:</strong> <span id="detailTelp">-</span></div>
                <div><strong>Alasan:</strong>
                    <div id="detailAlasan" class="text-sm text-gray-600 mt-1">-</div>
                </div>
                <div><strong>Pelimpahan Tugas:</strong>
                    <ul id="detailPelimpahan" class="list-disc list-inside mt-2 text-sm text-gray-800"></ul>
                </div>
                <div><strong>Status:</strong> <span id="detailStatus">-</span></div>
            </div>

            <div class="flex gap-3 pt-4">
                <button data-action="close-detail-modal"
                    class="flex-1 px-3 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm">Tutup</button>
            </div>
        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp5\htdocs\admin-KJT\resources\views/karyawan/pengajuan-cuti.blade.php ENDPATH**/ ?>