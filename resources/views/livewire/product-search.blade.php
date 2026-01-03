<div class="relative w-full" x-data="{ open: true }" @click.away="open = false">
    <form action="{{ route('search') }}" method="GET">
        <div class="relative group">
            <input 
                type="text" 
                name="q" 
                wire:model.live.debounce.300ms="search"
                @focus="open = true"
                placeholder="Cari produk..." 
                class="w-full bg-white border-none focus:ring-0 py-2 pl-10 pr-4 rounded-full text-sm placeholder:text-gray-400"
                autocomplete="off">
            
            <div class="absolute left-3 top-2.5 text-amber-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </form>

    @if(strlen($search) >= 2)
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         class="absolute mt-3 w-full bg-white rounded-2xl shadow-2xl border border-amber-100 z-[60] overflow-hidden">
        
        @forelse($recommendations as $p)
            <a href="{{ route('product.detail', $p->slug) }}" class="flex items-center p-3 hover:bg-amber-50 transition border-b border-gray-50 last:border-0">
                <img src="{{ $p->getThumbnailUrl() }}" class="w-12 h-12 object-cover rounded-xl mr-3 shadow-sm">
                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-800 line-clamp-1">{{ $p->name }}</p>
                    <p class="text-xs text-amber-600 font-black">Rp{{ number_format($p->price, 0, ',', '.') }}</p>
                </div>
                <div class="text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        @empty
            <div class="p-4 text-center text-xs text-gray-400 italic font-medium">
                Produk <span class="text-amber-600">"{{ $search }}"</span> tidak ditemukan
            </div>
        @endforelse

        @if(count($recommendations) > 0)
        <button type="button" onclick="this.closest('div').parentElement.querySelector('form').submit()" 
                class="w-full py-3 bg-amber-50 text-amber-700 text-xs font-bold hover:bg-amber-100 transition uppercase tracking-widest">
            Lihat Semua Hasil
        </button>
        @endif
    </div>
    @endif
</div>  