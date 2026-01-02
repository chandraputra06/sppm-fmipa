<div id="achievementModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60">

    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">

        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h3 id="modalTitle" class="font-bold text-lg text-gray-800"></h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl">
                &times;
            </button>
        </div>

        <!-- Image -->
        <div class="p-6">
            <img id="modalImage" class="w-full rounded-lg object-cover max-h-80 hidden">
            <div id="noImage"
                class="h-64 flex items-center justify-center bg-gray-100 rounded-lg text-gray-500 hidden">
                Bukti belum tersedia
            </div>
        </div>

        <!-- Info -->
        <div class="px-6 space-y-3 text-sm text-gray-700">
            <div class="flex justify-between">
                <span>Jenis Prestasi:</span>
                <span id="modalJenis" class="bg-gray-800 text-white text-xs px-3 py-1 rounded-full"></span>
            </div>

            <div class="flex justify-between">
                <span>Tingkat:</span>
                <span id="modalGrade" class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full"></span>
            </div>

            <div class="flex justify-between">
                <span>Tanggal:</span>
                <span id="modalDate" class="font-medium"></span>
            </div>

            <div class="flex justify-between">
                <span>Status:</span>
                <span id="modalStatus" class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full"></span>
            </div>
        </div>

        <!-- Description -->
        <div class="px-6 py-4 border-t mt-4">
            <h4 class="font-semibold text-gray-800 mb-2">Deskripsi</h4>
            <p id="modalDescription" class="text-sm text-gray-600"></p>
        </div>
    </div>
</div>
