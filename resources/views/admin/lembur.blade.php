<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Monitoring Pengajuan Lembur
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
                <h1 class="text-3xl font-bold text-gray-900">Pengajuan Lembur</h1>
                <p class="text-gray-600 mt-1">Monitor semua pengajuan lembur dari karyawan</p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Karyawan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Karyawan</label>
                        <input type="text" placeholder="Ketik nama..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="pending">Menunggu Direktur</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <!-- Filter Periode -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Periode</option>
                            <option value="2026-01">Januari 2026</option>
                            <option value="2025-12">Desember 2025</option>
                            <option value="2025-11">November 2025</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-slate-100/60 to-slate-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-slate-600/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Pengajuan</p>
                        <p class="text-3xl font-bold text-gray-900">28</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-amber-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-amber-100/60 to-amber-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-amber-500/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Menunggu</p>
                        <p class="text-3xl font-bold text-amber-600/80">5</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-100/60 to-green-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Disetujui</p>
                        <p class="text-3xl font-bold text-green-600/80">20</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-red-100/60 to-red-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600/80">2</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-slate-100/60 to-slate-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-slate-600/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Jam</p>
                        <p class="text-3xl font-bold text-slate-600/80">112</p>
                    </div>
                </div>
            </div>

            <!-- List of Submissions -->
            <div class="space-y-4">
                <!-- Pending Item 1 -->
                <div data-id="4" data-status="pending" data-name="Siti Nurhaliza" data-nik="EMP001"
                    data-email="siti.nurhaliza@company.com" data-dept="Operations" data-created="12 Januari 2026, 16:45"
                    data-tanggal="12 Januari 2026" data-jam-mulai="17:00" data-jam-selesai="20:00"
                    data-durasi="3 jam" data-keterangan="Deadline project urgent"
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-amber-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-amber-500/80 to-amber-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Siti Nurhaliza</h3>
                                    <p class="text-xs text-gray-500">ID: EMP001</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100/60 to-amber-50/40 text-amber-600/80 border border-amber-200/30 shadow-sm">⏳
                                    Menunggu</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">12 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">17:00-20:00</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">3 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Operations</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Deadline
                                    project urgent</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('pending', this.closest('[data-id]').dataset.id)"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Approved Item 1 -->
                <div data-id="2" data-status="approved" data-name="Rudi Hermawan" data-nik="EMP002"
                    data-email="rudi.hermawan@company.com" data-dept="IT" data-created="14 Januari 2026, 15:20"
                    data-approved="16 Januari 2026, 09:00" data-tanggal="14 Januari 2026" data-jam-mulai="18:00"
                    data-jam-selesai="21:00" data-durasi="3 jam" data-keterangan="Overload workload"
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-green-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-green-500/80 to-green-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Ahmad Rizki</h3>
                                    <p class="text-xs text-gray-500">ID: EMP002</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓
                                    Disetujui Direktur</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">10 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">18:00-21:00</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">3 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Marketing</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Kampanye
                                    persiapan launch</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('approved', this.closest('[data-id]').dataset.id)"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Approved Item 2 -->
                <div data-id="3" data-status="approved"
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-green-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-green-500/80 to-green-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-green-100/60 to-green-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Budi Santoso</h3>
                                    <p class="text-xs text-gray-500">ID: EMP003</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-green-100/60 to-green-50/40 text-green-600/80 border border-green-200/30 shadow-sm">✓
                                    Disetujui Direktur</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">08 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">17:30-20:30</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">3 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Finance</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Closing
                                    buku bulanan</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('approved', this.closest('[data-id]').dataset.id)"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Pending Item 2 -->
                <div data-id="4" data-status="pending"
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-amber-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-amber-500/80 to-amber-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-100/60 to-amber-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-amber-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Rina Wijaya</h3>
                                    <p class="text-xs text-gray-500">ID: EMP004</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-amber-100/60 to-amber-50/40 text-amber-600/80 border border-amber-200/30 shadow-sm">⏳
                                    Menunggu</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">14 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">17:00-19:00</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">2 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Human Resources</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span>
                                    Rekrutmen interview lanjutan</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal('pending', this.closest('[data-id]').dataset.id)"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Rejected Item 1 -->
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-red-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-red-500/80 to-red-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Putra Wijaksana</h3>
                                    <p class="text-xs text-gray-500">ID: EMP005</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100/60 to-red-50/40 text-red-600/80 border border-red-200/30 shadow-sm">✕
                                    Ditolak</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">07 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">18:00-22:00</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">4 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Operations</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Catatan:</span> Melebihi
                                    batas jam lembur bulan ini</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal()"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>

                <!-- Pending Item 3 -->
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-lg hover:border-red-200/40 transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b from-red-500/80 to-red-400/30 rounded-l-3xl">
                    </div>
                    <div class="flex items-start justify-between">
                        <div class="flex-1 ml-2">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-10 h-10 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                    <svg class="w-5 h-5 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Dedi Gunawan</h3>
                                    <p class="text-xs text-gray-500">ID: EMP006</p>
                                </div>
                                <span
                                    class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-red-100/60 to-red-50/40 text-red-600/80 border border-red-200/30 shadow-sm">⏳
                                    Menunggu</span>
                            </div>
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Tanggal
                                    </p>
                                    <p class="font-semibold text-gray-900">15 Jan 2026</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jam
                                        Lembur</p>
                                    <p class="font-semibold text-gray-900">19:00-22:00</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                    </p>
                                    <p class="font-semibold text-gray-900">3 jam</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                        Departemen</p>
                                    <p class="font-semibold text-gray-900">Operations</p>
                                </div>
                            </div>
                            <div class="pl-4 border-l-2 border-gray-200/50">
                                <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> System
                                    maintenance emergency</p>
                            </div>
                        </div>
                        <button onclick="openDetailModal()"
                            class="ml-4 px-4 py-2 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm hover:shadow-md transition-all duration-300 text-sm whitespace-nowrap flex-shrink-0 group-hover:scale-105">Lihat
                            Detail</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-gray-600">Menampilkan 6 dari 28 pengajuan</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50"
                        disabled>Sebelumnya</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Berikutnya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-red-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Lembur</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan jam kerja lembur karyawan</p>
                </div>
                <button onclick="closeDetailModal()"
                    class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6">
                <!-- Karyawan Info Card -->
                <div class="bg-gradient-to-br from-red-50/40 to-slate-50/30 rounded-2xl p-6 border border-red-100/30">
                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
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
                <div id="statusBadge"
                    class="flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div>
                    <span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu
                            Persetujuan</span></span>
                </div>

                <!-- Approval Info - Hidden by default, shown when approved/rejected -->
                <div id="approvalInfo" class="hidden p-4 rounded-xl border">
                    <div class="flex items-center gap-2 text-sm">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium" id="approvalAction">Disetujui oleh</span>
                        <span id="approverName">-</span>
                        <span>•</span>
                        <span id="approvalDateTime">-</span>
                    </div>
                    <p class="text-xs mt-2 pl-6" id="approvalNote" style="display: none;"></p>
                </div>

                <!-- Overtime Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jam Mulai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jam-mulai">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jam Selesai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jam-selesai">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="durasi">-</p>
                    </div>
                </div>

                <!-- Keterangan Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">Keterangan Lembur</h4>
                    <p class="text-gray-700 leading-relaxed" id="keteranganText">-</p>
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
                    <button id="buatSuratBtn" onclick="buatSurat()"
                        class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                    <button onclick="closeDetailModal()"
                        class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Surat -->
    <div id="buatSuratModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <div class="p-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-100/60 to-blue-50/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Buat Surat Lembur?</h3>
                <p class="text-gray-600 mb-6">Surat lembur untuk <span id="buatSuratEmployeeName">-</span> akan
                    dibuat. Pastikan sudah disetujui oleh direktur.</p>
                <div class="flex gap-3">
                    <button onclick="closeBuatSuratModal()"
                        class="flex-1 px-4 py-2.5 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">Batal</button>
                    <button onclick="confirmBuatSurat()"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm transition-all">Ya,
                        Buat Surat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Confirmation Modal -->
    <div id="approvalModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <div class="p-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-green-100/60 to-green-50/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Setujui Pengajuan?</h3>
                <p class="text-gray-600 mb-6">Anda akan menyetujui pengajuan lembur Siti Nurhaliza untuk 3 jam (12 Jan
                    2026)</p>
                <div class="flex gap-3">
                    <button onclick="closeApprovalModal()"
                        class="flex-1 px-4 py-2.5 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">Batal</button>
                    <button onclick="confirmApproval()"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm transition-all">Ya,
                        Setujui</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div id="rejectModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <div class="p-8">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-red-100/60 to-red-50/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 text-center">Tolak Pengajuan?</h3>
                <p class="text-gray-600 mb-4 text-center">Masukkan alasan penolakan pengajuan lembur</p>
                <textarea placeholder="Masukkan alasan penolakan..."
                    class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/40 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-400/40 text-sm resize-none mb-4"
                    rows="3"></textarea>
                <div class="flex gap-3">
                    <button onclick="closeRejectModal()"
                        class="flex-1 px-4 py-2.5 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">Batal</button>
                    <button onclick="confirmReject()"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500/80 to-red-400/70 text-white font-medium rounded-2xl hover:from-red-500 hover:to-red-400 shadow-sm transition-all">Ya,
                        Tolak</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentRequestStatus = 'pending'; // track status: pending, approved, rejected

        function openDetailModal(status = 'pending', lemburId = null) {
            currentRequestStatus = status || 'pending';
            const modal = document.getElementById('detailModal');
            const buatSuratBtn = document.getElementById('buatSuratBtn');

            // Get row element
            const rowElement = document.querySelector(`[data-id="${lemburId}"]`);
            if (!rowElement) return;

            // Extract data from row attributes
            const employeeName = rowElement.dataset.name || '-';
            const employeeNik = rowElement.dataset.nik || '-';
            const employeeEmail = rowElement.dataset.email || '-';
            const employeeDept = rowElement.dataset.dept || '-';
            const createdDate = rowElement.dataset.created || '-';
            const approvedDate = rowElement.dataset.approved || null;
            const tanggal = rowElement.dataset.tanggal || '-';
            const jamMulai = rowElement.dataset.jamMulai || '-';
            const jamSelesai = rowElement.dataset.jamSelesai || '-';
            const durasi = rowElement.dataset.durasi || '-';
            const keterangan = rowElement.dataset.keterangan || '-';

            // Set data to modal
            modal.dataset.lemburId = lemburId || '';

            // Update employee info in modal
            document.getElementById('employeeName').textContent = employeeName;
            document.getElementById('employeeIdDept').textContent = `ID: ${employeeNik} • Departemen: ${employeeDept}`;
            document.getElementById('employeeEmail').textContent = `Email: ${employeeEmail}`;

            // Update lembur details
            document.querySelectorAll('[data-detail]').forEach(el => {
                const detailKey = el.dataset.detail;
                if (detailKey === 'tanggal') el.textContent = tanggal;
                if (detailKey === 'jam-mulai') el.textContent = jamMulai;
                if (detailKey === 'jam-selesai') el.textContent = jamSelesai;
                if (detailKey === 'durasi') el.textContent = durasi;
            });

            // Update keterangan
            const keteranganEl = document.getElementById('keteranganText');
            if (keteranganEl) keteranganEl.textContent = keterangan;

            // Update timeline/riwayat
            updateTimelineDisplay(status, createdDate, approvedDate);

            // Update buat surat confirmation modal
            document.getElementById('buatSuratEmployeeName').textContent = employeeName;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Update status badge berdasarkan status
            const statusBadge = document.getElementById('statusBadge');
            const statusText = document.getElementById('statusText');
            const approvalInfo = document.getElementById('approvalInfo');

            if (status === 'approved') {
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-green-50/40 border border-green-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-green-500/80"></div><span class="font-medium text-green-700/80">Status: <span id="statusText">Disetujui Direktur</span></span>';
                buatSuratBtn.classList.remove('hidden');
                buatSuratBtn.classList.add('flex');

                // Show approval info
                if (approvalInfo && approvedDate) {
                    approvalInfo.className = 'p-4 rounded-xl border bg-green-50/50 border-green-200/30';
                    approvalInfo.querySelector('svg').className = 'w-4 h-4 text-green-600';
                    approvalInfo.querySelector('#approvalAction').textContent = 'Disetujui oleh';
                    approvalInfo.querySelector('#approvalAction').className = 'font-medium text-green-800';
                    approvalInfo.querySelector('#approverName').textContent = 'Direktur';
                    approvalInfo.querySelector('#approverName').className = 'text-green-700';
                    approvalInfo.querySelector('#approvalDateTime').textContent = approvedDate + ' WIB';
                    approvalInfo.querySelector('#approvalDateTime').className = 'text-green-700';
                    approvalInfo.classList.remove('hidden');
                }
            } else if (status === 'rejected') {
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-red-50/40 border border-red-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-red-500/80"></div><span class="font-medium text-red-700/80">Status: <span id="statusText">Ditolak</span></span>';
                buatSuratBtn.classList.add('hidden');

                // Show rejection info
                if (approvalInfo && approvedDate) {
                    approvalInfo.className = 'p-4 rounded-xl border bg-red-50/50 border-red-200/30';
                    approvalInfo.querySelector('svg').className = 'w-4 h-4 text-red-600';
                    approvalInfo.querySelector('#approvalAction').textContent = 'Ditolak oleh';
                    approvalInfo.querySelector('#approvalAction').className = 'font-medium text-red-800';
                    approvalInfo.querySelector('#approverName').textContent = 'Direktur';
                    approvalInfo.querySelector('#approverName').className = 'text-red-700';
                    approvalInfo.querySelector('#approvalDateTime').textContent = approvedDate + ' WIB';
                    approvalInfo.querySelector('#approvalDateTime').className = 'text-red-700';
                    approvalInfo.classList.remove('hidden');
                }
            } else {
                // pending
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div><span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>';
                buatSuratBtn.classList.add('hidden');

                // Hide approval info for pending
                if (approvalInfo) {
                    approvalInfo.classList.add('hidden');
                }
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
            const lemburId = modal.dataset.lemburId;
            const lemburName = modal.dataset.name;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            if (!lemburId) {
                alert('Error: ID lembur tidak ditemukan');
                return;
            }

            // Show loading state
            const btn = event.target;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Membuat...';

            fetch(`/admin/lembur/${lemburId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Get filename from content-disposition header
                        const contentDisposition = response.headers.get('content-disposition');
                        let filename = `Surat_Lembur_${lemburName}.pdf`;
                        if (contentDisposition) {
                            const filenameMatch = contentDisposition.match(/filename[^;=\n]*=(["\']?)([^"\';]*)/);
                            if (filenameMatch) filename = filenameMatch[2];
                        }

                        // Download PDF
                        response.blob().then(blob => {
                            const url = window.URL.createObjectURL(blob);
                            const a = document.createElement('a');
                            a.href = url;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                            window.URL.revokeObjectURL(url);
                            document.body.removeChild(a);

                            // Show success notification
                            showNotification('✓ Surat lembur berhasil dibuat dan diunduh!', 'success');

                            // Close modals
                            closeBuatSuratModal();
                            closeDetailModal();
                        });
                    } else {
                        return response.json().then(data => {
                            showNotification('✗ ' + (data.message || 'Gagal membuat surat'), 'error');
                        });
                    }
                })
                .catch(error => {
                    showNotification('✗ Error: ' + error.message, 'error');
                    console.error('Error:', error);
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
                previewModal.className =
                    'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden';
                previewModal.innerHTML = `
                    <div class="bg-white rounded-lg shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col">
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900">Preview Surat Lembur</h3>
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
                            <a id="downloadBtn" href="" download class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all shadow-sm">
                                <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </a>
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
            const downloadBtn = previewModal.querySelector('#downloadBtn');

            iframe.src = previewUrl;
            downloadBtn.href = previewUrl;

            iframe.onload = () => {
                loading.style.display = 'none';
                iframe.style.display = 'block';
            };

            // Show modal
            previewModal.classList.remove('hidden');
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

        function openApprovalModal() {
            document.getElementById('approvalModal').classList.remove('hidden');
        }

        function closeApprovalModal() {
            document.getElementById('approvalModal').classList.add('hidden');
        }

        function confirmApproval() {
            alert('Pengajuan lembur telah disetujui!');
            closeApprovalModal();
            closeDetailModal();
        }

        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        function confirmReject() {
            alert('Pengajuan lembur telah ditolak!');
            closeRejectModal();
            closeDetailModal();
        }

        // Close modal when clicking outside
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        document.getElementById('buatSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeBuatSuratModal();
        });

        document.getElementById('approvalModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeApprovalModal();
        });

        document.getElementById('rejectModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeRejectModal();
        });
    </script>
</x-app-layout>
