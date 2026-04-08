@extends('layouts.app')

@section('title', $product->name . ' - Mars Stationery')

@section('content')

@php
    $images = $product->images->sortByDesc('is_primary');
    $primaryImage = $images->first();
    $effectivePrice = ($product->sale_price && $product->sale_price > 0) ? $product->sale_price : $product->price;
@endphp

{{-- Breadcrumbs --}}
<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/products') }}" class="hover:text-primary transition">Products</a>
            @if($product->category)
                <i class="fas fa-chevron-right text-[10px]"></i>
                <a href="{{ url('/category/' . $product->category->slug) }}" class="hover:text-primary transition">{{ $product->category->name }}</a>
            @endif
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">{{ Str::limit($product->name, 40) }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- Image Gallery --}}
        <div class="lg:w-1/2" x-data="{ mainImage: '{{ $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://placehold.co/600x600/f5f5f5/999?text=' . urlencode($product->name) }}' }">
            <div class="bg-light rounded-2xl overflow-hidden aspect-square flex items-center justify-center mb-4">
                <img :src="mainImage" alt="{{ $product->name }}"
                     class="w-full h-full object-contain p-4 cursor-zoom-in"
                     onerror="this.src='https://placehold.co/600x600/f5f5f5/999?text=No+Image'"
                     @click="window.open(mainImage, '_blank')">
            </div>
            @if($images->count() > 1)
                <div class="flex gap-3 overflow-x-auto scrollbar-hide">
                    @foreach($images as $img)
                        <button @click="mainImage = '{{ asset('storage/' . $img->image_path) }}'"
                                class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden border-2 hover:border-primary transition"
                                :class="mainImage === '{{ asset('storage/' . $img->image_path) }}' ? 'border-primary' : 'border-gray-200'">
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt=""
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://placehold.co/100x100/f5f5f5/999?text=Img'">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="lg:w-1/2">
            @if($product->category)
                <a href="{{ url('/category/' . $product->category->slug) }}" class="text-xs text-primary font-semibold uppercase tracking-wider hover:underline">{{ $product->category->name }}</a>
            @endif
            <h1 class="font-heading text-2xl md:text-3xl font-bold text-dark mt-2">{{ $product->name }}</h1>

            <div class="flex items-center gap-2 mt-3">
                <div class="flex items-center gap-0.5">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                    @endfor
                </div>
                <span class="text-sm text-gray-400">(4.8 rating)</span>
            </div>

            <div class="flex items-center gap-3 mt-5">
                <span class="text-3xl font-bold text-primary">LKR {{ number_format($effectivePrice, 2) }}</span>
                @if($product->sale_price && $product->sale_price > 0 && $product->sale_price < $product->price)
                    <span class="text-xl text-gray-400 line-through">LKR {{ number_format($product->price, 2) }}</span>
                    @php $discount = round((($product->price - $product->sale_price) / $product->price) * 100); @endphp
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded">-{{ $discount }}%</span>
                @endif
            </div>

            @if($product->short_description)
                <p class="text-gray-500 mt-4 leading-relaxed">{{ $product->short_description }}</p>
            @endif

            <div class="border-t border-gray-100 mt-6 pt-6 space-y-3">
                <div class="flex items-center gap-3 text-sm">
                    <span class="text-gray-500 w-24">Weight:</span>
                    <span class="font-medium">{{ $product->weight }}g</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <span class="text-gray-500 w-24">SKU:</span>
                    <span class="font-medium">{{ $product->sku ?? 'N/A' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <span class="text-gray-500 w-24">Availability:</span>
                    @if($product->stock_quantity > 0)
                        <span class="text-green-600 font-medium"><i class="fas fa-check-circle mr-1"></i> In Stock ({{ $product->stock_quantity }} available)</span>
                    @else
                        <span class="text-red-500 font-medium"><i class="fas fa-times-circle mr-1"></i> Out of Stock</span>
                    @endif
                </div>
            </div>

            {{-- Add to Cart --}}
            @if($product->stock_quantity > 0)
                <form action="{{ url('/cart/add') }}" method="POST" class="mt-6 flex items-center gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div x-data="{ qty: 1 }" class="flex items-center border border-gray-200 rounded-lg">
                        <button type="button" @click="qty = Math.max(1, qty - 1)" class="px-4 py-3 text-gray-500 hover:text-primary transition">
                            <i class="fas fa-minus text-xs"></i>
                        </button>
                        <input type="number" name="quantity" x-model="qty" min="1" max="{{ $product->stock_quantity }}"
                               class="w-16 text-center border-0 focus:ring-0 text-sm font-medium">
                        <button type="button" @click="qty = Math.min({{ $product->stock_quantity }}, qty + 1)" class="px-4 py-3 text-gray-500 hover:text-primary transition">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                    </div>
                    <button type="submit" class="flex-1 bg-primary hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-[1.02]">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </form>
            @endif

            {{-- Quick Info --}}
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-truck text-primary"></i> Island-wide Delivery
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-undo text-primary"></i> Easy Returns
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-shield-alt text-primary"></i> Secure Payment
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-headset text-primary"></i> Customer Support
                </div>
            </div>
        </div>
    </div>

    {{-- Bulk Purchase Inquiry --}}
    <div class="mt-12 bg-light rounded-2xl p-6 md:p-8">
        <h3 class="font-heading text-xl font-bold text-dark mb-2"><i class="fas fa-boxes text-primary mr-2"></i> Bulk Purchase Inquiry</h3>
        <p class="text-gray-500 text-sm mb-6">Need this product in bulk? Fill out the form below and we will get back to you with a quote.</p>
        <form action="{{ url('/product-inquiry') }}" method="POST" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                <input type="text" name="name" required value="{{ auth()->user()->name ?? old('name') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" name="email" required value="{{ auth()->user()->email ?? old('email') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                <input type="tel" name="phone" required value="{{ auth()->user()->phone ?? old('phone') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity Required *</label>
                <input type="number" name="quantity" required min="1" value="{{ old('quantity', 100) }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                <input type="text" name="delivery_address" required value="{{ old('delivery_address') }}"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Message</label>
                <textarea name="message" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">{{ old('message') }}</textarea>
            </div>
            <div>
                <button type="submit" class="bg-primary hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-medium transition text-sm">
                    <i class="fas fa-paper-plane mr-1"></i> Submit Inquiry
                </button>
            </div>
        </form>
    </div>

    {{-- Tabs: Description / Additional Info --}}
    <div class="mt-12" x-data="{ tab: 'description' }">
        <div class="border-b border-gray-200 flex gap-0">
            <button @click="tab = 'description'" :class="tab === 'description' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="px-6 py-3 text-sm font-semibold border-b-2 transition">Description</button>
            <button @click="tab = 'info'" :class="tab === 'info' ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="px-6 py-3 text-sm font-semibold border-b-2 transition">Additional Info</button>
        </div>
        <div class="py-6">
            <div x-show="tab === 'description'">
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($product->description ?? 'No description available for this product.')) !!}
                </div>
            </div>
            <div x-show="tab === 'info'" x-cloak>
                <table class="w-full max-w-lg text-sm">
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="py-3 text-gray-500 w-40">SKU</td>
                            <td class="py-3 font-medium">{{ $product->sku ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="py-3 text-gray-500">Weight</td>
                            <td class="py-3 font-medium">{{ $product->weight }}g</td>
                        </tr>
                        <tr>
                            <td class="py-3 text-gray-500">Category</td>
                            <td class="py-3 font-medium">{{ $product->category->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td class="py-3 text-gray-500">Stock</td>
                            <td class="py-3 font-medium">{{ $product->stock_quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count() > 0)
        <div class="mt-12">
            <h2 class="font-heading text-2xl font-bold text-dark mb-6">Related Products</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($related as $relProd)
                    @include('components.product-card', ['product' => $relProd])
                @endforeach
            </div>
        </div>
    @endif
</div>

@endsection
