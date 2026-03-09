<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Surat Keterangan Diterima
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50/50 min-h-full">

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">📬 Surat Keterangan Diterima</h1>
                                    <p class="text-gray-600 text-sm mt-1">Daftar surat keterangan yang telah dikirim
                                        admin kepada Anda</p>
                                </div>
                                <a href="{{ route('karyawan.surat-keterangan.request.index') }}"
                                    class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow-md">
                                    📋 Ajukan Permintaan
                                </a>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                <div
                                    class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-green-700 font-medium mb-1">Total Surat Diterima</p>
                                            <p class="text-3xl font-bold text-green-900" id="totalSurat">0</p>
                                        </div>
                                        <div class="p-3 bg-green-200 rounded-full">
                                            <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-blue-700 font-medium mb-1">Bulan Ini</p>
                                            <p class="text-3xl font-bold text-blue-900" id="bulanIni">0</p>
                                        </div>
                                        <div class="p-3 bg-blue-200 rounded-full">
                                            <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-lg p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-purple-700 font-medium mb-1">Surat Terbaru</p>
                                            <p class="text-3xl font-bold text-purple-900" id="suratTerbaru">-</p>
                                        </div>
                                        <div class="p-3 bg-purple-200 rounded-full">
                                            <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Filter & Search -->
                            <div class="mb-6 flex gap-3">
                                <div class="flex-1">
                                    <input type="text" id="searchInput" placeholder="🔍 Cari nomor surat, jabatan..."
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                                </div>
                                <button onclick="loadSuratList()"
                                    class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all text-sm">
                                    🔄 Refresh
                                </button>
                            </div>

                            <!-- Table Container -->
                            <div id="tableContainer" class="overflow-x-auto">
                                <div class="flex items-center justify-center py-12">
                                    <div class="text-center">
                                        <div
                                            class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4">
                                        </div>
                                        <p class="text-gray-500">Memuat data...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Empty State Template (hidden, used by JS) -->
                            <template id="emptyStateTemplate">
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Surat Diterima</h3>
                                    <p class="text-gray-600 mb-6">Anda belum menerima surat keterangan dari admin</p>
                                    <a href="{{ route('karyawan.surat-keterangan.request.index') }}"
                                        class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-sm">
                                        📋 Ajukan Permintaan Surat
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
                <script>
                    let allSuratData = [];

                    // Load surat list
                    function loadSuratList() {
                        const container = document.getElementById('tableContainer');

                        fetch('/karyawan/surat-keterangan-received')
                            .then(r => r.json())
                            .then(data => {
                                if (!data.ok || data.data.length === 0) {
                                    const template = document.getElementById('emptyStateTemplate');
                                    container.innerHTML = template.innerHTML;
                                    updateStats(0, 0, '-');
                                    return;
                                }

                                allSuratData = data.data;
                                renderTable(allSuratData);
                                calculateStats(allSuratData);
                            })
                            .catch(e => {
                                container.innerHTML = `
                        <div class="text-center py-12">
                            <p class="text-red-600 font-semibold mb-2">❌ Error loading data</p>
                            <p class="text-gray-500 text-sm">${e.message}</p>
                            <button onclick="loadSuratList()" class="mt-4 px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                🔄 Coba Lagi
                            </button>
                        </div>
                    `;
                            });
                    }

                    // Render surat list dengan card design - konsisten dengan halaman lain
                    function renderTable(suratList) {
                        const container = document.getElementById('tableContainer');

                        if (suratList.length === 0) {
                            container.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada hasil pencarian</p>';
                            return;
                        }

                        container.innerHTML = `
                            <div class="bg-gray-50/30 rounded-xl border border-gray-200/50 shadow-sm overflow-hidden">
                                ${suratList.map(surat => {
                                    // Status styling - konsisten dengan desain standar
                                    const isSent = surat.is_sent;
                                    const statusColor = isSent ? 'emerald' : 'amber';
                                    const statusBg = isSent ? 'bg-emerald-50/60' : 'bg-amber-50/60';
                                    const statusBorder = isSent ? 'border-emerald-200/50' : 'border-amber-200/50';
                                    const statusIcon = isSent ? '✓' : '⏳';
                                    const statusLabel = isSent ? 'Diterima' : 'Pending';

                                    // Action buttons
                                    const actionButtons = isSent ? `
                                        <a href="${surat.file_url}" target="_blank" class="text-sm text-emerald-600/90 hover:text-emerald-700 font-medium transition-colors group-hover:font-bold">
                                            Lihat Detail →
                                        </a>
                                        <a href="${surat.download_url}" download class="text-sm text-blue-600/90 hover:text-blue-700 font-medium transition-colors group-hover:font-bold ml-3">
                                            📥 Download
                                        </a>
                                    ` : `
                                        <span class="text-sm text-gray-500">Menunggu pengiriman</span>
                                    `;

                                    return `
                                        <div class="bg-white/60 backdrop-blur-sm p-5 hover:bg-white/90 transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                                            <div class="flex items-start gap-4">
                                                <div class="w-12 h-12 rounded-xl ${statusBg} ${statusBorder} border flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 text-lg font-semibold text-${statusColor}-600">
                                                    ${statusIcon}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-3 mb-2">
                                                        <div>
                                                            <p class="text-base font-semibold text-gray-800">📄 ${surat.nomor_surat}</p>
                                                            <p class="text-sm text-gray-500 mt-1">${surat.keterangan || 'Surat Keterangan'}</p>
                                                        </div>
                                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-${statusColor}-100/70 text-${statusColor}-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">${statusLabel}</span>
                                                    </div>
                                                    <div class="space-y-1 mb-3">
                                                        <p class="text-sm text-gray-600">👤 ${surat.jabatan}</p>
                                                        <p class="text-sm text-gray-600">🏢 ${surat.unit_kerja}</p>
                                                        <p class="text-sm text-gray-600">📅 ${surat.tanggal_surat}</p>
                                                        ${isSent ? `<p class="text-sm text-emerald-600 font-medium">📬 Dikirim: ${surat.sent_at}</p>` : ''}
                                                    </div>
                                                    <div class="flex items-center gap-3 mt-3">
                                                        ${actionButtons}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        `;
                    }

                    // Calculate stats
                    function calculateStats(suratList) {
                        const total = suratList.length;

                        // Bulan ini
                        const now = new Date();
                        const thisMonth = suratList.filter(s => {
                            const sentDate = new Date(s.sent_at);
                            return sentDate.getMonth() === now.getMonth() && sentDate.getFullYear() === now.getFullYear();
                        }).length;

                        // Terbaru
                        const latest = suratList.length > 0 ? suratList[0].sent_at : '-';

                        updateStats(total, thisMonth, latest);
                    }

                    // Update stats display
                    function updateStats(total, bulanIni, terbaru) {
                        document.getElementById('totalSurat').textContent = total;
                        document.getElementById('bulanIni').textContent = bulanIni;
                        document.getElementById('suratTerbaru').textContent = terbaru;
                    }

                    // Search functionality
                    document.getElementById('searchInput')?.addEventListener('input', function(e) {
                        const searchTerm = e.target.value.toLowerCase();

                        if (!searchTerm) {
                            renderTable(allSuratData);
                            return;
                        }

                        const filtered = allSuratData.filter(surat =>
                            surat.nomor_surat.toLowerCase().includes(searchTerm) ||
                            surat.jabatan.toLowerCase().includes(searchTerm) ||
                            surat.unit_kerja.toLowerCase().includes(searchTerm) ||
                            (surat.keterangan && surat.keterangan.toLowerCase().includes(searchTerm))
                        );

                        renderTable(filtered);
                    });

                    // Load on page ready
                    document.addEventListener('DOMContentLoaded', loadSuratList);
                </script>
            @endpush
        </div>
    </div>
    </div>
</x-app-layout>
