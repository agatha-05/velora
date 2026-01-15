<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d97706; border-radius: 10px; }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-50" x-data="productDetail()" x-init="updateCartCount()">

    <div x-show="$store.toast.show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-8"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-8"
         class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] w-[90%] max-w-sm" x-cloak>
        <div class="bg-gray-900/95 backdrop-blur-md text-white px-6 py-4 rounded-2xl shadow-2xl border border-white/10 flex items-center gap-4">
            <div class="bg-amber-500 p-2 rounded-full shadow-lg shadow-amber-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="flex flex-col">
                <p class="text-sm font-bold tracking-wide" x-text="$store.toast.message"></p>
                <p class="text-[10px] text-gray-400 uppercase tracking-tighter">Berhasil diperbarui</p>
            </div>
        </div>
    </div>

    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-black text-amber-600 tracking-tighter italic">VELORA</a>
                <span class="mx-3 text-gray-200">|</span>
                <span class="text-gray-400 text-xs font-bold uppercase tracking-widest hidden md:block">{{ $product->name }}</span>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="/" class="text-xs font-bold uppercase tracking-widest text-gray-600 hover:text-amber-600 transition">Home</a>
                <a href="/cart" class="relative group">
                    <div class="p-2 bg-gray-50 rounded-full group-hover:bg-amber-50 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 group-hover:text-amber-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                        </svg>
                    </div>
                    <template x-if="cartCount > 0">
                        <span x-text="cartCount" class="absolute -top-1 -right-1 bg-amber-600 text-white text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-white animate-bounce"></span>
                    </template>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-amber-600 transition group">
                <div class="bg-white p-2 rounded-full shadow-sm mr-4 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span class="font-bold text-xs uppercase tracking-widest text-gray-500">Katalog Produk</span>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 bg-white p-6 md:p-12 rounded-[48px] shadow-2xl shadow-gray-200/50 border border-gray-100">
            <div class="lg:w-1/2">
                <div class="sticky top-28">
                    <div class="aspect-square rounded-[40px] overflow-hidden bg-gray-50 border border-gray-100 relative group">
                        <img :src="currentImage" class="w-full h-full object-cover transition duration-1000 transform group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="flex gap-4 mt-8 overflow-x-auto pb-4 custom-scrollbar">
                        @foreach($product->variants->unique('color') as $v)
                        <button @click="currentImage = '{{ Storage::url($v->image) }}'; selectedColor = '{{ $v->color }}'; selectedSize = ''; qty = 1" 
                                class="relative w-24 h-24 rounded-3xl border-2 overflow-hidden transition-all flex-shrink-0"
                                :class="selectedColor === '{{ $v->color }}' ? 'border-amber-500 ring-8 ring-amber-50' : 'border-gray-50 hover:border-amber-200'">
                            <img src="{{ Storage::url($v->image) }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 flex flex-col justify-center">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-amber-600 mb-4 px-3 py-1 bg-amber-50 rounded-full w-fit">
                    {{ $product->category->name }}
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-none tracking-tighter mb-6">
                    {{ $product->name }}
                </h1>
                
                <div class="text-4xl font-black text-gray-900 mb-8">
                    <span class="text-amber-600 text-2xl mr-1">Rp</span><span x-text="currentPrice.toLocaleString('id-ID')"></span>
                </div>

                <div class="space-y-8">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Pilih Warna</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->variants->unique('color') as $v)
                            <button @click="selectedColor = '{{ $v->color }}'; currentImage = '{{ Storage::url($v->image) }}'; selectedSize = ''; qty = 1"
                                    class="px-6 py-3 border-2 rounded-2xl transition-all text-sm font-bold"
                                    :class="selectedColor === '{{ $v->color }}' ? 'border-amber-600 bg-amber-600 text-white shadow-xl shadow-amber-200' : 'border-gray-100 text-gray-500 hover:border-amber-600'">
                                {{ $v->color }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Pilih Ukuran</h3>
                        <div class="flex flex-wrap gap-3">
                            <template x-for="v in variants.filter(v => v.color === selectedColor)">
                                <div class="flex flex-wrap gap-3">
                                    <template x-for="s in v.size">
                                        <button @click="selectedSize = s; currentStock = v.stock; qty = 1"
                                                class="w-14 h-14 border-2 rounded-2xl text-sm font-black transition-all flex items-center justify-center"
                                                :class="selectedSize === s ? 'bg-gray-900 border-gray-900 text-white shadow-xl' : 'bg-white border-gray-100 text-gray-800 hover:border-amber-600'"
                                                x-text="s">
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-[32px] border border-gray-100">
                        <h3 class="font-black text-gray-900 text-xs uppercase tracking-widest mb-4">Detail Produk</h3>
                        <div class="text-gray-500 leading-relaxed text-sm">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Atur Jumlah</span>
                            <span class="text-xs font-bold text-gray-500">Stok: <b class="text-amber-600" x-text="currentStock"></b></span>
                        </div>
                        <div class="flex flex-wrap md:flex-nowrap gap-4">
                            <div class="flex items-center bg-gray-100 rounded-3xl p-1">
                                <button @click="if(qty > 1) qty--" class="w-12 h-12 flex items-center justify-center font-bold text-xl hover:bg-white rounded-2xl transition">-</button>
                                <input type="number" x-model="qty" readonly class="w-12 text-center font-black bg-transparent border-none focus:ring-0">
                                <button @click="if(qty < currentStock) qty++" class="w-12 h-12 flex items-center justify-center font-bold text-xl hover:bg-white rounded-2xl transition text-amber-600">+</button>
                            </div>

                            <button @click="addToCart()" 
                                    class="p-4 bg-amber-50 text-amber-600 rounded-3xl hover:bg-amber-600 hover:text-white transition-all duration-300 group"
                                    :disabled="!selectedSize || currentStock == 0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-125 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                                </svg>
                            </button>

                            <button @click="buyNow()"
                                    class="flex-1 bg-gray-900 text-white font-black rounded-3xl shadow-2xl shadow-gray-400 hover:bg-amber-600 transition-all flex flex-col items-center justify-center py-4 disabled:opacity-50"
                                    :disabled="!selectedSize || currentStock == 0">
                                <span class="text-xs tracking-[0.2em] mb-1">BELI SEKARANG</span>
                                <span class="text-[10px] font-medium opacity-50" x-show="selectedSize">Rp<span x-text="(currentPrice * qty).toLocaleString('id-ID')"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-24">
            <div class="flex items-end gap-4 mb-10">
                <h2 class="text-3xl font-black tracking-tighter">Mungkin Kamu Suka</h2>
                <div class="h-1 flex-1 bg-gray-100 rounded-full mb-3"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div class="group relative bg-white rounded-[40px] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <a href="{{ route('product.detail', $related->slug) }}" class="block">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img src="{{ $related->getThumbnailUrl() }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        </div>
                        <div class="p-6">
                            <h3 class="text-sm font-bold text-gray-800 truncate mb-1">{{ $related->name }}</h3>
                            <p class="text-amber-600 font-black text-lg">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                    
                    <button @click="addToCartDirect({
                                id: '{{ $related->id }}-default',
                                name: '{{ $related->name }}',
                                price: {{ $related->price }},
                                image: '{{ $related->getThumbnailUrl() }}',
                                variant_info: 'Original'
                            })" 
                            class="absolute top-4 right-4 bg-white/95 backdrop-blur-md p-3 rounded-2xl shadow-xl opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-amber-600 hover:text-white text-gray-900 border border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-16 mt-32">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-black text-amber-600 italic tracking-tighter mb-4">VELORA</h2>
            <div class="flex justify-center gap-8 mb-8">
                <a href="#" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 transition">Instagram</a>
                <a href="#" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 transition">Tiktok</a>
                <a href="#" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-gray-900 transition">WhatsApp</a>
            </div>
            <p class="text-gray-400 text-[10px] font-medium tracking-widest uppercase">&copy; 2026 Velora Accessories. Crafted with passion.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('toast', {
                show: false,
                message: '',
                trigger(msg) {
                    this.message = msg;
                    this.show = true;
                    setTimeout(() => this.show = false, 3000);
                }
            });
        });

        function productDetail() {
            return {
                selectedColor: '{{ $product->variants->first()->color ?? '' }}',
                selectedSize: '',
                qty: 1,
                currentImage: '{{ $product->getThumbnailUrl() }}',
                currentPrice: {{ $product->price }},
                currentStock: {{ $product->variants->first()->stock ?? 0 }},
                variants: {!! $product->variants->toJson() !!},
                cartCount: 0,

                updateCartCount() {
                    let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
                    this.cartCount = cart.length;
                },

                saveToStorage() {
                    let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
                    const itemId = `{{ $product->id }}-${this.selectedColor}-${this.selectedSize}`;
                    const existingIndex = cart.findIndex(i => i.id === itemId);

                    if (existingIndex > -1) {
                        cart[existingIndex].quantity += this.qty;
                    } else {
                        cart.push({
                            id: itemId,
                            name: '{{ $product->name }}',
                            variant_info: `${this.selectedColor} | ${this.selectedSize}`,
                            price: this.currentPrice,
                            image: this.currentImage,
                            quantity: this.qty
                        });
                    }

                    localStorage.setItem('velora_cart', JSON.stringify(cart));
                    this.updateCartCount();
                },

                addToCart() {
                    if (!this.selectedSize) {
                        Alpine.store('toast').trigger('Silakan pilih ukuran dulu! ⚠️');
                        return;
                    }
                    this.saveToStorage();
                    Alpine.store('toast').trigger('Dimasukkan ke keranjang! 🛍️');
                },

                buyNow() {
                    if (!this.selectedSize) {
                        Alpine.store('toast').trigger('Pilih ukuran dulu! ⚠️');
                        return;
                    }
                    // Simpan data ke cart terlebih dahulu
                    this.saveToStorage();
                    // Redirect ke halaman checkout
                    window.location.href = "{{ route('checkout') }}";
                },

                addToCartDirect(item) {
                    let cart = JSON.parse(localStorage.getItem('velora_cart')) || [];
                    const existingIndex = cart.findIndex(i => i.id === item.id);

                    if (existingIndex > -1) {
                        cart[existingIndex].quantity += 1;
                    } else {
                        cart.push({
                            id: item.id,
                            name: item.name,
                            variant_info: item.variant_info,
                            price: item.price,
                            image: item.image,
                            quantity: 1
                        });
                    }

                    localStorage.setItem('velora_cart', JSON.stringify(cart));
                    this.updateCartCount();
                    Alpine.store('toast').trigger('Produk ditambahkan! 🛒');
                }
            }
        }
    </script>

    @livewireScripts
</body>
</html>