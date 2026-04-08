@extends('layouts.app')

@section('title', 'My Account - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">My Account</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar --}}
        @include('account._sidebar')

        {{-- Content --}}
        <div class="flex-1">
            <div class="bg-white rounded-xl border border-gray-100 p-6 mb-6">
                <h2 class="font-heading text-xl font-bold text-dark mb-1">Welcome, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-500 text-sm">Manage your account, view orders, and update your details.</p>
            </div>

            {{-- Quick Links --}}
            <div class="grid md:grid-cols-3 gap-5 mb-8">
                <a href="{{ url('/account/orders') }}" class="bg-white rounded-xl border border-gray-100 p-5 hover:shadow-md hover:border-primary/30 transition group">
                    <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white transition">
                        <i class="fas fa-box text-primary group-hover:text-white text-lg"></i>
                    </div>
                    <h3 class="font-heading font-semibold text-dark">My Orders</h3>
                    <p class="text-sm text-gray-500 mt-1">Track and manage your orders</p>
                </a>
                <a href="{{ url('/account/addresses') }}" class="bg-white rounded-xl border border-gray-100 p-5 hover:shadow-md hover:border-primary/30 transition group">
                    <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white transition">
                        <i class="fas fa-map-marker-alt text-primary group-hover:text-white text-lg"></i>
                    </div>
                    <h3 class="font-heading font-semibold text-dark">Addresses</h3>
                    <p class="text-sm text-gray-500 mt-1">Manage delivery addresses</p>
                </a>
                <a href="{{ url('/account/profile') }}" class="bg-white rounded-xl border border-gray-100 p-5 hover:shadow-md hover:border-primary/30 transition group">
                    <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center mb-3 group-hover:bg-primary group-hover:text-white transition">
                        <i class="fas fa-user-cog text-primary group-hover:text-white text-lg"></i>
                    </div>
                    <h3 class="font-heading font-semibold text-dark">Profile</h3>
                    <p class="text-sm text-gray-500 mt-1">Update your personal info</p>
                </a>
            </div>

            {{-- Recent Orders --}}
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h3 class="font-heading text-lg font-semibold text-dark mb-4">Recent Orders</h3>
                @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-100 text-left">
                                    <th class="pb-3 font-semibold text-gray-500">Order #</th>
                                    <th class="pb-3 font-semibold text-gray-500">Date</th>
                                    <th class="pb-3 font-semibold text-gray-500">Total</th>
                                    <th class="pb-3 font-semibold text-gray-500">Status</th>
                                    <th class="pb-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="py-3 font-medium text-primary">{{ $order->order_number }}</td>
                                        <td class="py-3 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="py-3 font-medium">LKR {{ number_format($order->total, 2) }}</td>
                                        <td class="py-3">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                                    'processing' => 'bg-blue-100 text-blue-700',
                                                    'shipped' => 'bg-purple-100 text-purple-700',
                                                    'delivered' => 'bg-green-100 text-green-700',
                                                    'cancelled' => 'bg-red-100 text-pink-700',
                                                ];
                                            @endphp
                                            <span class="text-xs font-semibold px-2 py-1 rounded {{ $statusColors[$order->order_status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <a href="{{ url('/account/orders/' . $order->id) }}" class="text-primary hover:underline text-xs font-medium">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-400 text-sm">No orders yet. <a href="{{ url('/products') }}" class="text-primary hover:underline">Start shopping!</a></p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
