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
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Aktif</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                        <p class="text-sm text-gray-500">Total Karyawan Aktif</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-amber-600 bg-amber-100 px-2 py-1 rounded-full">Pending</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500">Cuti Menunggu Approval</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Pending</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">5</h3>
                        <p class="text-sm text-gray-500">Lembur Menunggu Approval</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Proses</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">3</h3>
                        <p class="text-sm text-gray-500">Surat Menunggu Proses</p>
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
                    <!-- Karyawan Stats - Personal -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Tersisa</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">12</h3>
                        <p class="text-sm text-gray-500">Sisa Cuti Tahun Ini (hari)</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Digunakan</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">8</h3>
                        <p class="text-sm text-gray-500">Cuti Dipakai Tahun 2026 (hari)</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-purple-600 bg-purple-100 px-2 py-1 rounded-full">Jan 2026</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">16</h3>
                        <p class="text-sm text-gray-500">Total Lembur Januari (jam)</p>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Disetujui</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">Disetujui</h3>
                        <p class="text-sm text-gray-500">Status Pengajuan Terakhir</p>
                    </div>
                @endif
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                @if(Auth::user()->role === 'direktur')
                    <!-- Charts Section - Direktur (2 kolom) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Attendance Trend Chart - 12 Months -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Tren Kehadiran Perusahaan - 12 Bulan</h3>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">↑ 2%</span>
                            </div>
                            <div class="h-72 flex items-end justify-between gap-2 px-1">
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 180px;" title="92%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Jan</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 195px;" title="93%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Feb</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 185px;" title="92%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Mar</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 205px;" title="95%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Apr</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 190px;" title="93%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Mei</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 200px;" title="94%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Jun</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 188px;" title="92%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Jul</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 198px;" title="94%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Agu</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 192px;" title="93%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Sep</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 207px;" title="95%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Okt</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 200px;" title="94%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Nov</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-blue-500 rounded-t-lg" style="height: 210px;" title="96%"></div>
                                    <span class="text-xs text-gray-600 font-medium">Des</span>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-4 pt-4 border-t border-gray-100 text-xs">
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Rata-rata</p>
                                    <p class="font-bold text-lg text-blue-600">93.6%</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Tertinggi</p>
                                    <p class="font-bold text-lg text-green-600">96% (Des)</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Terendah</p>
                                    <p class="font-bold text-lg text-orange-600">92% (Jan)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Overtime by Division Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Rekapitulasi Lembur Per Divisi (Bulan Ini)</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">IT & Teknologi</span>
                                        <span class="text-sm font-semibold text-gray-800">42 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-blue-500 h-3 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Marketing & Sales</span>
                                        <span class="text-sm font-semibold text-gray-800">28 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-purple-500 h-3 rounded-full" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Finance & Accounting</span>
                                        <span class="text-sm font-semibold text-gray-800">35 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Operations</span>
                                        <span class="text-sm font-semibold text-gray-800">31 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-amber-500 h-3 rounded-full" style="width: 44%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">HR & Admin</span>
                                        <span class="text-sm font-semibold text-gray-800">14 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-red-500 h-3 rounded-full" style="width: 20%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Total Lembur Bulan Ini</span>
                                <span class="text-lg font-bold text-gray-800">150 jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Request Status Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan (TTD)</h3>
                            <div class="flex items-center justify-center mb-6">
                                <div class="relative w-48 h-48">
                                    <svg class="w-full h-full" viewBox="0 0 120 120">
                                        <!-- Background circle -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#e5e7eb" stroke-width="14"/>
                                        <!-- Approved (green) - 60 pengajuan dari 140 = ~43% -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981" stroke-width="14" stroke-dasharray="67.5 314" transform="rotate(-90 60 60)"/>
                                        <!-- Pending (amber) - 70 pengajuan dari 140 = ~50% -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b" stroke-width="14" stroke-dasharray="78.5 314" stroke-dashoffset="-67.5" transform="rotate(-90 60 60)"/>
                                        <!-- Rejected (red) - 10 pengajuan dari 140 = ~7% -->
                                        <circle cx="60" cy="60" r="50" fill="none" stroke="#ef4444" stroke-width="14" stroke-dasharray="11 314" stroke-dashoffset="-146" transform="rotate(-90 60 60)"/>
                                        <text x="60" y="68" text-anchor="middle" font-size="18" font-weight="bold" fill="#1f2937">140</text>
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                        <span class="text-gray-600">Disetujui</span>
                                    </div>
                                    <span class="font-bold text-gray-800">60</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                        <span class="text-gray-600">Menunggu</span>
                                    </div>
                                    <span class="font-bold text-gray-800">70</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                        <span class="text-gray-600">Ditolak</span>
                                    </div>
                                    <span class="font-bold text-gray-800">10</span>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Stats -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Bulan Ini</h3>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Kehadiran Rata-rata</span>
                                    <span class="font-bold text-lg text-blue-600">93.6%</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Total Cuti Terpakai</span>
                                    <span class="font-bold text-lg text-amber-600">24 hari</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Total Lembur</span>
                                    <span class="font-bold text-lg text-purple-600">150 jam</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Surat Diproses</span>
                                    <span class="font-bold text-lg text-red-600">3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Charts Section - Karyawan (Personal) -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Personal Attendance Chart - Monthly -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Kehadiran Saya - Januari 2026</h3>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">22 / 22 Hari</span>
                            </div>
                            <div class="h-56 flex items-end justify-between gap-1 px-1">
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">1</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">2</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-red-500 rounded-t-lg" style="height: 0%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">3</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">6</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">7</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-amber-500 rounded-t-lg" style="height: 50%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">8</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">9</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">10</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">13</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">14</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">15</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-green-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">16</span>
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-3 gap-4 pt-4 border-t border-gray-100 text-xs">
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Hadir</p>
                                    <p class="font-bold text-lg text-green-600">20</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Alfa/Izin</p>
                                    <p class="font-bold text-lg text-red-600">1</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-600 mb-1">Setengah Hari</p>
                                    <p class="font-bold text-lg text-amber-600">1</p>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Overtime Chart -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Lembur Saya - 6 Bulan Terakhir</h3>
                            <div class="h-48 flex items-end justify-between gap-4 px-2">
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-500 rounded-t-lg" style="height: 90%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Agustus</span>
                                    <span class="text-xs font-bold text-gray-800">12 jam</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-500 rounded-t-lg" style="height: 65%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">September</span>
                                    <span class="text-xs font-bold text-gray-800">8 jam</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-500 rounded-t-lg" style="height: 78%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Oktober</span>
                                    <span class="text-xs font-bold text-gray-800">10 jam</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-500 rounded-t-lg" style="height: 52%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">November</span>
                                    <span class="text-xs font-bold text-gray-800">6 jam</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-500 rounded-t-lg" style="height: 100%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Desember</span>
                                    <span class="text-xs font-bold text-gray-800">14 jam</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-purple-400 rounded-t-lg" style="height: 57%;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Januari</span>
                                    <span class="text-xs font-bold text-gray-800">16 jam</span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Total 6 Bulan Terakhir</span>
                                <span class="text-lg font-bold text-gray-800">66 jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Karyawan (Personal) -->
                    <div class="space-y-6">
                        <!-- Cuti Balance Quick View -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Saldo Cuti Saya</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Cuti Tahunan</span>
                                        <span class="text-sm font-bold text-green-600">12 / 20 hari</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-green-500 h-3 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Cuti Sakit</span>
                                        <span class="text-sm font-bold text-blue-600">Unlimited</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-3">
                                        <div class="bg-blue-500 h-3 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Summary -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Info Saya</h3>
                            <div class="space-y-4 text-sm">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Departemen</span>
                                    <span class="font-semibold text-gray-800">IT & Teknologi</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Status Kontrak</span>
                                    <span class="font-semibold text-gray-800">PKWTT</span>
                                </div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Kehadiran Bulan Ini</span>
                                    <span class="font-bold text-green-600">100%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Pengajuan Pending</span>
                                    <span class="font-bold text-amber-600">1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Updates -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-sm border border-blue-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Terbaru</h3>
                            <div class="space-y-3">
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mt-1.5 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-xs font-medium text-gray-800">Surat terbit</p>
                                        <p class="text-xs text-gray-600">Surat Keterangan Kerja</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-green-500 mt-1.5 flex-shrink-0"></div>
                                    <div class="flex-1">
                                        <p class="text-xs font-medium text-gray-800">Cuti disetujui</p>
                                        <p class="text-xs text-gray-600">3 hari mulai 10 Jan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pending Requests Tables - Direktur -->
            @if(Auth::user()->role === 'direktur')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Table Pengajuan Cuti Menunggu -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <h3 class="text-lg font-semibold text-gray-800">Pengajuan Cuti Terbaru (5)</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100">
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Nama Karyawan</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Divisi</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Durasi</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Status</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Ahmad Rizki</td>
                                        <td class="px-6 py-3 text-gray-600">IT & Teknologi</td>
                                        <td class="px-6 py-3 text-gray-600">3 hari</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">05-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Budi Santoso</td>
                                        <td class="px-6 py-3 text-gray-600">Finance</td>
                                        <td class="px-6 py-3 text-gray-600">2 hari</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">06-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Dani Hermawan</td>
                                        <td class="px-6 py-3 text-gray-600">Operations</td>
                                        <td class="px-6 py-3 text-gray-600">5 hari</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">06-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Eka Wijaya</td>
                                        <td class="px-6 py-3 text-gray-600">Marketing</td>
                                        <td class="px-6 py-3 text-gray-600">1 hari</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">07-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Fitra Rahman</td>
                                        <td class="px-6 py-3 text-gray-600">HR & Admin</td>
                                        <td class="px-6 py-3 text-gray-600">4 hari</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">07-Jan-2026</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat semua pengajuan cuti →</a>
                        </div>
                    </div>

                    <!-- Table Pengajuan Lembur Menunggu -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-purple-50 to-violet-50">
                            <h3 class="text-lg font-semibold text-gray-800">Pengajuan Lembur Terbaru (5)</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100">
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Nama Karyawan</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Divisi</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Jam</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Status</th>
                                        <th class="px-6 py-3 text-left font-semibold text-gray-600 text-xs uppercase">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Siti Nurhaliza</td>
                                        <td class="px-6 py-3 text-gray-600">IT & Teknologi</td>
                                        <td class="px-6 py-3 text-gray-600">5 jam</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">05-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Rina Wijaya</td>
                                        <td class="px-6 py-3 text-gray-600">Finance</td>
                                        <td class="px-6 py-3 text-gray-600">4 jam</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">06-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Gusril Maulana</td>
                                        <td class="px-6 py-3 text-gray-600">Operations</td>
                                        <td class="px-6 py-3 text-gray-600">6 jam</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">06-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Hendra Kusuma</td>
                                        <td class="px-6 py-3 text-gray-600">Marketing</td>
                                        <td class="px-6 py-3 text-gray-600">3 jam</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">07-Jan-2026</td>
                                    </tr>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-gray-800">Intan Permata</td>
                                        <td class="px-6 py-3 text-gray-600">HR & Admin</td>
                                        <td class="px-6 py-3 text-gray-600">2 jam</td>
                                        <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span></td>
                                        <td class="px-6 py-3 text-gray-600 text-xs">07-Jan-2026</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700">Lihat semua pengajuan lembur →</a>
                        </div>
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
                            <!-- Direktur Activities - Approval & Request Focus -->
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan lembur Rina Wijaya disetujui</p>
                                        <p class="text-xs text-gray-500">4 jam lembur - 7 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400 flex-shrink-0">1 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan cuti Ahmad Rizki menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500">Cuti tahunan 3 hari - mulai 10 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400 flex-shrink-0">2 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan cuti ditolak - Bentrok shift</p>
                                        <p class="text-xs text-gray-500">Budi Santoso - 5 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400 flex-shrink-0">3 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800">Laporan kehadiran Desember tersedia</p>
                                        <p class="text-xs text-gray-500">Tingkat kehadiran: 94.2% dari 156 karyawan</p>
                                    </div>
                                    <span class="text-xs text-gray-400 flex-shrink-0">Kemarin</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja diterbitkan</p>
                                        <p class="text-xs text-gray-500">3 surat untuk keperluan karyawan</p>
                                    </div>
                                    <span class="text-xs text-gray-400 flex-shrink-0">2 hari lalu</span>
                                </div>
                            </div>
                        @else
                            <!-- Karyawan Activities -->
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan cuti Anda disetujui</p>
                                        <p class="text-xs text-gray-500">Cuti tahunan 3 hari - Mulai 10 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400">2 hari lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan lembur menunggu persetujuan</p>
                                        <p class="text-xs text-gray-500">Lembur 5 jam - 7 Jan 2026</p>
                                    </div>
                                    <span class="text-xs text-gray-400">1 jam lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja terbit</p>
                                        <p class="text-xs text-gray-500">Untuk keperluan bank - Siap diunduh</p>
                                    </div>
                                    <span class="text-xs text-gray-400">1 hari lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors border-b border-gray-50">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Pengajuan cuti ditolak</p>
                                        <p class="text-xs text-gray-500">Cuti sakit 1 hari - 5 Jan 2026 (Bentrok dengan shift)</p>
                                    </div>
                                    <span class="text-xs text-gray-400">3 hari lalu</span>
                                </div>
                            </div>
                            <div class="px-6 py-4 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">Slip gaji Desember tersedia</p>
                                        <p class="text-xs text-gray-500">Dalam folder file pribadi Anda</p>
                                    </div>
                                    <span class="text-xs text-gray-400">5 hari lalu</span>
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
                        <div class="space-y-3">
                            @if(Auth::user()->role === 'direktur')
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Review Pengajuan Cuti</p>
                                        <p class="text-xs text-gray-600">8 menunggu approval</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-200 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Review Pengajuan Lembur</p>
                                        <p class="text-xs text-gray-600">5 menunggu approval</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('direktur.laporan') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 transition-all duration-200 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-amber-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Lihat Laporan Bulanan</p>
                                        <p class="text-xs text-gray-600">SDM & Kehadiran</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <a href="{{ route('direktur.riwayat-persetujuan') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 transition-all duration-200 group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-red-500 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Riwayat Persetujuan</p>
                                        <p class="text-xs text-gray-600">Approval history</p>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            @else
                                <!-- Karyawan Quick Actions (Horizontal List) -->
                                <a href="{{ route('karyawan.pengajuan-cuti') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Ajukan Cuti</p>
                                            <p class="text-xs text-gray-600">Cuti tahunan, sakit</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('karyawan.pengajuan-lembur') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 transition-all duration-200 group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Ajukan Lembur</p>
                                            <p class="text-xs text-gray-600">Jam kerja tambahan</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('karyawan.surat') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-orange-50 to-amber-50 hover:from-orange-100 hover:to-amber-100 transition-all duration-200 group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-orange-500 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Surat Saya</p>
                                            <p class="text-xs text-gray-600">Download & riwayat</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('karyawan.riwayat') }}" class="flex items-center justify-between p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 transition-all duration-200 group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">Riwayat Pengajuan</p>
                                            <p class="text-xs text-gray-600">Cuti, lembur, surat</p>
                                        </div>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
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