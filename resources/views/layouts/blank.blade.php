<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Pembayaran - Love-15 Tennis</title>
    
    <!-- Load CSS/JS Laravel (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-10">
        <!-- Logo / Judul -->
        <div class="mt-8 mb-4 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Love-15 Tennis Center</h1>
            <p class="text-gray-500 mt-1">Selesaikan pembayaran Anda</p>
        </div>

        <!-- Area Konten Utama -->
        <div class="w-full sm:max-w-2xl mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @yield('content')
        </div>
    </div>

</body>
</html>