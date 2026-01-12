<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pengajuan
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gradient-to-br from-slate-50/80 via-blue-50/20 to-purple-50/10 min-h-full">
        <!-- Welcome Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Riwayat Pengajuan</h1>
            <p class="text-sm text-gray-500">Lihat semua riwayat pengajuan cuti, lembur, dan surat Anda</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-6 mb-6 hover:shadow-md transition-shadow duration-300">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-2">Jenis Pengajuan</label>
                    <select class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:border-emerald-300/50 transition-all duration-300 text-sm">
                        <option selected>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                        <option>Surat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:border-emerald-300/50 transition-all duration-300 text-sm">
                        <option selected>Semua</option>
                        <option>Disetujui</option>
                        <option>Menunggu</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-2">Dari Tanggal</label>
                    <input type="date" class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:border-emerald-300/50 transition-all duration-300 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-2">Sampai Tanggal</label>
                    <input type="date" class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:border-emerald-300/50 transition-all duration-300 text-sm">
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button class="px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-400 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-500 shadow-sm hover:shadow-md transition-all duration-300 text-sm">Filter</button>
                <button class="px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">Reset</button>
            </div>
        </div>

        <!-- Riwayat List -->
        <div class="space-y-4">
            <!-- Kategori Januari 2026 -->
            <div class="sticky top-0 bg-gradient-to-r from-emerald-50/30 to-blue-50/20 backdrop-blur-sm py-3 mb-4 rounded-xl px-4 -mx-2 z-10">
                <h3 class="text-sm font-semibold text-gray-700">Januari 2026</h3>
            </div>

            <!-- Item 1 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50/60 to-emerald-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Cuti Tahunan</p>
                                <p class="text-xs text-gray-500 mt-0.5">3 hari • 10 - 12 Januari 2026</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Diproses oleh: <strong class="text-gray-600">Direktur</strong> • 7 Januari 2026</p>
                        <button class="text-xs text-emerald-500/80 hover:text-emerald-600/80 font-medium transition-colors">Lihat Detail →</button>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-50/60 to-yellow-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-yellow-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Lembur</p>
                                <p class="text-xs text-gray-500 mt-0.5">5 jam • 6 Januari 2026</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-yellow-50/70 text-yellow-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Menunggu</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Diajukan: <strong class="text-gray-600">5 Januari 2026</strong></p>
                        <div class="flex gap-3">
                            <button class="text-xs text-purple-500/80 hover:text-purple-600/80 font-medium transition-colors">Lihat Detail →</button>
                            <button class="text-xs text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Batalkan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50/60 to-blue-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja</p>
                                <p class="text-xs text-gray-500 mt-0.5">Untuk keperluan bank</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Diajukan: <strong class="text-gray-600">3 Januari 2026</strong> • Siap: <strong class="text-gray-600">5 Januari 2026</strong></p>
                        <div class="flex gap-3">
                            <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Download →</button>
                            <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Cuti Sakit</p>
                                <p class="text-xs text-gray-500 mt-0.5">1 hari • 5 Januari 2026</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-red-50/70 text-red-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Ditolak</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Alasan Penolakan: <strong class="text-gray-600">Bentrok dengan jadwal rapat penting</strong></p>
                        <div class="flex gap-3">
                            <button class="text-xs text-emerald-500/80 hover:text-emerald-600/80 font-medium transition-colors">Detail →</button>
                            <button class="text-xs text-emerald-500/80 hover:text-emerald-600/80 font-medium transition-colors">Ajukan Ulang</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori Desember 2025 -->
            <div class="sticky top-0 bg-gradient-to-r from-emerald-50/30 to-blue-50/20 backdrop-blur-sm py-3 mb-4 mt-8 rounded-xl px-4 -mx-2 z-10">
                <h3 class="text-sm font-semibold text-gray-700">Desember 2025</h3>
            </div>

            <!-- Item 5 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-50/60 to-emerald-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Cuti Tahunan</p>
                                <p class="text-xs text-gray-500 mt-0.5">5 hari • 16 - 20 Desember 2025</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Diproses oleh: <strong class="text-gray-600">Direktur</strong> • 10 Desember 2025</p>
                        <button class="text-xs text-emerald-500/80 hover:text-emerald-600/80 font-medium transition-colors">Lihat Detail →</button>
                    </div>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-5 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50/60 to-blue-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between mb-1.5">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Surat Keterangan Gaji</p>
                                <p class="text-xs text-gray-500 mt-0.5">Slip gaji Desember 2025</p>
                            </div>
                            <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Diajukan: <strong class="text-gray-600">28 Desember 2025</strong> • Siap: <strong class="text-gray-600">30 Desember 2025</strong></p>
                        <div class="flex gap-3">
                            <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Download →</button>
                            <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center items-center gap-2">
            <button class="px-3 py-2 rounded-xl border border-gray-200/60 text-gray-600 hover:bg-white/80 hover:border-gray-300/60 transition-all duration-300 text-sm">← Sebelumnya</button>
            <button class="px-3 py-2 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-400 text-white shadow-sm text-sm">1</button>
            <button class="px-3 py-2 rounded-xl border border-gray-200/60 text-gray-600 hover:bg-white/80 hover:border-gray-300/60 transition-all duration-300 text-sm">2</button>
            <button class="px-3 py-2 rounded-xl border border-gray-200/60 text-gray-600 hover:bg-white/80 hover:border-gray-300/60 transition-all duration-300 text-sm">3</button>
            <button class="px-3 py-2 rounded-xl border border-gray-200/60 text-gray-600 hover:bg-white/80 hover:border-gray-300/60 transition-all duration-300 text-sm">Selanjutnya →</button>
        </div>
        </div>
    </div>
</x-app-layout>
