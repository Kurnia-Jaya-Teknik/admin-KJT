<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Lembur
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
                    <h3 class="text-sm font-semibold text-gray-800">Ajukan Lembur Baru</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Tanggal Lembur -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lembur</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Jam Mulai & Selesai -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                                <input type="time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                                <input type="time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Total Jam -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Jam Lembur</label>
                            <div class="px-4 py-2 border border-gray-300 rounded-lg bg-gray-50">
                                <p class="text-gray-700 font-medium">5 jam</p>
                            </div>
                            <p class="text-xs text-gray-600 mt-2">Otomatis terhitung dari jam mulai dan selesai</p>
                        </div>

                        <!-- Keterangan Pekerjaan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Pekerjaan</label>
                            <textarea rows="4" placeholder="Jelaskan pekerjaan apa yang akan dilakukan selama lembur..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                        </div>

                        <!-- Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800">
                                <span class="font-medium">Catatan:</span> Lembur hanya bisa diajukan maksimal 3 jam per hari dan memerlukan persetujuan dari direktur.
                            </p>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                Ajukan Lembur
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
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Lembur</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-600 font-medium">TOTAL LEMBUR BULAN INI</p>
                        <p class="text-2xl font-bold text-indigo-600 mt-1">12 jam</p>
                        <p class="text-xs text-gray-600 mt-1">Dari 6 pengajuan</p>
                    </div>
                    <hr class="border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-medium mb-3">KEBIJAKAN LEMBUR</p>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Max 3 jam per hari</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Max 20 jam per bulan</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Lembur hari libur prioritas rendah</span>
                            </li>
                            <li class="flex gap-2">
                                <span class="text-indigo-600 font-bold">•</span>
                                <span>Persetujuan dari direktur</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengajuan Lembur -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Lembur</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <!-- Item 1 - Approved -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Lembur • 5 jam</p>
                            <p class="text-sm text-gray-600 mt-1">6 Januari 2026 • 18:00 - 23:00</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Pekerjaan: Menyelesaikan laporan project X</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    </div>
                </div>

                <!-- Item 2 - Approved -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Lembur • 3 jam</p>
                            <p class="text-sm text-gray-600 mt-1">3 Januari 2026 • 19:00 - 22:00</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Pekerjaan: Database maintenance</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    </div>
                </div>

                <!-- Item 3 - Pending -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Lembur • 4 jam</p>
                            <p class="text-sm text-gray-600 mt-1">2 Januari 2026 • 17:00 - 21:00</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Menunggu</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Pekerjaan: Backup data server</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                        <button class="text-sm text-red-600 hover:text-red-700 font-medium">Batalkan</button>
                    </div>
                </div>

                <!-- Item 4 - Approved -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Lembur • 2 jam</p>
                            <p class="text-sm text-gray-600 mt-1">1 Januari 2026 • 20:00 - 22:00</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Disetujui</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Pekerjaan: Meeting preparation dengan client</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Lihat Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
