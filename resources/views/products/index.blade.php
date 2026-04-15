@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Mars Stationery' : 'Products - Mars Stationery')

@section('content')

{{-- Breadcrumbs --}}
<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            @if(isset($category))
                <a href="{{ url('/products') }}" class="hover:text-primary transition">Products</a>
                <i class="fas fa-chevron-right text-[10px]"></i>
                <span class="text-dark font-medium">{{ $category->name }}</span>
            @else
                <span class="text-dark font-medium">Products</span>
            @endif
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Sidebar --}}
        <aside class="lg:w-64 flex-shrink-0" x-data="{ showFilters: window.innerWidth >= 1024 }">
            <button @click="showFilters = !showFilters" class="lg:hidden w-full bg-white border border-gray-200 rounded-lg px-4 py-3 flex items-center justify-between mb-4">
                <span class="font-medium"><i class="fas fa-filter mr-2"></i> Filters</span>
                <i class="fas fa-chevron-down" :class="showFilters && 'rotate-180'" style="transition: transform 0.2s"></i>
            </button>

            <div :class="showFilters ? 'block' : 'hidden'" class="lg:block space-y-6">
                {{-- Categories --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h3 class="font-heading font-semibold text-dark mb-4">Categories</h3>
                    <div class="space-y-1" x-data="{ openCat: '{{ request('category', '') }}' }">
                        @foreach($categories as $cat)
                            <div>
                                <a href="{{ url('/category/' . $cat->slug) }}"
                                   class="flex items-center justify-between py-2 px-2 rounded-lg text-sm {{ (isset($category) && $category->slug === $cat->slug) ? 'bg-pink-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-xs text-gray-400">({{ $cat->products_count ?? 0 }})</span>
                                </a>
                                @if($cat->children->count() > 0)
                                    <div class="ml-4 space-y-0.5">
                                        @foreach($cat->children as $child)
                                            <a href="{{ url('/category/' . $child->slug) }}"
                                               class="block py-1.5 px-2 rounded text-xs {{ (isset($category) && $category->slug === $child->slug) ? 'text-primary font-semibold' : 'text-gray-500 hover:text-primary' }} transition">
                                                {{ $child->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Price Filter --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h3 class="font-heading font-semibold text-dark mb-4">Price Range</h3>
                    <form method="GET" action="{{ isset($category) ? url('/category/' . $category->slug) : url('/products') }}">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                        @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
                        <div class="flex gap-2 mb-3">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white text-sm py-2 rounded-lg hover:bg-[#d1405b] transition">Apply</button>
                    </form>
                </div>

                {{-- Weight Filter --}}
                <div class="bg-white rounded-xl border border-gray-100 p-5">
                    <h3 class="font-heading font-semibold text-dark mb-4">Weight (grams)</h3>
                    <form method="GET" action="{{ isset($category) ? url('/category/' . $category->slug) : url('/products') }}">
                        @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                        @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                        @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
                        <div class="flex gap-2 mb-3">
                            <input type="number" name="min_weight" value="{{ request('min_weight') }}" placeholder="Min" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            <input type="number" name="max_weight" value="{{ request('max_weight') }}" placeholder="Max" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white text-sm py-2 rounded-lg hover:bg-[#d1405b] transition">Apply</button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Products --}}
        <div class="flex-1">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="font-heading text-2xl font-bold text-dark">
                        {{ isset($category) ? $category->name : (request('filter') === 'new' ? 'New Arrivals' : (request('filter') === 'featured' ? 'Featured Products' : 'All Products')) }}
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} product{{ $products->total() !== 1 ? 's' : '' }} found</p>
                </div>
                <form method="GET" action="{{ isset($category) ? url('/category/' . $category->slug) : url('/products') }}" class="flex items-center gap-2">
                    @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif
                    @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
                    @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                    @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                    <label class="text-sm text-gray-500">Sort by:</label>
                    <select name="sort" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary focus:outline-none bg-white">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    </select>
                </form>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="font-heading text-xl font-semibold text-gray-500">No products found</h3>
                    <p class="text-gray-400 mt-2">Try adjusting your filters or search term</p>
                    <a href="{{ url('/products') }}" class="inline-block mt-4 text-primary hover:underline font-medium">View all products</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
