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
