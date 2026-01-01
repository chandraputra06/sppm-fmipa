<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fakultas MIPA')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Navbar Component -->
    <x-navbar-admin />
    <x-alert-error />

    <!-- Main Content -->
    <main>
        <div class="container mx-auto px-4 py-8 mt-16">
            @yield('content')
        </div>
    </main>

    <!-- Footer Component -->

    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>

</html>
