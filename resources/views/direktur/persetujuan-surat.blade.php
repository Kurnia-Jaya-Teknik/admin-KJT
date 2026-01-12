<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Surat') }}
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                        <option>Semua Jenis</option>
                        <option>Surat PKWT</option>
                        <option>Surat PKWTT</option>
                        <option>Surat Magang</option>
                        <option>Surat Jalan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                        <option>Semua</option>
                        <option>Pending</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                    <input type="month" class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-red-500 text-white font-medium hover:bg-red-600 transition-colors">
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
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jenis Surat</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Pengajuan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWTT</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Lihat</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Rekomendasi</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Lihat</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Magang</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Disetujui</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Lihat</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed" disabled>Setujui</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed" disabled>Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWT</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Lihat</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed" disabled>Setujui</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed" disabled>Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Dani Hermawan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Jalan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Lihat</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-green-100 text-green-700 hover:bg-green-200 transition-colors">Setujui</button>
                                        <button class="px-2 py-1 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition-colors">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan 5 dari 18 surat</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">← Sebelumnya</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya →</button>
                    </div>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
