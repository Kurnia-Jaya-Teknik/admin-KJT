<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Saya
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Sisa Cuti Tahunan -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Sisa Cuti Tahunan</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">8</p>
                        <p class="text-xs text-gray-500 mt-1">dari 12 hari</p>
                    </div>
                    <div class="p-3 bg-emerald-100 rounded-lg">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 bg-gray-100 rounded-full h-2">
                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 67%"></div>
                </div>
            </div>

            <!-- Total Pengajuan Cuti -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pengajuan Cuti</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">4</p>
                        <p class="text-xs text-gray-500 mt-1">tahun ini</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Pengajuan Lembur -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pengajuan Lembur</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">6</p>
                        <p class="text-xs text-gray-500 mt-1">tahun ini</p>
                    </div>
                    <div class="p-3 bg-indigo-100 rounded-lg">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Status Terakhir -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Status Terakhir</p>
                        <p class="text-lg font-bold text-gray-800 mt-2">Disetujui</p>
                        <p class="text-xs text-gray-500 mt-1">Cuti 3 hari • 10 Jan</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Status Pengajuan Terbaru -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Status Pengajuan Terbaru</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Item 1 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Tahunan</p>
                                <p class="text-sm text-gray-600 mt-1">3 hari • 10 - 12 Januari 2026</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                        </div>
                        <p class="text-sm text-gray-600">Diproses: 7 Jan 2026</p>
                    </div>

                    <!-- Item 2 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Lembur</p>
                                <p class="text-sm text-gray-600 mt-1">5 jam • 6 Januari 2026</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Menunggu</span>
                        </div>
                        <p class="text-sm text-gray-600">Diajukan: 5 Jan 2026</p>
                    </div>

                    <!-- Item 3 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-medium text-gray-800">Surat Keterangan Kerja</p>
                                <p class="text-sm text-gray-600 mt-1">Untuk keperluan bank</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                        </div>
                        <p class="text-sm text-gray-600">Tersedia: 3 Jan 2026</p>
                    </div>

                    <!-- Item 4 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Sakit</p>
                                <p class="text-sm text-gray-600 mt-1">1 hari • 5 Januari 2026</p>
                            </div>
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Ditolak</span>
                        </div>
                        <p class="text-sm text-gray-600">Alasan: Bentrok dengan shift penting</p>
                    </div>
                </div>
            </div>

            <!-- Agenda Mendatang -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Agenda Mendatang</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Event 1 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-emerald-600">10</p>
                                <p class="text-xs text-gray-600">Jan</p>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Cuti Tahunan Dimulai</p>
                                <p class="text-xs text-gray-600 mt-1">3 hari libur</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event 2 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-indigo-600">25</p>
                                <p class="text-xs text-gray-600">Jan</p>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Gajian Bulan Januari</p>
                                <p class="text-xs text-gray-600 mt-1">Slip gaji tersedia</p>
                            </div>
                        </div>
                    </div>

                    <!-- Event 3 -->
                    <div class="p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex gap-4">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-slate-600">31</p>
                                <p class="text-xs text-gray-600">Jan</p>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Akhir Bulan</p>
                                <p class="text-xs text-gray-600 mt-1">Deadline pengajuan cuti</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-center">
                    <a href="{{ route('karyawan.riwayat') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                        Lihat Riwayat Lengkap →
                    </a>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Pengajuan cuti Anda disetujui</p>
                            <p class="text-sm text-gray-600 mt-1">Cuti tahunan 3 hari • 7 Jan 2026</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">2 hari lalu</span>
                    </div>
                </div>

                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Pengajuan lembur menunggu persetujuan</p>
                            <p class="text-sm text-gray-600 mt-1">5 jam lembur • 6 Jan 2026</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">1 hari lalu</span>
                    </div>
                </div>

                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Surat Keterangan Kerja tersedia</p>
                            <p class="text-sm text-gray-600 mt-1">Untuk keperluan bank • Siap diunduh</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">3 hari lalu</span>
                    </div>
                </div>

                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">Pengajuan cuti ditolak</p>
                            <p class="text-sm text-gray-600 mt-1">Cuti sakit 1 hari • Bentrok dengan shift</p>
                        </div>
                        <span class="text-xs text-gray-500 flex-shrink-0">5 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('karyawan.pengajuan-cuti') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-emerald-100 rounded-lg group-hover:bg-emerald-200 transition-colors">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-gray-900">Ajukan Cuti</p>
                        <p class="text-sm text-gray-600 mt-1">Cuti tahunan, sakit, atau khusus</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('karyawan.pengajuan-lembur') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-indigo-100 rounded-lg group-hover:bg-indigo-200 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-gray-900">Ajukan Lembur</p>
                        <p class="text-sm text-gray-600 mt-1">Jam kerja tambahan</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('karyawan.surat') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow group">
                <div class="flex items-start gap-4">
                    <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 group-hover:text-gray-900">Ajukan Surat</p>
                        <p class="text-sm text-gray-600 mt-1">PKWT, PKWTT, atau lainnya</p>
                    </div>
                </div>
            </a>
        </div>
        </div>
    </div>
</x-app-layout>
