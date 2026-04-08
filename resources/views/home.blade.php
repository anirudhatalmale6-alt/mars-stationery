@extends('layouts.app')

@section('title', 'Mars Stationery - Your One-Stop Stationery Shop')

@section('content')

{{-- Hero Slider --}}
<section x-data="{ current: 0, slides: {{ $banners->count() > 0 ? $banners->count() : 3 }} }"
         x-init="setInterval(() => current = (current + 1) % slides, 5000)"
         class="relative overflow-hidden bg-gray-100">
    <div class="relative" style="height: 500px;">
        @if($banners->count() > 0)
            @foreach($banners as $i => $banner)
                <div x-show="current === {{ $i }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0 transform translate-x-full"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <div class="h-full flex items-center"
                         style="background: linear-gradient(135deg, {{ $i % 2 === 0 ? '#DC2626' : '#1a1a1a' }} 0%, {{ $i % 2 === 0 ? '#991b1b' : '#374151' }} 100%);">
                        <div class="max-w-7xl mx-auto px-4 w-full">
                            <div class="max-w-lg text-white">
                                <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4 animate-pulse">{{ $banner->title }}</h2>
                                <p class="text-lg mb-6 text-white/80">{{ $banner->subtitle }}</p>
                                <a href="{{ $banner->link ?? '/products' }}"
                                   class="inline-block bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                                    Shop Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @php $defaultSlides = [
                ['title' => 'Premium Stationery Collection', 'subtitle' => 'Discover our wide range of quality stationery products for office and school', 'bg' => '#DC2626', 'bg2' => '#991b1b'],
                ['title' => 'Back to School Essentials', 'subtitle' => 'Everything you need for the new school year at unbeatable prices', 'bg' => '#1a1a1a', 'bg2' => '#374151'],
                ['title' => 'Office Supplies Sale', 'subtitle' => 'Up to 40% off on selected office supplies. Limited time offer!', 'bg' => '#DC2626', 'bg2' => '#7f1d1d'],
            ]; @endphp
            @foreach($defaultSlides as $i => $slide)
                <div x-show="current === {{ $i }}"
                     x-transition:enter="transition ease-out duration-700"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0">
                    <div class="h-full flex items-center" style="background: linear-gradient(135deg, {{ $slide['bg'] }} 0%, {{ $slide['bg2'] }} 100%);">
                        <div class="max-w-7xl mx-auto px-4 w-full">
                            <div class="max-w-lg text-white">
                                <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">{{ $slide['title'] }}</h2>
                                <p class="text-lg mb-6 text-white/80">{{ $slide['subtitle'] }}</p>
                                <a href="{{ url('/products') }}" class="inline-block bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105">
                                    Shop Now <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{-- Dots --}}
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-2">
        <template x-for="i in slides" :key="i">
            <button @click="current = i - 1"
                    :class="current === i - 1 ? 'bg-white w-8' : 'bg-white/50 w-3'"
                    class="h-3 rounded-full transition-all duration-300"></button>
        </template>
    </div>
    {{-- Arrows --}}
    <button @click="current = (current - 1 + slides) % slides" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button @click="current = (current + 1) % slides" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/40 rounded-full flex items-center justify-center text-white transition">
        <i class="fas fa-chevron-right"></i>
    </button>
</section>

{{-- Category Grid --}}
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="font-heading text-3xl font-bold text-dark">Shop by Category</h2>
            <p class="text-gray-500 mt-2">Browse our wide range of stationery categories</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            @foreach($categories as $cat)
                <a href="{{ url('/category/' . $cat->slug) }}"
                   class="group relative rounded-xl overflow-hidden aspect-square bg-gray-100">
                    @if($cat->image)
                        <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             onerror="this.style.display='none'">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent group-hover:from-primary/80 transition-all duration-300"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <h3 class="font-heading font-semibold text-sm">{{ $cat->name }}</h3>
                    </div>
                </a>
            @endforeach
            @if($categories->count() < 6)
                @for($i = $categories->count(); $i < 6; $i++)
                    @php $placeholderCats = ['Notebooks', 'Pens', 'Art Supplies', 'Files', 'Paper', 'Office']; @endphp
                    <a href="{{ url('/products') }}" class="group relative rounded-xl overflow-hidden aspect-square bg-gradient-to-br from-gray-200 to-gray-300">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-folder text-4xl text-gray-400 group-hover:text-primary transition"></i>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h3 class="font-heading font-semibold text-sm">{{ $placeholderCats[$i] ?? 'Category' }}</h3>
                        </div>
                    </a>
                @endfor
            @endif
        </div>
    </div>
