<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('homepage') }}" class="flex items-center">
                    <img src="{{ asset('build/assets/images/logo.png') }}" alt="Logo MIPA" class="h-10 w-auto">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">
                    Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                    User
                </a>
                <a href="{{ route('study-programs.index') }}" class="text-gray-700 hover:text-blue-600 transition">
                    Program Studi
                </a>
                <a href="{{ route('achievements.upload') }}" class="flex items-center bg-white text-black px-6 py-2 rounded-[10px] transition shadow-md border-gray-300 hover:bg-gray-100">
                    <i data-lucide="upload" class="h-4 w-4 text-gray-400 me-2"></i> Upload Excel
                </a>
                <a href="{{ route('achievements.create') }}" class="flex items-center bg-black text-white px-6 py-2 rounded-[10px] hover:bg-gray-800 transition">
                   <i data-lucide="plus" class="h-5 w-5 text-gray-400 me-2"></i>Input Data Prestasi
                </a>
                {{-- <a href="#" class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">
                    Prestasi
                </a> --}}
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
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Upload Excel</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">User Management</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Prestasi</a>
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
