<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengajuan Lembur
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-slate-50/80 via-red-50/20 to-red-50/15 min-h-full">
        <!-- Welcome Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Pengajuan Lembur</h1>
            <p class="text-sm text-gray-500">Ajukan jam kerja tambahan untuk pekerjaan yang mendesak</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Pengajuan -->
            <div class="lg:col-span-2 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/40 overflow-hidden hover:shadow-md transition-all duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-slate-50/20 via-red-50/20 to-red-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Ajukan Lembur Baru</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-5">
                        <!-- Tanggal Lembur -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2.5">Tanggal Lembur</label>
                            <input type="date" class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                        </div>

                        <!-- Jam Mulai & Selesai -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Jam Mulai</label>
                                <input type="time" class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-2.5">Jam Selesai</label>
                                <input type="time" class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm text-gray-700">
                            </div>
                        </div>

                        <!-- Total Jam -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2.5">Total Jam Lembur</label>
                            <div class="px-4 py-2.5 bg-gradient-to-r from-slate-50/40 to-red-50/30 border border-slate-200/30 rounded-xl">
                                <p class="text-gray-700 font-semibold text-sm">5 jam</p>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">Otomatis terhitung dari jam mulai dan selesai</p>
                        </div>

                        <!-- Keterangan Pekerjaan -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2.5">Keterangan Pekerjaan</label>
                            <textarea rows="4" placeholder="Jelaskan pekerjaan apa yang akan dilakukan selama lembur..." class="w-full px-4 py-2.5 bg-white/70 border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-slate-400/40 focus:border-slate-300/60 transition-all duration-300 text-sm resize-none text-gray-700 placeholder-gray-400"></textarea>
                        </div>

                        <!-- Info -->
                        <div class="bg-gradient-to-r from-slate-50/40 to-red-50/30 border border-slate-200/30 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <div class="p-1.5 bg-slate-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-slate-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    <span class="font-medium text-gray-700">Catatan:</span> Lembur hanya bisa diajukan maksimal 3 jam per hari dan memerlukan persetujuan dari direktur.
                                </p>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-slate-500 to-slate-400 text-white font-medium rounded-xl hover:from-slate-600 hover:to-slate-500 shadow-sm hover:shadow-md transition-all duration-300 text-sm">
                                Ajukan Lembur
                            </button>
                            <button type="reset" class="flex-1 px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-slate-50/20 to-red-50/20">
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Lembur</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-2">Total Lembur Bulan Ini</p>
                        <p class="text-2xl font-semibold bg-gradient-to-r from-slate-500/80 to-slate-400/70 bg-clip-text text-transparent">12 jam</p>
                        <p class="text-xs text-gray-500 mt-2">Dari 6 pengajuan</p>
                    </div>
                    <div class="border-t border-gray-100/50 pt-5">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wide mb-3">Kebijakan Lembur</p>
                        <ul class="space-y-2.5 text-xs text-gray-600">
                            <li class="flex items-start gap-2.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-400/70 mt-1.5 flex-shrink-0"></div>
                                <span class="leading-relaxed">Max 3 jam per hari</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-400/70 mt-1.5 flex-shrink-0"></div>
                                <span class="leading-relaxed">Max 20 jam per bulan</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-400/70 mt-1.5 flex-shrink-0"></div>
                                <span class="leading-relaxed">Lembur hari libur prioritas rendah</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <div class="w-1.5 h-1.5 rounded-full bg-slate-400/70 mt-1.5 flex-shrink-0"></div>
                                <span class="leading-relaxed">Persetujuan dari direktur</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengajuan Lembur -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-slate-50/20 via-red-50/20 to-red-50/15">
                <h3 class="text-sm font-semibold text-gray-800">Riwayat Pengajuan Lembur</h3>
            </div>
            <div class="divide-y divide-gray-100/50">
                <!-- Item 1 - Approved -->
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-1.5">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Lembur • 5 jam</p>
                                    <p class="text-xs text-gray-500 mt-0.5">6 Januari 2026 • 18:00 - 23:00</p>
                                </div>
                                <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                            </div>
                            <p class="text-xs text-gray-400 mb-2">Pekerjaan: Menyelesaikan laporan project X</p>
                            <button class="text-xs text-slate-600/90 hover:text-slate-700 font-medium transition-colors">Lihat Detail →</button>
                        </div>
                    </div>
                </div>

                <!-- Item 2 - Approved -->
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-1.5">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Lembur • 3 jam</p>
                                    <p class="text-xs text-gray-500 mt-0.5">3 Januari 2026 • 19:00 - 22:00</p>
                                </div>
                                <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                            </div>
                            <p class="text-xs text-gray-400 mb-2">Pekerjaan: Database maintenance</p>
                            <button class="text-xs text-slate-600/90 hover:text-slate-700 font-medium transition-colors">Lihat Detail →</button>
                        </div>
                    </div>
                </div>

                <!-- Item 3 - Pending -->
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-1.5">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Lembur • 4 jam</p>
                                    <p class="text-xs text-gray-500 mt-0.5">2 Januari 2026 • 17:00 - 21:00</p>
                                </div>
                                <span class="px-2.5 py-0.5 bg-red-50/70 text-red-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Menunggu</span>
                            </div>
                            <p class="text-xs text-gray-400 mb-2">Pekerjaan: Backup data server</p>
                            <div class="flex gap-3">
                                <button class="text-xs text-slate-600/90 hover:text-slate-700 font-medium transition-colors">Lihat Detail →</button>
                                <button class="text-xs text-red-500/80 hover:text-red-600/80 font-medium transition-colors">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item 4 - Approved -->
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300 group">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-50/60 to-green-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-5 h-5 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between mb-1.5">
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Lembur • 2 jam</p>
                                    <p class="text-xs text-gray-500 mt-0.5">1 Januari 2026 • 20:00 - 22:00</p>
                                </div>
                                <span class="px-2.5 py-0.5 bg-green-50/70 text-green-600/80 text-xs font-medium rounded-full shadow-sm flex-shrink-0 ml-2">Disetujui</span>
                            </div>
                            <p class="text-xs text-gray-400 mb-2">Pekerjaan: Meeting preparation dengan client</p>
                            <button class="text-xs text-slate-600/90 hover:text-slate-700 font-medium transition-colors">Lihat Detail →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
