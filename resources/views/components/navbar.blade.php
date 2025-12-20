<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo MIPA" class="h-10 w-auto">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-600 transition">
                    Beranda
                </a>
                <a href="{{ route('prestasi.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                    Daftar Prestasi
                </a>
                <a href="#" class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">
                    Masuk
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Daftar Prestasi</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Masuk</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@endpush