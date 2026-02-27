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
        <div
            class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gradient-to-br from-green-50/80 via-emerald-50/20 to-slate-50/10 min-h-full">
            <!-- Welcome Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800 mb-1.5">Profil Direktur</h1>
                <p class="text-sm text-gray-500">Kelola informasi pribadi dan keamanan akun Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="p-6 text-center">
                            <!-- Avatar -->
                            <div class="w-20 h-20 mx-auto mb-4 ring-2 ring-green-200/50 rounded-xl overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&size=80"
                                    alt="Avatar" class="w-full h-full">
                            </div>
                            <!-- Name & Position -->
                            <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->jabatan ?? 'Direktur' }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->departemen->nama ?? '-' }}</p>

                            <!-- Divider -->
                            <div class="my-4 border-t border-gray-100/50"></div>

                            <!-- Info Section -->
                            <div class="space-y-3 text-left">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Email</p>
                                    <p class="text-sm text-gray-800 font-semibold mt-0.5 break-all">
                                        {{ Auth::user()->email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Status</p>
                                    <p class="text-sm text-gray-800 font-semibold mt-0.5">
                                        <span
                                            class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs">Aktif</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Bergabung Sejak
                                    </p>
                                    <p class="text-sm text-gray-800 font-semibold mt-0.5">
                                        {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Role Info -->
                    <div
                        class="mt-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 p-6 hover:shadow-md transition-shadow duration-300">
                        <h3 class="text-sm font-semibold text-gray-800 mb-4">Hak Akses</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-100 to-emerald-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Role</p>
                                    <p class="text-sm font-semibold text-gray-800 capitalize">{{ Auth::user()->role }}
                                    </p>
                                </div>
                            </div>
                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-xs text-gray-600 leading-relaxed">Memiliki akses penuh untuk
                                    menyetujui/menolak pengajuan, mengelola karyawan, dan melihat seluruh laporan.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Edit Profile -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Informasi Pribadi -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div
                            class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-green-50/20 via-emerald-50/20 to-slate-50/15">
                            <h3 class="text-sm font-semibold text-gray-800">Informasi Pribadi</h3>
                        </div>
                        <div class="p-6">
                            <form class="space-y-5">
                                <!-- Data Tidak Dapat Diubah -->
                                <div
                                    class="bg-gradient-to-r from-green-50/40 to-emerald-50/30 border border-green-200/30 rounded-xl p-4">
                                    <div class="flex items-start gap-3">
                                        <div class="p-1.5 bg-green-100/50 rounded-lg flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-green-600/70" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs text-gray-600 leading-relaxed">
                                            <span class="font-medium text-gray-700">Info:</span> Data berikut tidak
                                            dapat diubah. Hubungi administrator sistem jika ada kesalahan.
                                        </p>
                                    </div>
                                </div>

                                <!-- Nama Lengkap (Read-only) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Nama
                                        Lengkap</label>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly disabled
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-500 cursor-not-allowed">
                                </div>

                                <!-- Email (Read-only) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Email</label>
                                    <input type="email" value="{{ Auth::user()->email }}" readonly disabled
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-500 cursor-not-allowed">
                                </div>

                                <!-- Jabatan (Read-only) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Jabatan</label>
                                    <input type="text" value="{{ Auth::user()->jabatan ?? 'Direktur' }}" readonly
                                        disabled
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-500 cursor-not-allowed">
                                </div>

                                <!-- Departemen (Read-only) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Departemen</label>
                                    <input type="text" value="{{ Auth::user()->departemen->nama ?? '-' }}" readonly
                                        disabled
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none bg-gray-50 text-gray-500 cursor-not-allowed">
                                </div>

                                <!-- No Telepon (Editable, fake update) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">No
                                        Telepon</label>
                                    <input type="tel" value="{{ Auth::user()->no_telepon ?? '' }}"
                                        placeholder="08XXXXXXXXXX"
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 hover:border-green-400 transition-colors">
                                </div>

                                <!-- Alamat (Editable, fake update) -->
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Alamat</label>
                                    <textarea rows="3" placeholder="Alamat lengkap..."
                                        class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 hover:border-green-400 transition-colors resize-none">{{ Auth::user()->alamat ?? '' }}</textarea>
                                </div>

                                <!-- Button -->
                                <div class="flex gap-3 pt-2">
                                    <button type="button"
                                        onclick="alert('Fitur update profil belum tersedia. Hubungi administrator untuk perubahan data.')"
                                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-sm font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 shadow-md hover:shadow-lg transition-all duration-200">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Keamanan Akun -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-100/50 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div
                            class="px-6 py-3.5 border-b border-gray-100/30 bg-gradient-to-r from-red-50/20 via-amber-50/20 to-orange-50/15">
                            <h3 class="text-sm font-semibold text-gray-800">Keamanan Akun</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <!-- Change Password -->
                            <div
                                class="flex items-start justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-slate-50/30 border border-gray-200/50 hover:border-gray-300/50 transition-all group">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <h4 class="text-sm font-semibold text-gray-800">Ubah Password</h4>
                                    </div>
                                    <p class="text-xs text-gray-600">Perbarui password untuk keamanan akun Anda</p>
                                </div>
                                <button onclick="alert('Fitur ubah password akan segera tersedia')"
                                    class="text-green-600 hover:text-green-700 font-medium text-sm whitespace-nowrap ml-4">
                                    Ubah →
                                </button>
                            </div>

                            <!-- Logout All Sessions -->
                            <div
                                class="flex items-start justify-between p-4 rounded-xl bg-gradient-to-r from-gray-50 to-slate-50/30 border border-gray-200/50 hover:border-gray-300/50 transition-all group">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        <h4 class="text-sm font-semibold text-gray-800">Logout Semua Sesi</h4>
                                    </div>
                                    <p class="text-xs text-gray-600">Keluar dari semua perangkat yang aktif</p>
                                </div>
                                <button onclick="alert('Fitur logout semua sesi akan segera tersedia')"
                                    class="text-red-600 hover:text-red-700 font-medium text-sm whitespace-nowrap ml-4">
                                    Logout →
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
