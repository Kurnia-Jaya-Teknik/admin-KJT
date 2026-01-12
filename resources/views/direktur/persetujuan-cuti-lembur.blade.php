<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Cuti & Lembur') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pengajuan</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                        <option>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                        <option>Semua</option>
                        <option>Menunggu</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <input type="month" class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-amber-500 text-white font-medium hover:bg-amber-600 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jenis</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">10-12 Jan 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Liburan keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">7 Jan 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5 jam</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Project deadline</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Sakit</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2 hari</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Sakit demam</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">8 Jan 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4 jam</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Meeting klien</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Dani Hermawan</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">15-17 Jan 2026</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Acara keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-3 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan 5 dari 12 pengajuan</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">← Sebelumnya</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya →</button>
                    </div>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
