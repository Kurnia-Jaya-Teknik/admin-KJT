<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 rounded-2xl p-8 mb-8 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-indigo-100 text-sm">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if(Auth::user()->role === 'direktur')
                    <!-- Direktur Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Total</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                        <p class="text-sm text-gray-500">Total Karyawan</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">94%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">94%</h3>
                        <p class="text-sm text-gray-500">Kehadiran Bulan Ini</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">7</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">7</h3>
                        <p class="text-sm text-gray-500">Menunggu Persetujuan</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">23</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">23</h3>
                        <p class="text-sm text-gray-500">Surat Diterbitkan</p>
                    </div>
                @elseif(Auth::user()->role === 'admin_hrd')
                    <!-- Admin HRD Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">+12%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                        <p class="text-sm text-gray-500">Total Karyawan</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">92%</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">143</h3>
                        <p class="text-sm text-gray-500">Hadir Hari Ini</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-1 rounded-full">Approved</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">24</h3>
                        <p class="text-sm text-gray-500">Pengajuan Disetujui</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Draft</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500">Surat Siap Dikirim</p>
                    </div>
                @else
                    <!-- Karyawan Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Hadir</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">Hadir</h3>
                        <p class="text-sm text-gray-500">Status Absensi Hari Ini</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-1 rounded-full">2026</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">12 Hari</h3>
                        <p class="text-sm text-gray-500">Sisa Cuti Tahun Ini</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">6</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">6</h3>
                        <p class="text-sm text-gray-500">Pengajuan Disetujui</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">PKWTT</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">PKWTT</h3>
                        <p class="text-sm text-gray-500">Status Kontrak Kerja</p>
                    </div>
                @endif
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                @if(Auth::user()->role === 'direktur')
                    <!-- Charts Section - Direktur -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Attendance Trend Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tren Kehadiran Karyawan</h3>
                            <div class="h-64 flex items-end justify-center gap-2 px-2">
                                <div class="w-full h-full flex flex-col items-end justify-end">
                                    <svg class="w-full h-full" viewBox="0 0 500 250" preserveAspectRatio="none">
                                        <polyline points="10,150 70,120 130,140 190,100 250,130 310,90 370,110 430,80 490,100" stroke="#3b82f6" stroke-width="3" fill="none" stroke-linejoin="round" stroke-linecap="round"/>
                                        <circle cx="10" cy="150" r="4" fill="#3b82f6"/>
                                        <circle cx="70" cy="120" r="4" fill="#3b82f6"/>
                                        <circle cx="130" cy="140" r="4" fill="#3b82f6"/>
                                        <circle cx="190" cy="100" r="4" fill="#3b82f6"/>
                                        <circle cx="250" cy="130" r="4" fill="#3b82f6"/>
                                        <circle cx="310" cy="90" r="4" fill="#3b82f6"/>
                                        <circle cx="370" cy="110" r="4" fill="#3b82f6"/>
                                        <circle cx="430" cy="80" r="4" fill="#3b82f6"/>
                                        <circle cx="490" cy="100" r="4" fill="#3b82f6"/>
                                        <line x1="10" y1="200" x2="490" y2="200" stroke="#e5e7eb" stroke-width="1"/>
                                        <text x="10" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Jan</text>
                                        <text x="70" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Feb</text>
                                        <text x="130" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Mar</text>
                                        <text x="190" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Apr</text>
                                        <text x="250" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Mei</text>
                                        <text x="310" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Jun</text>
                                        <text x="370" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Jul</text>
                                        <text x="430" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Agu</text>
                                        <text x="490" y="225" font-size="12" fill="#6b7280" text-anchor="middle">Sep</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-center gap-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                                    <span class="text-gray-600">Kehadiran (%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Cuti & Lembur Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Cuti & Lembur Per Bulan</h3>
                            <div class="h-64 flex items-end justify-center gap-3 px-2">
                                <div class="w-full h-full flex items-end justify-around">
                                    <div class="flex flex-col items-center gap-1 w-12">
                                        <div class="w-5 bg-amber-500 rounded-t" style="height: 120px;"></div>
                                        <div class="w-5 bg-blue-500 rounded-t" style="height: 80px;"></div>
                                        <span class="text-xs text-gray-500 mt-2">Jan</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1 w-12">
                                        <div class="w-5 bg-amber-500 rounded-t" style="height: 140px;"></div>
                                        <div class="w-5 bg-blue-500 rounded-t" style="height: 90px;"></div>
                                        <span class="text-xs text-gray-500 mt-2">Feb</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1 w-12">
                                        <div class="w-5 bg-amber-500 rounded-t" style="height: 100px;"></div>
                                        <div class="w-5 bg-blue-500 rounded-t" style="height: 110px;"></div>
                                        <span class="text-xs text-gray-500 mt-2">Mar</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1 w-12">
                                        <div class="w-5 bg-amber-500 rounded-t" style="height: 160px;"></div>
                                        <div class="w-5 bg-blue-500 rounded-t" style="height: 70px;"></div>
                                        <span class="text-xs text-gray-500 mt-2">Apr</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-1 w-12">
                                        <div class="w-5 bg-amber-500 rounded-t" style="height: 130px;"></div>
                                        <div class="w-5 bg-blue-500 rounded-t" style="height: 95px;"></div>
                                        <span class="text-xs text-gray-500 mt-2">Mei</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-center gap-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded bg-amber-500"></div>
                                    <span class="text-gray-600">Cuti</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded bg-blue-500"></div>
                                    <span class="text-gray-600">Lembur</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Column 2 - Direktur -->
                    <div class="space-y-6">
                        <!-- Employee Status Donut -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Karyawan</h3>
                            <div class="h-48 flex items-center justify-center relative">
                                <svg class="w-40 h-40" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#3b82f6" stroke-width="12" stroke-dasharray="78.5 314" transform="rotate(-90 60 60)"/>
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b" stroke-width="12" stroke-dasharray="62.8 314" stroke-dashoffset="-78.5" transform="rotate(-90 60 60)"/>
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#8b5cf6" stroke-width="12" stroke-dasharray="47.1 314" stroke-dashoffset="-141.3" transform="rotate(-90 60 60)"/>
                                    <text x="60" y="65" text-anchor="middle" font-size="20" font-weight="bold" fill="#1f2937">156</text>
                                </svg>
                            </div>
                            <div class="mt-4 space-y-2 text-sm">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        <span class="text-gray-600">PKWTT</span>
                                    </div>
                                    <span class="font-medium text-gray-800">100</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                        <span class="text-gray-600">PKWT</span>
                                    </div>
                                    <span class="font-medium text-gray-800">40</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                        <span class="text-gray-600">Magang</span>
                                    </div>
                                    <span class="font-medium text-gray-800">16</span>
                                </div>
                            </div>
                        </div>

                        <!-- Letters Type Distribution -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Jenis Surat Terbit</h3>
                            <div class="space-y-3">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Surat Rekomendasi</span>
                                        <span class="text-sm font-semibold text-gray-800">8</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 35%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Surat Keterangan</span>
                                        <span class="text-sm font-semibold text-gray-800">7</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-green-500 h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Surat Tanggung Jawab</span>
                                        <span class="text-sm font-semibold text-gray-800">5</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-amber-500 h-2 rounded-full" style="width: 22%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700">Surat Lainnya</span>
                                        <span class="text-sm font-semibold text-gray-800">3</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-purple-500 h-2 rounded-full" style="width: 13%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pending Approvals Table - Direktur -->
            @if(Auth::user()->role === 'direktur')
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Pengajuan Menunggu Persetujuan</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Jenis Pengajuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Durasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Ajuan</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">Ahmad Rizki</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">3 hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">5 Jan 2026</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">Siti Nurhaliza</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">5 jam</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">5 Jan 2026</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">Budi Santoso</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Sakit</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">2 hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">Rina Wijaya</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">4 jam</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">Dani Hermawan</td>
                                    <td class="px-6 py-4 text-sm text-gray-600"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                    <td class="px-6 py-4 text-sm text-gray-600">5 hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                            <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Activities -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @if(Auth::user()->role === 'direktur')
                            <!-- Direktur Activities -->
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan cuti Ahmad Rizki menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500">Cuti tahunan - 3 hari mulai 10 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400">5 menit lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Surat Rekomendasi ditolak</p>
                                        <p class="text-xs text-gray-500">Surat untuk Siti Nurhaliza - Keterangan revisi diperlukan</p>
                                    </div>
                                    <span class="text-xs text-gray-400">1 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan lembur Rina Wijaya disetujui</p>
                                        <p class="text-xs text-gray-500">Lembur 4 jam pada 7 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400">3 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Laporan kehadiran bulan Desember tersedia</p>
                                        <p class="text-xs text-gray-500">Tingkat kehadiran: 94.2% dari 156 karyawan</p>
                                    </div>
                                    <span class="text-xs text-gray-400">Kemarin</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja diterbitkan</p>
                                        <p class="text-xs text-gray-500">3 surat terbit untuk keperluan karyawan</p>
                                    </div>
                                    <span class="text-xs text-gray-400">2 hari lalu</span>
                                </div>
                            </div>
                        @else
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Ahmad Rizki mengajukan cuti</p>
                                        <p class="text-xs text-gray-500">Cuti tahunan - 3 hari</p>
                                    </div>
                                    <span class="text-xs text-gray-400">2 menit lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Karyawan baru ditambahkan</p>
                                        <p class="text-xs text-gray-500">Siti Nurhaliza - Divisi Marketing</p>
                                    </div>
                                    <span class="text-xs text-gray-400">1 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Laporan absensi digenerate</p>
                                        <p class="text-xs text-gray-500">Periode Desember 2025</p>
                                    </div>
                                    <span class="text-xs text-gray-400">3 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Gaji bulan Desember diproses</p>
                                        <p class="text-xs text-gray-500">156 karyawan</p>
                                    </div>
                                    <span class="text-xs text-gray-400">Kemarin</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions & Info -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            @if(Auth::user()->role === 'direktur')
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Lihat Pengajuan Cuti</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Lihat Pengajuan Lembur</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-red-50 to-orange-50 hover:from-red-100 hover:to-orange-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-red-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Surat Menunggu</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Laporan Bulanan</span>
                                </button>
                            @else
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Tambah Karyawan</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Rekap Absensi</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Kelola Cuti</span>
                                </button>
                                <button class="flex flex-col items-center justify-center p-4 rounded-xl bg-gradient-to-br from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-200 group">
                                    <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">Proses Gaji</span>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Agenda Mendatang</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-indigo-500 mt-2"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Meeting Tim HRD</p>
                                    <p class="text-xs text-gray-500">Hari ini, 14:00 WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-green-500 mt-2"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Evaluasi Kinerja Q4</p>
                                    <p class="text-xs text-gray-500">Besok, 09:00 WIB</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full bg-amber-500 mt-2"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Training Karyawan Baru</p>
                                    <p class="text-xs text-gray-500">10 Jan 2026, 10:00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Toggle (for responsive) -->
    <div class="lg:hidden fixed bottom-6 right-6">
        <button class="w-14 h-14 bg-indigo-600 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-indigo-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</x-app-layout>