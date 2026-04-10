<?php

namespace App\Http\Controllers;

use App\Models\BulkInquiry;
use App\Models\BulkInquiryItem;
use App\Models\Product;
use Illuminate\Http\Request;

class BulkInquiryController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->orderBy('name')->get(['id', 'name', 'sku', 'price']);
        return view('bulk-inquiry', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'message' => 'nullable|string|max:2000',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $inquiry = BulkInquiry::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'delivery_address' => $request->delivery_address,
            'message' => $request->message,
            'status' => 'new',
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            BulkInquiryItem::create([
                'bulk_inquiry_id' => $inquiry->id,
                'product_id' => $item['product_id'],
                'product_name' => $product->name,
                'quantity' => $item['quantity'],
            ]);
        }

        return back()->with('success', 'Your bulk inquiry has been submitted! We will contact you soon.');
    }

    public function productInquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'message' => 'nullable|string|max:2000',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $inquiry = BulkInquiry::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'delivery_address' => $request->delivery_address,
            'message' => $request->message,
            'status' => 'new',
        ]);

        BulkInquiryItem::create([
            'bulk_inquiry_id' => $inquiry->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Your inquiry has been submitted! We will contact you shortly.');
    }
}
