@extends('layouts.app')

@section('title', 'Bulk Inquiry - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Bulk Inquiry</span>
        </nav>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h1 class="font-heading text-3xl font-bold text-dark">Bulk Purchase Inquiry</h1>
        <p class="text-gray-500 mt-2">Need products in large quantities? Fill in the form below and we'll get back to you with a competitive quote.</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-8"
         x-data="{
            items: [{ product_id: '', quantity: 1 }],
            addItem() { this.items.push({ product_id: '', quantity: 1 }); },
            removeItem(index) { if (this.items.length > 1) this.items.splice(index, 1); }
         }">
        <form action="{{ url('/bulk-inquiry') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Contact Details --}}
            <div>
                <h3 class="font-heading text-lg font-semibold text-dark mb-4"><i class="fas fa-user text-primary mr-2"></i> Contact Details</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                        <input type="text" name="name" required value="{{ old('name', auth()->user()->name ?? '') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input type="email" name="email" required value="{{ old('email', auth()->user()->email ?? '') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                        <input type="tel" name="phone" required value="{{ old('phone', auth()->user()->phone ?? '') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                        <input type="text" name="delivery_address" required value="{{ old('delivery_address') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                </div>
            </div>

            {{-- Products --}}
            <div>
                <h3 class="font-heading text-lg font-semibold text-dark mb-4"><i class="fas fa-boxes text-primary mr-2"></i> Products Required</h3>
                <template x-for="(item, index) in items" :key="index">
                    <div class="flex gap-3 mb-3 items-end">
                        <div class="flex-1">
                            <label x-show="index === 0" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                            <select :name="'items[' + index + '][product_id]'" required
                                    x-model="item.product_id"
                                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                                <option value="">Select a product...</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku ?? 'N/A' }}) - LKR {{ number_format($product->price, 2) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-32">
                            <label x-show="index === 0" class="block text-sm font-medium text-gray-700 mb-1">Qty</label>
                            <input type="number" :name="'items[' + index + '][quantity]'" min="1" required
                                   x-model="item.quantity"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                        <button type="button" @click="removeItem(index)" x-show="items.length > 1"
                                class="w-10 h-10 flex items-center justify-center text-red-400 hover:text-red-600 transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </template>
                <button type="button" @click="addItem()" class="text-primary hover:text-red-700 text-sm font-medium transition">
                    <i class="fas fa-plus mr-1"></i> Add Another Product
                </button>
            </div>

            {{-- Message --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Additional Message</label>
                <textarea name="message" rows="4" placeholder="Any specific requirements, delivery timeline, etc."
                          class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="bg-primary hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                <i class="fas fa-paper-plane mr-2"></i> Submit Inquiry
            </button>
        </form>
    </div>
</div>

@endsection
