<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Surat Keterangan Kerja
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Header -->
            <div class="mb-12">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Surat Keterangan Kerja</h1>
                        <p class="text-gray-600 text-base">Kelola surat keterangan kerja untuk karyawan</p>
                    </div>
                    <button onclick="showCreateModal()" class="flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-white font-semibold rounded-2xl hover:from-blue-600 hover:to-blue-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 w-fit">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Buat Surat Baru
                    </button>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h10a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 002 2 1 1 0 100-2h-10a1 1 0 000 2 2 2 0 00-2-2V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Permintaan Menunggu</p>
                                <p class="text-2xl font-bold text-gray-900" id="pendingCount">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h10a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 002 2 1 1 0 100-2h-10a1 1 0 000 2 2 2 0 00-2-2V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Surat Dibuat</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $suratList->total() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-100/60 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 1 1 0 000 2h10a1 1 0 000-2 2 2 0 00-2 2v10a2 2 0 002 2 1 1 0 100-2h-10a1 1 0 000 2 2 2 0 00-2-2V5z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Permintaan</p>
                                <p class="text-2xl font-bold text-gray-900" id="totalCount">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex gap-4 mb-6 border-b border-gray-100">
                <button onclick="switchTab('permintaan')" id="tabPermintaan" class="px-6 py-3 font-semibold text-amber-600 border-b-2 border-amber-500 whitespace-nowrap">
                    📋 Permintaan Surat (Pending)
                </button>
                <button onclick="switchTab('dibuat')" id="tabDibuat" class="px-6 py-3 font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700 whitespace-nowrap">
                    ✓ Surat yang Dibuat
                </button>
            </div>

            <!-- TAB 1: Permintaan Surat -->
            <div id="contentPermintaan" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div id="pendingRequestsContent" class="p-8 text-center text-gray-500">
                    <p>Loading...</p>
                </div>
            </div>

            <!-- TAB 2: Surat yang Dibuat -->
            <div id="contentDibuat" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden">
                @if($suratList->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-transparent">
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Karyawan</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nomor Surat</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jabatan</th>
                                    <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-8 py-5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($suratList as $surat)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <p class="font-semibold text-gray-900">{{ $surat->user->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $surat->user->email }}</p>
                                    </td>
                                    <td class="px-8 py-6 font-mono text-sm text-gray-700">{{ $surat->nomor_surat }}</td>
                                    <td class="px-8 py-6 text-sm text-gray-700">{{ $surat->jabatan }}</td>
                                    <td class="px-8 py-6 text-sm text-gray-600">{{ optional($surat->tanggal_surat)->format('d/m/Y') }}</td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex gap-2 justify-center flex-wrap">
                                            <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank" class="px-4 py-2 bg-blue-100/60 text-blue-700 font-medium rounded-xl hover:bg-blue-100 transition-colors text-sm">
                                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                </svg>
                                                Lihat
                                            </a>
                                            <button onclick="deleteSurat({{ $surat->id }})" class="px-4 py-2 bg-red-100/60 text-red-700 font-medium rounded-xl hover:bg-red-100 transition-colors text-sm">
                                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-8 py-6 border-t border-gray-100">
                        {{ $suratList->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h4a1 1 0 010 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V7a1 1 0 010-2h4V3z"/>
                        </svg>
                        <p class="text-gray-500 mb-4">Belum ada surat keterangan</p>
                        <button onclick="showCreateModal()" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-2xl hover:bg-blue-600 transition-colors">
                            Buat Surat Pertama
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-300">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-blue-50/80 to-slate-50/60 backdrop-blur-md border-b border-gray-100/40 p-6 flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Buat Surat Keterangan</h2>
                    <p class="text-sm text-gray-500 mt-1">Isi data untuk membuat surat keterangan kerja</p>
                </div>
                <button onclick="closeCreateModal()" class="p-2 hover:bg-white/50 rounded-2xl transition-colors">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <form id="suratForm" class="p-8 space-y-6">
                @csrf
                
                <!-- Pilih Karyawan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih Karyawan</label>
                    <select id="userId" name="user_id" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($karyawanList as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->name }} - {{ $karyawan->departemen_id ? 'Dept.' : 'Umum' }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Nomor Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Nomor Surat</label>
                    <input type="text" id="nomorSurat" name="nomor_surat" placeholder="Contoh: 001/HRD/2026" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                </div>

                <!-- Tanggal Surat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Surat</label>
                    <input type="date" id="tanggalSurat" name="tanggal_surat" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Maintenance Electric" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                </div>

                <!-- Unit Kerja -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Unit Kerja</label>
                    <input type="text" id="unitKerja" name="unit_kerja" placeholder="Contoh: CV Kurnia Jaya Teknik" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                </div>

                <!-- Tanggal Mulai Kerja -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Mulai Kerja</label>
                    <input type="date" id="tanggalMulai" name="tanggal_mulai_kerja" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all" required>
                </div>

                <!-- Tanggal Selesai Kerja (Opsional) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Selesai Kerja (Opsional - jika resign)</label>
                    <input type="date" id="tanggalSelesai" name="tanggal_selesai_kerja" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                </div>

                <!-- Keterangan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Keterangan Tambahan (Opsional)</label>
                    <textarea id="keterangan" name="keterangan" rows="3" placeholder="Contoh: Surat ini untuk keperluan pembukaan rekening bank" class="w-full px-4 py-3 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all"></textarea>
                </div>
            </form>

            <!-- Modal Actions -->
            <div class="border-t border-gray-100/40 bg-gradient-to-r from-gray-50/50 to-slate-50/30 px-8 py-6 flex gap-4 justify-end flex-wrap">
                <button onclick="closeCreateModal()" class="px-8 py-3 border border-gray-200/60 rounded-2xl text-gray-600 font-medium hover:bg-gray-50/70 transition-all duration-300">
                    Batal
                </button>
                <button onclick="submitForm()" class="flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-400 text-white font-semibold rounded-2xl hover:from-blue-600 hover:to-blue-500 shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Buat Surat
                </button>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
let currentTab = 'permintaan';

// Load data on page load
document.addEventListener('DOMContentLoaded', function() {
    loadPendingRequests();
});

// Switch between tabs
function switchTab(tab) {
    currentTab = tab;
    
    // Update tab buttons
    document.getElementById('tabPermintaan').classList.toggle('text-amber-600', tab === 'permintaan');
    document.getElementById('tabPermintaan').classList.toggle('border-amber-500', tab === 'permintaan');
    document.getElementById('tabPermintaan').classList.toggle('text-gray-500', tab !== 'permintaan');
    document.getElementById('tabPermintaan').classList.toggle('border-transparent', tab !== 'permintaan');
    
    document.getElementById('tabDibuat').classList.toggle('text-amber-600', tab === 'dibuat');
    document.getElementById('tabDibuat').classList.toggle('border-amber-500', tab === 'dibuat');
    document.getElementById('tabDibuat').classList.toggle('text-gray-500', tab !== 'dibuat');
    document.getElementById('tabDibuat').classList.toggle('border-transparent', tab !== 'dibuat');
    
    // Toggle content visibility
    document.getElementById('contentPermintaan').classList.toggle('hidden', tab !== 'permintaan');
    document.getElementById('contentDibuat').classList.toggle('hidden', tab !== 'dibuat');
    
    if (tab === 'permintaan') {
        loadPendingRequests();
    }
}

// Load pending requests from karyawan
function loadPendingRequests() {
    fetch('/admin/surat-keterangan/requests/pending', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(r => r.json())
    .then(data => {
        document.getElementById('pendingCount').textContent = data.length;
        document.getElementById('totalCount').textContent = data.length;
        
        if (data.length === 0) {
            document.getElementById('pendingRequestsContent').innerHTML = `
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 3a2 2 0 012-2h6a2 2 0 012 2v2h4a1 1 0 010 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V7a1 1 0 010-2h4V3z"/>
                    </svg>
                    <p class="text-gray-500">Tidak ada permintaan surat yang menunggu</p>
                </div>
            `;
            return;
        }

        let html = `
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gradient-to-r from-gray-50 to-transparent">
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Karyawan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Alasan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Keperluan</th>
                            <th class="px-8 py-5 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Tanggal Diminta</th>
                            <th class="px-8 py-5 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
        `;

        data.forEach(req => {
            const tanggal = new Date(req.tanggal_diminta).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
            html += `
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-8 py-6">
                        <p class="font-semibold text-gray-900">${req.user.name}</p>
                        <p class="text-xs text-gray-500 mt-1">${req.user.email}</p>
                    </td>
                    <td class="px-8 py-6 text-sm text-gray-700">${req.alasan}</td>
                    <td class="px-8 py-6 text-sm text-gray-700">${req.keperluan}</td>
                    <td class="px-8 py-6 text-sm text-gray-600">${tanggal}</td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex gap-2 justify-center flex-wrap">
                            <button onclick="approveRequest(${req.id})" class="px-4 py-2 bg-green-100/60 text-green-700 font-medium rounded-xl hover:bg-green-100 transition-colors text-sm">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                Setujui
                            </button>
                            <button onclick="rejectRequest(${req.id})" class="px-4 py-2 bg-red-100/60 text-red-700 font-medium rounded-xl hover:bg-red-100 transition-colors text-sm">
                                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                Tolak
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });

        html += `
                    </tbody>
                </table>
            </div>
        `;

        document.getElementById('pendingRequestsContent').innerHTML = html;
    })
    .catch(e => console.error('Error:', e));
}

// Approve request
function approveRequest(id) {
    if (!confirm('Setujui permintaan ini?')) return;

    fetch(`/admin/surat-keterangan/requests/${id}/approve`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            alert('Permintaan disetujui!');
            loadPendingRequests();
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(e => alert('Error: ' + e.message));
}

// Reject request
function rejectRequest(id) {
    if (!confirm('Tolak permintaan ini?')) return;

    fetch(`/admin/surat-keterangan/requests/${id}/reject`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            alert('Permintaan ditolak!');
            loadPendingRequests();
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(e => alert('Error: ' + e.message));
}

function showCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

function submitForm() {
    const form = document.getElementById('suratForm');
    const formData = new FormData(form);

    fetch('/admin/surat-keterangan', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            user_id: formData.get('user_id'),
            nomor_surat: formData.get('nomor_surat'),
            tanggal_surat: formData.get('tanggal_surat'),
            jabatan: formData.get('jabatan'),
            unit_kerja: formData.get('unit_kerja'),
            tanggal_mulai_kerja: formData.get('tanggal_mulai_kerja'),
            tanggal_selesai_kerja: formData.get('tanggal_selesai_kerja') || null,
            keterangan: formData.get('keterangan') || null,
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            alert('Surat keterangan berhasil dibuat!');
            closeCreateModal();
            switchTab('dibuat');
            setTimeout(() => location.reload(), 500);
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(e => alert('Error: ' + e.message));
}

function deleteSurat(id) {
    if (!confirm('Hapus surat keterangan ini?')) return;

    fetch(`/admin/surat-keterangan/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        }
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            alert('Surat berhasil dihapus');
            location.reload();
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(e => alert('Error: ' + e.message));
}
</script>
