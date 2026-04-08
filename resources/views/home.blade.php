@extends('layouts.app')

@section('title', 'Mars Stationery - Your One-Stop Stationery Shop')

@section('content')

{{-- Section 1: Hero Banner Area --}}
<section class="py-4 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4" style="min-height: 420px;">
            {{-- Main Large Banner (left 60%) --}}
            <div class="lg:col-span-3 relative rounded-2xl overflow-hidden group cursor-pointer" style="min-height: 420px;">
                <div class="absolute inset-0" style="background: linear-gradient(135deg, #f8e8f0 0%, #ede4f5 50%, #e8e0f8 100%);"></div>
                <div class="relative h-full flex items-center p-8 md:p-12">
                    <div class="max-w-sm">
                        <p class="text-muted text-sm uppercase tracking-widest mb-2">Mix & Match</p>
                        <h1 class="text-3xl md:text-4xl lg:text-[42px] font-bold text-navy leading-tight mb-6">With Our<br>3 For 2<br>Stationery</h1>
                        <a href="{{ url('/products') }}" class="inline-flex items-center gap-2 bg-primary text-white px-7 py-3.5 rounded-full font-medium text-sm hover:bg-pink-600 transition-all group-hover:gap-3">
                            SHOP NOW <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Right Column (2 stacked banners) --}}
            <div class="lg:col-span-2 flex flex-col gap-4">
                {{-- Top right banner --}}
                <a href="{{ url('/products') }}" class="relative rounded-2xl overflow-hidden group flex-1 cursor-pointer" style="min-height: 200px;">
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, #fdf2e9 0%, #fce4d2 100%);"></div>
                    <div class="relative h-full flex items-center p-6 md:p-8">
                        <div>
                            <p class="text-navy text-lg font-bold">Metal Pens</p>
                            <p class="text-primary font-bold text-xl mt-1">15% Off</p>
                            <span class="inline-flex items-center gap-1 text-navy text-sm font-medium mt-3 group-hover:text-primary transition">
                                Shop Now <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Bottom right banner --}}
                <a href="{{ url('/products') }}" class="relative rounded-2xl overflow-hidden group flex-1 cursor-pointer" style="min-height: 200px;">
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, #e8f4f0 0%, #d5ede6 100%);"></div>
                    <div class="relative h-full flex items-center p-6 md:p-8">
                        <div>
                            <p class="text-navy text-lg font-bold">Office Adhesive / Tape</p>
                            <p class="text-muted text-sm mt-1">From <span class="text-primary font-bold text-lg">$12.99</span></p>
                            <span class="inline-flex items-center gap-1 text-navy text-sm font-medium mt-3 group-hover:text-primary transition">
                                Shop Now <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Section 2: Trust Badges Strip --}}
<section class="border-y border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-light flex items-center justify-center text-primary flex-shrink-0">
                    <i class="fas fa-truck text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-navy text-sm">Fast Delivery</h4>
                    <p class="text-muted text-xs mt-0.5">Across Sri Lanka</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-light flex items-center justify-center text-primary flex-shrink-0">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-navy text-sm">Safe Payments</h4>
                    <p class="text-muted text-xs mt-0.5">100% Secure</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-light flex items-center justify-center text-primary flex-shrink-0">
                    <i class="fas fa-tags text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-navy text-sm">Discount Coupons</h4>
                    <p class="text-muted text-xs mt-0.5">Best Prices</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-light flex items-center justify-center text-primary flex-shrink-0">
                    <i class="fas fa-headset text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-navy text-sm">Quality Support</h4>
                    <p class="text-muted text-xs mt-0.5">24/7 Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section 3: Product Tabs - "Cute Stationery" --}}
