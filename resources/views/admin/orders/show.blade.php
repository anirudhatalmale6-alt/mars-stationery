@extends('admin.layouts.app')
@section('title', 'Order ' . $order->order_number)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Orders</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Order Details --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Items --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Order Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Weight</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $item->product_name }}</td>
                                    <td class="px-4 py-3 text-gray-700">LKR {{ number_format($item->product_price, 2) }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $item->weight }}g</td>
                                    <td class="px-4 py-3 text-right text-gray-700">LKR {{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-right text-sm text-gray-600">Subtotal:</td>
                                <td class="px-4 py-2 text-right font-medium">LKR {{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-right text-sm text-gray-600">Delivery ({{ $order->total_weight }}g):</td>
                                <td class="px-4 py-2 text-right font-medium">LKR {{ number_format($order->delivery_charge, 2) }}</td>
                            </tr>
                            <tr class="border-t border-gray-300">
                                <td colspan="4" class="px-4 py-2 text-right text-sm font-bold text-gray-800">Total:</td>
                                <td class="px-4 py-2 text-right font-bold text-red-600 text-lg">LKR {{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Delivery Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delivery Information</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div><span class="text-gray-500">Name:</span> <span class="text-gray-900 font-medium ml-1">{{ $order->delivery_name }}</span></div>
                    <div><span class="text-gray-500">Phone:</span> <span class="text-gray-900 font-medium ml-1">{{ $order->delivery_phone }}</span></div>
                    <div class="col-span-2"><span class="text-gray-500">Address:</span> <span class="text-gray-900 font-medium ml-1">{{ $order->delivery_address }}, {{ $order->delivery_city }}, {{ $order->delivery_state }} {{ $order->delivery_postal_code }}</span></div>
                </div>
            </div>

            {{-- Bank Receipt --}}
            @if($order->bank_receipt_image)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Bank Transfer Receipt</h3>
                    <img src="{{ asset('storage/' . $order->bank_receipt_image) }}" alt="Bank receipt" class="max-w-md rounded-lg border border-gray-200">
                </div>
            @endif

            {{-- Notes --}}
            @if($order->notes)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Customer Notes</h3>
                    <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Order Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Info</h3>
                <dl class="space-y-3 text-sm">
                    <div><dt class="text-gray-500">Order Number</dt><dd class="font-bold text-gray-900">{{ $order->order_number }}</dd></div>
                    <div><dt class="text-gray-500">Customer</dt><dd class="font-medium text-gray-900">{{ $order->user->name ?? 'N/A' }}</dd></div>
                    <div><dt class="text-gray-500">Email</dt><dd class="text-gray-900">{{ $order->user->email ?? 'N/A' }}</dd></div>
                    <div><dt class="text-gray-500">Date</dt><dd class="text-gray-900">{{ $order->created_at->format('d M Y, h:i A') }}</dd></div>
                    <div><dt class="text-gray-500">Payment Method</dt><dd class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</dd></div>
                </dl>
            </div>

            {{-- Update Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Order Status</label>
                        <select name="order_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->order_status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                        <select name="payment_status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            @foreach(['pending', 'paid', 'failed', 'refunded'] as $ps)
                                <option value="{{ $ps }}" {{ $order->payment_status == $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
