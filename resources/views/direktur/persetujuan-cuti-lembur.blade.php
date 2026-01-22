<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Cuti & Lembur') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Filters - Clean Red-Grey Style -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Pengajuan</label>
                    <select
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                        <option>Semua</option>
                        <option>Cuti</option>
                        <option>Lembur</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                        <option>Semua</option>
                        <option>Menunggu</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                    <input type="month"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                </div>
                <div class="flex items-end">
                    <button
                        class="w-full px-4 py-2.5 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Table - Vibrant Red-Grey -->
            <div
                class="group relative overflow-hidden bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Jenis</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Keterangan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($requests as $request)
                                @php
                                    $isCuti = $request instanceof \App\Models\Cuti;
                                    $type = $isCuti ? 'cuti' : 'lembur';
                                    $jenisBadge = $isCuti
                                        ? 'bg-blue-100 text-blue-800'
                                        : 'bg-purple-100 text-purple-800';
                                    $jenisLabel = $isCuti ? $request->jenis : 'Lembur';
                                    $tanggal = $isCuti
                                        ? \Carbon\Carbon::parse($request->tanggal_mulai)->format('d M Y') .
                                            ' - ' .
                                            \Carbon\Carbon::parse($request->tanggal_selesai)->format('d M Y')
                                        : \Carbon\Carbon::parse($request->tanggal)->format('d M Y');
                                    $durasi = $isCuti
                                        ? ($request->durasi_hari ?? 0) . ' hari'
                                        : ($request->durasi ?? 0) . ' jam';
                                    $statusBadge = match ($request->status) {
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        'Disetujui' => 'bg-emerald-100 text-emerald-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <tr class="hover:bg-red-50 transition-colors duration-150">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-800">
                                        {{ $request->user->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-5 text-sm"><span
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $jenisBadge }}">{{ $jenisLabel }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $tanggal }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $durasi }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">
                                        {{ Str::limit($request->alasan ?? ($request->keterangan ?? '-'), 30) }}</td>
                                    <td class="px-6 py-5 text-sm"><span
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $statusBadge }}">{{ $request->status }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if ($request->status === 'Pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    onclick="openApprovalModal('{{ $request->user->name }}', '{{ $jenisLabel }}', '{{ $tanggal }}', 'Approve', {{ $request->id }}, '{{ $type }}')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                                <button
                                                    onclick="openApprovalModal('{{ $request->user->name }}', '{{ $jenisLabel }}', '{{ $tanggal }}', 'Reject', {{ $request->id }}, '{{ $type }}')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada
                                        pengajuan</td>
                                </tr>
                            @endforelse
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-5 text-sm font-medium text-gray-800">Siti Nurhaliza</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-purple-100 text-purple-800">Lembur</span>
                                </td>
                                <td class="px-6 py-5 text-sm text-gray-600">7 Jan 2026</td>
                                <td class="px-6 py-5 text-sm text-gray-600">5 jam</td>
                                <td class="px-6 py-5 text-sm text-gray-600">Project deadline</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Menunggu</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="openApprovalModal('Siti Nurhaliza', 'Lembur', '7 Jan 2026', 'Approve')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button
                                            onclick="openApprovalModal('Siti Nurhaliza', 'Lembur', '7 Jan 2026', 'Reject')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-5 text-sm font-medium text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-blue-100 text-blue-800">Cuti
                                        Sakit</span></td>
                                <td class="px-6 py-5 text-sm text-gray-600">6 Jan 2026</td>
                                <td class="px-6 py-5 text-sm text-gray-600">2 hari</td>
                                <td class="px-6 py-5 text-sm text-gray-600">Sakit demam</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Menunggu</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="openApprovalModal('Budi Santoso', 'Cuti Sakit', '6 Jan 2026', 'Approve')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button
                                            onclick="openApprovalModal('Budi Santoso', 'Cuti Sakit', '6 Jan 2026', 'Reject')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-5 text-sm font-medium text-gray-800">Rina Wijaya</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-purple-100 text-purple-800">Lembur</span>
                                </td>
                                <td class="px-6 py-5 text-sm text-gray-600">8 Jan 2026</td>
                                <td class="px-6 py-5 text-sm text-gray-600">4 jam</td>
                                <td class="px-6 py-5 text-sm text-gray-600">Meeting klien</td>
                                <td class="px-6 py-5 text-sm"><span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Menunggu</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="openApprovalModal('Rina Wijaya', 'Lembur', '8 Jan 2026', 'Approve')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button
                                            onclick="openApprovalModal('Rina Wijaya', 'Lembur', '8 Jan 2026', 'Reject')"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <p class="text-sm text-gray-600">Menampilkan 5 dari 12 pengajuan</p>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">←
                            Sebelumnya</button>
                        <button
                            class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">Selanjutnya
                            →</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval Modal - Clean & Cohesive Red-Grey -->
        <div id="approvalModal" class="fixed inset-0 bg-black/30 hidden z-50 flex items-center justify-center p-4">
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-200 max-w-md w-full animate-in fade-in zoom-in-95 duration-300">
                <!-- Header -->
                <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-bold text-white">
                        <span id="modalAction">Konfirmasi Persetujuan</span>
                    </h3>
                </div>

                <!-- Content -->
                <div class="px-6 py-6 space-y-4">
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 font-semibold">Nama Karyawan</p>
                        <p id="modalEmployeeName" class="text-base font-bold text-gray-800">-</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 font-semibold">Jenis Pengajuan</p>
                        <p id="modalRequestType" class="text-base font-bold text-gray-800">-</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-gray-600 font-semibold">Periode</p>
                        <p id="modalRequestDate" class="text-base font-bold text-gray-800">-</p>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                        <textarea id="modalNotes"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm resize-none"
                            rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-5 border-t border-gray-200 flex items-center justify-between gap-3 bg-gray-50">
                    <button onclick="closeApprovalModal()"
                        class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">
                        Batal
                    </button>
                    <button id="modalConfirmBtn" onclick="confirmApproval()"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script>
            let currentApprovalData = {
                employee: '',
                type: '',
                date: '',
                action: ''
            };

            function openApprovalModal(employeeName, requestType, requestDate, action, requestId, type) {
                currentApprovalData = {
                    employee: employeeName,
                    type: requestType,
                    date: requestDate,
                    action: action,
                    requestId: requestId,
                    requestType: type // 'cuti' or 'lembur'
                };

                const modal = document.getElementById('approvalModal');
                const actionText = action === 'Approve' ? 'Setujui Pengajuan' : 'Tolak Pengajuan';

                document.getElementById('modalAction').textContent = actionText;
                document.getElementById('modalEmployeeName').textContent = employeeName;
                document.getElementById('modalRequestType').textContent = requestType;
                document.getElementById('modalRequestDate').textContent = requestDate;
                document.getElementById('modalNotes').value = '';

                const btnText = action === 'Approve' ? 'Setujui' : 'Tolak';
                const btnClass = action === 'Approve' ?
                    'bg-emerald-600 hover:bg-emerald-700' :
                    'bg-red-600 hover:bg-red-700';

                document.getElementById('modalConfirmBtn').textContent = btnText;
                document.getElementById('modalConfirmBtn').className =
                    `flex-1 px-4 py-2.5 rounded-lg ${btnClass} text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200`;

                modal.classList.remove('hidden');
            }

            function closeApprovalModal() {
                document.getElementById('approvalModal').classList.add('hidden');
            }

            async function confirmApproval() {
                const notes = document.getElementById('modalNotes').value;
                const action = currentApprovalData.action;
                const requestId = currentApprovalData.requestId;
                const requestType = currentApprovalData.requestType;

                if (!requestId || !requestType) {
                    alert('Data request tidak valid');
                    return;
                }

                const endpoint = action === 'Approve' ?
                    `/direktur/api/${requestType}/${requestId}/approve` :
                    `/direktur/api/${requestType}/${requestId}/reject`;

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(endpoint, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({
                            catatan: notes
                        })
                    });

                    if (!response.ok) {
                        const error = await response.json().catch(() => ({
                            message: 'Terjadi kesalahan'
                        }));
                        throw new Error(error.message || 'Gagal memproses request');
                    }

                    const result = await response.json();
                    alert(result.message || 'Berhasil diproses');
                    closeApprovalModal();

                    // Reload page to update list
                    window.location.reload();
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error: ' + error.message);
                }
            }

            // Close modal when clicking outside
            document.getElementById('approvalModal')?.addEventListener('click', (e) => {
                if (e.target.id === 'approvalModal') {
                    closeApprovalModal();
                }
            });
        </script>
</x-app-layout>
