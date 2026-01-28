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
                    <select id="reportMonthSelect"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select id="reportYearSelect"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-red-400 transition-all">
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026" selected>2026</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button
                        class="w-full px-4 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Reports Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Laporan Absensi -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Absensi</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rekap kehadiran & ketidakhadiran seluruh karyawan periode ini.
                    </p>
                    <div class="flex gap-3">
                        <button
                            onclick="openReportModal('Laporan Absensi', 'Data kehadiran & ketidakhadiran karyawan bulan Januari 2026. Total records: 156 karyawan dengan 98% kehadiran rata-rata.', 'Januari 2026')"
                            class="flex-1 px-3 py-2 rounded-lg border border-blue-400 text-blue-400 font-semibold hover:bg-blue-50 transition-colors">
                            Lihat
                        </button>
                        <button
                            class="flex-1 px-3 py-2 rounded-lg bg-blue-400 text-white font-semibold hover:bg-blue-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Cuti -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Cuti</h3>
                            <p class="text-sm text-gray-500 mt-1">Pilih periode dan sumber periode untuk menampilkan
                                preview excel yang bisa dicetak.</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>

                    {{-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Periode</label>
                            <select id="reportPeriodBy"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm">
                                <option value="tanggal_mulai" selected>Berbasis Tanggal Mulai</option>
                                <option value="tanggal_persetujuan">Berbasis Tanggal Persetujuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                            <select id="reportMonthSelect"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <select id="reportYearSelect"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm">
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026" selected>2026</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="flex gap-3">
                        <a href="{{ route('direktur.laporan.cuti') }}"
                            class="flex-1 text-center px-3 py-2 rounded-lg border border-purple-400 text-purple-400 font-semibold hover:bg-purple-50 transition-colors">Lihat</a>
                        <a href="{{ route('direktur.laporan.cuti') }}?export=csv"
                            class="flex-1 text-center px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">Export
                            Excel</a>
                    </div>
                </div>

                <!-- Laporan Lembur -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Lembur</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jumlah jam lembur & biaya lembur yang diajukan karyawan.</p>
                    <div class="flex gap-3">
                        <button
                            onclick="openReportModal('Laporan Lembur', 'Total jam lembur: 128 jam. Karyawan dengan lembur terbanyak: 5 orang. Biaya lembur bulan ini: Rp 45.600.000. Divisi terbanyak lembur: Operasional.', 'Januari 2026')"
                            class="flex-1 px-3 py-2 rounded-lg border border-amber-400 text-amber-400 font-semibold hover:bg-amber-50 transition-colors">
                            Lihat
                        </button>
                        <button
                            class="flex-1 px-3 py-2 rounded-lg bg-amber-400 text-white font-semibold hover:bg-amber-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Surat -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Surat</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Siap</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Jenis & jumlah surat yang diterbitkan bulan ini.</p>
                    <div class="flex gap-3">
                        <button
                            onclick="openReportModal('Laporan Surat', 'Total surat diterbitkan: 28 lembar. Jenis: Surat Keterangan (12), Surat Referensi (8), Surat Rekomendasi (5), Surat Lainnya (3).', 'Januari 2026')"
                            class="flex-1 px-3 py-2 rounded-lg border border-red-400 text-red-400 font-semibold hover:bg-red-50 transition-colors">
                            Lihat
                        </button>
                        <button
                            class="flex-1 px-3 py-2 rounded-lg bg-red-400 text-white font-semibold hover:bg-red-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Penggajian -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Penggajian</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Draft</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Rincian penggajian & tunjangan seluruh karyawan.</p>
                    <div class="flex gap-3">
                        <button
                            onclick="openReportModal('Laporan Penggajian', 'Total gaji terbayar: Rp 2.345.600.000. Tunjangan tambahan: Rp 456.200.000. Pemotongan: Rp 123.450.000. Status: Masih dalam proses verifikasi.', 'Januari 2026')"
                            class="flex-1 px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">
                            Lihat
                        </button>
                        <button
                            class="flex-1 px-3 py-2 rounded-lg bg-emerald-400 text-white font-semibold hover:bg-emerald-500 transition-colors">
                            Unduh PDF
                        </button>
                    </div>
                </div>

                <!-- Laporan Kinerja -->
                <div
                    class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-100 to-cyan-50 flex items-center justify-center mb-3">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Laporan Kinerja</h3>
                            <p class="text-sm text-gray-500 mt-1">Periode Januari 2026</p>
                        </div>
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-700">Proses</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">Evaluasi kinerja karyawan berdasarkan KPI.</p>
                    <div class="flex gap-3">
                        <button
                            class="flex-1 px-3 py-2 rounded-lg border border-gray-300 text-gray-400 font-semibold cursor-not-allowed opacity-50">
                            Lihat
                        </button>
                        <button
                            class="flex-1 px-3 py-2 rounded-lg bg-gray-300 text-white font-semibold cursor-not-allowed opacity-50">
                            Unduh PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Panel (inline) -->
    <div id="cutiReportPanel" class="hidden bg-white rounded-2xl shadow-md border border-gray-200 p-0 mt-6">
        <div
            class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 rounded-t-2xl flex items-center justify-between">
            <h2 id="modalTitle" class="text-lg font-bold text-white">Preview Excel — Laporan Cuti</h2>
            <div class="text-sm text-white/90">Sheet: <strong>Laporan Cuti</strong> <span id="panelCount"
                    class="text-xs text-white/90 ml-2"></span></div>
        </div>
        <div class="p-6">
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                <p id="modalPeriod" class="text-lg text-gray-800">-</p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Preview</label>
                <div id="modalReportBody"
                    class="bg-gray-50 rounded-lg p-4 border border-gray-200 text-gray-700 leading-relaxed">
                    -
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button id="btnExportPdf"
                    class="flex-1 px-4 py-2 rounded-lg border border-red-400 text-red-400 font-semibold hover:bg-red-50 transition-colors">Unduh
                    PDF</button>
                <button id="exportExcelBtn" onclick="exportCutiCsv()"
                    class="flex-1 px-4 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">Export
                    Excel</button>
                <button id="printReportBtn" onclick="printReport()"
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition-colors">Cetak</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        // Simple helper to build API paths (mirrors other views)
        function apiPath(path) {
            if (!path) return '';
            if (path.startsWith('/api/') || path.startsWith('/session/')) return window.location.origin + path;
            // fallback: relative to origin
            if (path.startsWith('/')) return window.location.origin + path;
            return window.location.origin + '/' + path.replace(/^[\/]+/, '');
        }

        function openReportModal(title, content, period) {
            document.getElementById('modalTitle').textContent = title;
            // support legacy simple content and the new report body
            try {
                document.getElementById('modalContent').textContent = content;
            } catch (e) {}
            document.getElementById('modalPeriod').textContent = period;

            const modal = document.getElementById('reportModal');
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                return;
            }

            // fallback: render into inline panel
            const panel = document.getElementById('cutiReportPanel');
            if (panel) {
                document.getElementById('modalTitle').textContent = title;
                try {
                    document.getElementById('modalReportBody').textContent = content;
                } catch (e) {}
                document.getElementById('modalPeriod').textContent = period;
                panel.classList.remove('hidden');
                setTimeout(() => {
                    panel.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 120);
            }
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                return;
            }
            const panel = document.getElementById('cutiReportPanel');
            if (panel) panel.classList.add('hidden');
        }

        // Fetch and render cuti report for selected period
        function openCutiReport() {
            const month = document.getElementById('reportMonthSelect')?.value || (new Date()).getMonth() + 1;
            const year = document.getElementById('reportYearSelect')?.value || (new Date()).getFullYear();
            const periodBy = document.getElementById('reportPeriodBy')?.value || 'tanggal_mulai';
            const period = monthName(month) + ' ' + year + ' (' + (periodBy === 'tanggal_persetujuan' ?
                'Berdasarkan Tanggal Persetujuan' : 'Berdasarkan Tanggal Mulai') + ')';
            document.getElementById('modalTitle').textContent = 'Preview Excel — Laporan Cuti';
            document.getElementById('modalPeriod').textContent = period;
            const body = document.getElementById('modalReportBody');
            body.textContent = 'Memuat...';
            // show inline panel and scroll to it
            const panel = document.getElementById('cutiReportPanel');
            if (panel) panel.classList.remove('hidden');
            setTimeout(() => {
                panel && panel.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 180);

            fetch(apiPath('/api/reports/cuti?month=' + month + '&year=' + year + '&period_by=' + periodBy), {
                    credentials: 'same-origin',
                    headers: getAuthHeaders()
                })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal memuat laporan');
                    return res.json();
                })
                .then(json => {
                    const data = json.data || [];
                    window._currentReportData = data;
                    window._currentReportPeriod = period;
                    window._currentReportPeriodBy = periodBy;
                    // show count in panel header
                    const c = document.getElementById('panelCount');
                    if (c) c.textContent = '(' + (data.length || 0) + ' baris)';
                    renderCutiTable(data);
                })
                .catch(err => {
                    console.error(err);
                    body.textContent = 'Gagal memuat data.';
                    if (typeof showToast === 'function') showToast('error', 'Gagal memuat data laporan.');
                });
        }

        function renderCutiTable(data) {
            const body = document.getElementById('modalReportBody');
            if (!body) return;
            if (!Array.isArray(data) || data.length === 0) {
                body.innerHTML =
                    '<div class="text-sm text-gray-600">Tidak ada data untuk periode ini. Coba ubah <strong>Sumber Periode</strong> menjadi "Berbasis Tanggal Persetujuan" jika Anda ingin melihat pengajuan yang baru saja disetujui.</div>';
                return;
            }

            // Excel-like preview toolbar (show record count)
            let html =
                '<div class="mb-3 flex items-center justify-between"><div class="text-sm text-gray-600">Sheet: <strong>Laporan Cuti</strong> <span class="text-xs text-gray-500">(' +
                data.length + ' baris)</span></div><div class="text-sm text-gray-500">Preview bergaya Excel</div></div>';

            html +=
                '<div class="overflow-x-auto bg-white rounded-md p-3 border border-gray-200"><table class="min-w-full text-sm border-collapse" style="border:1px solid #e5e7eb">';
            html +=
                '<thead><tr class="bg-gray-100 text-xs text-gray-700"><th class="px-3 py-2 border">No</th><th class="px-3 py-2 border">Nama</th><th class="px-3 py-2 border">Jenis</th><th class="px-3 py-2 border">Tanggal</th><th class="px-3 py-2 border">Durasi</th><th class="px-3 py-2 border">Pelimpahan</th><th class="px-3 py-2 border">Telp</th><th class="px-3 py-2 border">Keterangan</th></tr></thead><tbody>';

            data.forEach((row, idx) => {
                const pel = (row.dilimpahkan_ke && row.dilimpahkan_ke.length) ? row.dilimpahkan_ke.map(p => p.name +
                    (p.departemen ? ' — ' + p.departemen : '')).join('; ') : '-';
                const tanggal = (row.tanggal_mulai || '-') + (row.tanggal_selesai ? (' — ' + row.tanggal_selesai) :
                    '');
                html += '<tr class="even:bg-gray-50"><td class="px-3 py-2 align-top border">' + (idx + 1) +
                    '</td>' +
                    '<td class="px-3 py-2 align-top border">' + (row.user?.name || '-') + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + (row.jenis || '-') + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + tanggal + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + (row.durasi_hari || '-') + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + pel + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + (row.telp || '-') + '</td>' +
                    '<td class="px-3 py-2 align-top border">' + ((row.alasan || '').replace(/\n/g, ' ')) +
                    '</td></tr>';
            });
            html += '</tbody></table></div>';
            body.innerHTML = html;
        }

        function exportCutiCsv() {
            const data = window._currentReportData || [];
            if (!data.length) {
                alert('Tidak ada data untuk diexport.');
                return;
            }
            const periodLabel = window._currentReportPeriod || '';
            const periodBy = window._currentReportPeriodBy || document.getElementById('reportPeriodBy')?.value || '';
            const headers = ['No', 'Nama', 'Jenis', 'Tanggal Mulai', 'Tanggal Selesai', 'Durasi (hari)', 'Pelimpahan',
                'Telp', 'Alasan', 'Tanggal Persetujuan', 'Disetujui Oleh'
            ];
            const rows = data.map((r, idx) => [
                idx + 1,
                r.user?.name || '',
                r.jenis || '',
                r.tanggal_mulai || '',
                r.tanggal_selesai || '',
                r.durasi_hari || '',
                (r.dilimpahkan_ke || []).map(x => x.name).join('; '),
                r.telp || '',
                (r.alasan || '').replace(/\n/g, ' '),
                r.tanggal_persetujuan || '',
                r.disetujui_oleh?.name || ''
            ]);
            let csv = headers.join(',') + '\n';
            rows.forEach(r => {
                csv += r.map(c => '"' + String(c).replace(/"/g, '""') + '"').join(',') + '\n';
            });
            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            const safePeriod = (document.getElementById('modalPeriod')?.textContent || '').replace(/[^a-z0-9 _\-(),.]/gi,
                '').replace(/\s+/g, '_');
            const periodBySafe = (periodBy || window._currentReportPeriodBy || '').replace(/[^a-z0-9_\-]/gi, '');
            a.href = url;
            a.download = 'laporan_cuti_' + (periodBySafe ? (periodBySafe + '_') : '') + (safePeriod || 'report') + '.csv';
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(url);
        }

        function printReport() {
            const data = window._currentReportData || [];
            const html = [
                '<html><head><title>Laporan Cuti</title><style>body{font-family:Arial,Helvetica,sans-serif}h2{background:#ef4444;color:#fff;padding:12px;border-radius:6px}table{width:100%;border-collapse:collapse;margin-top:12px}th,td{border:1px solid #ddd;padding:8px;text-align:left}th{background:#f3f4f6}</style></head><body>'
            ];
            html.push('<h2>Laporan Cuti - ' + (document.getElementById('modalPeriod')?.textContent || '') + '</h2>');
            if (!data.length) {
                html.push('<p>Tidak ada data untuk periode ini.</p>');
            } else {
                html.push(
                    '<table><thead><tr><th>No</th><th>Nama</th><th>Jenis</th><th>Tanggal</th><th>Durasi</th><th>Pelimpahan</th></tr></thead><tbody>'
                );
                data.forEach((r, i) => {
                    const pel = (r.dilimpahkan_ke || []).map(x => x.name + (x.departemen ? ' — ' + x.departemen :
                        '')).join(', ');
                    const tanggal = (r.tanggal_mulai || '') + (r.tanggal_selesai ? (' — ' + r.tanggal_selesai) :
                        '');
                    html.push('<tr><td>' + (i + 1) + '</td><td>' + (r.user?.name || '') + '</td><td>' + (r.jenis ||
                            '') + '</td><td>' + tanggal + '</td><td>' + (r.durasi_hari || '') + '</td><td>' +
                        pel + '</td></tr>');
                });
                html.push('</tbody></table>');
            }
            html.push('</body></html>');
            const w = window.open('', '_blank');
            w.document.write(html.join(''));
            w.document.close();
            w.focus();
            setTimeout(() => {
                w.print();
            }, 500);
        }

        function monthName(m) {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            return months[(Number(m) || 1) - 1] || '';
        }

        function getAuthHeaders() {
            const headers = {
                'Accept': 'application/json'
            };
            const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (csrf) headers['X-CSRF-TOKEN'] = csrf;
            return headers;
        }

        // Keep existing close listeners
        // Removed modal backdrop & Escape-to-close behavior since report is now inline (panel)
        // (no additional listeners required)
    </script>
</x-app-layout>
