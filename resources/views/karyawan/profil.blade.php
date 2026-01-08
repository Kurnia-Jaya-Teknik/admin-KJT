<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <div class="flex min-h-[calc(100vh-130px)]">
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50/50">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 text-center">
                        <!-- Avatar -->
                        <div class="w-20 h-20 mx-auto mb-4">
                            <img src="https://ui-avatars.com/api/?name=Rina+Wijaya&background=4f46e5&color=fff&size=80" alt="Avatar" class="w-full h-full rounded-lg">
                        </div>
                        <!-- Name & Position -->
                        <p class="text-lg font-semibold text-gray-800">Rina Wijaya</p>
                        <p class="text-sm text-gray-600 mt-1">Staff Finance</p>
                        <p class="text-xs text-gray-500 mt-1">Departemen Keuangan</p>
                        
                        <!-- Divider -->
                        <div class="my-4 border-t border-gray-200"></div>

                        <!-- Info Section -->
                        <div class="space-y-3 text-left">
                            <div>
                                <p class="text-xs text-gray-500 font-medium">ID KARYAWAN</p>
                                <p class="text-sm text-gray-800 font-semibold">EMP-2024-156</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">STATUS</p>
                                <p class="text-sm text-gray-800 font-semibold">Aktif</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">BERGABUNG SEJAK</p>
                                <p class="text-sm text-gray-800 font-semibold">15 Januari 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4">Statistik</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-xs text-gray-600">Sisa Cuti</span>
                                <span class="text-sm font-semibold text-gray-800">8/12</span>
                            </div>
                            <div class="bg-gray-100 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 67%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-xs text-gray-600">Kehadiran Bulan Ini</span>
                                <span class="text-sm font-semibold text-gray-800">18/20</span>
                            </div>
                            <div class="bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Edit Profile -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-800">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <form class="space-y-6">
                        <!-- Data Tidak Dapat Diubah -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-xs text-blue-800">
                                <span class="font-semibold">Info:</span> Data berikut tidak dapat diubah. Hubungi HR jika ada kesalahan.
                            </p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" value="Rina Wijaya" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="rina.wijaya@company.com" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input type="text" value="Staff Finance" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Departemen -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                            <input type="text" value="Keuangan" disabled class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 pt-6"></div>

                        <!-- Data Dapat Diubah -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-xs text-green-800">
                                <span class="font-semibold">Catatan:</span> Anda dapat mengubah data berikut.
                            </p>
                        </div>

                        <!-- Nomor HP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                            <input type="tel" placeholder="+62 8xx xxxx xxxx" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <p class="text-xs text-gray-600 mt-1">Digunakan untuk notifikasi penting</p>
                        </div>

                        <!-- Alamat Rumah -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Rumah</label>
                            <textarea rows="3" placeholder="Jalan, Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <option selected>Perempuan</option>
                                <option>Laki-laki</option>
                            </select>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        </div>

                        <!-- Button -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                Simpan Perubahan
                            </button>
                            <button type="reset" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Account Security Section -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Keamanan Akun</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Change Password -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Ubah Password</h4>
                        <p class="text-sm text-gray-600 mb-4">Perbarui password Anda secara berkala untuk keamanan akun</p>
                        <button class="px-4 py-2 border border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors">
                            Ubah Password
                        </button>
                    </div>

                    <!-- Two-Factor Auth -->
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Autentikasi Dua Faktor</h4>
                        <p class="text-sm text-gray-600 mb-4">Tingkatkan keamanan dengan autentikasi dua faktor</p>
                        <button class="px-4 py-2 border border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors">
                            Aktifkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm font-semibold text-gray-800">Log Aktivitas Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-200">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Login</p>
                            <p class="text-xs text-gray-600 mt-1">Perangkat: Windows • IP: 192.168.1.100</p>
                        </div>
                        <span class="text-xs text-gray-500">Hari ini, 14:30</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Ubah Profil</p>
                            <p class="text-xs text-gray-600 mt-1">Nomor telepon diperbarui</p>
                        </div>
                        <span class="text-xs text-gray-500">2 hari lalu</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="font-medium text-gray-800">Ajukan Pengajuan</p>
                            <p class="text-xs text-gray-600 mt-1">Pengajuan cuti tahunan</p>
                        </div>
                        <span class="text-xs text-gray-500">5 hari lalu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
