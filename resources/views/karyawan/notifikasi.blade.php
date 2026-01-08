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
        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex items-center justify-between gap-4">
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">Semua</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Belum Dibaca</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Disetujui</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Ditolak</button>
                </div>
                <button class="text-sm text-red-600 hover:text-red-700 font-medium">Tandai semua sudah dibaca</button>
            </div>
        </div>

        <!-- Notifikasi List -->
        <div class="space-y-3">
            <!-- Notifikasi 1 - Unread, Approved -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer">
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 rounded-full bg-indigo-600 mt-2 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Cuti tahunan 3 hari telah disetujui oleh Direktur. Cuti akan dilaksanakan pada 10-12 Januari 2026.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Hari ini, 14:32</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 2 - Unread, Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer">
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 rounded-full bg-indigo-600 mt-2 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Lembur Menunggu Persetujuan</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan lembur 5 jam pada 6 Januari 2026 sedang dalam proses persetujuan oleh Direktur. Anda akan diberitahu segera setelah ada keputusan.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">Menunggu</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Kemarin, 09:15</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 3 - Read, Rejected -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Ditolak</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan cuti sakit pada 5 Januari 2026 telah ditolak. Alasan: Bentrok dengan jadwal shift penting. Anda dapat mengajukan kembali dengan waktu yang berbeda.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Ditolak</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">2 hari lalu, 16:45</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 4 - Read, Ready -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Surat Keterangan Kerja Tersedia</p>
                                <p class="text-sm text-gray-600 mt-1">Surat Keterangan Kerja yang Anda ajukan untuk keperluan bank sudah siap. Silakan unduh atau ambil di kantor HR.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Siap</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">3 hari lalu, 11:20</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 5 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Slip Gaji Bulan Desember Tersedia</p>
                                <p class="text-sm text-gray-600 mt-1">Slip gaji Anda untuk bulan Desember 2025 sudah tersedia di sistem. Silakan unduh dari menu Profil atau hubungi HR untuk detail.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded">Info</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">1 minggu lalu, 08:00</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 6 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Lembur Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan lembur 4 jam pada 2 Januari 2026 telah disetujui oleh Direktur. Terima kasih atas kontribusi kerja Anda.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">1 minggu lalu, 15:30</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 7 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan cuti tahunan 5 hari pada 16-20 Desember 2025 telah disetujui oleh Direktur. Nikmati liburanmu dan pulang dengan aman.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">2 minggu lalu, 10:00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (jika tidak ada notifikasi) -->
        <!-- 
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <p class="text-gray-600 text-lg font-medium">Tidak Ada Notifikasi</p>
            <p class="text-gray-500 text-sm mt-2">Anda akan menerima notifikasi ketika ada perubahan status pengajuan Anda.</p>
        </div>
        -->
    </div>
</x-app-layout>
