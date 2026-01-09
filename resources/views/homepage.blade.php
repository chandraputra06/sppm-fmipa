@extends('layouts.app')

@section('title', 'Beranda - Fakultas MIPA')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/infor-24.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative container mx-auto px-4 h-full flex flex-col justify-center items-center text-white text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                Selamat Datang Sistem Pendataan Prestasi Mahasiswa<br>
                Fakultas Matematika dan Ilmu Pengetahuan Alam
            </h1>
            <a href="{{ route('prestasi.index') }}"
                class="bg-white text-gray-800 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Lihat Daftar Prestasi
            </a>
        </div>
    </section>

    <!-- Content Cards Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($achievements as $item)
                    <a href="{{ $item->student_id ? route('prestasi.show', $item->student_id) : route('prestasi.index') }}">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                            <!-- Image Placeholder -->
                            <div class="h-48 bg-gray-300 flex items-center justify-center">
                                @if ($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-gray-500">Image Placeholder</span>
                                @endif

                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $item->title }}</h3>
                                <div class="flex text-center justify-between">
                                    <p class="text-sm text-gray-500 mb-4">{{ $item->students->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-500 mb-4">Tanggal : {{ $item->date->format('d F Y') }}</p>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ $item->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Tidak ada prestasi yang dipublikasikan.</p>
                @endforelse

            </div>
        </div>
    </section>
@endsection
