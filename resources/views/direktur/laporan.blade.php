<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
            <!-- Period Filter -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                        <option>2024</option>
                        <option>2025</option>
                        <option selected>2026</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-amber-500 text-white font-medium hover:bg-amber-600 transition-colors">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Reports Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Laporan Absensi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Absensi</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rekap kehadiran & ketidakhadiran seluruh karyawan periode ini.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-blue-500 text-blue-700 font-medium hover:bg-blue-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-blue-500 text-white font-medium hover:bg-blue-600 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Cuti -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Cuti</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Detail pengajuan cuti yang disetujui & ditolak bulan ini.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-purple-500 text-purple-700 font-medium hover:bg-purple-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-purple-500 text-white font-medium hover:bg-purple-600 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Lembur -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Lembur</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jumlah jam lembur & biaya lembur yang diajukan karyawan.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-amber-500 text-amber-700 font-medium hover:bg-amber-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-amber-500 text-white font-medium hover:bg-amber-600 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Surat -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Surat</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jenis & jumlah surat yang diterbitkan bulan ini.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-red-500 text-red-700 font-medium hover:bg-red-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-red-500 text-white font-medium hover:bg-red-600 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Penggajian -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Penggajian</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rincian penggajian & tunjangan seluruh karyawan.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-green-500 text-green-700 font-medium hover:bg-green-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-green-500 text-white font-medium hover:bg-green-600 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Kinerja -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan Kinerja</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Proses</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Evaluasi kinerja karyawan berdasarkan KPI.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors cursor-not-allowed opacity-50">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-gray-400 text-white font-medium cursor-not-allowed opacity-50">
                            Unduh PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
