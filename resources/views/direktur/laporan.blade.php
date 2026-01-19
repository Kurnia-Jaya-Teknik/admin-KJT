<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Period Filter -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                        <option>Januari</option>
                        <option>Februari</option>
                        <option>Maret</option>
                        <option>April</option>
                        <option>Mei</option>
                        <option>Juni</option>
                        <option>Juli</option>
                        <option>Agustus</option>
                        <option>September</option>
                        <option>Oktober</option>
                        <option>November</option>
                        <option>Desember</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                        <option>2024</option>
                        <option>2025</option>
                        <option selected>2026</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Reports Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Laporan Absensi -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Absensi</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rekap kehadiran & ketidakhadiran seluruh karyawan periode ini.</p>
                    <div class="flex gap-3">
                        <button onclick="openReportModal('Laporan Absensi', 'Data kehadiran & ketidakhadiran karyawan bulan Januari 2026. Total records: 156 karyawan dengan 98% kehadiran rata-rata.', 'Januari 2026')" class="flex-1 px-3 py-2 rounded-lg border border-blue-400 text-blue-400 font-semibold hover:bg-blue-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-blue-400 text-white font-semibold hover:bg-blue-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Cuti -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Cuti</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Detail pengajuan cuti yang disetujui & ditolak bulan ini.</p>
                    <div class="flex gap-3">
                        <button onclick="openReportModal('Laporan Cuti', 'Pengajuan cuti: 12 disetujui, 2 ditolak. Total hari cuti: 45 hari. Rata-rata pengambilan cuti: 3.5 hari per karyawan.', 'Januari 2026')" class="flex-1 px-3 py-2 rounded-lg border border-purple-400 text-purple-400 font-semibold hover:bg-purple-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-purple-400 text-white font-semibold hover:bg-purple-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Lembur -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Lembur</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jumlah jam lembur & biaya lembur yang diajukan karyawan.</p>
                    <div class="flex gap-3">
                        <button onclick="openReportModal('Laporan Lembur', 'Total jam lembur: 128 jam. Karyawan dengan lembur terbanyak: 5 orang. Biaya lembur bulan ini: Rp 45.600.000. Divisi terbanyak lembur: Operasional.', 'Januari 2026')" class="flex-1 px-3 py-2 rounded-lg border border-amber-400 text-amber-400 font-semibold hover:bg-amber-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-amber-400 text-white font-semibold hover:bg-amber-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Surat -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Surat</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jenis & jumlah surat yang diterbitkan bulan ini.</p>
                    <div class="flex gap-3">
                        <button onclick="openReportModal('Laporan Surat', 'Total surat diterbitkan: 28 lembar. Jenis: Surat Keterangan (12), Surat Referensi (8), Surat Rekomendasi (5), Surat Lainnya (3).', 'Januari 2026')" class="flex-1 px-3 py-2 rounded-lg border border-red-400 text-red-400 font-semibold hover:bg-red-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Penggajian -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Penggajian</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Draft</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rincian penggajian & tunjangan seluruh karyawan.</p>
                    <div class="flex gap-3">
                        <button onclick="openReportModal('Laporan Penggajian', 'Total gaji terbayar: Rp 2.345.600.000. Tunjangan tambahan: Rp 456.200.000. Pemotongan: Rp 123.450.000. Status: Masih dalam proses verifikasi.', 'Januari 2026')" class="flex-1 px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-emerald-400 text-white font-semibold hover:bg-emerald-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Kinerja -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-100 to-cyan-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Kinerja</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">Proses</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Evaluasi kinerja karyawan berdasarkan KPI.</p>
                    <div class="flex gap-3">
                        <button class="flex-1 px-3 py-2 rounded-lg border border-gray-300 text-gray-400 font-semibold cursor-not-allowed opacity-50">
                            Lihat
                        </button>
                        <button class="flex-1 px-3 py-2 rounded-lg bg-gray-300 text-white font-semibold cursor-not-allowed opacity-50">
                            Unduh PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Detail Modal -->
    <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-8 py-6 flex items-center justify-between border-b-2 border-red-800">
                <h2 id="modalTitle" class="text-2xl font-bold text-white">Laporan</h2>
                <button onclick="closeReportModal()" class="text-white hover:text-red-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                    <p id="modalPeriod" class="text-lg text-gray-800">-</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Laporan</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p id="modalContent" class="text-gray-700 leading-relaxed">-</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button class="flex-1 px-4 py-2 rounded-lg border border-red-400 text-red-400 font-semibold hover:bg-red-50 transition-colors">
                        Unduh PDF
                    </button>
                    <button class="flex-1 px-4 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">
                        Export Excel
                    </button>
                    <button onclick="closeReportModal()" class="flex-1 px-4 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        function openReportModal(title, content, period) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalContent').textContent = content;
            document.getElementById('modalPeriod').textContent = period;
            document.getElementById('reportModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeReportModal() {
            document.getElementById('reportModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('reportModal')?.addEventListener('click', function(event) {
            if (event.target === this) {
                closeReportModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !document.getElementById('reportModal').classList.contains('hidden')) {
                closeReportModal();
            }
        });
    </script>
</x-app-layout>
