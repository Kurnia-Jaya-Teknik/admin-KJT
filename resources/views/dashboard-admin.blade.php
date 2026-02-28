<x-app-layout>
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50/50 min-h-full">
            <!-- Welcome Banner -->
            @if (Auth::user()->role === 'karyawan')
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-slate-400 via-slate-400 to-slate-500 rounded-2xl p-6 mb-6 shadow-lg">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold mb-1 text-white">Halo, {{ Auth::user()->name }}! 👋</h1>
                                <p class="text-slate-50 text-sm font-medium">
                                    {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="relative overflow-hidden bg-gradient-to-r from-red-500/85 via-red-600/80 to-slate-600/75 rounded-3xl p-8 mb-8 shadow-lg border border-red-200/30">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}!
                                    👋</h1>
                                <p class="text-red-50/90 text-sm">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if (Auth::user()->role === 'direktur')
                    <!-- Direktur Stats Card 1: Total Karyawan -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-slate-100/60 transition-all duration-300 hover:-translate-y-1">
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
                                    class="text-xs font-medium text-slate-600/80 bg-slate-50/70 px-2.5 py-1.5 rounded-full border border-slate-200/30 shadow-sm">👥
                                    Aktif</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $totalKaryawan }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Total Karyawan Aktif</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 2: Cuti Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
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
                                {{ $cutiPending }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Cuti Menunggu Persetujuan</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 3: Lembur Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
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
                                {{ $lemburPending }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Lembur Menunggu Persetujuan</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 4: Surat Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
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
                                {{ $suratPending }}
                            </h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Menunggu Proses</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 5: Persetujuan Selesai -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-green-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $persetujuanSelesai }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Persetujuan Selesai Bulan Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 6: Kehadiran Hari Ini -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
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
                                    {{ $totalKaryawan > 0 ? round(($hadirHariIni / $totalKaryawan) * 100) : 0 }}%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $hadirHariIni }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Hadir Hari Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 7: Surat Dikirim -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $suratDikirimBulan ?? 0 }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Sudah Dikirim</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 8: Tindakan Diperlukan -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $pendingApprovals }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Memerlukan Tindakan Segera</p>
                        </div>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Admin HRD Stats - 8 Cards Grid -->
                    <!-- Card 1: Total Karyawan -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-slate-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ number_format($totalKaryawan) }}
                            </h3>
                            <p class="text-sm text-gray-600 font-medium">Total Karyawan Aktif</p>
                        </div>
                    </div>

                    <!-- Kehadiran card removed per user request -->

                    <!-- Card 3: Cuti Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $cutiPending }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Cuti Pending</p>
                        </div>
                    </div>

                    <!-- Card 4: Lembur Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $lemburPending }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Lembur Pending</p>
                        </div>
                    </div>

                    <!-- Card 5: Surat Pending -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $suratPending }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat dalam Proses</p>
                        </div>
                    </div>

                    <!-- Card 6: Disetujui -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $pengajuanDisetujui }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Disetujui</p>
                        </div>
                    </div>

                    <!-- Card 7: Surat Siap -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $suratDiterbitkan }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Siap Dikirim</p>
                        </div>
                    </div>

                    <!-- Card 8: Ditolak/Revisi -->
                    <div
                        class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
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
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">{{ $revisiCount }}</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Perlu Revisi</p>
                        </div>
                    </div>
                @else
                    <!-- Karyawan Stats - Personal (Soft Modern Design) -->
                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-slate-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-slate-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Tersisa</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-1">12</h3>
                        <p class="text-sm text-gray-500 font-medium">Sisa Cuti Tahun Ini</p>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-gray-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-100 to-gray-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-slate-600 bg-slate-50 px-2.5 py-1 rounded-full">Digunakan</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500 font-medium">Cuti Dipakai Tahun Ini</p>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-orange-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Januari</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-1">16</h3>
                        <p class="text-sm text-gray-500 font-medium">Total Lembur Bulan Ini</p>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-emerald-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Disetujui</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">Disetujui</h3>
                        <p class="text-sm text-gray-500 font-medium">Status Pengajuan Terakhir</p>
                    </div>
                @endif
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                @if (Auth::user()->role === 'direktur' && isset($pengajuanPerBulan))
                    <!-- Charts Section - Direktur (2 kolom) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Bulan Ini Chart - Normal Bar Chart with Tooltip -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan per Bulan (6 Bulan
                                    Terakhir)</h3>
                                <div
                                    class="flex items-end justify-between h-56 gap-3 mb-6 px-2 relative border-b-2 border-gray-200/50 pb-4">
                                    @foreach ($pengajuanPerBulan as $entry)
                                        @php
                                            $height = $maxPengajuan
                                                ? floor(($entry['count'] / $maxPengajuan) * 110)
                                                : 20;
                                        @endphp
                                        <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                            <div
                                                class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                                <span>{{ $entry['count'] }}</span>
                                                <div
                                                    class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600">
                                                </div>
                                            </div>
                                            <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer"
                                                style="height: {{ $height }}px;"></div>
                                            <span
                                                class="text-xs text-gray-600 font-medium">{{ $entry['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pt-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                        <span
                                            class="text-lg font-bold bg-gradient-to-r from-rose-500 to-rose-400 bg-clip-text text-transparent">{{ $totalPengajuan6 }}
                                            pengajuan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lembur Per Divisi - Soft Gradient Progress Bars -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-orange-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Lembur per Divisi (Bulan Ini)</h3>
                                @php
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
                                @endphp
                                <div class="space-y-5">
                                    @forelse($lemburPerDepartemen as $index => $dept)
                                        @php
                                            $color = $colors[$index % count($colors)];
                                            $widthPercent =
                                                $maxLemburJam > 0
                                                    ? round(($dept['total_jam'] / $maxLemburJam) * 100)
                                                    : 0;
                                        @endphp
                                        <div>
                                            <div class="flex items-center justify-between mb-2.5">
                                                <span
                                                    class="text-sm font-medium text-gray-700">{{ $dept['nama'] }}</span>
                                                <span
                                                    class="text-sm font-bold bg-gradient-to-r from-{{ $color['from'] }} to-{{ $color['to'] }} bg-clip-text text-transparent">{{ $dept['total_jam'] }}
                                                    jam</span>
                                            </div>
                                            <div
                                                class="w-full bg-gradient-to-r from-gray-200/40 to-gray-100/30 rounded-full h-3 shadow-sm overflow-hidden">
                                                <div class="bg-gradient-to-r from-{{ $color['bar-from'] }} to-{{ $color['bar-to'] }} h-3 rounded-full shadow-md transition-all duration-300 hover:shadow-lg"
                                                    style="width: {{ $widthPercent }}%"></div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500 text-center py-4">Belum ada data lembur bulan
                                            ini</p>
                                    @endforelse
                                </div>
                                <div class="mt-5 pt-4 border-t border-gray-100/30 flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Total Lembur</span>
                                    <span
                                        class="text-lg font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">{{ $totalLemburBulanIni }}
                                        jam</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan Donut - Soft Gradient Colors -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-green-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan</h3>
                                @php
                                    $total = $statusApproved + $statusPending + $statusRejected;
                                    $circumference = 2 * 3.14159 * 55;
                                    $approvedDash = $total > 0 ? ($statusApproved / $total) * $circumference : 0;
                                    $pendingDash = $total > 0 ? ($statusPending / $total) * $circumference : 0;
                                    $rejectedDash = $total > 0 ? ($statusRejected / $total) * $circumference : 0;
                                    $approvedPct = $total > 0 ? round(($statusApproved / $total) * 100) : 0;
                                    $pendingPct = $total > 0 ? round(($statusPending / $total) * 100) : 0;
                                    $rejectedPct = $total > 0 ? round(($statusRejected / $total) * 100) : 0;
                                @endphp
                                <div class="flex items-center justify-center mb-6">
                                    <div class="relative w-48 h-48">
                                        <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 140 140"
                                            style="transform: rotate(-90deg)">
                                            <!-- Approved -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#10b981" stroke-width="22"
                                                stroke-dasharray="{{ $approvedDash }} {{ $circumference }}"
                                                stroke-linecap="round" opacity="0.8" />
                                            <!-- Pending -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#f59e0b" stroke-width="22"
                                                stroke-dasharray="{{ $pendingDash }} {{ $circumference }}"
                                                stroke-dashoffset="-{{ $approvedDash }}" stroke-linecap="round"
                                                opacity="0.8" />
                                            <!-- Rejected -->
                                            <circle cx="70" cy="70" r="55" fill="none"
                                                stroke="#ef4444" stroke-width="22"
                                                stroke-dasharray="{{ $rejectedDash }} {{ $circumference }}"
                                                stroke-dashoffset="-{{ $approvedDash + $pendingDash }}"
                                                stroke-linecap="round" opacity="0.8" />
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center">
                                                <div
                                                    class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                                    {{ $total }}</div>
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
                                        <span class="font-bold text-gray-800">{{ $statusApproved }}
                                            ({{ $approvedPct }}%)</span>
                                    </div>
                                    <div
                                        class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-amber-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 flex-shrink-0 shadow-sm">
                                            </div>
                                            <span class="text-gray-600">Menunggu</span>
                                        </div>
                                        <span class="font-bold text-gray-800">{{ $statusPending }}
                                            ({{ $pendingPct }}%)</span>
                                    </div>
                                    <div
                                        class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-red-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-4 h-4 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex-shrink-0 shadow-sm">
                                            </div>
                                            <span class="text-gray-600">Ditolak</span>
                                        </div>
                                        <span class="font-bold text-gray-800">{{ $statusRejected }}
                                            ({{ $rejectedPct }}%)</span>
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
                                    <span class="font-bold text-lg text-yellow-600">{{ $pendingApprovals }}</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Disetujui (Bulan Ini)</span>
                                    </div>
                                    <span
                                        class="font-bold text-lg text-green-600">{{ $persetujuanSelesai ?? 0 }}</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Ditolak (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-red-600">{{ $ditolakBulan ?? 0 }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Kehadiran Hari Ini</span>
                                    </div>
                                    <span
                                        class="font-bold text-lg text-slate-600">{{ $hadirHariIni }}/{{ $totalKaryawan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd' && isset($pengajuanPerBulan))
                    <!-- Charts Section - Admin HRD -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Masuk - Soft Gradient Chart -->
                        <div
                            class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-purple-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Pengajuan Masuk (6 Bulan Terakhir)
                                </h3>

                                <!-- Chart Container -->
                                <div class="flex gap-2 items-end border-b-2 border-gray-200/50 pb-4"
                                    style="height: 240px;">
                                    @php
                                        $bulanColors = ['blue', 'indigo', 'purple', 'pink', 'rose', 'red'];
                                        $bulanIndex = 0;
                                    @endphp
                                    @foreach ($pengajuanPerBulan as $entry)
                                        @php
                                            $heightPercent = ($entry['count'] / $maxPengajuan) * 100;
                                            $heightPx = max(40, ($heightPercent / 100) * 240);
                                            $color = $bulanColors[$bulanIndex % count($bulanColors)];
                                            $bulanIndex++;
                                        @endphp
                                        <div
                                            class="flex-1 flex flex-col items-center justify-end gap-2 group/bar relative">
                                            <!-- Tooltip on hover -->
                                            <div class="absolute bottom-full mb-2 hidden group-hover/bar:block z-10">
                                                <div
                                                    class="bg-gray-900 text-white text-xs rounded-lg px-3 py-2 shadow-lg whitespace-nowrap">
                                                    <div class="font-semibold">{{ $entry['label'] }}</div>
                                                    <div class="text-gray-300">{{ $entry['count'] }} pengajuan</div>
                                                </div>
                                            </div>
                                            <!-- Bar -->
                                            <div class="w-full bg-gradient-to-t from-{{ $color }}-400 to-{{ $color }}-300 rounded-t-xl shadow-md hover:shadow-lg hover:from-{{ $color }}-500 hover:to-{{ $color }}-400 transition-all duration-300 cursor-pointer relative"
                                                style="height: {{ $heightPx }}px;">
                                                <!-- Count badge on bar -->
                                                <div
                                                    class="absolute top-2 left-1/2 -translate-x-1/2 bg-white/90 text-{{ $color }}-700 text-xs font-bold px-2 py-0.5 rounded-full shadow">
                                                    {{ $entry['count'] }}
                                                </div>
                                            </div>
                                            <!-- Label -->
                                            <span
                                                class="text-[10px] text-gray-600 font-medium mt-1 text-center leading-tight">{{ $entry['label'] }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="pt-4 border-t border-gray-100/30 flex items-center justify-between mt-4">
                                    <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                    <span
                                        class="text-lg font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ $totalPengajuan6 }}
                                        pengajuan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pengajuan Breakdown by Type -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Cuti vs Lembur Comparison -->
                            <div
                                class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6">
                                <h4 class="text-sm font-semibold text-gray-800 mb-4">Pengajuan Menunggu</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                            <span class="text-xs text-gray-600">Cuti Pending</span>
                                        </div>
                                        <span class="font-bold text-amber-600">{{ $cutiPending }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                                            <span class="text-xs text-gray-600">Lembur Pending</span>
                                        </div>
                                        <span class="font-bold text-orange-600">{{ $lemburPending }}</span>
                                    </div>
                                    <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                                        <span class="text-xs font-semibold text-gray-700">Total Pending</span>
                                        <span
                                            class="font-bold text-lg text-gray-800">{{ $cutiPending + $lemburPending }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengajuan Disetujui Bulan Ini -->
                            <div
                                class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6">
                                <h4 class="text-sm font-semibold text-gray-800 mb-4">Disetujui Bulan Ini</h4>
                                <div class="text-center py-6">
                                    <div class="text-3xl font-bold text-green-600">{{ $pengajuanDisetujui }}</div>
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
                                                {{ $statusTotal }}</div>
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
                                            {{ $statusApproved }}</div>
                                    </div>

                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-yellow-600"></div>
                                            <span class="text-sm text-gray-700">Menunggu</span>
                                        </div>
                                        <div id="countPending" class="text-sm font-bold text-gray-800">
                                            {{ $statusPending }}</div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                                            <span class="text-sm text-gray-700">Ditolak</span>
                                        </div>
                                        <div id="countRejected" class="text-sm font-bold text-gray-800">
                                            {{ $statusRejected }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart.js Script (CDN) -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                (function() {
                                    const approved = {{ $statusApproved ?? 0 }};
                                    const pending = {{ $statusPending ?? 0 }};
                                    const rejected = {{ $statusRejected ?? 0 }};
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
                                    <span class="font-bold text-lg text-yellow-600">{{ $suratPending }}</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Disetujui</span>
                                    <span class="font-bold text-lg text-blue-600">{{ $suratDisetujui }}</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Diterbitkan</span>
                                    <span class="font-bold text-lg text-purple-600">{{ $suratDiterbitkan }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Ditolak</span>
                                    <span class="font-bold text-lg text-red-600">{{ $suratDitolak }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Charts Section - Karyawan (Personal) - Soft Modern Design -->
                    <div class="lg:col-span-2 space-y-5">
                        <!-- Personal Attendance chart removed per user request -->
                        {{-- <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-base font-semibold text-gray-800">Ijin Sakit Saya</h3>
                                <a href="{{ route('karyawan.ijin-sakit') }}"
                                    class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Ajukan
                                    Ijin Sakit</a>
                            </div>
                            <p class="text-sm text-gray-600">Grafik kehadiran dihapus. Gunakan tombol di atas untuk
                                mengajukan ijin sakit atau lihat riwayat pengajuan.</p>
                        </div> --}}

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

                    <!-- Right Column - Karyawan (Personal) - Soft Modern Design -->
                    <div class="space-y-5">
                        <!-- Surat Keterangan Diterima - PRIORITAS TERATAS -->
                        <div
                            class="bg-gradient-to-br from-green-50 to-emerald-50 backdrop-blur-sm rounded-xl shadow-md border-2 border-green-200 p-5 ring-2 ring-green-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                                    <span class="text-lg">📬</span>
                                    Surat Keterangan Diterima
                                </h3>
                                <span id="suratBadge"
                                    class="hidden px-2.5 py-1 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse shadow-lg">0</span>
                            </div>
                            <div id="suratDiterimaContainer" class="space-y-3">
                                <div class="flex items-center justify-center py-6">
                                    <div class="text-center">
                                        <div
                                            class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto mb-2">
                                        </div>
                                        <p class="text-xs text-gray-500">Loading...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex gap-2 items-center">
                                <a href="{{ route('karyawan.surat-keterangan.request.index') }}"
                                    class="flex-1 text-center text-xs font-semibold text-gray-700 hover:text-gray-800 py-2.5 border-2 border-gray-300 rounded-lg hover:bg-white transition-all">
                                    📋 Ajukan Permintaan
                                </a>
                                <a href="/karyawan/surat-keterangan"
                                    class="flex-1 text-center text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all">
                                    Lihat Semua →
                                </a>
                            </div>
                        </div>

                        <!-- Cuti Balance Quick View -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Kuota Cuti Saya</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Cuti Tahunan</span>
                                        <span class="text-sm font-semibold text-red-600">12 / 20 hari</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full transition-all duration-500"
                                            style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Cuti Sakit</span>
                                        <span class="text-sm font-semibold text-slate-600">Tidak Terbatas</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-slate-500 to-slate-600 h-2 rounded-full transition-all duration-500"
                                            style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Summary -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Info Saya</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Bagian</span>
                                    <span class="font-semibold text-gray-800">IT & Teknologi</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Status</span>
                                    <span class="font-semibold text-gray-800">Tetap</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-500 font-medium">Kehadiran Bulan Ini</span>
                                    <span class="font-semibold text-lg text-red-600">100%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-500 font-medium">Menunggu Persetujuan</span>
                                    <span class="font-semibold text-lg text-slate-600">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="{{ route('karyawan.pengajuan-cuti') }}"
                                    class="block w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Cuti
                                </a>
                                <a href="{{ route('karyawan.pengajuan-lembur') }}"
                                    class="block w-full bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Lembur
                                </a>
                                <a href="{{ route('karyawan.surat-keterangan.request.index') }}"
                                    class="block w-full bg-gradient-to-r from-red-700 to-red-800 hover:from-red-800 hover:to-red-900 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Surat Keterangan
                                </a>
                                <a href="{{ route('karyawan.surat') }}"
                                    class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Surat Saya
                                </a>
                            </div>
                        </div>

                        <!-- Pengajuan Pending -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Pengajuan Menunggu</h3>
                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-3 bg-red-50/50 rounded-lg border border-red-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Cuti Tahunan</p>
                                            <p class="text-xs text-gray-500">2 hari - 15-16 Jan</p>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs font-medium text-red-600 bg-red-100 px-2 py-0.5 rounded-full">Pending</span>
                                </div>
                                <div
                                    class="flex items-center justify-between p-3 bg-slate-50/50 rounded-lg border border-slate-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-slate-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Lembur</p>
                                            <p class="text-xs text-gray-500">5 jam - 12 Jan</p>
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-0.5 rounded-full">Review</span>
                                </div>
                            </div>
                            <a href="{{ route('karyawan.riwayat') }}"
                                class="mt-3 block text-center text-xs font-medium text-slate-600 hover:text-slate-700">
                                Lihat Semua →
                            </a>
                        </div>

                        <!-- Statistik Bulanan -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Statistik Bulan Ini</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Kehadiran</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">90.9%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Total Lembur</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">16 jam</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Cuti Digunakan</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">2 hari</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Surat Terbit</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notifikasi Penting -->
                        <div
                            class="bg-gradient-to-br from-red-50/50 to-slate-50/30 rounded-xl shadow-sm border border-red-100/50 p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <h3 class="text-sm font-semibold text-gray-800">Ringkasan Hari Ini</h3>
                            </div>
                            <div class="space-y-2">
                                <div class="text-xs text-gray-600 leading-relaxed">
                                    <p class="font-medium text-gray-800 mb-1">• Kehadiran Hari Ini</p>
                                    <p class="text-gray-500">{{ $hadirHariIni ?? 0 }} dari {{ $totalKaryawan ?? 0 }}
                                        karyawan hadir</p>
                                </div>
                                <div class="text-xs text-gray-600 leading-relaxed pt-2 border-t border-red-100/50">
                                    <p class="font-medium text-gray-800 mb-1">• Persetujuan Menunggu</p>
                                    <p class="text-gray-500">{{ $pendingApprovals ?? 0 }} pengajuan memerlukan
                                        tindakan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pending Requests - Direktur (Card Format) -->
            @if (Auth::user()->role === 'direktur')
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Pengajuan Cuti - Card List Format -->
                    @php
                        $cutiList = isset($pengajuanMenunggu)
                            ? $pengajuanMenunggu->where('type', 'cuti')->take(5)
                            : collect();
                        $lemburList = isset($pengajuanMenunggu)
                            ? $pengajuanMenunggu->where('type', 'lembur')->take(5)
                            : collect();
                        $colors = ['indigo', 'blue', 'green', 'orange', 'red', 'purple', 'pink', 'yellow'];
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                            <h3 class="text-lg font-bold text-gray-800">Cuti Menunggu Persetujuan
                                ({{ $cutiPending }})</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            @forelse($cutiList as $index => $item)
                                @php
                                    $color = $colors[$index % count($colors)];
                                    $initials = collect(explode(' ', $item['nama']))
                                        ->map(fn($n) => substr($n, 0, 1))
                                        ->take(2)
                                        ->join('');
                                @endphp
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center flex-shrink-0 font-semibold text-{{ $color }}-600">
                                            {{ $initials }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">{{ $item['nama'] }}</p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">{{ $item['jenis'] }}</p>
                                            <p class="text-xs font-medium text-gray-700">{{ $item['durasi'] }} •
                                                {{ $item['tanggal'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-8 text-center">
                                    <p class="text-sm text-gray-500">Tidak ada pengajuan cuti menunggu</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                                class="text-sm font-semibold text-green-600 hover:text-green-700">Lihat Semua →</a>
                        </div>
                    </div>

                    <!-- Pengajuan Lembur - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Lembur Menunggu Persetujuan
                                ({{ $lemburPending }})</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            @forelse($lemburList as $index => $item)
                                @php
                                    $color = $colors[$index % count($colors)];
                                    $initials = collect(explode(' ', $item['nama']))
                                        ->map(fn($n) => substr($n, 0, 1))
                                        ->take(2)
                                        ->join('');
                                @endphp
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center flex-shrink-0 font-semibold text-{{ $color }}-600">
                                            {{ $initials }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">{{ $item['nama'] }}
                                                </p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800">Pending</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">{{ $item['jenis'] }}</p>
                                            <p class="text-xs font-medium text-gray-700">{{ $item['durasi'] }} •
                                                {{ $item['tanggal'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-8 text-center">
                                    <p class="text-sm text-gray-500">Tidak ada pengajuan lembur menunggu</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                                class="text-sm font-semibold text-purple-600 hover:text-purple-700">Lihat Semua →</a>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->role === 'admin_hrd')
                <!-- Pending Requests - Admin HRD -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Surat Menunggu Proses -->
                    <div id="surat-card" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Surat Menunggu Proses (<span
                                    id="surat-count">{{ $suratMenunggu->count() }}</span>)</h3>
                        </div>
                        <div id="surat-list" class="divide-gray-100 max-h-80 overflow-y-auto">
                            @forelse($suratMenunggu as $surat)
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors"
                                    data-id="{{ $surat->id }}">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">
                                            {{ strtoupper(substr($surat->user->name, 0, 2)) }}</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $surat->user->name }}
                                                </p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-yellow-100 text-yellow-800 status-label">{{ $surat->status }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">{{ $surat->jenis ?? 'Surat' }}</p>
                                            <p class="text-xs font-medium text-gray-700">Diajukan
                                                {{ $surat->created_at->format('d M Y') }}</p>

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
                            @empty
                                <div class="px-6 py-4 text-sm text-gray-500">Tidak ada surat menunggu.</div>
                            @endforelse
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('admin.surat') }}"
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
                            @forelse($karyawanPerluPerhatian ?? [] as $index => $karyawan)
                                @php
                                    $colors = ['indigo', 'blue', 'green', 'orange', 'red', 'purple', 'pink', 'yellow'];
                                    $color = $karyawan['badge_color'] ?? 'gray';
                                    $initials = collect(explode(' ', $karyawan['nama']))
                                        ->map(fn($n) => substr($n, 0, 1))
                                        ->take(2)
                                        ->join('');
                                @endphp
                                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-{{ $color }}-100 flex items-center justify-center flex-shrink-0 font-semibold text-{{ $color }}-600">
                                            {{ $initials }}</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <p class="text-sm font-semibold text-gray-800">
                                                    {{ $karyawan['nama'] }}</p>
                                                <span
                                                    class="text-xs px-2 py-0.5 rounded-full font-medium bg-{{ $color }}-100 text-{{ $color }}-800">{{ $karyawan['badge'] }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500 mb-1">{{ $karyawan['departemen'] }}</p>
                                            <p class="text-xs font-medium text-gray-700">
                                                {{ $karyawan['keterangan'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-8 text-center">
                                    <p class="text-sm text-gray-500">Tidak ada karyawan yang perlu perhatian khusus</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('admin.karyawan') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">Kelola Karyawan →</a>
                        </div>
                    </div>
                </div>

                <!-- Modals untuk Surat Detail -->
                @foreach ($suratMenunggu as $surat)
                    <div id="surat-modal-{{ $surat->id }}"
                        class="js-modal hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                            <!-- Modal Header -->
                            <div
                                class="sticky top-0 px-6 py-5 bg-gradient-to-r from-purple-50 to-purple-50 border-b border-gray-200 flex items-center justify-between">
                                <h2 class="text-lg font-bold text-gray-800">Detail Surat</h2>
                                <button
                                    onclick="document.getElementById('surat-modal-{{ $surat->id }}').classList.add('hidden')"
                                    class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Pengajuan Oleh</p>
                                            <p class="text-sm font-semibold text-gray-800">{{ $surat->user->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs text-gray-500">Jenis Surat</p>
                                            <p class="text-sm font-semibold text-gray-800">{{ $surat->jenis }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Nomor Surat</p>
                                            <p class="text-sm font-semibold text-gray-800">{{ $surat->nomor_surat }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Status</p>
                                            <span
                                                class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $surat->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">{{ $surat->status }}</span>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Tanggal Pengajuan</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $surat->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail Surat -->
                                <div class="space-y-3">
                                    <h3 class="font-semibold text-gray-800">Detail Surat</h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Perihal</p>
                                            <p class="text-sm text-gray-800">{{ $surat->perihal }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Isi Surat</p>
                                            <p class="text-sm text-gray-800 whitespace-pre-wrap">
                                                {{ $surat->isi_surat }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Keterangan Tambahan</p>
                                            <p class="text-sm text-gray-800">{{ $surat->keterangan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-3 pt-4 border-t">
                                    <button onclick="approveAction({{ $surat->id }})"
                                        class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                                        Setujui
                                    </button>
                                    <button onclick="rejectAction({{ $surat->id }})"
                                        class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                                        Tolak
                                    </button>
                                    <button onclick="deleteAction({{ $surat->id }})"
                                        class="flex-1 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors">
                                        Hapus
                                    </button>
                                    <button
                                        onclick="document.getElementById('surat-modal-{{ $surat->id }}').classList.add('hidden')"
                                        class="flex-1 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-lg transition-colors">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                    @if (Auth::user()->role === 'karyawan')
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
                    @endif
                </script>
            @endif

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div
                    class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div
                        class="px-6 py-4 border-b border-gray-100/50 bg-gradient-to-r from-pink-50/30 via-purple-50/30 to-orange-50/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h3>
                            <span
                                class="text-xs font-medium text-gray-500 bg-white/60 px-2 py-1 rounded-full">{{ count($aktivitasTerbaru ?? []) }}
                                aktivitas</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100/50">
                        @forelse($aktivitasTerbaru ?? [] as $aktivitas)
                            <div
                                class="px-6 py-5 hover:bg-gradient-to-r hover:from-{{ $aktivitas['color'] }}-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-{{ $aktivitas['color'] }}-100 to-{{ $aktivitas['color'] }}-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        @if ($aktivitas['icon'] === 'check')
                                            <svg class="w-6 h-6 text-{{ $aktivitas['color'] }}-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif($aktivitas['icon'] === 'clock')
                                            <svg class="w-6 h-6 text-{{ $aktivitas['color'] }}-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif($aktivitas['icon'] === 'document')
                                            <svg class="w-6 h-6 text-{{ $aktivitas['color'] }}-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        @elseif($aktivitas['icon'] === 'user-add')
                                            <svg class="w-6 h-6 text-{{ $aktivitas['color'] }}-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-{{ $aktivitas['color'] }}-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">
                                            {{ $aktivitas['judul'] }}</p>
                                        <p class="text-xs text-gray-500 mb-2">{{ $aktivitas['deskripsi'] }}</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $aktivitas['waktu'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-sm text-gray-500">Belum ada aktivitas terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                @if (Auth::user()->role !== 'karyawan')
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
                                @if (Auth::user()->role === 'direktur')
                                    <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
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
                                                <p class="text-xs text-gray-600">{{ $pendingApprovals ?? 0 }}
                                                    pengajuan menunggu</p>
                                            </div>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    <a href="{{ route('direktur.laporan') }}"
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

                                    <a href="{{ route('direktur.ringkasan-karyawan') }}"
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
                                @elseif(Auth::user()->role === 'admin_hrd')
                                    <!-- Quick Actions - Admin HRD -->
                                    <a href="{{ route('admin.karyawan') }}"
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

                                    <a href="{{ route('admin.surat') }}"
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

                                    <a href="{{ route('admin.template') }}"
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
                                @endif
                            </div>
                        </div>

                        <!-- Recent Surat Requests -->
                        @if (isset($suratMenunggu) && $suratMenunggu->isNotEmpty())
                            <div
                                class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                                <h3 class="text-sm font-semibold text-gray-800 mb-4">Surat Menunggu Diproses</h3>
                                <div class="space-y-4">
                                    @foreach ($suratMenunggu as $surat)
                                        <div class="flex items-start space-x-3">
                                            <div class="w-2 h-2 rounded-full bg-amber-400 mt-1.5"></div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">
                                                    {{ $surat->jenis ?? 'Surat' }}</p>
                                                <p class="text-xs text-gray-500">{{ $surat->user->name ?? 'N/A' }} •
                                                    {{ $surat->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
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
</x-app-layout>
