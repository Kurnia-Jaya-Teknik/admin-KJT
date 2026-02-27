<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Persetujuan Cuti') }}
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Filters - Clean Blue-Grey Style -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cari</label>
                    <input id="filter_q" name="q" type="text" placeholder="Cari nama, alasan, atau jenis..."
                        value="{{ request()->query('q', '') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm hover:shadow-md" />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select id="filter_status" name="status"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm hover:shadow-md">
                        <option value="" {{ request()->query('status') == '' ? 'selected' : '' }}>Semua</option>
                        <option value="menunggu" {{ request()->query('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ request()->query('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request()->query('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                    <input id="filter_periode" name="periode" type="month" value="{{ request()->query('periode', '') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all shadow-sm hover:shadow-md">
                </div>
                <div class="flex items-end">
                    <div class="w-full flex gap-2">
                        <button type="button" onclick="applyApprovalFilters()"
                            class="w-full px-4 py-2.5 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-md hover:shadow-lg transition-all duration-200">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('direktur.persetujuan-cuti') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-50 shadow-sm transition-all duration-200 text-center">
                            Reset
                        </a>
                    </div>
                </div>
            </div> 

            <!-- Table - Vibrant Blue-Grey -->
            <div
                class="group relative overflow-hidden bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-600 to-blue-700 border-b-2 border-blue-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Alasan</th>
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
                                    $tanggal =
                                        \Carbon\Carbon::parse($request->tanggal_mulai)->format('d M Y') .
                                        ' - ' .
                                        \Carbon\Carbon::parse($request->tanggal_selesai)->format('d M Y');
                                    $durasi = ($request->durasi_hari ?? 0) . ' hari';
                                    $statusBadge = match ($request->status) {
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        'Disetujui' => 'bg-emerald-100 text-emerald-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <tr class="hover:bg-blue-50 transition-colors duration-150">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-800">
                                        {{ $request->user->name ?? 'Unknown' }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $tanggal }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">{{ $durasi }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">
                                        {{ Str::limit($request->alasan ?? '-', 30) }}</td>
                                    <td class="px-6 py-5 text-sm text-gray-600">
                                        @if (isset($request->delegated_users) && $request->delegated_users->count() > 0)
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
                                                <button data-request-id="{{ $request->id }}" data-request-type="cuti"
                                                    class="btn-preview px-3 py-1.5 text-xs font-semibold rounded-lg bg-white border text-blue-700 hover:bg-blue-50 shadow-sm hover:shadow-md transition-all duration-200">Lihat
                                                    Surat</button>
                                                <button data-request-id="{{ $request->id }}" data-request-type="cuti"
                                                    data-employee-name="{{ $request->user->name }}" data-jenis="Cuti"
                                                    data-tanggal="{{ $tanggal }}" data-action="Approve"
                                                    class="btn-approve px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                                <button data-request-id="{{ $request->id }}" data-request-type="cuti"
                                                    data-employee-name="{{ $request->user->name }}" data-jenis="Cuti"
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
                                        pengajuan cuti</td>
                                </tr>
                            @endforelse
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

        @include('direktur.partials.approval-modal')
        @include('direktur.partials.preview-modal')

        <script>
            window.APPROVAL_ROUTES = {
                base: @json(route('direktur.persetujuan-cuti'))
            };
        </script>
        <script>
            function applyApprovalFilters() {
                const base = window.APPROVAL_ROUTES.base;
                const q = document.getElementById('filter_q')?.value.trim();
                const status = document.getElementById('filter_status')?.value;
                const periode = document.getElementById('filter_periode')?.value;
                const params = new URLSearchParams();
                if (q) params.set('q', q);
                if (status) params.set('status', status);
                if (periode) params.set('periode', periode);
                const url = base + (params.toString() ? ('?' + params.toString()) : '');
                window.location.href = url;
            }
        </script>

        <script src="{{ asset('js/direktur-approval.js') }}?v={{ time() }}"></script>
</x-app-layout> 
