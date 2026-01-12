<x-app-layout>
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Welcome Banner -->
            <div class="relative overflow-hidden bg-gradient-to-r from-blue-400 via-purple-400 to-blue-500 rounded-2xl p-6 mb-6 shadow-lg">
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold mb-1 text-white">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                            <p class="text-blue-50 text-sm">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Total Karyawan -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Karyawan</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">156</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cuti Menunggu -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cuti Menunggu</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">8</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Lembur Menunggu -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lembur Menunggu</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Surat Bulan Ini -->
                <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Surat Bulan Ini</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <!-- Quick Links -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <h3 class="text-base font-semibold text-gray-800 mb-4">Akses Cepat</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.karyawan') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Manajemen Karyawan</p>
                                    <p class="text-xs text-gray-500">CRUD data karyawan</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.surat') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Manajemen Surat</p>
                                    <p class="text-xs text-gray-500">Buat & kelola surat</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.template') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Template Surat</p>
                                    <p class="text-xs text-gray-500">Kelola template</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.cuti') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center mr-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Pengajuan Cuti</p>
                                    <p class="text-xs text-gray-500">Monitor pengajuan</p>
                                </div>
                            </a>

                            <a href="{{ route('admin.lembur') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                <div
                                    class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mr-3 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Pengajuan Lembur</p>
                                    <p class="text-xs text-gray-500">Monitor pengajuan</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Activities -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                            <h3 class="text-base font-semibold text-gray-800">Aktivitas Terbaru</h3>
                        </div>
                        <div class="divide-y divide-gray-50">
                            <!-- Activity Item -->
                            <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">Direktur menyetujui
                                            pengajuan cuti</p>
                                        <p class="text-xs text-gray-500">Ahmad Rizki - Cuti tahunan 3 hari</p>
                                    </div>
                                    <span class="text-xs text-gray-400 ml-2 whitespace-nowrap">10 Jan</span>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">Karyawan baru ditambahkan
                                        </p>
                                        <p class="text-xs text-gray-500">Budi Santoso - Bagian Finance</p>
                                    </div>
                                    <span class="text-xs text-gray-400 ml-2 whitespace-nowrap">8 Jan</span>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-9 h-9 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">Template surat baru
                                            dibuat</p>
                                        <p class="text-xs text-gray-500">Template: Surat Keterangan Kerja</p>
                                    </div>
                                    <span class="text-xs text-gray-400 ml-2 whitespace-nowrap">5 Jan</span>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="px-5 py-3 hover:bg-gray-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div
                                        class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-800 truncate">Surat terbit untuk
                                            karyawan</p>
                                        <p class="text-xs text-gray-500">SK-001: Surat Keterangan Kerja</p>
                                    </div>
                                    <span class="text-xs text-gray-400 ml-2 whitespace-nowrap">3 Jan</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-3 border-t border-gray-100">
                            <a href="{{ route('admin.notifikasi') }}"
                                class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                Lihat semua aktivitas →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
