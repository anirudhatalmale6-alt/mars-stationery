<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['images', 'category']);

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%')
                  ->orWhere('sku', 'like', '%' . $request->q . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $cat = Category::where('slug', $request->category)->first();
            if ($cat) {
                $catIds = [$cat->id];
                $childIds = Category::where('parent_id', $cat->id)->pluck('id')->toArray();
                $catIds = array_merge($catIds, $childIds);
                $query->whereIn('category_id', $catIds);
            }
        }

        // Filter presets
        if ($request->filter === 'new') {
            $query->where('is_new_arrival', true);
        } elseif ($request->filter === 'featured') {
            $query->where('is_featured', true);
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $q->where('sale_price', '>=', $request->min_price)
                  ->orWhere(function ($q2) use ($request) {
                      $q2->whereNull('sale_price')->where('price', '>=', $request->min_price);
                  });
            });
        }
        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('sale_price', '>', 0)->where('sale_price', '<=', $request->max_price);
                })->orWhere(function ($q2) use ($request) {
                    $q2->where(function ($q3) {
                        $q3->whereNull('sale_price')->orWhere('sale_price', 0);
                    })->where('price', '<=', $request->max_price);
                });
            });
        }

        // Weight filter
        if ($request->filled('min_weight')) {
            $query->where('weight', '>=', $request->min_weight);
        }
        if ($request->filled('max_weight')) {
            $query->where('weight', '<=', $request->max_weight);
        }

        // Sort
        switch ($request->sort) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) DESC');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::whereNull('parent_id')->where('is_active', true)->with('children')->withCount('products')->orderBy('sort_order')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->with(['images', 'category'])->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with(['images', 'category'])
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $catIds = [$category->id];
        $childIds = Category::where('parent_id', $category->id)->pluck('id')->toArray();
        $catIds = array_merge($catIds, $childIds);

        $query = Product::whereIn('category_id', $catIds)->where('is_active', true)->with(['images', 'category']);

        $sort = request('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(NULLIF(sale_price, 0), price) DESC');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::whereNull('parent_id')->where('is_active', true)->with('children')->withCount('products')->orderBy('sort_order')->get();

        return view('products.index', compact('products', 'categories', 'category'));
    }
}
