@extends('admin.layouts.app')
@section('title', 'Orders')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">All Orders</h2>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-end gap-4">
            <div class="w-48">
                <label class="block text-xs font-medium text-gray-500 mb-1">Order Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-48">
                <label class="block text-xs font-medium text-gray-500 mb-1">Payment Status</label>
                <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="">All</option>
                    @foreach(['pending', 'paid', 'failed', 'refunded'] as $ps)
                        <option value="{{ $ps }}" {{ request('payment_status') == $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium">Filter</button>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700 py-2">Clear</a>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pay Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $order->order_number }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $order->user->name ?? $order->delivery_name }}</td>
                            <td class="px-4 py-3 text-gray-700">LKR {{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                            <td class="px-4 py-3">
                                @php $payColors = ['pending' => 'yellow', 'paid' => 'green', 'failed' => 'red', 'refunded' => 'purple']; @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $payColors[$order->payment_status] ?? 'gray' }}-100 text-{{ $payColors[$order->payment_status] ?? 'gray' }}-800">{{ ucfirst($order->payment_status) }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @php $statusColors = ['pending' => 'yellow', 'processing' => 'blue', 'shipped' => 'purple', 'delivered' => 'green', 'cancelled' => 'red']; @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $statusColors[$order->order_status] ?? 'gray' }}-100 text-{{ $statusColors[$order->order_status] ?? 'gray' }}-800">{{ ucfirst($order->order_status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-8 text-center text-gray-500">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
