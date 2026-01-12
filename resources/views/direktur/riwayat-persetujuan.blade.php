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
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode Mulai</label>
                    <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Periode Akhir</label>
                    <input type="date" class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pengajuan</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all">
                        <option>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                        <option>Surat</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition-colors">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Timeline/History Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jenis Pengajuan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Detail</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Keputusan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">7 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4 jam, Project deadline</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">6 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Rekomendasi</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">✗ Ditolak</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">5 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari, Liburan keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">4 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-800">Cuti Sakit</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2 hari, Sakit demam</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">3 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Dani Hermawan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWTT</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">2 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5 hari, Acara keluarga</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">✗ Ditolak</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">1 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 jam, Meeting klien</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">31 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">Surat</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Jalan</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">30 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti Tahunan</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 hari, Tahun Baru</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">29 Des 2025</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span></td>
                                <td class="px-6 py-4 text-sm text-gray-600">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">6 jam, Penyelesaian project</td>
                                <td class="px-6 py-4 text-sm"><span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✓ Disetujui</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan 10 dari 67 keputusan</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">← Sebelumnya</button>
                        <button class="px-3 py-1 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">Selanjutnya →</button>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Bulan Ini</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">45</h3>
                    <p class="text-sm text-gray-500">Total Disetujui</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Bulan Ini</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">3</h3>
                    <p class="text-sm text-gray-500">Total Ditolak</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Pending</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">2</h3>
                    <p class="text-sm text-gray-500">Menunggu Review</p>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
