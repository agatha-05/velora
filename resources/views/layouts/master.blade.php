<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velora Accessories - Premium Fashion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }
        /* Animasi agar ikon hati berdetak */
        @keyframes heartbeat {
            0% { transform: scale(1); }
            15% { transform: scale(1.3); }
            30% { transform: scale(1); }
            100% { transform: scale(1); }
        }
        .animate-heart { animation: heartbeat 0.6s ease-in-out; }
        
        /* Gaya untuk Toast Notification */
        #toast-container { pointer-events: none; }
        .toast-item { pointer-events: auto; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-50">

    <div id="toast-container" class="fixed top-24 right-5 z-[9999] flex flex-col gap-3"></div>

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

            <div class="flex items-center gap-4">
                <a href="{{ route('wishlist') }}" class="relative p-2 bg-gray-100 rounded-full hover:bg-red-50 hover:text-red-500 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" id="nav-heart-icon" class="h-6 w-6 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span id="nav-wishlist-count" class="absolute -top-1 -right-1 bg-amber-600 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full opacity-0 scale-0 transition-all">0</span>
                </a>

                <a href="{{ route('cart') }}" class="relative p-2 bg-gray-100 rounded-full hover:bg-amber-100 hover:text-amber-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                    </svg>   
                    <span id="nav-cart-count" class="absolute -top-1 -right-1 bg-amber-600 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full opacity-0 scale-0 transition-all">0</span>
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
            <p><b>untuk menjelajahi koleksi terbaru kami ↓</b></p>
        </div>
    </header>

    <main id="koleksi">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-400">
            <h2 class="text-2xl font-bold text-amber-500 mb-4">VELORA</h2>
            <p>&copy; 2026 Velora Accessories. All rights reserved.</p>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-4 text-center text-gray-400">
            <p class="text-sm">Jl. Fashion No.123, Banjarmasin, Indonesia | Email:
                <span class="text-amber-500 hover:underline">
                    <script>document.write('info' + '@' + 'velora-accessories.com');</script>
                </span>
                | Tel: <a href="tel:+6281234567890" class="hover:underline">+62 812-3456-7890</a>
            </p>
        </div>
    </footer>

    @livewireScripts
    <script>
    // --- FUNGSI TOAST NOTIFICATION ---
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const colorClass = type === 'success' ? 'bg-amber-600' : 'bg-gray-800';
        
        toast.className = `toast-item ${colorClass} text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 transform translate-x-12 opacity-0`;
        toast.innerHTML = `
            <span class="text-sm font-bold tracking-wide">${message}</span>
            <button onclick="this.parentElement.remove()" class="text-white/50 hover:text-white">&times;</button>
        `;
        
        container.appendChild(toast);
        
        // Trigger animasi masuk
        setTimeout(() => {
            toast.classList.remove('translate-x-12', 'opacity-0');
        }, 10);

        // Hapus otomatis setelah 3 detik
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-[-10px]');
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    // --- FUNGSI WISHLIST ---
    function toggleWishlist(id, name, image, price, slug) {
        let wishlist = JSON.parse(localStorage.getItem('velora_wishlist')) || [];
        let index = wishlist.findIndex(item => item.id === id);

        if (index === -1) {
            wishlist.push({ id, name, image, price, slug });
            showToast(`❤️ ${name} masuk Wishlist!`);
        } else {
            wishlist.splice(index, 1);
            showToast(`💔 ${name} dihapus dari Wishlist`, 'info');
        }

        localStorage.setItem('velora_wishlist', JSON.stringify(wishlist));
        updateHeartIcons();
    }

    // --- FUNGSI KERANJANG (CART) ---
    function addToCart(id, name, image, price, slug) {
        let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
        let index = cart.findIndex(item => item.id === id);

        if (index === -1) {
            cart.push({ id, name, image, price, slug, quantity: 1 });
        } else {
            cart[index].quantity += 1;
        }

        localStorage.setItem('velora_cart', JSON.stringify(cart));
        updateCartUI();
        showToast(`🛒 ${name} ditambah ke Keranjang!`);
    }

    // --- UPDATE UI SISTEM ---
    function updateCartUI() {
        let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
        const badge = document.getElementById('nav-cart-count');
        let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

        if (badge) {
            if (totalItems > 0) {
                badge.innerText = totalItems;
                badge.classList.remove('opacity-0', 'scale-0');
                badge.classList.add('opacity-100', 'scale-100');
            } else {
                badge.classList.add('opacity-0', 'scale-0');
            }
        }
    }

    function updateHeartIcons() {
        let wishlist = JSON.parse(localStorage.getItem('velora_wishlist')) || [];
        const badge = document.getElementById('nav-wishlist-count');
        const navHeart = document.getElementById('nav-heart-icon');
        
        if (badge) {
            if (wishlist.length > 0) {
                badge.innerText = wishlist.length;
                badge.classList.remove('opacity-0', 'scale-0');
                badge.classList.add('opacity-100', 'scale-100');
                navHeart.classList.add('text-red-500', 'animate-heart');
                navHeart.setAttribute('fill', 'currentColor');
            } else {
                badge.classList.add('opacity-0', 'scale-0');
                navHeart.classList.remove('text-red-500', 'animate-heart');
                navHeart.setAttribute('fill', 'none');
            }
        }

        document.querySelectorAll('[id^="heart-icon-"]').forEach(icon => {
            const id = icon.id.replace('heart-icon-', '');
            if (wishlist.some(item => item.id == id)) {
                icon.classList.add('text-red-500');
                icon.setAttribute('fill', 'currentColor');
            } else {
                icon.classList.remove('text-red-500');
                icon.setAttribute('fill', 'none');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateHeartIcons();
        updateCartUI();
    });
    window.addEventListener('storage', () => {
        updateHeartIcons();
        updateCartUI();
    });
    </script>
</body>
</html>