@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Prestasi Terdata -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-600">Total Prestasi Terdata</p>
                <span class="text-gray-400">
                    <i data-lucide="chart-spline" class="h-5 w-5 text-gray-400"></i>
                </span>
            </div>

            <div class="mt-4">
                <p class="text-3xl font-bold text-blue-600">
                    {{ $totalAchievements }}
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Semua data prestasi
                </p>
            </div>
        </div>

        <!-- Prestasi Tahun Ini -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-600">Prestasi Tahun Ini</p>
                <span class="text-gray-400">
                    <i data-lucide="medal" class="h-5 w-5 text-gray-400"></i>
                </span>
            </div>

            <div class="mt-4">
                <p class="text-3xl font-bold text-green-600">
                    {{ $totalAchievementyear }}
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Data tahun {{ now()->year }}
                </p>
            </div>
        </div>

        <!-- Prestasi Terpublikasi -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-600">Prestasi Terpublikasi</p>
                <span class="text-gray-400">
                    <i data-lucide="circle-check" class="h-5 w-5 text-gray-400"></i>
                </span>
            </div>

            <div class="mt-4">
                <p class="text-3xl font-bold text-indigo-600">
                    {{ $totalPublished }}
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Dapat dilihat publik
                </p>
            </div>
        </div>

        <!-- Menunggu Verifikasi -->
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-600">Menunggu Verifikasi</p>
                <span class="text-gray-400">
                    <i data-lucide="clock" class="h-5 w-5 text-gray-400"></i>

                </span>
            </div>

            <div class="mt-4">
                <p class="text-3xl font-bold text-red-600">
                    {{ $totalVerified }}
                </p>
                <p class="mt-1 text-sm text-gray-500">
                    Perlu ditinjau
                </p>
            </div>
        </div>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 mt-10">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">
            Data Prestasi Mahasiswa
        </h2>

        {{-- Search & Filter --}}
        @include('admin-page.dashboard.partials.filter')

        {{-- Table --}}
        @include('admin-page.dashboard.partials.table')
    </div>
@endsection

@push('scripts')
    <script>
        function clearSearch() {
            document.getElementById('search-input').value = '';
            document.querySelector('form').submit();
        }
    </script>
@endpush
