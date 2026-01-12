<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Surat
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
                <h1 class="text-3xl font-bold text-gray-900">Riwayat Surat</h1>
                <p class="text-gray-600 mt-1">Arsip dan pencarian surat yang telah dibuat</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Surat</label>
                        <input type="text" placeholder="Nomor atau nama..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Jenis -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Jenis</option>
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                        </select>
                    </div>

                    <!-- Filter Dari Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Sampai Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                </div>
            </div>

            <!-- Timeline by Month -->
            <div class="space-y-8">
                <!-- January 2026 -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-50/50 py-2">Januari 2026 (8 surat)</h2>
                    <div class="space-y-3">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2026-001</p>
                                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Budi Santoso</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>10 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">PC-2026-001</p>
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded">Siap Ambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Pengajuan Cuti • Untuk Rina Wijaya</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>09 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2026-002</p>
                                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Ahmad Rizki</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>08 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- December 2025 -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gray-50/50 py-2">Desember 2025 (12 surat)</h2>
                    <div class="space-y-3">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2025-048</p>
                                        <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Siti Nurhaliza</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>28 Desember 2025</span>
                                        <span>•</span>
                                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0 mt-1">
                                    <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">DR-2025-012</p>
                                        <span class="text-xs px-2 py-1 bg-amber-100 text-amber-800 rounded">Draft</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Izin • Untuk Dedi Gunawan</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>25 Desember 2025</span>
                                        <span>•</span>
                                        <button class="text-indigo-600 hover:text-indigo-700 font-medium">Selesaikan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-gray-600">Total: 48 surat</p>
                <div class="flex gap-2">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50" disabled>Sebelumnya</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Berikutnya</button>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
