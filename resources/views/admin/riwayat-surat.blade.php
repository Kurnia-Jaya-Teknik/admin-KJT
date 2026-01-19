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
            <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Surat</label>
                        <input type="text" placeholder="Nomor atau nama..." class="w-full px-4 py-2.5 border border-gray-200/60 rounded-2xl focus:ring-2 focus:ring-red-400/40 focus:border-transparent bg-white/80" />
                    </div>

                    <!-- Filter Jenis -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select class="w-full px-4 py-2.5 border border-gray-200/60 rounded-2xl focus:ring-2 focus:ring-red-400/40 focus:border-transparent bg-white/80">
                            <option value="">Semua Jenis</option>
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                        </select>
                    </div>

                    <!-- Filter Dari Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                        <input type="date" class="w-full px-4 py-2.5 border border-gray-200/60 rounded-2xl focus:ring-2 focus:ring-red-400/40 focus:border-transparent bg-white/80" />
                    </div>

                    <!-- Filter Sampai Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                        <input type="date" class="w-full px-4 py-2.5 border border-gray-200/60 rounded-2xl focus:ring-2 focus:ring-red-400/40 focus:border-transparent bg-white/80" />
                    </div>
                </div>
            </div>

            <!-- Timeline by Month -->
            <div class="space-y-8">
                <!-- January 2026 -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gradient-to-r from-red-50/50 to-slate-50/30 py-3 px-3 rounded-2xl border border-red-100/30 shadow-sm">Januari 2026 (8 surat)</h2>
                    <div class="space-y-3">
                        <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-5 hover:shadow-lg hover:border-blue-100/40 transition-all duration-300 group overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm mt-1">
                                    <svg class="w-5 h-5 text-blue-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2026-001</p>
                                        <span class="text-xs px-2.5 py-1 bg-blue-50/70 text-blue-600/80 rounded-full border border-blue-200/30 shadow-sm">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Budi Santoso</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>10 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-5 hover:shadow-lg hover:border-green-100/40 transition-all duration-300 group overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm mt-1">
                                    <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">PC-2026-001</p>
                                        <span class="text-xs px-2.5 py-1 bg-green-50/70 text-green-600/80 rounded-full border border-green-200/30 shadow-sm">Siap Ambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Pengajuan Cuti • Untuk Rina Wijaya</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>09 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-5 hover:shadow-lg hover:border-purple-100/40 transition-all duration-300 group overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-purple-100/60 to-purple-50/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm mt-1">
                                    <svg class="w-5 h-5 text-purple-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2026-002</p>
                                        <span class="text-xs px-2.5 py-1 bg-blue-50/70 text-blue-600/80 rounded-full border border-blue-200/30 shadow-sm">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Ahmad Rizki</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>08 Januari 2026</span>
                                        <span>•</span>
                                        <button class="text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- December 2025 -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 sticky top-0 bg-gradient-to-r from-red-50/50 to-slate-50/30 py-3 px-3 rounded-2xl border border-red-100/30 shadow-sm">Desember 2025 (2 surat)</h2>
                    <div class="space-y-3">
                        <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-5 hover:shadow-lg hover:border-blue-100/40 transition-all duration-300 group overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-blue-100/60 to-blue-50/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm mt-1">
                                    <svg class="w-5 h-5 text-blue-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">SK-2025-048</p>
                                        <span class="text-xs px-2.5 py-1 bg-blue-50/70 text-blue-600/80 rounded-full border border-blue-200/30 shadow-sm">Diambil</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Keterangan Kerja • Untuk Siti Nurhaliza</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>28 Desember 2025</span>
                                        <span>•</span>
                                        <button class="text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Unduh PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-5 hover:shadow-lg hover:border-orange-100/40 transition-all duration-300 group overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-50/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="relative flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-orange-100/60 to-orange-50/30 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm mt-1">
                                    <svg class="w-5 h-5 text-orange-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <p class="font-semibold text-gray-900">DR-2025-012</p>
                                        <span class="text-xs px-2.5 py-1 bg-slate-50/70 text-slate-600/80 rounded-full border border-slate-200/30 shadow-sm">Draft</span>
                                    </div>
                                    <p class="text-sm text-gray-700">Surat Izin • Untuk Dedi Gunawan</p>
                                    <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                                        <span>25 Desember 2025</span>
                                        <span>•</span>
                                        <button class="text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Selesaikan</button>
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
                    <button class="px-4 py-2.5 border border-gray-200/60 rounded-2xl text-gray-700 hover:bg-gray-50/80 transition-all duration-300 disabled:opacity-50 shadow-sm" disabled>Sebelumnya</button>
                    <button class="px-4 py-2.5 border border-gray-200/60 rounded-2xl text-gray-700 hover:bg-gray-50/80 transition-all duration-300 shadow-sm">Berikutnya</button>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
