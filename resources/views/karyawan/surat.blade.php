<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Surat
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gradient-to-br from-slate-50/80 via-blue-50/20 to-purple-50/10 min-h-full">
        <!-- Welcome Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Surat Saya</h1>
            <p class="text-sm text-gray-500">Ajukan dan kelola surat resmi Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pengajuan -->
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-blue-50/20 via-indigo-50/20 to-purple-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Ajukan Surat Baru</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-5">
                            <!-- Jenis Surat -->
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Jenis Surat</label>
                                <select id="jenisSurat"
                                    class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-300/50 transition-all duration-300 text-sm">
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
                                <label class="block text-xs font-medium text-gray-600 mb-2">Tujuan Penggunaan</label>
                                <input type="text" placeholder="Misal: Bank, Instansi Pemerintah, dll"
                                    class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-300/50 transition-all duration-300 text-sm">
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Keterangan Tambahan (Opsional)</label>
                                <textarea rows="3" placeholder="Tambahkan keterangan jika diperlukan..."
                                    class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-300/50 transition-all duration-300 text-sm resize-none"></textarea>
                            </div>

                            <!-- Info -->
                            <div class="bg-gradient-to-r from-blue-50/40 to-indigo-50/30 border border-blue-200/30 rounded-xl p-4">
                                <div class="flex items-start gap-3">
                                    <div class="p-1.5 bg-blue-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        <span class="font-medium text-gray-700">Catatan:</span> Surat akan diproses dalam waktu 1-2 hari kerja. Anda akan diberitahu melalui notifikasi ketika surat sudah siap diambil.
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="flex gap-3 pt-2">
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-400 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-500 shadow-sm hover:shadow-md transition-all duration-300 text-sm">
                                    Ajukan Surat
                                </button>
                                <button type="reset"
                                    class="flex-1 px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-blue-50/20 to-indigo-50/20">
                        <h3 class="text-sm font-semibold text-gray-800">Jenis Surat</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Surat yang Tersedia</p>
                            <ul class="space-y-2.5 text-xs text-gray-600">
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400/60 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-700">PKWT/PKWTT</strong> - Surat Perjanjian</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400/60 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-700">Kerja/Usaha</strong> - Keterangan</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400/60 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-700">Gaji</strong> - Slip gaji & bukti</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <div class="w-1.5 h-1.5 rounded-full bg-blue-400/60 mt-1.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-700">Magang</strong> - Balasan & sertifikat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pengajuan Surat -->
            <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-blue-50/20 to-purple-50/20">
                    <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Surat</h3>
                </div>
                <div class="divide-y divide-gray-100/50">
                    <!-- Item 1 - Ready -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Kerja</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Untuk keperluan bank</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: 3 Januari 2026</p>
                                <div class="flex gap-3">
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Download →</button>
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 - Processing -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-blue-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50/60 to-blue-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Usaha</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Untuk instansi pemerintah</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-blue-50/70 text-blue-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Diproses</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: 5 Januari 2026 • Estimasi selesai: 8 Jan</p>
                                <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 - Ready -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">Surat Keterangan Gaji</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Slip gaji Desember 2025</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: 28 Desember 2025</p>
                                <div class="flex gap-3">
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Download →</button>
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 - Ready -->
                    <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                        <div class="flex items-start gap-3 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                <svg class="w-5 h-5 text-green-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-1.5">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">PKWT (Kontrak Kerja)</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Periode 2025</p>
                                    </div>
                                    <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Siap Ambil</span>
                                </div>
                                <p class="text-xs text-gray-400 mb-2">Diajukan: 1 Januari 2026</p>
                                <div class="flex gap-3">
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Download →</button>
                                    <button class="text-xs text-blue-500/80 hover:text-blue-600/80 font-medium transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
