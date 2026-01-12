<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Saya
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gradient-to-br from-slate-50/80 via-blue-50/20 to-purple-50/10 min-h-full">
        <!-- Welcome Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Absensi Saya</h1>
            <p class="text-sm text-gray-500">Pantau kehadiran dan status pengajuan Anda</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <!-- Sisa Cuti Tahunan -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-100/50 hover:-translate-y-0.5">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Sisa Cuti Tahunan</p>
                        <p class="text-2xl font-semibold bg-gradient-to-r from-emerald-500/80 to-emerald-400/70 bg-clip-text text-transparent">8</p>
                        <p class="text-xs text-gray-500 mt-0.5">dari 12 hari</p>
                    </div>
                    <div class="p-2.5 bg-gradient-to-br from-emerald-50/60 to-emerald-50/40 rounded-xl shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 bg-gray-100/30 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-400/60 to-emerald-400/50 h-2 rounded-full transition-all duration-500 shadow-sm" style="width: 67%"></div>
                </div>
            </div>

            <!-- Total Pengajuan Cuti -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-100/50 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Pengajuan Cuti</p>
                        <p class="text-2xl font-semibold bg-gradient-to-r from-blue-500/80 to-blue-400/70 bg-clip-text text-transparent">4</p>
                        <p class="text-xs text-gray-500 mt-0.5">tahun ini</p>
                    </div>
                    <div class="p-2.5 bg-gradient-to-br from-blue-50/60 to-blue-50/40 rounded-xl shadow-sm">
                        <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Pengajuan Lembur -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-100/50 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Pengajuan Lembur</p>
                        <p class="text-2xl font-semibold bg-gradient-to-r from-purple-500/80 to-purple-400/70 bg-clip-text text-transparent">6</p>
                        <p class="text-xs text-gray-500 mt-0.5">tahun ini</p>
                    </div>
                    <div class="p-2.5 bg-gradient-to-br from-purple-50/60 to-purple-50/40 rounded-xl shadow-sm">
                        <svg class="w-5 h-5 text-purple-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Status Terakhir -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 border border-gray-100/50 hover:-translate-y-0.5">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1.5">Status Terakhir</p>
                        <p class="text-lg font-semibold text-gray-800">Disetujui</p>
                        <p class="text-xs text-gray-500 mt-0.5">Cuti 3 hari • 10 Jan</p>
                    </div>
                    <div class="p-2.5 bg-gradient-to-br from-green-50/60 to-green-50/40 rounded-xl shadow-sm">
                        <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Status Pengajuan Terbaru -->
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-pink-50/20 via-purple-50/20 to-orange-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Status Pengajuan Terbaru</h3>
                </div>
                <div class="divide-y divide-gray-100/50">
                    <!-- Item 1 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Pengajuan Cuti Tahunan</p>
                                        <p class="text-xs text-gray-500 mt-0.5">3 hari • 10 - 12 Januari 2026</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                                </div>
                                <p class="text-xs text-gray-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Diproses: 7 Jan 2026
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-50/60 to-yellow-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-yellow-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Pengajuan Lembur</p>
                                        <p class="text-xs text-gray-500 mt-0.5">5 jam • 6 Januari 2026</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-yellow-50/70 text-yellow-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Menunggu</span>
                                </div>
                                <p class="text-xs text-gray-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Diajukan: 5 Jan 2026
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50/60 to-blue-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Untuk keperluan bank</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                                </div>
                                <p class="text-xs text-gray-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Tersedia: 3 Jan 2026
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Pengajuan Cuti Sakit</p>
                                        <p class="text-xs text-gray-500 mt-0.5">1 hari • 5 Januari 2026</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-red-50/70 text-red-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Ditolak</span>
                                </div>
                                <p class="text-xs text-gray-400">Alasan: Bentrok dengan shift penting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Mendatang -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-purple-50/20 to-pink-50/20">
                    <h3 class="text-sm font-semibold text-gray-800">Agenda Mendatang</h3>
                </div>
                <div class="divide-y divide-gray-100/50">
                    <!-- Event 1 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-emerald-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex gap-3 items-start">
                            <div class="text-center min-w-[50px]">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-50/60 to-emerald-50/40 flex flex-col items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    <p class="text-lg font-semibold text-emerald-500/70 leading-none">10</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Jan</p>
                                </div>
                            </div>
                            <div class="flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-800">Cuti Tahunan Dimulai</p>
                                <p class="text-xs text-gray-500 mt-0.5">3 hari libur</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event 2 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-indigo-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex gap-3 items-start">
                            <div class="text-center min-w-[50px]">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-50/60 to-indigo-50/40 flex flex-col items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    <p class="text-lg font-semibold text-indigo-500/70 leading-none">25</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Jan</p>
                                </div>
                            </div>
                            <div class="flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-800">Gajian Bulan Januari</p>
                                <p class="text-xs text-gray-500 mt-0.5">Slip gaji tersedia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-slate-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex gap-3 items-start">
                            <div class="text-center min-w-[50px]">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-50/60 to-slate-50/40 flex flex-col items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    <p class="text-lg font-semibold text-slate-500/70 leading-none">31</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">Jan</p>
                                </div>
                            </div>
                            <div class="flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-800">Akhir Bulan</p>
                                <p class="text-xs text-gray-500 mt-0.5">Deadline pengajuan cuti</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-3 bg-gray-50/50 border-t border-gray-100/50 text-center">
                    <a href="{{ route('karyawan.riwayat') }}" class="text-xs font-medium text-purple-600 hover:text-purple-700 transition-colors inline-flex items-center gap-1">
                        Lihat Riwayat Lengkap
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden mb-8 hover:shadow-md transition-shadow duration-300">
            <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-pink-50/20 via-purple-50/20 to-orange-50/15">
                <h3 class="text-sm font-semibold text-gray-800">Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-100/50">
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 mb-0.5">Pengajuan cuti Anda disetujui</p>
                            <p class="text-xs text-gray-500 mb-1.5">Cuti tahunan 3 hari • 7 Jan 2026</p>
                            <span class="inline-flex items-center text-xs text-gray-400 gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                2 hari lalu
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-50/60 to-yellow-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-yellow-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 mb-0.5">Pengajuan lembur menunggu persetujuan</p>
                            <p class="text-xs text-gray-500 mb-1.5">5 jam lembur • 6 Jan 2026</p>
                            <span class="inline-flex items-center text-xs text-gray-400 gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                1 hari lalu
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50/60 to-blue-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 mb-0.5">Surat Keterangan Kerja tersedia</p>
                            <p class="text-xs text-gray-500 mb-1.5">Untuk keperluan bank • Siap diunduh</p>
                            <span class="inline-flex items-center text-xs text-gray-400 gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                3 hari lalu
                            </span>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 mb-0.5">Pengajuan cuti ditolak</p>
                            <p class="text-xs text-gray-500 mb-1.5">Cuti sakit 1 hari • Bentrok dengan shift</p>
                            <span class="inline-flex items-center text-xs text-gray-400 gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                5 hari lalu
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <a href="{{ route('karyawan.pengajuan-cuti') }}" class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start gap-3">
                    <div class="p-3 bg-gradient-to-br from-emerald-50/60 to-emerald-50/40 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-6 h-6 text-emerald-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-emerald-500/80 transition-colors mb-0.5">Ajukan Cuti</p>
                        <p class="text-xs text-gray-500">Cuti tahunan, sakit, atau khusus</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-500/80 transition-colors mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('karyawan.pengajuan-lembur') }}" class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start gap-3">
                    <div class="p-3 bg-gradient-to-br from-purple-50/60 to-purple-50/40 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-6 h-6 text-purple-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-purple-500/80 transition-colors mb-0.5">Ajukan Lembur</p>
                        <p class="text-xs text-gray-500">Jam kerja tambahan</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-500/80 transition-colors mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>

            <a href="{{ route('karyawan.surat') }}" class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-50/60 to-blue-50/40 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-6 h-6 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800 group-hover:text-blue-500/80 transition-colors mb-0.5">Ajukan Surat</p>
                        <p class="text-xs text-gray-500">PKWT, PKWTT, atau lainnya</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500/80 transition-colors mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>
                </div>
    </div>
</x-app-layout>
