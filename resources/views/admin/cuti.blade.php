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
            <div class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pengajuan Cuti</h1>
                        <p class="text-gray-600 text-base">Monitor dan kelola semua pengajuan cuti dari karyawan</p>
                    </div>
                    <button onclick="showCreateCutiModal()"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-2xl hover:from-red-700 hover:to-red-600 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 w-fit">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Buat Pengajuan
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Menunggu Persetujuan -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-2.414 2.414a1 1 0 101.414 1.414L9 11.414V6z" clip-rule="evenodd" />
                                </svg>
                            </div>
<<<<<<< Updated upstream
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                                <p class="text-2xl font-bold text-gray-900" id="pendingCount">0</p>
=======
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
>>>>>>> Stashed changes
                            </div>
                        </div>
                    </div>
                    
                    <!-- Disetujui -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Disetujui</p>
                                <p class="text-2xl font-bold text-gray-900" id="approvedCount">0</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ditolak -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-red-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Ditolak</p>
                                <p class="text-2xl font-bold text-gray-900" id="rejectedCount">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<<<<<<< Updated upstream
            <!-- Tabs -->
            <div class="flex gap-4 mb-6 border-b border-gray-100">
                <button onclick="switchTabCuti('pengajuan')" id="tabPengajuan"
                    class="px-6 py-3 font-semibold text-amber-600 border-b-2 border-amber-500 whitespace-nowrap">
                    📋 Pengajuan Cuti (Pending)
                </button>
                <button onclick="switchTabCuti('dibuat')" id="tabDibuat"
                    class="px-6 py-3 font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700 whitespace-nowrap">
                    ✓ Surat yang Dibuat
                </button>
            </div>

            <!-- TAB 1: Pengajuan Cuti -->
            <div id="contentPengajuan" class="bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Karyawan</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Jenis Cuti</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Durasi</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengajuanTableBody">
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada pengajuan cuti</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- TAB 2: Surat yang Dibuat -->
            <div id="contentDibuat" class="bg-white rounded-3xl shadow-md border border-gray-200 overflow-hidden hidden">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Karyawan</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Jenis Cuti</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Durasi</th>
                            <th class="px-8 py-6 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Tanggal Dibuat</th>
                            <th class="px-8 py-6 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="suratDibuatTableBody">
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada surat yang dibuat</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
>>>>>>> Stashed changes
            </div>

        </div>
    </div>

    <!-- Detail Modal - Updated to Red Theme -->
    <div id="detailModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header - Red Theme -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 p-8 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengajuan cuti karyawan</p>
                </div>
                <button onclick="closeDetailModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-8 space-y-6">
                <!-- Karyawan Info Card -->
                <div class="bg-gradient-to-br from-red-50/40 to-slate-50/30 rounded-2xl p-6 border border-red-100/30">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-100/60 to-red-50/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-500/70" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900" id="employeeName">-</h3>
                            <p class="text-sm text-gray-600 mt-0.5" id="employeeIdDept">-</p>
                            <p class="text-sm text-gray-500 mt-1" id="employeeEmail">-</p>
                        </div>
                    </div>
                </div>

                <!-- Status Badge -->
                <div id="statusBadge" class="flex items-center gap-2 p-3 bg-amber-50/40 border border-amber-100/30 rounded-2xl w-fit">
                    <div class="w-3 h-3 rounded-full bg-amber-500/80 animate-pulse"></div>
                    <span class="font-medium text-amber-700/80">Status: <span id="statusText">Menunggu Persetujuan</span></span>
                </div>

                <!-- Cuti Details Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="jenis">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="durasi">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-lg font-bold text-gray-900" data-detail="tanggal-mulai">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
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
                <div id="actionButtons" class="flex gap-3 pt-4 border-t border-gray-100/40 flex-wrap">
                    <!-- Button 'Lihat Surat' muncul jika surat sudah dibuat -->
                    <button id="lihatSuratBtn" class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-green-500/80 to-green-400/70 text-white font-medium rounded-2xl hover:from-green-500 hover:to-green-400 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Surat
                    </button>
                    <!-- Button 'Buat Surat' hanya muncul jika sudah disetujui direktur -->
                    <button id="buatSuratBtn" onclick="openBuatSuratModal()" class="hidden flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-2xl hover:from-red-700 hover:to-red-600 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                    <button onclick="closeDetailModal()" class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Surat - Form Input with Red Theme -->
    <div id="buatSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 p-8 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi data untuk membuat surat cuti <span id="formEmployeeName" class="font-medium text-gray-700">-</span></p>
                </div>
                <button onclick="closeBuatSuratModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Content - Form -->
            <form id="buatSuratForm" class="p-8 space-y-6">
                <input type="hidden" id="formCutiId" value="">

                <!-- Nomor Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Surat</label>
                    <input type="text" id="formNomorSurat" placeholder="Contoh: 001/SK-HRD/2026" required 
                        class="w-full px-4 py-3 border border-gray-200/50 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Format bebas, contoh: 001/SK-HRD/2026</p>
                </div>

                <!-- Tanggal Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Surat</label>
                    <input type="date" id="formTanggalSurat" required 
                        class="w-full px-4 py-3 border border-gray-200/50 rounded-2xl focus:outline-none focus:ring-2 focus:ring-red-500/30 focus:border-red-500 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Tanggal pembuatan surat</p>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Jenis Cuti</p>
                        <p class="text-sm font-bold text-gray-900" id="formJenisCuti">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Durasi</p>
                        <p class="text-sm font-bold text-gray-900" id="formDurasi">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Mulai</p>
                        <p class="text-sm font-bold text-gray-900" id="formTanggalMulai">-</p>
                    </div>
                    <div class="bg-gradient-to-br from-slate-50/60 to-gray-50/40 rounded-2xl p-4 border border-gray-100/40">
                        <p class="text-xs font-medium text-gray-600 uppercase tracking-wide mb-1">Tanggal Selesai</p>
                        <p class="text-sm font-bold text-gray-900" id="formTanggalSelesai">-</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-100/40">
                    <button type="button" onclick="closeBuatSuratModal()" class="flex-1 px-4 py-3 bg-gray-100/50 text-gray-700 font-medium rounded-2xl hover:bg-gray-100 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-medium rounded-2xl hover:from-red-700 hover:to-red-600 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Buat Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

