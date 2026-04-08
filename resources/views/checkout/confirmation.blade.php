@extends('layouts.app')

@section('title', 'Order Confirmed - Mars Stationery')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-check text-green-500 text-3xl"></i>
        </div>
        <h1 class="font-heading text-3xl font-bold text-dark">Order Confirmed!</h1>
        <p class="text-gray-500 mt-2">Thank you for your order. Your order number is:</p>
        <p class="text-2xl font-bold text-primary mt-2">{{ $order->order_number }}</p>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-6 mb-6">
        <h3 class="font-heading text-lg font-semibold text-dark mb-4">Order Details</h3>
        <div class="grid md:grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-500">Delivery Name</p>
                <p class="font-medium">{{ $order->delivery_name }}</p>
            </div>
            <div>
                <p class="text-gray-500">Phone</p>
                <p class="font-medium">{{ $order->delivery_phone }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-500">Delivery Address</p>
                <p class="font-medium">{{ $order->delivery_address }}, {{ $order->delivery_city }}, {{ $order->delivery_state }} {{ $order->delivery_postal_code }}</p>
            </div>
            <div>
                <p class="text-gray-500">Payment Method</p>
                <p class="font-medium">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</p>
            </div>
            <div>
                <p class="text-gray-500">Order Status</p>
                <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-1 rounded">{{ ucfirst($order->order_status) }}</span>
            </div>
        </div>

        <div class="border-t border-gray-100 mt-5 pt-5">
            <h4 class="font-medium text-dark mb-3">Items Ordered</h4>
            @foreach($order->items as $item)
                <div class="flex justify-between items-center py-2 text-sm">
                    <div>
                        <span class="font-medium">{{ $item->product_name }}</span>
                        <span class="text-gray-400 ml-2">x {{ $item->quantity }}</span>
                    </div>
                    <span class="font-medium">LKR {{ number_format($item->subtotal, 2) }}</span>
                </div>
            @endforeach
        </div>

        <div class="border-t border-gray-100 mt-4 pt-4 space-y-2 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Subtotal</span>
                <span>LKR {{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Weight</span>
                <span>{{ number_format($order->total_weight) }}g</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Delivery Charge</span>
                <span>LKR {{ number_format($order->delivery_charge, 2) }}</span>
            </div>
            <div class="flex justify-between border-t border-gray-100 pt-2">
                <span class="font-bold text-dark">Total</span>
                <span class="font-bold text-lg text-primary">LKR {{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    @if($order->payment_method === 'bank_transfer')
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
            <h3 class="font-heading text-lg font-semibold text-dark mb-3"><i class="fas fa-university text-blue-500 mr-2"></i> Bank Transfer Details</h3>
            <p class="text-sm text-gray-600 mb-4">Please transfer the total amount to the following bank account and upload your receipt below:</p>
            <div class="bg-white rounded-lg p-4 text-sm space-y-1">
                <p><span class="text-gray-500">Bank:</span> <span class="font-medium">{{ $settings['bank_name'] ?? 'Commercial Bank of Ceylon' }}</span></p>
                <p><span class="text-gray-500">Account:</span> <span class="font-medium">{{ $settings['bank_account'] ?? '1234567890' }}</span></p>
                <p><span class="text-gray-500">Branch:</span> <span class="font-medium">{{ $settings['bank_branch'] ?? 'Colombo' }}</span></p>
                <p><span class="text-gray-500">Account Holder:</span> <span class="font-medium">{{ $settings['bank_holder'] ?? 'Mars Stationery (Pvt) Ltd' }}</span></p>
                <p><span class="text-gray-500">Amount:</span> <span class="font-bold text-primary">LKR {{ number_format($order->total, 2) }}</span></p>
            </div>

            @if($order->bank_receipt_image)
                <div class="mt-4 p-3 bg-green-50 rounded-lg text-sm text-green-700">
                    <i class="fas fa-check-circle mr-1"></i> Receipt uploaded successfully!
                </div>
            @else
                <form action="{{ url('/order/' . $order->id . '/upload-receipt') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Bank Receipt</label>
                    <div class="flex gap-3">
                        <input type="file" name="receipt" accept="image/*" required
                               class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                            Upload
                        </button>
                    </div>
                    @error('receipt') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </form>
            @endif
        </div>
    @endif

    <div class="text-center">
        <a href="{{ url('/products') }}" class="inline-block bg-primary hover:bg-[#d1405b] text-white px-8 py-3 rounded-lg font-semibold transition">
            Continue Shopping
        </a>
        @auth
            <a href="{{ url('/account/orders') }}" class="inline-block ml-4 text-primary hover:underline font-medium">
                View My Orders
            </a>
        @endauth
    </div>
</div>

@endsection
