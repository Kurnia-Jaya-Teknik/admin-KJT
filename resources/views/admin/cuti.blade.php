<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Monitoring Pengajuan Cuti
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header -->
            <div class="mb-8 flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Pengajuan Cuti</h1>
                    <p class="text-gray-600 mt-1">Monitor semua pengajuan cuti dari karyawan</p>
                </div>
                <button onclick="openTambahCutiModal()"
                    class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl text-sm font-semibold hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pengajuan Cuti
                </button>
            </div>

            <!-- Tab Navigation -->
            <div class="mb-8 flex gap-4 border-b border-gray-200">
                <button onclick="showTab('pengajuan')" 
                    class="tab-btn px-4 py-3 font-semibold text-gray-600 border-b-2 border-indigo-500 text-gray-900 hover:text-gray-900 transition-all active-tab"
                    data-tab="pengajuan">
                    Pengajuan Cuti
                </button>
                <button onclick="showTab('surat')" 
                    class="tab-btn px-4 py-3 font-semibold text-gray-600 border-b-2 border-transparent hover:text-gray-900 transition-all"
                    data-tab="surat">
                    Surat yang Sudah Dibuat
                </button>
            </div>

            <!-- Tab Content: Pengajuan Cuti -->
            <div id="tab-pengajuan" class="tab-content">

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search Karyawan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama Karyawan</label>
                        <input type="text" placeholder="Ketik nama..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                    </div>

                    <!-- Filter Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="pending">Menunggu Direktur</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>

                    <!-- Filter Periode -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Periode</option>
                            <option value="2026-01">Januari 2026</option>
                            <option value="2025-12">Desember 2025</option>
                            <option value="2025-11">November 2025</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-slate-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-slate-100/60 to-slate-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-slate-600/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Pengajuan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalPengajuan ?? 0 }}</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-rose-100/60 to-rose-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-rose-500/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Persetujuan</p>
                        <p class="text-3xl font-bold text-rose-600/80">{{ $menungguPersetujuan ?? 0 }}</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-100/60 to-green-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-green-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Disetujui</p>
                        <p class="text-3xl font-bold text-green-600/80">{{ $disetujui ?? 0 }}</p>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-br from-white/90 to-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100/40 p-6 hover:shadow-md transition-all duration-300 group overflow-hidden relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-red-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="relative">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-red-100/60 to-red-50/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-red-500/70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600/80">{{ $ditolak ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Search & Filter Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                <!-- Top Row: Count & Sort -->
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span id="visibleCount"
                            class="font-semibold text-gray-900">{{ count($cutiList) }}</span> dari <span
                            class="font-semibold text-gray-900">{{ count($cutiList) }}</span> pengajuan
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-sm text-gray-600">Urutkan:</label>
                        <select id="sortBy"
                            class="px-3 py-1.5 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="name-asc">Nama A-Z</option>
                            <option value="name-desc">Nama Z-A</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="searchInput"
                                placeholder="Cari nama karyawan, NIK, atau departemen..."
                                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Filter by Status -->
                    <div class="w-full lg:w-48">
                        <select id="filterStatus"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>

                    <!-- Filter by Departemen -->
                    <div class="w-full lg:w-52">
                        <select id="filterDepartemen"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                            <option value="">Semua Departemen</option>
                            @foreach (\App\Models\Departemen::orderBy('nama')->get() as $dept)
                                <option value="{{ $dept->nama }}">{{ $dept->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <button onclick="resetFilters()"
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </button>
                </div>

                <!-- Quick Filter Tabs -->
                <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
                    <button onclick="quickFilter('all')"
                        class="quick-filter-btn active px-4 py-2 rounded-lg text-sm font-medium transition-all"
                        data-filter="all">
                        Semua ({{ $totalPengajuan }})
                    </button>
                    <button onclick="quickFilter('Pending')"
                        class="quick-filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all"
                        data-filter="Pending">
                        Menunggu ({{ $menungguPersetujuan }})
                    </button>
                    <button onclick="quickFilter('Disetujui')"
                        class="quick-filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all"
                        data-filter="Disetujui">
                        Disetujui ({{ $disetujui }})
                    </button>
                    <button onclick="quickFilter('Ditolak')"
                        class="quick-filter-btn px-4 py-2 rounded-lg text-sm font-medium transition-all"
                        data-filter="Ditolak">
                        Ditolak ({{ $ditolak }})
                    </button>
                </div>
            </div>

            <!-- List of Submissions -->
            <div class="space-y-4" id="cutiListContainer">
                @forelse($cutiList as $cuti)
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <!-- Left Color Bar -->
                        <div class="flex">
                            <div
                                class="w-1 bg-gradient-to-b from-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-400 to-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-300">
                            </div>

                            <div class="flex-1 p-6">
                                <!-- Header: Nama & Status -->
                                <div class="flex items-start justify-between mb-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-11 h-11 rounded-2xl bg-gradient-to-br from-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-50 to-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-500"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                {{ $cuti->user->name ?? 'N/A' }}
                                            </h3>
                                            <p class="text-sm text-gray-500">
                                                {{ $cuti->user->departemen->nama ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-50 text-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-700">
                                        @if ($cuti->status == 'Pending')
                                            Menunggu
                                        @elseif($cuti->status == 'Disetujui')
                                            Disetujui
                                        @else
                                            Ditolak
                                        @endif
                                    </span>
                                </div>

                                <!-- Info Grid -->
                                <div
                                    class="grid grid-cols-2 md:grid-cols-5 gap-5 mb-5 p-4 bg-gradient-to-br from-gray-50/80 to-gray-50/40 rounded-2xl">
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1.5">Jenis Cuti</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $cuti->jenis }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1.5">Durasi</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $cuti->durasi }} hari</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1.5">Tanggal</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 mb-1.5">Diajukan</p>
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->created_at)->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div>
<<<<<<< Updated upstream
                                        <button onclick="showDetailCuti({{ $cuti->id }})"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg text-xs font-semibold hover:from-indigo-600 hover:to-indigo-700 shadow-sm hover:shadow-md transition-all">
                                            Lihat Detail
                                        </button>
=======
                                        <p class="text-xs font-medium text-gray-500 mb-1.5">Status Surat</p>
                                        @if ($cuti->surat)
                                            <div class="flex flex-col gap-1.5">
                                                <a href="/admin/surat"
                                                    class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                                                    {{ $cuti->surat->status }} #{{ $cuti->surat->id }}
                                                </a>
                                                <button
                                                    onclick="editSurat({{ $cuti->surat->id }}, {{ $cuti->id }})"
                                                    class="px-2.5 py-1 bg-amber-500 text-white rounded-lg text-xs font-medium hover:bg-amber-600 transition-colors flex items-center justify-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                            </div>
                                        @elseif($cuti->status == 'Disetujui')
                                            <div class="flex flex-wrap gap-1.5">
                                                <button onclick="previewSuratCuti({{ $cuti->id }})"
                                                    class="px-2.5 py-1 bg-gray-600 text-white rounded-lg text-xs font-medium hover:bg-gray-700 transition-colors">
                                                    Preview
                                                </button>
                                                <button onclick="editCutiData({{ $cuti->id }})"
                                                    class="px-2.5 py-1 bg-amber-500 text-white rounded-lg text-xs font-medium hover:bg-amber-600 transition-colors">
                                                    Edit
                                                </button>
                                                <button onclick="buatSuratCuti({{ $cuti->id }})"
                                                    class="px-2.5 py-1 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700 transition-colors">
                                                    Buat Surat
                                                </button>
                                            </div>
                                        @else
                                            <p class="text-sm font-medium text-gray-400">-</p>
                                        @endif
>>>>>>> Stashed changes
                                    </div>
                                </div>

                                <!-- Approval Status -->
                                @if ($cuti->status == 'Disetujui' && $cuti->tanggal_persetujuan)
                                    <div class="mb-4 p-3.5 bg-green-50/70 rounded-xl">
                                        <div class="flex items-center gap-2 text-sm">
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold text-green-900">
                                                Disetujui oleh {{ $cuti->approver->name ?? 'direktur 1' }}
                                            </span>
                                            <span class="text-green-500">•</span>
                                            <span class="text-green-700">
                                                {{ \Carbon\Carbon::parse($cuti->tanggal_persetujuan)->format('d M Y, H:i') }}
                                                WIB
                                            </span>
                                        </div>
                                    </div>
                                @elseif($cuti->status == 'Ditolak' && $cuti->tanggal_persetujuan)
                                    <div class="mb-4 p-3.5 bg-red-50/70 rounded-xl">
                                        <div class="flex items-center gap-2 text-sm">
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold text-red-900">
                                                Ditolak oleh {{ $cuti->approver->name ?? 'Direktur' }}
                                            </span>
                                            <span class="text-red-500">•</span>
                                            <span class="text-red-700">
                                                {{ \Carbon\Carbon::parse($cuti->tanggal_persetujuan)->format('d M Y, H:i') }}
                                                WIB
                                            </span>
                                        </div>
                                        @if ($cuti->keterangan_persetujuan)
                                            <p class="text-sm text-red-800 mt-2">Alasan:
                                                {{ $cuti->keterangan_persetujuan }}</p>
                                        @endif
                                    </div>
                                @endif

                                <!-- Alasan Section -->
                                <div class="mb-4 pl-3 border-l-2 border-gray-200">
                                    <p class="text-sm text-gray-700">
                                        <span class="font-semibold text-gray-900">Alasan:</span>
                                        <span class="ml-1">{{ $cuti->alasan }}</span>
                                    </p>
                                </div>

                                <!-- Delegated Users -->
                                @if ($cuti->delegated_users && $cuti->delegated_users->count() > 0)
                                    <div class="pl-3 border-l-2 border-purple-200">
                                        <p class="text-sm font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-purple-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                            </svg>
                                            Dilimpahkan ke:
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($cuti->delegated_users as $delegated)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-700">
                                                    {{ $delegated->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-500">
                        <p>Belum ada pengajuan cuti</p>
                    </div>
                @endforelse
            </div>

<<<<<<< Updated upstream
            </div>
            <!-- End Tab: Pengajuan -->

            <!-- Tab Content: Surat yang Sudah Dibuat -->
            <div id="tab-surat" class="tab-content hidden">

            <!-- Surat List -->
            <div class="space-y-4">
                @php
                    $suratsBuat = $cutiList->where('file_surat', '!=', null)->sortByDesc('updated_at');
                @endphp

                @forelse($suratsBuat as $surat)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-emerald-50 rounded-2xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"></path>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $surat->user->name ?? 'N/A' }}</h3>
                                        <p class="text-xs text-gray-500">{{ $surat->user->departemen->nama ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-green-100/60 to-emerald-100/40 text-green-700 border border-green-200/30">
                                    Surat Dibuat
                                </span>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-green-50/30 to-emerald-50/20 rounded-2xl border border-green-100/20">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis Cuti</p>
                                    <p class="font-semibold text-gray-900">{{ $surat->jenis }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi</p>
                                    <p class="font-semibold text-gray-900">{{ $surat->durasi_hari ?? $surat->durasi }} hari</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Periode</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($surat->tanggal_mulai)->format('d M') }} -
                                        {{ \Carbon\Carbon::parse($surat->tanggal_selesai)->format('d M') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Dibuat</p>
                                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($surat->updated_at)->format('d M Y') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button onclick="previewCutiFromModal('{{ $surat->id }}', '{{ $surat->user->name }}')"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-blue-700 shadow-sm hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Surat
                                </button>
                                <a href="{{ url('storage/' . $surat->file_surat) }}" target="_blank"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 shadow-sm hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 text-gray-500">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <p class="text-lg font-medium">Belum ada surat yang dibuat</p>
                        <p class="text-sm text-gray-400 mt-1">Buat surat cuti dari pengajuan yang disetujui</p>
                    </div>
                @endforelse
            </div>

            </div>
            <!-- End Tab: Surat -->

=======
            <!-- Pagination Controls -->
            <div id="paginationControls"
                class="mt-6 flex items-center justify-between bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="text-sm text-gray-600">
                    Halaman <span id="currentPageDisplay" class="font-semibold text-gray-900">1</span> dari <span
                        id="totalPagesDisplay" class="font-semibold text-gray-900">1</span>
                </div>
                <div class="flex items-center gap-2">
                    <button id="btnPrevPage" onclick="prevPage()"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                        disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Sebelumnya
                    </button>
                    <div id="pageNumbers" class="flex items-center gap-1">
                        <!-- Page numbers will be inserted here -->
                    </div>
                    <button id="btnNextPage" onclick="nextPage()"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg text-sm font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

>>>>>>> Stashed changes
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-rose-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan cuti karyawan</p>
                </div>
                <button onclick="closeDetailModal()"
                    class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6">
                <!-- Karyawan Info Card -->
                <div
                    class="bg-gradient-to-br from-rose-50/40 to-slate-50/30 rounded-2xl p-6 border border-rose-100/30">
                    <div class="flex items-start gap-4 mb-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-100/60 to-rose-50/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-rose-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900" id="employeeName">-</h3>
                            <p class="text-sm text-gray-600 mt-0.5" id="employeeIdDept">-</p>
                            <p class="text-sm text-gray-500 mt-1" id="employeeEmail">-</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge - Dynamic based on status -->
                <div id="statusBadge"
                    class="flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div>
                    <span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu
                            Persetujuan</span></span>
                </div>

                <!-- Cuti Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jenis">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="durasi">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-mulai">-</p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-selesai">-</p>
                    </div>
                </div>

                <!-- Alasan Section -->
                <div class="bg-white/70 rounded-2xl p-5 border border-gray-100/40">
                    <h4 class="text-sm font-semibold text-gray-900 mb-2">Alasan Pengajuan</h4>
                    <p class="text-gray-700 leading-relaxed" id="alasanText">-</p>
                </div>

                <!-- Timeline -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-gray-900">Riwayat Pengajuan</h4>
                    <div class="space-y-2" id="timelineContainer">
                        <div class="text-gray-500">Memuat...</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <!-- NOTE: Approval/Rejection hanya untuk Direktur, Admin hanya bisa lihat dan buat surat jika disetujui -->
                <div id="actionButtons" class="flex gap-3 pt-4 border-t border-gray-100/40 flex-wrap">
                    <!-- Button 'Lihat Surat' muncul jika surat sudah dibuat -->
                    <button id="lihatSuratBtn" 
                        class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Surat
                    </button>
                    <!-- Button 'Buat Surat' hanya muncul jika sudah disetujui direktur -->
                    <button id="buatSuratBtn" onclick="openBuatSuratModal()"
                        class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                    <button onclick="closeDetailModal()"
                        class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Surat -->
    <div id="buatSuratModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-300">
            <div class="p-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-100/60 to-blue-50/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Buat Surat Cuti?</h3>
                <p class="text-gray-600 mb-6">Surat cuti untuk <span id="buatSuratEmployeeName">-</span> akan dibuat.
                    Pastikan sudah disetujui oleh direktur.</p>
                <div class="flex gap-3">
                    <button onclick="closeBuatSuratModal()"
                        class="flex-1 px-4 py-2.5 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">Batal</button>
                    <button onclick="confirmBuatSurat()"
                        class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500/80 to-blue-400/70 text-white font-medium rounded-2xl hover:from-blue-500 hover:to-blue-400 shadow-sm transition-all">Ya,
                        Buat Surat</button>
                </div>
            </div>
        </div>
    </div>

<<<<<<< Updated upstream
    <!-- Preview Surat Cuti Modal -->
    <div id="previewSuratCutiModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
            <div class="sticky top-0 bg-gradient-to-r from-blue-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 px-8 py-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Preview Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1" id="previewCutiTitle"></p>
                </div>
                <button onclick="closePreviewCutiModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto bg-gray-50">
                <iframe id="previewCutiFrame" class="w-full h-full" style="min-height: 600px;" frameborder="0"></iframe>
            </div>
            
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closePreviewCutiModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all">
                    Tutup
                </button>
                <a id="downloadCutiBtn" href="#" target="_blank" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-500 to-green-400 text-white font-semibold rounded-2xl hover:from-green-600 hover:to-green-500 shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3-7a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h4a1 1 0 110 2H7a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                    Download
                </a>
=======
    <!-- Modal Tambah Pengajuan Cuti -->
    <div id="tambahCutiModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-red-500 to-rose-500 backdrop-blur-md p-6 flex items-start justify-between z-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Tambah Pengajuan Cuti</h2>
                        <p class="text-sm text-red-100 mt-1">Buat pengajuan cuti baru untuk karyawan</p>
                    </div>
                </div>
                <button onclick="closeTambahCutiModal()"
                    class="p-2 hover:bg-white/20 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="tambahCutiForm" class="p-8 space-y-8">
                @csrf

                <!-- Section 1: Informasi Karyawan -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-red-100">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Karyawan</h3>
                            <p class="text-xs text-gray-500">Pilih karyawan yang mengajukan cuti</p>
                        </div>
                    </div>

                    <!-- Pilih Karyawan -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Pilih Karyawan
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="user_id" required
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all appearance-none bg-white hover:border-gray-300">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach (\App\Models\User::where('role', '!=', 'admin_hrd')->orderBy('name')->get() as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} • NIK: {{ $user->nik }} •
                                        {{ $user->departemen->nama ?? 'No Dept' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">
                            Pilih dari daftar karyawan aktif
                        </p>
                    </div>
                </div>

                <!-- Section 2: Detail Cuti -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-red-100">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Detail Cuti</h3>
                            <p class="text-xs text-gray-500">Isi informasi periode dan jenis cuti</p>
                        </div>
                    </div>

                    <!-- Jenis Cuti -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Jenis Cuti
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="jenis" required
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all appearance-none bg-white hover:border-gray-300">
                                <option value="">-- Pilih Jenis Cuti --</option>
                                <option value="Cuti Tahunan">📅 Cuti Tahunan</option>
                                <option value="Cuti Sakit">🏥 Cuti Sakit</option>
                                <option value="Cuti Menikah">💒 Cuti Menikah</option>
                                <option value="Cuti Melahirkan">👶 Cuti Melahirkan</option>
                                <option value="Cuti Keluarga Meninggal">🕊️ Cuti Keluarga Meninggal</option>
                                <option value="Cuti Besar">⭐ Cuti Besar</option>
                            </select>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tanggal Mulai & Selesai -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Tanggal Mulai
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" name="tanggal_mulai" required
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all hover:border-gray-300" />
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Tanggal Selesai
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="date" name="tanggal_selesai" required
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all hover:border-gray-300" />
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alasan -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Alasan Pengajuan Cuti
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alasan" rows="4" required
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all hover:border-gray-300 resize-none"
                            placeholder="Jelaskan alasan pengajuan cuti secara detail..."></textarea>
                        <p class="mt-2 text-xs text-gray-500">
                            Berikan alasan yang jelas dan lengkap
                        </p>
                    </div>

                    <!-- Status -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Status Pengajuan
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="status" required
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all appearance-none bg-white hover:border-gray-300">
                                <option value="Pending">⏳ Pending (Menunggu Persetujuan)</option>
                                <option value="Disetujui">✅ Disetujui</option>
                                <option value="Ditolak">❌ Ditolak</option>
                            </select>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6 border-t-2 border-gray-100">
                    <button type="button" onclick="closeTambahCutiModal()"
                        class="flex-1 px-6 py-3.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-red-700 shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data Cuti -->
    <div id="editCutiModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-amber-500 to-orange-500 backdrop-blur-md p-6 flex items-start justify-between z-10">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Data Cuti</h2>
                        <p class="text-sm text-amber-100 mt-1">Ubah informasi pengajuan cuti sebelum membuat surat</p>
                    </div>
                </div>
                <button onclick="closeEditCutiModal()"
                    class="p-2 hover:bg-white/20 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="editCutiForm" class="p-8 space-y-8">
                @csrf
                <input type="hidden" id="editCutiIdField" name="cuti_id">

                <!-- Info Karyawan (Read-only) -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border-2 border-amber-200">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Karyawan</h3>
                            <p class="text-xs text-gray-600">Data karyawan tidak dapat diubah</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-amber-200/50">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs font-medium text-gray-600">Nama Lengkap</span>
                            </div>
                            <span id="editCutiKaryawanNama" class="text-sm font-bold text-gray-900">-</span>
                        </div>
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-amber-200/50">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                <span class="text-xs font-medium text-gray-600">NIK</span>
                            </div>
                            <span id="editCutiKaryawanNik" class="text-sm font-bold text-gray-900">-</span>
                        </div>
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-amber-200/50">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-medium text-gray-600">Jabatan</span>
                            </div>
                            <span id="editCutiKaryawanJabatan" class="text-sm font-bold text-gray-900">-</span>
                        </div>
                        <div class="bg-white/60 backdrop-blur-sm rounded-xl p-4 border border-amber-200/50">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-xs font-medium text-gray-600">Departemen</span>
                            </div>
                            <span id="editCutiKaryawanDept" class="text-sm font-bold text-gray-900">-</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Detail Cuti -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-amber-100">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Detail Cuti yang Dapat Diubah</h3>
                            <p class="text-xs text-gray-500">Pastikan data yang diinput sudah benar</p>
                        </div>
                    </div>

                    <!-- Jenis Cuti -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Jenis Cuti
                        </label>
                        <div class="relative">
                            <select id="editCutiJenis" name="jenis"
                                class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all appearance-none bg-white hover:border-gray-300">
                                <option value="Cuti Tahunan">📅 Cuti Tahunan</option>
                                <option value="Cuti Sakit">🏥 Cuti Sakit</option>
                                <option value="Cuti Menikah">💒 Cuti Menikah</option>
                                <option value="Cuti Melahirkan">👶 Cuti Melahirkan</option>
                                <option value="Cuti Keluarga Meninggal">🕊️ Cuti Keluarga Meninggal</option>
                                <option value="Cuti Besar">⭐ Cuti Besar</option>
                            </select>
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Periode Cuti -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Tanggal Mulai
                            </label>
                            <div class="relative">
                                <input type="date" id="editCutiTanggalMulai" name="tanggal_mulai"
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all hover:border-gray-300" />
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Tanggal Selesai
                            </label>
                            <div class="relative">
                                <input type="date" id="editCutiTanggalSelesai" name="tanggal_selesai"
                                    class="w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all hover:border-gray-300" />
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alasan -->
                    <div class="relative">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Alasan Cuti
                        </label>
                        <textarea id="editCutiAlasan" name="alasan" rows="4"
                            class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all hover:border-gray-300 resize-none"
                            placeholder="Jelaskan alasan pengajuan cuti..."></textarea>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6 border-t-2 border-gray-100">
                    <button type="button" onclick="closeEditCutiModal()"
                        class="flex-1 px-6 py-3.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-6 py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-amber-700 shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Surat -->
    <div id="editSuratModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-amber-50/80 to-orange-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Edit Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Ubah data surat cuti sebelum finalisasi</p>
                </div>
                <button onclick="closeEditSuratModal()"
                    class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="editSuratForm" class="p-8 space-y-6">
                @csrf
                <input type="hidden" id="editSuratId" name="surat_id">
                <input type="hidden" id="editCutiId" name="cuti_id">

                <!-- Nomor Surat -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Surat</label>
                    <input type="text" id="editNomorSurat" name="nomor_surat"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        placeholder="Contoh: 001/KJT-HRD/II/2026" />
                </div>

                <!-- Info Karyawan (Read-only) -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Informasi Karyawan</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Nama:</span>
                            <span id="editKaryawanNama" class="font-medium text-gray-900 ml-2">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">NIK:</span>
                            <span id="editKaryawanNik" class="font-medium text-gray-900 ml-2">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Jabatan:</span>
                            <span id="editKaryawanJabatan" class="font-medium text-gray-900 ml-2">-</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Departemen:</span>
                            <span id="editKaryawanDept" class="font-medium text-gray-900 ml-2">-</span>
                        </div>
                    </div>
                </div>

                <!-- Jenis Cuti (Read-only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Cuti</label>
                    <input type="text" id="editJenisCuti" readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-700" />
                </div>

                <!-- Periode Cuti -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="editTanggalMulai" name="tanggal_mulai"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" id="editTanggalSelesai" name="tanggal_selesai"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent" />
                    </div>
                </div>

                <!-- Alasan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Cuti</label>
                    <textarea id="editAlasan" name="alasan" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent"></textarea>
                </div>

                <!-- Catatan Tambahan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                    <textarea id="editCatatan" name="catatan" rows="2"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        placeholder="Catatan khusus untuk surat ini..."></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-100/40">
                    <button type="button" onclick="closeEditSuratModal()"
                        class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-2xl hover:from-amber-600 hover:to-amber-700 shadow-sm hover:shadow-md transition-all duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Preview Surat -->
    <div id="previewSuratModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div
            class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div
                class="sticky top-0 bg-gradient-to-r from-blue-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Preview Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Pratinjau surat sebelum dibuat</p>
                </div>
                <button onclick="closePreviewSuratModal()"
                    class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8">
                <div id="previewSuratContent"
                    class="bg-white border border-gray-200 rounded-xl p-8 min-h-[600px] shadow-inner">
                    <div class="text-center text-gray-400 py-12">
                        <svg class="w-12 h-12 mx-auto mb-3 animate-spin" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Memuat preview...
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 mt-6">
                    <button onclick="closePreviewSuratModal()"
                        class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                    <button id="btnBuatFromPreview"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-2xl hover:from-blue-600 hover:to-blue-700 shadow-sm hover:shadow-md transition-all duration-300">
                        Lanjut Buat Surat
                    </button>
                </div>
>>>>>>> Stashed changes
            </div>
        </div>
    </div>

    <script>
        let currentRequestStatus = 'pending'; // track status: pending, approved, rejected

        // Tab switching function
        function showTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.add('hidden'));

            // Show selected tab
            const selectedTab = document.getElementById(`tab-${tabName}`);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Update button styles
            const buttons = document.querySelectorAll('.tab-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active-tab', 'border-b-indigo-500', 'text-gray-900');
                btn.classList.add('border-b-transparent', 'text-gray-600');
                if (btn.dataset.tab === tabName) {
                    btn.classList.add('active-tab', 'border-b-indigo-500', 'text-gray-900');
                }
            });
        }

        function openDetailModal(status = 'pending', cutiId = null) {
            currentRequestStatus = status || 'pending';
            const modal = document.getElementById('detailModal');
            const buatSuratBtn = document.getElementById('buatSuratBtn');

            // Get row element
            const rowElement = document.querySelector(`[data-id="${cutiId}"]`);
            if (!rowElement) return;

            // Extract data from row attributes
            const employeeName = rowElement.dataset.name || '-';
            const employeeNik = rowElement.dataset.nik || '-';
            const employeeEmail = rowElement.dataset.email || '-';
            const employeeDept = rowElement.dataset.dept || '-';
            const createdDate = rowElement.dataset.created || '-';
            const approvedDate = rowElement.dataset.approved || null;
            const jenis = rowElement.dataset.jenis || '-';
            const tanggalMulai = rowElement.dataset.tanggalMulai || '-';
            const tanggalSelesai = rowElement.dataset.tanggalSelesai || '-';
            const durasi = rowElement.dataset.durasi || '-';
            const alasan = rowElement.dataset.alasan || '-';

            // Set data to modal
            modal.dataset.cutiId = cutiId || '';

            // Update employee info in modal
            document.getElementById('employeeName').textContent = employeeName;
            document.getElementById('employeeIdDept').textContent = `ID: ${employeeNik} • Departemen: ${employeeDept}`;
            document.getElementById('employeeEmail').textContent = `Email: ${employeeEmail}`;

            // Update cuti details
            document.querySelectorAll('[data-detail]').forEach(el => {
                const detailKey = el.dataset.detail;
                if (detailKey === 'jenis') el.textContent = jenis;
                if (detailKey === 'durasi') el.textContent = durasi;
                if (detailKey === 'tanggal-mulai') el.textContent = tanggalMulai;
                if (detailKey === 'tanggal-selesai') el.textContent = tanggalSelesai;
            });

            // Update alasan
            const alasanEl = document.getElementById('alasanText');
            if (alasanEl) alasanEl.textContent = alasan;

            // Update timeline/riwayat
            updateTimelineDisplay(status, createdDate, approvedDate);

            // Update buat surat confirmation modal
            document.getElementById('buatSuratEmployeeName').textContent = employeeName;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Update status badge berdasarkan status
            const statusBadge = document.getElementById('statusBadge');
            const statusText = document.getElementById('statusText');

            if (status === 'approved') {
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-green-50/40 border border-green-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-green-500/80"></div><span class="font-medium text-green-700/80">Status: <span id="statusText">Disetujui Direktur</span></span>';
                buatSuratBtn.classList.remove('hidden');
                buatSuratBtn.classList.add('flex');
            } else if (status === 'rejected') {
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-red-50/40 border border-red-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-red-500/80"></div><span class="font-medium text-red-700/80">Status: <span id="statusText">Ditolak</span></span>';
                buatSuratBtn.classList.add('hidden');
            } else {
                // pending
                statusBadge.className =
                    'flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit';
                statusBadge.innerHTML =
                    '<div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div><span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>';
                buatSuratBtn.classList.add('hidden');
            }
        }

        function updateTimelineDisplay(status, createdDate, approvedDate) {
            const timelineContainer = document.getElementById('timelineContainer');
            if (!timelineContainer) return;

            let timelineHTML = '';

            // Timeline item 1: Pengajuan dibuat
            timelineHTML += `
                <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-blue-50/40 to-slate-50/30 rounded-2xl border border-blue-100/30">
                    <div class="w-2 h-2 rounded-full bg-blue-500/80 mt-2 flex-shrink-0"></div>
                    <div class="flex-1 text-sm">
                        <p class="font-medium text-gray-900">Pengajuan Dibuat</p>
                        <p class="text-gray-600">${createdDate}</p>
                    </div>
                </div>
            `;

            // Timeline item 2: Status sesuai kondisi
            if (status === 'approved' && approvedDate) {
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-green-50/40 to-slate-50/30 rounded-2xl border border-green-100/30">
                        <div class="w-2 h-2 rounded-full bg-green-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Disetujui Direktur</p>
                            <p class="text-gray-600">${approvedDate}</p>
                        </div>
                    </div>
                `;
            } else if (status === 'rejected') {
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-red-50/40 to-slate-50/30 rounded-2xl border border-red-100/30">
                        <div class="w-2 h-2 rounded-full bg-red-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Ditolak</p>
                            <p class="text-gray-600">${approvedDate || 'Belum diproses'}</p>
                        </div>
                    </div>
                `;
            } else {
                // pending
                timelineHTML += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50/40 to-slate-50/30 rounded-2xl border border-gray-100/30">
                        <div class="w-2 h-2 rounded-full bg-gray-400/50 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Menunggu Persetujuan Direktur</p>
                            <p class="text-gray-600">Belum diproses</p>
                        </div>
                    </div>
                `;
            }

            timelineContainer.innerHTML = timelineHTML;
        }

        // Show detail modal dengan data cuti
        async function showDetailCuti(cutiId) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}`);
                const data = await response.json();

                if (!data || !data.cuti) {
                    showNotification('Gagal memuat data cuti', 'error');
                    return;
                }

                const cuti = data.cuti;
                const modal = document.getElementById('detailModal');

                // Set employee info
                document.getElementById('employeeName').textContent = cuti.user?.name || '-';
                document.getElementById('employeeIdDept').textContent = 
                    `${cuti.user?.nip || 'N/A'} • ${cuti.user?.departemen?.nama || 'N/A'}`;
                document.getElementById('employeeEmail').textContent = cuti.user?.email || '-';

                // Set status badge
                const statusBadge = document.getElementById('statusBadge');
                const statusText = document.getElementById('statusText');
                let statusColor = 'bg-amber-50/40 border-amber-100/30';
                let statusDotColor = 'bg-amber-500/80';
                let statusLabel = 'Menunggu Persetujuan';

                if (cuti.status === 'Disetujui') {
                    statusColor = 'bg-green-50/40 border-green-100/30';
                    statusDotColor = 'bg-green-500/80';
                    statusLabel = 'Disetujui Direktur';
                } else if (cuti.status === 'Ditolak') {
                    statusColor = 'bg-red-50/40 border-red-100/30';
                    statusDotColor = 'bg-red-500/80';
                    statusLabel = 'Ditolak';
                }

                statusBadge.className = `flex items-center gap-2 p-3 rounded-2xl w-fit ${statusColor}`;
                statusBadge.querySelector('.w-3').className = `w-3 h-3 rounded-full ${statusDotColor} animate-pulse`;
                statusText.textContent = statusLabel;

                // Set cuti details
                document.querySelector('[data-detail="jenis"]').textContent = cuti.jenis || '-';
                document.querySelector('[data-detail="durasi"]').textContent = (cuti.durasi_hari || cuti.durasi || 0) + ' hari';
                document.querySelector('[data-detail="tanggal-mulai"]').textContent = 
                    new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
                document.querySelector('[data-detail="tanggal-selesai"]').textContent = 
                    new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });

                // Set alasan
                document.getElementById('alasanText').textContent = cuti.alasan || '-';

                // Set timeline
                const timelineContainer = document.getElementById('timelineContainer');
                let timelineHTML = '';

                if (cuti.status === 'Disetujui') {
                    timelineHTML += `
                        <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-green-50/40 to-slate-50/30 rounded-2xl border border-green-100/30">
                            <div class="w-2 h-2 rounded-full bg-green-500/80 mt-2 flex-shrink-0"></div>
                            <div class="flex-1 text-sm">
                                <p class="font-medium text-gray-900">Disetujui oleh Direktur</p>
                                <p class="text-gray-600">${cuti.tanggal_persetujuan ? new Date(cuti.tanggal_persetujuan).toLocaleDateString('id-ID') : 'N/A'}</p>
                            </div>
                        </div>
                    `;
                } else if (cuti.status === 'Ditolak') {
                    timelineHTML += `
                        <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-red-50/40 to-slate-50/30 rounded-2xl border border-red-100/30">
                            <div class="w-2 h-2 rounded-full bg-red-500/80 mt-2 flex-shrink-0"></div>
                            <div class="flex-1 text-sm">
                                <p class="font-medium text-gray-900">Ditolak oleh Direktur</p>
                                <p class="text-gray-600">${cuti.keterangan_persetujuan || 'Tidak ada keterangan'}</p>
                            </div>
                        </div>
                    `;
                } else {
                    timelineHTML += `
                        <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50/40 to-slate-50/30 rounded-2xl border border-gray-100/30">
                            <div class="w-2 h-2 rounded-full bg-gray-400/50 mt-2 flex-shrink-0"></div>
                            <div class="flex-1 text-sm">
                                <p class="font-medium text-gray-900">Menunggu Persetujuan Direktur</p>
                                <p class="text-gray-600">Belum diproses</p>
                            </div>
                        </div>
                    `;
                }

                timelineContainer.innerHTML = timelineHTML;

                // Set button visibility
                const buatSuratBtn = document.getElementById('buatSuratBtn');
                const lihatSuratBtn = document.getElementById('lihatSuratBtn');
                
                if (cuti.file_surat) {
                    // Ada surat - tampilkan tombol lihat surat
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) {
                        lihatSuratBtn.classList.remove('hidden');
                        lihatSuratBtn.onclick = () => previewCutiFromModal(cuti.id, cuti.user?.name || 'N/A');
                    }
                } else if (cuti.status === 'Disetujui') {
                    // Disetujui tapi belum ada surat - tampilkan tombol buat surat
                    buatSuratBtn.classList.remove('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                    buatSuratBtn.onclick = () => openBuatSuratModal(cuti.id, cuti.user?.name || 'N/A');
                } else {
                    // Pending atau ditolak - sembunyikan semua button (cuma tutup)
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                }

                // Store cutiId in modal for later use
                modal.dataset.cutiId = cutiId;

                // Show modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat data cuti', 'error');
            }
        }

        // Preview surat cuti dari modal
        async function previewCutiFromModal(cutiId, namaKaryawan) {
            // Jika dipanggil dari button di modal tanpa parameter, ambil dari modal
            if (!cutiId) {
                const modal = document.getElementById('detailModal');
                cutiId = modal.dataset.cutiId;
                namaKaryawan = document.getElementById('employeeName').textContent;
            }

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/preview`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.pdfBase64) {
                    document.getElementById('previewCutiFrame').src = 
                        'data:application/pdf;base64,' + data.pdfBase64;
                    document.getElementById('downloadCutiBtn').href = data.downloadUrl;
                    document.getElementById('previewCutiTitle').textContent = 
                        `Surat Cuti - ${namaKaryawan}`;
                    document.getElementById('previewSuratCutiModal').classList.remove('hidden');
                } else {
                    showNotification('✗ Gagal memuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat memuat surat', 'error');
            }
        }

        // Buka modal buat surat
        function openBuatSuratModal(cutiId, namaKaryawan) {
            const modal = document.getElementById('detailModal');
            modal.dataset.cutiId = cutiId;
            document.getElementById('buatSuratEmployeeName').textContent = namaKaryawan;
            document.getElementById('buatSuratModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function buatSurat() {
            document.getElementById('buatSuratModal').classList.remove('hidden');
        }

        function closeBuatSuratModal() {
            document.getElementById('buatSuratModal').classList.add('hidden');
        }

        function confirmBuatSurat() {
            const modal = document.getElementById('detailModal');
            const cutiId = modal.dataset.cutiId;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            if (!cutiId) {
                showNotification('Error: ID cuti tidak ditemukan', 'error');
                return;
            }

            // Show loading state
            const btn = event.target;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Membuat...';

            fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        closeBuatSuratModal();
                        showPdfPreviewModal(data.url);
                        showNotification('Surat berhasil dibuat!', 'success');
                    } else {
                        showNotification(`Error: ${data.message}`, 'error');
                    }
                })
                .catch(error => {
                    showNotification(`Error: ${error.message}`, 'error');
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.textContent = originalText;
                });
        }

        function showPdfPreviewModal(previewUrl) {
            // Create modal if not exists
            let previewModal = document.getElementById('pdfPreviewModal');
            if (!previewModal) {
                previewModal = document.createElement('div');
                previewModal.id = 'pdfPreviewModal';
                previewModal.className =
                    'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-2 hidden';
                previewModal.innerHTML = `
                    <div class="bg-white rounded-lg shadow-2xl w-full h-full max-h-screen flex flex-col">
                        <!-- Header -->
                        <div class="flex items-center justify-between p-6 border-b border-gray-200 bg-white">
                            <h3 class="text-xl font-bold text-gray-900">Preview Surat Cuti</h3>
                            <button onclick="closePdfPreviewModal()" class="text-gray-500 hover:text-gray-700 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- PDF Viewer -->
                        <div class="flex-1 overflow-hidden bg-gray-100 p-4">
                            <iframe id="pdfViewer" src="" class="w-full h-full border-0 rounded" style="display: none;"></iframe>
                            <div id="pdfLoading" class="flex items-center justify-center h-full">
                                <div class="text-center">
                                    <div class="inline-block">
                                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-500"></div>
                                    </div>
                                    <p class="mt-4 text-gray-600">Memuat PDF...</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="flex items-center justify-between p-6 border-t border-gray-200 bg-gray-50">
                            <button onclick="downloadCurrentPdf()" class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-medium rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all shadow-sm flex items-center gap-2">
                                <svg class="inline-block w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </button>
                            <button onclick="closePdfPreviewModal()" class="px-6 py-2 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition-all">
                                Tutup
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(previewModal);
            }

            // Set PDF source
            const iframe = previewModal.querySelector('#pdfViewer');
            const loading = previewModal.querySelector('#pdfLoading');

            // Store URL globally for download
            window.currentPdfUrl = previewUrl;

            iframe.src = previewUrl;

            iframe.onload = () => {
                loading.style.display = 'none';
                iframe.style.display = 'block';
            };

            // Show modal
            previewModal.classList.remove('hidden');
        }

        function downloadCurrentPdf() {
            if (!window.currentPdfUrl) return;

            const a = document.createElement('a');
            a.href = window.currentPdfUrl;
            a.download = window.currentPdfUrl.split('/').pop();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            showNotification('✓ PDF berhasil diunduh!', 'success');
        }

        function closePdfPreviewModal() {
            const previewModal = document.getElementById('pdfPreviewModal');
            if (previewModal) {
                previewModal.classList.add('hidden');
            }
        }

        function showNotification(message, type = 'info') {
            // Create notification if not exists
            let notification = document.getElementById('notification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'notification';
                notification.className = 'fixed top-4 right-4 max-w-md z-[60] hidden';
                document.body.appendChild(notification);
            }

            // Set colors based on type
            let bgColor = 'bg-blue-500';
            if (type === 'success') bgColor = 'bg-green-500';
            if (type === 'error') bgColor = 'bg-red-500';

            notification.innerHTML = `
                <div class="rounded-lg shadow-lg p-4 text-white ${bgColor} flex items-center gap-3">
                    <span>${message}</span>
                </div>
            `;
            notification.classList.remove('hidden');

            // Auto hide after 4 seconds
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 4000);
        }

        // Buat surat dari cuti yang sudah disetujui
        async function buatSuratCuti(cutiId) {
            if (!confirm('Buat surat resmi untuk pengajuan cuti ini?')) {
                return;
            }

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✓ Surat berhasil dibuat!', 'success');
                    // Reload halaman setelah 1 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('✗ ' + (data.message || 'Gagal membuat surat'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat membuat surat', 'error');
            }
        }

        // Preview surat cuti
        async function previewCuti(cutiId, namaKaryawan) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}/preview`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.pdfBase64) {
                    // Set PDF in iframe
                    document.getElementById('previewCutiFrame').src = 
                        'data:application/pdf;base64,' + data.pdfBase64;
                    
                    // Set download button
                    document.getElementById('downloadCutiBtn').href = data.downloadUrl;
                    
                    // Set title
                    document.getElementById('previewCutiTitle').textContent = 
                        `Surat Cuti - ${namaKaryawan}`;
                    
                    // Show modal
                    document.getElementById('previewSuratCutiModal').classList.remove('hidden');
                } else {
                    showNotification('✗ Gagal memuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat memuat surat', 'error');
            }
        }

        function closePreviewCutiModal() {
            document.getElementById('previewSuratCutiModal').classList.add('hidden');
            document.getElementById('previewCutiFrame').src = '';
        }

        // Close modal when clicking outside
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });

        document.getElementById('buatSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeBuatSuratModal();
        });

<<<<<<< Updated upstream
        document.getElementById('previewSuratCutiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closePreviewCutiModal();
        });

        // Event delegation untuk preview buttons di list
        document.addEventListener('click', function(e) {
            const previewBtn = e.target.closest('.btn-preview-cuti');
            if (previewBtn) {
                const cutiId = previewBtn.dataset.cutiId;
                const namaKaryawan = previewBtn.dataset.namaKaryawan;
                previewCuti(cutiId, namaKaryawan);
            }
        });

        // Add click handler untuk lihat surat button di modal
        document.getElementById('lihatSuratBtn')?.addEventListener('click', function() {
            previewCutiFromModal();
        });
=======
        document.getElementById('tambahCutiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeTambahCutiModal();
        });

        document.getElementById('previewSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closePreviewSuratModal();
        });

        document.getElementById('editSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeEditSuratModal();
        });

        document.getElementById('editCutiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeEditCutiModal();
        });

        // ========== MODAL EDIT DATA CUTI ==========
        async function editCutiData(cutiId) {
            const modal = document.getElementById('editCutiModal');
            document.getElementById('editCutiIdField').value = cutiId;

            try {
                // Fetch cuti data
                const response = await fetch(`/admin/cuti/${cutiId}/detail`);

                if (!response.ok) {
                    throw new Error('Failed to fetch cuti data');
                }

                const cutiData = await response.json();

                // Populate karyawan info
                if (cutiData.user) {
                    document.getElementById('editCutiKaryawanNama').textContent = cutiData.user.name || '-';
                    document.getElementById('editCutiKaryawanNik').textContent = cutiData.user.nik || '-';
                    document.getElementById('editCutiKaryawanJabatan').textContent = cutiData.user.jabatan || '-';
                    document.getElementById('editCutiKaryawanDept').textContent = cutiData.user.departemen?.nama || '-';
                }

                // Populate cuti data
                document.getElementById('editCutiJenis').value = cutiData.jenis || '';
                document.getElementById('editCutiTanggalMulai').value = cutiData.tanggal_mulai || '';
                document.getElementById('editCutiTanggalSelesai').value = cutiData.tanggal_selesai || '';
                document.getElementById('editCutiAlasan').value = cutiData.alasan || '';

                // Show modal
                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error loading cuti data:', error);
                showNotification('✗ Gagal memuat data cuti', 'error');
            }
        }

        function closeEditCutiModal() {
            document.getElementById('editCutiModal').classList.add('hidden');
        }

        // Handle edit cuti form submit
        document.getElementById('editCutiForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const cutiId = document.getElementById('editCutiIdField').value;
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Disable button & show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/update`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✓ Data cuti berhasil diupdate!', 'success');
                    closeEditCutiModal();
                    // Reload halaman setelah 1 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('✗ ' + (data.message || 'Gagal mengupdate data cuti'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat mengupdate data cuti', 'error');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        // ========== MODAL EDIT SURAT ==========
        async function editSurat(suratId, cutiId) {
            const modal = document.getElementById('editSuratModal');

            // Set IDs
            document.getElementById('editSuratId').value = suratId;
            document.getElementById('editCutiId').value = cutiId;

            try {
                // Fetch surat and cuti data
                const [suratRes, cutiRes] = await Promise.all([
                    fetch(`/admin/surat/${suratId}`),
                    fetch(`/admin/cuti/${cutiId}/detail`)
                ]);

                if (!suratRes.ok || !cutiRes.ok) {
                    throw new Error('Failed to fetch data');
                }

                const suratResponse = await suratRes.json();
                const cutiData = await cutiRes.json();
                const suratData = suratResponse.surat || suratResponse;

                // Populate form with surat data
                document.getElementById('editNomorSurat').value = suratData.nomor_surat || '';

                // Populate karyawan info
                if (cutiData.user) {
                    document.getElementById('editKaryawanNama').textContent = cutiData.user.name || '-';
                    document.getElementById('editKaryawanNik').textContent = cutiData.user.nik || '-';
                    document.getElementById('editKaryawanJabatan').textContent = cutiData.user.jabatan || '-';
                    document.getElementById('editKaryawanDept').textContent = cutiData.user.departemen?.nama || '-';
                }

                // Populate cuti data
                document.getElementById('editJenisCuti').value = cutiData.jenis || '';
                document.getElementById('editTanggalMulai').value = cutiData.tanggal_mulai || '';
                document.getElementById('editTanggalSelesai').value = cutiData.tanggal_selesai || '';
                document.getElementById('editAlasan').value = cutiData.alasan || '';
                document.getElementById('editCatatan').value = suratData.keterangan || '';

                // Show modal
                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error loading surat data:', error);
                showNotification('✗ Gagal memuat data surat', 'error');
            }
        }

        function closeEditSuratModal() {
            document.getElementById('editSuratModal').classList.add('hidden');
        }

        // Handle edit surat form submit
        document.getElementById('editSuratForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const suratId = document.getElementById('editSuratId').value;
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Disable button & show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            try {
                const response = await fetch(`/admin/surat/${suratId}/update`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✓ Surat berhasil diupdate!', 'success');
                    closeEditSuratModal();
                    // Reload halaman setelah 1 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('✗ ' + (data.message || 'Gagal mengupdate surat'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat mengupdate surat', 'error');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        // ========== MODAL TAMBAH PENGAJUAN CUTI ==========
        function openTambahCutiModal() {
            document.getElementById('tambahCutiModal').classList.remove('hidden');
            document.getElementById('tambahCutiForm').reset();
        }

        function closeTambahCutiModal() {
            document.getElementById('tambahCutiModal').classList.add('hidden');
        }

        // Handle form submit untuk tambah cuti
        document.getElementById('tambahCutiForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Disable button & show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            try {
                const response = await fetch('/admin/cuti/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✓ Pengajuan cuti berhasil ditambahkan!', 'success');
                    closeTambahCutiModal();
                    // Reload halaman setelah 1 detik
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showNotification('✗ ' + (data.message || 'Gagal menambahkan pengajuan cuti'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('✗ Terjadi kesalahan saat menambahkan pengajuan cuti', 'error');
            } finally {
                // Re-enable button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        // ========== MODAL PREVIEW SURAT ==========
        let currentPreviewCutiId = null;

        async function previewSuratCuti(cutiId) {
            currentPreviewCutiId = cutiId;
            const modal = document.getElementById('previewSuratModal');
            const content = document.getElementById('previewSuratContent');

            // Show modal with loading state
            modal.classList.remove('hidden');
            content.innerHTML = `
                <div class="text-center text-gray-400 py-12">
                    <svg class="w-12 h-12 mx-auto mb-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-2">Memuat preview surat...</p>
                </div>
            `;

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/preview`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    const html = await response.text();
                    content.innerHTML = html;
                } else {
                    content.innerHTML = `
                        <div class="text-center text-red-500 py-12">
                            <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>Gagal memuat preview surat</p>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                content.innerHTML = `
                    <div class="text-center text-red-500 py-12">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p>Terjadi kesalahan saat memuat preview</p>
                    </div>
                `;
            }
        }

        function closePreviewSuratModal() {
            document.getElementById('previewSuratModal').classList.add('hidden');
            currentPreviewCutiId = null;
        }

        // Handle button "Lanjut Buat Surat" dari preview modal
        document.getElementById('btnBuatFromPreview')?.addEventListener('click', function() {
            if (currentPreviewCutiId) {
                closePreviewSuratModal();
                buatSuratCuti(currentPreviewCutiId);
            }
        });

        // ========== SEARCH & FILTER FUNCTIONALITY ==========
        let allCutiCards = [];
        let currentPage = 1;
        const itemsPerPage = 10;

        // Initialize: get all cuti cards
        function initializeCards() {
            allCutiCards = Array.from(document.querySelectorAll('#cutiListContainer > div:not(.text-center)'));
            updatePagination();
        }

        // Call on page load
        initializeCards();

        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            filterCards();
        });

        // Filter by status
        document.getElementById('filterStatus')?.addEventListener('change', function(e) {
            filterCards();
        });

        // Filter by departemen
        document.getElementById('filterDepartemen')?.addEventListener('change', function(e) {
            filterCards();
        });

        // Sort functionality
        document.getElementById('sortBy')?.addEventListener('change', function(e) {
            sortCards(e.target.value);
        });

        // Sort cards function
        function sortCards(sortType) {
            const container = document.getElementById('cutiListContainer');
            const cards = Array.from(container.querySelectorAll(':scope > div:not(.empty-message)'));

            cards.sort((a, b) => {
                if (sortType === 'newest' || sortType === 'oldest') {
                    // Get date from "Diajukan" field
                    const dateA = a.querySelector('[class*="Diajukan"]')?.nextElementSibling?.textContent || '';
                    const dateB = b.querySelector('[class*="Diajukan"]')?.nextElementSibling?.textContent || '';
                    const compare = dateA.localeCompare(dateB);
                    return sortType === 'newest' ? -compare : compare;
                } else if (sortType === 'name-asc' || sortType === 'name-desc') {
                    const nameA = a.querySelector('h3')?.textContent.trim().toLowerCase() || '';
                    const nameB = b.querySelector('h3')?.textContent.trim().toLowerCase() || '';
                    const compare = nameA.localeCompare(nameB);
                    return sortType === 'name-asc' ? compare : -compare;
                }
                return 0;
            });

            // Re-append cards in sorted order
            cards.forEach(card => container.appendChild(card));

            // Reapply filters
            filterCards();
        }

        // Main filter function
        function filterCards() {
            const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';
            const statusFilter = document.getElementById('filterStatus')?.value || '';
            const departemenFilter = document.getElementById('filterDepartemen')?.value || '';

            let visibleCount = 0;

            allCutiCards.forEach(card => {
                const cardText = card.textContent.toLowerCase();
                const matchesSearch = cardText.includes(searchTerm);
                const matchesStatus = !statusFilter || cardText.includes(statusFilter.toLowerCase());
                const matchesDepartemen = !departemenFilter || cardText.includes(departemenFilter.toLowerCase());

                if (matchesSearch && matchesStatus && matchesDepartemen) {
                    card.classList.remove('filtered-out');
                    visibleCount++;
                } else {
                    card.classList.add('filtered-out');
                }
            });

            // Update visible count
            const visibleCountEl = document.getElementById('visibleCount');
            if (visibleCountEl) {
                visibleCountEl.textContent = visibleCount;
            }

            // Reset to first page when filtering
            currentPage = 1;
            updatePagination();

            // Show/hide empty message
            const container = document.getElementById('cutiListContainer');
            let emptyMsg = container.querySelector('.empty-message');

            if (visibleCount === 0) {
                if (!emptyMsg) {
                    emptyMsg = document.createElement('div');
                    emptyMsg.className = 'empty-message text-center py-12 text-gray-500';
                    emptyMsg.innerHTML = `
                        <svg class=\"w-16 h-16 mx-auto mb-4 text-gray-300\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\">
                            <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\" />
                        </svg>
                        <p class=\"text-lg font-medium\">Tidak ada data yang sesuai</p>
                        <p class=\"text-sm mt-2\">Coba ubah filter atau kata kunci pencarian</p>
                    `;
                    container.appendChild(emptyMsg);
                }
                emptyMsg.style.display = '';
                document.getElementById('paginationControls').style.display = 'none';
            } else {
                if (emptyMsg) {
                    emptyMsg.style.display = 'none';
                }
                document.getElementById('paginationControls').style.display = 'flex';
            }
        }

        // Quick filter buttons
        function quickFilter(status) {
            // Update active button
            document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Apply filter
            const statusSelect = document.getElementById('filterStatus');
            if (status === 'all') {
                statusSelect.value = '';
            } else {
                statusSelect.value = status;
            }

            filterCards();
        }

        // Reset all filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterDepartemen').value = '';
            document.getElementById('sortBy').value = 'newest';

            // Reset active button to "Semua"
            document.querySelectorAll('.quick-filter-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-filter') === 'all') {
                    btn.classList.add('active');
                }
            });

            // Reset page to 1
            currentPage = 1;

            // Reset sort and filter
            sortCards('newest');
            filterCards();
        }

        // ========== PAGINATION FUNCTIONALITY ==========
        function updatePagination() {
            // Get filtered cards (not hidden by filters)
            const visibleCards = allCutiCards.filter(card => !card.classList.contains('filtered-out'));
            const totalPages = Math.ceil(visibleCards.length / itemsPerPage);

            // Hide all cards first
            allCutiCards.forEach(card => {
                card.style.display = 'none';
            });

            // Show only cards for current page
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageCards = visibleCards.slice(startIndex, endIndex);

            pageCards.forEach(card => {
                card.style.display = '';
            });

            // Update pagination controls
            document.getElementById('currentPageDisplay').textContent = currentPage;
            document.getElementById('totalPagesDisplay').textContent = totalPages || 1;

            // Enable/disable buttons
            const btnPrev = document.getElementById('btnPrevPage');
            const btnNext = document.getElementById('btnNextPage');

            btnPrev.disabled = currentPage === 1;
            btnNext.disabled = currentPage >= totalPages;

            // Generate page numbers
            const pageNumbersContainer = document.getElementById('pageNumbers');
            pageNumbersContainer.innerHTML = '';

            // Show max 5 page numbers
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);

            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }

            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.onclick = () => goToPage(i);
                pageBtn.className = `px-3 py-1.5 rounded-lg text-sm font-medium transition-colors ${
                    i === currentPage 
                        ? 'bg-gradient-to-r from-red-500 to-red-600 text-white' 
                        : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                }`;
                pageNumbersContainer.appendChild(pageBtn);
            }

            // Scroll to top of list
            document.getElementById('cutiListContainer').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function nextPage() {
            const visibleCards = allCutiCards.filter(card => !card.classList.contains('filtered-out'));
            const totalPages = Math.ceil(visibleCards.length / itemsPerPage);

            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
            }
        }

        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        }

        function goToPage(page) {
            currentPage = page;
            updatePagination();
        }
>>>>>>> Stashed changes
    </script>

    <style>
        /* Quick Filter Button Styles */
        .quick-filter-btn {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        .quick-filter-btn:hover {
            background-color: #e5e7eb;
        }

        .quick-filter-btn.active {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-weight: 600;
        }
    </style>
</x-app-layout>
