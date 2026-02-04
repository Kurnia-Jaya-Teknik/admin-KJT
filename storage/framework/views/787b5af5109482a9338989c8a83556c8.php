<!-- Sidebar -->
<aside class="w-64 h-full bg-white shadow-sm border-r border-gray-200 flex flex-col">
    <div class="p-6 flex-1 overflow-y-auto">
        <!-- User Info -->
        <div class="flex items-center space-x-3 mb-8 pb-6 border-b border-gray-100">
            <div
                class="w-12 h-12 rounded-full bg-gradient-to-br from-red-600 to-slate-700 flex items-center justify-center text-white font-semibold text-lg shadow-md">
                <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

            </div>
            <div>
                <p class="font-semibold text-gray-800"><?php echo e(Auth::user()->name); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'admin_hrd'): ?>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Admin HRD
                    </span>
                <?php elseif(Auth::user()->role === 'direktur'): ?>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Direktur
                    </span>
                <?php else: ?>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                        Karyawan
                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(Auth::user()->departemen): ?>
                    <p class="text-xs text-gray-500 mt-1"><?php echo e(Auth::user()->departemen->nama); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'admin_hrd'): ?>
                <!-- Admin HRD Menu -->
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>

                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('dashboard') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="<?php echo e(route('admin.karyawan')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.karyawan') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Manajemen Karyawan</span>
                </a>

                <a href="<?php echo e(route('admin.cuti')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.cuti') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Pengajuan Cuti</span>
                </a>

                <a href="<?php echo e(route('admin.magang')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.magang') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C6.248 6.253 2 10.5 2 15.5S6.248 24.747 12 24.747s10-4.244 10-9.247S17.752 6.253 12 6.253z" />
                    </svg>
                    <span>Pengajuan Magang</span>
                </a>

                <a href="<?php echo e(route('admin.surat')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.surat') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Manajemen Surat</span>
                </a>

                <a href="<?php echo e(route('admin.template')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.template') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span>Template Surat</span>
                </a>

                <a href="<?php echo e(route('admin.riwayat-surat')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('admin.riwayat-surat') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                    <span>Arsip & Laporan</span>
                </a>
            <?php elseif(Auth::user()->role === 'direktur'): ?>
                <!-- Direktur Menu -->
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>

                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('dashboard') && !request()->routeIs('direktur.*') ? 'bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 font-medium' : 'text-gray-600 hover:bg-green-50 hover:text-green-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="<?php echo e(route('direktur.persetujuan-cuti-lembur')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('direktur.persetujuan-cuti-lembur') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Persetujuan Cuti & Izin Sakit</span>
                </a>

                <a href="<?php echo e(route('direktur.persetujuan-lembur')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('direktur.persetujuan-lembur') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Persetujuan Lembur</span>
                </a>

                <a href="<?php echo e(route('direktur.persetujuan-surat')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('direktur.persetujuan-surat') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Persetujuan Surat</span>
                </a>

                <a href="<?php echo e(route('direktur.ringkasan-karyawan')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('direktur.ringkasan-karyawan') || request()->routeIs('direktur.ringkasan-karyawan.kelola') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span>Ringkasan Karyawan</span>
                </a>

                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-8 mb-3">Lainnya</p>

                <div class="relative">
                    <button type="button" onclick="toggleReportsMenu()"
                        class="w-full flex items-center justify-between space-x-3 px-4 py-3 rounded-xl transition-all duration-200 text-gray-600 hover:bg-red-50 hover:text-red-700">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Laporan</span>
                        </span>
                        <svg id="reportsMenuIcon" class="w-4 h-4 text-gray-400 transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="reportsMenu" class="mt-2 ml-2 mr-2 space-y-2 hidden">
                        <a href="<?php echo e(route('direktur.laporan')); ?>"
                            class="block px-3 py-2 rounded hover:bg-gray-100 text-sm text-gray-700">Ringkasan
                            Laporan</a>

                        <div class="border-l pl-3">
                            <p class="text-xs text-gray-500 mb-2">Laporan</p>
                            <ul class="space-y-1">
                                <li><a href="<?php echo e(route('direktur.laporan.absensi')); ?>"
                                        class="block px-3 py-2 rounded hover:bg-gray-100 text-sm text-gray-700">Laporan
                                        Absensi</a></li>
                                <li><a id="sidebarReportCutiLink" href="<?php echo e(route('direktur.laporan.cuti')); ?>"
                                        class="block px-3 py-2 rounded hover:bg-gray-100 text-sm text-gray-700">Laporan
                                        Cuti</a></li>
                                <li><a href="<?php echo e(route('direktur.laporan.lembur')); ?>"
                                        class="block px-3 py-2 rounded hover:bg-gray-100 text-sm text-gray-700">Laporan
                                        Lembur</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(route('direktur.riwayat-persetujuan')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('direktur.riwayat-persetujuan') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Riwayat Persetujuan</span>
                </a>
            <?php else: ?>
                <!-- Karyawan Menu -->
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>

                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('dashboard') && !request()->routeIs('karyawan.*') ? 'bg-gradient-to-r from-slate-50 to-gray-50 text-slate-700 font-medium' : 'text-gray-600 hover:bg-slate-50 hover:text-slate-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="<?php echo e(route('karyawan.ijin-sakit')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.ijin-sakit') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Ijin Sakit</span>
                </a>

                <a href="<?php echo e(route('karyawan.pengajuan-cuti')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.pengajuan-cuti') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Pengajuan Cuti</span>
                    <?php if(Auth::user()->cuti_pending > 0): ?>
                        <span
                            class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800"><?php echo e(Auth::user()->cuti_pending); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <a href="<?php echo e(route('karyawan.pengajuan-lembur')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.pengajuan-lembur') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Pengajuan Lembur</span>
                    <?php if(Auth::user()->lembur_pending > 0): ?>
                        <span
                            class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800"><?php echo e(Auth::user()->lembur_pending); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <a href="<?php echo e(route('karyawan.surat')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.surat') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Surat Saya</span>
                    <?php if(Auth::user()->surat_pending > 0): ?>
                        <span
                            class="ml-auto inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800"><?php echo e(Auth::user()->surat_pending); ?></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mt-8 mb-3">Lainnya</p>

                <a href="<?php echo e(route('karyawan.riwayat')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.riwayat') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Riwayat Pengajuan</span>
                </a>

                <a href="<?php echo e(route('karyawan.profil')); ?>"
                    class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?php echo e(request()->routeIs('karyawan.profil') ? 'bg-gradient-to-r from-red-50 to-slate-50 text-red-700 font-medium' : 'text-gray-600 hover:bg-red-50 hover:text-red-700'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Profil Saya</span>
                </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>
    </div>

    <script>
        function toggleReportsMenu() {
            const el = document.getElementById('reportsMenu');
            const icon = document.getElementById('reportsMenuIcon');
            if (!el) return;
            el.classList.toggle('hidden');
            if (icon) icon.classList.toggle('rotate-180');
        }

        function submitSidebarLaporanCuti(e) {
            e.preventDefault();
            const form = document.getElementById('sidebarLaporanCutiForm');
            const month = document.getElementById('sb_reportMonthSelect').value;
            const year = document.getElementById('sb_reportYearSelect').value;
            const period_by = document.getElementById('sb_reportPeriodBy').value;
            const url = new URL('<?php echo e(route('direktur.laporan.cuti')); ?>', window.location.origin);
            url.searchParams.set('month', month);
            url.searchParams.set('year', year);
            url.searchParams.set('period_by', period_by);
            window.location.href = url.toString();
            return false;
        }

        function sidebarExportCuti() {
            const month = document.getElementById('sb_reportMonthSelect').value;
            const year = document.getElementById('sb_reportYearSelect').value;
            const period_by = document.getElementById('sb_reportPeriodBy').value;
            const url = new URL('<?php echo e(route('direktur.laporan.cuti')); ?>', window.location.origin);
            url.searchParams.set('month', month);
            url.searchParams.set('year', year);
            url.searchParams.set('period_by', period_by);
            url.searchParams.set('export', 'csv');
            window.location.href = url.toString();
        }
    </script>
</aside>
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>