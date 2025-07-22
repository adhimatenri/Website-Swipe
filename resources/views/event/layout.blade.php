<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swipe - Hentakan Hijrah')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <header class="bg-white">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="font-bold text-2xl">
                <img src="https://i.imgur.com/J3d2h4C.png" alt="Swipe Logo" class="h-10">
            </div>
            <nav class="space-x-8 text-gray-600">
                <a href="#" class="hover:text-gray-900">Beranda</a>
                <a href="#" class="hover:text-gray-900">Tentang Kami</a>
                <a href="#" class="hover:text-gray-900">Kontak</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    <footer class="bg-white mt-12 border-t">
        <div class="container mx-auto px-6 py-8 text-center text-gray-600">
            <div class="flex justify-center space-x-8 mb-6">
                <a href="#" class="hover:text-gray-900">Beranda</a>
                <a href="#" class="hover:text-gray-900">Tentang Kami</a>
                <a href="#" class="hover:text-gray-900">Kontak</a>
            </div>
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="text-gray-500 hover:text-gray-800"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-gray-500 hover:text-gray-800"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#" class="text-gray-500 hover:text-gray-800"><i class="fab fa-twitter fa-lg"></i></a>
            </div>
            <p class="text-sm">&copy;2025 Swipe - Hentakan Hijrah. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
