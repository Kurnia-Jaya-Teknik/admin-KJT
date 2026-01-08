<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notifikasi
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Notifikasi Admin HR</h1>
                <p class="text-gray-600 mt-1">Pemberitahuan sistem dan alert penting</p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex gap-2 mb-6">
                <button class="px-4 py-2 rounded-lg border-2 border-indigo-600 bg-indigo-50 text-indigo-700 font-medium transition-colors">Semua</button>
                <button class="px-4 py-2 rounded-lg border-2 border-gray-200 text-gray-700 hover:border-gray-300 font-medium transition-colors">Belum Dibaca</button>
                <button class="px-4 py-2 rounded-lg border-2 border-gray-200 text-gray-700 hover:border-gray-300 font-medium transition-colors">Pengajuan</button>
                <button class="px-4 py-2 rounded-lg border-2 border-gray-200 text-gray-700 hover:border-gray-300 font-medium transition-colors">Surat</button>
                <button class="px-4 py-2 rounded-lg border-2 border-gray-200 text-gray-700 hover:border-gray-300 font-medium transition-colors">Sistem</button>
            </div>

            <!-- Notifications List -->
            <div class="space-y-4">
                <!-- Unread Notification 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 rounded-full bg-indigo-600 flex-shrink-0 mt-3"></div>
                        <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Pengajuan Lembur Baru dari Siti Nurhaliza</p>
                            <p class="text-sm text-gray-600 mt-1">Siti Nurhaliza mengajukan lembur 3 jam untuk tanggal 12 Januari 2026</p>
                            <p class="text-xs text-gray-500 mt-3">Baru saja • Menunggu review</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Unread Notification 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 rounded-full bg-indigo-600 flex-shrink-0 mt-3"></div>
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Direktur Menyetujui Pengajuan Cuti</p>
                            <p class="text-sm text-gray-600 mt-1">Ahmad Rizki - Cuti Tahunan 3 hari - Disetujui oleh Direktur</p>
                            <p class="text-xs text-gray-500 mt-3">2 jam lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Unread Notification 3 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="w-2 h-2 rounded-full bg-indigo-600 flex-shrink-0 mt-3"></div>
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h6a1 1 0 01.894.553l2 4H4V4zm0 5v8a2 2 0 002 2h8a2 2 0 002-2V9H4z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Surat Siap Diambil</p>
                            <p class="text-sm text-gray-600 mt-1">SK-2026-001 (Budi Santoso) - Surat Keterangan Kerja siap untuk diambil</p>
                            <p class="text-xs text-gray-500 mt-3">3 jam lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Read Notification 1 -->
                <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow opacity-75">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Direktur Menolak Pengajuan</p>
                            <p class="text-sm text-gray-600 mt-1">Rina Wijaya - Cuti Tahunan 2 hari - Ditolak karena bentrok dengan deadline project</p>
                            <p class="text-xs text-gray-500 mt-3">5 jam lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Read Notification 2 -->
                <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow opacity-75">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Laporan Karyawan Belum Absen Hari Ini</p>
                            <p class="text-sm text-gray-600 mt-1">Putra Wijaksana belum melakukan absensi masuk hingga pukul 10:30</p>
                            <p class="text-xs text-gray-500 mt-3">1 hari lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Read Notification 3 -->
                <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow opacity-75">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Backup Database Selesai</p>
                            <p class="text-sm text-gray-600 mt-1">Database backup otomatis telah selesai dilakukan dengan sukses</p>
                            <p class="text-xs text-gray-500 mt-3">2 hari lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>

                <!-- Read Notification 4 -->
                <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow opacity-75">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">Update Sistem Tersedia</p>
                            <p class="text-sm text-gray-600 mt-1">Versi 2.1.0 dari sistem HR tersedia untuk di-update</p>
                            <p class="text-xs text-gray-500 mt-3">3 hari lalu</p>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-700 font-medium whitespace-nowrap ml-4">Lihat →</button>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div class="text-center mt-8">
                <button class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Muat Notifikasi Lebih Lama</button>
            </div>
        </div>
    </div>
</x-app-layout>
