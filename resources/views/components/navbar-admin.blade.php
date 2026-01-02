<nav class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('homepage') }}" class="flex items-center">
                    <img src="{{ asset('images/logo-mipa.png') }}" alt="Logo MIPA" class="h-10 w-auto">
                </a>
                @auth
                    @php
                        $roleMeta = auth()->user()->userRole();
                    @endphp
                    <div class="hidden sm:flex items-center ml-3 space-x-2 text-sm text-gray-600">
                        <div class="leading-tight">
                            <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="text-xs {{ $roleMeta['text'] ?? 'text-gray-500' }}">
                                {{ $roleMeta['label'] ?? 'User' }}
                            </div>
                        </div>

                    </div>

                @endauth
            </div>

            <!-- Navigation Links -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                    Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                    User
                </a>
                <a href="{{ route('study-programs.index') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                    Program Studi
                </a>
                <a href="{{ route('achievements.upload') }}"
                    class="flex items-center bg-white text-black px-6 py-2 rounded-[10px] transition shadow-md border-gray-300 hover:bg-gray-100 text-sm md:text-xs lg:text-sm">
                    <i data-lucide="upload" class="h-4 w-4 text-gray-400 me-2"></i> Upload Excel
                </a>
                <a href="{{ route('achievements.create') }}"
                    class="flex items-center bg-black text-white px-6 py-2 rounded-[10px] hover:bg-gray-800 transition text-sm md:text-xs lg:text-sm">
                    <i data-lucide="plus" class="h-5 w-5 text-gray-400 me-2"></i>Input Data Prestasi
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center bg-grey-100 text-dark px-6 py-2 rounded-[10px] hover:bg-gray-100 transition text-sm md:text-xs lg:text-sm">
                            <i data-lucide="log-out" class="h-5 w-5 text-gray-400 me-2"></i>
                        </button>
                    </form>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden pb-4">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="{{ route('users.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">User</a>
            <a href="{{ route('study-programs.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Program
                Studi</a>
            <a href="{{ route('achievements.upload') }}" class="block py-2 text-gray-700 hover:text-blue-600">Upload
                Excel</a>
            <a href="{{ route('achievements.create') }}" class="block py-2 text-gray-700 hover:text-blue-600">Input
                Data Prestasi</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center bg-grey-100 text-dark py-2 rounded-[10px] hover:bg-gray-100 transition">
                            <i data-lucide="log-out" class="h-5 w-5 text-gray-400 me-2"></i> Logout
                        </button>
                    </form>
                @endauth
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
