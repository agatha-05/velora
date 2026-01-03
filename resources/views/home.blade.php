@extends('layouts.master')

@section('title', 'Velora Accessories - Premium Fashion')

@section('content')
    <main id="koleksi" class="max-w-7xl mx-auto px-4 py-20">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h3 class="text-3xl font-bold text-gray-800">Koleksi Terbaru</h3>
                <div class="h-1 w-20 bg-amber-500 mt-2 rounded-full"></div>
            </div>
            <a href="#" class="text-amber-600 font-semibold hover:underline">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="group relative">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <div class="aspect-[4/5] bg-gray-100 overflow-hidden relative">
                            <img src="{{ $product->getThumbnailUrl() }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            @if($product->is_featured)
                            <span class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-lg">Hot</span>
                            @endif
                        </div>
                        <div class="p-5 text-center">
                            <p class="text-[10px] text-amber-600 font-bold uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                            <h4 class="font-bold text-gray-800 text-lg group-hover:text-amber-600 transition">{{ $product->name }}</h4>
                            <div class="mt-3">
                                <span class="text-xl font-extrabold text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
                <a href="{{ route('product.detail', $product->slug) }}" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white text-gray-900 px-6 py-2 rounded-full font-bold opacity-0 group-hover:opacity-100 transition duration-300 shadow-2xl">
                    {{ __('Lihat Detail') }}
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-400 text-lg italic">Belum ada produk untuk ditampilkan.</p>
            </div>
            @endforelse
        </div>
    </main>
@endsection

<script>
    let timer;
    const input = document.querySelector('input[name="search"]');
    input.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            input.closest('form').submit();
        }, 800); // Menunggu 0.8 detik setelah berhenti mengetik sebelum mencari
    });
</script>