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
            Monitoring Pengajuan Cuti
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header -->
            <div class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengajuan Cuti</h1>
                        <p class="text-gray-600 text-base">Monitor dan kelola semua pengajuan cuti dari karyawan</p>
                    </div>
                    <button onclick="showCreateCutiModal()"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-2xl hover:from-red-700 hover:to-red-600 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 w-fit">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Buat Pengajuan
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Menunggu Persetujuan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-2.414 2.414a1 1 0 101.414 1.414L9 11.414V6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                                <p class="text-2xl font-bold text-gray-900" id="pendingCount">0</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Disetujui -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Disetujui</p>
                                <p class="text-2xl font-bold text-gray-900" id="approvedCount">0</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ditolak -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-red-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Ditolak</p>
                                <p class="text-2xl font-bold text-gray-900" id="rejectedCount">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-4 mb-6 border-b border-gray-100">
                <button onclick="switchTabCuti('pengajuan')" id="tabPengajuan"
                    class="px-6 py-3 font-semibold text-amber-600 border-b-2 border-amber-500 whitespace-nowrap">
                    📋 Pengajuan Cuti (Pending)
                </button>
                <button onclick="switchTabCuti('dibuat')" id="tabDibuat"
                    class="px-6 py-3 font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700 whitespace-nowrap">
                    ✓ Surat yang Dibuat
                </button>
            </div>

            <!-- TAB 1: Pengajuan Cuti -->
            <div id="contentPengajuan" class="bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Karyawan</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Jenis Cuti</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Durasi</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengajuanTableBody">
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada pengajuan cuti</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TAB 2: Surat yang Dibuat -->
            <div id="contentDibuat" class="bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Karyawan</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Jenis Cuti</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Durasi</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Tanggal Dibuat</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="suratDibuatTableBody">
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada surat yang dibuat</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Detail Modal - Updated to Red Theme -->
    <div id="detailModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header - Red Theme -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 p-8 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan cuti karyawan</p>
                </div>
                <button onclick="closeDetailModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6">
                <!-- Karyawan Info Card -->
                <div class="bg-gradient-to-br from-red-50/40 to-slate-50/30 rounded-2xl p-6 border border-red-100/30">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900" id="employeeName">-</h3>
                            <p class="text-sm text-gray-600 mt-0.5" id="employeeIdDept">-</p>
                            <p class="text-sm text-gray-500 mt-1" id="employeeEmail">-</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div id="statusBadge" class="flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div>
                    <span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>
                </div>

                <!-- Cuti Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jenis">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="durasi">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-mulai">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-selesai">-</p>
                    </div>
                </div>

                <!-- Alasan Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">Alasan Pengajuan</h4>
                    <p class="text-gray-700 leading-relaxed" id="alasanText">-</p>
                </div>

                <!-- Timeline -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-gray-900">Riwayat Pengajuan</h4>
                    <div class="space-y-2" id="timelineContainer">
                        <div class="text-gray-500">Memuat...</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div id="actionButtons" class="flex gap-3 pt-4 border-t border-gray-100/40 flex-wrap">
                    <!-- Button 'Lihat Surat' muncul jika surat sudah dibuat -->
                    <button id="lihatSuratBtn" class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Surat
                    </button>
                    <!-- Button 'Buat Surat' hanya muncul jika sudah disetujui direktur -->
                    <button id="buatSuratBtn" onclick="openBuatSuratModal()" class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-2xl hover:from-red-700 hover:to-red-600 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                    <button onclick="closeDetailModal()" class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Surat - Form Input with Red Theme -->
    <div id="buatSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 p-8 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi data untuk membuat surat cuti <span id="formEmployeeName" class="font-medium text-gray-700">-</span></p>
                </div>
                <button onclick="closeBuatSuratModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content - Form -->
            <form id="buatSuratForm" class="p-8 space-y-6">
                <input type="hidden" id="formCutiId" value="">

                <!-- Nomor Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Surat</label>
                    <input type="text" id="formNomorSurat" placeholder="Contoh: 001/SK-HRD/2026" required 
                        class="w-full px-4 py-3 border border-gray-200/50 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Format bebas, contoh: 001/SK-HRD/2026</p>
                </div>

                <!-- Tanggal Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Surat</label>
                    <input type="date" id="formTanggalSurat" required 
                        class="w-full px-4 py-3 border border-gray-200/50 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Tanggal pembuatan surat</p>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-sm font-bold text-gray-900" id="formJenisCuti">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-sm font-bold text-gray-900" id="formDurasi">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-sm font-bold text-gray-900" id="formTanggalMulai">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-sm font-bold text-gray-900" id="formTanggalSelesai">-</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-100/40">
                    <button type="button" onclick="closeBuatSuratModal()" class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-2xl hover:from-red-700 hover:to-red-600 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Surat Modal - Red Theme -->
    <div id="previewSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header - Red Theme -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 px-8 py-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Preview Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1" id="previewTitle"></p>
                </div>
                <button onclick="closePreviewModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto bg-gray-50">
                <iframe id="previewFrame" class="w-full h-full" style="min-height: 600px;" frameborder="0"></iframe>
            </div>
            
            <!-- Footer - Red Theme Button -->
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closePreviewModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all">
                    Tutup
                </button>
                <a id="downloadBtn" href="#" target="_blank" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-2xl hover:from-red-700 hover:to-red-600 shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    Download
                </a>
            </div>
        </div>
    </div>

    <script>
        // Tab switching
        function switchTabCuti(tab) {
            const pengajuan = document.getElementById('contentPengajuan');
            const dibuat = document.getElementById('contentDibuat');
            const tabPengajuan = document.getElementById('tabPengajuan');
            const tabDibuat = document.getElementById('tabDibuat');

            if (tab === 'pengajuan') {
                pengajuan.classList.remove('hidden');
                dibuat.classList.add('hidden');
                tabPengajuan.classList.add('text-amber-600', 'border-amber-500');
                tabPengajuan.classList.remove('text-gray-500', 'border-transparent');
                tabDibuat.classList.remove('text-amber-600', 'border-amber-500');
                tabDibuat.classList.add('text-gray-500', 'border-transparent');
                // Load pengajuan data
                loadPengajuanCuti();
            } else {
                pengajuan.classList.add('hidden');
                dibuat.classList.remove('hidden');
                tabPengajuan.classList.remove('text-amber-600', 'border-amber-500');
                tabPengajuan.classList.add('text-gray-500', 'border-transparent');
                tabDibuat.classList.add('text-amber-600', 'border-amber-500');
                tabDibuat.classList.remove('text-gray-500', 'border-transparent');
                // Load surat dibuat data
                loadSuratDibuatCuti();
            }
        }

        // Load pengajuan cuti table from API
        async function loadPengajuanCuti() {
            const tbody = document.getElementById('pengajuanTableBody');
            
            try {
                const response = await fetch('/admin/cuti/list', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.list) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <p>Gagal memuat data</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                // Filter: Pending requests OR Approved (Disetujui) yang belum ada file_surat
                const pendingCuti = data.list.filter(cuti => 
                    cuti.status === 'Pending' || cuti.can_create_surat
                );
                
                if (pendingCuti.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada pengajuan cuti menunggu</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    updateCutiCounts(data.list);
                    return;
                }

                // Generate table rows
                let html = '';
                pendingCuti.forEach(cuti => {
                    const tanggalMulai = new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalSelesai = new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });

                    html += `
                        <tr class="border-b border-gray-100/50 hover:bg-blue-50/40 transition-colors">
                            <td class="px-8 py-6 text-sm text-gray-900 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-amber-100/60 flex items-center justify-center text-xs font-bold text-amber-600">
                                        ${cuti.user.name.charAt(0).toUpperCase()}
                                    </div>
                                    ${cuti.user.name}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.jenis || '-'}</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.durasi || 0} hari</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${tanggalMulai} - ${tanggalSelesai}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-amber-100/60 text-amber-700 border border-amber-200/30">
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-grid grid-cols-2 gap-2">
                                    <button onclick="showDetailCuti(${cuti.id})" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-blue-500/90 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                    <button onclick="showDetailCuti(${cuti.id})" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-gray-400/90 text-white rounded-lg text-xs font-semibold hover:bg-gray-500 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 2a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v1h1a1 1 0 110 2h-1v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9H2a1 1 0 110-2h1V4a2 2 0 012-2h2V2zm0 5h10v7H5V7z" clip-rule="evenodd"></path>
                                        </svg>
                                        Info
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                tbody.innerHTML = html;
                updateCutiCounts(data.list);

            } catch (error) {
                console.error('Error loading cuti:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-red-500">
                            <p>Error memuat data: ${error.message}</p>
                        </td>
                    </tr>
                `;
            }
        }

        // Load surat dibuat table from API
        async function loadSuratDibuatCuti() {
            const tbody = document.getElementById('suratDibuatTableBody');
            
            try {
                const response = await fetch('/admin/cuti/list', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.list) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <p>Gagal memuat data</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                // Filter surat yang sudah dibuat: status Disetujui AND memiliki file_surat
                const suratDibuat = data.list.filter(cuti => cuti.status === 'Disetujui' && cuti.file_surat);
                
                if (suratDibuat.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada surat yang dibuat</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    updateCutiCounts(data.list);
                    return;
                }

                // Generate table rows
                let html = '';
                suratDibuat.forEach(cuti => {
                    const tanggalMulai = new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalSelesai = new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalDibuat = new Date(cuti.updated_at).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });

                    html += `
                        <tr class="border-b border-gray-100/50 hover:bg-green-50/40 transition-colors">
                            <td class="px-8 py-6 text-sm text-gray-900 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-green-100/60 flex items-center justify-center text-xs font-bold text-green-600">
                                        ${cuti.user.name.charAt(0).toUpperCase()}
                                    </div>
                                    ${cuti.user.name}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.jenis || '-'}</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.durasi || 0} hari</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${tanggalMulai} - ${tanggalSelesai}</td>
                            <td class="px-8 py-6 text-sm text-gray-700 text-center">${tanggalDibuat}</td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-grid grid-cols-2 gap-2">
                                    <button onclick="previewSuratCuti(${cuti.id}, '${cuti.user.name}')" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-blue-500/90 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                    <a href="/storage/${cuti.file_surat}" target="_blank" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-green-500/90 text-white rounded-lg text-xs font-semibold hover:bg-green-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                tbody.innerHTML = html;
                updateCutiCounts(data.list);

            } catch (error) {
                console.error('Error loading surat:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-red-500">
                            <p>Error memuat data: ${error.message}</p>
                        </td>
                    </tr>
                `;
            }
        }

        // Update stats counts
        function updateCutiCounts(cutiList) {
            const pending = cutiList.filter(c => c.status === 'Pending').length;
            const approved = cutiList.filter(c => c.status === 'Disetujui').length;
            const rejected = cutiList.filter(c => c.status === 'Ditolak').length;

            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('approvedCount').textContent = approved;
            document.getElementById('rejectedCount').textContent = rejected;
        }

        // Show detail modal
        async function showDetailCuti(cutiId) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.cuti) {
                    showNotification('Gagal memuat data cuti', 'error');
                    return;
                }

                const cuti = data.cuti;
                const modal = document.getElementById('detailModal');

                // Set employee info
                document.getElementById('employeeName').textContent = cuti.user?.name || '-';
                document.getElementById('employeeIdDept').textContent = 
                    `${cuti.user?.nip || 'N/A'} • ${cuti.user?.departemen?.nama || 'N/A'}`;
                document.getElementById('employeeEmail').textContent = cuti.user?.email || '-';

                // Set status badge
                const statusBadge = document.getElementById('statusBadge');
                let statusColor = 'bg-amber-50/40 border-amber-100/30';
                let statusDotColor = 'bg-amber-500/80 animate-pulse';
                let statusLabel = 'Menunggu Persetujuan';

                if (cuti.status === 'Disetujui') {
                    statusColor = 'bg-green-50/40 border-green-100/30';
                    statusDotColor = 'bg-green-500/80';
                    statusLabel = 'Disetujui Direktur';
                } else if (cuti.status === 'Ditolak') {
                    statusColor = 'bg-red-50/40 border-red-100/30';
                    statusDotColor = 'bg-red-500/80';
                    statusLabel = 'Ditolak';
                }

                statusBadge.className = `flex items-center gap-2 p-3 rounded-2xl w-fit ${statusColor}`;
                statusBadge.innerHTML = `<div class="w-3 h-3 rounded-full ${statusDotColor}"></div><span class="font-medium text-gray-700">Status: ${statusLabel}</span>`;

                // Set cuti details
                document.querySelector('[data-detail="jenis"]').textContent = cuti.jenis || '-';
                document.querySelector('[data-detail="durasi"]').textContent = (cuti.durasi || 0) + ' hari';
                document.querySelector('[data-detail="tanggal-mulai"]').textContent = 
                    new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
                document.querySelector('[data-detail="tanggal-selesai"]').textContent = 
                    new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });

                // Set alasan
                document.getElementById('alasanText').textContent = cuti.alasan || '-';

                // Update timeline
                updateTimelineDisplay(cuti.status, cuti.created_at, cuti.tanggal_persetujuan);

                // Update buttons
                const buatSuratBtn = document.getElementById('buatSuratBtn');
                const lihatSuratBtn = document.getElementById('lihatSuratBtn');
                
                if (cuti.file_surat) {
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) {
                        lihatSuratBtn.classList.remove('hidden');
                        lihatSuratBtn.onclick = () => previewSuratCuti(cutiId, cuti.user.name);
                    }
                } else if (cuti.status === 'Disetujui') {
                    buatSuratBtn.classList.remove('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                    buatSuratBtn.onclick = () => openBuatSuratModal(cutiId, cuti);
                } else {
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                }

                // Store cutiId in modal
                modal.dataset.cutiId = cutiId;

                // Show modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat data cuti', 'error');
            }
        }

        // Update timeline display
        function updateTimelineDisplay(status, createdDate, approvedDate) {
            const timelineContainer = document.getElementById('timelineContainer');
            if (!timelineContainer) return;

            let html = '';

            // Created date
            html += `
                <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-blue-50/40 to-slate-50/30 rounded-2xl border border-blue-100/30">
                    <div class="w-2 h-2 rounded-full bg-blue-500/80 mt-2 flex-shrink-0"></div>
                    <div class="flex-1 text-sm">
                        <p class="font-medium text-gray-900">Pengajuan Dibuat</p>
                        <p class="text-gray-600">${new Date(createdDate).toLocaleDateString('id-ID')}</p>
                    </div>
                </div>
            `;

            // Status-based timeline
            if (status === 'Disetujui') {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-green-50/40 to-slate-50/30 rounded-2xl border border-green-100/30">
                        <div class="w-2 h-2 rounded-full bg-green-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Disetujui Direktur</p>
                            <p class="text-gray-600">${approvedDate ? new Date(approvedDate).toLocaleDateString('id-ID') : 'N/A'}</p>
                        </div>
                    </div>
                `;
            } else if (status === 'Ditolak') {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-red-50/40 to-slate-50/30 rounded-2xl border border-red-100/30">
                        <div class="w-2 h-2 rounded-full bg-red-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Ditolak</p>
                            <p class="text-gray-600">${approvedDate ? new Date(approvedDate).toLocaleDateString('id-ID') : 'N/A'}</p>
                        </div>
                    </div>
                `;
            } else {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50/40 to-slate-50/30 rounded-2xl border border-gray-100/30">
                        <div class="w-2 h-2 rounded-full bg-gray-400/50 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Menunggu Persetujuan Direktur</p>
                            <p class="text-gray-600">Belum diproses</p>
                        </div>
                    </div>
                `;
            }

            timelineContainer.innerHTML = html;
        }

        // Preview surat cuti
        async function previewSuratCuti(cutiId, namaKaryawan) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}/preview`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.ok && data.pdfBase64) {
                    document.getElementById('previewFrame').src = 
                        'data:application/pdf;base64,' + data.pdfBase64;
                    document.getElementById('downloadBtn').href = data.downloadUrl;
                    document.getElementById('previewTitle').textContent = `Surat Cuti - ${namaKaryawan}`;
                    document.getElementById('previewSuratModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    showNotification('Gagal memuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat surat', 'error');
            }
        }

        // Open buat surat modal with data
        function openBuatSuratModal(cutiId, cutiData) {
            // Set hidden ID
            document.getElementById('formCutiId').value = cutiId;
            
            // Set employee name
            document.getElementById('formEmployeeName').textContent = cutiData.user?.name || '-';
            
            // Set cuti info (read-only display)
            document.getElementById('formJenisCuti').textContent = cutiData.jenis || '-';
            document.getElementById('formDurasi').textContent = (cutiData.durasi || 0) + ' hari';
            document.getElementById('formTanggalMulai').textContent = 
                new Date(cutiData.tanggal_mulai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            document.getElementById('formTanggalSelesai').textContent = 
                new Date(cutiData.tanggal_selesai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('formTanggalSurat').value = today;
            
            // Clear nomor surat
            document.getElementById('formNomorSurat').value = '';
            
            // Show modal
            const modal = document.getElementById('buatSuratModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Handle form submission for "Buat Surat"
        document.getElementById('buatSuratForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const cutiId = document.getElementById('formCutiId').value;
            const nomorSurat = document.getElementById('formNomorSurat').value;
            const tanggalSurat = document.getElementById('formTanggalSurat').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            if (!cutiId || !nomorSurat || !tanggalSurat) {
                showNotification('Mohon isi semua field yang diperlukan', 'error');
                return;
            }

            try {
                showNotification('Membuat surat... mohon tunggu', 'info');
                
                const response = await fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nomor_surat: nomorSurat,
                        tanggal_surat: tanggalSurat
                    })
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✅ Surat berhasil dibuat!', 'success');
                    closeBuatSuratModal();
                    
                    // Auto refresh data
                    setTimeout(() => {
                        loadPengajuanCuti();
                        loadSuratDibuatCuti();
                    }, 500);
                } else {
                    showNotification(data.message || 'Gagal membuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan: ' + error.message, 'error');
            }
        });

            const btn = event.target;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Membuat...';

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.ok) {
                    closeBuatSuratModal();
                    closeDetailModal();
                    showNotification('Surat berhasil dibuat!', 'success');
                    // Reload tables
                    loadPengajuanCuti();
                    loadSuratDibuatCuti();
                } else {
                    showNotification(`Error: ${data.message}`, 'error');
                }
            } catch (error) {
                showNotification(`Error: ${error.message}`, 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // Modal functions
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeBuatSuratModal() {
            document.getElementById('buatSuratModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closePreviewModal() {
            document.getElementById('previewSuratModal').classList.add('hidden');
            document.getElementById('previewFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Notification helper
        function showNotification(message, type = 'info') {
            let notification = document.getElementById('notification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'notification';
                notification.className = 'fixed top-4 right-4 max-w-md z-[60]';
                document.body.appendChild(notification);
            }

            let bgColor = 'bg-blue-500';
            if (type === 'success') bgColor = 'bg-green-500';
            if (type === 'error') bgColor = 'bg-red-500';

            notification.innerHTML = `
                <div class="rounded-lg shadow-lg p-4 text-white ${bgColor}">
                    ${message}
                </div>
            `;

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 4000);
        }

        // Close modals on backdrop click
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
        
        document.getElementById('buatSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeBuatSuratModal();
        });
        
        document.getElementById('previewSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closePreviewModal();
        });

        // Load initial data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPengajuanCuti();
        });
    </script>
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
<?php /**PATH C:\xampp5\htdocs\admin-KJT\resources\views/admin/cuti.blade.php ENDPATH**/ ?>