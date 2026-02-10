<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permintaan Surat Keterangan Kerja
        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                            <h1 class="text-2xl font-bold text-gray-900">📋 Surat Keterangan Kerja</h1>
                            <p class="text-gray-600 text-sm mt-1">Ajukan permintaan surat keterangan kerja Anda ke admin</p>
                        </div>
                        <button onclick="showRequestModal()" class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow-md">
                            + Buat Permintaan
                        </button>
                    </div>

                    <!-- Status Stats -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="bg-amber-50 border border-amber-100 rounded-lg p-4">
                            <p class="text-sm text-amber-700 font-medium">Pending</p>
                            <p class="text-2xl font-bold text-amber-900"><?php echo e($requests->where('status', 'Pending')->count()); ?></p>
                        </div>
                        <div class="bg-green-50 border border-green-100 rounded-lg p-4">
                            <p class="text-sm text-green-700 font-medium">Approved</p>
                            <p class="text-2xl font-bold text-green-900"><?php echo e($requests->where('status', 'Approved')->count()); ?></p>
                        </div>
                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                            <p class="text-sm text-blue-700 font-medium">Completed</p>
                            <p class="text-2xl font-bold text-blue-900"><?php echo e($requests->where('status', 'Completed')->count()); ?></p>
                        </div>
                    </div>

                    <!-- Table -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($requests->count() > 0): ?>
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
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($req->alasan); ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo e(Str::limit($req->keperluan, 50)); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo e($req->tanggal_diminta->format('d/m/Y')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($req->status === 'Pending'): ?>
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">Menunggu</span>
                                            <?php elseif($req->status === 'Approved'): ?>
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                            <?php elseif($req->status === 'Completed'): ?>
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Selesai</span>
                                            <?php else: ?>
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($req->status === 'Pending'): ?>
                                                <button onclick="cancelRequest(<?php echo e($req->id); ?>)" class="text-red-600 hover:text-red-900 font-medium">Batalkan</button>
                                            <?php else: ?>
                                                <span class="text-gray-400">-</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">Belum ada permintaan surat keterangan</p>
                            <button onclick="showRequestModal()" class="px-6 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow-md">
                                Buat Permintaan Pertama
                            </button>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Modal -->
    <div id="requestModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-4 border-b border-red-200 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-red-900">📋 Permintaan Surat Keterangan</h2>
                    <p class="text-sm text-red-700/80 mt-1">Isi data permintaan Anda dengan lengkap</p>
                </div>
                <button onclick="closeRequestModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="requestForm" class="p-6 space-y-4">
                <?php echo csrf_field(); ?>

                <!-- Alasan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Alasan Permintaan</label>
                    <select id="alasan" name="alasan" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
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
                    <textarea id="keperluan" name="keperluan" rows="3" placeholder="Jelaskan keperluan Anda..." required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"></textarea>
                </div>

                <!-- Tanggal Diminta -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Tanggal Dibutuhkan</label>
                    <input type="date" id="tanggal_diminta" name="tanggal_diminta" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                </div>

                <!-- Actions -->
                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeRequestModal()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-sm hover:shadow-md">
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

            fetch('<?php echo e(route("karyawan.surat-keterangan.request.store")); ?>', {
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
        </div>
    </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/karyawan/surat-keterangan-request.blade.php ENDPATH**/ ?>