@extends('layouts.app')

@section('title', 'Checkout - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/cart') }}" class="hover:text-primary transition">Cart</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Checkout</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="font-heading text-3xl font-bold text-dark mb-8">Checkout</h1>

    <form action="{{ url('/checkout') }}" method="POST" x-data="{ paymentMethod: 'cod', selectedAddress: '' }">
        @csrf
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Left: Delivery Details --}}
            <div class="flex-1 space-y-6">
                @if(!auth()->check())
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Already have an account? <a href="{{ url('/login') }}" class="text-primary font-medium hover:underline">Log in</a> for a faster checkout.
                    </div>
                @endif

                {{-- Saved Addresses --}}
                @if(count($addresses) > 0)
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="font-heading text-lg font-semibold text-dark mb-4">Saved Addresses</h3>
                        <div class="grid gap-3">
                            @foreach($addresses as $addr)
                                <label class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-primary transition"
                                       @click="selectedAddress = '{{ $addr->id }}';
                                              document.getElementById('delivery_name').value = '{{ $addr->name }}';
                                              document.getElementById('delivery_phone').value = '{{ $addr->phone }}';
                                              document.getElementById('delivery_address').value = '{{ $addr->address_line_1 }}';
                                              document.getElementById('delivery_address_2').value = '{{ $addr->address_line_2 }}';
                                              document.getElementById('delivery_city').value = '{{ $addr->city }}';
                                              document.getElementById('delivery_state').value = '{{ $addr->state }}';
                                              document.getElementById('delivery_postal_code').value = '{{ $addr->postal_code }}';">
                                    <input type="radio" name="address_select" value="{{ $addr->id }}" class="mt-1 text-primary focus:ring-primary">
                                    <div class="text-sm">
                                        <p class="font-medium">{{ $addr->name }} <span class="text-gray-400">- {{ $addr->label }}</span></p>
                                        <p class="text-gray-500">{{ $addr->address_line_1 }}, {{ $addr->city }}, {{ $addr->state }} {{ $addr->postal_code }}</p>
                                        <p class="text-gray-400">{{ $addr->phone }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Delivery Form --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-heading text-lg font-semibold text-dark mb-4">Delivery Details</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="delivery_name" id="delivery_name" required
                                   value="{{ old('delivery_name', auth()->user()->name ?? '') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" name="delivery_phone" id="delivery_phone" required
                                   value="{{ old('delivery_phone', auth()->user()->phone ?? '') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1 *</label>
                            <input type="text" name="delivery_address" id="delivery_address" required
                                   value="{{ old('delivery_address') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                            <input type="text" name="delivery_address_2" id="delivery_address_2"
                                   value="{{ old('delivery_address_2') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                            <input type="text" name="delivery_city" id="delivery_city" required
                                   value="{{ old('delivery_city') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">State / Province *</label>
                            <input type="text" name="delivery_state" id="delivery_state" required
                                   value="{{ old('delivery_state') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                            <input type="text" name="delivery_postal_code" id="delivery_postal_code" required
                                   value="{{ old('delivery_postal_code') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('delivery_postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        @auth
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="save_address" id="save_address" value="1" class="text-primary rounded focus:ring-primary">
                            <label for="save_address" class="text-sm text-gray-600">Save this address</label>
                        </div>
                        @endauth
                    </div>
                </div>

                {{-- Order Notes --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-heading text-lg font-semibold text-dark mb-4">Order Notes</h3>
                    <textarea name="notes" rows="3" placeholder="Any special instructions for delivery..."
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">{{ old('notes') }}</textarea>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-heading text-lg font-semibold text-dark mb-4">Payment Method</h3>
                    <div class="space-y-3">
                        <label class="flex items-start gap-3 p-4 border rounded-lg cursor-pointer transition"
                               :class="paymentMethod === 'cod' ? 'border-primary bg-pink-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="payment_method" value="cod" x-model="paymentMethod" class="mt-0.5 text-primary focus:ring-primary">
                            <div>
                                <p class="font-medium text-sm">Cash on Delivery</p>
                                <p class="text-xs text-gray-500 mt-0.5">Pay when you receive your order</p>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 p-4 border rounded-lg cursor-pointer transition"
                               :class="paymentMethod === 'bank_transfer' ? 'border-primary bg-pink-50' : 'border-gray-200 hover:border-gray-300'">
                            <input type="radio" name="payment_method" value="bank_transfer" x-model="paymentMethod" class="mt-0.5 text-primary focus:ring-primary">
                            <div>
                                <p class="font-medium text-sm">Bank Transfer</p>
                                <p class="text-xs text-gray-500 mt-0.5">Transfer to our bank account and upload receipt</p>
                            </div>
                        </label>
                        <div x-show="paymentMethod === 'bank_transfer'" x-cloak class="bg-gray-50 rounded-lg p-4 ml-7 text-sm">
                            <p class="font-medium text-dark mb-2">Bank Details:</p>
                            <p class="text-gray-600">Bank: {{ $settings['bank_name'] ?? 'Commercial Bank of Ceylon' }}</p>
                            <p class="text-gray-600">Account: {{ $settings['bank_account'] ?? '1234567890' }}</p>
                            <p class="text-gray-600">Branch: {{ $settings['bank_branch'] ?? 'Colombo' }}</p>
                            <p class="text-gray-600">Name: {{ $settings['bank_holder'] ?? 'Mars Stationery (Pvt) Ltd' }}</p>
                        </div>
                        <label class="flex items-start gap-3 p-4 border border-gray-200 rounded-lg opacity-50 cursor-not-allowed">
                            <input type="radio" disabled class="mt-0.5">
                            <div>
                                <p class="font-medium text-sm">Online Payment</p>
                                <p class="text-xs text-gray-500 mt-0.5">Coming Soon</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Right: Order Summary --}}
            <div class="lg:w-96">
                <div class="bg-white rounded-xl border border-gray-100 p-6 sticky top-32">
                    <h3 class="font-heading text-lg font-bold text-dark mb-4">Order Summary</h3>

                    <div class="space-y-3 max-h-80 overflow-y-auto">
                        @foreach($cart as $item)
                            <div class="flex items-center gap-3 text-sm">
                                <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://placehold.co/50x50/f5f5f5/999?text=Img' }}"
                                     class="w-12 h-12 rounded-lg object-cover bg-gray-50"
                                     onerror="this.src='https://placehold.co/50x50/f5f5f5/999?text=Img'">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-dark truncate">{{ $item['name'] }}</p>
                                    <p class="text-gray-400 text-xs">{{ $item['quantity'] }} x LKR {{ number_format($item['price'], 2) }} | {{ $item['weight'] * $item['quantity'] }}g</p>
                                </div>
                                <span class="font-medium whitespace-nowrap">LKR {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 mt-4 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium">LKR {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Weight</span>
                            <span class="font-medium">{{ number_format($totalWeight) }}g</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Delivery</span>
                            <span class="font-medium">LKR {{ number_format($deliveryCharge, 2) }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between">
                            <span class="font-bold text-dark text-base">Total</span>
                            <span class="font-bold text-xl text-primary">LKR {{ number_format($subtotal + $deliveryCharge, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-[#d1405b] text-white py-3.5 rounded-lg font-semibold mt-6 transition transform hover:scale-[1.02]">
                        <i class="fas fa-lock mr-2"></i> Place Order
                    </button>

                    <p class="text-center text-xs text-gray-400 mt-3">By placing this order, you agree to our Terms & Conditions</p>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