@if($featured->count() > 0 || $newArrivals->count() > 0 || $bestSellers->count() > 0)
<section class="py-16 bg-white" x-data="{ activeTab: 'deals' }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-navy">Cute Stationery</h2>
        </div>

        {{-- Tab Buttons --}}
        <div class="flex flex-wrap justify-center gap-6 md:gap-8 mb-10 border-b border-gray-200 pb-0">
            <button @click="activeTab = 'deals'"
                    :class="activeTab === 'deals' ? 'text-primary border-primary' : 'text-muted border-transparent hover:text-navy'"
                    class="pb-3 border-b-2 text-sm font-semibold uppercase tracking-wider transition">Deals</button>
            @foreach($topCategories->take(4) as $tc)
                <button @click="activeTab = '{{ $tc->slug }}'"
                        :class="activeTab === '{{ $tc->slug }}' ? 'text-primary border-primary' : 'text-muted border-transparent hover:text-navy'"
                        class="pb-3 border-b-2 text-sm font-semibold uppercase tracking-wider transition">{{ $tc->name }}</button>
            @endforeach
        </div>

        {{-- Deals Tab (Featured Products) --}}
        <div x-show="activeTab === 'deals'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                @foreach($featured->take(5) as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
                @if($featured->count() < 5)
                    @foreach($newArrivals->take(5 - $featured->count()) as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Category Tabs --}}
        @foreach($topCategories->take(4) as $tc)
            <div x-show="activeTab === '{{ $tc->slug }}'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                @php
                    $catProducts = \App\Models\Product::where('category_id', $tc->id)->where('is_active', true)->with(['images', 'category'])->take(5)->get();
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
                    @foreach($catProducts as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                    @if($catProducts->count() === 0)
                        <div class="col-span-full text-center py-12 text-muted">No products in this category yet.</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

{{-- Section 4: Shop By Categories --}}
<section class="py-16 bg-light">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-navy">Shop By Categories</h2>
            <p class="text-muted mt-2">Browse our curated stationery collections</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4" style="min-height: 500px;">
            @php
                $catBgs = ['#f8e8f0', '#fdf2e9', '#e8f4f0', '#ede4f5'];
                $catLabels = ['Books & Stationery', 'Pens & Pencils', 'Paper & Card', 'School Supplies'];
                $displayCats = $categories->take(4);
            @endphp

            {{-- Left tall card --}}
            <div class="relative rounded-2xl overflow-hidden group cursor-pointer" style="min-height: 500px;">
                @if($displayCats->count() > 0)
                    @php $c = $displayCats[0]; @endphp
                    <a href="{{ url('/category/' . $c->slug) }}" class="block h-full">
                @else
                    <a href="{{ url('/products') }}" class="block h-full">
                @endif
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $catBgs[0] }}, #f0d4e4);"></div>
                    @if(isset($c) && $c->image)
                        <img src="{{ asset('storage/' . $c->image) }}" alt="{{ $c->name ?? '' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" onerror="this.style.display='none'">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="bg-white/90 backdrop-blur-sm text-navy text-sm font-semibold px-5 py-2 rounded-full">
                            {{ isset($c) ? $c->name : $catLabels[0] }}
                        </span>
                    </div>
                </a>
            </div>

            {{-- Center 2 stacked --}}
            <div class="flex flex-col gap-4">
                @for($ci = 1; $ci <= 2; $ci++)
                    <div class="relative rounded-2xl overflow-hidden group cursor-pointer flex-1" style="min-height: 240px;">
                        @if($displayCats->count() > $ci)
                            @php $c2 = $displayCats[$ci]; @endphp
                            <a href="{{ url('/category/' . $c2->slug) }}" class="block h-full">
                        @else
                            <a href="{{ url('/products') }}" class="block h-full">
                        @endif
                            <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $catBgs[$ci] }}, {{ $ci === 1 ? '#fce4d2' : '#d5ede6' }});"></div>
                            @if(isset($c2) && $c2->image)
                                <img src="{{ asset('storage/' . $c2->image) }}" alt="{{ $c2->name ?? '' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" onerror="this.style.display='none'">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5">
                                <span class="bg-white/90 backdrop-blur-sm text-navy text-sm font-semibold px-5 py-2 rounded-full">
                                    {{ isset($c2) ? $c2->name : $catLabels[$ci] }}
                                </span>
                            </div>
                        </a>
                    </div>
                    @php unset($c2); @endphp
                @endfor
            </div>

            {{-- Right tall card --}}
            <div class="relative rounded-2xl overflow-hidden group cursor-pointer" style="min-height: 500px;">
                @if($displayCats->count() > 3)
                    @php $c3 = $displayCats[3]; @endphp
                    <a href="{{ url('/category/' . $c3->slug) }}" class="block h-full">
                @else
                    <a href="{{ url('/products') }}" class="block h-full">
                @endif
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $catBgs[3] }}, #d8ccf0);"></div>
                    @if(isset($c3) && $c3->image)
                        <img src="{{ asset('storage/' . $c3->image) }}" alt="{{ $c3->name ?? '' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" onerror="this.style.display='none'">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span class="bg-white/90 backdrop-blur-sm text-navy text-sm font-semibold px-5 py-2 rounded-full">
                            {{ isset($c3) ? $c3->name : $catLabels[3] }}
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Section 5: Best Sellers --}}
@if($bestSellers->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-navy">Best Sellers</h2>
            <p class="text-muted mt-2">Our most popular products loved by customers</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            @foreach($bestSellers->take(5) as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ url('/products') }}" class="inline-flex items-center gap-2 border-2 border-navy text-navy px-8 py-3 rounded-full font-medium text-sm hover:bg-navy hover:text-white transition-all">
                View All Products <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- Section 6: Deal Of The Day --}}
