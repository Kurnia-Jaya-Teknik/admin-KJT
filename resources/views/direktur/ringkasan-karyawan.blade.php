<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ringkasan Karyawan') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8">
                    <a href="{{ route('direktur.ringkasan-karyawan') }}"
                        class="{{ !request()->is('direktur/ringkasan-karyawan/kelola') ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        📊 Ringkasan
                    </a>
                    <a href="{{ route('direktur.ringkasan-karyawan.kelola') }}"
                        class="{{ request()->is('direktur/ringkasan-karyawan/kelola') ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        👥 Kelola Akun
                    </a>
                </nav>
            </div>

            <!-- Stat Cards - Red Theme -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-red-400 px-3 py-1 rounded-lg">Total</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $totalKaryawan }}</h3>
                    <p class="text-sm text-gray-600">Total Karyawan</p>
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-purple-400 px-3 py-1 rounded-lg">Tetap</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $pkwtt }}</h3>
                    <p class="text-sm text-gray-600">PKWTT (Permanen)</p>
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-amber-400 px-3 py-1 rounded-lg">Kontrak</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $pkwt }}</h3>
                    <p class="text-sm text-gray-600">PKWT (Kontrak)</p>
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m0 0h6" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-emerald-400 px-3 py-1 rounded-lg">Belajar</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $magang }}</h3>
                    <p class="text-sm text-gray-600">Magang & Trainee</p>
                </div>
            </div>

            <!-- Charts & Table Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Donut Chart -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Status Kepegawaian</h3>
                    <div class="h-64 flex items-center justify-center relative">
                        @php
                            $pkwttPct = $totalKaryawan > 0 ? round(($pkwtt / $totalKaryawan) * 314) : 0;
                            $pkwtPct = $totalKaryawan > 0 ? round(($pkwt / $totalKaryawan) * 314) : 0;
                            $magangPct = $totalKaryawan > 0 ? round(($magang / $totalKaryawan) * 314) : 0;
                        @endphp
                        <svg class="w-48 h-48" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#8b5cf6"
                                stroke-width="12" stroke-dasharray="{{ $pkwttPct }} 314"
                                transform="rotate(-90 60 60)" />
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b"
                                stroke-width="12" stroke-dasharray="{{ $pkwtPct }} 314"
                                stroke-dashoffset="-{{ $pkwttPct }}" transform="rotate(-90 60 60)" />
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981"
                                stroke-width="12" stroke-dasharray="{{ $magangPct }} 314"
                                stroke-dashoffset="-{{ $pkwttPct + $pkwtPct }}" transform="rotate(-90 60 60)" />
                            <text x="60" y="65" text-anchor="middle" font-size="20" font-weight="bold"
                                fill="#1f2937">{{ $totalKaryawan }}</text>
                        </svg>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                <span class="text-sm text-gray-600">PKWTT</span>
                            </div>
                            <span class="font-semibold text-gray-800">{{ $pkwtt }}
                                ({{ $totalKaryawan > 0 ? round(($pkwtt / $totalKaryawan) * 100) : 0 }}%)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <span class="text-sm text-gray-600">PKWT</span>
                            </div>
                            <span class="font-semibold text-gray-800">{{ $pkwt }}
                                ({{ $totalKaryawan > 0 ? round(($pkwt / $totalKaryawan) * 100) : 0 }}%)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-sm text-gray-600">Magang</span>
                            </div>
                            <span class="font-semibold text-gray-800">{{ $magang }}
                                ({{ $totalKaryawan > 0 ? round(($magang / $totalKaryawan) * 100) : 0 }}%)</span>
                        </div>
                    </div>
                </div>

                <!-- Department Distribution -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Distribusi Per Divisi</h3>
                    <div class="space-y-4">
                        @php
                            $colors = ['red', 'purple', 'cyan', 'amber', 'green', 'blue', 'pink', 'indigo'];
                            $maxUsers = $departemens->max('users_count') ?: 1;
                        @endphp
                        @foreach ($departemens as $index => $dept)
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">{{ $dept->nama }}</span>
                                    <span class="text-sm font-semibold text-gray-800">{{ $dept->users_count }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    @php
                                        $color = $colors[$index % count($colors)];
                                        $widthPct =
                                            $totalKaryawan > 0 ? round(($dept->users_count / $totalKaryawan) * 100) : 0;
                                    @endphp
                                    <div class="bg-{{ $color }}-400 h-2 rounded-full"
                                        style="width: {{ $widthPct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Employee Table by Division -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-bold text-white">Daftar Karyawan Per Divisi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Divisi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    PKWTT</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    PKWT</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Magang</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($departemens as $dept)
                                @php
                                    $deptUsers = $karyawan
                                        ->where('role', 'karyawan')
                                        ->where('departemen_id', $dept->id);
                                    $deptPkwtt = $deptUsers->where('status_kepegawaian', 'PKWTT')->count();
                                    $deptPkwt = $deptUsers->where('status_kepegawaian', 'PKWT')->count();
                                    $deptMagang = $deptUsers->where('status_kepegawaian', 'Magang')->count();
                                    $deptTotal = $deptUsers->count();
                                @endphp
                                <tr class="hover:bg-red-50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $dept->nama }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $deptPkwtt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $deptPkwt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $deptMagang }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $deptTotal }}</td>
                                </tr>
                            @endforeach

                            @if ($countAdminHrd > 0)
                                @php
                                    $adminPkwtt = $adminHrd->where('status_kepegawaian', 'PKWTT')->count();
                                    $adminPkwt = $adminHrd->where('status_kepegawaian', 'PKWT')->count();
                                    $adminMagang = $adminHrd->where('status_kepegawaian', 'Magang')->count();
                                @endphp
                                <tr class="hover:bg-blue-50 transition-colors duration-150 bg-blue-50/50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                            </svg>
                                            Admin HRD
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $adminPkwtt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $adminPkwt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $adminMagang }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-blue-700">{{ $countAdminHrd }}
                                    </td>
                                </tr>
                            @endif

                            @if ($countTanpaDivisi > 0)
                                @php
                                    $tanpaDivisiPkwtt = $karyawanTanpaDivisi
                                        ->where('status_kepegawaian', 'PKWTT')
                                        ->count();
                                    $tanpaDivisiPkwt = $karyawanTanpaDivisi
                                        ->where('status_kepegawaian', 'PKWT')
                                        ->count();
                                    $tanpaDivisiMagang = $karyawanTanpaDivisi
                                        ->where('status_kepegawaian', 'Magang')
                                        ->count();
                                @endphp
                                <tr class="hover:bg-yellow-50 transition-colors duration-150 bg-yellow-50/50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 italic">
                                        <span class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-yellow-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Belum Ada Divisi
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tanpaDivisiPkwtt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tanpaDivisiPkwt }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $tanpaDivisiMagang }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-yellow-700">
                                        {{ $countTanpaDivisi }}</td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-t-2 border-red-800">
                                <td class="px-6 py-4 text-sm font-bold text-white">Total</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">{{ $pkwtt }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">{{ $pkwt }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">{{ $magang }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">{{ $totalKaryawan }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
