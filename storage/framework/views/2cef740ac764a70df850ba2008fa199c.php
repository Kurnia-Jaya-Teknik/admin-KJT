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
            <?php echo e(__('Persetujuan Lembur')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                                    Keterangan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $tanggal = $r->tanggal ? \Carbon\Carbon::parse($r->tanggal)->format('d M Y') : '-';
                                    $durasi = ($r->durasi ?? 0) . ' jam';
                                    $statusBadge = match ($r->status) {
                                        'Pending' => 'bg-amber-100 text-amber-800',
                                        'Disetujui' => 'bg-emerald-100 text-emerald-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                ?>
                                <tr class="hover:bg-red-50 transition-colors duration-150">
                                    <td class="px-6 py-5 text-sm font-medium text-gray-800"><?php echo e($r->user->name ?? '-'); ?>

                                    </td>
                                    <td class="px-6 py-5 text-sm text-gray-600"><?php echo e($tanggal); ?></td>
                                    <td class="px-6 py-5 text-sm text-gray-600"><?php echo e($durasi); ?></td>
                                    <td class="px-6 py-5 text-sm text-gray-600"><?php echo e(Str::limit($r->alasan ?? '-', 40)); ?>

                                    </td>
                                    <td class="px-6 py-5 text-sm"><span
                                            class="px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo e($statusBadge); ?>"><?php echo e($r->status); ?></span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($r->status === 'Pending'): ?>
                                            <div class="flex items-center justify-center gap-2">
                                                <button
                                                    onclick="openApprovalModal('<?php echo e($r->user->name); ?>', 'Lembur', '<?php echo e($tanggal); ?>', 'Approve', <?php echo e($r->id); ?>, 'lembur')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white">Setujui</button>
                                                <button
                                                    onclick="openApprovalModal('<?php echo e($r->user->name); ?>', 'Lembur', '<?php echo e($tanggal); ?>', 'Reject', <?php echo e($r->id); ?>, 'lembur')"
                                                    class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white">Tolak</button>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada
                                        pengajuan lembur</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Template (reuse existing modal JS if present) -->
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
    </div>

    <?php $__env->startPush('scripts'); ?>
        <script>
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
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/direktur/persetujuan-lembur.blade.php ENDPATH**/ ?>