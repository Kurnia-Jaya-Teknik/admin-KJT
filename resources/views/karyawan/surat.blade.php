<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Surat
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pengajuan -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Ajukan Surat Baru</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Jenis Surat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                            <select id="jenisSurat" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option selected disabled>Pilih jenis surat</option>
                                <option value="pkwt">PKWT (Perjanjian Kerja Waktu Tertentu)</option>
                                <option value="pkwtt">PKWTT (Perjanjian Kerja Waktu Tidak Tertentu)</option>
                                <option value="kerja">Surat Keterangan Kerja</option>
                                <option value="usaha">Surat Keterangan Usaha</option>
                                <option value="gaji">Surat Keterangan Gaji</option>
                                <option value="magang">Surat Balasan Magang</option>
                                <option value="lainnya">Surat Lainnya</option>
                            </select>
                        </div>

                        <!-- Tujuan Surat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Penggunaan</label>
                            <input type="text" placeholder="Misal: Bank, Instansi Pemerintah, dll" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Keterangan Tambahan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Tambahan (Opsional)</label>
                            <textarea rows="3" placeholder="Tambahkan keterangan jika diperlukan..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                        </div>

                        <!-- Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm text-blue-800">
                                <span class="font-medium">Catatan:</span> Surat akan diproses dalam waktu 1-2 hari kerja. Anda akan diberitahu melalui notifikasi ketika surat sudah siap diambil.
                            </p>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                Ajukan Surat
                            </button>
                            <button type="reset" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Jenis Surat</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-gray-600 font-medium mb-3">SURAT YANG TERSEDIA</p>
                        <ul class="space-y-2 text-xs text-gray-700">
                            <li class="flex gap-2">
                                <svg class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                <span><strong>PKWT/PKWTT</strong> - Surat Perjanjian</span>
                            </li>
                            <li class="flex gap-2">
                                <svg class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                <span><strong>Kerja/Usaha</strong> - Keterangan</span>
                            </li>
                            <li class="flex gap-2">
                                <svg class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                <span><strong>Gaji</strong> - Slip gaji & bukti</span>
                            </li>
                            <li class="flex gap-2">
                                <svg class="w-4 h-4 text-indigo-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                <span><strong>Magang</strong> - Balasan & sertifikat</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengajuan Surat -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Surat</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <!-- Item 1 - Ready -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Surat Keterangan Kerja</p>
                            <p class="text-sm text-gray-600 mt-1">Untuk keperluan bank</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diajukan: 3 Januari 2026</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Download</button>
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                    </div>
                </div>

                <!-- Item 2 - Processing -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Surat Keterangan Usaha</p>
                            <p class="text-sm text-gray-600 mt-1">Untuk instansi pemerintah</p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Diproses</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diajukan: 5 Januari 2026 • Estimasi selesai: 8 Jan</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                    </div>
                </div>

                <!-- Item 3 - Ready -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">Surat Keterangan Gaji</p>
                            <p class="text-sm text-gray-600 mt-1">Slip gaji Desember 2025</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diajukan: 28 Desember 2025</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Download</button>
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                    </div>
                </div>

                <!-- Item 4 - Ready -->
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="font-medium text-gray-800">PKWT (Kontrak Kerja)</p>
                            <p class="text-sm text-gray-600 mt-1">Periode 2025</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Siap Ambil</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3">Diajukan: 1 Januari 2026</p>
                    <div class="flex gap-2">
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Download</button>
                        <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
