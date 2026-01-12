<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Admin HR
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar: Profile Card -->
                <div class="lg:col-span-1">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="text-center">
                            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-indigo-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Arina Wijaya</h2>
                            <p class="text-sm text-gray-600 mt-1">HR Manager</p>
                            <p class="text-xs text-gray-500 mt-2">Admin HR System</p>
                        </div>
                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Status</p>
                                    <p class="text-sm font-semibold text-gray-900 mt-1">Aktif</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Tanggal Bergabung</p>
                                    <p class="text-sm font-semibold text-gray-900 mt-1">01 Januari 2024</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Departemen</p>
                                    <p class="text-sm font-semibold text-gray-900 mt-1">Human Resources</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-600 font-medium">Lokasi</p>
                                    <p class="text-sm font-semibold text-gray-900 mt-1">Jakarta Pusat</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4">Statistik Akses</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-xs text-gray-600">Login Bulan Ini</span>
                                    <span class="text-sm font-semibold text-gray-900">24 kali</span>
                                </div>
                                <div class="bg-gray-100 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Last Login</p>
                                <p class="text-sm font-semibold text-gray-900 mt-1">Hari ini, 09:15 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-6">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0"></div>
                                <p class="text-gray-600">Edit profil: 30 menit lalu</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-500 flex-shrink-0"></div>
                                <p class="text-gray-600">Buat surat: 2 jam lalu</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-purple-500 flex-shrink-0"></div>
                                <p class="text-gray-600">Ubah template: Kemarin</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-500 flex-shrink-0"></div>
                                <p class="text-gray-600">Export laporan: 2 hari lalu</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content: Edit Forms -->
                <div class="lg:col-span-2">
                    <!-- Informasi Pribadi -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Informasi Pribadi
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" value="Arina Wijaya" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" value="arina.wijaya@company.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                                    <input type="text" value="08123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" value="1990-06-15" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="perempuan" selected>Perempuan</option>
                                        <option value="lakilaki">Laki-laki</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="">Pilih Agama</option>
                                        <option value="islam" selected>Islam</option>
                                        <option value="kristen">Kristen</option>
                                        <option value="katolik">Katolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Alamat lengkap">Jl. Merdeka No. 123, Jakarta Pusat</textarea>
                            </div>

                            <div class="flex justify-end pt-4 border-t border-gray-200">
                                <button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>

                    <!-- Keamanan & Password -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Keamanan
                        </h3>

                        <!-- Change Password Section -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <h4 class="font-medium text-gray-800 mb-4">Ubah Password</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>
                                <button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Ubah Password</button>
                            </div>
                        </div>

                        <!-- 2FA Section -->
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-800 mb-1">Autentikasi Dua Faktor (2FA)</h4>
                                    <p class="text-sm text-gray-600">Tingkatkan keamanan akun dengan autentikasi dua faktor</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">Konfigurasi Ulang</button>
                                <button class="px-4 py-2 border border-red-300 rounded-lg text-red-700 hover:bg-red-50 transition-colors font-medium text-sm">Nonaktifkan 2FA</button>
                            </div>
                        </div>

                        <!-- Session Management -->
                        <div>
                            <h4 class="font-medium text-gray-800 mb-3">Sesi Aktif</h4>
                            <div class="bg-gray-50 rounded-lg p-4 mb-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">Browser Utama</p>
                                        <p class="text-xs text-gray-600 mt-1">Chrome • Windows 10 • Aktif sekarang</p>
                                    </div>
                                    <button class="text-red-600 hover:text-red-700 font-medium text-sm">Logout</button>
                                </div>
                            </div>
                            <button class="text-red-600 hover:text-red-700 font-medium text-sm">Logout Semua Sesi</button>
                        </div>
                    </div>

                    <!-- Preferensi Notifikasi -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            Preferensi Notifikasi
                        </h3>
                        <div class="space-y-4">
                            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" />
                                <span class="font-medium text-gray-800">Pengajuan Cuti & Lembur Baru</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" />
                                <span class="font-medium text-gray-800">Keputusan Direktur</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" />
                                <span class="font-medium text-gray-800">Surat Siap Diambil</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 rounded border-gray-300" />
                                <span class="font-medium text-gray-800">Laporan Sistem</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                                <input type="checkbox" checked class="w-4 h-4 rounded border-gray-300" />
                                <span class="font-medium text-gray-800">Notifikasi Email</span>
                            </label>

                            <div class="flex justify-end pt-4 border-t border-gray-200">
                                <button class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Simpan Preferensi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
