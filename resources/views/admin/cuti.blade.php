<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Monitoring Pengajuan Cuti
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Pengajuan Cuti</h1>
                <p class="text-gray-600 mt-1">Monitor semua pengajuan cuti dari karyawan</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Karyawan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Karyawan</label>
                                        <input type="text" placeholder="Ketik nama..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="pending">Menunggu Direktur</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <!-- Filter Periode -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Periode</option>
                            <option value="2026-01">Januari 2026</option>
                            <option value="2025-12">Desember 2025</option>
                            <option value="2025-11">November 2025</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Total Pengajuan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">36</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">8</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Disetujui</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">24</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Ditolak</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">4</p>
                </div>
            </div>

            <!-- List of Submissions -->
            <div class="space-y-4">
                <!-- Pending Item 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Ahmad Rizki</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">3 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">15-17 Januari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Diajukan</p>
                                    <p class="font-medium text-gray-900">10 Januari 2026</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alasan: Libur keluarga</p>
                            </div>
                        </div>
                        <button class="text-red-600 hover:text-red-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>

                <!-- Approved Item 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Budi Santoso</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Disetujui</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">5 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">20-24 Januari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Disetujui Oleh</p>
                                    <p class="font-medium text-gray-900">Direktur (08-01-2026)</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alasan: Cuti panjang</p>
                            </div>
                        </div>
                        <button class="text-red-600 hover:text-red-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>

                <!-- Pending Item 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Siti Nurhaliza</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Sakit</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">1 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">12 Januari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Diajukan</p>
                                    <p class="font-medium text-gray-900">12 Januari 2026</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alasan: Demam tinggi</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>

                <!-- Rejected Item 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Rina Wijaya</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">2 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">28-29 Januari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Ditolak Oleh</p>
                                    <p class="font-medium text-gray-900">Direktur (09-01-2026)</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Catatan: Bentrok dengan deadline project</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>

                <!-- Approved Item 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Dedi Gunawan</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Disetujui</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">7 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">02-08 Februari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Disetujui Oleh</p>
                                    <p class="font-medium text-gray-900">Direktur (05-01-2026)</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alasan: Cuti panjang + hari libur</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>

                <!-- Pending Item 3 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <h3 class="text-lg font-semibold text-gray-900">Putra Wijaksana</h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm mb-3">
                                <div>
                                    <p class="text-gray-600">Jenis Cuti</p>
                                    <p class="font-medium text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Durasi</p>
                                    <p class="font-medium text-gray-900">2 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal</p>
                                    <p class="font-medium text-gray-900">25-26 Januari 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Diajukan</p>
                                    <p class="font-medium text-gray-900">11 Januari 2026</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Alasan: Acara keluarga</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat Detail →</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-gray-600">Menampilkan 6 dari 36 pengajuan</p>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Berikutnya</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
