<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Cuti') }}
        </h2>
    </x-slot>

    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Laporan Cuti</h3>
                    <p class="text-sm text-gray-600 mb-4">Pilih sumber periode, bulan, dan tahun lalu klik "Lihat" untuk
                        melihat preview bergaya Excel.</p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
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
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m === now()->month ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <select id="reportYearSelect"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm">
                                @for ($y = now()->year - 2; $y <= now()->year + 1; $y++)
                                    <option value="{{ $y }}" {{ $y === now()->year ? 'selected' : '' }}>
                                        {{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button id="btnOpenCutiReport" onclick="openCutiReport()"
                            class="px-3 py-2 rounded-lg border border-purple-400 text-purple-400 font-semibold hover:bg-purple-50 transition-colors">Lihat</button>
                        <button id="exportExcelBtnTop" onclick="exportCutiCsv()"
                            class="px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50 transition-colors">Export
                            Excel</button>
                    </div>
                </div>

                <div id="cutiReportPage" class="hidden bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <h4 class="font-semibold">Preview Excel — Laporan Cuti <span id="panelCountSmall"
                                    class="text-sm text-gray-500 ml-2"></span></h4>
                            <div class="relative">
                                <input id="cutiSearchInput" placeholder="Cari nama, jenis, alasan, departemen..."
                                    class="px-3 py-2 border rounded-lg text-sm w-64" />
                                <button id="cutiSearchClear" class="absolute right-1 top-1 text-sm text-gray-500 hidden"
                                    type="button">✕</button>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button id="btnPrintPdf" onclick="printReport()"
                                class="px-3 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50">Cetak
                                PDF</button>
                            <button onclick="exportCutiCsv()"
                                class="px-3 py-2 rounded-lg border border-emerald-400 text-emerald-400 font-semibold hover:bg-emerald-50">Export
                                CSV</button>
                        </div>
                    </div>

                    <div id="cutiReportPageBody"
                        class="overflow-x-auto bg-white rounded-md p-3 border border-gray-200 min-h-[120px]">
                        <div class="text-sm text-gray-600">Belum ada data. Silakan pilih periode lalu klik
                            <strong>Lihat</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // helper
            function apiPath(path) {
                if (!path) return '';
                if (path.startsWith('/api/') || path.startsWith('/session/')) return window.location.origin + path;
                if (path.startsWith('/')) return window.location.origin + path;
                return window.location.origin + '/' + path.replace(/^[\/]+/, '');
            }

            function getAuthHeaders() {
                const headers = {
                    'Accept': 'application/json'
                };
                const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                if (csrf) headers['X-CSRF-TOKEN'] = csrf;
                return headers;
            }

            function monthName(m) {
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ];
                return months[(Number(m) || 1) - 1] || '';
            }

            window.openCutiReport = function() {
                const month = document.getElementById('reportMonthSelect').value;
                const year = document.getElementById('reportYearSelect').value;
                const periodBy = document.getElementById('reportPeriodBy').value;
                const period = monthName(month) + ' ' + year + ' (' + (periodBy === 'tanggal_persetujuan' ?
                    'Berdasarkan Tanggal Persetujuan' : 'Berdasarkan Tanggal Mulai') + ')';

                const body = document.getElementById('cutiReportPageBody');
                body.textContent = 'Memuat...';
                fetch(apiPath('/api/reports/cuti?month=' + month + '&year=' + year + '&period_by=' + periodBy), {
                        headers: getAuthHeaders(),
                        credentials: 'same-origin'
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal memuat');
                        return res.json();
                    })
                    .then(json => {
                        const data = json.data || [];
                        window._currentReportData = data;
                        document.getElementById('panelCountSmall').textContent = '(' + (data.length || 0) + ' baris)';
                        renderCutiPageTable(data);
                        document.getElementById('cutiReportPage').classList.remove('hidden');
                        setTimeout(() => document.getElementById('cutiReportPage').scrollIntoView({
                            behavior: 'smooth'
                        }), 150);
                        // if ?export=csv present, trigger export after load
                        const params = new URLSearchParams(window.location.search);
                        if (params.get('export') === 'csv') exportCutiCsv();

                        // initialize search bindings
                        setupCutiSearch();

                    })
                    .catch(err => {
                        console.error(err);
                        body.innerHTML = '<div class="text-sm text-red-600">Gagal memuat data.</div>';
                    });
            }

            // Auto-run if URL contains query params
            document.addEventListener('DOMContentLoaded', function() {
                const params = new URLSearchParams(window.location.search);
                const month = params.get('month');
                const year = params.get('year');
                const periodBy = params.get('period_by');
                if (month) document.getElementById('reportMonthSelect').value = month;
                if (year) document.getElementById('reportYearSelect').value = year;
                if (periodBy) document.getElementById('reportPeriodBy').value = periodBy;

                // open sidebar reports menu and highlight cuti link
                try {
                    const reportsMenu = document.getElementById('reportsMenu');
                    const icon = document.getElementById('reportsMenuIcon');
                    if (reportsMenu && reportsMenu.classList.contains('hidden')) {
                        reportsMenu.classList.remove('hidden');
                        if (icon) icon.classList.add('rotate-180');
                    }
                    const link = document.getElementById('sidebarReportCutiLink');
                    if (link) {
                        link.classList.add('bg-gray-100', 'text-gray-900');
                        link.scrollIntoView({
                            block: 'center'
                        });
                    }
                } catch (e) {
                    /* ignore */
                }

                if (month || year || periodBy) {
                    setTimeout(() => window.openCutiReport(), 120);
                }
            });

            function setupCutiSearch() {
                const input = document.getElementById('cutiSearchInput');
                const clear = document.getElementById('cutiSearchClear');
                let timer = null;
                if (!input) return;
                input.addEventListener('input', function(e) {
                    const q = (input.value || '').trim().toLowerCase();
                    if (clear) clear.classList.toggle('hidden', !q);
                    if (timer) clearTimeout(timer);
                    timer = setTimeout(() => applyCutiFilter(q), 250);
                });
                if (clear) clear.addEventListener('click', function() {
                    input.value = '';
                    clear.classList.add('hidden');
                    applyCutiFilter('');
                });
            }

            function applyCutiFilter(q) {
                try {
                    if (!q) {
                        window._currentFilteredReportData = null;
                        renderCutiPageTable(window._currentReportData || []);
                        return;
                    }
                    const src = window._currentReportData || [];
                    const filtered = src.filter(r => {
                        const hay = [(r.user?.name || ''), (r.jenis || ''), (r.alasan || ''), (r.telp || ''), ((r
                            .dilimpahkan_ke || []).map(x => x.name).join(' '))].join(' ').toLowerCase();
                        return hay.indexOf(q) !== -1;
                    });
                    window._currentFilteredReportData = filtered;
                    renderCutiPageTable(filtered);
                } catch (e) {
                    console.debug('applyCutiFilter', e);
                }
            }

            // adapt export & print to use filtered data if available
            function exportCutiCsv() {
                const data = window._currentFilteredReportData || window._currentReportData || [];
                if (!data.length) {
                    alert('Tidak ada data untuk diexport.');
                    return;
                }
                const headers = ['No', 'Nama', 'Divisi', 'Jenis', 'Tanggal Mulai', 'Tanggal Selesai', 'Durasi (hari)',
                    'Pelimpahan',
                    'Telp', 'Alasan', 'Tanggal Persetujuan', 'Disetujui Oleh'
                ];
                const rows = data.map((r, idx) => [idx + 1, r.user?.name || '', r.user?.departemen || '', r.jenis || '', r
                    .tanggal_mulai || '', r
                    .tanggal_selesai || '', r.durasi_hari || '', (r.dilimpahkan_ke || []).map(x => x.name).join('; '), r
                    .telp || '', (r.alasan || '').replace(/\n/g, ' '), r.tanggal_persetujuan || '', r.disetujui_oleh
                    ?.name || ''
                ]);

                // Use semicolon delimiter (better for Excel in many locales) and add UTF-8 BOM so Excel detects UTF-8
                const delimiter = ';';
                const escapeCell = (v) => '"' + String(v).replace(/"/g, '""') + '"';
                let csv = headers.join(delimiter) + '\n';
                rows.forEach(r => csv += r.map(c => escapeCell(c)).join(delimiter) + '\n');

                const bom = '\uFEFF';
                const blob = new Blob([bom + csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                // sanitize filename: replace spaces and parentheses
                const raw = (document.getElementById('panelCountSmall')?.textContent || 'report').replace(/[()\s]+/g, '_')
                    .replace(/[^a-zA-Z0-9_\-\.]/g, '');
                a.download = 'laporan_cuti_' + raw + '.csv';
                document.body.appendChild(a);
                a.click();
                a.remove();
                URL.revokeObjectURL(url);
            }

            function printReport() {
                // Use server-side PDF generation (Dompdf) to produce a professional A4 landscape PDF.
                const month = document.getElementById('reportMonthSelect')?.value || '';
                const year = document.getElementById('reportYearSelect')?.value || '';
                const periodBy = document.getElementById('reportPeriodBy')?.value || '';
                const q = (document.getElementById('cutiSearchInput')?.value || '').trim();
                const url = new URL('{{ route('direktur.laporan.cuti.pdf') }}', window.location.origin);
                if (month) url.searchParams.set('month', month);
                if (year) url.searchParams.set('year', year);
                if (periodBy) url.searchParams.set('period_by', periodBy);
                if (q) url.searchParams.set('q', q);
                window.open(url.toString(), '_blank');
            }

            function renderCutiPageTable(data) {
                const body = document.getElementById('cutiReportPageBody');
                if (!Array.isArray(data) || data.length === 0) {
                    body.innerHTML = '<div class="text-sm text-gray-600">Tidak ada data untuk periode ini.</div>';
                    return;
                }
                let html =
                    '<div class="overflow-x-auto"><table class="min-w-full text-sm border-collapse" style="border:1px solid #e5e7eb; table-layout:fixed">';
                html +=
                    '<colgroup><col style="width:40px"><col style="width:140px"><col style="width:120px"><col style="width:140px"><col style="width:160px"><col style="width:70px"><col style="width:140px"><col style="width:120px"><col></colgroup>';
                html +=
                    '<thead><tr class="bg-gray-100 text-xs text-gray-700"><th class="px-3 py-2 border">No</th><th class="px-3 py-2 border">Nama</th><th class="px-3 py-2 border">Divisi</th><th class="px-3 py-2 border">Jenis</th><th class="px-3 py-2 border">Tanggal</th><th class="px-3 py-2 border">Durasi</th><th class="px-3 py-2 border">Pelimpahan</th><th class="px-3 py-2 border">Telp</th><th class="px-3 py-2 border">Keterangan</th></tr></thead><tbody>';
                data.forEach((row, idx) => {
                    const pel = (row.dilimpahkan_ke && row.dilimpahkan_ke.length) ? row.dilimpahkan_ke.map(p => p.name +
                        (p.departemen ? ' — ' + p.departemen : '')).join('; ') : '-';
                    const tanggal = (row.tanggal_mulai || '-') + (row.tanggal_selesai ? (' — ' + row.tanggal_selesai) :
                        '');
                    html += '<tr class="even:bg-gray-50"><td class="px-3 py-2 align-top border">' + (idx + 1) +
                        '</td>' +
                        '<td class="px-3 py-2 align-top border">' + (row.user?.name || '-') + '</td>' +
                        '<td class="px-3 py-2 align-top border">' + (row.user?.departemen || '-') + '</td>' +
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

            // Duplicate exportCutiCsv removed; the canonical implementation above uses UTF-8 BOM and semicolon delimiter.

            function printReport() {
                const data = window._currentFilteredReportData || window._currentReportData || [];
                const html = [
                    '<html><head><title>Laporan Cuti</title><style>body{font-family:Arial,Helvetica,sans-serif}h2{background:#ef4444;color:#fff;padding:12px;border-radius:6px}table{width:100%;border-collapse:collapse;margin-top:12px}th,td{border:1px solid #ddd;padding:8px;text-align:left}th{background:#f3f4f6}</style></head><body>'
                ];
                html.push('<h2>Laporan Cuti - ' + (document.querySelector('#reportMonthSelect option:checked')?.textContent ||
                    '') + ' ' + (document.getElementById('reportYearSelect')?.value || '') + '</h2>');
                if (!data.length) {
                    html.push('<p>Tidak ada data untuk periode ini.</p>');
                } else {
                    html.push(
                        '<table><thead><tr><th>No</th><th>Nama</th><th>Divisi</th><th>Jenis</th><th>Tanggal</th><th>Durasi</th><th>Pelimpahan</th></tr></thead><tbody>'
                    );
                    data.forEach((r, i) => {
                        const pel = (r.dilimpahkan_ke || []).map(x => x.name + (x.departemen ? ' — ' + x.departemen :
                            '')).join(', ');
                        const tanggal = (r.tanggal_mulai || '') + (r.tanggal_selesai ? (' — ' + r.tanggal_selesai) :
                            '');
                        html.push('<tr><td>' + (i + 1) + '</td><td>' + (r.user?.name || '') + '</td><td>' + (r.user
                                ?.departemen || '') + '</td><td>' + (r.jenis ||
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
                setTimeout(() => w.print(), 500);
            }
        </script>
    @endpush
</x-app-layout>
