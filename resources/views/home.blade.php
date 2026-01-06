@extends('layouts.master')

@section('title', 'Velora Accessories - Premium Fashion')

@section('content')
    <header class="bg-amber-50 py-16 mb-10 border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="text-center md:text-left md:w-1/2">
                <span class="text-amber-600 font-bold text-sm uppercase tracking-[0.3em]">New Collection 2026</span>
                <h1 class="text-4xl md:text-6xl font-black text-gray-900 mt-4 mb-6 leading-tight">
                    Ekspresikan <br> Gaya <span class="text-amber-600 italic">Eleganmu</span>
                </h1>
                <p class="text-gray-500 max-w-lg mb-8 text-sm md:text-base leading-relaxed">
                    Temukan koleksi aksesoris dan fashion premium yang dirancang khusus untuk meningkatkan kepercayaan diri Anda setiap hari.
                </p>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="#katalog" class="bg-amber-600 text-white px-8 py-3 rounded-full font-bold shadow-lg shadow-amber-200 hover:bg-amber-700 transition-all">
                        Belanja Sekarang
                    </a>
                    <a href="#" class="bg-white text-gray-700 px-8 py-3 rounded-full font-bold border border-gray-200 hover:bg-gray-50 transition-all">
                        Lihat Tren
                    </a>
                </div>
            </div>
            
            <div class="md:w-1/2 relative">
                <div class="w-72 h-72 md:w-96 md:h-96 bg-amber-200 rounded-full absolute -bottom-4 -right-4 blur-3xl opacity-30"></div>
                <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=2070&auto=format&fit=crop" 
                     class="relative z-10 rounded-[40px] shadow-2xl border-8 border-white object-cover aspect-square w-full max-w-md mx-auto" 
                     alt="Featured Fashion">
            </div>
        </div>
    </header>

    <main id="katalog" class="max-w-7xl mx-auto px-4 pb-20">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <div>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Katalog Produk</h2>
                <div class="h-1 w-20 bg-amber-500 mt-1 rounded-full"></div>
            </div>
            
            <div class="flex gap-2 overflow-x-auto pb-2 w-full md:w-auto custom-scrollbar">
                <a href="{{ route('home') }}" 
                   class="px-5 py-2 rounded-full text-xs font-bold whitespace-nowrap transition-all {{ !request('category') ? 'bg-amber-600 text-white shadow-lg shadow-amber-200' : 'bg-white text-gray-500 border border-gray-100 hover:border-amber-500' }}">
                    Semua
                </a>

                @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}" 
                   class="px-5 py-2 rounded-full text-xs font-bold whitespace-nowrap transition-all {{ request('category') == $cat->slug ? 'bg-amber-600 text-white shadow-lg shadow-amber-200' : 'bg-white text-gray-500 border border-gray-100 hover:border-amber-500' }}">
                    {{ $cat->name }}
                </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            @forelse($products as $product)
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
                            Lihat Detail Produk
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
                        
                        <div class="md:hidden bg-amber-50 p-2 rounded-lg text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                </div>
                <p class="text-gray-400 font-medium italic">Belum ada produk untuk kategori ini.</p>
            </div>
            @endforelse
        </div>
    </main>

    <style>
        /* Sembunyikan scrollbar pada filter kategori agar rapi di mobile */
        .custom-scrollbar::-webkit-scrollbar { display: none; }
        .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
@endsection