@if($dealProduct)
<section class="py-16 bg-navy relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            {{-- Left Side --}}
            <div class="text-white">
                <p class="text-primary text-sm uppercase tracking-widest font-medium mb-3">Limited Time Offer</p>
                <h2 class="text-3xl md:text-4xl font-bold mb-3">Deal Of The Day</h2>
                <p class="text-gray-400 mb-8 leading-relaxed">{{ Str::limit($dealProduct->description, 120) }}</p>

                {{-- Countdown Timer --}}
                <div x-data="countdown()" x-init="start()" class="flex gap-3 mb-8">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl w-20 h-20 flex flex-col items-center justify-center border border-white/10">
                        <span x-text="days" class="text-2xl font-bold text-white">00</span>
                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Days</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl w-20 h-20 flex flex-col items-center justify-center border border-white/10">
                        <span x-text="hours" class="text-2xl font-bold text-white">00</span>
                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Hours</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl w-20 h-20 flex flex-col items-center justify-center border border-white/10">
                        <span x-text="minutes" class="text-2xl font-bold text-white">00</span>
                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Minutes</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl w-20 h-20 flex flex-col items-center justify-center border border-white/10">
                        <span x-text="seconds" class="text-2xl font-bold text-white">00</span>
                        <span class="text-[10px] uppercase text-gray-400 tracking-wider">Seconds</span>
                    </div>
                </div>

                <a href="{{ url('/products/' . $dealProduct->slug) }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3.5 rounded-full font-medium text-sm hover:bg-pink-600 transition-all">
                    Shop Now <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Right Side: Product Images --}}
            <div class="relative flex items-center justify-center">
                @php
                    $dealImage = $dealProduct->images->where('is_primary', true)->first() ?? $dealProduct->images->first();
                    $dealImgUrl = $dealImage ? asset('storage/' . $dealImage->image_path) : 'https://placehold.co/500x500/01213A/E84F69?text=' . urlencode($dealProduct->name);
                @endphp
                <div class="relative">
                    <div class="absolute -inset-8 bg-primary/10 rounded-full blur-3xl"></div>
                    <img src="{{ $dealImgUrl }}" alt="{{ $dealProduct->name }}"
                         class="relative w-72 h-72 md:w-96 md:h-96 object-contain drop-shadow-2xl"
                         onerror="this.src='https://placehold.co/500x500/01213A/E84F69?text=No+Image'">
                    <div class="absolute -bottom-4 -right-4 bg-primary text-white rounded-2xl p-4 shadow-xl">
                        <p class="text-xs text-pink-200 line-through">LKR {{ number_format($dealProduct->price, 2) }}</p>
                        <p class="text-xl font-bold">LKR {{ number_format($dealProduct->sale_price ?? $dealProduct->price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Section 7: 3-Column Promo Cards --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $promos = [
                    ['title' => 'Notebooks & Pens', 'desc' => 'Premium writing essentials for everyday use', 'bg' => '#f8e8f0', 'icon' => 'fas fa-book'],
                    ['title' => 'Back to School', 'desc' => 'Everything students need to succeed', 'bg' => '#e8f4f0', 'icon' => 'fas fa-graduation-cap'],
                    ['title' => 'Birthday Cards', 'desc' => 'Unique cards for every special occasion', 'bg' => '#fdf2e9', 'icon' => 'fas fa-gift'],
                ];
            @endphp
            @foreach($promos as $promo)
                <a href="{{ url('/products') }}" class="group relative rounded-2xl overflow-hidden" style="min-height: 280px;">
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, {{ $promo['bg'] }}, {{ $promo['bg'] }}dd);"></div>
                    <div class="relative h-full flex flex-col justify-between p-8">
                        <div class="w-16 h-16 rounded-full bg-white/50 flex items-center justify-center mb-auto">
                            <i class="{{ $promo['icon'] }} text-2xl text-navy"></i>
                        </div>
                        <div class="mt-auto">
                            <h3 class="text-xl font-bold text-navy mb-2">{{ $promo['title'] }}</h3>
                            <p class="text-muted text-sm mb-4">{{ $promo['desc'] }}</p>
                            <span class="inline-flex items-center gap-2 text-navy text-sm font-semibold group-hover:text-primary group-hover:gap-3 transition-all">
                                Shop Now <i class="fas fa-arrow-right text-xs"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Section 8: Testimonials --}}
