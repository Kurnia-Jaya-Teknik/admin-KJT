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
            <!-- Stat Cards - Red Theme -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-red-400 px-3 py-1 rounded-lg">Total</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">156</h3>
                    <p class="text-sm text-gray-600">Total Karyawan</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-purple-400 px-3 py-1 rounded-lg">Tetap</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">100</h3>
                    <p class="text-sm text-gray-600">PKWTT (Permanen)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-amber-400 px-3 py-1 rounded-lg">Kontrak</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">40</h3>
                    <p class="text-sm text-gray-600">PKWT (Kontrak)</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-white bg-emerald-400 px-3 py-1 rounded-lg">Belajar</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">16</h3>
                    <p class="text-sm text-gray-600">Magang & Trainee</p>
                </div>
            </div>

            <!-- Charts & Table Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Donut Chart -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Status Kepegawaian</h3>
                    <div class="h-64 flex items-center justify-center relative">
                        <svg class="w-48 h-48" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#8b5cf6" stroke-width="12" stroke-dasharray="78.5 314" transform="rotate(-90 60 60)"/>
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#f59e0b" stroke-width="12" stroke-dasharray="62.8 314" stroke-dashoffset="-78.5" transform="rotate(-90 60 60)"/>
                            <circle cx="60" cy="60" r="50" fill="none" stroke="#10b981" stroke-width="12" stroke-dasharray="47.1 314" stroke-dashoffset="-141.3" transform="rotate(-90 60 60)"/>
                            <text x="60" y="65" text-anchor="middle" font-size="20" font-weight="bold" fill="#1f2937">156</text>
                        </svg>
                    </div>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                <span class="text-sm text-gray-600">PKWTT</span>
                            </div>
                            <span class="font-semibold text-gray-800">100 (64%)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <span class="text-sm text-gray-600">PKWT</span>
                            </div>
                            <span class="font-semibold text-gray-800">40 (26%)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-sm text-gray-600">Magang</span>
                            </div>
                            <span class="font-semibold text-gray-800">16 (10%)</span>
                        </div>
                    </div>
                </div>

                <!-- Department Distribution -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Distribusi Per Divisi</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Operasional</span>
                                <span class="text-sm font-semibold text-gray-800">45</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-400 h-2 rounded-full" style="width: 29%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Marketing</span>
                                <span class="text-sm font-semibold text-gray-800">38</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-400 h-2 rounded-full" style="width: 24%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">IT & Teknologi</span>
                                <span class="text-sm font-semibold text-gray-800">32</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-cyan-400 h-2 rounded-full" style="width: 20%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Keuangan</span>
                                <span class="text-sm font-semibold text-gray-800">22</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-amber-400 h-2 rounded-full" style="width: 14%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">HR & Admin</span>
                                <span class="text-sm font-semibold text-gray-800">19</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-400 h-2 rounded-full" style="width: 12%"></div>
                            </div>
                        </div>
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
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Divisi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">PKWTT</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">PKWT</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Magang</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Operasional</td>
                                <td class="px-6 py-4 text-sm text-gray-600">28</td>
                                <td class="px-6 py-4 text-sm text-gray-600">14</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">45</td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Marketing</td>
                                <td class="px-6 py-4 text-sm text-gray-600">22</td>
                                <td class="px-6 py-4 text-sm text-gray-600">12</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">38</td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">IT & Teknologi</td>
                                <td class="px-6 py-4 text-sm text-gray-600">20</td>
                                <td class="px-6 py-4 text-sm text-gray-600">10</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">32</td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Keuangan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">16</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">22</td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">HR & Admin</td>
                                <td class="px-6 py-4 text-sm text-gray-600">14</td>
                                <td class="px-6 py-4 text-sm text-gray-600">0</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">19</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-t-2 border-red-800">
                                <td class="px-6 py-4 text-sm font-bold text-white">Total</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">100</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">40</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">16</td>
                                <td class="px-6 py-4 text-sm font-bold text-white">156</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
                </div>
    </div>
</x-app-layout>
