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
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('homepage') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                    Beranda
                </a>
                <a href="{{ route('prestasi.index') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                    Daftar Prestasi
                </a>
                @auth
                    @if (in_array(auth()->user()->role, ['1', '2']))
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition text-sm md:text-xs lg:text-sm">
                            Admin Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition text-sm md:text-xs lg:text-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800 transition text-sm md:text-xs lg:text-sm">
                        Masuk
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
            <a href="{{ route('homepage') }}" class="block py-2 text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="{{ route('prestasi.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">Daftar
                Prestasi</a>
            @auth
                @if (in_array(auth()->user()->role, ['1', '2']))
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-700 hover:text-blue-600">
                        Admin Dashboard
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 text-gray-700 hover:text-blue-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-blue-600">Masuk</a>
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
