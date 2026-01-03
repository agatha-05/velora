@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="mb-10 border-b pb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Hasil Pencarian untuk: <span class="text-amber-600">"{{ $query }}"</span></h1>
        <p class="text-gray-500 mt-2">Ditemukan {{ $products->total() }} produk</p>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border">
                     <a href="{{ route('product.detail', $product->slug) }}">
                        <img src="{{ $product->getThumbnailUrl() }}" class="w-full aspect-[4/5] object-cover">
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800">{{ $product->name }}</h4>
                            <p class="text-amber-600 font-bold mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                     </a>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $products->appends(['q' => $query])->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <p class="text-gray-400 text-lg">Maaf, produk tidak ditemukan. Coba kata kunci lain.</p>
        </div>
    @endif
</div>
@endsection