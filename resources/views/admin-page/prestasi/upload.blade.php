@extends('layouts.admin')

@section('title', 'Upload Data Excel')

@section('content')
    {{-- Back --}}
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-2 text-sm text-gray-600 mb-6 hover:underline">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
        Kembali ke Dashboard
    </a>

    {{-- Card --}}
    <div class="bg-white rounded-xl shadow-sm border p-6 space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold">Upload Data Excel</h2>
                <p class="text-sm text-gray-500">
                    Upload file Excel untuk menambahkan data prestasi secara massal
                </p>
            </div>

            <a href="{{ route('achievements.downloadTemplate') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm border rounded-lg hover:bg-gray-50">
                <i data-lucide="download" class="w-5 h-5"></i>
                Download Template
            </a>
        </div>

        {{-- FORM UPLOAD --}}
        <form action="{{ route('achievements.import') }}"
              method="POST"
              enctype="multipart/form-data"
              x-data="excelUpload()"
              class="space-y-6">
            @csrf

            {{-- Upload Box --}}
            <div
                class="border-2 border-dashed rounded-xl p-10 flex flex-col items-center justify-center text-center gap-4
                       bg-gray-50 transition"
                :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'"
                @dragover.prevent="dragging = true"
                @dragleave.prevent="dragging = false"
                @drop.prevent="handleDrop($event)">

                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                    <i data-lucide="file" class="w-5 h-5"></i>
                </div>

                <p class="text-sm text-gray-600">
                    Drag & drop file Excel di sini
                </p>

                <span class="text-xs text-gray-400">atau</span>

                <label
                    class="inline-flex items-center px-4 py-2 bg-white border rounded-lg cursor-pointer hover:bg-gray-50">
                    Pilih File
                    <input type="file"
                           name="file"
                           accept=".xls,.xlsx"
                           class="hidden"
                           @change="handleFile($event)">
                </label>

                <p class="text-xs text-gray-400">
                    Format: .xls, .xlsx • Maksimal 10MB
                </p>

                {{-- Selected file --}}
                <template x-if="fileName">
                    <p class="text-sm text-green-600 mt-2">
                        File dipilih: <strong x-text="fileName"></strong>
                    </p>
                </template>
            </div>

            {{-- Submit --}}
            <div class="flex justify-end">
                <button type="submit"
                        :disabled="!fileReady"
                        class="px-5 py-2 rounded-lg text-sm text-white transition"
                        :class="fileReady
                            ? 'bg-blue-600 hover:bg-blue-700'
                            : 'bg-gray-400 cursor-not-allowed'">
                    Upload Excel
                </button>
            </div>
        </form>

        {{-- Info --}}
        <div class="bg-gray-50 border rounded-xl p-5">
            <h3 class="text-sm font-semibold mb-3">
                Kolom Wajib dalam Excel
            </h3>

            <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                <li>NIM</li>
                <li>Nama Mahasiswa</li>
                <li>Program Studi</li>
                <li>Jenis Prestasi (Akademik / Non Akademik)</li>
                <li>Nama Kegiatan</li>
                <li>Tingkat (Fakultas / Universitas / Nasional / Internasional)</li>
                <li>Tanggal Perolehan (DD/MM/YYYY)</li>
            </ul>
        </div>

    </div>
@endsection

@push('scripts')
 {{-- Alpine --}}
    <script>
        function excelUpload() {
            return {
                dragging: false,
                fileName: null,
                fileReady: false,

                handleFile(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    this.fileName = file.name;
                    this.fileReady = true;
                },

                handleDrop(e) {
                    this.dragging = false;
                    const file = e.dataTransfer.files[0];
                    if (!file) return;

                    this.$el.querySelector('input[type=file]').files = e.dataTransfer.files;
                    this.fileName = file.name;
                    this.fileReady = true;
                }
            }
        }
    </script>

@endpush
