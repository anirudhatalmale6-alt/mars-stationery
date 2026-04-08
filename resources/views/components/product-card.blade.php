@props(['product'])

@php
    $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
    $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://placehold.co/400x400/f5f5f5/999999?text=' . urlencode($product->name);
    $effectivePrice = $product->sale_price && $product->sale_price > 0 ? $product->sale_price : $product->price;
@endphp

<div class="group bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300">
    {{-- Image --}}
    <div class="relative overflow-hidden aspect-square bg-gray-50">
        <a href="{{ url('/products/' . $product->slug) }}">
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                 onerror="this.src='https://placehold.co/400x400/f5f5f5/999999?text=No+Image'">
        </a>

        {{-- Badges --}}
        <div class="absolute top-3 left-3 flex flex-col gap-1">
            @if($product->is_new_arrival)
                <span class="bg-green-500 text-white text-[10px] font-bold px-2 py-0.5 rounded">NEW</span>
            @endif
            @if($product->sale_price && $product->sale_price > 0 && $product->sale_price < $product->price)
                <span class="bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded">SALE</span>
            @endif
        </div>

        {{-- Hover Overlay --}}
        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 pointer-events-none group-hover:pointer-events-auto">
            <a href="{{ url('/products/' . $product->slug) }}"
               class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-700 hover:bg-primary hover:text-white transition transform translate-y-4 group-hover:translate-y-0 duration-300"
               title="Quick View">
                <i class="fas fa-eye text-sm"></i>
            </a>
            <form action="{{ url('/cart/add') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-700 hover:bg-primary hover:text-white transition transform translate-y-4 group-hover:translate-y-0 duration-300 delay-75"
                        title="Add to Cart">
                    <i class="fas fa-cart-plus text-sm"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Details --}}
    <div class="p-4">
        @if($product->category)
            <p class="text-[11px] text-gray-400 uppercase tracking-wider mb-1">{{ $product->category->name }}</p>
        @endif
        <a href="{{ url('/products/' . $product->slug) }}" class="block">
            <h3 class="font-heading text-sm font-semibold text-gray-800 line-clamp-2 hover:text-primary transition min-h-[2.5rem]">{{ $product->name }}</h3>
        </a>
        <div class="flex items-center gap-1 my-2">
            @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star text-yellow-400 text-[10px]"></i>
            @endfor
        </div>
        <div class="flex items-center gap-2">
            <span class="text-primary font-bold text-lg">LKR {{ number_format($effectivePrice, 2) }}</span>
            @if($product->sale_price && $product->sale_price > 0 && $product->sale_price < $product->price)
                <span class="text-gray-400 text-sm line-through">LKR {{ number_format($product->price, 2) }}</span>
            @endif
        </div>
        <form action="{{ url('/cart/add') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="w-full bg-gray-100 hover:bg-primary text-gray-700 hover:text-white text-xs font-semibold py-2.5 rounded-lg transition-all duration-300">
                <i class="fas fa-shopping-cart mr-1"></i> Add to Cart
            </button>
        </form>
    </div>
</div>
