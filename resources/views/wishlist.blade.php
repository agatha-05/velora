<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya - Velora Accessories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="/" class="text-2xl font-black text-amber-600 tracking-tighter">VELORA</a>
            
            <div class="flex items-center gap-6 text-sm font-bold text-gray-600">
                <a href="/" class="hover:text-amber-600 transition">Beranda</a>
                <a href="/#katalog" class="hover:text-amber-600 transition">Katalog</a>
                <div class="relative group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001z" />
                    </svg>
                    <span id="wishlist-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12 min-h-screen">
        <div class="mb-12 border-b border-gray-100 pb-8">
            <nav class="flex mb-4 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black">
                <a href="/" class="hover:text-amber-600">Velora</a>
                <span class="mx-2">/</span>
                <span>My Wishlist</span>
            </nav>
            <h1 class="text-3xl md:text-5xl font-black text-gray-900">
                Daftar <span class="text-amber-600">Favorit</span>
            </h1>
            <p class="text-gray-500 mt-3 italic text-sm">Produk-produk pilihan yang Anda simpan untuk nanti.</p>
        </div>

        <div id="wishlist-container" class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            </div>

        <div id="wishlist-empty" class="hidden text-center py-24 bg-white rounded-[40px] border border-dashed border-gray-200">
            <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-black text-gray-900">Belum ada favorit</h3>
            <p class="text-gray-400 mt-2 max-w-sm mx-auto text-sm">Mulai jelajahi katalog kami dan tandai produk yang Anda sukai.</p>
            <a href="/#katalog" class="inline-block mt-8 bg-amber-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-amber-700 transition-all">
                Jelajahi Produk
            </a>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-2xl font-black text-amber-600 tracking-tighter">VELORA</span>
            <p class="text-gray-400 text-[10px] uppercase tracking-widest font-bold mt-4">
                &copy; 2026 Velora Accessories. Premium High-End Fashion.
            </p>
        </div>
    </footer>

    <script>
        function loadWishlist() {
            let wishlist = JSON.parse(localStorage.getItem('velora_wishlist')) || [];
            let container = document.getElementById('wishlist-container');
            let emptyState = document.getElementById('wishlist-empty');
            let countBadge = document.getElementById('wishlist-count');

            // Update badge jumlah
            countBadge.innerText = wishlist.length;

            // Bersihkan container
            container.innerHTML = '';

            if (wishlist.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            } else {
                emptyState.classList.add('hidden');
            }

            wishlist.forEach(item => {
                let card = `
                    <div class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all relative flex flex-col h-full">
                        <a href="/product/${item.slug}" class="block aspect-[4/5] overflow-hidden bg-gray-50">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </a>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-sm font-bold text-gray-800 line-clamp-2 h-10 mb-2">${item.name}</h3>
                            <p class="text-amber-600 font-black text-lg">Rp${parseInt(item.price).toLocaleString('id-ID')}</p>
                            
                            <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between">
                                <a href="/product/${item.slug}" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-amber-600">Detail</a>
                                <button onclick="removeFromWishlist('${item.id}')" class="text-red-500 p-2 hover:bg-red-50 rounded-full transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }

        function removeFromWishlist(id) {
            let wishlist = JSON.parse(localStorage.getItem('velora_wishlist')) || [];
            wishlist = wishlist.filter(item => item.id !== id);
            localStorage.setItem('velora_wishlist', JSON.stringify(wishlist));
            loadWishlist(); // Refresh tampilan tanpa reload halaman
        }

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadWishlist);
    </script>

</body>
</html>