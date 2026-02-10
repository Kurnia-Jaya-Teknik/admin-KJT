<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Surat Keterangan Diterima
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                            <p class="text-gray-600 text-sm mt-1">Daftar surat keterangan yang telah dikirim admin kepada Anda</p>
                        </div>
                        <a href="<?php echo e(route('karyawan.surat-keterangan.request.index')); ?>" 
                            class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow-md">
                            📋 Ajukan Permintaan
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-green-700 font-medium mb-1">Total Surat Diterima</p>
                                    <p class="text-3xl font-bold text-green-900" id="totalSurat">0</p>
                                </div>
                                <div class="p-3 bg-green-200 rounded-full">
                                    <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-blue-700 font-medium mb-1">Bulan Ini</p>
                                    <p class="text-3xl font-bold text-blue-900" id="bulanIni">0</p>
                                </div>
                                <div class="p-3 bg-blue-200 rounded-full">
                                    <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-lg p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-purple-700 font-medium mb-1">Surat Terbaru</p>
                                    <p class="text-3xl font-bold text-purple-900" id="suratTerbaru">-</p>
                                </div>
                                <div class="p-3 bg-purple-200 rounded-full">
                                    <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter & Search -->
                    <div class="mb-6 flex gap-3">
                        <div class="flex-1">
                            <input type="text" id="searchInput" 
                                placeholder="🔍 Cari nomor surat, jabatan..."
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
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
                                <p class="text-gray-500">Memuat data...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State Template (hidden, used by JS) -->
                    <template id="emptyStateTemplate">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Surat Diterima</h3>
                            <p class="text-gray-600 mb-6">Anda belum menerima surat keterangan dari admin</p>
                            <a href="<?php echo e(route('karyawan.surat-keterangan.request.index')); ?>" 
                                class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all shadow-sm">
                                📋 Ajukan Permintaan Surat
                            </a>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
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

        // Render table
        function renderTable(suratList) {
            const container = document.getElementById('tableContainer');
            
            if (suratList.length === 0) {
                container.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada hasil pencarian</p>';
                return;
            }

            const tableHTML = `
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Surat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Unit Kerja</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Surat</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Diterima</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">File</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        ${suratList.map((surat, index) => `
                            <tr class="hover:bg-gray-50 transition-colors ${index % 2 === 0 ? 'bg-white' : 'bg-gray-50/50'}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">📄</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">${surat.nomor_surat}</div>
                                            <div class="text-xs text-gray-500">${surat.keterangan || '-'}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">${surat.jabatan}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-700">${surat.unit_kerja}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-700">${surat.tanggal_surat}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            ${surat.sent_at}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="${surat.file_url}" target="_blank" 
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-xs font-semibold rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Lihat
                                        </a>
                                        <a href="${surat.download_url}" download
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            `;
            
            container.innerHTML = tableHTML;
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
    <?php $__env->stopPush(); ?>
        </div>
    </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/karyawan/surat-keterangan.blade.php ENDPATH**/ ?>