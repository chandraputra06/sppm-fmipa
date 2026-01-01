@extends('layouts.admin')

@section('title', 'User Create')

@section('content')
    <div class="flex items-center">

         <a href="{{ route('users.index') }}" class="flex items-center gap-2 text-sm text-gray-600 mb-6 hover:underline">
            <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali
        </a>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-6">
        <h1 class="my-4">Users Create</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-3 py-2"
                    required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="1">Admin</option>
                    <option value="2">Dosen</option>
                    <option value="3">Mahasiswa</option>
                </select>
            </div>
            <div class="mb-4" style="display: none">
                <label for="nim" class="block text-gray-700">NIM</label>
                <input type="number" name="nim" id="nim" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
            <div class="mb-4" style="display: none">
                <label for="study_program_id" class="block text-gray-700">Study Program</label>
                <select name="study_program_id" id="study_program_id"
                    class="w-full border border-gray-300 rounded px-3 py-2">
                    {{-- <option value="">Select Study Program</option> --}}
                    @foreach ($studyPrograms as $studyProgram)
                        <option value="{{ $studyProgram->id }}">{{ $studyProgram->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">Create User</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('role').addEventListener('change', function() {
            var nimField = document.getElementById('nim').parentElement;
            var studyProgramField = document.getElementById('study_program_id').parentElement;
            if (this.value == '3') { // Student
                nimField.style.display = 'block';
                studyProgramField.style.display = 'block';
            } else if (this.value == '2') { // Dosen
                nimField.style.display = 'none';
                studyProgramField.style.display = 'block';
            } else {
                nimField.style.display = 'none';
                studyProgramField.style.display = 'none';
            }
        });
    </script>
@endpush
