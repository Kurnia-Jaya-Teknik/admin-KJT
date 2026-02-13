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
            Pengajuan Lembur
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-red-50/30 via-slate-50/40 to-white min-h-full">
            <!-- Welcome Header -->
            <div class="mb-6">
                <h1
                    class="text-2xl font-bold bg-gradient-to-r from-red-500 to-red-700 bg-clip-text text-transparent mb-1.5">
                    Pengajuan Lembur</h1>
                <p class="text-sm text-gray-600">Ajukan jam kerja tambahan untuk pekerjaan yang mendesak</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Pengajuan -->
                <div
                    class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <div class="px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-red-50 to-red-100/60">
                        <h3 class="text-base font-bold text-gray-800">Ajukan Lembur Baru</h3>
                    </div>
                    <div class="p-6">
                        <form id="lemburForm" class="space-y-5">
                            <!-- Tanggal Lembur -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Tanggal Lembur</label>
                                <input id="lemburTanggal" type="date"
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                            </div>

                            <!-- Jam Mulai & Selesai -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2.5">Jam Mulai</label>
                                    <input id="lemburMulai" type="time"
                                        class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-2.5">Jam Selesai</label>
                                    <input id="lemburSelesai" type="time"
                                        class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                                </div>
                            </div>

                            <!-- Total Jam -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Total Jam Lembur</label>
                                <div id="lemburTotalContainer"
                                    class="px-4 py-2.5 bg-gradient-to-r from-red-50 to-red-100/60 border border-red-200/50 rounded-xl">
                                    <p id="lemburTotal" class="text-gray-800 font-bold text-sm">-</p>
                                </div>
                                <div id="lemburTotalError" class="text-red-600 text-xs mt-2 hidden"></div>
                                <p class="text-xs text-gray-400 mt-2">Otomatis terhitung dari jam mulai dan selesai</p>
                            </div>

                            <!-- Keterangan Pekerjaan -->
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Keterangan
                                    Pekerjaan</label>
                                <textarea id="lemburKeterangan" rows="4" placeholder="Jelaskan pekerjaan apa yang akan dilakukan selama lembur..."
                                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm resize-none text-gray-700 placeholder-gray-400"></textarea>
                            </div>

                            <!-- Info -->
                            <div
                                class="bg-gradient-to-r from-red-50 to-red-100/60 border border-red-200/50 rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-1.5 bg-red-100 rounded-lg flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        <span class="font-medium text-gray-700">Catatan:</span> Lembur hanya bisa
                                        diajukan maksimal 3 jam per hari dan memerlukan persetujuan dari direktur.
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="flex gap-3 pt-2">
                                <button id="submitLembur" type="submit"
                                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-700 text-white font-semibold rounded-xl hover:from-red-600 hover:to-red-800 shadow-md hover:shadow-lg transition-all duration-300 text-sm">
                                    Ajukan Lembur
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
                    class="bg-white rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-red-50 to-red-100/60">
                        <h3 class="text-base font-bold text-gray-800">Informasi Lembur</h3>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-2">Total Lembur Bulan
                                Ini</p>
                            <p
                                class="text-2xl font-bold bg-gradient-to-r from-red-500 to-red-700 bg-clip-text text-transparent">
                                12 jam</p>
                            <p class="text-xs text-gray-500 mt-2">Dari 6 pengajuan</p>
                        </div>
                        <div class="border-t border-gray-100/50 pt-5">
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Kebijakan Lembur
                            </p>
                            <ul class="space-y-2.5 text-xs text-gray-600">
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-600 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Max 3 jam per hari</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-600 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Max 20 jam per bulan</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-600 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Lembur hari libur prioritas rendah</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-red-600 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed">Persetujuan dari direktur</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pengajuan Lembur -->
            <div
                class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="px-6 py-4 border-b border-gray-200/50 bg-gradient-to-r from-red-50 to-red-100/60">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-gray-800">Riwayat Pengajuan Lembur</h3>
                        
                    </div>
                </div>
                <div id="lemburHistory" class="divide-y divide-gray-100/50">
                    <!-- History will be rendered here by JS -->
                    

                    <!-- Item 2 - Approved -->
                    

                    <!-- Item 3 - Pending -->
                    

                    <!-- Item 4 - Approved -->
                    
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
        <script>
            (function() {
                const API_BASE_RAW = <?php echo json_encode(rtrim(request()->getSchemeAndHttpHost() . request()->getBaseUrl(), '/')); ?>;
                const API_BASE = (API_BASE_RAW && API_BASE_RAW.indexOf(String.fromCharCode(123, 123)) === -1) ?
                    API_BASE_RAW : (window.location.origin + window.location.pathname.substring(0, window.location.pathname
                        .lastIndexOf(String.fromCharCode(47))));

                function apiPath(path) {
                    if (path.startsWith("/api/") || path.startsWith("/session/")) return window.location.origin + path;
                    return API_BASE + path;
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

                function showToast(type, msg) {
                    console.debug('[lembur] toast', type, msg);
                    alert((type === 'success' ? '✅ ' : '❌ ') + msg);
                }

                async function fetchHistory() {
                    try {
                        const res = await fetch('/karyawan/api/lembur', {
                            headers: getAuthHeaders(),
                            credentials: 'same-origin'
                        });
                        const container = document.getElementById('lemburHistory');
                        if (!container) return;

                        if (!res.ok) {
                            console.error('Failed to fetch history', res.status);
                            container.innerHTML =
                                '<div class="text-center py-6 text-gray-500">Gagal memuat riwayat (status ' + res
                                .status + ')</div>';
                            return;
                        }

                        const json = await res.json();
                        console.debug('[lembur] fetchHistory result', json);

                        // cache latest items for quick lookup in preview/edit
                        lemburCache = json.data || [];

                        container.innerHTML = '';

                        if (!lemburCache.length) {
                            container.innerHTML =
                                '<div class="text-center py-6 text-gray-500">Belum ada pengajuan lembur</div>';
                            return;
                        }

                        lemburCache.forEach(item => {
                            // Status styling
                            let statusBadge, iconBg, iconColor, hoverBg;
                            if (item.status === 'Pending') {
                                statusBadge =
                                    '<span class="px-3 py-1 bg-amber-100/80 text-amber-700 text-xs font-semibold rounded-lg shadow-sm border border-amber-200/50">⏱️ Menunggu Persetujuan</span>';
                                iconBg = 'from-amber-50/70 to-amber-100/50';
                                iconColor = 'text-amber-600';
                                hoverBg = 'hover:from-amber-50/40';
                            } else if (item.status === 'Disetujui') {
                                statusBadge =
                                    '<span class="px-3 py-1 bg-green-100/80 text-green-700 text-xs font-semibold rounded-lg shadow-sm border border-green-200/50">✓ Disetujui</span>';
                                iconBg = 'from-green-50/70 to-green-100/50';
                                iconColor = 'text-green-600';
                                hoverBg = 'hover:from-green-50/40';
                            } else {
                                statusBadge =
                                    '<span class="px-3 py-1 bg-red-100/80 text-red-700 text-xs font-semibold rounded-lg shadow-sm border border-red-200/50">✕ Ditolak</span>';
                                iconBg = 'from-red-50/70 to-red-100/50';
                                iconColor = 'text-red-600';
                                hoverBg = 'hover:from-red-50/40';
                            }

                            // Format tanggal
                            const dateStr = new Date(item.tanggal).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'long',
                                year: 'numeric'
                            });

                            const el = document.createElement('div');
                            el.className =
                                `px-6 py-5 hover:bg-gradient-to-r ${hoverBg} hover:to-transparent transition-all duration-300 group border-b border-gray-100/50 last:border-0`;

                            // Action buttons with better styling
                            const actions = item.status === 'Pending' ? `
                                <div class="flex gap-2 mt-3">
                                    <button onclick="previewLembur(${item.id})" class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat Detail
                                    </button>
                                    <button onclick="editLembur(${item.id})" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        Edit
                                    </button>
                                    <button onclick="deleteLembur(${item.id})" class="flex items-center gap-1.5 px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus
                                    </button>
                                </div>
                            ` : `
                                <div class="flex gap-2 mt-3">
                                    <button onclick="previewLembur(${item.id})" class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-medium rounded-lg transition-colors duration-200 shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat Detail
                                    </button>
                                </div>
                            `;

                            el.innerHTML = `
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br ${iconBg} flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-sm border border-white/50">
                                        <svg class="w-6 h-6 ${iconColor}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between gap-3 mb-2">
                                            <div class="flex-1">
                                                <h4 class="text-sm font-semibold text-gray-800 mb-1">
                                                    Lembur ${item.durasi_jam} Jam
                                                </h4>
                                                <div class="flex items-center gap-2 text-xs text-gray-600">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="font-medium">${dateStr}</span>
                                                </div>
                                                <div class="flex items-center gap-2 text-xs text-gray-600 mt-1">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span>${item.jam_mulai} - ${item.jam_selesai} WIB</span>
                                                </div>
                                            </div>
                                            ${statusBadge}
                                        </div>
                                        <div class="bg-gray-50/80 rounded-lg px-3 py-2 mt-2 border border-gray-100">
                                            <div class="flex items-start gap-2">
                                                <svg class="w-3.5 h-3.5 text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <div class="flex-1">
                                                    <p class="text-xs font-medium text-gray-500 mb-0.5">Keterangan Pekerjaan:</p>
                                                    <p class="text-xs text-gray-700 leading-relaxed">${item.keterangan || 'Tidak ada keterangan'}</p>
                                                </div>
                                            </div>
                                        </div>
                                        ${actions}
                                    </div>
                                </div>
                            `;
                            container.appendChild(el);
                        });
                    } catch (err) {
                        console.error('fetchHistory error', err);
                    }
                }

                // modal & actions helper functions
                let lemburCache = [];

                function ensureLemburModal() {
                    if (document.getElementById('lemburModal')) return;
                    const modal = document.createElement('div');
                    modal.id = 'lemburModal';
                    modal.className =
                        'fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4';
                    modal.innerHTML = `
                        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden border border-gray-200">
                            <!-- Header -->
                            <div class="px-6 py-5 bg-gradient-to-r from-red-500 to-red-700 border-b border-red-800/20">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg border border-white/30">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 id="lemburModalTitle" class="text-xl font-bold text-white">Detail Pengajuan Lembur</h3>
                                            <p id="lemburModalSubtitle" class="text-xs text-white/80 mt-0.5">Informasi lengkap pengajuan lembur</p>
                                        </div>
                                    </div>
                                    <button id="lemburModalClose" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/20 text-white/90 hover:text-white transition-all duration-200 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Body -->
                            <div id="lemburModalBody" class="p-8 space-y-6 bg-gradient-to-br from-gray-50/50 to-white max-h-[70vh] overflow-y-auto">
                                <!-- Tanggal Lembur -->
                                <div class="group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                            <span class="text-lg">📅</span>
                                        </div>
                                        Tanggal Lembur
                                    </label>
                                    <input id="modalTanggal" type="date" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-sm text-gray-800 font-medium shadow-sm" />
                                </div>
                                
                                <!-- Jam Mulai & Selesai -->
                                <div class="grid grid-cols-2 gap-5">
                                    <div class="group">
                                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                                <span class="text-lg">⏰</span>
                                            </div>
                                            Jam Mulai
                                        </label>
                                        <input id="modalMulai" type="time" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-sm text-gray-800 font-medium shadow-sm" />
                                    </div>
                                    <div class="group">
                                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                                <span class="text-lg">⏱️</span>
                                            </div>
                                            Jam Selesai
                                        </label>
                                        <input id="modalSelesai" type="time" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-sm text-gray-800 font-medium shadow-sm" />
                                    </div>
                                </div>
                                
                                <!-- Durasi -->
                                <div class="group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                            <span class="text-lg">⏳</span>
                                        </div>
                                        Total Durasi Lembur
                                    </label>
                                    <div class="px-5 py-4 bg-gradient-to-r from-red-50 to-red-100/50 border-2 border-red-200/50 rounded-xl shadow-sm">
                                        <div id="modalDurasi" class="text-2xl font-bold bg-gradient-to-r from-red-500 to-red-700 bg-clip-text text-transparent">-</div>
                                    </div>
                                </div>
                                
                                <!-- Keterangan -->
                                <div class="group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                            <span class="text-lg">📝</span>
                                        </div>
                                        Keterangan Pekerjaan
                                    </label>
                                    <textarea id="modalKeterangan" rows="4" placeholder="Jelaskan pekerjaan yang dilakukan selama lembur..." class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-sm resize-none text-gray-700 placeholder-gray-400 shadow-sm leading-relaxed"></textarea>
                                </div>
                                
                                <!-- Status -->
                                <div class="group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-50 to-red-100/60 flex items-center justify-center">
                                            <span class="text-lg">📊</span>
                                        </div>
                                        Status Pengajuan
                                    </label>
                                    <div id="modalStatus" class="px-5 py-4 bg-gradient-to-r from-red-50 to-red-100/50 border-2 border-red-200/50 rounded-xl shadow-sm">
                                        <div class="text-sm font-semibold text-gray-800">-</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Footer -->
                            <div class="px-8 py-5 bg-gray-50/80 border-t border-gray-200 flex justify-end gap-3">
                                <button id="modalDeleteBtn" class="hidden flex items-center gap-2 px-5 py-3 bg-white hover:bg-red-50 border-2 border-red-300 text-red-700 font-bold rounded-xl transition-all duration-200 text-sm shadow-sm hover:shadow-md hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus Pengajuan
                                </button>
                                <button id="modalSaveBtn" class="hidden flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white font-bold rounded-xl transition-all duration-200 text-sm shadow-md hover:shadow-lg hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                                <button id="modalCloseBtn" class="flex items-center gap-2 px-5 py-3 bg-white hover:bg-gray-100 border-2 border-gray-300 text-gray-700 font-bold rounded-xl transition-all duration-200 text-sm shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Tutup
                                </button>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(modal);
                    document.getElementById('lemburModalClose').addEventListener('click', closeLemburModal);
                    document.getElementById('modalCloseBtn').addEventListener('click', closeLemburModal);

                    // Close on backdrop click
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) closeLemburModal();
                    });
                }

                function openLemburModal(mode, lembur) {
                    ensureLemburModal();
                    const modal = document.getElementById('lemburModal');
                    const modalTitle = document.getElementById('lemburModalTitle');
                    const modalSubtitle = document.getElementById('lemburModalSubtitle');

                    // Update title and subtitle based on mode
                    if (mode === 'edit') {
                        modalTitle.textContent = 'Edit Pengajuan Lembur';
                        modalSubtitle.textContent = 'Ubah informasi pengajuan lembur Anda';
                    } else {
                        modalTitle.textContent = 'Detail Pengajuan Lembur';
                        modalSubtitle.textContent = 'Informasi lengkap pengajuan lembur';
                    }

                    // populate
                    document.getElementById('modalTanggal').value = lembur.tanggal ? lembur.tanggal.split('T')[0] : '';
                    document.getElementById('modalMulai').value = lembur.jam_mulai || '';
                    document.getElementById('modalSelesai').value = lembur.jam_selesai || '';
                    document.getElementById('modalKeterangan').value = lembur.keterangan || '';

                    // Status with badge styling
                    const statusEl = document.getElementById('modalStatus');
                    let statusHtml = '';
                    if (lembur.status === 'Pending') {
                        statusHtml =
                            '<div class="flex items-center gap-3"><span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-700 text-sm font-bold rounded-lg border-2 border-amber-200 shadow-sm"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>Menunggu Persetujuan</span></div>';
                    } else if (lembur.status === 'Disetujui') {
                        statusHtml =
                            '<div class="space-y-2"><div class="flex items-center gap-3"><span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 text-sm font-bold rounded-lg border-2 border-green-200 shadow-sm"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>Disetujui</span></div>';
                        if (lembur.approver?.name) {
                            statusHtml +=
                                '<p class="text-xs text-gray-600 font-medium pl-1">Disetujui oleh: <span class="text-gray-800 font-bold">' +
                                lembur.approver.name + '</span></p>';
                        }
                        statusHtml += '</div>';
                    } else {
                        statusHtml =
                            '<div class="space-y-2"><div class="flex items-center gap-3"><span class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 text-red-700 text-sm font-bold rounded-lg border-2 border-red-200 shadow-sm"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>Ditolak</span></div>';
                        if (lembur.keterangan_persetujuan) {
                            statusHtml +=
                                '<div class="bg-red-50 border-l-4 border-red-300 p-3 rounded"><p class="text-xs text-gray-600 font-medium mb-1">Alasan Penolakan:</p><p class="text-sm text-gray-800">' +
                                lembur.keterangan_persetujuan + '</p></div>';
                        }
                        statusHtml += '</div>';
                    }
                    statusEl.innerHTML = statusHtml;

                    // compute durasi
                    if (lembur.jam_mulai && lembur.jam_selesai) {
                        const s = new Date('1970-01-01T' + lembur.jam_mulai + ':00Z');
                        const e = new Date('1970-01-01T' + lembur.jam_selesai + ':00Z');
                        let diff = Math.round(((e - s) / 3600000) * 100) / 100;
                        if (!isFinite(diff)) diff = 0;
                        document.getElementById('modalDurasi').textContent = formatHours(diff);
                    } else {
                        document.getElementById('modalDurasi').textContent = '-';
                    }

                    // mode controls
                    const saveBtn = document.getElementById('modalSaveBtn');
                    const delBtn = document.getElementById('modalDeleteBtn');
                    const tanggalInput = document.getElementById('modalTanggal');
                    const mulaiInput = document.getElementById('modalMulai');
                    const selesaiInput = document.getElementById('modalSelesai');
                    const keteranganInput = document.getElementById('modalKeterangan');

                    if (mode === 'edit' && lembur.status === 'Pending') {
                        saveBtn.classList.remove('hidden');
                        delBtn.classList.remove('hidden');
                        tanggalInput.removeAttribute('disabled');
                        mulaiInput.removeAttribute('disabled');
                        selesaiInput.removeAttribute('disabled');
                        keteranganInput.removeAttribute('disabled');

                        // Enable styling for edit mode
                        tanggalInput.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        mulaiInput.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        selesaiInput.classList.remove('bg-gray-100', 'cursor-not-allowed');
                        keteranganInput.classList.remove('bg-gray-100', 'cursor-not-allowed');

                        saveBtn.onclick = async function() {
                            const tanggal = tanggalInput.value;
                            const jamMulai = mulaiInput.value;
                            const jamSelesai = selesaiInput.value;
                            const keterangan = keteranganInput.value;
                            if (!tanggal || !jamMulai || !jamSelesai) {
                                alert('⚠️ Tanggal dan jam harus diisi');
                                return;
                            }
                            const s = new Date('1970-01-01T' + jamMulai + ':00Z');
                            const e = new Date('1970-01-01T' + jamSelesai + ':00Z');
                            let diff = Math.round(((e - s) / 3600000) * 100) / 100;
                            if (diff <= 0) {
                                alert('⚠️ Jam selesai harus lebih besar dari jam mulai');
                                return;
                            }
                            if (diff > 3) {
                                alert('⚠️ Durasi lembur maksimal 3 jam per hari');
                                return;
                            }

                            try {
                                saveBtn.disabled = true;
                                saveBtn.innerHTML =
                                    '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...';

                                const res = await fetch('/karyawan/api/lembur/' + lembur.id, {
                                    method: 'PUT',
                                    headers: getAuthHeaders(),
                                    credentials: 'same-origin',
                                    body: JSON.stringify({
                                        tanggal,
                                        jam_mulai: jamMulai,
                                        jam_selesai: jamSelesai,
                                        keterangan
                                    })
                                });
                                const json = await res.json();
                                if (res.ok && json.ok) {
                                    showToast('success', 'Perubahan tersimpan');
                                    closeLemburModal();
                                    fetchHistory();
                                } else {
                                    showToast('error', json.message || 'Gagal menyimpan perubahan');
                                }
                            } catch (err) {
                                console.error('save edit error', err);
                                showToast('error', 'Terjadi kesalahan saat menyimpan');
                            } finally {
                                saveBtn.disabled = false;
                                saveBtn.innerHTML =
                                    '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Simpan Perubahan';
                            }
                        };

                        delBtn.onclick = function() {
                            window.deleteLembur(lembur.id);
                        };
                    } else {
                        // Preview mode - disable all inputs
                        saveBtn.classList.add('hidden');
                        delBtn.classList.add('hidden');
                        tanggalInput.setAttribute('disabled', 'disabled');
                        mulaiInput.setAttribute('disabled', 'disabled');
                        selesaiInput.setAttribute('disabled', 'disabled');
                        keteranganInput.setAttribute('disabled', 'disabled');

                        // Disabled styling
                        tanggalInput.classList.add('bg-gray-100', 'cursor-not-allowed');
                        mulaiInput.classList.add('bg-gray-100', 'cursor-not-allowed');
                        selesaiInput.classList.add('bg-gray-100', 'cursor-not-allowed');
                        keteranganInput.classList.add('bg-gray-100', 'cursor-not-allowed');

                        saveBtn.onclick = null;
                        delBtn.onclick = null;
                    }

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeLemburModal() {
                    const modal = document.getElementById('lemburModal');
                    if (!modal) return;
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }

                // Expose functions to global scope for onclick handlers
                window.previewLembur = function(id) {
                    const lembur = lemburCache.find(l => Number(l.id) === Number(id));
                    if (!lembur) return showToast('error', 'Data tidak ditemukan');
                    openLemburModal('preview', lembur);
                }

                window.editLembur = function(id) {
                    const lembur = lemburCache.find(l => Number(l.id) === Number(id));
                    if (!lembur) return showToast('error', 'Data tidak ditemukan');
                    openLemburModal('edit', lembur);
                }

                window.deleteLembur = async function(id) {
                    if (!confirm('Yakin ingin menghapus pengajuan lembur ini?')) return;
                    try {
                        const res = await fetch('/karyawan/api/lembur/' + id, {
                            method: 'DELETE',
                            headers: getAuthHeaders(),
                            credentials: 'same-origin'
                        });
                        const json = await res.json();
                        if (res.ok && json.ok) {
                            showToast('success', 'Pengajuan lembur dihapus');
                            closeLemburModal();
                            fetchHistory();
                        } else {
                            showToast('error', json.message || 'Gagal menghapus');
                        }
                    } catch (err) {
                        console.error('delete error', err);
                        showToast('error', 'Terjadi kesalahan saat menghapus');
                    }
                }

                document.getElementById('lemburForm').addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const tanggal = document.getElementById('lemburTanggal').value;
                    const jamMulai = document.getElementById('lemburMulai').value;
                    const jamSelesai = document.getElementById('lemburSelesai').value;
                    const keterangan = document.getElementById('lemburKeterangan').value;

                    if (!tanggal || !jamMulai || !jamSelesai) {
                        showToast('error', 'Tanggal, jam mulai dan jam selesai harus diisi');
                        return;
                    }

                    // compute duration
                    const s = new Date('1970-01-01T' + jamMulai + ':00Z');
                    const eTime = new Date('1970-01-01T' + jamSelesai + ':00Z');
                    let diff = (eTime - s) / 3600000;
                    diff = Math.round(diff * 100) / 100;
                    if (diff <= 0) {
                        showToast('error', 'Jam selesai harus lebih besar dari jam mulai');
                        return;
                    }
                    if (diff > 3) {
                        showToast('error', 'Durasi lembur maksimal 3 jam per hari');
                        return;
                    }

                    try {
                        const res = await fetch('/karyawan/api/lembur', {
                            method: 'POST',
                            headers: getAuthHeaders(),
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                tanggal,
                                jam_mulai: jamMulai,
                                jam_selesai: jamSelesai,
                                keterangan
                            })
                        });

                        const json = await res.json();
                        if (res.status === 201 && json.ok) {
                            showToast('success', 'Pengajuan lembur berhasil dikirim');
                            // reload history
                            fetchHistory();
                            // reset form
                            document.getElementById('lemburForm').reset();
                        } else {
                            showToast('error', json.message || 'Gagal mengajukan lembur');
                        }
                    } catch (err) {
                        console.error('submit lembur error', err);
                        showToast('error', 'Terjadi kesalahan saat mengajukan lembur');
                    }
                });

                // initial load

                function formatHours(h) {
                    return Number.isInteger(h) ? h + ' jam' : h.toFixed(2) + ' jam';
                }

                function updateTotalDisplay() {
                    const start = document.getElementById('lemburMulai')?.value;
                    const end = document.getElementById('lemburSelesai')?.value;
                    const totalEl = document.getElementById('lemburTotal');
                    const errEl = document.getElementById('lemburTotalError');
                    const submitBtn = document.getElementById('submitLembur');

                    if (errEl) {
                        errEl.classList.add('hidden');
                        errEl.textContent = '';
                    }

                    if (!start || !end) {
                        if (totalEl) totalEl.textContent = '-';
                        if (submitBtn) submitBtn.removeAttribute('disabled');
                        return;
                    }

                    const s = new Date('1970-01-01T' + start + ':00Z');
                    const eTime = new Date('1970-01-01T' + end + ':00Z');
                    let diff = (eTime - s) / 3600000;
                    diff = Math.round(diff * 100) / 100;

                    if (diff <= 0) {
                        if (totalEl) totalEl.textContent = '-';
                        if (errEl) {
                            errEl.textContent = 'Jam selesai harus lebih besar dari jam mulai.';
                            errEl.classList.remove('hidden');
                        }
                        if (submitBtn) submitBtn.setAttribute('disabled', 'disabled');
                        return;
                    }

                    if (diff > 3) {
                        if (totalEl) totalEl.textContent = formatHours(diff);
                        if (errEl) {
                            errEl.textContent = 'Durasi lembur maksimal 3 jam per hari.';
                            errEl.classList.remove('hidden');
                        }
                        if (submitBtn) submitBtn.setAttribute('disabled', 'disabled');
                        return;
                    }

                    if (totalEl) totalEl.textContent = formatHours(diff);
                    if (submitBtn) submitBtn.removeAttribute('disabled');
                }

                // wire live updates
                document.getElementById('lemburMulai')?.addEventListener('input', updateTotalDisplay);
                document.getElementById('lemburSelesai')?.addEventListener('input', updateTotalDisplay);

                // initial load
                updateTotalDisplay();
                fetchHistory();

                // Test helper: create a quick lembur for current user (helpful while debugging)
                document.getElementById('createTestLemburBtn')?.addEventListener('click', async function() {
                    if (!confirm('Buat pengajuan lembur test untuk akun Anda (2 jam, sekarang+2)?')) return;
                    const now = new Date();
                    const start = now.toISOString().substring(11, 16);
                    const endDate = new Date(now.getTime() + (2 * 60 * 60 * 1000));
                    const end = endDate.toISOString().substring(11, 16);
                    const tanggal = now.toISOString().substring(0, 10);

                    try {
                        const btn = document.getElementById('createTestLemburBtn');
                        btn.setAttribute('disabled', 'disabled');
                        btn.textContent = 'Membuat...';

                        const res = await fetch('/karyawan/api/lembur', {
                            method: 'POST',
                            headers: getAuthHeaders(),
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                tanggal,
                                jam_mulai: start,
                                jam_selesai: end,
                                keterangan: 'Test lembur otomatis'
                            })
                        });
                        const json = await res.json();
                        if (res.status === 201 && json.ok) {
                            showToast('success', 'Lembur test dibuat');
                            fetchHistory();
                        } else {
                            showToast('error', json.message || 'Gagal membuat lembur test');
                        }
                    } catch (err) {
                        console.error('create test error', err);
                        showToast('error', 'Terjadi kesalahan saat membuat lembur test');
                    } finally {
                        const btn = document.getElementById('createTestLemburBtn');
                        if (btn) {
                            btn.removeAttribute('disabled');
                            btn.textContent = 'Buat Lembur Test';
                        }
                    }
                });
            })();
        </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/karyawan/pengajuan-lembur.blade.php ENDPATH**/ ?>