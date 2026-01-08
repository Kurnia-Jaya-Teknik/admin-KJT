<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Cuti
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pengajuan -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Ajukan Cuti Baru</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Jenis Cuti -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Cuti</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option selected disabled>Pilih jenis cuti</option>
                                <option>Cuti Tahunan</option>
                                <option>Cuti Sakit</option>
                                <option>Cuti Khusus</option>
                                <option>Cuti Penting</option>
                            </select>
                        </div>

                        <!-- Tanggal Mulai & Selesai -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                                <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Alasan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alasan / Keterangan</label>
                            <textarea rows="4" placeholder="Jelaskan alasan pengajuan cuti Anda..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                        </div>

                        <!-- Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800">
                                <span class="font-medium">Catatan:</span> Sisa cuti tahunan Anda <strong>8 hari</strong>. Pastikan pengajuan tidak melebihi jumlah sisa cuti.
                            </p>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                Ajukan Cuti
                            </button>
                            <button type="reset" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Cuti</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-600 font-medium">SISA CUTI TAHUNAN</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">8 hari</p>
                        <div class="mt-2 bg-gray-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 67%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">Digunakan 4 dari 12 hari</p>
                    </div>
                    <hr class="border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-medium mb-3">KEBIJAKAN CUTI</p>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Pengajuan minimal 3 hari sebelumnya</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Max 5 hari dalam satu pengajuan</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Approval dari direktur</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Cuti tidak bisa dibatalkan 1 hari sebelumnya</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengajuan Cuti -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Cuti</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <!-- Item 1 - Approved -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Cuti Tahunan</p>
                            <p class="text-sm text-gray-600 mt-1">3 hari • 10 - 12 Januari 2026</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diproses oleh: Direktur • 7 Januari 2026</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    </div>
                </div>

                <!-- Item 2 - Pending -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Cuti Sakit</p>
                            <p class="text-sm text-gray-600 mt-1">1 hari • 5 Januari 2026</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Menunggu</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diajukan: 4 Januari 2026</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                        <button class="text-sm text-red-600 hover:text-red-700 font-medium">Batalkan</button>
                    </div>
                </div>

                <!-- Item 3 - Rejected -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Cuti Khusus</p>
                            <p class="text-sm text-gray-600 mt-1">2 hari • 2 - 3 Januari 2026</p>
                        </div>
                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Ditolak</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Alasan: Bentrok dengan jadwal rapat penting</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Ajukan Ulang</button>
                    </div>
                </div>

                <!-- Item 4 - Approved -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Cuti Tahunan</p>
                            <p class="text-sm text-gray-600 mt-1">5 hari • 16 - 20 Desember 2025</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diproses oleh: Direktur • 10 Desember 2025</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
