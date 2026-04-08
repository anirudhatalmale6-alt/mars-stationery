@extends('layouts.app')

@section('title', 'My Orders - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/account') }}" class="hover:text-primary transition">Account</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Orders</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        @include('account._sidebar')

        <div class="flex-1">
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h2 class="font-heading text-xl font-bold text-dark mb-6">My Orders</h2>

                @if($orders->count() > 0)
                    <div class="space-y-4">
                        @foreach($orders as $order)
                            <a href="{{ url('/account/orders/' . $order->id) }}"
                               class="block border border-gray-100 rounded-lg p-4 hover:shadow-md hover:border-primary/20 transition">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div>
                                        <span class="font-semibold text-primary">{{ $order->order_number }}</span>
                                        <span class="text-gray-400 text-sm ml-2">{{ $order->created_at->format('d M Y, h:i A') }}</span>
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
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $statusColors[$order->order_status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </div>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3 mt-3 text-sm text-gray-500">
                                    <span><i class="fas fa-money-bill-wave mr-1"></i> LKR {{ number_format($order->total, 2) }}</span>
                                    <span class="hidden sm:inline text-gray-300">|</span>
                                    <span><i class="fas fa-credit-card mr-1"></i> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Bank Transfer' }}</span>
                                    <span class="hidden sm:inline text-gray-300">|</span>
                                    <span><i class="fas fa-weight-hanging mr-1"></i> {{ number_format($order->total_weight) }}g</span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-box-open text-5xl text-gray-200 mb-4"></i>
                        <h3 class="font-heading text-lg font-semibold text-gray-500">No orders yet</h3>
                        <p class="text-gray-400 mt-1 text-sm">Your order history will appear here.</p>
                        <a href="{{ url('/products') }}" class="inline-block mt-4 bg-primary text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-[#d1405b] transition">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