<<<<<<< Updated upstream
    <!-- Preview Surat Modal - Red Theme -->
    <div id="previewSuratModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header - Red Theme -->
            <div class="sticky top-0 bg-gradient-to-r from-red-50 via-white to-slate-50 border-b border-gray-100/40 px-8 py-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Preview Surat Cuti</h2>
                    <p class="text-sm text-gray-500 mt-1" id="previewTitle"></p>
                </div>
                <button onclick="closePreviewModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto bg-gray-50">
                <iframe id="previewFrame" class="w-full h-full" style="min-height: 600px;" frameborder="0"></iframe>
            </div>
            
            <!-- Footer - Red Theme Button -->
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closePreviewModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all">
                    Tutup
                </button>
                <a id="downloadBtn" href="#" target="_blank" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-2xl hover:from-red-700 hover:to-red-600 shadow-md hover:shadow-lg transition-all transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
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
        // Tab switching
        function switchTabCuti(tab) {
            const pengajuan = document.getElementById('contentPengajuan');
            const dibuat = document.getElementById('contentDibuat');
            const tabPengajuan = document.getElementById('tabPengajuan');
            const tabDibuat = document.getElementById('tabDibuat');

            if (tab === 'pengajuan') {
                pengajuan.classList.remove('hidden');
                dibuat.classList.add('hidden');
                tabPengajuan.classList.add('text-amber-600', 'border-amber-500');
                tabPengajuan.classList.remove('text-gray-500', 'border-transparent');
                tabDibuat.classList.remove('text-amber-600', 'border-amber-500');
                tabDibuat.classList.add('text-gray-500', 'border-transparent');
                // Load pengajuan data
                loadPengajuanCuti();
            } else {
                pengajuan.classList.add('hidden');
                dibuat.classList.remove('hidden');
                tabPengajuan.classList.remove('text-amber-600', 'border-amber-500');
                tabPengajuan.classList.add('text-gray-500', 'border-transparent');
                tabDibuat.classList.add('text-amber-600', 'border-amber-500');
                tabDibuat.classList.remove('text-gray-500', 'border-transparent');
                // Load surat dibuat data
                loadSuratDibuatCuti();
            }
        }

        // Load pengajuan cuti table from API
        async function loadPengajuanCuti() {
            const tbody = document.getElementById('pengajuanTableBody');
            
            try {
                const response = await fetch('/admin/cuti/list', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.list) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <p>Gagal memuat data</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                // Filter: Pending requests OR Approved (Disetujui) yang belum ada file_surat
                const pendingCuti = data.list.filter(cuti => 
                    cuti.status === 'Pending' || cuti.can_create_surat
                );
                
                if (pendingCuti.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada pengajuan cuti menunggu</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    updateCutiCounts(data.list);
                    return;
                }

                // Generate table rows
                let html = '';
                pendingCuti.forEach(cuti => {
                    const tanggalMulai = new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalSelesai = new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });

                    html += `
                        <tr class="border-b border-gray-100/50 hover:bg-blue-50/40 transition-colors">
                            <td class="px-8 py-6 text-sm text-gray-900 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-amber-100/60 flex items-center justify-center text-xs font-bold text-amber-600">
                                        ${cuti.user.name.charAt(0).toUpperCase()}
                                    </div>
                                    ${cuti.user.name}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.jenis || '-'}</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.durasi || 0} hari</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${tanggalMulai} - ${tanggalSelesai}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-amber-100/60 text-amber-700 border border-amber-200/30">
                                    Menunggu
                                </span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-grid grid-cols-2 gap-2">
                                    <button onclick="showDetailCuti(${cuti.id})" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-blue-500/90 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                    <button onclick="showDetailCuti(${cuti.id})" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-gray-400/90 text-white rounded-lg text-xs font-semibold hover:bg-gray-500 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 2a2 2 0 012-2h6a2 2 0 012 2v2h2a2 2 0 012 2v1h1a1 1 0 110 2h-1v7a2 2 0 01-2 2H5a2 2 0 01-2-2V9H2a1 1 0 110-2h1V4a2 2 0 012-2h2V2zm0 5h10v7H5V7z" clip-rule="evenodd"></path>
                                        </svg>
                                        Info
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                tbody.innerHTML = html;
                updateCutiCounts(data.list);

            } catch (error) {
                console.error('Error loading cuti:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-red-500">
                            <p>Error memuat data: ${error.message}</p>
                        </td>
                    </tr>
                `;
            }
        }

        // Load surat dibuat table from API
        async function loadSuratDibuatCuti() {
            const tbody = document.getElementById('suratDibuatTableBody');
            
            try {
                const response = await fetch('/admin/cuti/list', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.list) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <p>Gagal memuat data</p>
                            </td>
                        </tr>
                    `;
                    return;
                }

                // Filter surat yang sudah dibuat: status Disetujui AND memiliki file_surat
                const suratDibuat = data.list.filter(cuti => cuti.status === 'Disetujui' && cuti.file_surat);
                
                if (suratDibuat.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-4">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-sm">Tidak ada surat yang dibuat</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    updateCutiCounts(data.list);
                    return;
                }

                // Generate table rows
                let html = '';
                suratDibuat.forEach(cuti => {
                    const tanggalMulai = new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalSelesai = new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });
                    const tanggalDibuat = new Date(cuti.updated_at).toLocaleDateString('id-ID', { 
                        year: 'numeric', month: 'short', day: 'numeric' 
                    });

                    html += `
                        <tr class="border-b border-gray-100/50 hover:bg-green-50/40 transition-colors">
                            <td class="px-8 py-6 text-sm text-gray-900 font-medium">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-green-100/60 flex items-center justify-center text-xs font-bold text-green-600">
                                        ${cuti.user.name.charAt(0).toUpperCase()}
                                    </div>
                                    ${cuti.user.name}
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.jenis || '-'}</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${cuti.durasi || 0} hari</td>
                            <td class="px-8 py-6 text-sm text-gray-700">${tanggalMulai} - ${tanggalSelesai}</td>
                            <td class="px-8 py-6 text-sm text-gray-700 text-center">${tanggalDibuat}</td>
                            <td class="px-8 py-6 text-center">
                                <div class="inline-grid grid-cols-2 gap-2">
                                    <button onclick="previewSuratCuti(${cuti.id}, '${cuti.user.name}')" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-blue-500/90 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </button>
                                    <a href="/storage/${cuti.file_surat}" target="_blank" class="flex flex-col items-center justify-center gap-1 px-3 py-2 bg-green-500/90 text-white rounded-lg text-xs font-semibold hover:bg-green-600 transition-colors shadow-sm">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                });

                tbody.innerHTML = html;
                updateCutiCounts(data.list);

            } catch (error) {
                console.error('Error loading surat:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-8 py-12 text-center text-red-500">
                            <p>Error memuat data: ${error.message}</p>
                        </td>
                    </tr>
                `;
            }
        }

        // Update stats counts
        function updateCutiCounts(cutiList) {
            const pending = cutiList.filter(c => c.status === 'Pending').length;
            const approved = cutiList.filter(c => c.status === 'Disetujui').length;
            const rejected = cutiList.filter(c => c.status === 'Ditolak').length;

            document.getElementById('pendingCount').textContent = pending;
            document.getElementById('approvedCount').textContent = approved;
            document.getElementById('rejectedCount').textContent = rejected;
        }

        // Show detail modal
        async function showDetailCuti(cutiId) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (!data.ok || !data.cuti) {
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
                let statusColor = 'bg-amber-50/40 border-amber-100/30';
                let statusDotColor = 'bg-amber-500/80 animate-pulse';
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
                statusBadge.innerHTML = `<div class="w-3 h-3 rounded-full ${statusDotColor}"></div><span class="font-medium text-gray-700">Status: ${statusLabel}</span>`;

                // Set cuti details
                document.querySelector('[data-detail="jenis"]').textContent = cuti.jenis || '-';
                document.querySelector('[data-detail="durasi"]').textContent = (cuti.durasi || 0) + ' hari';
                document.querySelector('[data-detail="tanggal-mulai"]').textContent = 
                    new Date(cuti.tanggal_mulai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
                document.querySelector('[data-detail="tanggal-selesai"]').textContent = 
                    new Date(cuti.tanggal_selesai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });

                // Set alasan
                document.getElementById('alasanText').textContent = cuti.alasan || '-';

                // Update timeline
                updateTimelineDisplay(cuti.status, cuti.created_at, cuti.tanggal_persetujuan);

                // Update buttons
                const buatSuratBtn = document.getElementById('buatSuratBtn');
                const lihatSuratBtn = document.getElementById('lihatSuratBtn');
                
                if (cuti.file_surat) {
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) {
                        lihatSuratBtn.classList.remove('hidden');
                        lihatSuratBtn.onclick = () => previewSuratCuti(cutiId, cuti.user.name);
                    }
                } else if (cuti.status === 'Disetujui') {
                    buatSuratBtn.classList.remove('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                    buatSuratBtn.onclick = () => openBuatSuratModal(cutiId, cuti);
                } else {
                    buatSuratBtn.classList.add('hidden');
                    if (lihatSuratBtn) lihatSuratBtn.classList.add('hidden');
                }

                // Store cutiId in modal
                modal.dataset.cutiId = cutiId;

                // Show modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat data cuti', 'error');
            }
        }

        // Update timeline display
        function updateTimelineDisplay(status, createdDate, approvedDate) {
            const timelineContainer = document.getElementById('timelineContainer');
            if (!timelineContainer) return;

            let html = '';

            // Created date
            html += `
                <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-blue-50/40 to-slate-50/30 rounded-2xl border border-blue-100/30">
                    <div class="w-2 h-2 rounded-full bg-blue-500/80 mt-2 flex-shrink-0"></div>
                    <div class="flex-1 text-sm">
                        <p class="font-medium text-gray-900">Pengajuan Dibuat</p>
                        <p class="text-gray-600">${new Date(createdDate).toLocaleDateString('id-ID')}</p>
                    </div>
                </div>
            `;

            // Status-based timeline
            if (status === 'Disetujui') {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-green-50/40 to-slate-50/30 rounded-2xl border border-green-100/30">
                        <div class="w-2 h-2 rounded-full bg-green-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Disetujui Direktur</p>
                            <p class="text-gray-600">${approvedDate ? new Date(approvedDate).toLocaleDateString('id-ID') : 'N/A'}</p>
                        </div>
                    </div>
                `;
            } else if (status === 'Ditolak') {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-red-50/40 to-slate-50/30 rounded-2xl border border-red-100/30">
                        <div class="w-2 h-2 rounded-full bg-red-500/80 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Ditolak</p>
                            <p class="text-gray-600">${approvedDate ? new Date(approvedDate).toLocaleDateString('id-ID') : 'N/A'}</p>
                        </div>
                    </div>
                `;
            } else {
                html += `
                    <div class="flex items-start gap-3 p-3 bg-gradient-to-r from-gray-50/40 to-slate-50/30 rounded-2xl border border-gray-100/30">
                        <div class="w-2 h-2 rounded-full bg-gray-400/50 mt-2 flex-shrink-0"></div>
                        <div class="flex-1 text-sm">
                            <p class="font-medium text-gray-900">Menunggu Persetujuan Direktur</p>
                            <p class="text-gray-600">Belum diproses</p>
                        </div>
                    </div>
                `;
            }

            timelineContainer.innerHTML = html;
        }

        // Preview surat cuti
        async function previewSuratCuti(cutiId, namaKaryawan) {
            try {
                const response = await fetch(`/admin/cuti/${cutiId}/preview`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.ok && data.pdfBase64) {
                    document.getElementById('previewFrame').src = 
                        'data:application/pdf;base64,' + data.pdfBase64;
                    document.getElementById('downloadBtn').href = data.downloadUrl;
                    document.getElementById('previewTitle').textContent = `Surat Cuti - ${namaKaryawan}`;
                    document.getElementById('previewSuratModal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                } else {
                    showNotification('Gagal memuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memuat surat', 'error');
            }
        }

        // Open buat surat modal with data
        function openBuatSuratModal(cutiId, cutiData) {
            // Set hidden ID
            document.getElementById('formCutiId').value = cutiId;
            
            // Set employee name
            document.getElementById('formEmployeeName').textContent = cutiData.user?.name || '-';
            
            // Set cuti info (read-only display)
            document.getElementById('formJenisCuti').textContent = cutiData.jenis || '-';
            document.getElementById('formDurasi').textContent = (cutiData.durasi || 0) + ' hari';
            document.getElementById('formTanggalMulai').textContent = 
                new Date(cutiData.tanggal_mulai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            document.getElementById('formTanggalSelesai').textContent = 
                new Date(cutiData.tanggal_selesai).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' });
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('formTanggalSurat').value = today;
            
            // Clear nomor surat
            document.getElementById('formNomorSurat').value = '';
            
            // Show modal
            const modal = document.getElementById('buatSuratModal');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Handle form submission for "Buat Surat"
        document.getElementById('buatSuratForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const cutiId = document.getElementById('formCutiId').value;
            const nomorSurat = document.getElementById('formNomorSurat').value;
            const tanggalSurat = document.getElementById('formTanggalSurat').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            if (!cutiId || !nomorSurat || !tanggalSurat) {
                showNotification('Mohon isi semua field yang diperlukan', 'error');
                return;
            }

            try {
                showNotification('Membuat surat... mohon tunggu', 'info');
                
                const response = await fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nomor_surat: nomorSurat,
                        tanggal_surat: tanggalSurat
                    })
                });

                const data = await response.json();

                if (data.ok) {
                    showNotification('✅ Surat berhasil dibuat!', 'success');
                    closeBuatSuratModal();
                    
                    // Auto refresh data
                    setTimeout(() => {
                        loadPengajuanCuti();
                        loadSuratDibuatCuti();
                    }, 500);
                } else {
                    showNotification(data.message || 'Gagal membuat surat', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan: ' + error.message, 'error');
            }
        });

            const btn = event.target;
            const originalText = btn.textContent;
            btn.disabled = true;
            btn.textContent = 'Membuat...';

            try {
                const response = await fetch(`/admin/cuti/${cutiId}/buat-surat`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.ok) {
                    closeBuatSuratModal();
                    closeDetailModal();
                    showNotification('Surat berhasil dibuat!', 'success');
                    // Reload tables
                    loadPengajuanCuti();
                    loadSuratDibuatCuti();
                } else {
                    showNotification(`Error: ${data.message}`, 'error');
                }
            } catch (error) {
                showNotification(`Error: ${error.message}`, 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        }

        // Modal functions
        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closeBuatSuratModal() {
            document.getElementById('buatSuratModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function closePreviewModal() {
            document.getElementById('previewSuratModal').classList.add('hidden');
            document.getElementById('previewFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Notification helper
        function showNotification(message, type = 'info') {
            let notification = document.getElementById('notification');
            if (!notification) {
                notification = document.createElement('div');
                notification.id = 'notification';
                notification.className = 'fixed top-4 right-4 max-w-md z-[60]';
                document.body.appendChild(notification);
            }

            let bgColor = 'bg-blue-500';
            if (type === 'success') bgColor = 'bg-green-500';
            if (type === 'error') bgColor = 'bg-red-500';

            notification.innerHTML = `
                <div class="rounded-lg shadow-lg p-4 text-white ${bgColor}">
                    ${message}
                </div>
            `;

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 4000);
        }

        // Close modals on backdrop click
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeDetailModal();
        });
        
        document.getElementById('buatSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeBuatSuratModal();
        });
<<<<<<< Updated upstream
        
=======

        document.getElementById('tambahCutiModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeTambahCutiModal();
        });

>>>>>>> Stashed changes
        document.getElementById('previewSuratModal')?.addEventListener('click', function(e) {
            if (e.target === this) closePreviewModal();
        });

        // Load initial data on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadPengajuanCuti();
        });
<<<<<<< Updated upstream
=======

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
</x-app-layout>
