<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Lembur') }}
        </h2>
    </x-slot>

    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select id="filterStatus"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                        <option value="">Semua</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                    <input id="filterPeriode" type="month"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                </div>
                <div class="flex items-end col-span-2">
                    <button id="applyFilters"
                        class="w-full px-4 py-2.5 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <div
                class="group relative overflow-hidden bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Pekerjaan yang Ditangani</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($requests as $r)
                                @php
                                    $tanggal = $r->tanggal ? \Carbon\Carbon::parse($r->tanggal)->format('d M Y') : '-';
                                    $durasi = ($r->durasi_jam ?? 0) . ' jam';
                                    $statusBadge = match ($r->status) {
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        'Disetujui' => 'bg-emerald-100 text-emerald-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <tr class="hover:bg-red-50 transition-colors duration-150">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-800">{{ $r->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $tanggal }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $durasi }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">
                                        <button
                                            onclick="showDetailLembur({{ $r->id }}, '{{ $r->user->name }}', '{{ $tanggal }}', '{{ $r->jam_mulai ?? '' }}', '{{ $r->jam_selesai ?? '' }}', '{{ $durasi }}', `{{ addslashes($r->keterangan ?? 'Tidak ada keterangan') }}`)"
                                            class="text-left hover:text-red-600 transition-colors">
                                            {{ Str::limit($r->keterangan ?? '-', 40) }}
                                        </button>
                                    </td>
                                    <td class="px-6 py-5 text-sm"><span
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $statusBadge }}">{{ $r->status }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if ($r->status === 'Pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    onclick="openApprovalModal('{{ $r->user->name }}', 'Lembur', '{{ $tanggal }}', 'Approve', {{ $r->id }}, 'lembur')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white">Setujui</button>
                                                <button
                                                    onclick="openApprovalModal('{{ $r->user->name }}', 'Lembur', '{{ $tanggal }}', 'Reject', {{ $r->id }}, 'lembur')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white">Tolak</button>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada
                                        pengajuan lembur</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Approval Modal -->
        <div id="approvalModal" class="fixed inset-0 bg-black/30 hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 max-w-md w-full p-6">
                <h3 id="modalTitle" class="text-lg font-bold mb-3">Konfirmasi</h3>
                <p id="modalBody" class="text-sm text-gray-600 mb-4">Pesan konfirmasi akan ditampilkan di sini.</p>
                <div class="flex gap-3 justify-end">
                    <button id="modalCancel" class="px-3 py-1.5 rounded-lg border">Batal</button>
                    <button id="modalConfirm"
                        class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white">Konfirmasi</button>
                </div>
            </div>
        </div>

        <!-- Detail Lembur Modal -->
        <div id="detailLemburModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 max-w-2xl w-full overflow-hidden">
                <div class="px-6 py-5 bg-gradient-to-r from-red-500 to-red-700 border-b border-red-800/20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg border border-white/30">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">Detail Lembur</h3>
                                <p class="text-xs text-white/80 mt-0.5">Informasi lengkap pengajuan lembur</p>
                            </div>
                        </div>
                        <button onclick="closeDetailLembur()"
                            class="p-2 hover:bg-white/20 rounded-lg transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-8 space-y-6 bg-gradient-to-br from-gray-50/50 to-white max-h-[70vh] overflow-y-auto">
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <span class="text-lg">👤</span> Nama Karyawan
                        </label>
                        <p id="detailNama" class="text-lg font-semibold text-gray-900"></p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <span class="text-lg">📅</span> Tanggal
                            </label>
                            <p id="detailTanggal" class="text-gray-800"></p>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <span class="text-lg">⏱️</span> Durasi
                            </label>
                            <p id="detailDurasi" class="text-gray-800 font-semibold"></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <span class="text-lg">⏰</span> Jam Mulai
                            </label>
                            <p id="detailJamMulai" class="text-gray-800"></p>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <span class="text-lg">🏁</span> Jam Selesai
                            </label>
                            <p id="detailJamSelesai" class="text-gray-800"></p>
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-3">
                            <span class="text-lg">📝</span> Pekerjaan yang Ditangani
                        </label>
                        <div class="p-4 bg-gray-50 border-2 border-gray-200 rounded-xl">
                            <p id="detailKeterangan"
                                class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap"></p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button onclick="closeDetailLembur()"
                        class="px-6 py-2.5 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showDetailLembur(id, nama, tanggal, jamMulai, jamSelesai, durasi, keterangan) {
                document.getElementById('detailNama').textContent = nama;
                document.getElementById('detailTanggal').textContent = tanggal;
                document.getElementById('detailDurasi').textContent = durasi;
                document.getElementById('detailJamMulai').textContent = jamMulai || '-';
                document.getElementById('detailJamSelesai').textContent = jamSelesai || '-';
                document.getElementById('detailKeterangan').textContent = keterangan;
                document.getElementById('detailLemburModal').classList.remove('hidden');
            }

            function closeDetailLembur() {
                document.getElementById('detailLemburModal').classList.add('hidden');
            }

            function openApprovalModal(name, jenis, tanggal, action, id, type) {
                const modal = document.getElementById('approvalModal');
                document.getElementById('modalTitle').textContent = action === 'Approve' ? 'Konfirmasi Persetujuan' :
                    'Konfirmasi Penolakan';
                document.getElementById('modalBody').textContent = `${action} ${jenis} - ${name} (${tanggal})?`;
                modal.classList.remove('hidden');
                const cancel = document.getElementById('modalCancel');
                const confirm = document.getElementById('modalConfirm');
                cancel.onclick = () => modal.classList.add('hidden');
                confirm.onclick = async () => {
                    modal.classList.add('hidden');
                    const url = `/pengajuan/${type}/${id}/${action === 'Approve' ? 'approve' : 'reject'}`;
                    try {
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            credentials: 'same-origin'
                        });
                        if (!res.ok) throw new Error('Gagal');
                        location.reload();
                    } catch (e) {
                        alert('Gagal melakukan aksi. Cek console.');
                        console.error(e);
                    }
                };
            }

            document.getElementById('applyFilters')?.addEventListener('click', () => {
                const status = document.getElementById('filterStatus')?.value || '';
                const periode = document.getElementById('filterPeriode')?.value || '';
                const q = new URLSearchParams();
                if (status) q.set('status', status);
                if (periode) q.set('periode', periode);
                const url = location.pathname + (q.toString() ? ('?' + q.toString()) : '');
                location.href = url;
            });
        </script>
    @endpush
</x-app-layout>
