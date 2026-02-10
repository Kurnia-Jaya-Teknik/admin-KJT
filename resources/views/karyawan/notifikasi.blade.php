<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Notifikasi
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50/50 min-h-full">
        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
            <div class="flex items-center justify-between gap-4">
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">Semua</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Belum Dibaca</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Disetujui</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">Ditolak</button>
                </div>
                <button class="text-sm text-red-600 hover:text-red-700 font-medium">Tandai semua sudah dibaca</button>
            </div>
        </div>

        <!-- Notifikasi Surat Keterangan Diterima -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-sm border-2 border-green-200 p-5 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <span class="text-2xl">📬</span>
                    Surat Keterangan Diterima
                </h3>
                <span id="suratKeteranganBadge" class="hidden px-3 py-1.5 text-sm font-bold text-white bg-red-500 rounded-full">0</span>
            </div>
            <div id="suratKeteranganNotif" class="space-y-3">
                <div class="text-center py-4">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-600 mx-auto mb-2"></div>
                    <p class="text-sm text-gray-500">Loading...</p>
                </div>
            </div>
        </div>

        <!-- Notifikasi List -->
        <div class="space-y-3">
            <!-- Notifikasi 1 - Unread, Approved -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer">
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 rounded-full bg-red-600 mt-2 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Cuti tahunan 3 hari telah disetujui oleh Direktur. Cuti akan dilaksanakan pada 10-12 Januari 2026.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Hari ini, 14:32</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 2 - Unread, Pending -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer">
                <div class="flex items-start gap-4">
                    <div class="w-3 h-3 rounded-full bg-red-600 mt-2 flex-shrink-0"></div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Lembur Menunggu Persetujuan</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan lembur 5 jam pada 6 Januari 2026 sedang dalam proses persetujuan oleh Direktur. Anda akan diberitahu segera setelah ada keputusan.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Menunggu</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">Kemarin, 09:15</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 3 - Read, Rejected -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Ditolak</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan cuti sakit pada 5 Januari 2026 telah ditolak. Alasan: Bentrok dengan jadwal shift penting. Anda dapat mengajukan kembali dengan waktu yang berbeda.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Ditolak</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">2 hari lalu, 16:45</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 4 - Read, Ready -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Surat Keterangan Kerja Tersedia</p>
                                <p class="text-sm text-gray-600 mt-1">Surat Keterangan Kerja yang Anda ajukan untuk keperluan bank sudah siap. Silakan unduh atau ambil di kantor HR.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-slate-100 text-slate-800 text-xs font-medium rounded">Siap</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">3 hari lalu, 11:20</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 5 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Slip Gaji Bulan Desember Tersedia</p>
                                <p class="text-sm text-gray-600 mt-1">Slip gaji Anda untuk bulan Desember 2025 sudah tersedia di sistem. Silakan unduh dari menu Profil atau hubungi HR untuk detail.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-slate-100 text-slate-800 text-xs font-medium rounded">Info</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">1 minggu lalu, 08:00</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 6 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Lembur Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan lembur 4 jam pada 2 Januari 2026 telah disetujui oleh Direktur. Terima kasih atas kontribusi kerja Anda.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">1 minggu lalu, 15:30</p>
                    </div>
                </div>
            </div>

            <!-- Notifikasi 7 - Read -->
            <div class="bg-gray-50 rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                <div class="flex items-start gap-4">
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="font-medium text-gray-800">Pengajuan Cuti Disetujui</p>
                                <p class="text-sm text-gray-600 mt-1">Pengajuan cuti tahunan 5 hari pada 16-20 Desember 2025 telah disetujui oleh Direktur. Nikmati liburanmu dan pulang dengan aman.</p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Disetujui</span>
                                <button class="text-gray-400 hover:text-gray-600">×</button>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500">2 minggu lalu, 10:00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State (jika tidak ada notifikasi) -->
        <!-- 
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <p class="text-gray-600 text-lg font-medium">Tidak Ada Notifikasi</p>
            <p class="text-gray-500 text-sm mt-2">Anda akan menerima notifikasi ketika ada perubahan status pengajuan Anda.</p>
        </div>
        -->
    </div>

    <script>
        // Load Surat Keterangan Notifikasi
        function loadSuratKeteranganNotif() {
            const container = document.getElementById('suratKeteranganNotif');
            const badge = document.getElementById('suratKeteranganBadge');
            
            fetch('/karyawan/surat-keterangan-received')
                .then(r => r.json())
                .then(data => {
                    if (!data.ok || data.data.length === 0) {
                        container.innerHTML = `
                            <div class="bg-white rounded-lg p-6 text-center border border-gray-200">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-600 font-medium">Belum ada surat keterangan diterima</p>
                                <p class="text-sm text-gray-500 mt-1">Surat yang dikirim admin akan muncul di sini</p>
                            </div>
                        `;
                        if (badge) badge.classList.add('hidden');
                        return;
                    }

                    // Update badge
                    if (badge) {
                        badge.textContent = data.data.length;
                        badge.classList.remove('hidden');
                    }

                    // Render notifikasi surat
                    container.innerHTML = data.data.map(surat => `
                        <div class="bg-white rounded-lg shadow-sm border border-green-200 p-4 hover:shadow-md transition-all cursor-pointer">
                            <div class="flex items-start gap-4">
                                <div class="w-3 h-3 rounded-full bg-green-500 mt-2 flex-shrink-0 animate-pulse"></div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-2">
                                        <div class="flex-1">
                                            <p class="font-bold text-gray-800 flex items-center gap-2">
                                                <span>📄</span>
                                                Surat Keterangan Diterima
                                            </p>
                                            <p class="text-sm text-gray-700 mt-2 font-medium">Nomor: <span class="text-green-700">${surat.nomor_surat}</span></p>
                                            <p class="text-sm text-gray-600 mt-1">Jabatan: ${surat.jabatan} - ${surat.unit_kerja}</p>
                                            <p class="text-sm text-gray-600">Tanggal Surat: ${surat.tanggal_surat}</p>
                                            ${surat.keterangan ? `<p class="text-sm text-gray-500 mt-1 italic">"${surat.keterangan}"</p>` : ''}
                                        </div>
                                        <div class="flex flex-col items-end gap-2 flex-shrink-0 ml-4">
                                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-bold rounded-full whitespace-nowrap">✓ Terkirim</span>
                                            <a href="${surat.file_url}" target="_blank" 
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white text-xs font-bold rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-sm hover:shadow-md whitespace-nowrap">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Diterima: ${surat.sent_at}</p>
                                </div>
                            </div>
                        </div>
                    `).join('');
                })
                .catch(e => {
                    container.innerHTML = `
                        <div class="bg-white rounded-lg p-4 border border-red-200">
                            <p class="text-red-600 font-semibold text-sm">❌ Error loading surat keterangan</p>
                            <p class="text-gray-500 text-xs mt-1">${e.message}</p>
                        </div>
                    `;
                    if (badge) badge.classList.add('hidden');
                });
        }

        // Load on page ready
        document.addEventListener('DOMContentLoaded', loadSuratKeteranganNotif);
    </script>
</x-app-layout>
