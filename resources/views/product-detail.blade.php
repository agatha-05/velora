<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
    @livewireStyles
</head>
<body class="bg-gray-50" x-data="{ 
    selectedColor: '{{ $product->variants->first()->color ?? '' }}',
    selectedSize: '',
    qty: 1,
    currentImage: '{{ $product->getThumbnailUrl() }}',
    currentPrice: {{ $product->price }},
    currentStock: {{ $product->variants->first()->stock ?? 0 }},
    variants: {{ $product->variants->toJson() }}
}">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-extrabold text-amber-600 tracking-tighter">VELORA</a>
                <span class="mx-3 text-gray-200">|</span>
                <span class="text-gray-500 text-sm hidden md:block">{{ $product->name }}</span>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="/" class="text-sm font-medium text-gray-600 hover:text-amber-600">Home</a>
                <div class="relative p-2 bg-gray-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                    </svg>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-500 hover:text-amber-600 transition group">
                <div class="bg-white p-2 rounded-full shadow-sm mr-3 group-hover:bg-amber-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span class="font-medium">Kembali ke Katalog</span>
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-10 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="md:w-1/2">
                <div class="sticky top-24">
                    <div class="aspect-square rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 shadow-inner">
                        <img :src="currentImage" class="w-full h-full object-cover transition duration-700 transform hover:scale-105">
                    </div>
                    <div class="flex gap-3 mt-6 overflow-x-auto pb-2 custom-scrollbar">
                        @foreach($product->variants->unique('color') as $v)
                        <button @click="currentImage = '{{ Storage::url($v->image) }}'; selectedColor = '{{ $v->color }}'; selectedSize = ''; qty = 1" 
                                class="relative w-20 h-20 rounded-xl border-2 overflow-hidden transition-all flex-shrink-0"
                                :class="selectedColor === '{{ $v->color }}' ? 'border-amber-500 ring-4 ring-amber-100' : 'border-gray-100'">
                            <img src="{{ Storage::url($v->image) }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 flex flex-col">
                <nav class="flex mb-2">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-amber-600">{{ $product->category->name }}</span>
                </nav>
                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>
                
                <div class="flex items-center mt-4 gap-4">
                    <div class="text-3xl font-black text-amber-600">
                        Rp<span x-text="currentPrice.toLocaleString('id-ID')"></span>
                    </div>
                </div>

                <div class="h-px bg-gray-100 my-6"></div>

                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Pilih Warna</h3>
                    <div class="flex flex-wrap gap-3 mt-3">
                        @foreach($product->variants->unique('color') as $v)
                        <button @click="selectedColor = '{{ $v->color }}'; currentImage = '{{ Storage::url($v->image) }}'; selectedSize = ''; qty = 1"
                                class="px-4 py-2 border rounded-xl transition-all text-sm font-bold flex items-center gap-2"
                                :class="selectedColor === '{{ $v->color }}' ? 'border-amber-600 bg-amber-50 text-amber-600' : 'border-gray-200 text-gray-600'">
                            <span x-text="'{{ $v->color }}'"></span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest">Pilih Ukuran</h3>
                    <div class="flex flex-wrap gap-2 mt-3">
                        <template x-for="v in variants.filter(v => v.color === selectedColor)">
                            <div class="flex flex-wrap gap-2">
                                <template x-for="s in v.size">
                                    <button @click="selectedSize = s; currentStock = v.stock; qty = 1"
                                            class="w-12 h-10 border rounded-lg text-xs font-bold transition-all"
                                            :class="selectedSize === s ? 'bg-amber-600 border-amber-600 text-white shadow-md' : 'bg-white border-gray-200 text-gray-700 hover:border-amber-400'"
                                            x-text="s">
                                    </button>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-8 bg-gray-50 p-5 rounded-2xl border border-gray-100">
                    <h3 class="font-bold text-gray-900 text-sm border-b border-gray-200 pb-2 mb-3">Informasi Produk</h3>
                    <div class="text-gray-600 leading-relaxed text-sm">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-400 uppercase">Jumlah</span>
                        <span class="text-xs text-gray-500">Stok: <b class="text-amber-600" x-text="currentStock"></b> unit</span>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex items-center border-2 border-gray-100 rounded-xl overflow-hidden">
                            <button @click="if(qty > 1) qty--" class="px-4 py-2 bg-gray-50 font-bold">-</button>
                            <input type="number" x-model="qty" readonly class="w-10 text-center font-bold border-none focus:ring-0">
                            <button @click="if(qty < currentStock) qty++" class="px-4 py-2 bg-gray-50 font-bold">+</button>
                        </div>
                        <button class="flex-1 bg-amber-600 text-white font-bold rounded-xl shadow-lg shadow-amber-100 hover:bg-amber-700 transition-all flex flex-col items-center justify-center py-2 disabled:opacity-50"
                                :disabled="!selectedSize || currentStock == 0">
                            <span class="text-sm">BELI SEKARANG</span>
                            <span class="text-[10px] opacity-80" x-show="selectedSize">Total: Rp<span x-text="(currentPrice * qty).toLocaleString('id-ID')"></span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="{{ route('product.detail', $related->slug) }}" class="group">
                    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img src="{{ $related->getThumbnailUrl() }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="text-sm font-bold text-gray-800 truncate">{{ $related->name }}</h3>
                            <p class="text-amber-600 font-bold mt-1 text-sm">Rp{{ number_format($related->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-10 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-xl font-black text-amber-600">VELORA</h2>
            <p class="text-gray-400 text-xs mt-2">&copy; 2026 Velora Accessories. Premium Fashion.</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>