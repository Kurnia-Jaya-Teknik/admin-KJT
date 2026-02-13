<!-- Image Modal (untuk lihat surat dokter) -->
<div id="imageModal" class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center p-4"
    onclick="closeImageModal()">
    <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
        <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Surat Dokter</h3>
                <button onclick="closeImageModal()" class="text-white hover:text-gray-200 text-2xl">&times;</button>
            </div>
            <div class="p-4 bg-gray-100" style="max-height: 80vh; overflow-y: auto;">
                <img id="imageModalContent" src="" alt="Surat Dokter" class="w-full h-auto rounded shadow-lg">
            </div>
        </div>
    </div>
</div>
