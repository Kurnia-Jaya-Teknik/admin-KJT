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
            Pengajuan Magang
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header Section -->
            <div class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengajuan Magang</h1>
                        <p class="text-gray-600 text-base">Monitor semua pengajuan magang dari sekolah dan institusi</p>
                    </div>
                </div>

                <!-- Animated Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Card -->
                    <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-slate-100/60 to-slate-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-slate-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Pengajuan</p>
                            <p class="text-3xl font-bold text-gray-900" data-stat="total"><?php echo e($magangList->total()); ?></p>
                        </div>
                    </div>

                    <!-- Pending Card -->
                    <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-rose-100/60 to-rose-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Permintaan Surat</p>
                            <p class="text-3xl font-bold text-rose-600/80" data-stat="permintaan"><?php echo e($magangList->where('status', 'Permintaan Surat')->count()); ?></p>
                        </div>
                    </div>

                    <!-- Approved Card -->
                    <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100/60 to-green-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Surat Selesai</p>
                            <p class="text-3xl font-bold text-green-600/80" data-stat="selesai"><?php echo e($magangList->where('status', 'Surat Selesai')->count()); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Magang List Section -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($magangList->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gradient-to-r from-gray-50 via-gray-50 to-transparent">
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Peserta Magang</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Institusi</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Program</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-8 py-5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $magangList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $magang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/40 transition-colors duration-200 group" data-magang-id="<?php echo e($magang->id); ?>">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-slate-300 to-slate-400 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                                    <?php echo e(substr($magang->nama_peserta, 0, 1)); ?>

                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm"><?php echo e($magang->nama_peserta); ?></p>
                                                    <p class="text-xs text-gray-500 mt-1"><?php echo e($magang->jurusan); ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <p class="text-sm text-gray-700 font-medium"><?php echo e($magang->sekolah_asal); ?></p>
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="inline-flex items-center gap-2 text-sm text-slate-700 font-medium bg-slate-50 px-4 py-2 rounded-lg border border-slate-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <?php echo e($magang->durasi_hari); ?> hari
                                            </span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($magang->status === 'Permintaan Surat'): ?>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-rose-100/60 to-rose-50/40 text-rose-600/80 border border-rose-200/30 shadow-sm">📬 Permintaan Surat</span>
                                            <?php elseif($magang->status === 'Surat Selesai'): ?>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓ Surat Selesai</span>
                                            <?php elseif($magang->status === 'Ditolak'): ?>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100/60 to-red-50/40 text-red-600/80 border border-red-200/30 shadow-sm">✗ Ditolak</span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100/60 to-gray-50/40 text-gray-600/80 border border-gray-200/30 shadow-sm"><?php echo e($magang->status); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <button class="btn-lihat-detail px-4 py-2 bg-gradient-to-r from-rose-500/80 to-rose-400/70 text-white font-medium rounded-2xl hover:from-rose-500 hover:to-rose-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap group-hover:scale-105" data-magang-id="<?php echo e($magang->id); ?>">
                                                Lihat Detail
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($magangList->hasPages()): ?>
                        <div class="bg-gradient-to-r from-gray-50 to-gray-50 border-t border-gray-100 px-8 py-6">
                            <?php echo e($magangList->links()); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg font-medium">Belum ada pengajuan magang</p>
                        <p class="text-gray-400 text-sm mt-2">Pengajuan akan muncul di sini ketika ada yang mengajukan</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="magangDetailModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-rose-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Magang</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan magang dari peserta</p>
                </div>
                <button onclick="closeMagangDetailModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6" id="magangDetailContent">
                <div class="text-center py-8">
                    <div class="inline-block animate-spin">
                        <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div id="magangDetailActions" class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <!-- Will be populated by JavaScript -->
            </div>
        </div>
    </div>

    <!-- Form Buat Surat Modal (Input Nomor & Tanggal) -->
    <div id="magangCreateSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-rose-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 px-8 py-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Surat Magang</h2>
                    <p class="text-sm text-gray-500 mt-1">Input nomor surat dan tanggal</p>
                </div>
                <button onclick="closeMagangCreateSuratModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8 space-y-6">
                <!-- Nomor Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Surat</label>
                    <input type="text" id="magangNomorSurat" placeholder="Contoh: 001/HRD/2026" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition-all" />
                </div>

                <!-- Tanggal Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Surat</label>
                    <input type="date" id="magangTanggalSurat" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition-all" />
                </div>

                <!-- NIM/NIS Mahasiswa Container (Dynamic) -->
                <div id="magangNimNisContainer">
                    <!-- Will be populated by JavaScript -->
                </div>

                <!-- Info dari Direktur (Read-only) -->
                <div class="bg-amber-50/50 border border-amber-100/40 rounded-2xl p-4">
                    <p class="text-xs font-medium text-amber-700 uppercase tracking-wide mb-2">Permintaan dari Direktur</p>
                    <p class="text-sm text-amber-900"><span class="font-semibold">No Surat:</span> <span id="magangNoSuratDiminta">-</span></p>
                    <p class="text-sm text-amber-900"><span class="font-semibold">Tanggal:</span> <span id="magangTanggalDiminta">-</span></p>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closeMagangCreateSuratModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all duration-300">
                    Batal
                </button>
                <button onclick="submitMagangCreateSurat()" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-rose-500 to-rose-400 text-white font-semibold rounded-2xl hover:from-rose-600 hover:to-rose-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Buat & Preview
                </button>
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div id="magangPdfModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl h-[90vh] flex flex-col animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-rose-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 px-8 py-6 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Preview Surat Magang</h2>
                    <p class="text-sm text-gray-500 mt-1">Pratinjau surat balasan pengajuan magang</p>
                </div>
                <button onclick="closeMagangPdfModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- PDF Viewer -->
            <iframe id="magangPdfFrame" class="flex-1 w-full border-none" src=""></iframe>

            <!-- Modal Actions -->
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closeMagangPdfModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all duration-300">
                    Tutup
                </button>
                <a id="magangDownloadBtn" href="#" download class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-rose-500 to-rose-400 text-white font-semibold rounded-2xl hover:from-rose-600 hover:to-rose-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Download PDF
                </a>
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

<script>
let currentMagangId = null;

function showMagangDetailModal(magangId) {
    currentMagangId = magangId;
    document.getElementById('magangDetailModal').classList.remove('hidden');
    
    fetch(`/admin/magang/${magangId}/detail`)
        .then(r => r.json())
        .then(res => {
            if (!res.ok) {
                alert('Gagal memuat data');
                return;
            }
            
            const d = res.data;
            const html = `
                <!-- Peserta Info Card -->
                <div class="bg-gradient-to-br from-rose-50/40 to-slate-50/30 rounded-2xl p-6 border border-rose-100/30">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-rose-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">${d.nama_peserta}</h3>
                            <p class="text-sm text-gray-600 mt-0.5">${d.jurusan}</p>
                            <p class="text-sm text-gray-500 mt-1">${d.sekolah_asal}</p>
                            <p class="text-xs text-gray-500 mt-2">NIM/NIS: ${d.nim_nis || '-'}</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="flex items-center gap-2 p-3 bg-rose-50/40 border border-rose-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full ${d.status === 'Permintaan Surat' ? 'bg-amber-500/80' : 'bg-green-500/80'}"></div>
                    <span class="font-medium ${d.status === 'Permintaan Surat' ? 'text-amber-700/80' : 'text-green-700/80'}">${d.status}</span>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-lg font-bold text-gray-900">${d.tanggal_mulai}</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-lg font-bold text-gray-900">${d.tanggal_selesai}</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900">${d.durasi_hari} Hari</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">No. Telepon</p>
                        <p class="text-lg font-bold text-gray-900">${d.phone || '-'}</p>
                    </div>
                </div>

                <!-- Keperluan Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">Keperluan Magang</h4>
                    <p class="text-gray-700 leading-relaxed">${d.keperluan || '-'}</p>
                </div>

                <!-- Peserta List Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Daftar Peserta Magang</h4>
                    <div class="space-y-2">
                        ${d.peserta_list && d.peserta_list.length > 0 
                            ? d.peserta_list.map((peserta, idx) => `
                                <div class="flex items-start gap-3 p-3 bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl border border-gray-100/40">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-rose-100/40 text-rose-600/80 font-bold text-sm flex-shrink-0">
                                        ${idx + 1}
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-gray-900">${peserta.nama_peserta}</p>
                                        <p class="text-xs text-gray-600 mt-0.5">${peserta.jurusan}</p>
                                        ${peserta.nim_nis ? `<p class="text-xs text-gray-500 mt-1">NIM/NIS: ${peserta.nim_nis}</p>` : ''}
                                    </div>
                                </div>
                            `).join('')
                            : '<p class="text-sm text-gray-500 italic">Tidak ada data peserta</p>'
                        }
                    </div>
                </div>
            `;
            
            document.getElementById('magangDetailContent').innerHTML = html;
            
            let actionsHtml = '';
            if (d.status === 'Permintaan Surat') {
                actionsHtml = `
                    <button type="button" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-rose-500 to-rose-400 text-white font-semibold rounded-2xl hover:from-rose-600 hover:to-rose-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 btn-buat-surat" data-magang-id="${d.id}" data-nomor-surat="${d.nomor_surat_diminta || ''}" data-tanggal-surat="${d.tanggal_surat_diminta || ''}" data-peserta-list='${JSON.stringify(d.peserta_list)}'>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        Buat Surat
                    </button>
                `;
            } else if (d.status === 'Surat Selesai') {
                actionsHtml = `
                    <button type="button" onclick="openPdfPreview(${d.id})" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-rose-500 to-rose-400 text-white font-semibold rounded-2xl hover:from-rose-600 hover:to-rose-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        Lihat Surat
                    </button>
                `;
            }
            actionsHtml += `
                <button type="button" onclick="closeMagangDetailModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all duration-300">
                    Tutup
                </button>
            `;
            
            document.getElementById('magangDetailActions').innerHTML = actionsHtml;
        })
        .catch(e => {
            console.error(e);
            alert('Error: ' + e.message);
        });
}

function closeMagangDetailModal() {
    document.getElementById('magangDetailModal').classList.add('hidden');
}

/**
 * =============================
 * Form Buat Surat (Admin Input)
 * =============================
 */
function showMagangCreateSuratForm(magangId, noSuratDiminta, tanggalDiminta, pesertaListJson) {
    try {
        console.log('showMagangCreateSuratForm called with:', {magangId, noSuratDiminta, tanggalDiminta, pesertaListJson});
        
        // Parse JSON string ke array jika string
        let pesertaList = pesertaListJson;
        if (typeof pesertaListJson === 'string') {
            pesertaList = JSON.parse(pesertaListJson);
        }
        
        console.log('Parsed pesertaList:', pesertaList);
        
        document.getElementById('magangCreateSuratModal').classList.remove('hidden');
        
        // Tampilkan data dari direktur
        document.getElementById('magangNoSuratDiminta').textContent = noSuratDiminta || '-';
        document.getElementById('magangTanggalDiminta').textContent = tanggalDiminta || '-';
        
        // Pre-fill form dengan data direktur (bisa diubah admin)
        document.getElementById('magangNomorSurat').value = noSuratDiminta || '';
        document.getElementById('magangTanggalSurat').value = tanggalDiminta || '';
        
        // Generate input fields untuk setiap peserta
        const container = document.getElementById('magangNimNisContainer');
        if (pesertaList && pesertaList.length > 0) {
            let html = '<label class="block text-sm font-semibold text-gray-900 mb-3">NIM/NIS Peserta Magang</label>';
            html += '<div class="space-y-3">';
            
            pesertaList.forEach((peserta, idx) => {
                html += `
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-2">${idx + 1}. ${peserta.nama_peserta}</p>
                        <input type="text" 
                               class="magang-nim-nis w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent outline-none transition-all" 
                               placeholder="NIM/NIS untuk ${peserta.nama_peserta}" 
                               data-peserta-id="${peserta.id}"
                               value="${peserta.nim_nis || ''}" />
                    </div>
                `;
            });
            
            html += '</div>';
            container.innerHTML = html;
        }
        
        currentMagangId = magangId;
        closeMagangDetailModal();
        
        console.log('Form opened successfully');
    } catch (error) {
        console.error('Error in showMagangCreateSuratForm:', error);
        alert('Terjadi error saat membuka form: ' + error.message);
    }
}

function closeMagangCreateSuratModal() {
    document.getElementById('magangCreateSuratModal').classList.add('hidden');
}

function submitMagangCreateSurat() {
    try {
        const nomorSurat = document.getElementById('magangNomorSurat').value.trim();
        const tanggalSurat = document.getElementById('magangTanggalSurat').value.trim();
        
        if (!nomorSurat) {
            alert('Nomor surat harus diisi');
            return;
        }
        if (!tanggalSurat) {
            alert('Tanggal surat harus diisi');
            return;
        }
        
        // Collect semua NIM/NIS input dari form
        const nimNisInputs = document.querySelectorAll('.magang-nim-nis');
        const pesertaNimNis = {};
        
        nimNisInputs.forEach(input => {
            const pesertaId = input.getAttribute('data-peserta-id');
            const nimNis = input.value.trim();
            
            if (!nimNis) {
                throw new Error(`NIM/NIS untuk peserta ${pesertaId} harus diisi`);
            }
            
            pesertaNimNis[pesertaId] = nimNis;
        });
        
        if (Object.keys(pesertaNimNis).length === 0) {
            alert('Minimal ada 1 peserta untuk dibuatkan surat');
            return;
        }
        
        // Close form dan buat surat
        closeMagangCreateSuratModal();
        createMagangSurat(currentMagangId, nomorSurat, tanggalSurat, pesertaNimNis);
    } catch (error) {
        console.error('Error in submitMagangCreateSurat:', error);
        alert('Terjadi error: ' + error.message);
    }
}

function approveMagang(magangId) {
    if (!confirm('Setujui pengajuan magang ini?')) return;
    
    fetch(`/admin/magang/${magangId}/approve`, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
        .then(r => r.json())
        .then(res => {
            if (res.ok) {
                alert('Pengajuan magang disetujui');
                closeMagangDetailModal();
                location.reload();
            }
        });
}

function rejectMagang(magangId) {
    if (!confirm('Tolak pengajuan magang ini?')) return;
    
    fetch(`/admin/magang/${magangId}/reject`, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
        .then(r => r.json())
        .then(res => {
            if (res.ok) {
                alert('Pengajuan magang ditolak');
                closeMagangDetailModal();
                location.reload();
            }
        });
}

function createMagangSurat(magangId, nomorSurat, tanggalSurat, pesertaNimNis) {
    // Show loading state and open modal
    document.getElementById('magangPdfModal').classList.remove('hidden');
    const frame = document.getElementById('magangPdfFrame');
    frame.src = 'about:blank';
    frame.style.backgroundColor = '#f5f5f5';
    
    // Send both ID and surat data
    fetch(`/admin/magang/${magangId}/buat-surat`, { 
        method: 'POST', 
        headers: { 
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            nomor_surat_dibuat: nomorSurat,
            tanggal_surat_dibuat: tanggalSurat,
            peserta_nim_nis: pesertaNimNis,
        })
    })
        .then(r => r.json())
        .then(res => {
            console.log('Response dari server:', res);
            if (!res.ok) {
                alert('Error: ' + res.message);
                document.getElementById('magangPdfModal').classList.add('hidden');
                return;
            }
            
            // Decode base64 ke binary
            const binaryString = atob(res.pdfBase64);
            const bytes = new Uint8Array(binaryString.length);
            for (let i = 0; i < binaryString.length; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            
            // Buat blob dari binary
            const blob = new Blob([bytes], { type: 'application/pdf' });
            const blobUrl = URL.createObjectURL(blob);
            
            console.log('PDF Blob URL created:', blobUrl);
            console.log('PDF Blob size:', blob.size, 'bytes');
            
            // Set download button href
            document.getElementById('magangDownloadBtn').href = res.url;
            
            // Ensure iframe is ready before setting src
            const iframe = document.getElementById('magangPdfFrame');
            
            // Clear dan reset iframe
            iframe.src = '';
            
            // Small delay to ensure iframe is properly reset
            setTimeout(() => {
                iframe.src = blobUrl;
                iframe.style.backgroundColor = 'white';
                
                // Update UI tanpa reload halaman
                updateMagangListAfterSuratCreated(magangId);
            }, 100);
        })
        .catch(e => {
            alert('Error: ' + e.message);
            document.getElementById('magangPdfModal').classList.add('hidden');
        });
}

function updateMagangListAfterSuratCreated(magangId) {
    /**
     * Update list view dan stats setelah surat dibuat
     * Tanpa perlu reload halaman
     */
    
    // 1. Find row di table dengan magang ID
    const tableRow = document.querySelector(`tr[data-magang-id="${magangId}"]`);
    if (!tableRow) {
        console.warn('Row tidak ditemukan untuk magang ID:', magangId);
        return;
    }
    
    // 2. Update status badge di row
    const statusCell = tableRow.querySelector('td:nth-child(4)');
    if (statusCell) {
        statusCell.innerHTML = '<span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓ Surat Selesai</span>';
    }
    
    // 3. Update action buttons (ganti dengan "Lihat Surat" saja)
    const actionCell = tableRow.querySelector('td:nth-child(5)');
    if (actionCell) {
        actionCell.innerHTML = '<button onclick="showMagangDetailModal(' + magangId + ')" class="px-4 py-2 bg-gradient-to-r from-rose-500/80 to-rose-400/70 text-white font-medium rounded-2xl hover:from-rose-500 hover:to-rose-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap group-hover:scale-105">Lihat Detail</button>';
    }
    
    // 4. Move row ke atas (reorder)
    const tableBody = document.querySelector('tbody');
    if (tableBody) {
        tableBody.insertBefore(tableRow, tableBody.firstChild);
    }
    
    // 5. Update stats cards
    updateMagangStats();
    
    // 6. Close detail modal
    closeMagangDetailModal();
}

function updateMagangStats() {
    /**
     * Update semua stats cards dengan data terbaru dari server
     * Tanpa reload halaman
     */
    fetch('/admin/magang-stats')
        .then(r => r.json())
        .then(res => {
            if (res.ok) {
                // Update total
                const totalEl = document.querySelector('[data-stat="total"]');
                if (totalEl) totalEl.textContent = res.data.total;
                
                // Update permintaan surat
                const permintaanEl = document.querySelector('[data-stat="permintaan"]');
                if (permintaanEl) permintaanEl.textContent = res.data.permintaan_surat;
                
                // Update surat selesai
                const selesaiEl = document.querySelector('[data-stat="selesai"]');
                if (selesaiEl) selesaiEl.textContent = res.data.surat_selesai;
            }
        })
        .catch(e => console.error('Error updating stats:', e));
}

function openPdfPreview(magangId) {
    if (!magangId) return;
    
    // Show modal with blank iframe
    document.getElementById('magangPdfModal').classList.remove('hidden');
    const frame = document.getElementById('magangPdfFrame');
    frame.src = 'about:blank';
    frame.style.backgroundColor = '#f5f5f5';
    closeMagangDetailModal();
    
    // Use GET endpoint for existing surat (not POST for creating)
    fetch(`/admin/magang/${magangId}/get-surat`)
        .then(r => r.json())
        .then(res => {
            if (!res.ok) {
                alert('Error: ' + res.message);
                return;
            }
            
            // Decode base64 ke binary
            const binaryString = atob(res.pdfBase64);
            const bytes = new Uint8Array(binaryString.length);
            for (let i = 0; i < binaryString.length; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            
            // Buat blob dari binary
            const blob = new Blob([bytes], { type: 'application/pdf' });
            const blobUrl = URL.createObjectURL(blob);
            
            // Set download button href
            document.getElementById('magangDownloadBtn').href = res.url;
            
            // Ensure iframe is ready before setting src
            const iframe = document.getElementById('magangPdfFrame');
            
            // Clear dan reset iframe
            iframe.src = '';
            
            // Small delay to ensure iframe is properly reset
            setTimeout(() => {
                iframe.src = blobUrl;
                iframe.style.backgroundColor = 'white';
            }, 100);
            document.getElementById('magangDownloadBtn').href = res.url;
        })
        .catch(e => alert('Error: ' + e.message));
}

function closeMagangPdfModal() {
    document.getElementById('magangPdfModal').classList.add('hidden');
}

// Initialize event listeners for action buttons
document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol "Lihat Detail" - gunakan event delegation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-lihat-detail')) {
            const magangId = e.target.closest('.btn-lihat-detail').getAttribute('data-magang-id');
            showMagangDetailModal(magangId);
        }
    });

    // Event listener untuk tombol "Buat Surat" - gunakan event delegation
    document.addEventListener('click', function(e) {
        if (e.target.closest('.btn-buat-surat')) {
            const btn = e.target.closest('.btn-buat-surat');
            const magangId = btn.getAttribute('data-magang-id');
            const nomorSurat = btn.getAttribute('data-nomor-surat');
            const tanggalSurat = btn.getAttribute('data-tanggal-surat');
            const pesertaList = JSON.parse(btn.getAttribute('data-peserta-list'));
            showMagangCreateSuratForm(magangId, nomorSurat, tanggalSurat, pesertaList);
        }
    });
});
</script>
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/admin/magang.blade.php ENDPATH**/ ?>