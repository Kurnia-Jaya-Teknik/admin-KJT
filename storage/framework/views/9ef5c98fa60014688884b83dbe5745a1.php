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
            <?php echo e(__('Persetujuan Surat')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Filters - Clean Red-Grey Style -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Surat</label>
                    <select class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                        <option>Semua Jenis</option>
                        <option>Surat PKWT</option>
                        <option>Surat PKWTT</option>
                        <option>Surat Magang</option>
                        <option>Surat Jalan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                    <select class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                        <option>Semua</option>
                        <option>Pending</option>
                        <option>Disetujui</option>
                        <option>Ditolak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Periode</label>
                    <input type="month" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 hover:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm hover:shadow-md">
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2.5 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
                        Terapkan Filter
                    </button>
                </div>
            </div>

            <!-- Table - Vibrant Red-Grey -->
            <div class="group relative overflow-hidden bg-white rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition-all duration-300">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nama Karyawan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Jenis Surat</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Tanggal Pengajuan</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Ahmad Rizki</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWTT</td>
                                <td class="px-6 py-4 text-sm text-gray-600">5 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openDetailModal('Ahmad Rizki', 'Surat PKWTT', '5 Jan 2026')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-200">Lihat</button>
                                        <button onclick="openApprovalModal('Ahmad Rizki', 'Surat PKWTT', '5 Jan 2026', 'Approve')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button onclick="openApprovalModal('Ahmad Rizki', 'Surat PKWTT', '5 Jan 2026', 'Reject')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Rekomendasi</td>
                                <td class="px-6 py-4 text-sm text-gray-600">4 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openDetailModal('Siti Nurhaliza', 'Surat Rekomendasi', '4 Jan 2026')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-200">Lihat</button>
                                        <button onclick="openApprovalModal('Siti Nurhaliza', 'Surat Rekomendasi', '4 Jan 2026', 'Approve')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button onclick="openApprovalModal('Siti Nurhaliza', 'Surat Rekomendasi', '4 Jan 2026', 'Reject')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Budi Santoso</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Magang</td>
                                <td class="px-6 py-4 text-sm text-gray-600">3 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-800">Disetujui</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openDetailModal('Budi Santoso', 'Surat Magang', '3 Jan 2026')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-200">Lihat</button>
                                        <button class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed" disabled>Setujui</button>
                                        <button class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed" disabled>Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Rina Wijaya</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat PKWT</td>
                                <td class="px-6 py-4 text-sm text-gray-600">2 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-100 text-red-800">Ditolak</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openDetailModal('Rina Wijaya', 'Surat PKWT', '2 Jan 2026')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-200">Lihat</button>
                                        <button class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed" disabled>Setujui</button>
                                        <button class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-gray-300 text-gray-500 cursor-not-allowed" disabled>Tolak</button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-red-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">Dani Hermawan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">Surat Jalan</td>
                                <td class="px-6 py-4 text-sm text-gray-600">6 Jan 2026</td>
                                <td class="px-6 py-4 text-sm"><span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-100 text-amber-800">Pending</span></td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openDetailModal('Dani Hermawan', 'Surat Jalan', '6 Jan 2026')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-sm hover:shadow-md transition-all duration-200">Lihat</button>
                                        <button onclick="openApprovalModal('Dani Hermawan', 'Surat Jalan', '6 Jan 2026', 'Approve')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all duration-200">Setujui</button>
                                        <button onclick="openApprovalModal('Dani Hermawan', 'Surat Jalan', '6 Jan 2026', 'Reject')" class="px-3 py-1.5 text-xs font-semibold rounded-lg bg-red-600 text-white hover:bg-red-700 shadow-sm hover:shadow-md transition-all duration-200">Tolak</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between bg-gray-50">
                    <p class="text-sm text-gray-600">Menampilkan 5 dari 18 surat</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">← Sebelumnya</button>
                        <button class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">Selanjutnya →</button>
                    </div>
                </div>
            </div>
                </div>
    </div>

    <!-- Detail Modal - View Letter -->
    <div id="detailModal" class="fixed inset-0 bg-black/30 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 max-w-md w-full animate-in fade-in zoom-in-95 duration-300">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700">
                <h3 class="text-lg font-bold text-white">Detail Surat</h3>
            </div>

            <!-- Content -->
            <div class="px-6 py-6 space-y-4">
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 font-semibold">Nama Karyawan</p>
                    <p id="detailEmployeeName" class="text-base font-bold text-gray-800">-</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 font-semibold">Jenis Surat</p>
                    <p id="detailLetterType" class="text-base font-bold text-gray-800">-</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 font-semibold">Tanggal Pengajuan</p>
                    <p id="detailSubmissionDate" class="text-base font-bold text-gray-800">-</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 font-semibold">Uraian Surat</p>
                    <p class="text-sm text-gray-700 leading-relaxed">Surat permohonan sebagaimana dimaksud dalam prosedur administratif perusahaan, berdasarkan kebijakan manajemen sumber daya manusia.</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-5 border-t border-gray-200 flex items-center justify-end bg-gray-50">
                <button onclick="closeDetailModal()" class="px-6 py-2.5 rounded-lg bg-gray-300 text-gray-700 font-semibold hover:bg-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Approval Modal - Approve/Reject Letter -->
    <div id="approvalModal" class="fixed inset-0 bg-black/30 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 max-w-md w-full animate-in fade-in zoom-in-95 duration-300">
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
                    <p class="text-sm text-gray-600 font-semibold">Jenis Surat</p>
                    <p id="modalLetterType" class="text-base font-bold text-gray-800">-</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600 font-semibold">Tanggal Pengajuan</p>
                    <p id="modalSubmissionDate" class="text-base font-bold text-gray-800">-</p>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea id="modalNotes" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all shadow-sm resize-none" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-5 border-t border-gray-200 flex items-center justify-between gap-3 bg-gray-50">
                <button onclick="closeApprovalModal()" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100 transition-all duration-200 shadow-sm hover:shadow-md">
                    Batal
                </button>
                <button id="modalConfirmBtn" onclick="confirmApproval()" class="flex-1 px-4 py-2.5 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700 shadow-md hover:shadow-lg transition-all duration-200">
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

        function openDetailModal(employeeName, letterType, submissionDate) {
            document.getElementById('detailEmployeeName').textContent = employeeName;
            document.getElementById('detailLetterType').textContent = letterType;
            document.getElementById('detailSubmissionDate').textContent = submissionDate;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function openApprovalModal(employeeName, letterType, submissionDate, action) {
            currentApprovalData = {
                employee: employeeName,
                type: letterType,
                date: submissionDate,
                action: action
            };

            const modal = document.getElementById('approvalModal');
            const actionText = action === 'Approve' ? 'Setujui Surat' : 'Tolak Surat';

            document.getElementById('modalAction').textContent = actionText;
            document.getElementById('modalEmployeeName').textContent = employeeName;
            document.getElementById('modalLetterType').textContent = letterType;
            document.getElementById('modalSubmissionDate').textContent = submissionDate;
            document.getElementById('modalNotes').value = '';

            const btnText = action === 'Approve' ? 'Setujui' : 'Tolak';
            const btnClass = action === 'Approve' 
                ? 'bg-emerald-600 hover:bg-emerald-700' 
                : 'bg-red-600 hover:bg-red-700';
            
            document.getElementById('modalConfirmBtn').textContent = btnText;
            document.getElementById('modalConfirmBtn').className = `flex-1 px-4 py-2.5 rounded-lg ${btnClass} text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200`;

            modal.classList.remove('hidden');
        }

        function closeApprovalModal() {
            document.getElementById('approvalModal').classList.add('hidden');
        }

        function confirmApproval() {
            const notes = document.getElementById('modalNotes').value;
            const action = currentApprovalData.action === 'Approve' ? 'DISETUJUI' : 'DITOLAK';
            
            alert(`${currentApprovalData.employee}\n${currentApprovalData.type}\n\n${action}\n\nCatatan: ${notes || '(tidak ada)'}`);
            
            closeApprovalModal();
        }

        // Close modals when clicking outside
        document.getElementById('detailModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'detailModal') {
                closeDetailModal();
            }
        });

        document.getElementById('approvalModal')?.addEventListener('click', (e) => {
            if (e.target.id === 'approvalModal') {
                closeApprovalModal();
            }
        });
    </script>
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
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/direktur/persetujuan-surat.blade.php ENDPATH**/ ?>