</section>

{{-- Featured Products Carousel --}}
@if($featured->count() > 0)
<section class="py-14 bg-light">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="font-heading text-3xl font-bold text-dark">Featured Products</h2>
                <p class="text-gray-500 mt-1">Hand-picked products just for you</p>
            </div>
            <a href="{{ url('/products?filter=featured') }}" class="text-primary hover:underline font-medium text-sm">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div x-data="{ scrollEl: null }" x-init="scrollEl = $refs.carousel" class="relative">
            <div x-ref="carousel" class="flex gap-5 overflow-x-auto scrollbar-hide scroll-smooth pb-4">
                @foreach($featured as $product)
                    <div class="min-w-[250px] max-w-[250px] flex-shrink-0">
                        @include('components.product-card', ['product' => $product])
                    </div>
                @endforeach
            </div>
            <button @click="scrollEl.scrollBy({ left: -280, behavior: 'smooth' })"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:text-primary transition z-10">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button @click="scrollEl.scrollBy({ left: 280, behavior: 'smooth' })"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-10 h-10 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:text-primary transition z-10">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>
@endif

{{-- Promotional Banners --}}
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-6">
            <a href="{{ url('/products?filter=featured') }}" class="relative rounded-2xl overflow-hidden group" style="min-height: 220px;">
                <div class="absolute inset-0 bg-gradient-to-r from-primary to-red-700"></div>
                <div class="relative p-8 md:p-10 flex flex-col justify-center h-full text-white">
                    <span class="text-sm font-medium text-red-200 uppercase tracking-wider">Limited Offer</span>
                    <h3 class="font-heading text-2xl md:text-3xl font-bold mt-2">Up to 50% Off<br>Office Supplies</h3>
                    <p class="mt-2 text-red-100 text-sm">Shop now and save big on essential supplies</p>
                    <span class="inline-flex items-center gap-2 mt-4 font-semibold text-sm group-hover:gap-3 transition-all">
                        Shop Now <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>
            <a href="{{ url('/products?filter=new') }}" class="relative rounded-2xl overflow-hidden group" style="min-height: 220px;">
                <div class="absolute inset-0 bg-gradient-to-r from-dark to-gray-700"></div>
                <div class="relative p-8 md:p-10 flex flex-col justify-center h-full text-white">
                    <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Just Arrived</span>
                    <h3 class="font-heading text-2xl md:text-3xl font-bold mt-2">New Stationery<br>Collection</h3>
                    <p class="mt-2 text-gray-300 text-sm">Explore the latest additions to our store</p>
                    <span class="inline-flex items-center gap-2 mt-4 font-semibold text-sm group-hover:gap-3 transition-all">
                        Explore Now <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- New Arrivals --}}
@if($newArrivals->count() > 0)
<section class="py-14 bg-light">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="font-heading text-3xl font-bold text-dark">New Arrivals</h2>
                <p class="text-gray-500 mt-1">Check out what's new in store</p>
            </div>
            <a href="{{ url('/products?filter=new') }}" class="text-primary hover:underline font-medium text-sm">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($newArrivals->take(8) as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Deal of the Day --}}
