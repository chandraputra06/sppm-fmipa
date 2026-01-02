@extends('layouts.app')

@section('title', 'Profil Mahasiswa - Fakultas MIPA')

@section('content')
    <div class="bg-gray-50 min-h-screen py-8 mt-16">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Back Button -->
            <a href="{{ route('prestasi.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-800 mb-6 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span>Kembali ke Daftar</span>
            </a>

            <!-- Profile Card -->
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <div class="flex flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Avatar -->
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($student->name ?? 'N/A') }}&background=3b82f6&color=fff&size=64"
                        class="w-32 h-32 rounded-full shadow-lg">

                    <!-- Info -->
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $student->name }}</h1>
                        <div class="flex flex-wrap gap-4 text-gray-600 mb-4">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                                NIM: {{ $student->nim }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                {{ $student->studyProgram->name }}
                            </span>
                        </div>

                        <!-- Stats -->
                        <div class="flex flex-wrap gap-4">
                            <div class="bg-blue-50 rounded-lg px-6 py-3 text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $achievementCount }}</div>
                                <div class="text-sm text-gray-600">Total Prestasi</div>
                            </div>
                            <div class="bg-purple-50 rounded-lg px-6 py-3 text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $achievementInternasional }}</div>
                                <div class="text-sm text-gray-600">Internasional</div>
                            </div>
                            <div class="bg-green-50 rounded-lg px-6 py-3 text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $achievementNasional }}</div>
                                <div class="text-sm text-gray-600">Nasional</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Daftar Prestasi</h2>
                <p class="text-gray-600 mb-6">Timeline pencapaian mahasiswa</p>

                @foreach ($achievementsByYear as $year => $achievements)
                    <div class="mb-8">
                        <div class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full font-semibold mb-6">
                            {{ $year }}
                        </div>

                        <div class="space-y-6 ml-4">
                            @foreach ($achievements as $item)
                                <div class="relative pl-8 border-l-2 border-gray-200 pb-6">
                                    <div class="absolute left-0 top-0 -ml-2 w-4 h-4 bg-blue-600 rounded-full"></div>

                                    <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center space-x-3">
                                                <h3 class="font-bold text-lg text-gray-800"> {{ $item->title }}
                                                </h3>
                                            </div>

                                            <button
                                                class="open-modal flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-white transition text-sm"
                                                data-title="{{ $item->title }}"
                                                data-proof="{{ $item->proof ? asset('storage/' . $item->proof) : '' }}"
                                                data-jenis="{{ $item->getJenisPrestasiAttribute() }}"
                                                data-grade="{{ $item->grade }}" data-status="{{ $item->status }}"
                                                data-date="{{ $item->date->format('d F Y') }}"
                                                data-description="{{ $item->description }}">
                                                <span>Lihat Bukti & Foto</span>
                                            </button>
                                        </div>

                                        <!-- Badges -->
                                        <div class="flex flex-wrap gap-2 mb-3">
                                            <span
                                                class="bg-gray-800 text-white text-xs px-3 py-1 rounded-full">{{ $item->getJenisPrestasiAttribute() }}</span>
                                            <span
                                                class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">{{ $item->grade }}</span>
                                            <span
                                                class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">{{ $item->status }}</span>
                                        </div>

                                        <!-- Date -->
                                        <div class="flex items-center text-sm text-gray-500 mb-3">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $item->date->format('d F Y') }}
                                        </div>

                                        <!-- Description -->
                                        <p class="text-gray-600 text-sm">
                                            {{ $item->description }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('prestasi.partials.modal-proof')
@endsection

@push('scripts')
    <script>
        const modal = document.getElementById('achievementModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalImage = document.getElementById('modalImage');
        const noImage = document.getElementById('noImage');
        const modalJenis = document.getElementById('modalJenis');
        const modalGrade = document.getElementById('modalGrade');
        const modalStatus = document.getElementById('modalStatus');
        const modalDate = document.getElementById('modalDate');
        const modalDescription = document.getElementById('modalDescription');

        document.querySelectorAll('.open-modal').forEach(button => {
            button.addEventListener('click', () => {
                modalTitle.textContent = button.dataset.title;
                modalJenis.textContent = button.dataset.jenis;
                modalGrade.textContent = button.dataset.grade;
                modalStatus.textContent = button.dataset.status;
                modalDate.textContent = button.dataset.date;
                modalDescription.textContent = button.dataset.description;

                if (button.dataset.proof) {
                    modalImage.src = button.dataset.proof;
                    modalImage.classList.remove('hidden');
                    noImage.classList.add('hidden');
                } else {
                    modalImage.classList.add('hidden');
                    noImage.classList.remove('hidden');
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });
    </script>
@endpush
