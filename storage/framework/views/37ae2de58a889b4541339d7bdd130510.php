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
            <?php echo e(__('Kelola Akun Karyawan & Admin')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <!-- Fixed Sidebar -->
    <div class="fixed left-0 top-16 bottom-0 z-40 hidden lg:block">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Scrollable Main Content -->
    <div class="flex-1 lg:ml-64 overflow-y-auto h-[calc(100vh-4rem)]">
        <div class="p-6 lg:p-8 bg-white min-h-full">
            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex space-x-8">
                    <a href="<?php echo e(route('direktur.ringkasan-karyawan')); ?>"
                        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        📊 Ringkasan
                    </a>
                    <a href="<?php echo e(route('direktur.ringkasan-karyawan.kelola')); ?>"
                        class="border-red-500 text-red-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        👥 Kelola Akun
                    </a>
                </nav>
            </div>

            <!-- Header with Add Button -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Akun</h1>
                    <p class="text-gray-600 mt-1">Kelola akun karyawan dan admin HRD</p>
                </div>
                <button onclick="openAddModal()"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800 shadow-md hover:shadow-lg transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Akun
                </button>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Nama</label>
                        <input type="text" id="searchName" placeholder="Ketik nama..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="filterRole"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Role</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="admin_hrd">Admin HRD</option>
                            <option value="magang">Magang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="filterStatus"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="PKWTT">PKWTT</option>
                            <option value="PKWT">PKWT</option>
                            <option value="Magang">Magang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                        <select id="filterDivisi"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">Semua Divisi</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departemens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <option value="null">Belum Ada Divisi</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-red-600 to-red-700 border-b-2 border-red-800">
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Role</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Divisi</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                    Status Kepeg.</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-white uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="userTableBody">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-red-50 transition-colors duration-150"
                                    data-user-id="<?php echo e($user->id); ?>" data-name="<?php echo e(strtolower($user->name)); ?>"
                                    data-role="<?php echo e($user->role); ?>" data-status="<?php echo e($user->status_kepegawaian); ?>"
                                    data-divisi="<?php echo e($user->departemen_id); ?>">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gradient-to-br from-red-100 to-red-50 flex items-center justify-center mr-3">
                                                <span
                                                    class="text-red-600 font-semibold text-sm"><?php echo e(strtoupper(substr($user->name, 0, 2))); ?></span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></p>
                                                <p class="text-xs text-gray-500">ID: <?php echo e($user->id); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo e($user->email); ?></td>
                                    <td class="px-6 py-4">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role == 'admin_hrd'): ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Admin
                                                HRD</span>
                                        <?php elseif($user->role == 'magang'): ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Magang</span>
                                        <?php else: ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Karyawan</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->departemen): ?>
                                            <?php echo e($user->departemen->nama); ?>

                                        <?php else: ?>
                                            <span class="text-yellow-600 italic">Belum ada divisi</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->role == 'karyawan'): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status_kepegawaian == 'PKWTT'): ?>
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">PKWTT</span>
                                            <?php elseif($user->status_kepegawaian == 'PKWT'): ?>
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">PKWT</span>
                                            <?php else: ?>
                                                <span
                                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 italic">-</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php else: ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 italic">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center" id="status-<?php echo e($user->id); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->status === 'aktif'): ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">✓
                                                Aktif</span>
                                        <?php else: ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">✗
                                                Nonaktif</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editUser(<?php echo e($user->id); ?>)"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <button onclick="resetPassword(<?php echo e($user->id); ?>)"
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white rounded-lg text-sm hover:bg-yellow-600">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                                </svg>
                                                Reset
                                            </button>
                                            <button
                                                onclick="toggleStatus(<?php echo e($user->id); ?>, '<?php echo e($user->status); ?>')"
                                                class="inline-flex items-center px-3 py-1.5 <?php echo e($user->status === 'aktif' ? 'bg-orange-500 hover:bg-orange-600' : 'bg-green-500 hover:bg-green-600'); ?> text-white rounded-lg text-sm">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                                <?php echo e($user->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan'); ?>

                                            </button>
                                            <button onclick="deleteUser(<?php echo e($user->id); ?>, '<?php echo e($user->name); ?>')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-900/30 backdrop-blur-md hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div
                class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 flex items-center justify-between rounded-t-lg">
                <h3 class="text-xl font-bold text-white">Edit Data User</h3>
                <button onclick="closeEditModal()" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editForm" class="p-6 space-y-4">
                <input type="hidden" id="editUserId">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="editName" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="editEmail" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="editRole" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="karyawan">Karyawan</option>
                            <option value="admin_hrd">Admin HRD</option>
                            <option value="magang">Magang</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Kepegawaian</label>
                        <select id="editStatus"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="">- (Tidak Ada) -</option>
                            <option value="PKWTT">PKWTT</option>
                            <option value="PKWT">PKWT</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                    <select id="editDivisi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="">Belum Ada Divisi</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departemens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg hover:from-red-700 hover:to-red-800">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Filter functionality
        const searchName = document.getElementById('searchName');
        const filterRole = document.getElementById('filterRole');
        const filterStatus = document.getElementById('filterStatus');
        const filterDivisi = document.getElementById('filterDivisi');
        const tbody = document.getElementById('userTableBody');

        function filterTable() {
            const searchTerm = searchName.value.toLowerCase();
            const selectedRole = filterRole.value;
            const selectedStatus = filterStatus.value;
            const selectedDivisi = filterDivisi.value;

            const rows = tbody.querySelectorAll('tr');
            rows.forEach(row => {
                const name = row.dataset.name || '';
                const role = row.dataset.role || '';
                const status = row.dataset.status || '';
                const divisi = row.dataset.divisi || '';

                const matchName = name.includes(searchTerm);
                const matchRole = !selectedRole || role === selectedRole;
                const matchStatus = !selectedStatus || status === selectedStatus;
                const matchDivisi = !selectedDivisi ||
                    (selectedDivisi === 'null' && !divisi) ||
                    divisi === selectedDivisi;

                if (matchName && matchRole && matchStatus && matchDivisi) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchName.addEventListener('input', filterTable);
        filterRole.addEventListener('change', filterTable);
        filterStatus.addEventListener('change', filterTable);
        filterDivisi.addEventListener('change', filterTable);

        function openAddModal() {
            alert('Fitur tambah akun akan segera hadir!');
        }

        // Get user data and populate modal
        function editUser(userId) {
            // Find the row
            const row = document.querySelector(`tr[data-user-id="${userId}"]`);
            if (!row) {
                alert('❌ Data user tidak ditemukan');
                return;
            }

            try {
                // Get user data from row attributes
                const name = row.dataset.name ? row.dataset.name.charAt(0).toUpperCase() + row.dataset.name.slice(1) : '';
                const email = row.querySelector('td:nth-child(2)').textContent.trim();
                const role = row.dataset.role || 'karyawan';
                const status = row.dataset.status || '';
                const divisi = row.dataset.divisi || '';

                // Populate modal
                document.getElementById('editUserId').value = userId;
                document.getElementById('editName').value = name;
                document.getElementById('editEmail').value = email;
                document.getElementById('editRole').value = role;
                document.getElementById('editStatus').value = status || '';
                document.getElementById('editDivisi').value = divisi || '';

                // Show modal
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editModal').classList.add('flex');
            } catch (error) {
                console.error('Error loading user data:', error);
                alert('❌ Terjadi kesalahan saat membuka form edit');
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }

        // Handle form submission
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const userId = document.getElementById('editUserId').value;
            const formData = {
                name: document.getElementById('editName').value,
                email: document.getElementById('editEmail').value,
                role: document.getElementById('editRole').value,
                status_kepegawaian: document.getElementById('editStatus').value || null,
                departemen_id: document.getElementById('editDivisi').value || null
            };

            console.log('Sending data:', formData);

            try {
                const response = await fetch(`/direktur/ringkasan-karyawan/${userId}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                console.log('Response status:', response.status);
                const contentType = response.headers.get('content-type') || '';
                let result = null;

                if (contentType.includes('application/json')) {
                    result = await response.json();
                    console.log('Response data:', result);
                } else {
                    const text = await response.text();
                    console.error('Non-JSON response (text):', text);
                    alert('❌ Server returned non-JSON response (status ' + response.status + ').\nCheck console (Network & Console) for details.');
                    return;
                }

                if (response.ok && result && result.success) {
                    // Update table row in-place with returned user (no full reload needed)
                    const updatedUser = result.user;
                    const row = document.querySelector(`tr[data-user-id="${updatedUser.id}"]`);
                    if (row) {
                        // update data attributes
                        row.dataset.name = updatedUser.name || '';
                        row.dataset.role = updatedUser.role || '';
                        row.dataset.status = updatedUser.status_kepegawaian || '';
                        row.dataset.divisi = updatedUser.departemen_id || '';

                        // name
                        const nameEl = row.querySelector('td:nth-child(1) .text-gray-900');
                        if (nameEl) nameEl.textContent = updatedUser.name;

                        // email
                        const emailEl = row.querySelector('td:nth-child(2)');
                        if (emailEl) emailEl.textContent = updatedUser.email;

                        // role badge
                        const roleEl = row.querySelector('td:nth-child(3)');
                        if (roleEl) {
                            if (updatedUser.role === 'admin_hrd') {
                                roleEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Admin HRD</span>';
                            } else if (updatedUser.role === 'magang') {
                                roleEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Magang</span>';
                            } else {
                                roleEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Karyawan</span>';
                            }
                        }

                        // divisi
                        const divisiEl = row.querySelector('td:nth-child(4)');
                        if (divisiEl) {
                            divisiEl.textContent = (updatedUser.departemen && updatedUser.departemen.nama) ? updatedUser.departemen.nama : 'Belum ada divisi';
                        }

                        // status kepegawaian
                        const statusEl = row.querySelector('td:nth-child(5)');
                        if (statusEl) {
                            if (updatedUser.role === 'karyawan') {
                                if (updatedUser.status_kepegawaian === 'PKWTT') {
                                    statusEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">PKWTT</span>';
                                } else if (updatedUser.status_kepegawaian === 'PKWT') {
                                    statusEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">PKWT</span>';
                                } else {
                                    statusEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 italic">-</span>';
                                }
                            } else {
                                statusEl.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 italic">-</span>';
                            }
                        }

                        // update status badge (aktif/nonaktif) if provided
                        if (updatedUser.status) {
                            const statusCell = document.getElementById('status-' + updatedUser.id);
                            if (statusCell) {
                                if (updatedUser.status === 'aktif') {
                                    statusCell.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">✓ Aktif</span>';
                                } else {
                                    statusCell.innerHTML = '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">✗ Nonaktif</span>';
                                }
                            }
                        }
                    }

                    alert('✅ ' + result.message);
                    closeEditModal();
                } else if (result && result.errors) {
                    // Validation errors
                    const firstError = Object.values(result.errors)[0][0];
                    alert('❌ ' + firstError);
                } else if (result && !result.success) {
                    alert('❌ ' + (result.message || 'Terjadi kesalahan'));
                } else {
                    alert('❌ Unknown response from server');
                }
            } catch (error) {
                console.error('Fetch error:', error);
                alert('❌ Terjadi kesalahan: ' + error.message);
            }
        });

        async function resetPassword(userId) {
            if (!confirm('Reset password untuk user ID ' + userId + '?\n\nPassword akan direset ke: password123')) {
                return;
            }

            try {
                const response = await fetch(`/direktur/ringkasan-karyawan/${userId}/reset-password`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('✅ ' + result.message);
                } else {
                    alert('❌ ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat reset password');
            }
        }

        async function toggleStatus(userId, currentStatus) {
            const action = currentStatus === 'aktif' ? 'menonaktifkan' : 'mengaktifkan';
            if (!confirm('Yakin ingin ' + action + ' akun ini?')) {
                return;
            }

            try {
                const response = await fetch(`/direktur/ringkasan-karyawan/${userId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('✅ ' + result.message);
                    // Update status badge
                    const statusCell = document.getElementById('status-' + userId);
                    if (result.status === 'aktif') {
                        statusCell.innerHTML =
                            '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">✓ Aktif</span>';
                    } else {
                        statusCell.innerHTML =
                            '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">✗ Nonaktif</span>';
                    }

                    // Reload to update button
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('❌ ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat mengubah status');
            }
        }

        async function deleteUser(userId, userName) {
            if (!confirm('⚠️ PERINGATAN!\n\nHapus akun: ' + userName +
                    '?\n\nData yang akan dihapus:\n- Akun user\n- History pengajuan\n- Data terkait lainnya\n\nAksi ini TIDAK DAPAT dibatalkan!'
                    )) {
                return;
            }

            // Double confirmation
            if (!confirm('Konfirmasi sekali lagi untuk menghapus akun ' + userName + '?')) {
                return;
            }

            try {
                const response = await fetch(`/direktur/ringkasan-karyawan/${userId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();

                if (result.success) {
                    alert('✅ ' + result.message);
                    location.reload();
                } else {
                    alert('❌ ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Terjadi kesalahan saat menghapus akun');
            }
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
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
<?php /**PATH C:\xampp\htdocs\Admin-KJT\resources\views/direktur/kelola-karyawan.blade.php ENDPATH**/ ?>