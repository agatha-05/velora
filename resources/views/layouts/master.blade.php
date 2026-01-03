<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velora Accessories - Premium Fashion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    @livewireStyles
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex flex-wrap justify-between items-center gap-4">
            <h1 class="text-3xl font-extrabold text-amber-600 tracking-tighter">VELORA</h1>

            <div class="flex-1 max-w-md mx-4">
                @if(request('search'))
                    <div class="mb-8">
                        <h3 class="text-xl text-gray-600">
                            Hasil pencarian untuk: <span class="font-bold text-amber-600">"{{ request('search') }}"</span>
                        </h3>
                        <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-amber-600 underline">Bersihkan pencarian</a>
                    </div>
                    @endif
                <div class="flex-1 max-w-md mx-4">
                    @livewire('product-search')
                </div>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-gray-700 font-medium">
                <a href="/" class="hover:text-amber-600 transition">Home</a>
                <a href="#" class="hover:text-amber-600 transition">Katalog</a>
                <a href="#" class="hover:text-amber-600 transition">Tentang Kami</a>
                <a href="#" class="hover:text-amber-600 transition">Kontak</a>
            </div>
                <a href="#" class="relative p-2 bg-gray-100 rounded-full hover:bg-amber-100 hover:text-amber-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                    </svg>   
                    <span class="absolute inset-0 rounded-full" aria-hidden="true"></span>
                    <span class="absolute -top-1 -right-1 bg-amber-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">0</span>
                </a>
            </div>
        </div>
    </nav>

    <header class="relative h-[500px] flex items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop" 
             alt="Hero Fashion" 
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-6 w-full text-white">
            <h2 class="text-5xl md:text-6xl font-bold leading-tight mb-4 drop-shadow-lg">
                Aksesoris & <br> <span class="text-amber-400">Fashion Elegan</span>
            </h2>
            <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-lg leading-relaxed">
                Temukan koleksi eksklusif yang dirancang khusus untuk mempertegas karakter penampilanmu.
            </p>
            <div class="flex gap-4">
                <a href="#koleksi" class="bg-amber-600 text-white px-10 py-4 rounded-full font-bold shadow-xl hover:bg-amber-500 hover:scale-105 transition transform duration-300 text-center">
                    Lihat Koleksi
                </a>
            </div>
            <div class="mt-6 text-sm text-gray-300">
                <p>Gratis ongkir untuk pembelian di atas Rp100.000!</p>
            </div>
        </div>
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-gray-300 text-sm">
                <p><Scroll><b>untuk menjelajahi koleksi terbaru kami ↓</b></Scroll></p>
            </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-400">
            <h2 class="text-2xl font-bold text-amber-500 mb-4">VELORA</h2>
            <p>&copy; 2026 Velora Accessories. All rights reserved.</p>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-4 text-center text-gray-400">
            <p class="text-sm">Jl. Fashion No.123, Banjarmasin, Indonesia | Email:
                <a href="mailto:
        <span class="text-amber-500 hover:underline">
            <script>
                document.write('info' + '@' + 'velora-accessories.com');</script>
        </span>
            </a>
            | Tel: <a href="tel:+6281234567890" class="hover:underline">+62 812-3456-7890</a>
            </p>
        <div class="mt-6 text-center">
            <a href="#" class="text-gray-400 hover:text-amber-500 mx-2">Privacy Policy</a> |
            <a href="#" class="text-gray-400 hover:text-amber-500 mx-2">Terms of Service</a> |
            <a href="#" class="text-gray-400 hover:text-amber-500 mx-2">Contact Us</a>
        </div>
    </footer>
    @livewireScripts
</body>
</html>