@extends('layouts.app')

@section('title', 'Daftar Prestasi Mahasiswa - Fakultas MIPA')

@section('content')
    <!-- Header Section -->
    <section class="bg-white py-16 mt-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Daftar Prestasi Mahasiswa</h1>
            <p class="text-gray-600">Menampilkan seluruh capaian akademik & non-akademik mahasiswa</p>
        </div>
    </section>


    <!-- Filter Section -->
    <section class="bg-gray-50 py-8">
        <div class="container mx-auto px-4">

            <form method="GET" id="filterForm">
                <!-- Search Bar -->
                <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                    <div class="relative flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama mahasiswa atau NIM..." class="w-full bg-white rounded-lg px-3 py-2 text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="searchInput">

                        <button type="button" onclick="clearSearch()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                            aria-label="Bersihkan pencarian">
                            <i data-lucide="x" class="h-4 w-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                    <!-- Filter Prodi -->
                    <select name="study_program"
                        class="filter-select w-full bg-white border border-gray-300 rounded-lg px-4 py-3">
                        <option value="">Semua Prodi</option>
                        @foreach ($studyPrograms as $studyProgram)
                            <option value="{{ $studyProgram->id }}"
                                {{ request('study_program') == $studyProgram->id ? 'selected' : '' }}>
                                {{ $studyProgram->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Tingkat -->
                    <select name="grade"
                        class="filter-select w-full bg-white border border-gray-300 rounded-lg px-4 py-3">
                        <option value="">Semua Tingkat</option>
                        @foreach (['Internasional', 'Nasional', 'Lokal'] as $level)
                            <option value="{{ $level }}" {{ request('grade') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Filter Tahun -->
                    <select name="year"
                        class="filter-select w-full bg-white border border-gray-300 rounded-lg px-4 py-3">
                        <option value="">Semua Tahun</option>
                        @for ($y = now()->year; $y >= 2020; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Per Page -->
                <div class="flex items-center text-gray-600">
                    <span>Tampilkan</span>

                    <select name="per_page" class="filter-select mx-2 border border-gray-300 rounded px-2 py-1 text-sm">

                        @foreach ([5, 10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 5) == $size ? 'selected' : '' }}>
                                {{ $size }}
                            </option>
                        @endforeach
                    </select>

                    <span>Mahasiswa</span>
                </div>
            </form>

        </div>
    </section>



    <!-- Student List Section -->
    <section class="bg-gray-50 pb-16">
        <div class="container mx-auto px-4">
            <div class="space-y-4">
                <!-- Student Card 1 -->
                @forelse ($students as $item)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Avatar -->
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name ?? 'N/A') }}&background=3b82f6&color=fff&size=64"
                                    class="w-16 h-16 rounded-full">

                                <!-- Info -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $item->name }}</h3>
                                    <p class="text-sm text-gray-500">NIM: {{ $item->nim }}</p>
                                    <p class="text-sm text-gray-600">{{ $item->studyProgram->name }}</p>
                                </div>
                            </div>

                            <!-- Stats & Actions -->
                            <div class="flex items-center space-x-6">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-blue-600">{{ $item->achievements->count() }}</div>
                                    <div class="text-xs text-gray-500">Prestasi</div>
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{ route('prestasi.show', $item->id) }}"
                                        class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span class="text-sm">Lihat Profil</span>
                                    </a>

                                    {{-- <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Tidak ada prestasi yang dipublikasikan.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="flex justify-center items-center space-x-2 mt-8">
                {{-- Previous --}}
                <a href="{{ $students->previousPageUrl() ?? '#' }}"
                    class="p-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition
               {{ $students->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                {{-- Page Numbers --}}
                @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                        class="px-4 py-2 rounded-lg transition
                {{ $page == $students->currentPage() ? 'bg-gray-800 text-white' : 'border border-gray-300 hover:bg-gray-100' }}">
                        {{ $page }}
                    </a>
                @endforeach

                {{-- Next --}}
                <a href="{{ $students->nextPageUrl() ?? '#' }}"
                    class="p-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition
               {{ !$students->hasMorePages() ? 'opacity-50 pointer-events-none' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('filterForm');

        // auto submit saat dropdown berubah
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', () => {
                form.submit();
            });
        });

        // debounce search (submit setelah berhenti ngetik)
        let searchTimer;
        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                form.submit();
            }, 600); // delay 600ms
        });

        function clearSearch() {
            searchInput.value = '';
            form.submit();
        }
    </script>
@endpush
