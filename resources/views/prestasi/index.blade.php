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
        <!-- Search Bar -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" 
                       placeholder="Cari nama mahasiswa atau NIM..." 
                       class="w-full outline-none text-gray-700"
                       id="searchInput">
            </div>
        </div>

        <!-- Filters -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Filter Prodi -->
            <div>
                <select class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Prodi</option>
                    <option value="matematika">Matematika</option>
                    <option value="fisika">Fisika</option>
                    <option value="kimia">Kimia</option>
                    <option value="biologi">Biologi</option>
                    <option value="farmasi">Farmasi</option>
                    <option value="informatika">Informatika</option>
                </select>
            </div>

            <!-- Filter Tingkat -->
            <div>
                <select class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tingkat</option>
                    <option value="internasional">Internasional</option>
                    <option value="nasional">Nasional</option>
                    <option value="provinsi">Provinsi</option>
                    <option value="universitas">Universitas</option>
                </select>
            </div>

            <!-- Filter Tahun -->
            <div>
                <select class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tahun</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>
        </div>

        <!-- Results Info -->
        <div class="flex items-center text-gray-600 mb-6">
            <span>Tampilkan</span>
            <select class="mx-2 border border-gray-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span>Mahasiswa</span>
        </div>
    </div>
</section>

<!-- Student List Section -->
<section class="bg-gray-50 pb-16">
    <div class="container mx-auto px-4">
        <div class="space-y-4">
            <!-- Student Card 1 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Avatar -->
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff&size=64" 
                             alt="Budi Santoso" 
                             class="w-16 h-16 rounded-full">
                        
                        <!-- Info -->
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Budi Santoso</h3>
                            <p class="text-sm text-gray-500">NIM: 2021002345</p>
                            <p class="text-sm text-gray-600">Kimia</p>
                        </div>
                    </div>

                    <!-- Stats & Actions -->
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">1</div>
                            <div class="text-xs text-gray-500">Prestasi</div>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('prestasi.show', 1) }}" class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="text-sm">Lihat Profil</span>
                            </a>
                            
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Card 2 --> 
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzan&background=10b981&color=fff&size=64" 
                             alt="Ahmad Fauzan Rahman" 
                             class="w-16 h-16 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Ahmad Fauzan Rahman</h3>
                            <p class="text-sm text-gray-500">NIM: 2021001234</p>
                            <p class="text-sm text-gray-600">Informatika</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">3</div>
                            <div class="text-xs text-gray-500">Prestasi</div>
                        </div>
                        {{-- Belum Ubah Button jadi a --}}
                        <div class="flex space-x-2">
                            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="text-sm">Lihat Profil</span>
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Card 3 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Azizah&background=ec4899&color=fff&size=64" 
                             alt="Siti Nur Azizah" 
                             class="w-16 h-16 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Siti Nur Azizah</h3>
                            <p class="text-sm text-gray-500">NIM: 2021001567</p>
                            <p class="text-sm text-gray-600">Farmasi</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">2</div>
                            <div class="text-xs text-gray-500">Prestasi</div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="text-sm">Lihat Profil</span>
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Card 4 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Siti+Azizah&background=8b5cf6&color=fff&size=64" 
                             alt="Siti Nur Azizah" 
                             class="w-16 h-16 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Siti Nur Azizah</h3>
                            <p class="text-sm text-gray-500">NIM: 2021001567</p>
                            <p class="text-sm text-gray-600">Matematika</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">4</div>
                            <div class="text-xs text-gray-500">Prestasi</div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="text-sm">Lihat Profil</span>
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Card 5 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=Rizky+Prasetyo&background=f59e0b&color=fff&size=64" 
                             alt="Rizky Prasetyo" 
                             class="w-16 h-16 rounded-full">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">Rizky Prasetyo</h3>
                            <p class="text-sm text-gray-500">NIM: 2021004567</p>
                            <p class="text-sm text-gray-600">Biologi</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">2</div>
                            <div class="text-xs text-gray-500">Prestasi</div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="text-sm">Lihat Profil</span>
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-8">
            <button class="p-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            <button class="px-4 py-2 bg-gray-800 text-white rounded-lg">1</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">2</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">3</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">4</button>
            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">5</button>
            
            <button class="p-2 rounded-lg border border-gray-300 hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</section>
@endsection