<section class="py-16 bg-light" x-data="{ activeSlide: 0 }">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-navy mb-12">Our Customers Say</h2>

        @php
            $testimonials = [
                ['quote' => 'Amazing quality stationery! I ordered notebooks and pens for my entire office and everyone loved them. The delivery was super fast too.', 'name' => 'Sarah Fernando', 'role' => 'Office Manager'],
                ['quote' => 'My go-to shop for all school supplies. The prices are unbeatable and the variety is incredible. Highly recommend Mars Stationery!', 'name' => 'Dinesh Perera', 'role' => 'Teacher'],
                ['quote' => 'Beautiful packaging, premium products, and excellent customer service. I keep coming back for more art supplies every month.', 'name' => 'Amaya Silva', 'role' => 'Artist'],
            ];
        @endphp

        <div class="relative">
            @foreach($testimonials as $i => $t)
                <div x-show="activeSlide === {{ $i }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <div class="text-primary text-6xl mb-6 leading-none">&ldquo;</div>
                    <p class="text-lg md:text-xl text-muted italic leading-relaxed max-w-2xl mx-auto mb-8">{{ $t['quote'] }}</p>
                    <h4 class="font-bold text-navy text-lg">{{ $t['name'] }}</h4>
                    <p class="text-muted text-sm mt-1">{{ $t['role'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Dots --}}
        <div class="flex justify-center gap-2 mt-8">
            @foreach($testimonials as $i => $t)
                <button @click="activeSlide = {{ $i }}"
                        :class="activeSlide === {{ $i }} ? 'bg-primary w-8' : 'bg-gray-300 w-3'"
                        class="h-3 rounded-full transition-all duration-300"></button>
            @endforeach
        </div>
    </div>
</section>

{{-- Section 9: Instagram Gallery --}}
<section class="overflow-hidden">
    <div class="grid grid-cols-3 md:grid-cols-5">
        @php
            $instaColors = ['#f8e8f0', '#fdf2e9', '#e8f4f0', '#ede4f5', '#fce8e4'];
            $instaIcons = ['fa-pen-fancy', 'fa-book-open', 'fa-palette', 'fa-pencil-alt', 'fa-paint-brush'];
        @endphp
        @for($ig = 0; $ig < 5; $ig++)
            <div class="group relative aspect-square cursor-pointer overflow-hidden" style="background: {{ $instaColors[$ig] }};">
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas {{ $instaIcons[$ig] }} text-4xl md:text-5xl" style="color: {{ $instaColors[$ig] }}; filter: brightness(0.85);"></i>
                </div>
                <div class="absolute inset-0 bg-primary/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <i class="fab fa-instagram text-white text-3xl"></i>
                </div>
            </div>
        @endfor
    </div>
</section>

{{-- New Arrivals Row --}}
@if($newArrivals->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-navy">New Arrivals</h2>
                <p class="text-muted mt-2">Fresh products just landed in store</p>
            </div>
            <a href="{{ url('/products?filter=new') }}" class="hidden md:inline-flex items-center gap-2 text-navy hover:text-primary font-medium text-sm transition">
                View All <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">
            @foreach($newArrivals->take(5) as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Brands --}}
@if($brands->count() > 0)
<section class="py-12 bg-light border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-center gap-10 flex-wrap opacity-50 hover:opacity-80 transition-opacity duration-500">
            @foreach($brands as $brand)
                <div class="flex items-center justify-center h-10" title="{{ $brand->name }}">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-full object-contain grayscale hover:grayscale-0 transition-all duration-300"
                             onerror="this.parentElement.innerHTML='<span class=\'font-bold text-lg text-gray-400\'>{{ $brand->name }}</span>'">
                    @else
                        <span class="font-bold text-lg text-gray-400">{{ $brand->name }}</span>
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
        days: '00', hours: '00', minutes: '00', seconds: '00',
        start() {
            const endOfDay = new Date();
            endOfDay.setHours(23, 59, 59, 999);
            const update = () => {
                const now = new Date();
                let diff = Math.max(0, Math.floor((endOfDay - now) / 1000));
                this.days = String(Math.floor(diff / 86400)).padStart(2, '0');
                diff %= 86400;
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
