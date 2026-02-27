<!-- Preview Modal -->
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
            <button type="button"
                class="btn-close-preview px-4 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-100">Tutup</button>
            <button type="button"
                class="btn-approve-from-preview px-4 py-2.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">Setujui
                (Lanjut)</button>
        </div>
    </div>
</div>
