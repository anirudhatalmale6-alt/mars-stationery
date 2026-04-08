<?php

namespace App\Http\Controllers;

use App\Models\DeliverySetting;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
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

        return view('cart.index', compact('cart', 'totalWeight', 'subtotal', 'deliveryCharge'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::with('images')->findOrFail($request->product_id);
        $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
        $cart = session('cart', []);
        $key = 'product_' . $product->id;

        $effectivePrice = ($product->sale_price && $product->sale_price > 0) ? $product->sale_price : $product->price;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => (float) $effectivePrice,
                'weight' => (int) $product->weight,
                'quantity' => (int) $request->quantity,
                'image' => $primaryImage ? $primaryImage->image_path : null,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session('cart', []);

        if ($request->quantity <= 0) {
            unset($cart[$request->key]);
        } elseif (isset($cart[$request->key])) {
            $cart[$request->key]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $cart = session('cart', []);
        unset($cart[$request->key]);
        session(['cart' => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }
}
