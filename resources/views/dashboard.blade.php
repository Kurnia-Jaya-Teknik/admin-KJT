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
                <div class="relative overflow-hidden bg-gradient-to-r from-slate-400 via-slate-400 to-slate-500 rounded-2xl p-6 mb-6 shadow-lg">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold mb-1 text-white">Halo, {{ Auth::user()->name }}! 👋</h1>
                                <p class="text-slate-50 text-sm font-medium">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="relative overflow-hidden bg-gradient-to-r from-red-500/85 via-red-600/80 to-slate-600/75 rounded-3xl p-8 mb-8 shadow-lg border border-red-200/30">
                    <div class="relative flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                                <p class="text-red-50/90 text-sm">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white/15" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if (Auth::user()->role === 'direktur')
                    <!-- Direktur Stats Card 1: Total Karyawan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-slate-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100/60 to-slate-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-slate-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-600/80 bg-slate-50/70 px-2.5 py-1.5 rounded-full border border-slate-200/30 shadow-sm">👥 Aktif</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">156</h3>
                            <p class="text-sm text-gray-600 font-medium">Total Karyawan Aktif</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 2: Cuti Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-amber-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-amber-600/80 bg-amber-50/70 px-2.5 py-1.5 rounded-full border border-amber-200/30 shadow-sm">⏳ Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">8</h3>
                            <p class="text-sm text-gray-600 font-medium">Cuti Menunggu Persetujuan Direktur</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 3: Lembur Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-100/60 to-orange-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-orange-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-orange-600/80 bg-orange-50/70 px-2.5 py-1.5 rounded-full border border-orange-200/30 shadow-sm">⏳ Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">5</h3>
                            <p class="text-sm text-gray-600 font-medium">Lembur Menunggu Persetujuan</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 4: Surat Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-red-600/80 bg-red-50/70 px-2.5 py-1.5 rounded-full border border-red-200/30 shadow-sm">📋 Proses</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">3</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Menunggu Proses</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 5: Persetujuan Selesai -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-green-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-green-600/80 bg-green-50/70 px-2.5 py-1.5 rounded-full border border-green-200/30 shadow-sm">✅ Selesai</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">47</h3>
                            <p class="text-sm text-gray-600 font-medium">Persetujuan Selesai Bulan Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 6: Kehadiran Hari Ini -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-blue-600/80 bg-blue-50/70 px-2.5 py-1.5 rounded-full border border-blue-200/30 shadow-sm">📊 92%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">143</h3>
                            <p class="text-sm text-gray-600 font-medium">Hadir Hari Ini</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 7: Surat Dikirim -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-100/60 to-purple-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-purple-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-purple-600/80 bg-purple-50/70 px-2.5 py-1.5 rounded-full border border-purple-200/30 shadow-sm">📤 Terkirim</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">12</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Sudah Dikirim</p>
                        </div>
                    </div>

                    <!-- Direktur Stats Card 8: Tindakan Diperlukan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M7 8a5 5 0 1110 0H7z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-rose-600/80 bg-rose-50/70 px-2.5 py-1.5 rounded-full border border-rose-200/30 shadow-sm">⚠️ Penting</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">16</h3>
                            <p class="text-sm text-gray-600 font-medium">Memerlukan Tindakan Segera</p>
                        </div>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Admin HRD Stats - 8 Cards Grid -->
                    <!-- Card 1: Total Karyawan -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-slate-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-100/60 to-slate-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-slate-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-green-600/80 bg-green-50/70 px-2.5 py-1.5 rounded-full border border-green-200/30 shadow-sm">+12%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">156</h3>
                            <p class="text-sm text-gray-600 font-medium">Total Karyawan Aktif </p>
                        </div>
                    </div>

                    <!-- Card 2: Hadir Hari Ini -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-green-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-green-600/80 bg-green-50/70 px-2.5 py-1.5 rounded-full border border-green-200/30 shadow-sm">92%</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">143</h3>
                            <p class="text-sm text-gray-600 font-medium">Hadir Hari Ini</p>
                        </div>
                    </div>

                    <!-- Card 3: Cuti Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-amber-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-amber-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-amber-600/80 bg-amber-50/70 px-2.5 py-1.5 rounded-full border border-amber-200/30 shadow-sm">Menunggu</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">8</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Cuti Pending</p>
                        </div>
                    </div>

                    <!-- Card 4: Lembur Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-orange-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-100/60 to-orange-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-orange-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-orange-600/80 bg-orange-50/70 px-2.5 py-1.5 rounded-full border border-orange-200/30 shadow-sm">Pending</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">5</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Lembur Pending</p>
                        </div>
                    </div>

                    <!-- Card 5: Surat Pending -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-red-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-red-600/80 bg-red-50/70 px-2.5 py-1.5 rounded-full border border-red-200/30 shadow-sm">Proses</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">3</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat dalam Proses</p>
                        </div>
                    </div>

                    <!-- Card 6: Disetujui -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-blue-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-blue-600/80 bg-blue-50/70 px-2.5 py-1.5 rounded-full border border-blue-200/30 shadow-sm">Approved</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">47</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Disetujui</p>
                        </div>
                    </div>

                    <!-- Card 7: Surat Siap -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-purple-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-100/60 to-purple-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-purple-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-purple-600/80 bg-purple-50/70 px-2.5 py-1.5 rounded-full border border-purple-200/30 shadow-sm">Siap</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">12</h3>
                            <p class="text-sm text-gray-600 font-medium">Surat Siap Dikirim</p>
                        </div>
                    </div>

                    <!-- Card 8: Ditolak/Revisi -->
                    <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-gray-100/40 hover:shadow-lg hover:border-rose-100/60 transition-all duration-300 hover:-translate-y-1">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-rose-600/80 bg-rose-50/70 px-2.5 py-1.5 rounded-full border border-rose-200/30 shadow-sm">Revisi</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-0.5">2</h3>
                            <p class="text-sm text-gray-600 font-medium">Pengajuan Perlu Revisi</p>
                        </div>
                    </div>
                @else
                    <!-- Karyawan Stats - Personal (Soft Modern Design) -->
                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-slate-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-slate-100 flex items-center justify-center">
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
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-gray-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-100 to-gray-100 flex items-center justify-center">
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
                        <div class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-orange-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-orange-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-full">Januari</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-1">16</h3>
                        <p class="text-sm text-gray-500 font-medium">Total Lembur Bulan Ini</p>
                    </div>

                    <div
                        class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-5 shadow-sm hover:shadow-md border border-gray-100/50 transition-all duration-300 hover:-translate-y-0.5">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-emerald-50/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
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
                @if (Auth::user()->role === 'direktur')
                    <!-- Charts Section - Direktur (2 kolom) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pengajuan Bulan Ini Chart - Normal Bar Chart with Tooltip -->
                        <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-rose-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan per Bulan (6 Bulan Terakhir)</h3>
                                <div class="flex items-end justify-between h-56 gap-3 mb-6 px-2 relative border-b-2 border-gray-200/50 pb-4">
                                    <!-- Agustus -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>80</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 80px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Agu</span>
                                    </div>
                                    <!-- September -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>95</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 95px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Sep</span>
                                    </div>
                                    <!-- Oktober -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>70</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 70px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Okt</span>
                                    </div>
                                    <!-- November -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>110</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 110px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Nov</span>
                                    </div>
                                    <!-- Desember -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>105</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 105px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Des</span>
                                    </div>
                                    <!-- Januari -->
                                    <div class="flex-1 flex flex-col items-center gap-2 group/bar relative">
                                        <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 bg-gradient-to-b from-rose-600/90 to-rose-500/80 text-white px-3 py-1.5 rounded-lg text-xs font-bold whitespace-nowrap opacity-0 group-hover/bar:opacity-100 transition-all duration-200 pointer-events-none shadow-lg z-10">
                                            <span>95</span>
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-rose-600"></div>
                                        </div>
                                        <div class="w-8 bg-gradient-to-t from-rose-400/60 to-rose-300/40 rounded-t-lg shadow-md group-hover/bar:shadow-lg group-hover/bar:from-rose-400/80 group-hover/bar:to-rose-300/60 transition-all duration-300 cursor-pointer" style="height: 75px;"></div>
                                        <span class="text-xs text-gray-600 font-medium">Jan</span>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                        <span class="text-lg font-bold bg-gradient-to-r from-rose-500 to-rose-400 bg-clip-text text-transparent">550 pengajuan</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lembur Per Divisi - Soft Gradient Progress Bars -->
                        <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Lembur per Divisi (Bulan Ini)</h3>
                                <div class="space-y-5">
                                    <div>
                                        <div class="flex items-center justify-between mb-2.5">
                                            <span class="text-sm font-medium text-gray-700">IT & Teknologi</span>
                                            <span class="text-sm font-bold bg-gradient-to-r from-orange-500 to-orange-400 bg-clip-text text-transparent">42 jam</span>
                                        </div>
                                        <div class="w-full bg-gradient-to-r from-gray-200/40 to-gray-100/30 rounded-full h-3 shadow-sm overflow-hidden">
                                            <div class="bg-gradient-to-r from-orange-400/80 to-orange-300/60 h-3 rounded-full shadow-md transition-all duration-300 hover:shadow-lg" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-2.5">
                                            <span class="text-sm font-medium text-gray-700">Finance</span>
                                            <span class="text-sm font-bold bg-gradient-to-r from-blue-500 to-blue-400 bg-clip-text text-transparent">35 jam</span>
                                        </div>
                                        <div class="w-full bg-gradient-to-r from-gray-200/40 to-gray-100/30 rounded-full h-3 shadow-sm overflow-hidden">
                                            <div class="bg-gradient-to-r from-blue-400/80 to-blue-300/60 h-3 rounded-full shadow-md transition-all duration-300 hover:shadow-lg" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center justify-between mb-2.5">
                                            <span class="text-sm font-medium text-gray-700">Operations</span>
                                            <span class="text-sm font-bold bg-gradient-to-r from-emerald-500 to-emerald-400 bg-clip-text text-transparent">31 jam</span>
                                        </div>
                                        <div class="w-full bg-gradient-to-r from-gray-200/40 to-gray-100/30 rounded-full h-3 shadow-sm overflow-hidden">
                                            <div class="bg-gradient-to-r from-emerald-400/80 to-emerald-300/60 h-3 rounded-full shadow-md transition-all duration-300 hover:shadow-lg" style="width: 44%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5 pt-4 border-t border-gray-100/30 flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Total Lembur</span>
                                    <span class="text-lg font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">150 jam</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan Donut - Soft Gradient Colors -->
                        <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan</h3>
                                <div class="flex items-center justify-center mb-6">
                                    <div class="relative w-48 h-48">
                                        <svg class="w-full h-full drop-shadow-sm" viewBox="0 0 140 140"
                                            style="transform: rotate(-90deg)">
                                            <!-- Approved (soft green) - 60/140 = 43% = 154.8° -->
                                            <circle cx="70" cy="70" r="55" fill="none" stroke="#10b981"
                                                stroke-width="22" stroke-dasharray="119.3 340.6"
                                                stroke-linecap="round" opacity="0.8" />
                                            <!-- Pending (soft amber) - 70/140 = 50% = 180° -->
                                            <circle cx="70" cy="70" r="55" fill="none" stroke="#f59e0b"
                                                stroke-width="22" stroke-dasharray="136 340.6" stroke-dashoffset="-119.3"
                                                stroke-linecap="round" opacity="0.8" />
                                            <!-- Rejected (soft red) - 10/140 = 7% = 25.2° -->
                                            <circle cx="70" cy="70" r="55" fill="none" stroke="#ef4444"
                                                stroke-width="22" stroke-dasharray="24.4 340.6"
                                                stroke-dashoffset="-255.3" stroke-linecap="round" opacity="0.8" />
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center">
                                                <div class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">140</div>
                                                <div class="text-xs text-gray-500">Total</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-green-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex-shrink-0 shadow-sm"></div>
                                            <span class="text-gray-600">Disetujui</span>
                                        </div>
                                        <span class="font-bold text-gray-800">60 (43%)</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-amber-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 flex-shrink-0 shadow-sm"></div>
                                            <span class="text-gray-600">Menunggu</span>
                                        </div>
                                        <span class="font-bold text-gray-800">70 (50%)</span>
                                    </div>
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gradient-to-r hover:from-red-50/40 hover:to-transparent transition-colors duration-300">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex-shrink-0 shadow-sm"></div>
                                            <span class="text-gray-600">Ditolak</span>
                                        </div>
                                        <span class="font-bold text-gray-800">10 (7%)</span>
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
                                    <span class="font-bold text-lg text-yellow-600">13</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Disetujui (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-green-600">60</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Ditolak (Bulan Ini)</span>
                                    </div>
                                    <span class="font-bold text-lg text-red-600">10</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-600 font-bold">Kehadiran Hari Ini</span>
                                    </div>
                                    <span class="font-bold text-lg text-slate-600">145/156</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Charts Section - Admin HRD -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Kehadiran per Divisi - Soft Gradient Vertical Bar Chart -->
                        <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Kehadiran per Divisi (Hari Ini)</h3>

                                <!-- Chart Container -->
                                <div class="flex gap-4 items-end border-l-2 border-b-2 border-gray-200/50 pl-4 pb-4 pt-2"
                                    style="height: 300px;">
                                    <!-- IT & Teknologi -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-slate-400/70 to-slate-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-slate-400/90 group-hover/bar:to-slate-300/70 transition-all duration-300" style="height: 160px;"></div>
                                        <div class="text-center">
                                            <p class="text-xs font-semibold text-gray-700 mb-0.5">IT & Teknologi</p>
                                            <p class="text-sm font-bold bg-gradient-to-r from-slate-500 to-slate-400 bg-clip-text text-transparent">18/20</p>
                                        </div>
                                    </div>

                                    <!-- Finance -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-green-400/70 to-green-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-green-400/90 group-hover/bar:to-green-300/70 transition-all duration-300" style="height: 230px;"></div>
                                        <div class="text-center">
                                            <p class="text-xs font-semibold text-gray-700 mb-0.5">Finance</p>
                                            <p class="text-sm font-bold bg-gradient-to-r from-green-500 to-green-400 bg-clip-text text-transparent">25/25</p>
                                        </div>
                                    </div>

                                    <!-- Operations -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-amber-400/70 to-amber-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-amber-400/90 group-hover/bar:to-amber-300/70 transition-all duration-300" style="height: 170px;"></div>
                                        <div class="text-center">
                                            <p class="text-xs font-semibold text-gray-700 mb-0.5">Operations</p>
                                            <p class="text-sm font-bold bg-gradient-to-r from-amber-500 to-amber-400 bg-clip-text text-transparent">38/45</p>
                                        </div>
                                    </div>

                                    <!-- Marketing -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-indigo-400/70 to-indigo-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-indigo-400/90 group-hover/bar:to-indigo-300/70 transition-all duration-300" style="height: 190px;"></div>
                                        <div class="text-center">
                                            <p class="text-xs font-semibold text-gray-700 mb-0.5">Marketing</p>
                                            <p class="text-sm font-bold bg-gradient-to-r from-indigo-500 to-indigo-400 bg-clip-text text-transparent">28/30</p>
                                        </div>
                                    </div>

                                    <!-- HRD -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-cyan-400/70 to-cyan-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-cyan-400/90 group-hover/bar:to-cyan-300/70 transition-all duration-300" style="height: 230px;"></div>
                                        <div class="text-center">
                                            <p class="text-xs font-semibold text-gray-700 mb-0.5">HRD</p>
                                            <p class="text-sm font-bold bg-gradient-to-r from-cyan-500 to-cyan-400 bg-clip-text text-transparent">10/10</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-100/30 flex items-center justify-between mt-4">
                                    <span class="text-sm font-medium text-gray-600">Total Kehadiran Hari Ini</span>
                                    <span class="text-lg font-bold bg-gradient-to-r from-green-500 to-green-400 bg-clip-text text-transparent">143/156 (92%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pengajuan Masuk - Soft Gradient Chart -->
                        <div class="group relative overflow-hidden bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 hover:shadow-lg transition-all duration-300 p-6">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative">
                                <h3 class="text-lg font-semibold text-gray-800 mb-6">Pengajuan Masuk (6 Bulan Terakhir)</h3>

                                <!-- Chart Container -->
                                <div class="flex gap-3 items-end border-b-2 border-gray-200/50 pb-4" style="height: 240px;">
                                    <!-- Agustus -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-blue-400/70 to-blue-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-blue-400/90 group-hover/bar:to-blue-300/70 transition-all duration-300" style="height: 140px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Agu</span>
                                    </div>

                                    <!-- September -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-blue-400/70 to-blue-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-blue-400/90 group-hover/bar:to-blue-300/70 transition-all duration-300" style="height: 170px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Sep</span>
                                    </div>

                                    <!-- Oktober -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-blue-400/70 to-blue-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-blue-400/90 group-hover/bar:to-blue-300/70 transition-all duration-300" style="height: 120px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Okt</span>
                                    </div>

                                    <!-- November -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-blue-400/70 to-blue-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-blue-400/90 group-hover/bar:to-blue-300/70 transition-all duration-300" style="height: 190px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Nov</span>
                                    </div>

                                    <!-- Desember -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-blue-400/70 to-blue-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-blue-400/90 group-hover/bar:to-blue-300/70 transition-all duration-300" style="height: 210px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Des</span>
                                    </div>

                                    <!-- Januari -->
                                    <div class="flex-1 flex flex-col items-center justify-end gap-2 group/bar">
                                        <div class="w-full bg-gradient-to-t from-indigo-400/70 to-indigo-300/50 rounded-t-xl shadow-md group-hover/bar:shadow-lg group-hover/bar:from-indigo-400/90 group-hover/bar:to-indigo-300/70 transition-all duration-300" style="height: 150px;"></div>
                                        <span class="text-xs text-gray-700 font-medium mt-1.5">Jan</span>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-100/30 flex items-center justify-between mt-4">
                                    <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                    <span class="text-lg font-bold bg-gradient-to-r from-indigo-600 to-indigo-500 bg-clip-text text-transparent">342 pengajuan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Admin HRD Summary -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan - Pie Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Pengajuan</h3>
                            <div class="flex items-center gap-6 mb-2">
                                <!-- Pie (Chart.js canvas) -->
                                <div class="relative w-40 h-40 flex items-center justify-center">
                                    <canvas id="statusPie" width="160" height="160" class="w-40 h-40"></canvas>
                                    <!-- Smaller center chip so it doesn't cover the doughnut -->
                                    <div id="statusTotal"
                                        class="absolute inset-0 m-auto flex flex-col items-center justify-center z-10 pointer-events-none">
                                        <div class="bg-white rounded-full px-3 py-2 shadow-sm text-center">
                                            <div class="text-lg font-bold text-gray-800 leading-none">89</div>
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
                                        <div id="countApproved" class="text-sm font-bold text-gray-800">45</div>
                                    </div>

                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-yellow-600"></div>
                                            <span class="text-sm text-gray-700">Menunggu</span>
                                        </div>
                                        <div id="countPending" class="text-sm font-bold text-gray-800">36</div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full bg-red-600"></div>
                                            <span class="text-sm text-gray-700">Ditolak</span>
                                        </div>
                                        <div id="countRejected" class="text-sm font-bold text-gray-800">8</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart.js Script (CDN) -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                (function() {
                                    const approved = 45;
                                    const pending = 36;
                                    const rejected = 8;
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
                                    <span class="font-bold text-lg text-yellow-600">5</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Sedang Diproses</span>
                                    <span class="font-bold text-lg text-blue-600">3</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-sm text-gray-600">Siap Dikirim</span>
                                    <span class="font-bold text-lg text-purple-600">8</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Dikirim Bulan Ini</span>
                                    <span class="font-bold text-lg text-green-600">24</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Charts Section - Karyawan (Personal) - Soft Modern Design -->
                    <div class="lg:col-span-2 space-y-5">
                        <!-- Personal Attendance Chart - Monthly with Dummy Data -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="text-base font-semibold text-gray-800">Kehadiran Saya - Januari 2026</h3>
                                <span class="text-xs font-medium text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full">20 / 22 Hari</span>
                            </div>
                            <div class="h-48 flex items-end justify-between gap-1 px-1 overflow-x-auto">
                                <!-- Data dummy untuk 22 hari kerja -->
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-red-600 rounded-t-lg transition-all duration-300 hover:bg-red-700" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">1</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-red-600 rounded-t-lg transition-all duration-300 hover:bg-red-700" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">2</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-slate-400 rounded-t-lg transition-all duration-300 hover:bg-slate-500" style="height: 5%; min-height: 4px;" title="Tidak Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">3</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-red-600 rounded-t-lg transition-all duration-300 hover:bg-red-700" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">4</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">5</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">6</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">7</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-yellow-400/70 to-yellow-300/50 rounded-t-lg transition-all duration-300 hover:from-yellow-500 hover:to-yellow-400" style="height: 50%;" title="Setengah Hari"></div>
                                    <span class="text-xs text-gray-600 font-medium">8</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">9</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">10</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">11</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">12</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">13</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">14</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">15</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">16</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">17</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">18</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">19</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">20</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">21</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-1.5 min-w-[20px]">
                                    <div class="w-full bg-gradient-to-t from-pink-400/80 to-pink-300/60 rounded-t-lg transition-all duration-300 hover:from-pink-500 hover:to-pink-400" style="height: 100%;" title="Hadir"></div>
                                    <span class="text-xs text-gray-600 font-medium">22</span>
                                </div>
                            </div>
                            <div class="mt-5 grid grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Hadir</p>
                                    <p class="font-semibold text-lg text-red-600">20</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Tidak Hadir</p>
                                    <p class="font-semibold text-lg text-slate-600">1</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-500 mb-1 text-xs font-medium">Setengah Hari</p>
                                    <p class="font-semibold text-lg text-yellow-600">1</p>
                                </div>
                            </div>
                        </div>

                        <!-- Pengajuan Cuti Chart - 6 Bulan Terakhir -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-6">
                            <h3 class="text-base font-semibold text-gray-800 mb-6">Pengajuan Cuti Saya - 6 Bulan Terakhir</h3>
                            <!-- Chart dengan Grid Lines dan Layout Lebih Besar -->
                            <div class="space-y-4">
                                <!-- Y-axis scale labels -->
                                <div class="flex gap-6">
                                    <div class="w-12 flex flex-col justify-between text-right pr-2" style="height: 280px;">
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
                                            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
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
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 75%; max-width: 80px; margin: 0 auto;" title="3 hari">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">3</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 50%; max-width: 80px; margin: 0 auto;" title="2 hari">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">2</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 100%; max-width: 80px; margin: 0 auto;" title="4 hari">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">4</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-600 hover:bg-red-700 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 25%; max-width: 80px; margin: 0 auto; min-height: 12px;" title="1 hari">
                                                        <div class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">1</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-gray-400 hover:bg-gray-500 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 5%; max-width: 80px; margin: 0 auto; min-height: 8px;" title="0 hari"></div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-red-700 hover:bg-red-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 50%; max-width: 80px; margin: 0 auto;" title="2 hari">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
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
                                    <div class="w-12 flex flex-col justify-between text-right pr-2" style="height: 280px;">
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
                                            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
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
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 85.7%; max-width: 80px; margin: 0 auto;" title="12 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">12h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Agu</span>
                                                </div>
                                                <!-- September -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 57%; max-width: 80px; margin: 0 auto;" title="8 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">8h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Sep</span>
                                                </div>
                                                <!-- Oktober -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 71%; max-width: 80px; margin: 0 auto;" title="10 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">10h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Okt</span>
                                                </div>
                                                <!-- November -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 42.8%; max-width: 80px; margin: 0 auto; min-height: 12px;" title="6 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">6h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Nov</span>
                                                </div>
                                                <!-- Desember -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-700 hover:bg-slate-800 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 100%; max-width: 80px; margin: 0 auto;" title="14 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                            <span class="text-xs font-bold text-white">14h</span>
                                                        </div>
                                                    </div>
                                                    <span class="text-xs text-gray-600 font-medium mt-2">Des</span>
                                                </div>
                                                <!-- Januari -->
                                                <div class="flex-1 flex flex-col items-center group">
                                                    <div class="w-full bg-slate-800 hover:bg-slate-900 rounded-t-lg transition-all duration-300 shadow-md hover:shadow-lg cursor-pointer" style="height: 114%; max-width: 80px; margin: 0 auto;" title="16 jam">
                                                        <div class="w-full h-full flex items-start justify-center pt-1 opacity-0 group-hover:opacity-100 transition-opacity">
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
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                                        <!-- Disetujui (60% = 188.5 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981" stroke-width="12" 
                                            stroke-dasharray="188.5 314.16" stroke-dashoffset="0" stroke-linecap="round"/>
                                        <!-- Menunggu (25% = 78.54 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b" stroke-width="12" 
                                            stroke-dasharray="78.54 314.16" stroke-dashoffset="-188.5" stroke-linecap="round"/>
                                        <!-- Ditolak (15% = 47.12 dari 314.16) -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#ef4444" stroke-width="12" 
                                            stroke-dasharray="47.12 314.16" stroke-dashoffset="-267.04" stroke-linecap="round"/>
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
                                        <div class="bg-gradient-to-r from-red-500 to-red-600 h-2 rounded-full transition-all duration-500" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Cuti Sakit</span>
                                        <span class="text-sm font-semibold text-slate-600">Tidak Terbatas</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-slate-500 to-slate-600 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
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
                                <a href="{{ route('karyawan.pengajuan-cuti') }}" class="block w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Cuti
                                </a>
                                <a href="{{ route('karyawan.pengajuan-lembur') }}" class="block w-full bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Ajukan Lembur
                                </a>
                                <a href="{{ route('karyawan.surat') }}" class="block w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium text-sm py-2.5 px-4 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 text-center">
                                    Surat Saya
                                </a>
                            </div>
                        </div>

                        <!-- Pengajuan Pending -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 p-5">
                            <h3 class="text-sm font-semibold text-gray-800 mb-4">Pengajuan Menunggu</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-red-50/50 rounded-lg border border-red-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Cuti Tahunan</p>
                                            <p class="text-xs text-gray-500">2 hari - 15-16 Jan</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-0.5 rounded-full">Pending</span>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-slate-50/50 rounded-lg border border-slate-100/50">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-slate-500"></div>
                                        <div>
                                            <p class="text-xs font-medium text-gray-800">Lembur</p>
                                            <p class="text-xs text-gray-500">5 jam - 12 Jan</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-medium text-slate-600 bg-slate-100 px-2 py-0.5 rounded-full">Review</span>
                                </div>
                            </div>
                            <a href="{{ route('karyawan.riwayat') }}" class="mt-3 block text-center text-xs font-medium text-slate-600 hover:text-slate-700">
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
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Kehadiran</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">90.9%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Total Lembur</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">16 jam</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Cuti Digunakan</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">2 hari</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-medium text-gray-600">Surat Terbit</span>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-800">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Notifikasi Penting -->
                        <div class="bg-gradient-to-br from-red-50/50 to-slate-50/30 rounded-xl shadow-sm border border-red-100/50 p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <h3 class="text-sm font-semibold text-gray-800">Pemberitahuan</h3>
                            </div>
                            <div class="space-y-2">
                                <div class="text-xs text-gray-600 leading-relaxed">
                                    <p class="font-medium text-gray-800 mb-1">• Slip gaji Desember tersedia</p>
                                    <p class="text-gray-500">Silakan unduh di menu Surat Saya</p>
                                </div>
                                <div class="text-xs text-gray-600 leading-relaxed pt-2 border-t border-red-100/50">
                                    <p class="font-medium text-gray-800 mb-1">• Evaluasi kinerja Q4</p>
                                    <p class="text-gray-500">Jadwal: 20 Januari 2026</p>
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
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
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
                                                <p class="text-sm font-semibold text-gray-800">{{ $surat->user->name }}
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
                                return res.ok ? res.json() : Promise.reject(await res.json());
                            }

                            async function del(url) {
                                const res = await fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrf,
                                        'Accept': 'application/json'
                                    }
                                });
                                return res.ok ? res.json() : Promise.reject(await res.json());
                            }

                            // delegate click events on list
                            list && list.addEventListener('click', function(e) {
                                const btn = e.target.closest('[data-action]');
                                if (!btn) return;
                                const action = btn.getAttribute('data-action');
                                const item = btn.closest('[data-id]');
                                if (!item) return;
                                const id = item.getAttribute('data-id');

                                if (action === 'approve') {
                                    if (!confirm('Setujui surat ini?')) return;
                                    post(`/admin/surat/${id}/approve`).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menyetujui'));
                                }

                                if (action === 'reject') {
                                    const reason = prompt('Alasan penolakan (wajib):');
                                    if (!reason) return alert('Alasan dibutuhkan');
                                    post(`/admin/surat/${id}/reject`, {
                                        keterangan: reason
                                    }).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menolak'));
                                }

                                if (action === 'delete') {
                                    if (!confirm('Hapus surat ini?')) return;
                                    del(`/admin/surat/${id}`).then(() => {
                                        item.remove();
                                        setCount(-1);
                                    }).catch(() => alert('Gagal menghapus'));
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
                            <a href="{{ route('admin.karyawan') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-700">Kelola Karyawan →</a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Activities -->
                <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="px-6 py-4 border-b border-gray-100/50 bg-gradient-to-r from-pink-50/30 via-purple-50/30 to-orange-50/20">
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h3>
                            <span class="text-xs font-medium text-gray-500 bg-white/60 px-2 py-1 rounded-full">5 aktivitas</span>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100/50">
                        @if (Auth::user()->role === 'direktur')
                            <!-- Direktur Activities - Approval & Request Focus -->
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan lembur Rina Wijaya
                                            disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">4 jam lembur - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti Ahmad Rizki
                                            menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - mulai 10 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Pengajuan cuti ditolak - Bentrok
                                            shift</p>
                                        <p class="text-xs text-gray-500 mb-2">Budi Santoso - 5 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Laporan kehadiran Desember
                                            tersedia</p>
                                        <p class="text-xs text-gray-500 mb-2">Tingkat kehadiran: 94.2% dari 156 karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">3 surat untuk keperluan karyawan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->role === 'admin_hrd')
                            <!-- Admin HRD Activities -->
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-100 to-green-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat Keterangan Kerja diterbitkan
                                        </p>
                                        <p class="text-xs text-gray-500 mb-2">Ahmad Rizki - Keperluan Bank</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            30 menit lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Karyawan baru ditambahkan</p>
                                        <p class="text-xs text-gray-500 mb-2">Rina Wijaya - IT & Teknologi</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            2 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
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
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            3 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Data karyawan diperbarui</p>
                                        <p class="text-xs text-gray-500 mb-2">Dani Hermawan - Perubahan jabatan</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Kemarin
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Kontrak hampir berakhir</p>
                                        <p class="text-xs text-gray-500 mb-2">2 karyawan - Perlu diperpanjang</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Karyawan Activities - Soft Modern Design -->
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-pink-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-100 to-pink-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Cuti Anda disetujui</p>
                                        <p class="text-xs text-gray-500 mb-2">Cuti tahunan 3 hari - Mulai 10 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            2 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-yellow-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-100 to-orange-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Lembur menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500 mb-2">Lembur 5 jam - 7 Jan 2026</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            1 jam lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Surat sudah terbit</p>
                                        <p class="text-xs text-gray-500 mb-2">Surat Keterangan Kerja - Siap diunduh</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            1 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-orange-100 to-yellow-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
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
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            3 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-5 hover:bg-gradient-to-r hover:from-purple-50/30 hover:to-transparent transition-all duration-300 group">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-800 mb-1">Slip gaji tersedia</p>
                                        <p class="text-xs text-gray-500 mb-2">Slip gaji Desember - Siap diunduh</p>
                                        <span class="inline-flex items-center text-xs text-gray-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            5 hari lalu
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                @if (Auth::user()->role !== 'karyawan')
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-100/50 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100/50 bg-gradient-to-r from-purple-50/30 to-pink-50/30">
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
                                            <p class="text-xs text-gray-600">13 pengajuan menunggu</p>
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
                @endif
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
