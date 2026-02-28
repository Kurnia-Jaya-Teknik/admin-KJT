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
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50 min-h-full">
            <!-- Welcome Banner -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'karyawan'): ?>
                <div
                    class="relative overflow-hidden mb-8 rounded-2xl shadow-sm border-0">
                    <!-- Animated gradient background - Soft diverse -->
                    <div class="absolute inset-0 bg-gradient-to-br from-teal-600 via-cyan-500 to-blue-600"></div>
                    <!-- Decorative blur elements -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white/8 rounded-full -mr-48 -mt-48 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/4 rounded-full -ml-32 -mb-32 blur-3xl"></div>
                    
                    <!-- Content -->
                    <div class="relative px-8 py-7 md:py-9 flex items-center justify-between">
                        <div class="flex items-center gap-6 flex-1">
                            <!-- Icon Container -->
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/25 shadow-sm">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2 1m2-1l-2-1m2 1v2.5" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Text Content -->
                            <div class="flex-1">
                                <div class="mb-1">
                                    <h1 class="text-3xl md:text-4xl font-semibold text-white mb-1">
                                        Selamat datang, <span class="bg-gradient-to-r from-white/95 via-white to-blue-100 bg-clip-text text-transparent"><?php echo e(Auth::user()->name); ?></span>! 👋
                                    </h1>
                                    <p class="text-white/80 text-sm md:text-base font-normal flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                                        <?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM Y')); ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right side decoration -->
                        <div class="hidden lg:block flex-shrink-0">
                            <div class="text-white/15">
                                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-red-600/95 via-red-500/90 to-gray-600/85 rounded-2xl p-8 mb-8 shadow-sm border border-white/10">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-semibold mb-1 text-white">Selamat Datang, <?php echo e(Auth::user()->name); ?>!
                                    👋</h1>
                                <p class="text-white/70 text-sm"><?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM Y')); ?>

                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white/12" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <?php if(Auth::user()->role === 'direktur'): ?>
                    <!-- Direktur Stats Card 1: Total Karyawan -->
                    <div
                        class="group relative overflow-hidden bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-slate-200/25 hover:shadow-md hover:border-slate-300/40 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-50/20 to-transparent opacity-0 group-hover:opacity-60 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-100/50 flex items-center justify-center group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-slate-600/80" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-slate-700 bg-slate-100/60 px-2.5 py-1.5 rounded-full border border-slate-200/40">👥
                                    Aktif</span>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-0.5"><?php echo e($totalKaryawan); ?></h3>
                            <p class="text-sm text-gray-600 font-normal">Total Karyawan Aktif</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 2: Cuti Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-amber-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-amber-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-amber-600/80 bg-amber-50/70 px-2.5 py-1.5 rounded-full border border-amber-200/30 shadow-sm">⏳
                                    Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">
                                <?php echo e(\App\Models\Cuti::where('status', 'Pending')->count()); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Cuti Menunggu Persetujuan</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 3: Lembur Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-100/60 to-orange-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-orange-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-orange-600/80 bg-orange-50/70 px-2.5 py-1.5 rounded-full border border-orange-200/30 shadow-sm">⏳
                                    Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">
                                <?php echo e(\App\Models\Lembur::where('status', 'Pending')->count()); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Lembur Menunggu Persetujuan</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 4: Surat Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-red-600/80 bg-red-50/70 px-2.5 py-1.5 rounded-full border border-red-200/30 shadow-sm">📋
                                    Proses</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">
                                <?php echo e(\App\Models\Surat::whereIn('status', ['Draft', 'Menunggu Persetujuan'])->count()); ?>

                            </h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Menunggu Proses</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 5: Persetujuan Selesai -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-green-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-green-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-green-600/80 bg-green-50/70 px-2.5 py-1.5 rounded-full border border-green-200/30 shadow-sm">✅
                                    Selesai</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($persetujuanSelesai); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Persetujuan Selesai Bulan Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 6: Kehadiran Hari Ini -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-blue-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-blue-600/80 bg-blue-50/70 px-2.5 py-1.5 rounded-full border border-blue-200/30 shadow-sm">📊
                                    <?php echo e($totalKaryawan > 0 ? round(($hadirHariIni / $totalKaryawan) * 100) : 0); ?>%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($hadirHariIni); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Hadir Hari Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 7: Surat Dikirim -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-100/60 to-purple-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-purple-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-purple-600/80 bg-purple-50/70 px-2.5 py-1.5 rounded-full border border-purple-200/30 shadow-sm">📤
                                    Terkirim</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($suratDikirimBulan ?? 0); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Sudah Dikirim</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 8: Tindakan Diperlukan -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-rose-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4v2m0 4v2M7 8a5 5 0 1110 0H7z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-rose-600/80 bg-rose-50/70 px-2.5 py-1.5 rounded-full border border-rose-200/30 shadow-sm">⚠️
                                    Penting</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($pendingApprovals); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Memerlukan Tindakan Segera</p>
                        </div>
                    </div>
                <?php elseif(Auth::user()->role === 'admin_hrd'): ?>
                    <!-- Admin HRD Stats - 8 Cards Grid -->
                    <!-- Card 1: Total Karyawan -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-slate-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100/60 to-slate-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-slate-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-green-600/80 bg-green-50/70 px-2.5 py-1.5 rounded-full border border-green-200/30 shadow-sm">+12%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e(number_format($totalKaryawan)); ?>

                            </h3>
                            <p class="text-sm text-gray-600 font-medium">Total Karyawan Aktif</p>
                        </div>
                    </div>

                    <!-- Kehadiran card removed per user request -->

                    <!-- Card 3: Cuti Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-amber-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-amber-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-amber-600/80 bg-amber-50/70 px-2.5 py-1.5 rounded-full border border-amber-200/30 shadow-sm">Menunggu</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($cutiPending); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Cuti Pending</p>
                        </div>
                    </div>

                    <!-- Card 4: Lembur Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-100/60 to-orange-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-orange-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-orange-600/80 bg-orange-50/70 px-2.5 py-1.5 rounded-full border border-orange-200/30 shadow-sm">Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($lemburPending); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Lembur Pending</p>
                        </div>
                    </div>

                    <!-- Card 5: Surat Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-red-600/80 bg-red-50/70 px-2.5 py-1.5 rounded-full border border-red-200/30 shadow-sm">Proses</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($suratPending); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Surat dalam Proses</p>
                        </div>
                    </div>

                    <!-- Card 6: Disetujui -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-blue-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-blue-600/80 bg-blue-50/70 px-2.5 py-1.5 rounded-full border border-blue-200/30 shadow-sm">Approved</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($pengajuanDisetujui); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Disetujui</p>
                        </div>
                    </div>

                    <!-- Card 7: Surat Siap -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-100/60 to-purple-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-purple-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-purple-600/80 bg-purple-50/70 px-2.5 py-1.5 rounded-full border border-purple-200/30 shadow-sm">Siap</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($suratDiterbitkan); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Siap Dikirim</p>
                        </div>
                    </div>

                    <!-- Card 8: Ditolak/Revisi -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-rose-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <span
                                    class="text-xs font-medium text-rose-600/80 bg-rose-50/70 px-2.5 py-1.5 rounded-full border border-rose-200/30 shadow-sm">Revisi</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5"><?php echo e($revisiCount); ?></h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Perlu Revisi</p>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Karyawan Stats - Personal (Soft Diverse Colors) -->
                    <!-- Sisa Cuti Card -->
                    <div class="group relative overflow-hidden rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border-0 bg-gradient-to-br from-teal-500/90 to-cyan-600/85">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-white/80 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">Tersisa</span>
                            </div>
                            <h3 class="text-4xl font-bold text-white mb-1">12</h3>
                            <p class="text-white/85 text-sm font-normal">Sisa Cuti Tahun Ini</p>
                            <div class="mt-4 pt-4 border-t border-white/15">
                                <p class="text-xs text-white/70">Total tahunan: <span class="font-semibold text-white/95">20 hari</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Cuti Digunakan Card -->
                    <div class="group relative overflow-hidden rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border-0 bg-gradient-to-br from-slate-500/90 to-slate-700/85">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-white/80 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">Digunakan</span>
                            </div>
                            <h3 class="text-4xl font-bold text-white mb-1">8</h3>
                            <p class="text-white/85 text-sm font-normal">Cuti Dipakai Tahun Ini</p>
                            <div class="mt-4 pt-4 border-t border-white/15">
                                <p class="text-xs text-white/70">Sisa: <span class="font-semibold text-white/95">12 hari</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Lembur Bulan Ini Card -->
                    <div class="group relative overflow-hidden rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border-0 bg-gradient-to-br from-amber-500/90 to-orange-600/85">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-white/80 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">Januari</span>
                            </div>
                            <h3 class="text-4xl font-bold text-white mb-1">16</h3>
                            <p class="text-white/85 text-sm font-normal">Total Lembur Bulan Ini</p>
                            <div class="mt-4 pt-4 border-t border-white/15">
                                <p class="text-xs text-white/70">Rata-rata: <span class="font-semibold text-white/95">8 jam/minggu</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Pengajuan Card -->
                    <div class="group relative overflow-hidden rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 border-0 bg-gradient-to-br from-emerald-500/90 to-green-600/85">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-60 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white/90" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-white/80 bg-white/20 px-3 py-1 rounded-full backdrop-blur-sm">Disetujui</span>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-1">Disetujui</h3>
                            <p class="text-white/85 text-sm font-normal">Status Pengajuan Terakhir</p>
                            <div class="mt-4 pt-4 border-t border-white/15">
                                <p class="text-xs text-white/70">Tanggal: <span class="font-semibold text-white/95">12 Jan 2025</span></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <?php if(Auth::user()->role === 'direktur' && isset($pengajuanPerBulan)): ?>
                    <!-- Charts Section - Direktur (2 kolom) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Bulan Ini Chart - Normal Bar Chart with Tooltip -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan per Bulan (6 Bulan
                                    Terakhir)</h3>
                                <div
                                    class="flex items-end justify-between h-56 gap-3 mb-6 px-2 relative border-b-2 border-gray-200/50 pb-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pengajuanPerBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $height = $maxPengajuan
                                                ? floor(($entry['count'] / $maxPengajuan) * 110)
                                                : 20;
                                        ?>
                                        <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                            <div
                                                class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                                <span><?php echo e($entry['count']); ?></span>
                                                <div
                                                    class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600">
                                                </div>
                                            </div>
                                            <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer"
                                                style="height: <?php echo e($height); ?>px;"></div>
                                            <span
                                                class="text-xs text-gray-600 font-medium"><?php echo e($entry['label']); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="pt-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                        <span
                                            class="text-lg font-bold bg-gradient-to-r from-rose-500 to-rose-400 bg-clip-text text-transparent"><?php echo e($totalPengajuan6); ?>

                                            pengajuan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lembur Per Divisi - Soft Gradient Progress Bars -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-orange-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Lembur per Divisi (Bulan Ini)</h3>
                                <?php
                                    $colors = [
                                        [
                                            'from' => 'orange-500',
                                            'to' => 'orange-400',
                                            'bar-from' => 'orange-400/80',
                                            'bar-to' => 'orange-300/60',
                                        ],
                                        [
                                            'from' => 'blue-500',
                                            'to' => 'blue-400',
                                            'bar-from' => 'blue-400/80',
                                            'bar-to' => 'blue-300/60',
                                        ],
                                        [
                                            'from' => 'emerald-500',
                                            'to' => 'emerald-400',
                                            'bar-from' => 'emerald-400/80',
                                            'bar-to' => 'emerald-300/60',
                                        ],
                                        [
                                            'from' => 'purple-500',
                                            'to' => 'purple-400',
                                            'bar-from' => 'purple-400/80',
                                            'bar-to' => 'purple-300/60',
                                        ],
                                        [
                                            'from' => 'pink-500',
                                            'to' => 'pink-400',
                                            'bar-from' => 'pink-400/80',
                                            'bar-to' => 'pink-300/60',
                                        ],
                                    ];
                                ?>
                                <div class="space-y-5">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $lemburPerDepartemen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $color = $colors[$index % count($colors)];
                                            $widthPercent =
                                                $maxLemburJam > 0
                                                    ? round(($dept['total_jam'] / $maxLemburJam) * 100)
                                                    : 0;
                                        ?>
                                        <div>
                                            <div class="flex items-center justify-between mb-2.5">
                                                <span
                                                    class="text-sm font-medium text-gray-700"><?php echo e($dept['nama']); ?></span>
                                                <span
                                                    class="text-sm font-bold bg-gradient-to-r from-<?php echo e($color['from']); ?> to-<?php echo e($color['to']); ?> bg-clip-text text-transparent"><?php echo e($dept['total_jam']); ?>

                                                    jam</span>
                                            </div>
                                            <div
                                                class="w-full bg-gradient-to-r from-gray-200/40 to-gray-100/30 rounded-full h-3 shadow-sm overflow-hidden">
                                                <div class="bg-gradient-to-r from-<?php echo e($color['bar-from']); ?> to-<?php echo e($color['bar-to']); ?> h-3 rounded-full shadow-md transition-all duration-300 hover:shadow-lg"
                                                    style="width: <?php echo e($widthPercent); ?>%"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data lembur bulan
                                            ini</p>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div class="mt-5 pt-4 border-t border-gray-100/30 flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Total Lembur</span>
                                    <span
                                        class="text-lg font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent"><?php echo e($totalLemburBulanIni); ?>

                                        jam</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan Donut - Soft Gradient Colors -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-green-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan</h3>
                                <?php
                                    $total = $statusApproved + $statusPending + $statusRejected;
                                    $circumference = 2 * 3.14159 * 55;
                                    $approvedDash = $total > 0 ? ($statusApproved / $total) * $circumference : 0;
                                    $pendingDash = $total > 0 ? ($statusPending / $total) * $circumference : 0;
                                    $rejectedDash = $total > 0 ? ($statusRejected / $total) * $circumference : 0;
                                    $approvedPct = $total > 0 ? round(($statusApproved / $total) * 100) : 0;
                                    $pendingPct = $total > 0 ? round(($statusPending / $total) * 100) : 0;
                                    $rejectedPct = $total > 0 ? round(($statusRejected / $total) * 100) : 0;
                                ?>
                                <div class="flex items-center justify-center mb-6">
                                    <div class="relative w-48 h-48">
                                        <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 140 140"
                                            style="transform: rotate(-90deg)">
                                            <!-- Approved -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#10b981" stroke-width="22"
                                                stroke-dasharray="<?php echo e($approvedDash); ?> <?php echo e($circumference); ?>"
                                                stroke-linecap="round" opacity="0.8" />
                                            <!-- Pending -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#f59e0b" stroke-width="22"
                                                stroke-dasharray="<?php echo e($pendingDash); ?> <?php echo e($circumference); ?>"
                                                stroke-dashoffset="-<?php echo e($approvedDash); ?>" stroke-linecap="round"
                                                opacity="0.8" />
                                            <!-- Rejected -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#ef4444" stroke-width="22"
                                                stroke-dasharray="<?php echo e($rejectedDash); ?> <?php echo e($circumference); ?>"
                                                stroke-dashoffset="-<?php echo e($approvedDash + $pendingDash); ?>"
                                                stroke-linecap="round" opacity="0.8" />
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center">
                                                <div
                                                    class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                                    <?php echo e($total); ?></div>
                                                <div class="text-xs text-gray-500">Total</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div
                                        class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-green-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-4 h-4 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex-shrink-0 shadow-sm">
                                            </div>
                                            <span class="text-gray-600">Disetujui</span>
                                        </div>
                                        <span class="font-bold text-gray-800"><?php echo e($statusApproved); ?>

                                            (<?php echo e($approvedPct); ?>%)</span>
                                    </div>
                                    <div
                                        class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-amber-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 flex-shrink-0 shadow-sm">
                                            </div>
                                            <span class="text-gray-600">Menunggu</span>
                                        </div>
                                        <span class="font-bold text-gray-800"><?php echo e($statusPending); ?>

                                            (<?php echo e($pendingPct); ?>%)</span>
                                    </div>
                                    <div
                                        class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-red-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-4 h-4 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex-shrink-0 shadow-sm">
                                            </div>
                                            <span class="text-gray-600">Ditolak</span>
                                        </div>
                                        <span class="font-bold text-gray-800"><?php echo e($statusRejected); ?>

                                            (<?php echo e($rejectedPct); ?>%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ringkasan Harian - Minimal & Fokus -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-9">Ringkasan Hari Ini</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100 mt-5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Pengajuan Pending</span>
                                    </div>
                                    <span class="font-bold text-lg text-yellow-600"><?php echo e($pendingApprovals); ?></span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Disetujui (Bulan Ini)</span>
                                    </div>
                                    <span
                                        class="font-bold text-lg text-green-600"><?php echo e($persetujuanSelesai ?? 0); ?></span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Ditolak (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-red-600"><?php echo e($ditolakBulan ?? 0); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Kehadiran Hari Ini</span>
                                    </div>
                                    <span
                                        class="font-bold text-lg text-slate-600"><?php echo e($hadirHariIni); ?>/<?php echo e($totalKaryawan); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif(Auth::user()->role === 'admin_hrd' && isset($pengajuanPerBulan)): ?>
                    <!-- Charts Section - Admin HRD -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Masuk - Soft Gradient Chart -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-purple-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Pengajuan Masuk (6 Bulan Terakhir)
                                </h3>

                                <!-- Chart Container -->
                                <div class="flex gap-3 items-end border-b-2 border-gray-200/50 pb-4"
                                    style="height: 240px;">
                                    <?php
                                        $bulanColors = ['indigo', 'indigo', 'indigo', 'purple', 'purple', 'purple'];
                                        $bulanIndex = 0;
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pengajuanPerBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $heightPercent = ($entry['count'] / $maxPengajuan) * 100;
                                            $heightPx = max(40, ($heightPercent / 100) * 240);
                                            $color = $bulanColors[$bulanIndex % count($bulanColors)];
                                            $bulanIndex++;
                                        ?>
                                        <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                            <div class="w-full bg-gradient-to-t from-<?php echo e($color); ?>-400/70 to-<?php echo e($color); ?>-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-<?php echo e($color); ?>-400/90 group-hover/bar:to-<?php echo e($color); ?>-300/70 transition-all duration-300"
                                                style="height: <?php echo e($heightPx); ?>px;"
                                                title="<?php echo e($entry['count']); ?> pengajuan"></div>
                                            <span
                                                class="text-xs text-gray-700 font-medium mt-1.5"><?php echo e($entry['label']); ?></span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                <div class="pt-4 border-t border-gray-100/30 flex items-center justify-between mt-4">
                                    <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                    <span
                                        class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-indigo-500 bg-clip-text text-transparent"><?php echo e($totalPengajuan6); ?>

                                        pengajuan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pengajuan Breakdown by Type -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Cuti vs Lembur Comparison -->
                            <div
                                class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 p-6">
                                <h4 class="text-sm font-semibold text-gray-800 mb-4">Pengajuan Menunggu</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                            <span class="text-xs text-gray-600">Cuti Pending</span>
                                        </div>
                                        <span class="font-bold text-amber-600"><?php echo e($cutiPending); ?></span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                                            <span class="text-xs text-gray-600">Lembur Pending</span>
                                        </div>
                                        <span class="font-bold text-orange-600"><?php echo e($lemburPending); ?></span>
                                    </div>
                                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                        <span class="text-xs font-semibold text-gray-700">Total Pending</span>
                                        <span
                                            class="font-bold text-lg text-gray-800"><?php echo e($cutiPending + $lemburPending); ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengajuan Disetujui Bulan Ini -->
                            <div
                                class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-2xl shadow-sm border border-gray-100/40 p-6">
                                <h4 class="text-sm font-semibold text-gray-800 mb-4">Disetujui Bulan Ini</h4>
                                <div class="text-center py-6">
                                    <div class="text-3xl font-bold text-green-600"><?php echo e($pengajuanDisetujui); ?></div>
                                    <p class="text-xs text-gray-500 mt-2">Pengajuan disetujui</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Admin HRD Summary -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan - Pie Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Pengajuan Overall</h3>
                            <div class="flex items-center gap-6 mb-2">
                                <!-- Pie (Chart.js canvas) -->
                                <div class="relative w-40 h-40 flex items-center justify-center">
                                    <canvas id="statusPie" width="160" height="160" class="w-40 h-40"></canvas>
                                    <!-- Smaller center chip so it doesn't cover the doughnut -->
                                    <div id="statusTotal"
                                        class="absolute inset-0 m-auto flex flex-col items-center justify-center z-10 pointer-events-none">
                                        <div class="bg-white rounded-full px-3 py-2 shadow-sm text-center">
                                            <div class="text-lg font-bold text-gray-800 leading-none">
                                                <?php echo e($statusTotal); ?></div>
                                            <div class="text-xs text-gray-500 -mt-0.5">Total</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Legend & Counts -->
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-green-600"></div>
                                            <span class="text-sm text-gray-700">Disetujui</span>
                                        </div>
                                        <div id="countApproved" class="text-sm font-bold text-gray-800">
                                            <?php echo e($statusApproved); ?></div>
                                    </div>

                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-yellow-600"></div>
                                            <span class="text-sm text-gray-700">Menunggu</span>
                                        </div>
                                        <div id="countPending" class="text-sm font-bold text-gray-800">
                                            <?php echo e($statusPending); ?></div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                                            <span class="text-sm text-gray-700">Ditolak</span>
                                        </div>
                                        <div id="countRejected" class="text-sm font-bold text-gray-800">
                                            <?php echo e($statusRejected); ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart.js Script (CDN) -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                (function() {
                                    const approved = <?php echo e($statusApproved ?? 0); ?>;
                                    const pending = <?php echo e($statusPending ?? 0); ?>;
                                    const rejected = <?php echo e($statusRejected ?? 0); ?>;
                                    const total = approved + pending + rejected;
                                    // set total display (safe selector fallback)
                                    const totalEl = document.getElementById('statusTotal');
                                    if (totalEl) {
                                        const numEl = totalEl.querySelector('.text-2xl') || totalEl.querySelector('.text-lg') || totalEl
                                            .querySelector('.font-bold') || totalEl.querySelector('div');
                                        if (numEl) numEl.textContent = total;
                                    }

                                    // prepare chart
                                    const ctx = document.getElementById('statusPie').getContext('2d');
                                    // destroy existing chart instance if present (hot reload)
                                    if (window._statusPieChart) {
                                        window._statusPieChart.destroy();
                                    }
                                    window._statusPieChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: ['Disetujui', 'Menunggu', 'Ditolak'],
                                            datasets: [{
                                                data: [approved, pending, rejected],
                                                backgroundColor: ['#059669', '#d97706', '#dc2626'],
                                                hoverOffset: 8
                                            }]
                                        },
                                        options: {
                                            cutout: '60%',
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                tooltip: {
                                                    mode: 'index',
                                                    intersect: false
                                                }
                                            }
                                        }
                                    });
                                })();
                            </script>
                        </div>

                        <!-- Ringkasan Surat -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Surat</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Menunggu Proses</span>
                                    <span class="font-bold text-lg text-yellow-600"><?php echo e($suratPending); ?></span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Disetujui</span>
                                    <span class="font-bold text-lg text-blue-600"><?php echo e($suratDisetujui); ?></span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Diterbitkan</span>
                                    <span class="font-bold text-lg text-purple-600"><?php echo e($suratDiterbitkan); ?></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Ditolak</span>
                                    <span class="font-bold text-lg text-red-600"><?php echo e($suratDitolak); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Charts Section - Karyawan (Personal) - Soft Modern Design -->
                    <div class="lg:col-span-2 space-y-5">
                        <!-- Personal Attendance chart removed per user request -->
                        

                        <!-- Pengajuan Cuti Chart - 6 Bulan Terakhir -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Pengajuan Cuti Saya - 6 Bulan
                                Terakhir</h3>
                            <!-- Chart dengan Grid Lines dan Layout Lebih Besar -->
                            <div class="space-y-4">
                                <!-- Y-axis scale labels -->
                                <div class="flex gap-6">
                                    <div class="w-12 flex flex-col justify-between text-right pr-2"
                                        style="height: 280px;">
                                        <span class="text-xs text-gray-500 font-medium">4</span>
                                        <span class="text-xs text-gray-500 font-medium">3</span>
                                        <span class="text-xs text-gray-500 font-medium">2</span>
                                        <span class="text-xs text-gray-500 font-medium">1</span>
                                        <span class="text-xs text-gray-500 font-medium">0</span>
                                    </div>
                                    <!-- Main Chart Container -->
                                    <div class="flex-1">
                                        <div class="relative" style="height: 280px;">
                                            <!-- Grid lines -->
                                            <div
                                                class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                            <!-- Bars Container -->
                                            <div class="absolute inset-0 flex items-end justify-around gap-6 px-2">
                                                <!-- Agustus -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 75%; max-width: 80px; margin: 0 auto;"
                                                        title="3 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">3</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 50%; max-width: 80px; margin: 0 auto;"
                                                        title="2 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">2</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 100%; max-width: 80px; margin: 0 auto;"
                                                        title="4 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">4</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 25%; max-width: 80px; margin: 0 auto; min-height: 12px;"
                                                        title="1 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">1</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-gray-400 hover:bg-gray-500 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 5%; max-width: 80px; margin: 0 auto; min-height: 8px;"
                                                        title="0 hari"></div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-700 hover:bg-red-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 50%; max-width: 80px; margin: 0 auto;"
                                                        title="2 hari">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">2</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Jan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Cuti Digunakan</span>
                                <span class="text-lg font-semibold text-yellow-600">12 hari</span>
                            </div>
                        </div>

                        <!-- Personal Overtime Chart -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Lembur Saya - 6 Bulan Terakhir</h3>
                            <!-- Chart dengan Grid Lines dan Layout Lebih Besar -->
                            <div class="space-y-4">
                                <!-- Y-axis scale labels -->
                                <div class="flex gap-6">
                                    <div class="w-12 flex flex-col justify-between text-right pr-2"
                                        style="height: 280px;">
                                        <span class="text-xs text-gray-500 font-medium">14h</span>
                                        <span class="text-xs text-gray-500 font-medium">10h</span>
                                        <span class="text-xs text-gray-500 font-medium">7h</span>
                                        <span class="text-xs text-gray-500 font-medium">3h</span>
                                        <span class="text-xs text-gray-500 font-medium">0h</span>
                                    </div>
                                    <!-- Main Chart Container -->
                                    <div class="flex-1">
                                        <div class="relative" style="height: 280px;">
                                            <!-- Grid lines -->
                                            <div
                                                class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                                <div class="border-t border-gray-200"></div>
                                            </div>
                                            <!-- Bars Container -->
                                            <div class="absolute inset-0 flex items-end justify-around gap-6 px-2">
                                                <!-- Agustus -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 85.7%; max-width: 80px; margin: 0 auto;"
                                                        title="12 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">12h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 57%; max-width: 80px; margin: 0 auto;"
                                                        title="8 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">8h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 71%; max-width: 80px; margin: 0 auto;"
                                                        title="10 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">10h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 42.8%; max-width: 80px; margin: 0 auto; min-height: 12px;"
                                                        title="6 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">6h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 100%; max-width: 80px; margin: 0 auto;"
                                                        title="14 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">14h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-800 hover:bg-slate-900 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer"
                                                        style="height: 114%; max-width: 80px; margin: 0 auto;"
                                                        title="16 jam">
                                                        <div
                                                            class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">16h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Jan</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total 6 Bulan Terakhir</span>
                                <span class="text-lg font-semibold text-purple-600">66 jam</span>
                            </div>
                        </div>

                        <!-- Status Pengajuan Chart (Donut/Pie) -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-5">Status Pengajuan Saya</h3>
                            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                                <!-- Donut Chart Visual - Fixed Calculation -->
                                <div class="relative w-36 h-36 flex-shrink-0">
                                    <svg class="w-36 h-36 transform -rotate-90" viewBox="0 0 120 120">
                                        <!-- Background circle -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#e5e7eb"
                                            stroke-width="12" />
                                        <!-- Disetujui (60% = 188.5 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981"
                                            stroke-width="12" stroke-dasharray="188.5 314.16" stroke-dashoffset="0"
                                            stroke-linecap="round" />
                                        <!-- Menunggu (25% = 78.54 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b"
                                            stroke-width="12" stroke-dasharray="78.54 314.16"
                                            stroke-dashoffset="-188.5" stroke-linecap="round" />
                                        <!-- Ditolak (15% = 47.12 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#ef4444"
                                            stroke-width="12" stroke-dasharray="47.12 314.16"
                                            stroke-dashoffset="-267.04" stroke-linecap="round" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                        <div class="text-center">
                                            <div class="text-2xl font-semibold text-gray-800">20</div>
                                            <div class="text-xs text-gray-500">Total</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Legend -->
                                <div class="space-y-3 flex-shrink-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-green-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Disetujui</p>
                                            <p class="text-xs text-gray-500">12 (60%)</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Menunggu</p>
                                            <p class="text-xs text-gray-500">5 (25%)</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-500 flex-shrink-0"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Ditolak</p>
                                            <p class="text-xs text-gray-500">3 (15%)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Karyawan (Personal) - Modern Design -->
                    <div class="space-y-6">
                        <!-- Profile Card dengan Info Lengkap -->
                        <div class="relative overflow-hidden bg-gradient-to-br from-white/95 to-white/80 backdrop-blur-md rounded-2xl shadow-lg border border-white/40 p-7">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 via-transparent to-cyan-50/20 pointer-events-none"></div>
                            <div class="relative">
                                <div class="flex items-center gap-5 mb-6">
                                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900"><?php echo e(Auth::user()->name); ?></h3>
                                        <p class="text-sm text-blue-600 font-semibold">Karyawan Tetap</p>
                                    </div>
                                </div>
                                <div class="space-y-3 divide-y divide-gray-200">
                                    <div class="pt-3 first:pt-0">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Departemen/Bagian</p>
                                        <p class="text-sm font-semibold text-gray-900">IT & Teknologi</p>
                                    </div>
                                    <div class="pt-3">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Email</p>
                                        <p class="text-sm font-semibold text-gray-900"><?php echo e(Auth::user()->email); ?></p>
                                    </div>
                                    <div class="pt-3">
                                        <p class="text-xs text-gray-500 font-medium mb-1">Kehadiran Bulan Ini</p>
                                        <div class="flex items-center gap-2">
                                            <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" style="width: 90.9%"></div>
                                            </div>
                                            <span class="text-lg font-bold text-green-600">90.9%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Menunggu Persetujuan -->
                            <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-2xl p-5 border border-orange-100">
                                <div class="w-10 h-10 rounded-lg bg-orange-500/20 flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 font-medium mb-1">Menunggu Persetujuan</p>
                                <p class="text-3xl font-bold text-orange-600">1</p>
                            </div>

                            <!-- Penolakan -->
                            <div class="bg-gradient-to-br from-red-50 to-rose-50 rounded-2xl p-5 border border-red-100">
                                <div class="w-10 h-10 rounded-lg bg-red-500/20 flex items-center justify-center mb-3">
                                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 font-medium mb-1">Perlu Revisi</p>
                                <p class="text-3xl font-bold text-red-600">0</p>
                            </div>
                        </div>

                        <!-- Surat Keterangan Alert Box -->
                        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-500 rounded-2xl shadow-lg border border-emerald-300/30 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                            <div class="relative">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-bold text-sm mb-1">📬 Surat Keterangan Tersedia</h4>
                                        <p class="text-white/90 text-xs leading-relaxed">Anda memiliki surat yang siap untuk diambil. Klik tombol di bawah untuk melihat detail.</p>
                                    </div>
                                </div>
                                <div id="suratDiterimaContainer" class="mb-4">
                                    <!-- Akan diisi oleh JavaScript -->
                                </div>
                                <div class="flex gap-2">
                                    <a href="<?php echo e(route('karyawan.surat-keterangan.request.index')); ?>" class="flex-1 text-center bg-white/20 hover:bg-white/30 text-white text-xs font-semibold py-2.5 rounded-xl transition-all border border-white/30">
                                        📋 Ajukan
                                    </a>
                                    <a href="/karyawan/surat-keterangan" class="flex-1 text-center bg-white text-emerald-600 hover:bg-emerald-50 text-xs font-bold py-2.5 rounded-xl transition-all">
                                        Lihat Semua →
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Buttons -->
                        <div class="grid grid-cols-2 gap-3">
                            <a href="<?php echo e(route('karyawan.pengajuan-cuti')); ?>" class="group relative overflow-hidden rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 bg-gradient-to-br from-red-500 to-red-600 hover:from-red-600 hover:to-red-700">
                                <div class="relative flex flex-col items-center text-center text-white">
                                    <svg class="w-5 h-5 mb-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1z"/>
                                    </svg>
                                    <span class="text-xs font-semibold">Ajukan Cuti</span>
                                </div>
                            </a>

                            <a href="<?php echo e(route('karyawan.pengajuan-lembur')); ?>" class="group relative overflow-hidden rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 bg-gradient-to-br from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800">
                                <div class="relative flex flex-col items-center text-center text-white">
                                    <svg class="w-5 h-5 mb-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11 17h2v-6h-2v6zm1-15C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-.55 0-1 .45-1 1s.45 1 1 1 1-.45 1-1-.45-1-1-1z"/>
                                    </svg>
                                    <span class="text-xs font-semibold">Ajukan Lembur</span>
                                </div>
                            </a>

                            <a href="<?php echo e(route('karyawan.surat-keterangan.request.index')); ?>" class="group relative overflow-hidden rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 bg-gradient-to-br from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700">
                                <div class="relative flex flex-col items-center text-center text-white">
                                    <svg class="w-5 h-5 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-xs font-semibold">Surat Keterangan</span>
                                </div>
                            </a>

                            <a href="<?php echo e(route('karyawan.surat')); ?>" class="group relative overflow-hidden rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300 bg-gradient-to-br from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700">
                                <div class="relative flex flex-col items-center text-center text-white">
                                    <svg class="w-5 h-5 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-xs font-semibold">Surat Saya</span>
                                </div>
                            </a>
                        </div>


                        <!-- View History Link -->
                        <a href="<?php echo e(route('karyawan.riwayat')); ?>" class="flex items-center justify-center gap-2 w-full bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-sm hover:shadow-md transition-all border border-gray-100/50 text-gray-700 font-semibold hover:text-blue-600 group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3" />
                            </svg>
                            Lihat Riwayat Lengkap →
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Pending Requests - Direktur (Card Format) -->
            <?php if(Auth::user()->role === 'direktur'): ?>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Pengajuan Cuti - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                            <h3 class="text-lg font-bold text-gray-800">Cuti Menunggu Persetujuan (5)</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Card Item 1 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4"> 
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">
                                        AR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Ahmad Rizki</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">3 hari • Mulai 10 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        BS</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Budi Santoso</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">2 hari • Mulai 12 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">
                                        DH</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Dani Hermawan</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">5 hari • Mulai 15 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">
                                        EW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Eka Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">1 hari • Mulai 16 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        FR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Fitra Rahman</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">4 hari • Mulai 18 Jan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="<?php echo e(route('direktur.persetujuan-cuti-lembur')); ?>"
                                class="text-sm font-semibold text-green-600 hover:text-green-700">Lihat Semua →</a>
                        </div>
                    </div>

                    <!-- Pengajuan Lembur - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Lembur Menunggu Persetujuan (5)</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Card Item 1 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">
                                        SN</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Siti Nurhaliza</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">5 jam • 5 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        RW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Rina Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">4 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">
                                        GM</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Gusril Maulana</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">6 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">
                                        HK</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Hendra Kusuma</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">3 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        IP</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Intan Permata</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">2 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="<?php echo e(route('direktur.persetujuan-cuti-lembur')); ?>"
                                class="text-sm font-semibold text-purple-600 hover:text-purple-700">Lihat Semua →</a>
                        </div>
                    </div>
                </div>
            <?php elseif(Auth::user()->role === 'admin_hrd'): ?>
                <!-- Pending Requests - Admin HRD -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Surat Menunggu Proses -->
                    <div id="surat-card" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Surat Menunggu Proses (<span
                                    id="surat-count"><?php echo e($suratMenunggu->count()); ?></span>)</h3>
                        </div>
                        <div id="surat-list" class="divide-gray-100 max-h-80 overflow-y-auto">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $suratMenunggu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors"
                                    data-id="<?php echo e($surat->id); ?>">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                            <?php echo e(strtoupper(substr($surat->user->name, 0, 2))); ?></div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">
                                                    <?php echo e($surat->user->name); ?>

                                                </p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800 status-label"><?php echo e($surat->status); ?></span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1"><?php echo e($surat->jenis ?? 'Surat'); ?></p>
                                            <p class="text-xs font-medium text-gray-700">Diajukan
                                                <?php echo e($surat->created_at->format('d M Y')); ?></p>

                                            <div class="mt-3 flex items-center gap-2 flex-wrap">
                                                <button data-action="view"
                                                    class="px-3 py-1 text-xs rounded-md bg-gray-100 hover:bg-gray-200">Lihat</button>

                                                <button data-action="approve"
                                                    class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700 hover:bg-green-200">Setujui</button>

                                                <button data-action="reject"
                                                    class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200">Tolak</button>

                                                <button data-action="delete"
                                                    class="px-3 py-1 text-xs rounded-md bg-gray-50 text-red-600 hover:bg-red-100">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="px-6 py-4 text-sm text-gray-500">Tidak ada surat menunggu.</div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="<?php echo e(route('admin.surat')); ?>"
                                class="text-sm font-semibold text-purple-600 hover:text-purple-700">Kelola Surat →</a>
                        </div>
                    </div>

                    <!-- JS handlers: approve/reject/delete and modal close -->
                    <script>
                        (function() {
                            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            const list = document.getElementById('surat-list');
                            const countEl = document.getElementById('surat-count');

                            function setCount(delta) {
                                if (!countEl) return;
                                const cur = parseInt(countEl.textContent) || 0;
                                countEl.textContent = Math.max(0, cur + (delta || 0));
                            }

                            async function post(url, data) {
                                const res = await fetch(url, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(data || {})
                                });
                                const text = await res.text();
                                console.log('POST Response:', {
                                    url,
                                    status: res.status,
                                    statusText: res.statusText,
                                    body: text
                                });
                                let json = {};
                                try {
                                    json = JSON.parse(text);
                                } catch (e) {
                                    console.error('JSON Parse Error:', e, text);
                                    throw new Error('Response is not valid JSON. Status: ' + res.status);
                                }
                                if (!res.ok) {
                                    throw new Error(json.message || json.error || 'HTTP ' + res.status);
                                }
                                return json;
                            }

                            async function del(url) {
                                const res = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json'
                                    }
                                });
                                const text = await res.text();
                                console.log('DELETE Response:', {
                                    url,
                                    status: res.status,
                                    statusText: res.statusText,
                                    body: text
                                });
                                let json = {};
                                try {
                                    json = JSON.parse(text);
                                } catch (e) {
                                    console.error('JSON Parse Error:', e, text);
                                    throw new Error('Response is not valid JSON. Status: ' + res.status);
                                }
                                if (!res.ok) {
                                    throw new Error(json.message || json.error || 'HTTP ' + res.status);
                                }
                                return json;
                            }

                            // delegate click events on list
                            list && list.addEventListener('click', function(e) {
                                const btn = e.target.closest('[data-action]');
                                if (!btn) return;
                                const action = btn.getAttribute('data-action');
                                const item = btn.closest('[data-id]');
                                const id = item.getAttribute('data-id');

                                if (action === 'approve') {
                                    if (!confirm('Setujui surat ini?')) return;
                                    post(`/admin/surat/${id}/approve`, {}).then(() => {
                                        alert('Surat berhasil disetujui');
                                        item.remove();
                                        setCount(-1);
                                    }).catch((err) => alert('Gagal: ' + (err.message || 'Tidak diketahui')));
                                }

                                if (action === 'reject') {
                                    const reason = prompt('Alasan penolakan (wajib):');
                                    if (!reason) return alert('Alasan dibutuhkan');
                                    post(`/admin/surat/${id}/reject`, {
                                        keterangan: reason
                                    }).then(() => {
                                        alert('Surat berhasil ditolak');
                                        item.remove();
                                        setCount(-1);
                                    }).catch((err) => alert('Gagal: ' + (err.message || 'Tidak diketahui')));
                                }

                                if (action === 'delete') {
                                    if (!confirm('Hapus surat ini?')) return;
                                    del(`/admin/surat/${id}`).then(() => {
                                        alert('Surat berhasil dihapus');
                                        item.remove();
                                        setCount(-1);
                                    }).catch((err) => alert('Gagal: ' + (err.message || 'Tidak diketahui')));
                                }

                                if (action === 'view') {
                                    const modal = document.getElementById('surat-modal-' + id);
                                    if (modal) modal.classList.remove('hidden');
                                }
                            });

                            // modal overlay close
                            document.querySelectorAll('.js-modal').forEach(m => {
                                m.addEventListener('click', function(e) {
                                    if (e.target === this) this.classList.add('hidden');
                                });
                            });
                            document.addEventListener('keydown', function(e) {
                                if (e.key === 'Escape') document.querySelectorAll('.js-modal').forEach(m => m.classList.add(
                                    'hidden'));
                            });

                        })();
                    </script>

                    <!-- Data Karyawan Perlu Perhatian -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <h3 class="text-lg font-bold text-gray-800">Karyawan Perlu Perhatian</h3>
                        </div>
                        <div class="divide-gray-100 max-h-80 overflow-y-auto">
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">
                                        SN</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Siti Nurhaliza</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-red-100 text-red-800">Tidak
                                                Hadir</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">Tidak hadir 2 hari tanpa
                                            keterangan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 font-semibold text-yellow-600">
                                        RW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Rina Wijaya</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Kontrak
                                                Exp</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">Kontrak berakhir 15 Februari 2026
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                        GM</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Gusril Maulana</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-blue-100 text-blue-800">Cuti
                                                Panjang</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">Cuti 10-20 Januari 2026</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 font-semibold text-yellow-600">
                                        HK</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Hendra Kusuma</p>
                                            <span
                                                class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Kontrak
                                                Exp</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">Kontrak berakhir 28 Februari 2026
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="<?php echo e(route('admin.karyawan')); ?>"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">Kelola Karyawan →</a>
                        </div>
                    </div>
                </div>

                <!-- Modals untuk Surat Detail -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $suratMenunggu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="surat-modal-<?php echo e($surat->id); ?>"
                        class="js-modal hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <!-- Modal Header -->
                            <div
                                class="sticky top-0 px-6 py-5 bg-gradient-to-r from-purple-50 to-purple-50 border-b border-gray-200 flex items-center justify-between">
                                <h2 class="text-lg font-bold text-gray-800">Detail Surat</h2>
                                <button
                                    onclick="document.getElementById('surat-modal-<?php echo e($surat->id); ?>').classList.add('hidden')"
                                    class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Modal Content -->
                            <div class="px-6 py-6 space-y-6">
                                <!-- Info Pengajuan -->
                                <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Pengajuan Oleh</p>
                                            <p class="text-sm font-semibold text-gray-800"><?php echo e($surat->user->name); ?>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500">Jenis Surat</p>
                                            <p class="text-sm font-semibold text-gray-800"><?php echo e($surat->jenis); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Nomor Surat</p>
                                            <p class="text-sm font-semibold text-gray-800"><?php echo e($surat->nomor_surat); ?>

                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <span
                                                class="text-xs font-semibold px-2.5 py-1 rounded-full <?php echo e($surat->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800'); ?>"><?php echo e($surat->status); ?></span>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Tanggal Pengajuan</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                <?php echo e($surat->created_at->format('d M Y')); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail Surat -->
                                <div class="space-y-3">
                                    <h3 class="font-semibold text-gray-800">Detail Surat</h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Perihal</p>
                                            <p class="text-sm text-gray-800"><?php echo e($surat->perihal); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Isi Surat</p>
                                            <p class="text-sm text-gray-800 whitespace-pre-wrap">
                                                <?php echo e($surat->isi_surat); ?></p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Keterangan Tambahan</p>
                                            <p class="text-sm text-gray-800"><?php echo e($surat->keterangan ?? '-'); ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-3 pt-4 border-t">
                                    <button onclick="approveAction(<?php echo e($surat->id); ?>)"
                                        class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                        Setujui
                                    </button>
                                    <button onclick="rejectAction(<?php echo e($surat->id); ?>)"
                                        class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                        Tolak
                                    </button>
                                    <button onclick="deleteAction(<?php echo e($surat->id); ?>)"
                                        class="flex-1 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                    <button
                                        onclick="document.getElementById('surat-modal-<?php echo e($surat->id); ?>').classList.add('hidden')"
                                        class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg transition-colors">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Helper Functions untuk Modal Actions -->
                <script>
                    function approveAction(id) {
                        if (!confirm('Setujui surat ini?')) return;
                        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        fetch(`/admin/surat/${id}/approve`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({})
                        }).then(async res => {
                            const json = await res.json();
                            if (res.ok) {
                                alert('Surat berhasil disetujui');
                                document.querySelector(`[data-id="${id}"]`)?.remove();
                                document.getElementById(`surat-modal-${id}`)?.classList.add('hidden');
                                location.reload();
                            } else {
                                alert('Gagal: ' + (json.message || 'Tidak diketahui'));
                            }
                        }).catch((err) => alert('Error: ' + err.message));
                    }

                    function rejectAction(id) {
                        const reason = prompt('Alasan penolakan (wajib):');
                        if (!reason) return;
                        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        fetch(`/admin/surat/${id}/reject`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                keterangan: reason
                            })
                        }).then(async res => {
                            const json = await res.json();
                            if (res.ok) {
                                alert('Surat berhasil ditolak');
                                document.querySelector(`[data-id="${id}"]`)?.remove();
                                document.getElementById(`surat-modal-${id}`)?.classList.add('hidden');
                                location.reload();
                            } else {
                                alert('Gagal: ' + (json.message || 'Tidak diketahui'));
                            }
                        }).catch((err) => alert('Error: ' + err.message));
                    }

                    function deleteAction(id) {
                        if (!confirm('Hapus surat ini? (Tidak dapat dibatalkan)')) return;
                        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        fetch(`/admin/surat/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                                'Accept': 'application/json'
                            }
                        }).then(async res => {
                            const text = await res.text();
                            const json = text ? JSON.parse(text) : {};
                            if (res.ok) {
                                alert('Surat berhasil dihapus');
                                document.querySelector(`[data-id="${id}"]`)?.remove();
                                document.getElementById(`surat-modal-${id}`)?.classList.add('hidden');
                                location.reload();
                            } else {
                                alert('Gagal: ' + (json.message || 'Error ' + res.status));
                            }
                        }).catch((err) => alert('Error: ' + err.message));
                    }

                    // Load Surat Keterangan Diterima untuk Karyawan
                    <?php if(Auth::user()->role === 'karyawan'): ?>
                        function loadSuratDiterima() {
                            const container = document.getElementById('suratDiterimaContainer');
                            const badge = document.getElementById('suratBadge');
                            if (!container) return;

                            fetch('/karyawan/surat-keterangan-received')
                                .then(r => r.json())
                                .then(data => {
                                    if (!data.ok || data.data.length === 0) {
                                        container.innerHTML =
                                            '<p class="text-xs text-gray-500 text-center py-2">Belum ada surat keterangan diterima</p>';
                                        if (badge) badge.classList.add('hidden');
                                        return;
                                    }

                                    // Update badge dengan jumlah surat
                                    if (badge && data.data.length > 0) {
                                        badge.textContent = data.data.length;
                                        badge.classList.remove('hidden');
                                    }

                                    // Tampilkan max 3 surat terbaru di dashboard
                                    const displayData = data.data.slice(0, 3);
                                    container.innerHTML = displayData.map(surat => `
                                    <div class="p-3 bg-gradient-to-r from-green-50 to-transparent border border-green-100 rounded-lg hover:shadow-sm transition-all">
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-gray-900 truncate">${surat.nomor_surat}</p>
                                                <p class="text-xs text-gray-600 mt-0.5">${surat.jabatan}</p>
                                            </div>
                                            <span class="text-xs font-medium text-green-700 bg-green-100 px-2 py-0.5 rounded whitespace-nowrap">✓ Terkirim</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-2">Diterima: ${surat.sent_at}</p>
                                        <div class="flex gap-2">
                                            <a href="${surat.file_url}" target="_blank" class="text-xs text-green-600 hover:text-green-700 font-medium">Download →</a>
                                        </div>
                                    </div>
                                `).join('');

                                    // Tambah info jika ada lebih banyak surat
                                    if (data.data.length > 3) {
                                        container.innerHTML +=
                                            `<p class="text-xs text-center text-gray-500 pt-2">+ ${data.data.length - 3} surat lainnya</p>`;
                                    }
                                })
                                .catch(e => {
                                    container.innerHTML = '<p class="text-xs text-red-500">Error loading surat</p>';
                                    if (badge) badge.classList.add('hidden');
                                });
                        }

                        // Load on page load
                        document.addEventListener('DOMContentLoaded', loadSuratDiterima);
                    <?php endif; ?>
                </script>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div
                    class="lg:col-span-3 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div
                        class="px-6 py-4 border-b border-gray-100/50 bg-gradient-to-r from-pink-50/30 via-purple-50/30 to-orange-50/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h3>
                            <span class="text-xs font-medium text-gray-500 bg-white/60 px-2 py-1 rounded-full">5
                                aktivitas</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100/50">
                        <?php if(Auth::user()->role === 'direktur'): ?>
                            <!-- Direktur Activities - Approval & Request Focus -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan lembur Rina
                                            Wijaya
                                            disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">4 jam lembur - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti Ahmad Rizki
                                            menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - mulai 10 Jan 2026
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti ditolak -
                                            Bentrok
                                            shift</p>
                                        <p class="text-xs text-gray-500 mb-2">Budi Santoso - 5 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Laporan kehadiran Desember
                                            tersedia</p>
                                        <p class="text-xs text-gray-500 mb-2">Tingkat kehadiran: 94.2% dari 156
                                            karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja
                                            diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">3 surat untuk keperluan karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php elseif(Auth::user()->role === 'admin_hrd'): ?>
                            <!-- Admin HRD Activities -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja
                                            diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Ahmad Rizki - Keperluan Bank</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            30 menit lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Karyawan baru ditambahkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Rina Wijaya - IT & Teknologi</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan surat masuk</p>
                                        <p class="text-xs text-gray-500 mb-2">Budi Santoso - Surat Referensi</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Data karyawan diperbarui
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Dani Hermawan - Perubahan jabatan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Kontrak hampir berakhir
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">2 karyawan - Perlu diperpanjang</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Karyawan Activities - Soft Modern Design -->
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-pink-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-100 to-pink-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Cuti Anda disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - Mulai 10 Jan 2026
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-orange-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Lembur menunggu
                                            persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Lembur 5 jam - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat sudah terbit</p>
                                        <p class="text-xs text-gray-500 mb-2">Surat Keterangan Kerja - Siap diunduh
                                        </p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            1 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Cuti ditolak</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti sakit 1 hari - 5 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            3 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                <?php if(Auth::user()->role !== 'karyawan'): ?>
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden">
                            <div
                                class="px-5 py-4 border-b border-gray-100/50 bg-gradient-to-r from-purple-50/30 to-pink-50/30">
                                <h3 class="text-sm font-semibold text-gray-800">Aksi Cepat</h3>
                            </div>
                            <div class="divide-y divide-gray-100/50">
                                <!-- Quick Actions - Direktur -->
                                <?php if(Auth::user()->role === 'direktur'): ?>
                                    <a href="<?php echo e(route('direktur.persetujuan-cuti-lembur')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Review Pengajuan</p>
                                                <p class="text-xs text-gray-600"><?php echo e($pendingApprovals ?? 0); ?>

                                                    pengajuan menunggu</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="<?php echo e(route('direktur.laporan')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm10-3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 00-1-1h-3z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Laporan Bulanan</p>
                                                <p class="text-xs text-gray-600">SDM, kehadiran & pengajuan</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="<?php echo e(route('direktur.ringkasan-karyawan')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Ringkasan Karyawan</p>
                                                <p class="text-xs text-gray-600">Data 156 karyawan</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                <?php elseif(Auth::user()->role === 'admin_hrd'): ?>
                                    <!-- Quick Actions - Admin HRD -->
                                    <a href="<?php echo e(route('admin.karyawan')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Kelola Karyawan</p>
                                                <p class="text-xs text-gray-600">156 karyawan aktif</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="<?php echo e(route('admin.surat')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-purple-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Kelola Surat</p>
                                                <p class="text-xs text-gray-600">5 surat menunggu</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="<?php echo e(route('admin.template')); ?>"
                                        class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                    <path fill-rule="evenodd"
                                                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">Template Surat</p>
                                                <p class="text-xs text-gray-600">Kelola template</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-100/50">
                            <!-- Quick Actions - Direktur -->
                            <?php if(Auth::user()->role === 'direktur'): ?>
                                <a href="<?php echo e(route('direktur.persetujuan-cuti-lembur')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Review Pengajuan</p>
                                            <p class="text-xs text-gray-600">13 pengajuan menunggu</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="<?php echo e(route('direktur.laporan')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm10-3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 00-1-1h-3z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Laporan Bulanan</p>
                                            <p class="text-xs text-gray-600">SDM, kehadiran & pengajuan</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="<?php echo e(route('direktur.ringkasan-karyawan')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-700" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Ringkasan Karyawan</p>
                                            <p class="text-xs text-gray-600">Data 156 karyawan</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            <?php elseif(Auth::user()->role === 'admin_hrd'): ?>
                                <!-- Quick Actions - Admin HRD -->
                                <a href="<?php echo e(route('admin.karyawan')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Kelola Karyawan</p>
                                            <p class="text-xs text-gray-600">156 karyawan aktif</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="<?php echo e(route('admin.surat')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Kelola Surat</p>
                                            <p class="text-xs text-gray-600">5 surat menunggu</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="<?php echo e(route('admin.template')); ?>"
                                    class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                <path fill-rule="evenodd"
                                                    d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">Template Surat</p>
                                            <p class="text-xs text-gray-600">Kelola template</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4">Agenda Mendatang</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-purple-400 mt-1.5"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Meeting Tim</p>
                                    <p class="text-xs text-gray-500">Hari ini, 14:00 WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-yellow-400 mt-1.5"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Evaluasi Kinerja</p>
                                    <p class="text-xs text-gray-500">Besok, 09:00 WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-pink-400 mt-1.5"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Pelatihan</p>
                                    <p class="text-xs text-gray-500">10 Jan 2026, 10:00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    </div>
    </div>

    <!-- Mobile Sidebar Toggle (for responsive) -->
    <div class="lg:hidden fixed bottom-6 right-6 z-50">
        <button
            class="w-14 h-14 bg-indigo-600 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-indigo-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
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
<?php /**PATH C:\xampp5\htdocs\admin-KJT\resources\views/dashboard.blade.php ENDPATH**/ ?>