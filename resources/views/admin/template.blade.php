<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Template Surat
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
            <!-- Header with Button -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Template Surat</h1>
                    <p class="text-gray-600 mt-1">Kelola template surat untuk mempercepat pembuatan</p>
                </div>
                <button onclick="openTambahTemplateModal()"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Template Baru
                </button>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Template</label>
                        <input type="text" placeholder="Ketik nama template..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Total Template</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">12</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Template Aktif</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">11</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <p class="text-sm text-gray-600">Digunakan Bulan Ini</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">36</p>
                </div>
            </div>

            <!-- Template List Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Template Card 1 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Keterangan Kerja</h3>
                            <p class="text-sm text-gray-600 mt-1">Template standar untuk surat keterangan kerja</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        Kepada Yth. [TUJUAN]

                        Dengan hormat,
                        Kami, [PERUSAHAAN] menerangkan bahwa [NAMA KARYAWAN] adalah karyawan kami...
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(1)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(1)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(1)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 2 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Pengajuan Cuti</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk pengajuan cuti resmi</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        PENGAJUAN CUTI

                        Nama Karyawan : [NAMA]
                        Jenis Cuti : [JENIS]
                        Tanggal Mulai : [TGL-MULAI]
                        Tanggal Selesai: [TGL-SELESAI]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(2)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(2)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(2)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 3 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Izin Sakit</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk surat izin sakit</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        SURAT IZIN SAKIT

                        Nama Karyawan : [NAMA]
                        Tanggal : [TANGGAL-SAKIT]
                        Keterangan : [KETERANGAN]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(3)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(3)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Nonaktifkan</button>
                        <button onclick="openDeleteTemplateModal(3)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>

                <!-- Template Card 4 -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Surat Rekomendasi</h3>
                            <p class="text-sm text-gray-600 mt-1">Template untuk surat rekomendasi kerja</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Nonaktif</span>
                    </div>

                    <div
                        class="bg-gray-50 rounded-lg p-4 mb-4 max-h-40 overflow-hidden text-xs font-mono text-gray-600 whitespace-pre-wrap line-clamp-6">
                        Nomor : [NOMOR-SURAT]
                        Tanggal : [TANGGAL]

                        Dengan hormat,
                        [ISI REKOMENDASI]
                    </div>

                    <div class="flex gap-2">
                        <button onclick="openEditTemplateModal(4)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Edit</button>
                        <button onclick="openToggleStatusModal(4)"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Aktifkan</button>
                        <button onclick="openDeleteTemplateModal(4)"
                            class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between mt-8">
                <p class="text-sm text-gray-600">Menampilkan 4 dari 12 template</p>
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

    <!-- Modal: Tambah Template -->
    <div id="tambahTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="tambahTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Template Surat Baru</h3>
                <button onclick="closeTambahTemplateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Template</label>
                        <input type="text" placeholder="Nama template"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih Jenis</option>
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                            <option value="lain">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Template</label>
                        <textarea placeholder="Ketik isi template..." rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"></textarea>
                        <p class="text-xs text-gray-500 mt-2">Gunakan [NAMA], [TANGGAL], [TUJUAN] sebagai placeholder
                            yang dapat diganti</p>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeTambahTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan
                    Template</button>
            </div>
        </div>
    </div>

    <!-- Modal: Edit Template -->
    <div id="editTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="editTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Edit Template</h3>
                <button onclick="closeEditTemplateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 max-h-96 overflow-y-auto">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Template</label>
                        <input type="text" placeholder="Nama template"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="kerja">Surat Keterangan Kerja</option>
                            <option value="cuti">Surat Pengajuan Cuti</option>
                            <option value="izin">Surat Izin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Isi Template</label>
                        <textarea placeholder="Ketik isi template..." rows="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"></textarea>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeEditTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan
                    Perubahan</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Toggle Status -->
    <div id="toggleStatusModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="toggleStatusModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Ubah Status Template?</h3>
                <p class="text-gray-600 text-center mb-6">Ubah status template aktif/nonaktif?</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeToggleStatusModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors font-medium">Ya,
                    Ubah Status</button>
            </div>
        </div>
    </div>

    <!-- Modal: Konfirmasi Hapus -->
    <div id="deleteTemplateModal"
        class="hidden js-modal fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
        data-modal-id="deleteTemplateModal">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">Hapus Template?</h3>
                <p class="text-gray-600 text-center mb-6">Template akan dihapus permanen. Aksi ini tidak dapat
                    dibatalkan.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button onclick="closeDeleteTemplateModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">Ya,
                    Hapus</button>
            </div>
        </div>
    </div>

    <script>
        function openTambahTemplateModal() {
            document.getElementById('tambahTemplateModal').classList.remove('hidden');
        }

        function closeTambahTemplateModal() {
            document.getElementById('tambahTemplateModal').classList.add('hidden');
        }

        function openEditTemplateModal(id) {
            document.getElementById('editTemplateModal').classList.remove('hidden');
        }

        function closeEditTemplateModal() {
            document.getElementById('editTemplateModal').classList.add('hidden');
        }

        function openToggleStatusModal(id) {
            document.getElementById('toggleStatusModal').classList.remove('hidden');
        }

        function closeToggleStatusModal() {
            document.getElementById('toggleStatusModal').classList.add('hidden');
        }

        function openDeleteTemplateModal(id) {
            document.getElementById('deleteTemplateModal').classList.remove('hidden');
        }

        function closeDeleteTemplateModal() {
            document.getElementById('deleteTemplateModal').classList.add('hidden');
        }

        // Close modal when clicking outside (scoped to .js-modal) and close on Escape
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
