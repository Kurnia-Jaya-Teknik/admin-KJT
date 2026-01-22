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
        <div class="p-6 lg:p-8 bg-gray-50/50 min-h-full">
            <!-- Filters -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <form method="GET" class="contents">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pengajuan</label>
                        <select name="jenis"
                            class="filterSelect w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                            <option value="">Semua</option>
                            <option value="cuti" {{ request('jenis') === 'cuti' ? 'selected' : '' }}>Cuti</option>
                            <option value="lembur" {{ request('jenis') === 'lembur' ? 'selected' : '' }}>Lembur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="filterSelect w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                            <option value="">Semua</option>
                            <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>
                                Disetujui</option>
                            <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <input type="month" name="periode" value="{{ request('periode', '') }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="w-full px-4 py-2 rounded-lg bg-amber-500 text-white font-medium hover:bg-amber-600 transition-colors">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('direktur.persetujuan-cuti-lembur') }}"
                            class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-medium hover:bg-gray-300 transition-colors">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Nama
                                    Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Jenis</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Durasi
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status
                                </th>
                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($requests as $request)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        {{ $request->user->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($request::class === 'App\Models\Cuti')
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $request->jenis }}</span>
                                        @else
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Lembur</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if ($request::class === 'App\Models\Cuti')
                                            {{ \Carbon\Carbon::parse($request->tanggal_mulai)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($request->tanggal_selesai)->format('d M Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($request->tanggal)->format('d M Y') }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if ($request::class === 'App\Models\Cuti')
                                            {{ $request->durasi_hari }} hari
                                        @else
                                            {{ $request->durasi_jam ?? 0 }} jam
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <span title="{{ $request->alasan ?? ($request->keterangan ?? '-') }}"
                                            class="truncate block max-w-xs">
                                            {{ Str::limit($request->alasan ?? ($request->keterangan ?? '-'), 40) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if ($request->status === 'Pending')
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 ring-1 ring-yellow-100">
                                                <svg class="w-3 h-3 text-yellow-700" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Menunggu</span>
                                            </span>
                                        @elseif ($request->status === 'Disetujui')
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 ring-1 ring-green-100">
                                                <svg class="w-3 h-3 text-green-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>Disetujui</span>
                                            </span>
                                        @elseif ($request->status === 'Ditolak')
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 ring-1 ring-red-100">
                                                <svg class="w-3 h-3 text-red-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                <span>Ditolak</span>
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 ring-1 ring-gray-100">{{ $request->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if ($request->status === 'Pending')
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        onclick="approveRequest('{{ $request::class }}', {{ $request->id }})"
                                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-50 text-green-700 hover:bg-green-100 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-green-200">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        <span>Setujui</span>
                                                    </button>
                                                    <button
                                                        onclick="rejectRequest('{{ $request::class }}', {{ $request->id }})"
                                                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-700 hover:bg-red-100 text-sm font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        <span>Tolak</span>
                                                    </button>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-500">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <p class="text-gray-600 font-medium">Tidak ada pengajuan untuk ditampilkan
                                            </p>
                                            <p class="text-gray-400 text-xs">Coba ubah filter atau cek kembali nanti
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan {{ count($requests) }} pengajuan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Approve -->
    <div id="approveModal"
        class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Setujui Pengajuan?</h3>
                        <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm leading-relaxed">
                    Apakah Anda yakin ingin <span class="font-semibold">menyetujui pengajuan ini</span>?
                    Karyawan akan menerima notifikasi via email.
                </p>
            </div>
            <div class="flex gap-3 px-6 py-4 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeApproveModal()"
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                    Batal
                </button>
                <button type="button" onclick="submitApproval()"
                    class="flex-1 px-4 py-2 rounded-lg bg-green-600 text-white font-medium hover:bg-green-700 transition-colors">
                    Ya, Setujui
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Reject -->
    <div id="rejectModal"
        class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Tolak Pengajuan?</h3>
                        <p class="text-sm text-gray-500">Berikan alasan penolakan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 text-sm mb-4">
                    Masukkan alasan penolakan pengajuan ini. Karyawan akan menerima notifikasi dengan alasan Anda.
                </p>
                <textarea id="rejectReason" placeholder="Masukkan alasan penolakan..."
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"
                    rows="3"></textarea>
                <p class="text-xs text-gray-400 mt-2">Minimal 5 karakter</p>
            </div>
            <div class="flex gap-3 px-6 py-4 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeRejectModal()"
                    class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-100 transition-colors">
                    Batal
                </button>
                <button type="button" onclick="submitReject()"
                    class="flex-1 px-4 py-2 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    id="submitRejectBtn">
                    Ya, Tolak
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentRequestData = {
            modelClass: null,
            requestId: null
        };

        function approveRequest(modelClass, requestId) {
            currentRequestData = {
                modelClass,
                requestId
            };
            document.getElementById('approveModal').classList.remove('hidden');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            currentRequestData = {
                modelClass: null,
                requestId: null
            };
        }

        async function submitApproval() {
            const {
                modelClass,
                requestId
            } = currentRequestData;
            const isLembur = modelClass.includes('Lembur');
            const endpoint = isLembur ? `/direktur/api/lembur/${requestId}/approve` :
                `/direktur/api/cuti/${requestId}/approve`;

            console.log('Submitting approval to:', endpoint);
            console.log('Model class:', modelClass, 'Request ID:', requestId);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                console.log('CSRF Token:', csrfToken ? 'Found' : 'NOT FOUND');

                const response = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    }
                });

                console.log('Response status:', response.status);
                const responseText = await response.text();
                console.log('Response body:', responseText);

                if (response.ok) {
                    closeApproveModal();
                    showSuccessAlert('Pengajuan telah disetujui!');
                    setTimeout(() => location.reload(), 1000);
                } else if (response.status === 401) {
                    closeApproveModal();
                    showErrorAlert('Anda tidak memiliki akses untuk menyetujui pengajuan ini.');
                } else {
                    try {
                        const data = JSON.parse(responseText);
                        closeApproveModal();
                        showErrorAlert('Error: ' + (data.message || 'Gagal menyetujui pengajuan'));
                    } catch (e) {
                        closeApproveModal();
                        showErrorAlert('Error: ' + responseText);
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                closeApproveModal();
                showErrorAlert('Terjadi kesalahan saat memproses permintaan: ' + error.message);
            }
        }

        function rejectRequest(modelClass, requestId) {
            currentRequestData = {
                modelClass,
                requestId
            };
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectReason').value = '';
            document.getElementById('rejectReason').focus();
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectReason').value = '';
            currentRequestData = {
                modelClass: null,
                requestId: null
            };
        }

        async function submitReject() {
            const reason = document.getElementById('rejectReason').value.trim();

            if (reason.length < 5) {
                showErrorAlert('Alasan penolakan minimal 5 karakter');
                return;
            }

            const {
                modelClass,
                requestId
            } = currentRequestData;
            const isLembur = modelClass.includes('Lembur');
            const endpoint = isLembur ? `/direktur/api/lembur/${requestId}/reject` :
                `/direktur/api/cuti/${requestId}/reject`;

            console.log('Submitting reject to:', endpoint);
            console.log('Model class:', modelClass, 'Request ID:', requestId);
            console.log('Reason:', reason);

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                console.log('CSRF Token:', csrfToken ? 'Found' : 'NOT FOUND');

                const response = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        reason: reason
                    })
                });

                console.log('Response status:', response.status);
                const responseText = await response.text();
                console.log('Response body:', responseText);

                if (response.ok) {
                    closeRejectModal();
                    showSuccessAlert('Pengajuan telah ditolak!');
                    setTimeout(() => location.reload(), 1000);
                } else if (response.status === 401) {
                    closeRejectModal();
                    showErrorAlert('Anda tidak memiliki akses untuk menolak pengajuan ini.');
                } else {
                    try {
                        const data = JSON.parse(responseText);
                        closeRejectModal();
                        showErrorAlert('Error: ' + (data.message || 'Gagal menolak pengajuan'));
                    } catch (e) {
                        closeRejectModal();
                        showErrorAlert('Error: ' + responseText);
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                closeRejectModal();
                showErrorAlert('Terjadi kesalahan saat memproses permintaan: ' + error.message);
            }
        }

        // Validasi alasan real-time
        document.getElementById('rejectReason')?.addEventListener('input', function() {
            const btn = document.getElementById('submitRejectBtn');
            btn.disabled = this.value.trim().length < 5;
        });

        // Close modals on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeApproveModal();
                closeRejectModal();
            }
        });

        function showSuccessAlert(message) {
            const alert = document.createElement('div');
            alert.className =
                'fixed bottom-6 right-6 bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 z-[100] animate-in';
            alert.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>${message}</span>
            `;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }

        function showErrorAlert(message) {
            const alert = document.createElement('div');
            alert.className =
                'fixed bottom-6 right-6 bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 z-[100] animate-in';
            alert.innerHTML = `
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span>${message}</span>
            `;
            document.body.appendChild(alert);
            setTimeout(() => alert.remove(), 3000);
        }
    </script>
</x-app-layout>
