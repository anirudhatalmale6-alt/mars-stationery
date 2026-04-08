<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('is_admin', false)->count();
        $revenue = Order::where('payment_status', 'paid')->sum('total');

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $lowStockProducts = Product::where('stock_quantity', '<=', 5)->where('is_active', true)->orderBy('stock_quantity')->take(10)->get();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalCustomers', 'revenue', 'recentOrders', 'lowStockProducts'));
    }
}
