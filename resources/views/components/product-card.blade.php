@props(['product'])

@php
    $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
    $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://placehold.co/400x400/f5f5f5/999999?text=' . urlencode($product->name);
    $effectivePrice = $product->sale_price && $product->sale_price > 0 ? $product->sale_price : $product->price;
    $onSale = $product->sale_price && $product->sale_price > 0 && $product->sale_price < $product->price;
@endphp

<div class="group bg-white rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl">
    {{-- Image --}}
    <div class="relative overflow-hidden aspect-square bg-light">
        <a href="{{ url('/products/' . $product->slug) }}">
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out"
                 loading="lazy"
                 onerror="this.src='https://placehold.co/400x400/f5f5f5/999999?text=No+Image'">
        </a>

        {{-- Sale Badge --}}
        @if($onSale)
            @php $discount = round((($product->price - $product->sale_price) / $product->price) * 100); @endphp
            <span class="absolute top-3 left-3 bg-primary text-white text-[10px] font-bold px-2.5 py-1 rounded-full">-{{ $discount }}%</span>
        @endif
        @if($product->is_new_arrival)
            <span class="absolute top-3 {{ $onSale ? 'left-16' : 'left-3' }} bg-navy text-white text-[10px] font-bold px-2.5 py-1 rounded-full">NEW</span>
        @endif

        {{-- Hover Quick View Icon --}}
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none group-hover:pointer-events-auto">
            <a href="{{ url('/products/' . $product->slug) }}"
               class="w-11 h-11 bg-white rounded-full flex items-center justify-center text-navy hover:bg-primary hover:text-white transition-all duration-300 shadow-lg transform translate-y-3 group-hover:translate-y-0"
               title="Quick View">
                <i class="fas fa-eye text-sm"></i>
            </a>
        </div>
    </div>

    {{-- Details --}}
    <div class="p-4 text-center">
        <a href="{{ url('/products/' . $product->slug) }}" class="block">
            <h3 class="text-sm font-medium text-dark line-clamp-2 hover:text-primary transition min-h-[2.5rem] leading-snug">{{ $product->name }}</h3>
        </a>
        <div class="flex items-center justify-center gap-2 mt-2">
            <span class="font-bold {{ $onSale ? 'text-primary' : 'text-dark' }}">LKR {{ number_format($effectivePrice, 2) }}</span>
            @if($onSale)
                <span class="text-gray-400 text-sm line-through">LKR {{ number_format($product->price, 2) }}</span>
            @endif
        </div>
    </div>
</div>
