@extends('layouts.admin')

@section('title', 'Users Management')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white p-6 mt-10">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">
                Users Management
            </h1>
            <a href="{{ route('users.create') }}"
                 class="flex items-center rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-sm">
                <i data-lucide="plus" class="h-5 w-5 text-white-400 me-1"></i>Create New
            </a>
        </div>
        {{-- Search & Filter --}}
        @include('admin-page.users.partials.filter')

        {{-- Table --}}
        @include('admin-page.users.partials.table')
    </div>
@endsection

@push('scripts')
    <script>
        function clearSearch() {
            const input = document.getElementById('search-input');
            if (!input) return;

            input.value = '';
            const form = input.closest('form');
            if (form) form.submit();
        }
    </script>
@endpush
