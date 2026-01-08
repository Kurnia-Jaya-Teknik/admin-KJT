<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin HRD
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Selamat Datang, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600 mt-1">{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Karyawan -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Karyawan</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">156</dd>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a2 2 0 002-2v-2a3 3 0 00-5.356-1.857M6 20H4a2 2 0 01-2-2v-2a3 3 0 015.356-1.857M6 20a2 2 0 002-2v-2a3 3 0 01-6 0v2a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengajuan Cuti Pending -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Cuti Menunggu</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">8</dd>
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-lg">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengajuan Lembur Pending -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Lembur Menunggu</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">5</dd>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Surat Bulan Ini -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <dt class="text-sm font-medium text-gray-500 truncate">Surat Bulan Ini</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">12</dd>
                            </div>
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Quick Links -->
                <div class="lg:col-span-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Akses Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.karyawan') }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a2 2 0 002-2v-2a3 3 0 00-5.356-1.857M6 20H4a2 2 0 01-2-2v-2a3 3 0 015.356-1.857M6 20a2 2 0 002-2v-2a3 3 0 01-6 0v2a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Manajemen Karyawan</p>
                                    <p class="text-xs text-gray-500">CRUD data karyawan</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.surat') }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Manajemen Surat</p>
                                    <p class="text-xs text-gray-500">Buat & kelola surat</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.template') }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Template Surat</p>
                                    <p class="text-xs text-gray-500">Kelola template</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.cuti') }}" class="block p-4 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
                            <div class="flex items-center">
                                <div class="p-2 bg-yellow-100 rounded-lg mr-3">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Pengajuan Cuti</p>
                                    <p class="text-xs text-gray-500">Monitor pengajuan</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Notifications / Activities -->
                <div class="lg:col-span-2 bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                        
                        <div class="space-y-4">
                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div class="p-2 bg-green-100 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Direktur menyetujui pengajuan cuti</p>
                                    <p class="text-sm text-gray-600">Ahmad Rizki - Cuti tahunan 3 hari</p>
                                    <p class="text-xs text-gray-500 mt-1">10 Januari 2026</p>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div class="p-2 bg-blue-100 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Karyawan baru ditambahkan</p>
                                    <p class="text-sm text-gray-600">Budi Santoso - Bagian Finance</p>
                                    <p class="text-xs text-gray-500 mt-1">8 Januari 2026</p>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div class="p-2 bg-purple-100 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 6v8a2 2 0 002 2h12a2 2 0 002-2v-8H4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Template surat baru dibuat</p>
                                    <p class="text-sm text-gray-600">Template: Surat Keterangan Kerja</p>
                                    <p class="text-xs text-gray-500 mt-1">5 Januari 2026</p>
                                </div>
                            </div>

                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div class="p-2 bg-yellow-100 rounded-full mr-3">
                                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-900">Surat terbit untuk karyawan</p>
                                    <p class="text-sm text-gray-600">SK-001: Surat Keterangan Kerja</p>
                                    <p class="text-xs text-gray-500 mt-1">3 Januari 2026</p>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.notifikasi') }}" class="mt-4 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                            Lihat semua aktivitas →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
