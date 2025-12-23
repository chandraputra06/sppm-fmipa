@extends('layouts.app')

@section('title', 'Beranda - Fakultas MIPA')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative container mx-auto px-4 h-full flex flex-col justify-center items-center text-white text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
            Selamat Datang Sistem Pendataan Prestasi Mahasiswa<br>
            Fakultas Matematika dan Ilmu Pengetahuan Alam
        </h1>
        <a href="#" class="bg-white text-gray-800 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
            Lihat Daftar Prestasi
        </a>
    </div>
</section>

<!-- Content Cards Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <!-- Image Placeholder -->
                <div class="h-48 bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Image Placeholder</span>
                </div>
                
                <!-- Content -->
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Judul Lomba Yang Dimenangkan Mahasiswa</h3>
                    <p class="text-sm text-gray-500 mb-4">Tanggal : 20 November 2025</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis non convalis. Tempus leo eu aenean sed diam eros. Consequat semper viverra nam libero justo laoreet. Erat velit scelerisque in dictum non consectetur a erat. Nunc sed id semper risus in hendrerit gravida rutrum quisque. Dictum non consectetur a erat nam at lectus urna. Lacus vestibulum sed arcu non odio euismod. Scelerisque viverra mauris in aliquam sem fringibus ut morbi. Aliquam id diam maecenas ultricies mi eget mauris. Id cursus metus aliquam eleifend mi in nulla posuere.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Image Placeholder</span>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Judul Lomba Yang Dimenangkan Mahasiswa</h3>
                    <p class="text-sm text-gray-500 mb-4">Tanggal : 20 November 2025</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis non convalis. Tempus leo eu aenean sed diam eros. Consequat semper viverra nam libero justo laoreet. Erat velit scelerisque in dictum non consectetur a erat. Nunc sed id semper risus in hendrerit gravida rutrum quisque. Dictum non consectetur a erat nam at lectus urna. Lacus vestibulum sed arcu non odio euismod. Scelerisque viverra mauris in aliquam sem fringibus ut morbi. Aliquam id diam maecenas ultricies mi eget mauris. Id cursus metus aliquam eleifend mi in nulla posuere.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                <div class="h-48 bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-500">Image Placeholder</span>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Judul Lomba Yang Dimenangkan Mahasiswa</h3>
                    <p class="text-sm text-gray-500 mb-4">Tanggal : 20 November 2025</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis non convalis. Tempus leo eu aenean sed diam eros. Consequat semper viverra nam libero justo laoreet. Erat velit scelerisque in dictum non consectetur a erat. Nunc sed id semper risus in hendrerit gravida rutrum quisque. Dictum non consectetur a erat nam at lectus urna. Lacus vestibulum sed arcu non odio euismod. Scelerisque viverra mauris in aliquam sem fringibus ut morbi. Aliquam id diam maecenas ultricies mi eget mauris. Id cursus metus aliquam eleifend mi in nulla posuere.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection