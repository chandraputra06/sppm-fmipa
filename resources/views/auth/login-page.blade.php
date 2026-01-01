@extends('layouts._blank')

@section('title', 'Login Page - Fakultas MIPA')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <a href="#" class="flex items-center justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo MIPA" class="h-10 w-auto">
            </a>
            <h2 class="text-2xl font-bold mb-6 text-center">Masuk ke Akun Anda</h2>
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Masuk</button>
            </form>
        </div>
    </div>
@endsection
