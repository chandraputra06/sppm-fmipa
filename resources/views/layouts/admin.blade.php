<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-mipa.png') }}">
    <title>@yield('title', 'Fakultas MIPA')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Navbar Component -->
    <x-navbar-admin />
    <x-alert-error />
    <x-alert-success />

    <!-- Main Content -->
    <main>
        <div class="container max-w-5xl mx-auto px-6 px-lg-1 py-10 mt-16">
            @yield('content')
        </div>
    </main>

    <!-- Footer Component -->

    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>

</html>
