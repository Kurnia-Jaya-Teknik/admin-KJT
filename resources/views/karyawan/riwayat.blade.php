<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pengajuan
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pengajuan</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option selected>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                        <option>Surat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option selected>Semua</option>
                        <option>Disetujui</option>
                        <option>Menunggu</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">Filter</button>
                <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Reset</button>
            </div>
        </div>

        <!-- Riwayat List -->
        <div class="space-y-4">
            <!-- Kategori Januari 2026 -->
            <div class="sticky top-0 bg-gray-50 py-3 mb-4">
                <h3 class="text-sm font-semibold text-gray-700">Januari 2026</h3>
            </div>

            <!-- Item 1 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cuti Tahunan</p>
                                <p class="text-xs text-gray-600">3 hari • 10 - 12 Januari 2026</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Diproses oleh: <strong>Direktur</strong> • 7 Januari 2026
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-yellow-100 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Lembur</p>
                                <p class="text-xs text-gray-600">5 jam • 6 Januari 2026</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Menunggu</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Diajukan: <strong>5 Januari 2026</strong>
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    <button class="text-sm text-red-600 hover:text-red-700 font-medium">Batalkan</button>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Surat Keterangan Kerja</p>
                                <p class="text-xs text-gray-600">Untuk keperluan bank</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Diajukan: <strong>3 Januari 2026</strong> • Siap: <strong>5 Januari 2026</strong>
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Download</button>
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cuti Sakit</p>
                                <p class="text-xs text-gray-600">1 hari • 5 Januari 2026</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Ditolak</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Alasan Penolakan: <strong>Bentrok dengan jadwal rapat penting</strong>
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Ajukan Ulang</button>
                </div>
            </div>

            <!-- Kategori Desember 2025 -->
            <div class="sticky top-0 bg-gray-50 py-3 mb-4 mt-8">
                <h3 class="text-sm font-semibold text-gray-700">Desember 2025</h3>
            </div>

            <!-- Item 5 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cuti Tahunan</p>
                                <p class="text-xs text-gray-600">5 hari • 16 - 20 Desember 2025</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Diproses oleh: <strong>Direktur</strong> • 10 Desember 2025
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Surat Keterangan Gaji</p>
                                <p class="text-xs text-gray-600">Slip gaji Desember 2025</p>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                </div>
                <div class="ml-14 text-sm text-gray-600 mb-3">
                    Diajukan: <strong>28 Desember 2025</strong> • Siap: <strong>30 Desember 2025</strong>
                </div>
                <div class="ml-14 flex gap-2">
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Download</button>
                    <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center items-center gap-2">
            <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">← Sebelumnya</button>
            <button class="px-3 py-2 rounded-lg bg-indigo-600 text-white">1</button>
            <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">2</button>
            <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">3</button>
            <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya →</button>
        </div>
    </div>
</x-app-layout>
