<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Surat Resmi
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Manajemen Surat Resmi</h1>
                        <p class="text-gray-600 mt-1">Pengelolaan surat resmi yang disetujui direktur untuk diterbitkan</p>
                    </div>
                    <button onclick="openModalBuatSurat()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        + Buat Surat Baru
                    </button>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <div class="mb-6 border-b border-gray-200 flex gap-8">
                <button onclick="switchTab('permintaan')" id="tab-permintaan" class="px-4 py-3 border-b-2 border-indigo-600 text-indigo-600 font-semibold">Permintaan Disetujui</button>
                <button onclick="switchTab('daftar')" id="tab-daftar" class="px-4 py-3 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-medium">Daftar Surat Terbit</button>
            </div>

            <!-- TAB 1: Permintaan Surat Disetujui Direktur -->
            <div id="content-permintaan" class="block">
                <div class="mb-6 bg-white overflow-hidden shadow rounded-lg border border-blue-200 bg-blue-50 p-4">
                    <p class="text-sm text-blue-800"><strong>Informasi:</strong> Tampilan ini menunjukkan permintaan surat dari karyawan yang telah disetujui Direktur dan siap diterbitkan oleh Admin HRD.</p>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Karyawan atau Keperluan</label>
                            <input type="text" placeholder="Ketik nama karyawan..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Permintaan</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Semua Jenis</option>
                                <option value="cuti">Surat Cuti</option>
                                <option value="lembur">Surat Lembur</option>
                                <option value="surat">Surat Resmi</option>
                                <option value="lain">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Disetujui</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow border border-amber-200 p-4">
                        <p class="text-sm font-semibold text-amber-700">Menunggu Dibuat</p>
                        <p class="text-3xl font-bold text-amber-600 mt-2">12</p>
                    </div>
                    <div class="bg-white rounded-lg shadow border border-blue-200 p-4">
                        <p class="text-sm font-semibold text-blue-700">Sedang Diproses</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">3</p>
                    </div>
                    <div class="bg-white rounded-lg shadow border border-green-200 p-4">
                        <p class="text-sm font-semibold text-green-700">Telah Diterbitkan</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">28</p>
                    </div>
                </div>

                <!-- Queue Table -->
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jenis Permintaan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Keperluan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Disetujui Tgl</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <!-- Item 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Ahmad Rizki</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Cuti</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Cuti Tahunan 5 Hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">10 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu Dibuat</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="buatSurat('Ahmad Rizki', 'Cuti')" class="px-3 py-2 text-indigo-600 hover:text-indigo-700 font-medium text-sm hover:bg-indigo-50 rounded">Buat</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Item 2 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Siti Nurhaliza</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Lembur</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Lembur 8 Jam</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">12 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sedang Diproses</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="lanjutkanSurat('Siti Nurhaliza', 'Lembur')" class="px-3 py-2 text-gray-600 hover:text-gray-700 font-medium text-sm hover:bg-gray-50 rounded">Lanjutkan</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Item 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Budi Santoso</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Resmi</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Izin Keluar Jam Kerja</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">11 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu Dibuat</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="buatSurat('Budi Santoso', 'Resmi')" class="px-3 py-2 text-indigo-600 hover:text-indigo-700 font-medium text-sm hover:bg-indigo-50 rounded">Buat</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Item 4 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Rina Wijaya</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Cuti</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Cuti Sakit 3 Hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">13 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu Dibuat</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="buatSurat('Rina Wijaya', 'Cuti')" class="px-3 py-2 text-indigo-600 hover:text-indigo-700 font-medium text-sm hover:bg-indigo-50 rounded">Buat</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Item 5 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">Dedi Gunawan</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Cuti</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Cuti Tahunan 7 Hari</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">09 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Menunggu Dibuat</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="buatSurat('Dedi Gunawan', 'Cuti')" class="px-3 py-2 text-indigo-600 hover:text-indigo-700 font-medium text-sm hover:bg-indigo-50 rounded">Buat</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB 2: Daftar Surat Diterbitkan -->
            <div id="content-daftar" class="hidden">
                <div class="mb-6 bg-white overflow-hidden shadow rounded-lg border border-green-200 bg-green-50 p-4">
                    <p class="text-sm text-green-800"><strong>Informasi:</strong> Daftar surat resmi yang telah diterbitkan oleh Admin HRD. Surat ini tersedia untuk diambil karyawan dan dilaporkan ke Direktur.</p>
                </div>

                <!-- Filter Section -->
                <div class="bg-white rounded-lg shadow border border-gray-200 p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nomor Surat atau Karyawan</label>
                            <input type="text" placeholder="Cari..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option value="">Semua Jenis</option>
                                <option value="cuti">Surat Cuti</option>
                                <option value="lembur">Surat Lembur</option>
                                <option value="resmi">Surat Resmi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Terbit</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow border border-green-200 p-4">
                        <p class="text-sm font-semibold text-green-700">Total Surat Diterbitkan Bulan Ini</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">28</p>
                    </div>
                    <div class="bg-white rounded-lg shadow border border-blue-200 p-4">
                        <p class="text-sm font-semibold text-blue-700">Belum Diambil Karyawan</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">5</p>
                    </div>
                </div>

                <!-- Published Surat Table -->
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">No. Surat</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Karyawan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Tgl Terbit</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">SK-2026-001</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Cuti</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Ahmad Rizki</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">10 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Telah Diterbitkan</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Lihat</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">SK-2026-002</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Lembur</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Siti Nurhaliza</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">12 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Telah Diterbitkan</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Lihat</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">SK-2026-003</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Surat Resmi</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">Budi Santoso</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">11 Jan 2026</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Telah Diterbitkan</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex justify-center gap-2">
                                            <button class="text-indigo-600 hover:text-indigo-700 font-medium">Lihat</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Buat/Edit Surat -->
    <div id="modalSurat" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900">Buat Surat Resmi</h2>
                <button onclick="closeModalSurat()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="px-6 py-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
                        <input type="text" id="nomorSurat" placeholder="SK-2026-XXX (auto)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" disabled />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Surat</label>
                        <input type="date" id="tanggalSurat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                        <select id="jenisSurat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Pilih Jenis</option>
                            <option value="cuti">Surat Cuti</option>
                            <option value="lembur">Surat Lembur</option>
                            <option value="resmi">Surat Resmi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Untuk Karyawan</label>
                        <input type="text" id="karyawanSurat" placeholder="Nama karyawan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tujuan Surat</label>
                    <input type="text" placeholder="Ke Bank, Kantor Pos, dll..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Surat</label>
                    <textarea placeholder="Ketik isi surat di sini..." rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-mono text-sm"></textarea>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <button onclick="closeModalSurat()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">Batal</button>
                <button onclick="simpanSurat()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Terbitkan Surat</button>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            document.getElementById('content-permintaan').classList.add('hidden');
            document.getElementById('content-daftar').classList.add('hidden');
            
            document.getElementById('tab-permintaan').classList.remove('border-indigo-600', 'text-indigo-600');
            document.getElementById('tab-permintaan').classList.add('border-transparent', 'text-gray-600');
            document.getElementById('tab-daftar').classList.remove('border-indigo-600', 'text-indigo-600');
            document.getElementById('tab-daftar').classList.add('border-transparent', 'text-gray-600');
            
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).classList.add('border-indigo-600', 'text-indigo-600');
            document.getElementById('tab-' + tab).classList.remove('border-transparent', 'text-gray-600');
        }

        function openModalBuatSurat() {
            document.getElementById('modalSurat').classList.remove('hidden');
            document.getElementById('tanggalSurat').valueAsDate = new Date();
        }

        function closeModalSurat() {
            document.getElementById('modalSurat').classList.add('hidden');
        }

        function buatSurat(karyawan, jenis) {
            openModalBuatSurat();
            document.getElementById('karyawanSurat').value = karyawan;
            document.getElementById('jenisSurat').value = jenis.toLowerCase();
        }

        function lanjutkanSurat(karyawan, jenis) {
            buatSurat(karyawan, jenis);
        }

        function simpanSurat() {
            alert('Surat berhasil diterbitkan!');
            closeModalSurat();
            // Refresh table atau lakukan aksi lainnya
        }

        // Close modal when clicking outside
        document.getElementById('modalSurat')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModalSurat();
            }
        });
    </script>
</x-app-layout>
