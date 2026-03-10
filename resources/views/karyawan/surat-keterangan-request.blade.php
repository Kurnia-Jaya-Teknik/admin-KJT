<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permintaan Surat Keterangan Kerja
        </h2>
    </x-slot>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        @include('layouts.sidebar')
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:pr-8 lg:pl-4 lg:py-8 bg-gray-50/50 min-h-full">

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <!-- Header dengan tombol buat -->
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">Surat Keterangan Kerja</h1>
                                    <p class="text-gray-600 text-base mt-2">Ajukan permintaan surat keterangan kerja Anda ke admin</p>
                                </div>
                                <button onclick="showRequestModal()"
                                    class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all shadow-sm hover:shadow-md">
                                    + Buat Permintaan
                                </button>
                            </div>

                            <!-- Status Stats -->
                            <div class="grid grid-cols-3 gap-4 mb-8">
                                <div class="bg-amber-50/80 border border-amber-200/50 rounded-2xl p-6 shadow-sm">
                                    <p class="text-sm text-amber-700 font-semibold mb-2 uppercase tracking-wide">Menunggu</p>
                                    <p class="text-4xl font-bold text-amber-900">
                                        {{ $requests->where('status', 'Pending')->count() }}</p>
                                </div>
                                <div class="bg-emerald-50/80 border border-emerald-200/50 rounded-2xl p-6 shadow-sm">
                                    <p class="text-sm text-emerald-700 font-semibold mb-2 uppercase tracking-wide">Disetujui</p>
                                    <p class="text-4xl font-bold text-emerald-900">
                                        {{ $requests->where('status', 'Approved')->count() }}</p>
                                </div>
                                <div class="bg-blue-50/80 border border-blue-200/50 rounded-2xl p-6 shadow-sm">
                                    <p class="text-sm text-blue-700 font-semibold mb-2 uppercase tracking-wide">Selesai</p>
                                    <p class="text-4xl font-bold text-blue-900">
                                        {{ $requests->where('status', 'Completed')->count() }}</p>
                                </div>
                            </div>

                            <!-- Table -->
                            @if ($requests->count() > 0)
                                <div class="overflow-x-auto">
                                    <div class="bg-gray-50/30 rounded-xl border border-gray-200/50 shadow-sm overflow-hidden">
                                        @foreach ($requests as $req)
                                            <div class="bg-white/60 backdrop-blur-sm p-5 hover:bg-white/90 transition-all duration-300 border-b border-gray-100/50 last:border-0 group">
                                                <div class="flex items-start justify-between gap-4 mb-3">
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between mb-2">
                                                            <p class="text-base font-semibold text-gray-800">{{ $req->alasan }}</p>
                                                            @if ($req->status === 'Pending')
                                                                <span class="px-3 py-1 bg-amber-100/70 text-amber-700 text-sm font-semibold rounded-full shadow-sm">Menunggu</span>
                                                            @elseif($req->status === 'Approved')
                                                                <span class="px-3 py-1 bg-emerald-100/70 text-emerald-700 text-sm font-semibold rounded-full shadow-sm">Disetujui</span>
                                                            @elseif($req->status === 'Completed')
                                                                <span class="px-3 py-1 bg-blue-100/70 text-blue-700 text-sm font-semibold rounded-full shadow-sm">Selesai</span>
                                                            @else
                                                                <span class="px-3 py-1 bg-red-100/70 text-red-700 text-sm font-semibold rounded-full shadow-sm">Ditolak</span>
                                                            @endif
                                                        </div>
                                                        <div class="space-y-1">
                                                            <p class="text-sm text-gray-600"><strong>Keperluan:</strong> {{ Str::limit($req->keperluan, 60) }}</p>
                                                            <p class="text-sm text-gray-600"><strong>Tanggal Diminta:</strong> {{ $req->tanggal_diminta->format('d/m/Y') }}</p>
                                                        </div>
                                                    </div>
                                                    @if ($req->status === 'Pending')
                                                        <button onclick="cancelRequest({{ $req->id }})"
                                                            class="text-sm text-red-600/90 hover:text-red-700 font-semibold transition-colors flex-shrink-0">Batalkan</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Permintaan</h3>
                                    <p class="text-gray-600 mb-6 text-base">Anda belum mengajukan surat keterangan</p>
                                    <button onclick="showRequestModal()"
                                        class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all shadow-sm hover:shadow-md">
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
                <div class="bg-white rounded-2xl shadow-xl max-w-md w-full overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-5 border-b border-red-800/20 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white">Permintaan Surat Keterangan</h2>
                            <p class="text-sm text-red-100 mt-1">Isi data permintaan Anda dengan lengkap</p>
                        </div>
                        <button onclick="closeRequestModal()" class="text-white/70 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Form -->
                    <form id="requestForm" class="p-6 space-y-4">
                        @csrf

                        <!-- Error Display -->
                        <div id="errorAlert" class="hidden bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <p class="text-sm font-semibold text-red-800 mb-2">Gagal:</p>
                            <ul id="errorList" class="text-sm text-red-700 space-y-1 list-disc pl-5"></ul>
                        </div>

                        <!-- Alasan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Alasan Permintaan</label>
                            <select id="alasan" name="alasan" required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all text-base">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Pembukaan Rekening Bank">Pembukaan Rekening Bank</option>
                                <option value="Lamaran Kerja">Lamaran Kerja</option>
                                <option value="Visa/Perjalanan">Visa/Perjalanan</option>
                                <option value="Administrasi Umum">Administrasi Umum</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <p id="error-alasan" class="text-xs text-red-500 mt-1 hidden"></p>
                        </div>

                        <!-- Keperluan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Detail Keperluan</label>
                            <textarea id="keperluan" name="keperluan" rows="3" placeholder="Jelaskan keperluan Anda..." required
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all text-base"></textarea>
                            <p id="error-keperluan" class="text-xs text-red-500 mt-1 hidden"></p>
                        </div>

                        <!-- Tanggal Diminta -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Dibutuhkan</label>
                            <input type="date" id="tanggal_diminta" name="tanggal_diminta" required
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all text-base">
                            <p class="text-xs text-gray-500 mt-1">Minimal hari ini atau lebih</p>
                            <p id="error-tanggal_diminta" class="text-xs text-red-500 mt-1 hidden"></p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 pt-4">
                            <button type="button" onclick="closeRequestModal()"
                                class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-200 shadow-sm hover:shadow-md">
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

                    // Clear previous errors
                    document.getElementById('errorAlert').classList.add('hidden');
                    document.querySelectorAll('[id^="error-"]').forEach(el => el.classList.add('hidden'));

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    // Disable submit button to prevent double submission
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Mengirim...';

                    fetch('/karyawan/surat-keterangan-request', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: new FormData(this)
                        })
                        .then(r => {
                            if (!r.ok) {
                                return r.json().then(data => {
                                    throw {
                                        status: r.status,
                                        data: data
                                    };
                                });
                            }
                            return r.json();
                        })
                        .then(res => {
                            if (res.ok) {
                                alert('✅ Permintaan berhasil dikirim ke admin!');
                                closeRequestModal();
                                setTimeout(() => location.reload(), 500);
                            } else {
                                // Show error alert
                                const errorAlert = document.getElementById('errorAlert');
                                const errorList = document.getElementById('errorList');

                                errorAlert.classList.remove('hidden');
                                errorList.innerHTML = '';

                                if (res.errors) {
                                    // Display field-specific errors
                                    for (const [field, messages] of Object.entries(res.errors)) {
                                        messages.forEach(msg => {
                                            const li = document.createElement('li');
                                            li.textContent = msg;
                                            errorList.appendChild(li);

                                            // Show error under field
                                            const errorEl = document.getElementById(`error-${field}`);
                                            if (errorEl) {
                                                errorEl.textContent = messages[0];
                                                errorEl.classList.remove('hidden');
                                            }
                                        });
                                    }
                                } else {
                                    const li = document.createElement('li');
                                    li.textContent = res.message || 'Terjadi kesalahan';
                                    errorList.appendChild(li);
                                }
                            }
                        })
                        .catch(e => {
                            console.error('Error:', e);
                            const errorAlert = document.getElementById('errorAlert');
                            const errorList = document.getElementById('errorList');

                            errorAlert.classList.remove('hidden');
                            errorList.innerHTML = '<li>' + (e.data?.message || e.message ||
                                'Gagal mengirim permintaan') + '</li>';
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Kirim Permintaan';
                        });
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
        </div>
    </div>
    </div>
</x-app-layout>
