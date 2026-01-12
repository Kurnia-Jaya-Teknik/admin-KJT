<x-app-layout>
    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header with Tambah Button -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Data Karyawan</h1>
                    <p class="text-gray-600 mt-1">Total: 156 karyawan aktif</p>
                </div>
                <button onclick="openTambahModal()"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Karyawan
                </button>
            </div>

            <!-- Search & Filter -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama atau NIK</label>
                        <input type="text" placeholder="Ketik nama atau NIK..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Departemen -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Departemen</option>
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                            <option value="cuti">Cuti</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Jabatan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Departemen</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <!-- Row 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2024001</td>
                                <td class="px-6 py-4 text-sm text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Staff Finance</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Finance</td>
                                <td class="px-6 py-4 text-sm text-gray-600">budi.santoso@company.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal('2024001', 'Budi Santoso')"
                                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024001')"
                                            class="text-amber-600 hover:text-amber-700 font-medium transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024001')"
                                            class="text-red-600 hover:text-red-700 font-medium transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2024002</td>
                                <td class="px-6 py-4 text-sm text-gray-800">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Senior Marketing Manager</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Marketing</td>
                                <td class="px-6 py-4 text-sm text-gray-600">ahmad.rizki@company.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal('2024002', 'Ahmad Rizki')"
                                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024002')"
                                            class="text-amber-600 hover:text-amber-700 font-medium transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024002')"
                                            class="text-red-600 hover:text-red-700 font-medium transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2024003</td>
                                <td class="px-6 py-4 text-sm text-gray-800">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Programmer</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Operations</td>
                                <td class="px-6 py-4 text-sm text-gray-600">siti.nurhaliza@company.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cuti</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal('2024003', 'Siti Nurhaliza')"
                                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024003')"
                                            class="text-amber-600 hover:text-amber-700 font-medium transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024003')"
                                            class="text-red-600 hover:text-red-700 font-medium transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2024004</td>
                                <td class="px-6 py-4 text-sm text-gray-800">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">HR Specialist</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Human Resources</td>
                                <td class="px-6 py-4 text-sm text-gray-600">rina.wijaya@company.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal('2024004', 'Rina Wijaya')"
                                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024004')"
                                            class="text-amber-600 hover:text-amber-700 font-medium transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024004')"
                                            class="text-red-600 hover:text-red-700 font-medium transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">2024005</td>
                                <td class="px-6 py-4 text-sm text-gray-800">Dedi Gunawan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Operations Manager</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Operations</td>
                                <td class="px-6 py-4 text-sm text-gray-600">dedi.gunawan@company.com</td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Nonaktif</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex justify-center gap-2">
                                        <button onclick="openEditModal('2024005', 'Dedi Gunawan')"
                                            class="text-indigo-600 hover:text-indigo-700 font-medium transition-colors"
                                            title="Edit">Edit</button>
                                        <button onclick="openResetModal('2024005')"
                                            class="text-amber-600 hover:text-amber-700 font-medium transition-colors"
                                            title="Reset">Reset</button>
                                        <button onclick="openDeactivateModal('2024005')"
                                            class="text-red-600 hover:text-red-700 font-medium transition-colors"
                                            title="Nonaktifkan">Nonaktif</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-6">
                <p class="text-sm text-gray-600">Menampilkan 5 dari 156 karyawan</p>
                <div class="flex gap-2">
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50"
                        disabled>Sebelumnya</button>
                    <button
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">Berikutnya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Tambah Karyawan -->
    <div id="tambahModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="tambahModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Karyawan Baru</h3>
                <button onclick="closeTambahModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="Nama lengkap"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                        <input type="text" placeholder="Nomor Identitas Karyawan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" placeholder="email@company.com"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" placeholder="Jabatan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih Departemen</option>
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                        <input type="text" placeholder="0812xxxxxxxx"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                        <input type="date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeTambahModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Edit Karyawan -->
    <div id="editModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="editModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Edit Data Karyawan</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <p class="text-sm text-gray-600 mb-4">Edit informasi karyawan di bawah ini</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" placeholder="Nama lengkap"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                        <input type="text" placeholder="Nomor Identitas Karyawan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            disabled />
                    </div>
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" placeholder="email@company.com"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" placeholder="Jabatan"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="finance">Finance</option>
                            <option value="marketing">Marketing</option>
                            <option value="ops">Operations</option>
                            <option value="hr">Human Resources</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                        <input type="text" placeholder="0812xxxxxxxx"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Bergabung</label>
                        <input type="date"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeEditModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Reset -->
    <div id="resetModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="resetModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Reset Akses Karyawan?</h3>
                <p class="text-gray-600 text-center mb-6">Password akan direset ke default dan 2FA akan dihapus.
                    Karyawan perlu setup ulang password pada login berikutnya.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeResetModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">Ya,
                    Reset</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Nonaktifkan -->
    <div id="deactivateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="deactivateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Nonaktifkan Karyawan?</h3>
                <p class="text-gray-600 text-center mb-6">Karyawan tidak akan bisa login dan mengakses sistem. Data
                    historis tetap tersimpan.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeDeactivateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Ya,
                    Nonaktifkan</button>
            </div>
        </div>
        </div>
    </div>

    <script>
        function openTambahModal() {
            document.getElementById('tambahModal').classList.remove('hidden');
        }

        function closeTambahModal() {
            document.getElementById('tambahModal').classList.add('hidden');
        }

        function openEditModal(nik, nama) {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openResetModal(nik) {
            document.getElementById('resetModal').classList.remove('hidden');
        }

        function closeResetModal() {
            document.getElementById('resetModal').classList.add('hidden');
        }

        function openDeactivateModal(nik) {
            document.getElementById('deactivateModal').classList.remove('hidden');
        }

        function closeDeactivateModal() {
            document.getElementById('deactivateModal').classList.add('hidden');
        }

        // Close modal when clicking outside (scoped to .js-modal) and close on Escape key
        document.querySelectorAll('.js-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.js-modal').forEach(m => m.classList.add('hidden'));
            }
        });
    </script>
</x-app-layout>
