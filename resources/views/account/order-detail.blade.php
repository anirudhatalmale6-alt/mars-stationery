@extends('layouts.app')

@section('title', 'Order ' . $order->order_number . ' - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/account') }}" class="hover:text-primary transition">Account</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/account/orders') }}" class="hover:text-primary transition">Orders</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">{{ $order->order_number }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        @include('account._sidebar')

        <div class="flex-1 space-y-6">
            {{-- Order Header --}}
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="font-heading text-xl font-bold text-dark">Order {{ $order->order_number }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                    @php
                        $statusColors = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'shipped' => 'bg-purple-100 text-purple-700',
                            'delivered' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-pink-700',
                        ];
                    @endphp
                    <span class="text-sm font-semibold px-4 py-1.5 rounded-full {{ $statusColors[$order->order_status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>
            </div>

            {{-- Items --}}
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="font-heading font-semibold text-dark mb-4">Order Items</h3>
                <div class="divide-y divide-gray-50">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4 py-3">
                            <div class="flex-1">
                                <p class="font-medium text-sm text-dark">{{ $item->product_name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $item->quantity }} x LKR {{ number_format($item->product_price, 2) }} | {{ number_format($item->weight) }}g</p>
                            </div>
                            <span class="font-semibold text-sm">LKR {{ number_format($item->subtotal, 2) }}</span>
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

            {{-- Delivery & Payment --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-heading font-semibold text-dark mb-3">Delivery Address</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p class="font-medium text-dark">{{ $order->delivery_name }}</p>
                        <p>{{ $order->delivery_phone }}</p>
                        <p>{{ $order->delivery_address }}</p>
                        <p>{{ $order->delivery_city }}, {{ $order->delivery_state }} {{ $order->delivery_postal_code }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-100 p-6">
                    <h3 class="font-heading font-semibold text-dark mb-3">Payment Info</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p><span class="text-gray-500">Method:</span> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</p>
                        <p><span class="text-gray-500">Payment Status:</span>
                            <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Bank Receipt Upload --}}
            @if($order->payment_method === 'bank_transfer')
                <div class="bg-blue-50 rounded-xl border border-blue-200 p-6">
                    <h3 class="font-heading font-semibold text-dark mb-3"><i class="fas fa-university text-blue-500 mr-2"></i> Bank Transfer Receipt</h3>
                    @if($order->bank_receipt_image)
                        <div class="flex items-center gap-3 text-sm text-green-700 bg-green-50 rounded-lg p-3">
                            <i class="fas fa-check-circle"></i>
                            <span>Receipt uploaded successfully</span>
                            <a href="{{ asset('storage/' . $order->bank_receipt_image) }}" target="_blank" class="text-blue-600 hover:underline ml-auto">View Receipt</a>
                        </div>
                    @else
                        <form action="{{ url('/order/' . $order->id . '/upload-receipt') }}" method="POST" enctype="multipart/form-data" class="flex gap-3">
                            @csrf
                            <input type="file" name="receipt" accept="image/*" required class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">Upload</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
