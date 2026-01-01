@extends('layouts.admin')

@section('content')
 <div class="flex items-center">
        <a href="{{ route('users.index') }}"
            class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <i data-lucide="arrow-left-to-line" class="w-5 h-5"></i>
            <span>Back To User</span>
        </a>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 mt-10">
        <h1 class="my-4 text-xl font-semibold">Edit User</h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Role --}}
            <div class="mb-4">
                <label class="block text-gray-700">Role</label>
                <select name="role" id="role" class="w-full border rounded px-3 py-2" required>
                    <option value="1" @selected(old('role', $user->role) == 1)>Admin</option>
                    <option value="2" @selected(old('role', $user->role) == 2)>Dosen</option>
                    <option value="3" @selected(old('role', $user->role) == 3)>Mahasiswa</option>
                </select>
            </div>

            {{-- NIM --}}
            <div class="mb-4" id="nim-wrapper">
                <label class="block text-gray-700">NIM</label>
                <input type="number" name="nim" class="w-full border rounded px-3 py-2"
                    value="{{ old('nim', $user->student->nim ?? '') }}">
            </div>

            {{-- Study Program --}}
            <div class="mb-4" id="study-program-wrapper">
                <label class="block text-gray-700">Study Program</label>
                <select name="study_program_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- pilih --</option>
                    @foreach ($studyPrograms as $studyProgram)
                        <option value="{{ $studyProgram->id }}" @selected(old('study_program_id', $user->student->study_program_id ?? ($user->lecture->study_program_id ?? null)) == $studyProgram->id)>
                            {{ $studyProgram->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-400">
                Update User
            </button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleFields(role) {
            const nim = document.getElementById('nim-wrapper');
            const study = document.getElementById('study-program-wrapper');

            if (role === '3') { // mahasiswa
                nim.style.display = 'block';
                study.style.display = 'block';
            } else if (role === '2') { // dosen
                nim.style.display = 'none';
                study.style.display = 'block';
            } else {
                nim.style.display = 'none';
                study.style.display = 'none';
            }
        }

        const roleSelect = document.getElementById('role');

        // on load
        toggleFields(roleSelect.value);

        // on change
        roleSelect.addEventListener('change', function() {
            toggleFields(this.value);
        });
    </script>
@endpush
