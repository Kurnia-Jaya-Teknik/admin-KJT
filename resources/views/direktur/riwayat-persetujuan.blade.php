<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Persetujuan') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Periode Mulai</label>
                    <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Periode Akhir</label>
                    <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Jenis Pengajuan</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                        <option>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                        <option>Surat</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Timeline/History Table -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Jenis Pengajuan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Detail</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Keputusan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">7 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4 jam, Project deadline</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">6 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Rekomendasi</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">✗ Ditolak</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">5 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari, Liburan keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">4 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">Cuti Sakit</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2 hari, Sakit demam</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">3 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Dani Hermawan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWTT</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">2 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5 hari, Acara keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">✗ Ditolak</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">1 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 jam, Meeting klien</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">31 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Jalan</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">30 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari, Tahun Baru</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">29 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">6 jam, Penyelesaian project</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">✓ Disetujui</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <p class="text-sm text-gray-600">Menampilkan 10 dari 67 keputusan</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-600 font-medium hover:bg-gray-100 transition-colors">← Sebelumnya</button>
                        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-600 font-medium hover:bg-gray-100 transition-colors">Selanjutnya →</button>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-emerald-700 bg-emerald-100 px-3 py-1.5 rounded-full">Bulan Ini</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">45</h3>
                    <p class="text-sm text-gray-600">Total Disetujui</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-red-700 bg-red-100 px-3 py-1.5 rounded-full">Bulan Ini</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">3</h3>
                    <p class="text-sm text-gray-600">Total Ditolak</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-amber-700 bg-amber-100 px-3 py-1.5 rounded-full">Pending</span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-1">2</h3>
                    <p class="text-sm text-gray-600">Menunggu Review</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
