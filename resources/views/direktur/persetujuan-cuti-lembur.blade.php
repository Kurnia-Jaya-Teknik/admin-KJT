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
                                    Pelimpahan</th>
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
                                    <td class="px-6 py-5 text-sm text-gray-600">
                                        @if ($isCuti && isset($request->delegated_users) && $request->delegated_users->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($request->delegated_users as $user)
                                                    <span
                                                        class="px-2 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">{{ $user->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-sm"><span
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $statusBadge }}">{{ $request->status }}</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if ($request->status === 'Pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button data-request-id="{{ $request->id }}"
                                                    data-request-type="{{ $type }}"
                                                    class="btn-preview px-3 py-1.5 text-xs font-semibold rounded-lg bg-white border text-blue-700 hover:bg-blue-50 shadow-sm hover:shadow-md transition-all duration-200">Lihat
                                                    Surat</button>
                                                @if ($isCuti && $request->jenis === 'Ijin Sakit' && !empty($request->bukti))
                                                    <button
                                                        onclick="openImageModal('{{ route('files.bukti', basename($request->bukti)) }}')"
                                                        class="btn-image px-3 py-1.5 text-xs font-semibold rounded-lg border bg-white/80 text-indigo-600 hover:bg-indigo-50">📄
                                                        Lihat Dokter</button>
                                                @endif
                                                <button data-request-id="{{ $request->id }}"
                                                    data-request-type="{{ $type }}"
                                                    data-employee-name="{{ $request->user->name }}"
                                                    data-jenis="{{ $jenisLabel }}"
                                                    data-tanggal="{{ $tanggal }}" data-action="Approve"
                                                    class="btn-approve px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                                <button data-request-id="{{ $request->id }}"
                                                    data-request-type="{{ $type }}"
                                                    data-employee-name="{{ $request->user->name }}"
                                                    data-jenis="{{ $jenisLabel }}"
                                                    data-tanggal="{{ $tanggal }}" data-action="Reject"
                                                    class="btn-reject px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
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
                            {{-- <tr class="hover:bg-red-50 transition-colors duration-150">
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
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <p class="text-sm text-gray-600">Menampilkan {{ $requests->firstItem() ?? 0 }} -
                        {{ $requests->lastItem() ?? 0 }} dari {{ $requests->total() }} pengajuan</p>
                    <div class="flex gap-2">
                        <a href="{{ $requests->previousPageUrl() ?: '#' }}"
                            class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md {{ $requests->previousPageUrl() ? '' : 'opacity-50 pointer-events-none' }}">←
                            Sebelumnya</a>
                        <a href="{{ $requests->nextPageUrl() ?: '#' }}"
                            class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md {{ $requests->nextPageUrl() ? '' : 'opacity-50 pointer-events-none' }}">Selanjutnya
                            →</a>
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
                        <div id="approvalError"
                            class="hidden mt-2 p-2 rounded-md bg-red-50 border border-red-200 text-red-700 text-sm">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-5 border-t border-gray-200 flex items-center justify-between gap-3 bg-gray-50">
                    <button type="button"
                        class="btn-cancel-approval flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">
                        Batal
                    </button>
                    <button type="button" id="modalConfirmBtn"
                        class="btn-confirm-approval flex-1 px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        Konfirmasi
                    </button>
                </div>
            </div>
        </div>

        <!-- Preview Modal (moved out so it can display independently of approvalModal) -->
        <div id="previewModal" class="fixed inset-0 bg-black/30 hidden z-50 flex items-center justify-center p-4">
            <div
                class="bg-white rounded-2xl shadow-xl border border-gray-200 max-w-3xl w-full animate-in fade-in zoom-in-95 duration-300 overflow-auto max-h-[80vh]">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-red-600 to-red-700">
                    <h3 class="text-lg font-bold text-white">Pratinjau Surat</h3>
                </div>
                <div class="p-6" id="previewContent">
                    <div class="text-sm text-gray-500">Memuat pratinjau...</div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <button onclick="closePreviewModal()"
                        class="px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100">Tutup</button>
                    <button onclick="openApprovalModalFromPreview()"
                        class="px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Setujui
                        (Lanjut)</button>
                </div>
            </div>
        </div>

        <!-- Image Modal (untuk lihat dokter) -->
        <div id="imageModal" class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center p-4"
            onclick="closeImageModal()">
            <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
                <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
                    <div
                        class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-white">Surat Dokter</h3>
                        <button onclick="closeImageModal()"
                            class="text-white hover:text-gray-200 text-2xl">&times;</button>
                    </div>
                    <div class="p-4 bg-gray-100" style="max-height: 80vh; overflow-y: auto;">
                        <img id="imageModalContent" src="" alt="Surat Dokter"
                            class="w-full h-auto rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>

        <!-- Load external JS -->
        <script src="{{ asset('js/direktur-approval.js') }}?v={{ time() }}"></script>
