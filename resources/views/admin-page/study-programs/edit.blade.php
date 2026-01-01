@extends('layouts.admin')

@section('title', 'Program Studi Edit')

@section('content')
    <div class="flex items-center">
       <a href="{{ route('study-programs.index') }}"
            class="flex items-center gap-2 text-sm text-gray-600 mb-6 hover:underline">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali
        </a>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-6">
        <h1 class="my-4">Program Studi Edit</h1>
        <form action="{{ route('study-programs.update', $studyProgram->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama Program Studi</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2"
                    value="{{ old('name', $studyProgram->name) }}" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">Update</button>
        </form>
    </div>
@endsection
