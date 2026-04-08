@extends('layouts.app')

@section('title', 'Shopping Cart - Mars Stationery')

@section('content')

{{-- Breadcrumbs --}}
<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Shopping Cart</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="font-heading text-3xl font-bold text-dark mb-8">Shopping Cart</h1>

    @if(count($cart) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Cart Items --}}
            <div class="flex-1">
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                    {{-- Desktop Header --}}
                    <div class="hidden md:grid grid-cols-12 gap-4 bg-gray-50 px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <div class="col-span-5">Product</div>
                        <div class="col-span-2 text-center">Price</div>
                        <div class="col-span-2 text-center">Quantity</div>
                        <div class="col-span-2 text-center">Subtotal</div>
                        <div class="col-span-1"></div>
                    </div>

                    @foreach($cart as $key => $item)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center px-6 py-5 border-b border-gray-50 last:border-0">
                            {{-- Product --}}
                            <div class="md:col-span-5 flex items-center gap-4">
                                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://placehold.co/80x80/f5f5f5/999?text=Img' }}"
                                     alt="{{ $item['name'] }}" class="w-16 h-16 rounded-lg object-cover bg-gray-50"
                                     onerror="this.src='https://placehold.co/80x80/f5f5f5/999?text=Img'">
                                <div>
                                    <a href="{{ url('/products/' . $item['slug']) }}" class="font-medium text-sm text-dark hover:text-primary transition">{{ $item['name'] }}</a>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $item['weight'] }}g per unit</p>
                                </div>
                            </div>

                            {{-- Price --}}
                            <div class="md:col-span-2 text-center">
                                <span class="text-sm font-medium">LKR {{ number_format($item['price'], 2) }}</span>
                            </div>

                            {{-- Quantity --}}
                            <div class="md:col-span-2 flex justify-center">
                                <form action="{{ url('/cart/update') }}" method="POST" class="flex items-center border border-gray-200 rounded-lg">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}"
                                            class="px-3 py-2 text-gray-400 hover:text-primary transition text-xs">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="w-10 text-center text-sm font-medium">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                            class="px-3 py-2 text-gray-400 hover:text-primary transition text-xs">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- Subtotal --}}
                            <div class="md:col-span-2 text-center">
                                <span class="font-semibold text-sm text-primary">LKR {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>

                            {{-- Remove --}}
                            <div class="md:col-span-1 text-center">
                                <form action="{{ url('/cart/remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Remove">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <a href="{{ url('/products') }}" class="text-primary hover:underline text-sm font-medium">
                        <i class="fas fa-arrow-left mr-1"></i> Continue Shopping
                    </a>
                </div>
            </div>

            {{-- Cart Summary --}}
            <div class="lg:w-80">
                <div class="bg-white rounded-xl border border-gray-100 p-6 sticky top-32">
                    <h3 class="font-heading text-lg font-bold text-dark mb-4">Order Summary</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium">LKR {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Total Weight</span>
                            <span class="font-medium">{{ number_format($totalWeight) }}g ({{ ceil($totalWeight / 1000) }}kg)</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Delivery Charge</span>
                            <span class="font-medium">LKR {{ number_format($deliveryCharge, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <span class="font-semibold text-dark">Total</span>
                            <span class="font-bold text-lg text-primary">LKR {{ number_format($subtotal + $deliveryCharge, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ url('/checkout') }}"
                       class="block w-full bg-primary hover:bg-[#d1405b] text-white text-center py-3 rounded-lg font-semibold mt-6 transition">
                        Proceed to Checkout <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <i class="fas fa-shopping-cart text-6xl text-gray-200 mb-6"></i>
            <h3 class="font-heading text-2xl font-semibold text-gray-500">Your cart is empty</h3>
            <p class="text-gray-400 mt-2">Looks like you haven't added any products yet.</p>
            <a href="{{ url('/products') }}" class="inline-block mt-6 bg-primary hover:bg-[#d1405b] text-white px-8 py-3 rounded-lg font-semibold transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>

@endsection
