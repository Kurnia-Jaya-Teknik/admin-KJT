<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permintaan Surat Keterangan Kerja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header dengan tombol buat -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Permintaan Surat Keterangan</h1>
                            <p class="text-gray-600 text-sm mt-1">Kelola permintaan surat keterangan kerja Anda</p>
                        </div>
                        <button onclick="showRequestModal()" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-400 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-500 transition-all">
                            + Buat Permintaan
                        </button>
                    </div>

                    <!-- Status Stats -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="bg-amber-50 border border-amber-100 rounded-lg p-4">
                            <p class="text-sm text-amber-700 font-medium">Pending</p>
                            <p class="text-2xl font-bold text-amber-900">{{ $requests->where('status', 'Pending')->count() }}</p>
                        </div>
                        <div class="bg-green-50 border border-green-100 rounded-lg p-4">
                            <p class="text-sm text-green-700 font-medium">Approved</p>
                            <p class="text-2xl font-bold text-green-900">{{ $requests->where('status', 'Approved')->count() }}</p>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                            <p class="text-sm text-blue-700 font-medium">Completed</p>
                            <p class="text-2xl font-bold text-blue-900">{{ $requests->where('status', 'Completed')->count() }}</p>
                        </div>
                    </div>

                    <!-- Table -->
                    @if($requests->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Alasan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Keperluan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Tanggal Diminta</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($requests as $req)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $req->alasan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($req->keperluan, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $req->tanggal_diminta->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($req->status === 'Pending')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">Menunggu</span>
                                            @elseif($req->status === 'Approved')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                            @elseif($req->status === 'Completed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Selesai</span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @if($req->status === 'Pending')
                                                <button onclick="cancelRequest({{ $req->id }})" class="text-red-600 hover:text-red-900 font-medium">Batalkan</button>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">Belum ada permintaan surat keterangan</p>
                            <button onclick="showRequestModal()" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-all">
                                Buat Permintaan Pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Permintaan Surat Keterangan</h2>
                    <p class="text-sm text-gray-600 mt-1">Isi data permintaan Anda</p>
                </div>
                <button onclick="closeRequestModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="requestForm" class="p-6 space-y-4">
                @csrf

                <!-- Alasan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Alasan Permintaan</label>
                    <select id="alasan" name="alasan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Pilih Alasan --</option>
                        <option value="Pembukaan Rekening Bank">Pembukaan Rekening Bank</option>
                        <option value="Lamaran Kerja">Lamaran Kerja</option>
                        <option value="Visa/Perjalanan">Visa/Perjalanan</option>
                        <option value="Administrasi Umum">Administrasi Umum</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Keperluan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Detail Keperluan</label>
                    <textarea id="keperluan" name="keperluan" rows="3" placeholder="Jelaskan keperluan Anda..." required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>

                <!-- Tanggal Diminta -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Dibutuhkan</label>
                    <input type="date" id="tanggal_diminta" name="tanggal_diminta" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Actions -->
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="closeRequestModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-400 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-500 transition-all">
                        Kirim Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRequestModal() {
            document.getElementById('requestModal').classList.remove('hidden');
        }

        function closeRequestModal() {
            document.getElementById('requestModal').classList.add('hidden');
            document.getElementById('requestForm').reset();
        }

        document.getElementById('requestForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('{{ route("karyawan.surat-keterangan.request.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    alasan: formData.get('alasan'),
                    keperluan: formData.get('keperluan'),
                    tanggal_diminta: formData.get('tanggal_diminta'),
                })
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    alert('Permintaan berhasil dikirim ke admin');
                    closeRequestModal();
                    location.reload();
                } else {
                    alert('Error: ' + res.message);
                }
            })
            .catch(e => alert('Error: ' + e.message));
        });

        function cancelRequest(id) {
            if (!confirm('Batalkan permintaan ini?')) return;

            fetch(`/karyawan/surat-keterangan-request/${id}/cancel`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.ok) {
                    alert('Permintaan berhasil dibatalkan');
                    location.reload();
                } else {
                    alert('Error: ' + res.message);
                }
            })
            .catch(e => alert('Error: ' + e.message));
        }
    </script>
</x-app-layout>
