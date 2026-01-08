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
                        <!-- Pengajuan Bulan Ini Chart - Simpel -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pengajuan per Bulan (6 Bulan Terakhir)</h3>
                            <div class="flex items-end justify-between h-40 gap-2 mb-6">
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 80px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Agu</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 95px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Sep</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 70px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Okt</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 110px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Nov</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 105px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Des</span>
                                </div>
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-indigo-600 rounded-t" style="height: 75px;"></div>
                                    <span class="text-xs text-gray-600 font-medium">Jan</span>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-gray-600">Total 6 Bulan</span>
                                    <span class="text-lg font-bold text-indigo-600">555 pengajuan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Lembur Per Divisi - Progress Bar Sederhana -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Lembur per Divisi (Bulan Ini)</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">IT & Teknologi</span>
                                        <span class="text-sm font-bold text-indigo-600">42 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Finance</span>
                                        <span class="text-sm font-bold text-blue-600">35 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">Operations</span>
                                        <span class="text-sm font-bold text-emerald-600">31 jam</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-emerald-600 h-2 rounded-full" style="width: 44%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Lembur</span>
                                <span class="text-lg font-bold text-gray-800">150 jam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column Charts - Direktur -->
                    <div class="space-y-6">
                        <!-- Status Pengajuan Donut FULL 360° - SOLID COLOR -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-6">Status Pengajuan</h3>
                            <div class="flex items-center justify-center mb-6">
                                <div class="relative w-48 h-48">
                                    <svg class="w-full h-full" viewBox="0 0 140 140" style="transform: rotate(-90deg)">
                                        <!-- Approved (green) - 60/140 = 43% = 154.8° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#059669" stroke-width="22" stroke-dasharray="119.3 340.6" stroke-linecap="round"/>
                                        <!-- Pending (amber) - 70/140 = 50% = 180° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#d97706" stroke-width="22" stroke-dasharray="136 340.6" stroke-dashoffset="-119.3" stroke-linecap="round"/>
                                        <!-- Rejected (red) - 10/140 = 7% = 25.2° -->
                                        <circle cx="70" cy="70" r="55" fill="none" stroke="#dc2626" stroke-width="22" stroke-dasharray="24.4 340.6" stroke-dashoffset="-255.3" stroke-linecap="round"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-3xl font-bold text-gray-800">140</div>
                                            <div class="text-xs text-gray-500">Total</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-green-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Disetujui</span>
                                    </div>
                                    <span class="font-bold text-gray-800">60 (43%)</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-amber-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Menunggu</span>
                                    </div>
                                    <span class="font-bold text-gray-800">70 (50%)</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-4 h-4 rounded-full bg-red-600 flex-shrink-0"></div>
                                        <span class="text-gray-600">Ditolak</span>
                                    </div>
                                    <span class="font-bold text-gray-800">10 (7%)</span>
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
                                    <span class="font-bold text-lg text-amber-600">13</span>
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
                                    <span class="font-bold text-lg text-blue-600">145/156</span>
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
         
    <!-- Pending Requests - Direktur (Card Format) -->
            @if(Auth::user()->role === 'direktur')
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
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">AR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Ahmad Rizki</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">3 hari • Mulai 10 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">BS</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Budi Santoso</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">2 hari • Mulai 12 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">DH</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Dani Hermawan</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">5 hari • Mulai 15 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">EW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Eka Wijaya</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">1 hari • Mulai 16 Jan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">FR</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Fitra Rahman</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">4 hari • Mulai 18 Jan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="text-sm font-semibold text-green-600 hover:text-green-700">Lihat Semua →</a>
                        </div>
                    </div>

                    <!-- Pengajuan Lembur - Card List Format -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-violet-50 to-purple-50">
                            <h3 class="text-lg font-bold text-gray-800">Lembur Menunggu Persetujuan (5)</h3>
                        </div>
                        <div class="divide-gray-100 max-h-96 overflow-y-auto">
                            <!-- Card Item 1 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 font-semibold text-indigo-600">SN</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Siti Nurhaliza</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">IT & Teknologi</p>
                                        <p class="text-xs font-medium text-gray-700">5 jam • 5 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 2 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 font-semibold text-blue-600">RW</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Rina Wijaya</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Finance</p>
                                        <p class="text-xs font-medium text-gray-700">4 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 3 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 font-semibold text-green-600">GM</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Gusril Maulana</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Operations</p>
                                        <p class="text-xs font-medium text-gray-700">6 jam • 6 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 4 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors ">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0 font-semibold text-orange-600">HK</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Hendra Kusuma</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">Marketing</p>
                                        <p class="text-xs font-medium text-gray-700">3 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Item 5 -->
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 font-semibold text-red-600">IP</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-1">
                                            <p class="text-sm font-semibold text-gray-800">Intan Permata</p>
                                            <span class="text-xs px-2 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800">Pending</span>
                                        </div>
                                        <p class="text-xs text-gray-500 mb-1">HR & Admin</p>
                                        <p class="text-xs font-medium text-gray-700">2 jam • 7 Jan 2026</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="text-sm font-semibold text-purple-600 hover:text-purple-700">Lihat Semua →</a>
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
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-sm font-semibold text-gray-800">Aksi Cepat</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <!-- Quick Actions - Direktur -->
                    @if(Auth::user()->role === 'direktur')
                        <a href="{{ route('direktur.persetujuan-cuti-lembur') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Review Pengajuan</p>
                                    <p class="text-xs text-gray-600">13 pengajuan menunggu</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('direktur.laporan') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm10-3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1v-3a1 1 0 00-1-1h-3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Laporan Bulanan</p>
                                    <p class="text-xs text-gray-600">SDM, kehadiran & pengajuan</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>

                        <a href="{{ route('direktur.ringkasan-karyawan') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Ringkasan Karyawan</p>
                                    <p class="text-xs text-gray-600">Data 156 karyawan</p>
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