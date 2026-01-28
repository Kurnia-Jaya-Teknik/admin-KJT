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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-100/60 to-slate-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-slate-600/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Pengajuan</p>
                        <p class="text-3xl font-bold text-gray-900">36</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-rose-100/60 to-rose-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-rose-600/80">8</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-100/60 to-green-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Disetujui</p>
                        <p class="text-3xl font-bold text-green-600/80">24</p>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-100/60 to-red-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600/80">4</p>
                    </div>
                </div>
            </div>

            <!-- List of Submissions -->
            <div class="space-y-4">
                <!-- Pending Item 1 -->
                <div data-id="8" data-status="pending" data-name="Ahmad Rizki" data-nik="EMP001" data-email="ahmad.rizki@company.com" data-dept="IT" data-created="10 Januari 2026, 14:30" data-jenis="Cuti Tahunan" data-tanggal-mulai="15-01-2026" data-tanggal-selesai="17-01-2026" data-durasi="3 hari" data-alasan="Libur keluarga" class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-rose-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-rose-500/80 to-rose-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Ahmad Rizki</h3>
                                    <p class="text-xs text-gray-500">ID: EMP001</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100/60 to-amber-50/40 text-amber-600/80 border border-amber-200/30 shadow-sm">⏳ Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">3 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">15-17 Jan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Diajukan</p>
                                    <p class="font-semibold text-gray-900">10 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span> Libur keluarga</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('pending', this.closest('[data-id]').dataset.id)" class="ml-4 px-4 py-2 bg-gradient-to-r from-rose-500/80 to-rose-400/70 text-white font-medium rounded-2xl hover:from-rose-500 hover:to-rose-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
                    </div>
                </div>

                <!-- Approved Item 1 -->
                <div data-id="3" data-status="approved" data-name="Budi Santoso" data-nik="EMP002" data-email="budi.santoso@company.com" data-dept="Finance" data-created="12 Januari 2026, 09:15" data-approved="14 Januari 2026, 10:30" data-jenis="Cuti Tahunan" data-tanggal-mulai="20-01-2026" data-tanggal-selesai="22-01-2026" data-durasi="3 hari" data-alasan="Liburan ke luar kota" class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-green-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-green-500/80 to-green-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Budi Santoso</h3>
                                    <p class="text-xs text-gray-500">ID: EMP002</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓ Disetujui Direktur</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">5 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">20-24 Jan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Disetujui</p>
                                    <p class="font-semibold text-gray-900">08 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span> Cuti panjang</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('approved', this.closest('[data-id]').dataset.id)" class="ml-4 px-4 py-2 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
                    </div>
                </div>

                <!-- Pending Item 2 -->
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-amber-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-amber-500/80 to-amber-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Siti Nurhaliza</h3>
                                    <p class="text-xs text-gray-500">ID: EMP003</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100/60 to-amber-50/40 text-amber-600/80 border border-amber-200/30 shadow-sm">⏳ Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Sakit</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">1 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">12 Jan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Diajukan</p>
                                    <p class="font-semibold text-gray-900">12 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span> Demam tinggi</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal()" class="ml-4 px-4 py-2 bg-gradient-to-r from-amber-500/80 to-amber-400/70 text-white font-medium rounded-2xl hover:from-amber-500 hover:to-amber-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
                    </div>
                </div>

                <!-- Rejected Item 1 -->
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-red-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-red-500/80 to-red-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Rina Wijaya</h3>
                                    <p class="text-xs text-gray-500">ID: EMP004</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100/60 to-red-50/40 text-red-600/80 border border-red-200/30 shadow-sm">✕ Ditolak</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">2 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">28-29 Jan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Ditolak</p>
                                    <p class="font-semibold text-gray-900">09 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Catatan:</span> Bentrok dengan deadline project</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal()" class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
                    </div>
                </div>

                <!-- Approved Item 2 -->
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-green-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-green-500/80 to-green-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Dedi Gunawan</h3>
                                    <p class="text-xs text-gray-500">ID: EMP005</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓ Disetujui Direktur</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">7 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">02-08 Feb</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Disetujui</p>
                                    <p class="font-semibold text-gray-900">05 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span> Cuti panjang + hari libur</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('approved')" class="ml-4 px-4 py-2 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
                    </div>
                </div>

                <!-- Pending Item 3 -->
                <div class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-rose-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-rose-500/80 to-rose-400/30 rounded-l-3xl"></div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Putra Wijaksana</h3>
                                    <p class="text-xs text-gray-500">ID: EMP006</p>
                                </div>
                                <span class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100/60 to-amber-50/40 text-amber-600/80 border border-amber-200/30 shadow-sm">⏳ Menunggu</span>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">Cuti Tahunan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">2 hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal</p>
                                    <p class="font-semibold text-gray-900">25-26 Jan</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Diajukan</p>
                                    <p class="font-semibold text-gray-900">11 Jan 2026</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span> Acara keluarga</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal()" class="ml-4 px-4 py-2 bg-gradient-to-r from-rose-500/80 to-rose-400/70 text-white font-medium rounded-2xl hover:from-rose-500 hover:to-rose-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat Detail</button>
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

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-rose-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan cuti karyawan</p>
                </div>
                <button onclick="closeDetailModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6">
                <!-- Karyawan Info Card -->
                <div class="bg-gradient-to-br from-rose-50/40 to-slate-50/30 rounded-2xl p-6 border border-rose-100/30">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-rose-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900" id="employeeName">-</h3>
                            <p class="text-sm text-gray-600 mt-0.5" id="employeeIdDept">-</p>
                            <p class="text-sm text-gray-500 mt-1" id="employeeEmail">-</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge - Dynamic based on status -->
                <div id="statusBadge" class="flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div>
                    <span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>
                </div>

                <!-- Cuti Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jenis">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="durasi">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-mulai">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-selesai">-</p>
                    </div>
                </div>

                <!-- Alasan Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">Alasan Pengajuan</h4>
                    <p class="text-gray-700 leading-relaxed" id="alasanText">-</p>
                </div>

                <!-- Timeline -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-gray-900">Riwayat Pengajuan</h4>
                    <div class="space-y-2" id="timelineContainer">
                        <div class="text-gray-500">Memuat...</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <!-- NOTE: Approval/Rejection hanya untuk Direktur, Admin hanya bisa lihat dan buat surat jika disetujui -->
                <div id="actionButtons" class="flex gap-3 pt-4 border-t border-gray-100/40">
                    <!-- Button 'Buat Surat' hanya muncul jika sudah disetujui direktur -->
                    <button id="buatSuratBtn" onclick="buatSurat()" class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Buat Surat
                    </button>
                    <button onclick="closeDetailModal()" class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Surat -->
    <div id="buatSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-100/60 to-blue-50/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Buat Surat Cuti?</h3>
                <p class="text-gray-600 mb-6">Surat cuti untuk <span id="buatSuratEmployeeName">-</span> akan dibuat. Pastikan sudah disetujui oleh direktur.</p>
                <div class="flex gap-3">
                    <button onclick="closeBuatSuratModal()" class="flex-1 px-4 py-2.5 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">Batal</button>
                    <button onclick="confirmBuatSurat()" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm transition-all">Ya, Buat Surat</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentRequestStatus = 'pending'; // track status: pending, approved, rejected

        function openDetailModal(status = 'pending', cutiId = null) {
            currentRequestStatus = status || 'pending';
            const modal = document.getElementById('detailModal');
            const buatSuratBtn = document.getElementById('buatSuratBtn');
            
            // Get row element
            const rowElement = document.querySelector(`[data-id="${cutiId}"]`);
            if (!rowElement) return;
            
            // Extract data from row attributes
            const employeeName = rowElement.dataset.name || '-';
            const employeeNik = rowElement.dataset.nik || '-';
            const employeeEmail = rowElement.dataset.email || '-';
            const employeeDept = rowElement.dataset.dept || '-';
            const createdDate = rowElement.dataset.created || '-';
            const approvedDate = rowElement.dataset.approved || null;
            const jenis = rowElement.dataset.jenis || '-';
            const tanggalMulai = rowElement.dataset.tanggalMulai || '-';
            const tanggalSelesai = rowElement.dataset.tanggalSelesai || '-';
            const durasi = rowElement.dataset.durasi || '-';
            const alasan = rowElement.dataset.alasan || '-';
            
            // Set data to modal
            modal.dataset.cutiId = cutiId || '';
            
            // Update employee info in modal
            document.getElementById('employeeName').textContent = employeeName;
            document.getElementById('employeeIdDept').textContent = `ID: ${employeeNik} • Departemen: ${employeeDept}`;
            document.getElementById('employeeEmail').textContent = `Email: ${employeeEmail}`;
            
            // Update cuti details
            document.querySelectorAll('[data-detail]').forEach(el => {
                const detailKey = el.dataset.detail;
                if (detailKey === 'jenis') el.textContent = jenis;
                if (detailKey === 'durasi') el.textContent = durasi;
                if (detailKey === 'tanggal-mulai') el.textContent = tanggalMulai;
                if (detailKey === 'tanggal-selesai') el.textContent = tanggalSelesai;
            });
            
            // Update alasan
            const alasanEl = document.getElementById('alasanText');
            if (alasanEl) alasanEl.textContent = alasan;
            
            // Update timeline/riwayat
            updateTimelineDisplay(status, createdDate, approvedDate);
            
            // Update buat surat confirmation modal
            document.getElementById('buatSuratEmployeeName').textContent = employeeName;
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Update status badge berdasarkan status
            const statusBadge = document.getElementById('statusBadge');
            const statusText = document.getElementById('statusText');
            
            if (status === 'approved') {
                statusBadge.className = 'flex items-center gap-2 p-3 bg-green-50/40 border border-green-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML = '<div class="w-3 h-3 rounded-full bg-green-500/80"></div><span class="font-medium text-green-700/80">Status: <span id="statusText">Disetujui Direktur</span></span>';
                buatSuratBtn.classList.remove('hidden');
                buatSuratBtn.classList.add('flex');
            } else if (status === 'rejected') {
                statusBadge.className = 'flex items-center gap-2 p-3 bg-red-50/40 border border-red-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML = '<div class="w-3 h-3 rounded-full bg-red-500/80"></div><span class="font-medium text-red-700/80">Status: <span id="statusText">Ditolak</span></span>';
                buatSuratBtn.classList.add('hidden');
            } else {
                // pending
                statusBadge.className = 'flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML = '<div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div><span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>';
                buatSuratBtn.classList.add('hidden');
            }
        }

        function updateTimelineDisplay(status, createdDate, approvedDate) {
            const timelineContainer = document.getElementById('timelineContainer');
            if (!timelineContainer) return;
            
            let timelineHTML = '';
            
            // Timeline item 1: Pengajuan dibuat
            timelineHTML += `
                <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-blue-50/40 to-slate-50/30 rounded-2xl border border-blue-100/30">
                    <div class="w-2 h-2 rounded-full bg-blue-500/80 mt-2 flex-shrink-0"></div>
                    <div class="flex-1 text-sm">
                        <p class="font-medium text-gray-900">Pengajuan Dibuat</p>
                        <p class="text-gray-600">${createdDate}</p>
                    </div>
                </div>
            `;
            
            // Timeline item 2: Status sesuai kondisi
            if (status === 'approved' && approvedDate) {
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-green-50/40 to-slate-50/30 rounded-2xl border border-green-100/30">
                        <div class="w-2 h-2 rounded-full bg-green-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Disetujui Direktur</p>
                            <p class="text-gray-600">${approvedDate}</p>
                        </div>
                    </div>
                `;
            } else if (status === 'rejected') {
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-red-50/40 to-slate-50/30 rounded-2xl border border-red-100/30">
                        <div class="w-2 h-2 rounded-full bg-red-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Ditolak</p>
                            <p class="text-gray-600">${approvedDate || 'Belum diproses'}</p>
                        </div>
                    </div>
                `;
            } else {
                // pending
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50/40 to-slate-50/30 rounded-2xl border border-gray-100/30">
                        <div class="w-2 h-2 rounded-full bg-gray-400/50 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Menunggu Persetujuan Direktur</p>
                            <p class="text-gray-600">Belum diproses</p>
                        </div>
                    </div>
                `;
            }
            
            timelineContainer.innerHTML = timelineHTML;
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function buatSurat() {
            document.getElementById('buatSuratModal').classList.remove('hidden');
        }

        function closeBuatSuratModal() {
            document.getElementById('buatSuratModal').classList.add('hidden');
        }

        function confirmBuatSurat() {
            const modal = document.getElementById('detailModal');
            const cutiId = modal.dataset.cutiId;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
            
            if (!cutiId) {
                showNotification('Error: ID cuti tidak ditemukan', 'error');
                return;
            }
            
            // Show loading state
            const btn = event.target;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Membuat...';
            
            fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.ok) {
                    closeBuatSuratModal();
                    showPdfPreviewModal(data.url);
                    showNotification('Surat berhasil dibuat!', 'success');
                } else {
                    showNotification(`Error: ${data.message}`, 'error');
                }
            })
            .catch(error => {
                showNotification(`Error: ${error.message}`, 'error');
            })
            .finally(() => {
                btn.disabled = false;
                btn.textContent = originalText;
            });
        }

        function showPdfPreviewModal(previewUrl) {
            // Create modal if not exists
            let previewModal = document.getElementById('pdfPreviewModal');
            if (!previewModal) {
                previewModal = document.createElement('div');
                previewModal.id = 'pdfPreviewModal';
                previewModal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-2 hidden';
                previewModal.innerHTML = `
                    <div class="bg-white rounded-lg shadow-2xl w-full h-full max-h-screen flex flex-col">
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-white">
                            <h3 class="text-xl font-bold text-gray-900">Preview Surat Cuti</h3>
                            <button onclick="closePdfPreviewModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- PDF Viewer -->
                        <div class="flex-1 overflow-hidden bg-gray-100 p-4">
                            <iframe id="pdfViewer" src="" class="w-full h-full border-0 rounded" style="display: none;"></iframe>
                            <div id="pdfLoading" class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <div class="inline-block">
                                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-500"></div>
                                    </div>
                                    <p class="mt-4 text-gray-600">Memuat PDF...</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50">
                            <button onclick="downloadCurrentPdf()" class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all shadow-sm flex items-center gap-2">
                                <svg class="inline-block w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </button>
                            <button onclick="closePdfPreviewModal()" class="px-6 py-2 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition-all">
                                Tutup
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(previewModal);
            }
            
            // Set PDF source
            const iframe = previewModal.querySelector('#pdfViewer');
            const loading = previewModal.querySelector('#pdfLoading');
            
            // Store URL globally for download
            window.currentPdfUrl = previewUrl;
            
            iframe.src = previewUrl;
            
            iframe.onload = () => {
                loading.style.display = 'none';
                iframe.style.display = 'block';
            };
            
            // Show modal
            previewModal.classList.remove('hidden');
        }

        function downloadCurrentPdf() {
            if (!window.currentPdfUrl) return;
            
            const a = document.createElement('a');
            a.href = window.currentPdfUrl;
            a.download = window.currentPdfUrl.split('/').pop();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showNotification('✓ PDF berhasil diunduh!', 'success');
        }

        function closePdfPreviewModal() {
            const previewModal = document.getElementById('pdfPreviewModal');
            if (previewModal) {
                previewModal.classList.add('hidden');
            }
        }

        function showNotification(message, type = 'info') {
            // Create notification if not exists
            let notification = document.getElementById('notification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'notification';
                notification.className = 'fixed top-4 right-4 max-w-md z-[60] hidden';
                document.body.appendChild(notification);
            }
            
            // Set colors based on type
            let bgColor = 'bg-blue-500';
            if (type === 'success') bgColor = 'bg-green-500';
            if (type === 'error') bgColor = 'bg-red-500';
            
            notification.innerHTML = `
                <div class="rounded-lg shadow-lg p-4 text-white ${bgColor} flex items-center gap-3">
                    <span>${message}</span>
                </div>
            `;
            notification.classList.remove('hidden');
            
            // Auto hide after 4 seconds
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 4000);
        }

        // Close modal when clicking outside
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        document.getElementById('buatSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeBuatSuratModal();
        });
    </script>
</x-app-layout>
