<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderStatusUpdated;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'address']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'order_status' => 'nullable|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'nullable|string|in:pending,paid,failed,refunded',
        ]);

        $email = $order->user?->email ?? null;

        if ($request->filled('order_status') && $order->order_status !== $validated['order_status']) {
            $oldStatus = $order->order_status;
            $order->order_status = $validated['order_status'];

            if ($email) {
                Mail::to($email)->send(new OrderStatusUpdated($order, 'order', $oldStatus, $validated['order_status']));
            }
        }

        if ($request->filled('payment_status') && $order->payment_status !== $validated['payment_status']) {
            $oldStatus = $order->payment_status;
            $order->payment_status = $validated['payment_status'];

            if ($email) {
                Mail::to($email)->send(new OrderStatusUpdated($order, 'payment', $oldStatus, $validated['payment_status']));
            }
        }

        $order->save();

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }
}
