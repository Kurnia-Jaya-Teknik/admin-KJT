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
                    <!-- Menunggu -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-2.414 2.414a1 1 0 101.414 1.414L9 11.414V6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Menunggu Persetujuan</p>
                                <p class="text-2xl font-bold text-gray-900" id="pendingCount">0</p>
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
            </div>

                        <div class="flex items-start justify-between">
                            <div class="flex-1 ml-2">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-gradient-to-br from-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-100/60 to-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-50/30 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-sm">
                                        <svg class="w-5 h-5 text-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-500/70"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $cuti->user->name ?? 'N/A' }}
                                        </h3>
                                        <p class="text-xs text-gray-500">{{ $cuti->user->departemen->nama ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <span
                                        class="ml-auto inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-gradient-to-r from-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-100/60 to-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-50/40 text-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-600/80 border border-{{ $cuti->status == 'Pending' ? 'amber' : ($cuti->status == 'Disetujui' ? 'green' : 'red') }}-200/30 shadow-sm">
                                        @if ($cuti->status == 'Pending')
                                            Menunggu
                                        @elseif($cuti->status == 'Disetujui')
                                            Disetujui
                                        @else
                                            Ditolak
                                        @endif
                                    </span>
                                </div>
                                <div
                                    class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm mb-4 p-4 bg-gradient-to-br from-gray-50/50 to-slate-50/30 rounded-2xl border border-gray-100/30">
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Jenis
                                            Cuti</p>
                                        <p class="font-semibold text-gray-900">{{ $cuti->jenis }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">Durasi
                                        </p>
                                        <p class="font-semibold text-gray-900">{{ $cuti->durasi }} hari</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                            Tanggal</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->format('d M') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium uppercase tracking-wide mb-1">
                                            Diajukan</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ \Carbon\Carbon::parse($cuti->created_at)->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <button onclick="showDetailCuti({{ $cuti->id }})"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 text-white rounded-lg text-xs font-semibold hover:from-indigo-600 hover:to-indigo-700 shadow-sm hover:shadow-md transition-all">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                                <div class="pl-4 border-l-2 border-gray-200/50 mb-3">
                                    <p class="text-sm text-gray-600"><span class="font-medium">Alasan:</span>
                                        {{ $cuti->alasan }}</p>
                                </div>

                                @if ($cuti->delegated_users && $cuti->delegated_users->count() > 0)
                                    <div class="pl-4 border-l-2 border-blue-200/50 mb-3">
                                        <p class="text-sm text-gray-600 mb-1"><span class="font-medium">👥 Dilimpahkan
                                                ke:</span></p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($cuti->delegated_users as $delegated)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">{{ $delegated->name }}</span>
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
    </script>
</x-app-layout>
