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
        <div
            class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50 min-h-full">
            <!-- Page Header with Gradient Banner -->
            <div class="mb-8 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-red-600 via-red-500 to-red-700 rounded-3xl blur-2xl opacity-10"></div>
                <div class="relative bg-gradient-to-r from-red-600/95 via-red-500/90 to-red-700/85 rounded-3xl p-8 overflow-hidden">
                    <div class="absolute top-4 right-8 opacity-20">
                        <div class="w-32 h-32 bg-white rounded-full blur-3xl"></div>
                    </div>
                    <div class="absolute bottom-2 left-4 opacity-15">
                        <div class="w-24 h-24 bg-white rounded-full blur-2xl"></div>
                    </div>
                    <div class="relative">
                        <h1 class="text-3xl font-bold text-white mb-2">Surat Saya</h1>
                        <p class="text-red-50/90 text-sm">Ajukan dan kelola surat resmi Anda dengan mudah</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Form Pengajuan -->
                <div
                    class="lg:col-span-2 bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div
                        class="px-8 py-6 border-b border-gray-200/30 bg-gradient-to-r from-red-50/80 via-red-50/50 to-gray-50/30">
                        <h3 class="text-lg font-semibold text-gray-800">Ajukan Surat Baru</h3>
                    </div>
                    <div class="p-8">
                        <form id="suratForm" class="space-y-6">
                            <!-- Jenis Surat -->
                            <div>
                                <label class="text-sm font-semibold text-gray-700 uppercase tracking-wide block mb-3">Jenis Surat</label>
                                <select id="jenisSurat" name="jenis_surat"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-base bg-white focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-100/30 transition-all duration-200 font-medium text-gray-800 shadow-sm">
                                    <option selected disabled value="">Pilih jenis surat</option>
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
                                <label class="text-sm font-semibold text-gray-700 uppercase tracking-wide block mb-3">Tujuan Penggunaan</label>
                                <input type="text" id="tujuanSurat" name="tujuan"
                                    placeholder="Misal: Bank, Instansi Pemerintah, dll"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-base bg-white focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-100/30 transition-all duration-200 font-medium text-gray-800 shadow-sm">
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div>
                                <label class="text-sm font-semibold text-gray-700 uppercase tracking-wide block mb-3">Keterangan Tambahan (Opsional)</label>
                                <textarea rows="4" id="keteranganSurat" name="keterangan" placeholder="Tambahkan keterangan jika diperlukan..."
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl text-base bg-white focus:bg-white focus:border-red-400/60 focus:ring-2 focus:ring-red-100/30 transition-all duration-200 resize-none font-normal text-gray-800 placeholder-gray-400 shadow-sm leading-relaxed"></textarea>
                            </div>

                            <!-- Info -->
                            <div
                                class="bg-gradient-to-r from-red-50/70 to-red-100/50 border border-red-200/50 rounded-xl p-4 shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div class="p-1.5 bg-red-100 rounded-lg flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        <span class="font-semibold text-gray-800">Catatan:</span> Surat akan diproses dalam waktu 1-2 hari kerja. Anda akan diberitahu melalui notifikasi ketika surat sudah siap diambil.
                                    </p>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="flex gap-3 pt-6 border-t border-gray-200/30">
                                <button type="submit" id="submitSurat"
                                    class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 active:scale-95 text-white font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-300 text-base">
                                    Ajukan Surat
                                </button>
                                <button type="reset"
                                    class="flex-1 px-4 py-3 bg-gray-200/80 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-all duration-300 text-base">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div
                    class="bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                    <div
                        class="px-8 py-6 border-b border-gray-200/30 bg-gradient-to-r from-red-50/80 via-red-50/50 to-gray-50/30">
                        <h3 class="text-lg font-semibold text-gray-800">Jenis Surat Tersedia</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wide mb-3">Kategori Surat</p>
                            <ul class="space-y-3 text-sm text-gray-700">
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-600 mt-2.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-800">PKWT/PKWTT</strong> - Surat Perjanjian Kerja</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-600 mt-2.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-800">Kerja/Usaha</strong> - Surat Keterangan</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-600 mt-2.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-800">Gaji</strong> - Slip Gaji & Bukti Penghasilan</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="w-2 h-2 rounded-full bg-red-600 mt-2.5 flex-shrink-0"></div>
                                    <span class="leading-relaxed"><strong class="text-gray-800">Magang</strong> - Balasan & Sertifikat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Pengajuan Surat -->
            <div
                class="mt-8 bg-white/95 backdrop-blur-md rounded-2xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md transition-all duration-300">
                <div class="px-8 py-5 border-b border-gray-200/30 bg-gradient-to-r from-red-50/80 via-red-50/50 to-gray-50/30">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Pengajuan Surat</h3>
                </div>
                <div class="divide-y divide-gray-100/50">
                    <!-- Item 1 - Ready -->
                    <div
                        class="p-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 border border-red-200/50 shadow-sm">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <div>
                                        <p class="text-base font-semibold text-gray-800">Surat Keterangan Kerja</p>
                                        <p class="text-sm text-gray-500 mt-1">3 Januari 2026 • Untuk keperluan bank</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100/70 text-emerald-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">Siap Ambil</span>
                                </div>
                                <p class="text-base text-gray-600 mb-3">Surat keterangan pekerjaan untuk kebutuhan perbankan dan administratif</p>
                                <div class="flex items-center gap-3">
                                    <button
                                        class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold text-sm rounded transition-all duration-200 shadow-sm hover:shadow-md">Download</button>
                                    <button
                                        class="px-3 py-1.5 bg-red-50/60 text-red-600 hover:bg-red-100/80 hover:text-red-700 font-medium text-sm rounded transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 - Processing -->
                    <div
                        class="p-5 hover:bg-gradient-to-r hover:from-amber-50/30 hover:to-transparent transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-50/60 to-amber-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 border border-amber-200/50 shadow-sm">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <div>
                                        <p class="text-base font-semibold text-gray-800">Surat Keterangan Usaha</p>
                                        <p class="text-sm text-gray-500 mt-1">5 Januari 2026 • Untuk instansi pemerintah</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100/70 text-amber-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">Diproses</span>
                                </div>
                                <p class="text-base text-gray-600 mb-3">Estimasi selesai: 8 Januari 2026</p>
                                <div class="flex items-center gap-3">
                                    <button data-action="edit-surat" data-id="2" data-jenis="usaha"
                                        data-tujuan="Untuk instansi pemerintah" data-keterangan=""
                                        class="text-sm text-blue-600/90 hover:text-blue-700 font-medium transition-colors">Edit</button>
                                    <button data-action="delete-surat" data-id="2"
                                        class="text-sm text-red-600/90 hover:text-red-700 font-medium transition-colors">Hapus</button>
                                    <button
                                        class="px-3 py-1.5 bg-amber-50/60 text-amber-600 hover:bg-amber-100/80 hover:text-amber-700 font-medium text-sm rounded transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 - Ready -->
                    <div
                        class="p-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 border border-red-200/50 shadow-sm">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <div>
                                        <p class="text-base font-semibold text-gray-800">Surat Keterangan Gaji</p>
                                        <p class="text-sm text-gray-500 mt-1">28 Desember 2025 • Slip gaji Desember 2025</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100/70 text-emerald-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">Siap Ambil</span>
                                </div>
                                <p class="text-base text-gray-600 mb-3">Slip gaji Desember 2025 untuk keperluan administratif</p>
                                <div class="flex items-center gap-3">
                                    <button
                                        class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold text-sm rounded transition-all duration-200 shadow-sm hover:shadow-md">Download</button>
                                    <button
                                        class="px-3 py-1.5 bg-red-50/60 text-red-600 hover:bg-red-100/80 hover:text-red-700 font-medium text-sm rounded transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 - Ready -->
                    <div
                        class="p-5 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300 group border-b border-gray-100/50 last:border-0">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-50/60 to-red-50/40 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300 border border-red-200/50 shadow-sm">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-3 mb-2">
                                    <div>
                                        <p class="text-base font-semibold text-gray-800">PKWT (Kontrak Kerja)</p>
                                        <p class="text-sm text-gray-500 mt-1">1 Januari 2026 • Periode 2025</p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100/70 text-emerald-700 text-sm font-semibold rounded-full whitespace-nowrap flex-shrink-0 shadow-sm">Siap Ambil</span>
                                </div>
                                <p class="text-base text-gray-600 mb-3">Surat perjanjian kerja waktu tertentu untuk periode 2025</p>
                                <div class="flex items-center gap-3">
                                    <button
                                        class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold text-sm rounded transition-all duration-200 shadow-sm hover:shadow-md">Download</button>
                                    <button
                                        class="px-3 py-1.5 bg-red-50/60 text-red-600 hover:bg-red-100/80 hover:text-red-700 font-medium text-sm rounded transition-colors">Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Surat -->
    <div id="editSuratModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden border border-gray-200">
            <div class="px-6 py-5 bg-gradient-to-r from-red-600 to-red-700 border-b border-red-800/20">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Ubah Pengajuan Surat</h3>
                    <button id="closeEditModalBtn" class="w-9 h-9 flex items-center justify-center rounded-lg hover:bg-white/20 text-white/90 hover:text-white transition-all duration-200 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-8 space-y-6 bg-gradient-to-br from-gray-50/50 to-white max-h-[70vh] overflow-y-auto">
                <input type="hidden" id="editSuratId">
                <div class="group">
                    <label class="text-sm font-bold text-gray-700 mb-3 block">Jenis Surat</label>
                    <select id="editJenisSurat" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-base text-gray-800 font-medium shadow-sm">
                        <option value="pkwt">PKWT</option>
                        <option value="pkwtt">PKWTT</option>
                        <option value="kerja">Surat Keterangan Kerja</option>
                        <option value="usaha">Surat Keterangan Usaha</option>
                        <option value="gaji">Surat Keterangan Gaji</option>
                        <option value="magang">Surat Balasan Magang</option>
                        <option value="lainnya">Surat Lainnya</option>
                    </select>
                </div>
                <div class="group">
                    <label class="text-sm font-bold text-gray-700 mb-3 block">Tujuan Penggunaan</label>
                    <input id="editTujuanSurat" type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-base text-gray-800 font-medium shadow-sm">
                </div>
                <div class="group">
                    <label class="text-sm font-bold text-gray-700 mb-3 block">Keterangan</label>
                    <textarea id="editKeteranganSurat" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500/40 focus:border-red-500 transition-all duration-300 text-base resize-none text-gray-700 shadow-sm leading-relaxed"></textarea>
                </div>
            </div>
            <div class="px-8 py-5 bg-gray-50/80 border-t border-gray-200 flex justify-end gap-3">
                <button id="closeEditModal" class="flex items-center gap-2 px-5 py-3 bg-white hover:bg-gray-100 border-2 border-gray-300 text-gray-700 font-bold rounded-xl transition-all duration-200 text-base shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </button>
                <button id="saveEditSurat"
                    class="flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold rounded-xl transition-all duration-200 text-base shadow-md hover:shadow-lg hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            (function() {
                // Delegated handlers untuk edit & delete
                document.addEventListener('click', function(e) {
                    // Edit surat
                    const editBtn = e.target.closest('[data-action="edit-surat"]');
                    if (editBtn) {
                        const id = editBtn.getAttribute('data-id');
                        const jenis = editBtn.getAttribute('data-jenis');
                        const tujuan = editBtn.getAttribute('data-tujuan');
                        const keterangan = editBtn.getAttribute('data-keterangan');

                        document.getElementById('editSuratId').value = id;
                        document.getElementById('editJenisSurat').value = jenis;
                        document.getElementById('editTujuanSurat').value = tujuan;
                        document.getElementById('editKeteranganSurat').value = keterangan;
                        document.getElementById('editSuratModal').classList.remove('hidden');
                        document.getElementById('editSuratModal').classList.add('flex');
                        return;
                    }

                    // Delete surat
                    const deleteBtn = e.target.closest('[data-action="delete-surat"]');
                    if (deleteBtn) {
                        const id = deleteBtn.getAttribute('data-id');
                        if (!confirm('Yakin ingin menghapus pengajuan surat ini?')) return;

                        // TODO: Panggil API DELETE /api/surat/{id}
                        alert('Berhasil: Pengajuan surat berhasil dihapus');
                        deleteBtn.closest('.p-5').remove();
                        return;
                    }
                });

                // Close modal
                function closeEditModal() {
                    document.getElementById('editSuratModal').classList.add('hidden');
                    document.getElementById('editSuratModal').classList.remove('flex');
                }
                document.getElementById('closeEditModal')?.addEventListener('click', closeEditModal);
                document.getElementById('closeEditModalBtn')?.addEventListener('click', closeEditModal);

                // Save edit
                document.getElementById('saveEditSurat')?.addEventListener('click', function() {
                    const id = document.getElementById('editSuratId').value;
                    const jenis = document.getElementById('editJenisSurat').value;
                    const tujuan = document.getElementById('editTujuanSurat').value;
                    const keterangan = document.getElementById('editKeteranganSurat').value;

                    // TODO: Panggil API PUT /api/surat/{id}
                    alert('Berhasil: Perubahan berhasil disimpan');
                    closeEditModal();
                });
            })();
        </script>
    @endpush
</x-app-layout>
