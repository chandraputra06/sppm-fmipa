@extends('layouts.admin')

@section('content')
    <div class="rounded-xl border border-gray-200 bg-white p-6 mt-10">
        <div>
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">
                    Users Management
                </h1>
                <a href="{{ route('users.create') }}"
                    class="flex items-center rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    <i data-lucide="plus" class="h-5 w-5 text-white-400 me-2"></i>Create New User
                </a>
            </div>
            {{-- Search & Filter --}}
            @include('admin-page.users.partials.filter')

            {{-- Table --}}
            @include('admin-page.users.partials.table')
        </div>
    @endsection
