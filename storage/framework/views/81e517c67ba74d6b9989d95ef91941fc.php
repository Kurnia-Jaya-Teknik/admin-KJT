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
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-4 md:p-6 lg:p-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-full">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Manajemen Karyawan</h1>
                        <p class="text-gray-600 mt-1 text-sm md:text-base">Kelola data dan informasi karyawan perusahaan</p>
                    </div>
                    <button onclick="openTambahModal()"
                        class="px-4 md:px-6 py-2 md:py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:shadow-lg transition-all font-medium flex items-center gap-2 self-start md:self-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span class="hidden sm:inline">Tambah Karyawan</span>
                        <span class="sm:hidden">Tambah</span>
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Karyawan</p>
                            <p class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">156</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Status Aktif</p>
                            <p class="text-2xl md:text-3xl font-bold text-green-600 mt-2">142</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Sedang Cuti</p>
                            <p class="text-2xl md:text-3xl font-bold text-yellow-600 mt-2">8</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10m7 8a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v12z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Nonaktif</p>
                            <p class="text-2xl md:text-3xl font-bold text-red-600 mt-2">6</p>
                        </div>
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6 mb-6">
                <div class="flex flex-col sm:flex-row gap-4 items-end">
                    <!-- Search Input -->
                    <div class="flex-1 min-w-0">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama atau NIK</label>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Ketik nama atau NIK..."
                                class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Filter Departemen -->
                    <div class="w-full sm:w-48">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                        <select id="filterDepartemen"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Departemen</option>
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div class="w-full sm:w-48">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="filterStatus"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <button onclick="resetFilters()"
                        class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                        Reset
                    </button>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <!-- Table Responsive Wrapper -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">NIK</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">Jabatan</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Departemen</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Email</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-4 md:px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <!-- Row 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">2024001</td>
                                <td class="px-4 md:px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                                        <p class="text-xs text-gray-500 md:hidden">Finance • Aktif</p>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">Staff Finance</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">Finance</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">budi.santoso@company.com</td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-1 flex-wrap">
                                        <button onclick="openEditModal('2024001', 'Budi Santoso')"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024001')"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024001')"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">2024002</td>
                                <td class="px-4 md:px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Ahmad Rizki</p>
                                        <p class="text-xs text-gray-500 md:hidden">Marketing • Aktif</p>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">Senior Marketing Manager</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">Marketing</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">ahmad.rizki@company.com</td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-1 flex-wrap">
                                        <button onclick="openEditModal('2024002', 'Ahmad Rizki')"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024002')"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024002')"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">2024003</td>
                                <td class="px-4 md:px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Siti Nurhaliza</p>
                                        <p class="text-xs text-gray-500 md:hidden">Operations • Cuti</p>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">Programmer</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">Operations</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">siti.nurhaliza@company.com</td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">Cuti</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-1 flex-wrap">
                                        <button onclick="openEditModal('2024003', 'Siti Nurhaliza')"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024003')"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024003')"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">2024004</td>
                                <td class="px-4 md:px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Rina Wijaya</p>
                                        <p class="text-xs text-gray-500 md:hidden">HR • Aktif</p>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">HR Specialist</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">Human Resources</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">rina.wijaya@company.com</td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-1 flex-wrap">
                                        <button onclick="openEditModal('2024004', 'Rina Wijaya')"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024004')"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024004')"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">2024005</td>
                                <td class="px-4 md:px-6 py-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Dedi Gunawan</p>
                                        <p class="text-xs text-gray-500 md:hidden">Operations • Nonaktif</p>
                                    </div>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">Operations Manager</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">Operations</td>
                                <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">dedi.gunawan@company.com</td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">Nonaktif</span>
                                </td>
                                <td class="px-4 md:px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-1 flex-wrap">
                                        <button onclick="openEditModal('2024005', 'Dedi Gunawan')"
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024005')"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024005')"
                                            class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <p class="text-sm text-gray-600">Menampilkan <span class="font-semibold">5</span> dari <span class="font-semibold">156</span> karyawan</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50 font-medium text-sm"
                        disabled>← Sebelumnya</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Berikutnya →</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Tambah Karyawan -->
    <div id="tambahModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="tambahModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-red-100 flex items-center justify-between sticky top-0">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Tambah Karyawan Baru</h3>
                    <p class="text-xs text-gray-600 mt-1">Isi semua data yang diperlukan untuk menambah karyawan baru</p>
                </div>
                <button onclick="closeTambahModal()" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Lengkap -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap<span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="Ketik nama lengkap karyawan" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK<span class="text-red-500">*</span></label>
                        <input type="text" name="nik" placeholder="Nomor Identitas" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email<span class="text-red-500">*</span></label>
                        <input type="email" name="email" placeholder="email@company.com" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan<span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" placeholder="Contoh: Staff Finance" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Departemen<span class="text-red-500">*</span></label>
                        <select name="departemen_id" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            <option value="">-- Pilih Departemen --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = App\Models\Departemen::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP<span class="text-red-500">*</span></label>
                        <input type="tel" name="phone" placeholder="0812xxxxxxxx" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Tanggal Bergabung -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Bergabung<span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_bergabung" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" placeholder="Alamat lengkap karyawan" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"></textarea>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-xs text-blue-800"><span class="font-semibold">Catatan:</span> Setelah penambahan, karyawan akan menerima email dengan link verifikasi dan instruksi setup password.</p>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeTambahModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:shadow-lg transition-all font-medium">Simpan Karyawan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Edit Karyawan -->
    <div id="editModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="editModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-50 to-red-100 flex items-center justify-between sticky top-0">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Edit Data Karyawan</h3>
                    <p class="text-xs text-gray-600 mt-1">Perbarui informasi karyawan di bawah ini</p>
                </div>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Nama Lengkap -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Nama lengkap"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- NIK (Readonly) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                        <input type="text" name="nik" placeholder="Nomor Identitas"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed" readonly />
                        <p class="text-xs text-gray-500 mt-1">NIK tidak dapat diubah</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="email@company.com"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" placeholder="Jabatan"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Departemen</label>
                        <select name="departemen_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            <option value="">-- Pilih Departemen --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = App\Models\Departemen::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                        <input type="tel" name="phone" placeholder="0812xxxxxxxx"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea name="alamat" placeholder="Alamat lengkap karyawan" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:shadow-lg transition-all font-medium">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal: Konfirmasi Reset -->
    <div id="resetModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="resetModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
            <div class="p-8">
                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Reset Akses Karyawan?</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">Password akan direset ke password default dan 2FA akan dihapus. Karyawan perlu setup ulang password pada login berikutnya.</p>
                
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg mb-6">
                    <p class="text-xs text-yellow-800"><span class="font-semibold">Perhatian:</span> Karyawan harus segera setup password baru untuk keamanan akun.</p>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeResetModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button onclick="confirmReset()"
                    class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors font-medium">Ya, Reset Akses</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Nonaktifkan -->
    <div id="deactivateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="deactivateModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
            <div class="p-8">
                <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4v2m0 5v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Nonaktifkan Karyawan?</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">Karyawan tidak akan bisa login dan mengakses sistem. Data historis tetap tersimpan dan dapat diaktifkan kembali di kemudian hari.</p>
                
                <div class="p-4 bg-red-50 border border-red-200 rounded-lg mb-6">
                    <p class="text-xs text-red-800"><span class="font-semibold">Aksi ini tidak dapat dibatalkan:</span> Pastikan Anda yakin sebelum melanjutkan.</p>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeDeactivateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button onclick="confirmDeactivate()"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Ya, Nonaktifkan Karyawan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Aktifkan -->
    <div id="activateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="activateModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
            <div class="p-8">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Aktifkan Karyawan?</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">Karyawan akan dapat login dan mengakses sistem kembali dengan akun yang sama.</p>
                
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg mb-6">
                    <p class="text-xs text-green-800"><span class="font-semibold">Informasi:</span> Akses karyawan akan dipulihkan sepenuhnya.</p>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeActivateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button onclick="confirmActivate()"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium">Ya, Aktifkan Karyawan</button>
            </div>
        </div>
    </div>

    <div id="leaveModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="leaveModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
            <div class="p-8">
                <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Tandai Sedang Cuti?</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">Karyawan akan ditandai sedang cuti. Akses sistem akan dibatasi untuk karyawan cuti.</p>
                
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg mb-6">
                    <p class="text-xs text-yellow-800"><span class="font-semibold">Informasi:</span> Status karyawan akan berubah menjadi "Sedang Cuti".</p>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeLeaveModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button onclick="confirmLeave()"
                    class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors font-medium">Ya, Tandai Cuti</button>
            </div>
        </div>
    </div>

    <div id="returnFromLeaveModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="returnFromLeaveModal">
        <div class="bg-white rounded-lg shadow-2xl max-w-md w-full">
            <div class="p-8">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.646 7.23a2 2 0 01-1.789 1.106H5a2 2 0 01-2-2V8a2 2 0 012-2h1.05a2 2 0 011.664.89l1.812 2.71a2 2 0 001.664.89h2.41m-9.653-4h6.06a2 2 0 011.995 2.129V15M9 19h3m0 0h3" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 text-center mb-2">Kembali dari Cuti?</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">Karyawan akan kembali ke status aktif dan dapat mengakses sistem kembali.</p>
                
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg mb-6">
                    <p class="text-xs text-blue-800"><span class="font-semibold">Informasi:</span> Status karyawan akan berubah menjadi "Aktif".</p>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeReturnFromLeaveModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button onclick="confirmReturnFromLeave()"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">Ya, Kembali Aktif</button>
            </div>
        </div>
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let currentKaryawanId = null;
        let scrollPosition = 0;  // Track scroll position untuk maintain view

        // Load karyawan data on page load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('✅ DOM loaded, initializing...');
            loadKaryawanData();
            attachFormHandlers();
            attachEventDelegation();
            attachSearchFilters();
        });

        // Attach event delegation for dynamic buttons
        function attachEventDelegation() {
            console.log('🔗 Attaching event delegation...');
            const tbody = document.querySelector('tbody');
            if (!tbody) {
                console.error('❌ tbody not found!');
                return;
            }

            tbody.addEventListener('click', function(e) {
                const btn = e.target.closest('button[data-action]');
                if (!btn) return;

                const action = btn.getAttribute('data-action');
                const karyawanId = btn.getAttribute('data-id');

                console.log('✓ Button clicked:', action, 'ID:', karyawanId);

                if (action === 'edit') openEditModal(karyawanId);
                else if (action === 'reset') openResetModal(karyawanId);
                else if (action === 'deactivate') openDeactivateModal(karyawanId);
                else if (action === 'activate') openActivateModal(karyawanId);
                else if (action === 'leave') openLeaveModal(karyawanId);
                else if (action === 'return-leave') openReturnFromLeaveModal(karyawanId);
            });
            console.log('✓ Event delegation ready');
        }

        // Attach search and filter listeners
        function attachSearchFilters() {
            console.log('🔍 Attaching search/filter listeners...');
            
            const searchInput = document.getElementById('searchInput');
            const filterDept = document.getElementById('filterDepartemen');
            const filterStatus = document.getElementById('filterStatus');

            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    console.log('🔎 Search changed:', e.target.value);
                    const search = e.target.value.trim();
                    const dept = filterDept?.value || '';
                    const status = filterStatus?.value || '';
                    loadKaryawanData(search, dept, status);
                });
                console.log('✓ Search listener attached');
            } else {
                console.error('❌ searchInput not found!');
            }

            if (filterDept) {
                filterDept.addEventListener('change', function(e) {
                    console.log('🏢 Department filter changed:', e.target.value);
                    const search = searchInput?.value?.trim() || '';
                    const dept = e.target.value;
                    const status = filterStatus?.value || '';
                    loadKaryawanData(search, dept, status);
                });
                console.log('✓ Department filter listener attached');
            }

            if (filterStatus) {
                filterStatus.addEventListener('change', function(e) {
                    console.log('📊 Status filter changed:', e.target.value);
                    const search = searchInput?.value?.trim() || '';
                    const dept = filterDept?.value || '';
                    const status = e.target.value;
                    loadKaryawanData(search, dept, status);
                });
                console.log('✓ Status filter listener attached');
            }
        }

        // Load karyawan data from API
        async function loadKaryawanData(search = '', departemen = '', status = '') {
            try {
                let url = '/admin/karyawan/list';
                const params = new URLSearchParams();
                
                if (search && search.trim()) params.append('search', search.trim());
                if (departemen && departemen.trim()) params.append('departemen', departemen.trim());
                if (status && status.trim()) params.append('status', status.trim());
                
                const queryString = params.toString();
                if (queryString) url += '?' + queryString;

                console.log('📡 Fetching:', url);

                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    }
                });

                console.log('📊 Response status:', response.status);

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('❌ API error:', response.status, errorText.substring(0, 200));
                    throw new Error(`API Error: ${response.status}`);
                }

                const responseText = await response.text();
                console.log('📝 Raw response length:', responseText.length);

                let karyawan = [];
                try {
                    karyawan = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                    console.error('Response:', responseText.substring(0, 300));
                    throw new Error('Invalid JSON response');
                }

                console.log('✅ Loaded', karyawan.length, 'karyawan');

                // Update table
                updateKaryawanTable(karyawan);
                
                // Update stats
                updateStats(karyawan);

                // Restore scroll position after a short delay to allow DOM to settle
                setTimeout(() => {
                    window.scrollTo(0, scrollPosition);
                    console.log('↩️ Scrolled back to:', scrollPosition);
                }, 100);
            } catch (error) {
                console.error('❌ Load error:', error.message);
                showMessage('❌ Gagal memuat data: ' + error.message, 'error');
            }
        }

        // Update table with karyawan data
        function updateKaryawanTable(karyawan) {
            const tbody = document.querySelector('tbody');
            if (!tbody) return;

            if (karyawan.length === 0) {
                tbody.innerHTML = `<tr><td colspan="7" class="text-center px-6 py-8 text-gray-500">Tidak ada data karyawan</td></tr>`;
                return;
            }

            tbody.innerHTML = karyawan.map(k => `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 md:px-6 py-4 text-sm font-medium text-gray-900">${k.nik || '-'}</td>
                    <td class="px-4 md:px-6 py-4">
                        <div>
                            <p class="text-sm font-medium text-gray-900">${k.name}</p>
                            <p class="text-xs text-gray-500 md:hidden">${k.departemen?.nama || '-'} • ${k.status}</p>
                        </div>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden md:table-cell">${k.jabatan || '-'}</td>
                    <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">${k.departemen?.nama || '-'}</td>
                    <td class="px-4 md:px-6 py-4 text-sm text-gray-600 hidden lg:table-cell">${k.email}</td>
                    <td class="px-4 md:px-6 py-4 text-sm">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold ${getStatusBadgeClass(k.status)}">${capitalizeFirst(k.status)}</span>
                    </td>
                    <td class="px-4 md:px-6 py-4 text-sm">
                        <div class="flex justify-center gap-1 flex-wrap">
                            <button type="button" data-action="edit" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors">Edit</button>
                            <button type="button" data-action="reset" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-50 rounded transition-colors">Reset</button>
                            ${k.status === 'aktif' ? `
                            <button type="button" data-action="leave" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-yellow-600 hover:bg-yellow-50 rounded transition-colors">Cuti</button>
                            <button type="button" data-action="deactivate" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors">Nonaktif</button>
                            ` : k.status === 'cuti' ? `
                            <button type="button" data-action="return-leave" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50 rounded transition-colors">Aktif</button>
                            <button type="button" data-action="deactivate" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-50 rounded transition-colors">Nonaktif</button>
                            ` : `
                            <button type="button" data-action="activate" data-id="${k.id}"
                                class="px-3 py-1.5 text-xs font-medium text-green-600 hover:bg-green-50 rounded transition-colors">Aktifkan</button>
                            `}
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // Update stats cards
        function updateStats(karyawan) {
            const total = karyawan.length;
            const aktif = karyawan.filter(k => k.status === 'aktif').length;
            const cuti = karyawan.filter(k => k.status === 'cuti').length;
            const nonaktif = karyawan.filter(k => k.status === 'nonaktif').length;

            const statCards = document.querySelectorAll('.grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-4 > div');
            if (statCards.length >= 4) {
                statCards[0].querySelector('p:last-child').textContent = total;
                statCards[1].querySelector('p:last-child').textContent = aktif;
                statCards[2].querySelector('p:last-child').textContent = cuti;
                statCards[3].querySelector('p:last-child').textContent = nonaktif;
            }
        }

        // Get status badge CSS class
        function getStatusBadgeClass(status) {
            const classes = {
                'aktif': 'bg-green-100 text-green-800',
                'cuti': 'bg-yellow-100 text-yellow-800',
                'nonaktif': 'bg-gray-100 text-gray-800'
            };
            return classes[status] || classes.aktif;
        }

        // Capitalize first letter
        function capitalizeFirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        // Attach form handlers
        function attachFormHandlers() {
            console.log('🔧 Attaching form handlers...');
            
            // Tambah form
            const tambahForm = document.querySelector('#tambahModal form');
            if (tambahForm) {
                tambahForm.removeEventListener('submit', handleTambahSubmit);
                tambahForm.addEventListener('submit', handleTambahSubmit);
                console.log('✓ Tambah form handler attached');
            } else {
                console.error('❌ Tambah form not found!');
            }

            // Edit form
            const editForm = document.querySelector('#editModal form');
            if (editForm) {
                editForm.removeEventListener('submit', handleEditSubmit);
                editForm.addEventListener('submit', handleEditSubmit);
                console.log('✓ Edit form handler attached');
            } else {
                console.error('❌ Edit form not found!');
            }
        }

        async function handleTambahSubmit(e) {
            e.preventDefault();
            console.log('📝 Tambah form submitted');
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);
            await saveTambahKaryawan(e.target);
        }

        async function handleEditSubmit(e) {
            e.preventDefault();
            console.log('✏️ Edit form submitted');
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);
            await saveEditKaryawan(e.target);
        }

        // Save tambah karyawan
        async function saveTambahKaryawan(form) {
            console.log('💾 Starting save tambah karyawan...');
            
            const formData = new FormData(form);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                nik: formData.get('nik'),
                jabatan: formData.get('jabatan'),
                departemen_id: parseInt(formData.get('departemen_id')) || null,
                phone: formData.get('phone'),
                alamat: formData.get('alamat'),
                tanggal_bergabung: formData.get('tanggal_bergabung'),
            };

            console.log('📋 Data to save:', data);

            // Validate required fields
            if (!data.name || !data.email || !data.nik || !data.jabatan || !data.departemen_id || !data.phone || !data.tanggal_bergabung) {
                console.error('❌ Validation failed - missing required fields');
                showMessage('⚠️ Semua field yang ditandai (*) wajib diisi!', 'error');
                return;
            }

            try {
                console.log('📤 POSTing to /admin/karyawan...');
                const response = await fetch('/admin/karyawan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                console.log('Response Status:', response.status);

                // Read response text first
                const responseText = await response.text();
                console.log('Raw Response:', responseText.substring(0, 300));

                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON Parse Error:', e.message);
                    console.error('Response text:', responseText);
                }

                console.log('Parsed Result:', result);

                if (!response.ok) {
                    const errorMsg = result.message || result.error || 'Gagal menambah karyawan';
                    console.error('❌ API Error:', errorMsg);
                    throw new Error(errorMsg);
                }

                console.log('✅ Karyawan saved successfully:', result);
                showMessage('✅ Karyawan berhasil ditambahkan!', 'success');
                closeTambahModal();
                form.reset();
                
                // Reload data dengan delay
                setTimeout(() => {
                    loadKaryawanData();
                }, 500);
            } catch (error) {
                console.error('❌ Save error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        // Save edit karyawan
        async function saveEditKaryawan(form) {
            if (!currentKaryawanId) {
                console.error('❌ currentKaryawanId is null');
                showMessage('ID tidak valid', 'error');
                return;
            }

            console.log('💾 Starting save edit karyawan ID:', currentKaryawanId);

            const formData = new FormData(form);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                jabatan: formData.get('jabatan'),
                departemen_id: parseInt(formData.get('departemen_id')) || null,
                phone: formData.get('phone'),
                alamat: formData.get('alamat'),
            };

            console.log('📋 Data to update:', data);

            try {
                console.log('📤 PUTing to /admin/karyawan/' + currentKaryawanId);
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                console.log('Response Status:', response.status);

                const responseText = await response.text();
                console.log('Raw Response:', responseText.substring(0, 300));

                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON Parse Error:', e.message);
                }

                if (!response.ok) {
                    const errorMsg = result.message || result.error || 'Gagal memperbarui';
                    console.error('❌ API Error:', errorMsg);
                    throw new Error(errorMsg);
                }

                console.log('✅ Karyawan updated successfully');
                showMessage('✅ Data karyawan berhasil diperbarui!', 'success');
                closeEditModal();
                
                setTimeout(() => {
                    loadKaryawanData();
                }, 500);
            } catch (error) {
                console.error('❌ Update error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        // Modal Management Functions
        function openTambahModal() {
            const modal = document.getElementById('tambahModal');
            modal.classList.remove('hidden');
            modal.querySelector('form').reset();
            document.body.style.overflow = 'hidden';
        }

        function closeTambahModal() {
            document.getElementById('tambahModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        async function openEditModal(id) {
            currentKaryawanId = id;
            console.log('Opening edit modal for:', id);
            
            try {
                const response = await fetch(`/admin/karyawan/${id}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf
                    }
                });

                if (!response.ok) throw new Error('Gagal memuat data');
                const karyawan = await response.json();

                console.log('Loaded karyawan:', karyawan);

                // Fill form
                const form = document.querySelector('#editModal form');
                form.querySelector('input[name="name"]').value = karyawan.name;
                form.querySelector('input[name="email"]').value = karyawan.email;
                form.querySelector('input[name="nik"]').value = karyawan.nik || '';
                form.querySelector('input[name="jabatan"]').value = karyawan.jabatan || '';
                form.querySelector('select[name="departemen_id"]').value = karyawan.departemen_id || '';
                form.querySelector('input[name="phone"]').value = karyawan.phone || '';
                form.querySelector('textarea[name="alamat"]').value = karyawan.alamat || '';

                document.getElementById('editModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } catch (error) {
                console.error('Edit error:', error);
                showMessage(error.message, 'error');
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function openResetModal(id) {
            currentKaryawanId = id;
            console.log('Opening reset modal for:', id);
            document.getElementById('resetModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeResetModal() {
            document.getElementById('resetModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function confirmReset() {
            if (!currentKaryawanId) return;

            console.log('🔄 Resetting password for:', currentKaryawanId);
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);

            try {
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}/reset-password`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });

                const responseText = await response.text();
                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                }

                if (!response.ok) throw new Error(result.message || 'Gagal mereset password');

                console.log('✅ Password reset successful');
                showMessage('✅ Password berhasil direset! Temp: ' + result.temp_password, 'success');
                closeResetModal();
                setTimeout(() => loadKaryawanData(), 500);
            } catch (error) {
                console.error('❌ Reset error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        async function openDeactivateModal(id) {
            currentKaryawanId = id;
            console.log('🚫 Opening deactivate modal for:', id);
            document.getElementById('deactivateModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeactivateModal() {
            console.log('Closing deactivate modal');
            document.getElementById('deactivateModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function confirmDeactivate() {
            if (!currentKaryawanId) return;

            console.log('⏸️ Deactivating:', currentKaryawanId);
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);

            try {
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}/deactivate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });

                const responseText = await response.text();
                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                }

                if (!response.ok) throw new Error(result.message || 'Gagal menonaktifkan');

                console.log('✅ Deactivate successful');
                showMessage('✅ Karyawan berhasil dinonaktifkan!', 'success');
                closeDeactivateModal();
                setTimeout(() => loadKaryawanData(), 500);
            } catch (error) {
                console.error('❌ Deactivate error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        async function openActivateModal(id) {
            currentKaryawanId = id;
            console.log('✅ Opening activate modal for:', id);
            document.getElementById('activateModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeActivateModal() {
            console.log('Closing activate modal');
            document.getElementById('activateModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function confirmActivate() {
            if (!currentKaryawanId) return;

            console.log('✅ Activating:', currentKaryawanId);
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);

            try {
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}/activate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });

                const responseText = await response.text();
                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                }

                if (!response.ok) throw new Error(result.message || 'Gagal mengaktifkan');

                console.log('✅ Activate successful');
                showMessage('✅ Karyawan berhasil diaktifkan!', 'success');
                closeActivateModal();
                setTimeout(() => loadKaryawanData(), 500);
            } catch (error) {
                console.error('❌ Activate error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        async function openLeaveModal(id) {
            currentKaryawanId = id;
            console.log('✅ Opening leave modal for:', id);
            document.getElementById('leaveModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLeaveModal() {
            console.log('Closing leave modal');
            document.getElementById('leaveModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function confirmLeave() {
            if (!currentKaryawanId) return;

            console.log('✅ Setting leave status for:', currentKaryawanId);
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);

            try {
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}/set-leave`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });

                const responseText = await response.text();
                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                }

                if (!response.ok) throw new Error(result.message || 'Gagal mengatur cuti');

                console.log('✅ Leave status set successful');
                showMessage('✅ Karyawan berhasil ditandai cuti!', 'success');
                closeLeaveModal();
                setTimeout(() => loadKaryawanData(), 500);
            } catch (error) {
                console.error('❌ Leave status error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        async function openReturnFromLeaveModal(id) {
            currentKaryawanId = id;
            console.log('✅ Opening return from leave modal for:', id);
            document.getElementById('returnFromLeaveModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeReturnFromLeaveModal() {
            console.log('Closing return from leave modal');
            document.getElementById('returnFromLeaveModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentKaryawanId = null;
        }

        async function confirmReturnFromLeave() {
            if (!currentKaryawanId) return;

            console.log('✅ Returning from leave for:', currentKaryawanId);
            scrollPosition = window.scrollY;  // Save scroll position
            console.log('📍 Saved scroll position:', scrollPosition);

            try {
                const response = await fetch(`/admin/karyawan/${currentKaryawanId}/return-from-leave`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                });

                const responseText = await response.text();
                let result = {};
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error('❌ JSON parse error:', e.message);
                }

                if (!response.ok) throw new Error(result.message || 'Gagal mengembalikan dari cuti');

                console.log('✅ Return from leave successful');
                showMessage('✅ Karyawan berhasil kembali aktif!', 'success');
                closeReturnFromLeaveModal();
                setTimeout(() => loadKaryawanData(), 500);
            } catch (error) {
                console.error('❌ Return from leave error:', error.message);
                showMessage('❌ Gagal: ' + error.message, 'error');
            }
        }

        function resetFilters() {
            console.log('🔄 Resetting filters');
            document.getElementById('searchInput').value = '';
            document.getElementById('filterDepartemen').value = '';
            document.getElementById('filterStatus').value = '';
            loadKaryawanData();
        }

        // Close modal when clicking outside
        document.querySelectorAll('.js-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    console.log('Closing modal via outside click');
                    this.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                console.log('Closing modals via Escape key');
                document.querySelectorAll('.js-modal').forEach(m => {
                    if (!m.classList.contains('hidden')) {
                        m.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }
        });

        // Show message helper
        function showMessage(message, type = 'success') {
            const bgClass = type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
            const alert = document.createElement('div');
            alert.className = `fixed top-4 right-4 border px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in ${bgClass}`;
            alert.textContent = message;
            document.body.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 4000);
        }

        console.log('=== SCRIPT INITIALIZATION COMPLETE ===');
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Custom scrollbar untuk modal */
        .js-modal::-webkit-scrollbar {
            width: 8px;
        }

        .js-modal::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .js-modal::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .js-modal::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
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
<?php /**PATH C:\xampp5\htdocs\admin-KJT\resources\views/admin/karyawan.blade.php ENDPATH**/ ?>