@if($dealProduct)
<section class="py-14 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="font-heading text-3xl font-bold text-dark">Deal of the Day</h2>
            <p class="text-gray-500 mt-1">Hurry up! This offer won't last forever</p>
        </div>
        <div class="bg-light rounded-2xl p-6 md:p-10 flex flex-col md:flex-row items-center gap-8">
            @php
                $dealImage = $dealProduct->images->where('is_primary', true)->first() ?? $dealProduct->images->first();
                $dealImgUrl = $dealImage ? asset('storage/' . $dealImage->image_path) : 'https://placehold.co/500x500/f5f5f5/999?text=' . urlencode($dealProduct->name);
            @endphp
            <div class="md:w-1/2">
                <img src="{{ $dealImgUrl }}" alt="{{ $dealProduct->name }}"
                     class="w-full max-w-md mx-auto rounded-xl"
                     onerror="this.src='https://placehold.co/500x500/f5f5f5/999?text=No+Image'">
            </div>
            <div class="md:w-1/2">
                @if($dealProduct->category)
                    <span class="text-xs text-primary font-semibold uppercase tracking-wider">{{ $dealProduct->category->name }}</span>
                @endif
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-dark mt-2">{{ $dealProduct->name }}</h3>
                <div class="flex items-center gap-1 mt-2">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                    @endfor
                    <span class="text-gray-400 text-sm ml-1">(4.8)</span>
                </div>
                <div class="flex items-center gap-3 mt-4">
                    <span class="text-3xl font-bold text-primary">LKR {{ number_format($dealProduct->sale_price, 2) }}</span>
                    <span class="text-xl text-gray-400 line-through">LKR {{ number_format($dealProduct->price, 2) }}</span>
                </div>
                <p class="text-gray-500 mt-3 text-sm leading-relaxed">{{ Str::limit($dealProduct->description, 150) }}</p>

                {{-- Countdown --}}
                <div x-data="countdown()" x-init="start()" class="flex gap-3 mt-6">
                    <div class="bg-primary text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center">
                        <span x-text="hours" class="text-xl font-bold">00</span>
                        <span class="text-[9px] uppercase">Hours</span>
                    </div>
                    <div class="bg-primary text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center">
                        <span x-text="minutes" class="text-xl font-bold">00</span>
                        <span class="text-[9px] uppercase">Mins</span>
                    </div>
                    <div class="bg-primary text-white rounded-lg w-16 h-16 flex flex-col items-center justify-center">
                        <span x-text="seconds" class="text-xl font-bold">00</span>
                        <span class="text-[9px] uppercase">Secs</span>
                    </div>
                </div>

                <form action="{{ url('/cart/add') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $dealProduct->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="bg-primary hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Best Sellers Tabs --}}
@if($bestSellers->count() > 0)
<section class="py-14 bg-light" x-data="{ activeTab: 'all' }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="font-heading text-3xl font-bold text-dark">Best Sellers</h2>
            <p class="text-gray-500 mt-1">Our most popular products</p>
        </div>
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                    class="px-5 py-2 rounded-full text-sm font-medium transition">All</button>
            @foreach($topCategories as $tc)
                <button @click="activeTab = '{{ $tc->slug }}'" :class="activeTab === '{{ $tc->slug }}' ? 'bg-primary text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition">{{ $tc->name }}</button>
            @endforeach
        </div>
        <div x-show="activeTab === 'all'" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($bestSellers->take(8) as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        @foreach($topCategories as $tc)
            <div x-show="activeTab === '{{ $tc->slug }}'" x-cloak class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @php
                    $catProducts = \App\Models\Product::where('category_id', $tc->id)->where('is_active', true)->with(['images', 'category'])->take(8)->get();
                @endphp
                @foreach($catProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
                @if($catProducts->count() === 0)
                    <div class="col-span-full text-center py-10 text-gray-400">No products in this category yet.</div>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- Brand Logos --}}
@if($brands->count() > 0)
<section class="py-12 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h3 class="font-heading text-center text-lg font-semibold text-gray-400 mb-8">Trusted Brands We Carry</h3>
        <div class="flex items-center justify-center gap-10 flex-wrap opacity-60">
            @foreach($brands as $brand)
                <div class="flex items-center justify-center h-12" title="{{ $brand->name }}">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-full object-contain"
                             onerror="this.parentElement.innerHTML='<span class=\'font-heading font-bold text-xl text-gray-400\'>{{ $brand->name }}</span>'">
                    @else
                        <span class="font-heading font-bold text-xl text-gray-400">{{ $brand->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
function countdown() {
    return {
        hours: '00', minutes: '00', seconds: '00',
        start() {
            const endOfDay = new Date();
            endOfDay.setHours(23, 59, 59, 999);
            const update = () => {
                const now = new Date();
                let diff = Math.max(0, Math.floor((endOfDay - now) / 1000));
                this.hours = String(Math.floor(diff / 3600)).padStart(2, '0');
                this.minutes = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
                this.seconds = String(diff % 60).padStart(2, '0');
            };
            update();
            setInterval(update, 1000);
        }
    };
}
</script>
@endpush
