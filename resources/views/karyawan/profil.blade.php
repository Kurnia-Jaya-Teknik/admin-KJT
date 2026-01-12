<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-slate-50/80 via-red-50/20 to-green-50/10 min-h-full">
        <!-- Welcome Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Profil Saya</h1>
            <p class="text-sm text-gray-500">Kelola informasi pribadi dan keamanan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="p-6 text-center">
                        <!-- Avatar -->
                        <div class="w-20 h-20 mx-auto mb-4 ring-2 ring-red-200/50 rounded-xl overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Rina+Wijaya&background=4f46e5&color=fff&size=80" alt="Avatar" class="w-full h-full">
                        </div>
                        <!-- Name & Position -->
                        <p class="text-lg font-semibold text-gray-800">Rina Wijaya</p>
                        <p class="text-sm text-gray-600 mt-1">Staff Finance</p>
                        <p class="text-xs text-gray-500 mt-1">Departemen Keuangan</p>
                        
                        <!-- Divider -->
                        <div class="my-4 border-t border-gray-100/50"></div>

                        <!-- Info Section -->
                        <div class="space-y-3 text-left">
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">ID Karyawan</p>
                                <p class="text-sm text-gray-800 font-semibold mt-0.5">EMP-2024-156</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Status</p>
                                <p class="text-sm text-gray-800 font-semibold mt-0.5">Aktif</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Bergabung Sejak</p>
                                <p class="text-sm text-gray-800 font-semibold mt-0.5">15 Januari 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="mt-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-6 hover:shadow-md transition-shadow duration-300">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4">Statistik</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Sisa Cuti</span>
                                <span class="text-sm font-semibold text-gray-800">8/12</span>
                            </div>
                            <div class="bg-gray-100/30 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-red-400/60 to-red-400/50 h-2 rounded-full transition-all duration-500 shadow-sm" style="width: 67%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <span class="text-xs text-gray-500">Kehadiran Bulan Ini</span>
                                <span class="text-sm font-semibold text-gray-800">18/20</span>
                            </div>
                            <div class="bg-gray-100/30 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-slate-400/60 to-slate-400/50 h-2 rounded-full transition-all duration-500 shadow-sm" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit Profile -->
            <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 via-slate-50/20 to-slate-50/15">
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-5">
                        <!-- Data Tidak Dapat Diubah -->
                        <div class="bg-gradient-to-r from-slate-50/40 to-slate-50/30 border border-slate-200/30 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <div class="p-1.5 bg-slate-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-slate-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    <span class="font-medium text-gray-700">Info:</span> Data berikut tidak dapat diubah. Hubungi HR jika ada kesalahan.
                                </p>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Nama Lengkap</label>
                            <input type="text" value="Rina Wijaya" disabled class="w-full px-4 py-2.5 bg-gray-50/60 border border-gray-200/40 rounded-xl text-gray-600 cursor-not-allowed text-sm">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Email</label>
                            <input type="email" value="rina.wijaya@company.com" disabled class="w-full px-4 py-2.5 bg-gray-50/60 border border-gray-200/40 rounded-xl text-gray-600 cursor-not-allowed text-sm">
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Jabatan</label>
                            <input type="text" value="Staff Finance" disabled class="w-full px-4 py-2.5 bg-gray-50/60 border border-gray-200/40 rounded-xl text-gray-600 cursor-not-allowed text-sm">
                        </div>

                        <!-- Departemen -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Departemen</label>
                            <input type="text" value="Keuangan" disabled class="w-full px-4 py-2.5 bg-gray-50/60 border border-gray-200/40 rounded-xl text-gray-600 cursor-not-allowed text-sm">
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100/50 pt-5"></div>

                        <!-- Data Dapat Diubah -->
                        <div class="bg-gradient-to-r from-red-50/40 to-red-50/30 border border-red-200/30 rounded-xl p-4">
                            <div class="flex items-start gap-3">
                                <div class="p-1.5 bg-red-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-red-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    <span class="font-medium text-gray-700">Catatan:</span> Anda dapat mengubah data berikut.
                                </p>
                            </div>
                        </div>

                        <!-- Nomor HP -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Nomor HP</label>
                            <input type="tel" placeholder="+62 8xx xxxx xxxx" class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/30 focus:border-red-300/50 transition-all duration-300 text-sm">
                            <p class="text-xs text-gray-400 mt-1.5">Digunakan untuk notifikasi penting</p>
                        </div>

                        <!-- Alamat Rumah -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Alamat Rumah</label>
                            <textarea rows="3" placeholder="Jalan, Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi" class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/30 focus:border-red-300/50 transition-all duration-300 text-sm resize-none"></textarea>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Jenis Kelamin</label>
                            <select class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/30 focus:border-red-300/50 transition-all duration-300 text-sm">
                                <option selected>Perempuan</option>
                                <option>Laki-laki</option>
                            </select>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Tanggal Lahir</label>
                            <input type="date" class="w-full px-4 py-2.5 bg-white/80 border border-gray-200/60 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-400/30 focus:border-red-300/50 transition-all duration-300 text-sm">
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-400 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-500 shadow-sm hover:shadow-md transition-all duration-300 text-sm">
                                Simpan Perubahan
                            </button>
                            <button type="reset" class="flex-1 px-4 py-2.5 bg-white/80 border border-gray-200/60 text-gray-600 font-medium rounded-xl hover:bg-gray-50/80 hover:border-gray-300/60 transition-all duration-300 text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Account Security Section -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 to-slate-50/20">
                <h3 class="text-sm font-semibold text-gray-800">Keamanan Akun</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Change Password -->
                    <div class="bg-gradient-to-br from-red-50/30 to-red-50/20 rounded-xl p-5 border border-red-100/30">
                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Ubah Password</h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Perbarui password Anda secara berkala untuk keamanan akun</p>
                        <button class="px-4 py-2.5 border border-red-400/60 text-red-600/80 font-medium rounded-xl hover:bg-red-50/60 hover:border-red-400/80 transition-all duration-300 text-sm">
                            Ubah Password
                        </button>
                    </div>

                    <!-- Two-Factor Auth -->
                    <div class="bg-gradient-to-br from-green-50/30 to-slate-50/20 rounded-xl p-5 border border-green-100/30">
                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Autentikasi Dua Faktor</h4>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Tingkatkan keamanan dengan autentikasi dua faktor</p>
                        <button class="px-4 py-2.5 border border-green-400/60 text-green-600/80 font-medium rounded-xl hover:bg-green-50/60 hover:border-green-400/80 transition-all duration-300 text-sm">
                            Aktifkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="mt-8 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 to-slate-50/20">
                <h3 class="text-sm font-semibold text-gray-800">Log Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-100/50">
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-red-50/30 hover:to-transparent transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Login</p>
                            <p class="text-xs text-gray-400 mt-0.5">Perangkat: Windows • IP: 192.168.1.100</p>
                        </div>
                        <span class="text-xs text-gray-400">Hari ini, 14:30</span>
                    </div>
                </div>
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-green-50/30 hover:to-transparent transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Ubah Profil</p>
                            <p class="text-xs text-gray-400 mt-0.5">Nomor telepon diperbarui</p>
                        </div>
                        <span class="text-xs text-gray-400">2 hari lalu</span>
                    </div>
                </div>
                <div class="px-6 py-4 hover:bg-gradient-to-r hover:from-slate-50/30 hover:to-transparent transition-all duration-300">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-800">Ajukan Pengajuan</p>
                            <p class="text-xs text-gray-400 mt-0.5">Pengajuan cuti tahunan</p>
                        </div>
                        <span class="text-xs text-gray-400">5 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</x-app-layout>
