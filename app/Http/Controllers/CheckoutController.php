<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\DeliverySetting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $delivery = DeliverySetting::where('is_active', true)->first();
        $totalWeight = collect($cart)->sum(fn($item) => $item['weight'] * $item['quantity']);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $deliveryCharge = 0;
        if ($delivery && $totalWeight > 0) {
            $kg = ceil($totalWeight / 1000);
            $deliveryCharge = $delivery->first_kg_charge;
            if ($kg > 1) {
                $deliveryCharge += ($kg - 1) * $delivery->additional_kg_charge;
            }
        }

        $addresses = [];
        if (auth()->check()) {
            $addresses = auth()->user()->addresses()->orderByDesc('is_default')->get();
        }

        $settings = SiteSetting::pluck('value', 'key');

        return view('checkout.index', compact('cart', 'totalWeight', 'subtotal', 'deliveryCharge', 'addresses', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_name' => 'required|string|max:255',
            'delivery_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'delivery_city' => 'required|string|max:100',
            'delivery_state' => 'required|string|max:100',
            'delivery_postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $delivery = DeliverySetting::where('is_active', true)->first();
        $totalWeight = collect($cart)->sum(fn($item) => $item['weight'] * $item['quantity']);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $deliveryCharge = 0;
        if ($delivery && $totalWeight > 0) {
            $kg = ceil($totalWeight / 1000);
            $deliveryCharge = $delivery->first_kg_charge;
            if ($kg > 1) {
                $deliveryCharge += ($kg - 1) * $delivery->additional_kg_charge;
            }
        }

        $orderNumber = 'MARS-' . strtoupper(Str::random(8));

        // Save address if logged in and requested
        if (auth()->check() && $request->save_address) {
            Address::create([
                'user_id' => auth()->id(),
                'label' => 'Delivery Address',
                'name' => $request->delivery_name,
                'phone' => $request->delivery_phone,
                'address_line_1' => $request->delivery_address,
                'address_line_2' => $request->input('delivery_address_2', ''),
                'city' => $request->delivery_city,
                'state' => $request->delivery_state,
                'postal_code' => $request->delivery_postal_code,
                'country' => 'Sri Lanka',
                'is_default' => false,
            ]);
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'delivery_name' => $request->delivery_name,
            'delivery_phone' => $request->delivery_phone,
            'delivery_address' => $request->delivery_address . ($request->delivery_address_2 ? ', ' . $request->delivery_address_2 : ''),
            'delivery_city' => $request->delivery_city,
            'delivery_state' => $request->delivery_state,
            'delivery_postal_code' => $request->delivery_postal_code,
            'subtotal' => $subtotal,
            'delivery_charge' => $deliveryCharge,
            'total' => $subtotal + $deliveryCharge,
            'total_weight' => $totalWeight,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'payment_pending',
            'notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'weight' => $item['weight'] * $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect('/order-confirmation/' . $order->id)->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        $order->load('items');
        $settings = SiteSetting::pluck('value', 'key');

        return view('checkout.confirmation', compact('order', 'settings'));
    }

    public function uploadReceipt(Request $request, Order $order)
    {
        $request->validate([
            'receipt' => 'required|image|max:5120',
        ]);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts', 'public');
            $order->update(['bank_receipt_image' => $path]);
        }

        return back()->with('success', 'Bank receipt uploaded successfully!');
    }
}
