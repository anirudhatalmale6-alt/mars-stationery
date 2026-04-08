<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $categories = Category::whereNull('parent_id')->where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $featured = Product::where('is_active', true)->where('is_featured', true)->with(['images', 'category'])->take(12)->get();
        $newArrivals = Product::where('is_active', true)->where('is_new_arrival', true)->with(['images', 'category'])->latest()->take(8)->get();
        $bestSellers = Product::where('is_active', true)->with(['images', 'category'])->inRandomOrder()->take(8)->get();
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();
        $dealProduct = Product::where('is_active', true)->where('sale_price', '>', 0)->with(['images', 'category'])->inRandomOrder()->first();
        $topCategories = Category::whereNull('parent_id')->where('is_active', true)->withCount('products')->orderByDesc('products_count')->take(4)->get();

        return view('home', compact('banners', 'categories', 'featured', 'newArrivals', 'bestSellers', 'brands', 'dealProduct', 'topCategories'));
    }
}
