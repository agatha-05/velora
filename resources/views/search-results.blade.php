<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian: {{ $query }} - Velora</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center gap-4 md:justify-between">
            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="/" class="text-2xl font-extrabold text-amber-600 tracking-tighter">VELORA</a>
                <div class="md:hidden">
                    <a href="/" class="text-gray-500 text-sm font-bold">Home</a>
                </div>
            </div>

            <form action="{{ route('search') }}" method="GET" class="relative w-full md:w-1/2 lg:w-1/3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" name="q" value="{{ $query }}"
                        class="w-full py-2.5 pl-12 pr-4 bg-gray-100 border border-gray-100 rounded-full focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 outline-none transition-all text-sm shadow-inner" 
                        placeholder="Cari produk lainnya...">
                </div>
            </form>

            <div class="hidden md:flex items-center gap-6 text-sm font-bold text-gray-600">
                <a href="/" class="hover:text-amber-600">Home</a>
                <a href="/#katalog" class="hover:text-amber-600">Katalog</a>
                <a href="#" class="bg-gray-100 p-2 rounded-full text-gray-800 hover:bg-amber-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 12H4L5 11z" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between border-b border-gray-200 pb-8">
            <div>
                <nav class="flex mb-4 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black">
                    <a href="/" class="hover:text-amber-600">Velora</a>
                    <span class="mx-2">/</span>
                    <span>Search Results</span>
                </nav>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 leading-tight">
                    Hasil Pencarian: <span class="text-amber-600">"{{ $query }}"</span>
                </h1>
            </div>
            <p class="text-gray-400 text-sm mt-4 md:mt-0 font-medium italic">
                Ditemukan {{ method_exists($products, 'total') ? $products->total() : $products->count() }} produk
            </p>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                @foreach($products as $product)
                <div class="group bg-white rounded-3xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-amber-100/50 transition-all duration-500 relative flex flex-col h-full">
                    
                    @if($product->is_featured)
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-red-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase shadow-lg shadow-red-200">Hot</span>
                    </div>
                    @endif

                    <a href="{{ route('product.detail', $product->slug) }}" class="block relative overflow-hidden aspect-[4/5] bg-gray-50">
                        <img src="{{ $product->getThumbnailUrl() }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        
                        <div class="absolute inset-x-0 bottom-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 hidden md:block">
                            <div class="bg-white/95 backdrop-blur-sm py-3 text-center rounded-2xl text-amber-600 font-bold text-xs shadow-xl border border-amber-50">
                                Lihat Detail
                            </div>
                        </div>
                    </a>

                    <div class="p-5 flex flex-col flex-grow">
                        <p class="text-[10px] text-amber-600 font-black uppercase tracking-widest mb-1">
                            {{ $product->category->name }}
                        </p>
                        <h3 class="text-sm md:text-base font-bold text-gray-800 line-clamp-2 mb-2 group-hover:text-amber-600 transition h-10 md:h-12">
                            {{ $product->name }}
                        </h3>
                        <div class="mt-auto pt-3 flex items-center justify-between border-t border-gray-50">
                            <span class="text-amber-600 font-black text-base md:text-xl">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if(method_exists($products, 'links'))
            <div class="mt-16 flex justify-center">
                {{ $products->appends(['q' => $query])->links() }}
            </div>
            @endif

        @else
            <div class="text-center py-24 bg-white rounded-[40px] border border-dashed border-gray-200 shadow-sm">
                <div class="bg-amber-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-amber-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900">Wah, pencarian nihil!</h3>
                <p class="text-gray-400 mt-2 max-w-sm mx-auto text-sm leading-relaxed">
                    Kami tidak bisa menemukan <span class="text-amber-600 font-bold">"{{ $query }}"</span>. <br> Coba gunakan kata kunci yang lebih umum.
                </p>
                <div class="mt-10">
                    <a href="{{ route('home') }}" class="px-8 py-3 bg-gray-900 text-white rounded-full font-bold text-sm hover:bg-amber-600 transition-all shadow-lg">
                        Kembali Beranda
                    </a>
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-2xl font-black text-amber-600 tracking-tighter">VELORA</span>
            <p class="text-gray-400 text-[10px] uppercase tracking-widest font-bold mt-4">
                &copy; 2026 Velora Accessories. Premium High-End Fashion.
            </p>
        </div>
    </footer>

</body>
</html>