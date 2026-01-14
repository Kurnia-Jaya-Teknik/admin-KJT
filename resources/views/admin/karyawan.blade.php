<x-app-layout>
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
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
                        <input type="text" placeholder="Ketik nama lengkap karyawan" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK<span class="text-red-500">*</span></label>
                        <input type="text" placeholder="Nomor Identitas" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email<span class="text-red-500">*</span></label>
                        <input type="email" placeholder="email@company.com" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan<span class="text-red-500">*</span></label>
                        <input type="text" placeholder="Contoh: Staff Finance" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Departemen<span class="text-red-500">*</span></label>
                        <select required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            <option value="">-- Pilih Departemen --</option>
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP<span class="text-red-500">*</span></label>
                        <input type="tel" placeholder="0812xxxxxxxx" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Tanggal Bergabung -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Bergabung<span class="text-red-500">*</span></label>
                        <input type="date" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea placeholder="Alamat lengkap karyawan" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"></textarea>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-xs text-blue-800"><span class="font-semibold">Catatan:</span> Setelah penambahan, karyawan akan menerima email dengan link verifikasi dan instruksi setup password.</p>
                </div>
            </form>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3 sticky bottom-0">
                <button onclick="closeTambahModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:shadow-lg transition-all font-medium">Simpan Karyawan</button>
            </div>
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
                        <input type="text" placeholder="Nama lengkap"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- NIK (Readonly) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                        <input type="text" placeholder="Nomor Identitas"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed" readonly />
                        <p class="text-xs text-gray-500 mt-1">NIK tidak dapat diubah</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" placeholder="email@company.com"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan</label>
                        <input type="text" placeholder="Jabatan"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Departemen</label>
                        <select
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all">
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor HP</label>
                        <input type="tel" placeholder="0812xxxxxxxx"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Tanggal Bergabung -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Bergabung</label>
                        <input type="date"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all" />
                    </div>

                    <!-- Alamat -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                        <textarea placeholder="Alamat lengkap karyawan" rows="3"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all"></textarea>
                    </div>
                </div>
            </form>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3 sticky bottom-0">
                <button onclick="closeEditModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:shadow-lg transition-all font-medium">Simpan Perubahan</button>
            </div>
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
                <button
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
                <button
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Ya, Nonaktifkan Karyawan</button>
            </div>
        </div>
    </div>

    <script>
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

        function openEditModal(nik, nama) {
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openResetModal(nik) {
            document.getElementById('resetModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeResetModal() {
            document.getElementById('resetModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openDeactivateModal(nik) {
            document.getElementById('deactivateModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDeactivateModal() {
            document.getElementById('deactivateModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterDepartemen').value = '';
            document.getElementById('filterStatus').value = '';
        }

        // Close modal when clicking outside (scoped to .js-modal)
        document.querySelectorAll('.js-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.js-modal').forEach(m => {
                    if (!m.classList.contains('hidden')) {
                        m.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const nik = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const nama = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                
                if (nik.includes(query) || nama.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter functionality
        document.getElementById('filterDepartemen').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('filterStatus').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const deptFilter = document.getElementById('filterDepartemen').value.toLowerCase();
            const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const dept = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(6) span').textContent.toLowerCase();

                const deptMatch = !deptFilter || dept.includes(deptFilter);
                const statusMatch = !statusFilter || status.includes(statusFilter);

                row.style.display = deptMatch && statusMatch ? '' : 'none';
            });
        }

        // Show success message (optional)
        function showSuccessMessage(message) {
            const alert = document.createElement('div');
            alert.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in';
            alert.textContent = message;
            document.body.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 3000);
        }
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
</x-app-layout>
