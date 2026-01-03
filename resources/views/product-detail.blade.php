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

    <nav class="bg-white shadow-sm p-4">
        <div class="max-w-7xl mx-auto flex items-center">
            <a href="/" class="text-amber-600 font-bold text-xl">VELORA</a>
            <span class="mx-2 text-gray-300">/</span>
            <span class="text-gray-500 text-sm">{{ $product->name }}</span>
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
                    <img :src="currentImage" class="w-full h-full object-cover transition duration-700 ease-in-out transform hover:scale-105">
                </div>
                
                <div class="flex gap-3 mt-6 overflow-x-auto pb-2 custom-scrollbar">
                    @foreach($product->variants->unique('color') as $v)
                    <button @click="currentImage = '{{ Storage::url($v->image) }}'; selectedColor = '{{ $v->color }}'; selectedSize = ''; qty = 1" 
                            class="relative w-24 h-24 rounded-xl border-2 overflow-hidden transition-all duration-300 flex-shrink-0"
                            :class="selectedColor === '{{ $v->color }}' ? 'border-amber-500 ring-4 ring-amber-100' : 'border-gray-100 hover:border-amber-200'">
                        <img src="{{ Storage::url($v->image) }}" class="w-full h-full object-cover">
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="md:w-1/2 flex flex-col">
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs uppercase tracking-widest font-bold">
                        <li class="text-amber-600">{{ $product->category->name }}</li>
                        <li class="text-gray-300">/</li>
                        <li class="text-gray-400">Detail Produk</li>
                    </ol>
                </nav>

                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $product->name }}</h1>
                
                <div class="flex items-center mt-4 space-x-4">
                    <div class="text-3xl font-black text-amber-600">
                        Rp<span x-text="currentPrice.toLocaleString('id-ID')"></span>
                    </div>
                    @if($product->is_featured)
                    <span class="bg-red-100 text-red-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Terlaris</span>
                    @endif
                </div>

                <div class="h-px bg-gray-100 my-6"></div>

                <div>
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Pilih Warna</h3>
                    <div class="flex flex-wrap gap-3 mt-4">
                        @foreach($product->variants->unique('color') as $v)
                        <button @click="selectedColor = '{{ $v->color }}'; currentImage = '{{ Storage::url($v->image) }}'; selectedSize = ''; qty = 1"
                                class="group px-4 py-3 border rounded-xl transition-all duration-300 flex items-center gap-3 bg-white"
                                :class="selectedColor === '{{ $v->color }}' ? 'border-amber-600 ring-2 ring-amber-500/20' : 'border-gray-200 hover:border-amber-300'">
                            <img src="{{ Storage::url($v->image) }}" class="w-8 h-8 rounded-lg object-cover">
                            <span class="font-semibold text-sm" :class="selectedColor === '{{ $v->color }}' ? 'text-amber-600' : 'text-gray-600'">{{ $v->color }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-7">
                    <div class="flex justify-between items-center">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide">Pilih Ukuran</h3>
                        <a href="#" class="text-xs text-amber-600 underline">Panduan Ukuran</a>
                    </div>
                    <div class="flex flex-wrap gap-3 mt-4">
                        <template x-for="v in variants.filter(v => v.color === selectedColor)">
                            <template x-for="s in v.size">
                                <button @click="selectedSize = s; currentStock = v.stock; qty = 1"
                                        class="px-5 py-2 border rounded-lg text-sm font-medium transition-all duration-300"
                                        :class="selectedSize === s ? 'border-amber-600 bg-amber-600 text-white shadow-lg' : 'border-gray-200 hover:border-amber-300 bg-white text-gray-700'"
                                        x-text="s">
                                </button>
                            </template>
                        </template>
                    </div>
                </div>
                 <div class="mt-8">
                    <h3 class="font-bold text-gray-900 border-b pb-2">Deskripsi Produk</h3>
                    <div class="text-gray-600 mt-4 leading-relaxed text-sm">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-4">Jumlah</h3>
                    <div class="flex items-center gap-5">
                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
                            <button @click="if(qty > 1) qty--" class="px-4 py-2 bg-gray-50 hover:bg-amber-50 text-gray-600 font-bold border-r">-</button>
                            <input type="number" x-model="qty" readonly class="w-12 text-center font-bold text-gray-800 border-none focus:ring-0">
                            <button @click="if(qty < currentStock) qty++" class="px-4 py-2 bg-gray-50 hover:bg-amber-50 text-gray-600 font-bold border-l">+</button>
                        </div>
                        <p class="text-xs text-gray-500 italic">Stok: <span x-text="currentStock"></span> unit tersedia</p>
                    </div>
                </div>


                <div class="mt-8 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <div class="flex items-center gap-3">
                        <button class="flex flex-col items-center justify-center w-16 h-14 bg-white border-2 border-amber-600 text-amber-600 rounded-xl hover:bg-amber-50 transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <span class="text-[9px] font-bold uppercase">Chat</span>
                        </button>
                        
                        <button class="flex-1 h-14 bg-amber-600 text-white flex flex-col items-center justify-center rounded-xl hover:bg-amber-700 shadow-lg transition-all active:scale-95 disabled:opacity-50 disabled:grayscale"
                                :disabled="!selectedSize || currentStock == 0">
                            <span class="font-black text-sm uppercase tracking-wider">Beli Sekarang</span>
                            <span class="text-[11px] font-medium opacity-90">
                                Total: Rp<span x-text="(currentPrice * qty).toLocaleString('id-ID')"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>