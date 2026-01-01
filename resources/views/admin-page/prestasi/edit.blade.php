@extends('layouts.admin')
@section('title', 'Edit Prestasi')

@section('content')
    <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-2 text-sm text-gray-600 mb-6 hover:underline">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            Kembali
        </a>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6">
        <h1 class="my-4 text-lg font-semibold">Edit Prestasi</h1>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('achievements.update', $achievement->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label class="block text-gray-700">Judul Prestasi</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $achievement->title) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       required>
            </div>

            {{-- Mahasiswa --}}
            <div class="mb-4">
                <label class="block text-gray-700">Nama Mahasiswa</label>
                <select name="student_id"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ old('student_id', $achievement->student_id) == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label class="block text-gray-700">Deskripsi Prestasi</label>
                <textarea name="description"
                          rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $achievement->description) }}</textarea>
            </div>

            {{-- Tanggal --}}
            <div class="mb-4">
                <label class="block text-gray-700">Tanggal Prestasi</label>
                <input type="date"
                       name="date"
                       value="{{ old('date', $achievement->date) }}"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       required>
            </div>

            {{-- Kategori --}}
            <div class="mb-4">
                <label class="block text-gray-700">Kategori</label>
                <select name="category"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    <option value="1" {{ old('category', $achievement->category) == 1 ? 'selected' : '' }}>
                        Akademik
                    </option>
                    <option value="2" {{ old('category', $achievement->category) == 2 ? 'selected' : '' }}>
                        Non Akademik
                    </option>
                </select>
            </div>

            {{-- Tingkatan --}}
            <div class="mb-4">
                <label class="block text-gray-700">Tingkatan</label>
                <select name="grade"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    @foreach (['Lokal','Nasional','Internasional'] as $grade)
                        <option value="{{ $grade }}"
                            {{ old('grade', $achievement->grade) == $grade ? 'selected' : '' }}>
                            {{ $grade }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        required>
                    @foreach (['Draft','Verified','Publish'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $achievement->status) == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Bukti Prestasi --}}
            <div class="mb-4" x-data="{ preview: null }">
                <label class="block text-gray-700">Bukti Prestasi</label>

                @if ($achievement->proof)
                    <div class="mb-2 text-sm">
                        File saat ini:
                        <a href="{{ asset('storage/' . $achievement->proof) }}"
                           target="_blank"
                           class="text-blue-600 underline">
                            Lihat Bukti
                        </a>
                    </div>
                @endif

                <input type="file"
                       name="proof"
                       accept=".pdf,.doc,.docx,image/*"
                       @change="preview = $event.target.files[0].type.startsWith('image')
                                    ? URL.createObjectURL($event.target.files[0])
                                    : null"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm">

                <template x-if="preview">
                    <img :src="preview"
                         class="mt-3 h-32 rounded border object-cover">
                </template>
            </div>

            {{-- Foto --}}
            <div class="mb-6" x-data="{ preview: null }">
                <label class="block text-gray-700">Foto Pendukung</label>

                @if ($achievement->photo)
                    <img src="{{ asset('storage/' . $achievement->photo) }}"
                         class="mb-2 h-32 rounded border object-cover">
                @endif

                <input type="file"
                       name="photo"
                       accept="image/*"
                       @change="preview = URL.createObjectURL($event.target.files[0])"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm">

                <template x-if="preview">
                    <img :src="preview"
                         class="mt-3 h-32 rounded border object-cover">
                </template>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 text-sm">
                Update Prestasi
            </button>
        </form>
    </div>
@endsection
