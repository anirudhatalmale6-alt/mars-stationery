@php
    $settings = \App\Models\SiteSetting::pluck('value', 'key');
    $allCategories = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->with('children')->orderBy('sort_order')->get();
    $cartItems = session('cart', []);
    $cartCount = collect($cartItems)->sum('quantity');
    $cartTotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings['site_name'] ?? 'Mars Stationery')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#E84F69',
                        navy: '#01213A',
                        dark: '#292a30',
                        light: '#f5f5f5',
                        muted: '#666666',
                    },
                    fontFamily: {
                        jost: ['Jost', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { font-family: 'Jost', sans-serif; }
        body { font-family: 'Jost', sans-serif; color: #292a30; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Jost', sans-serif; font-weight: 600; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        [x-cloak] { display: none !important; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .nav-link { position: relative; padding: 1.25rem 0; font-size: 0.9375rem; font-weight: 500; color: #01213A; letter-spacing: 0.02em; transition: color 0.2s; }
        .nav-link:hover { color: #E84F69; }
        .nav-link::after { content: ''; position: absolute; bottom: 0; left: 0; width: 0; height: 2px; background: #E84F69; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
        .mega-menu { opacity: 0; visibility: hidden; transform: translateY(10px); transition: all 0.3s ease; }
        .nav-item:hover .mega-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .badge-count { position: absolute; top: -6px; right: -8px; min-width: 18px; height: 18px; background: #E84F69; color: #fff; font-size: 10px; font-weight: 600; border-radius: 50%; display: flex; align-items: center; justify-content: center; line-height: 1; }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-dark" x-data="{ mobileMenu: false, searchOpen: false }">

    {{-- Top Bar --}}
    <div class="bg-light border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between text-xs text-muted">
            <div class="flex items-center gap-2">
                <i class="fas fa-phone-alt text-[10px]"></i>
                <span>Call: {{ $settings['phone'] ?? '(+94) 11 234 5678' }}</span>
            </div>
            <div class="hidden sm:block text-center">
                <span>Summer Sale Discount <span class="text-primary font-semibold">50%</span> Off</span>
            </div>
            <div class="flex items-center gap-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-dark transition">
                        English <i class="fas fa-chevron-down text-[8px]"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-28 bg-white rounded shadow-lg border border-gray-100 py-1 z-50">
                        <a href="#" class="block px-3 py-1.5 text-xs hover:bg-gray-50">English</a>
                        <a href="#" class="block px-3 py-1.5 text-xs hover:bg-gray-50">Sinhala</a>
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-dark transition">
                        LKR <i class="fas fa-chevron-down text-[8px]"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-24 bg-white rounded shadow-lg border border-gray-100 py-1 z-50">
                        <a href="#" class="block px-3 py-1.5 text-xs hover:bg-gray-50">LKR</a>
                        <a href="#" class="block px-3 py-1.5 text-xs hover:bg-gray-50">USD</a>
                    </div>
                </div>
                <a href="{{ url('/contact') }}" class="hidden md:inline hover:text-dark transition">Find A Store</a>
            </div>
        </div>
    </div>

    {{-- Header --}}
    <header class="bg-white sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-[72px]">

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-2 flex-shrink-0">
                    <span class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">S</span>
                    <span class="text-xl font-bold text-navy tracking-wide lowercase">mars</span>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden lg:flex items-center gap-8">
                    <div class="nav-item relative">
                        <a href="{{ url('/') }}" class="nav-link flex items-center gap-1">Home <i class="fas fa-chevron-down text-[8px] ml-0.5 opacity-50"></i></a>
                    </div>
                    <div class="nav-item relative">
                        <a href="{{ url('/products') }}" class="nav-link flex items-center gap-1">Shop <i class="fas fa-chevron-down text-[8px] ml-0.5 opacity-50"></i></a>
                        <div class="mega-menu absolute left-1/2 -translate-x-1/2 top-full bg-white shadow-xl rounded-b-lg min-w-[600px] p-6 z-50 grid grid-cols-3 gap-4 border-t-2 border-primary">
                            @foreach($allCategories as $cat)
                                <div>
                                    <a href="{{ url('/category/' . $cat->slug) }}" class="font-semibold text-navy hover:text-primary block mb-2 text-sm">{{ $cat->name }}</a>
                                    @foreach($cat->children as $child)
                                        <a href="{{ url('/category/' . $child->slug) }}" class="block text-sm text-muted hover:text-primary py-0.5">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nav-item relative">
                        <a href="{{ url('/products?filter=featured') }}" class="nav-link flex items-center gap-1">Pages <i class="fas fa-chevron-down text-[8px] ml-0.5 opacity-50"></i></a>
                        <div class="mega-menu absolute left-0 top-full bg-white shadow-xl rounded-b-lg min-w-[180px] py-3 z-50 border-t-2 border-primary">
                            <a href="{{ url('/products?filter=featured') }}" class="block px-5 py-2 text-sm text-muted hover:text-primary hover:bg-gray-50">Featured</a>
                            <a href="{{ url('/products?filter=new') }}" class="block px-5 py-2 text-sm text-muted hover:text-primary hover:bg-gray-50">New Arrivals</a>
                            <a href="{{ url('/bulk-inquiry') }}" class="block px-5 py-2 text-sm text-muted hover:text-primary hover:bg-gray-50">Bulk Inquiry</a>
                        </div>
                    </div>
                    <a href="{{ url('/products?filter=new') }}" class="nav-link">Blog</a>
                    <a href="{{ url('/contact') }}" class="nav-link">Contact</a>
                </nav>

                {{-- Right Icons --}}
                <div class="flex items-center gap-5">
                    {{-- Login/Register --}}
                    <div x-data="{ open: false }" class="relative hidden md:block">
                        @auth
                            <button @click="open = !open" class="text-sm text-navy hover:text-primary transition font-medium">
                                <i class="far fa-user mr-1"></i> Account
                            </button>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                                <a href="{{ url('/account') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 hover:text-primary">My Account</a>
                                <a href="{{ url('/account/orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-50 hover:text-primary">My Orders</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50 text-primary">Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ url('/login') }}" class="text-sm text-navy hover:text-primary transition font-medium uppercase tracking-wide">
                                Login <span class="text-gray-300 mx-1">/</span> Register
                            </a>
                        @endauth
                    </div>

                    {{-- Search Icon --}}
                    <button @click="searchOpen = !searchOpen" class="text-navy hover:text-primary transition text-lg">
                        <i class="fas fa-search"></i>
                    </button>

                    {{-- Wishlist --}}
                    <a href="#" class="text-navy hover:text-primary transition text-lg relative">
                        <i class="far fa-heart"></i>
                        <span class="badge-count">0</span>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ url('/cart') }}" class="text-navy hover:text-primary transition text-lg relative">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="badge-count">{{ $cartCount }}</span>
                    </a>

                    {{-- Mobile Menu Toggle --}}
                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-navy text-xl">
                        <i :class="mobileMenu ? 'fas fa-times' : 'fas fa-bars'"></i>
                    </button>
                </div>
            </div>

            {{-- Search Overlay --}}
            <div x-show="searchOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-2"
                 class="absolute left-0 right-0 top-full bg-white shadow-lg border-t border-gray-100 p-4 z-50">
                <form action="{{ url('/products') }}" method="GET" class="max-w-2xl mx-auto flex">
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}"
                           class="flex-1 border border-gray-200 rounded-l-lg px-5 py-3 text-sm focus:outline-none focus:border-primary" autofocus>
                    <button type="submit" class="bg-primary text-white px-6 py-3 rounded-r-lg hover:bg-pink-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div x-show="mobileMenu" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-[80vh]" x-transition:leave="transition ease-in duration-200"
             class="lg:hidden bg-white border-t border-gray-100 overflow-y-auto max-h-[80vh]">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ url('/') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">Home</a>
                <a href="{{ url('/products') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">Shop</a>
                @foreach($allCategories as $cat)
                    <a href="{{ url('/category/' . $cat->slug) }}" class="block py-2 px-6 text-muted hover:text-primary hover:bg-gray-50 rounded-lg transition text-sm">{{ $cat->name }}</a>
                @endforeach
                <a href="{{ url('/products?filter=featured') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">Featured</a>
                <a href="{{ url('/products?filter=new') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">New Arrivals</a>
                <a href="{{ url('/bulk-inquiry') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">Bulk Inquiry</a>
                <a href="{{ url('/contact') }}" class="block py-2.5 px-3 text-navy font-medium hover:text-primary hover:bg-gray-50 rounded-lg transition">Contact</a>
                <div class="border-t border-gray-100 pt-3 mt-3">
                    @auth
                        <a href="{{ url('/account') }}" class="block py-2.5 px-3 text-navy hover:text-primary transition">My Account</a>
                        <a href="{{ url('/account/orders') }}" class="block py-2.5 px-3 text-navy hover:text-primary transition">My Orders</a>
                    @else
                        <a href="{{ url('/login') }}" class="block py-2.5 px-3 text-navy hover:text-primary transition">Login</a>
                        <a href="{{ url('/register') }}" class="block py-2.5 px-3 text-navy hover:text-primary transition">Register</a>
                    @endauth
                </div>
            </div>
            {{-- Mobile Search --}}
            <div class="px-4 pb-4">
                <form action="{{ url('/products') }}" method="GET" class="flex">
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}"
                           class="flex-1 border border-gray-200 rounded-l-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary">
                    <button type="submit" class="bg-primary text-white px-4 py-2.5 rounded-r-lg hover:bg-pink-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             class="fixed top-20 right-4 z-[100] bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button @click="show = false" class="ml-2"><i class="fas fa-times"></i></button>
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             class="fixed top-20 right-4 z-[100] bg-pink-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button @click="show = false" class="ml-2"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Newsletter + Footer --}}
    <footer class="bg-navy text-gray-300">
        {{-- Newsletter Section --}}
        <div class="border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-14">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-white text-2xl md:text-3xl font-bold leading-tight">Subscribe And Get <span class="text-primary">20% Off</span> Your First Purchase.</h3>
                    <form class="flex mt-8 max-w-lg mx-auto" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                        <input type="email" required placeholder="Your email address" class="flex-1 px-5 py-3.5 rounded-l-lg focus:outline-none text-sm text-dark bg-white">
                        <button type="submit" class="bg-primary text-white px-7 py-3.5 rounded-r-lg hover:bg-pink-600 transition font-medium text-sm whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Footer Columns --}}
        <div class="max-w-7xl mx-auto px-4 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                {{-- Col 1: Logo + About --}}
                <div>
                    <a href="{{ url('/') }}" class="flex items-center gap-2 mb-5">
                        <span class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg">S</span>
                        <span class="text-xl font-bold text-white tracking-wide lowercase">mars</span>
                    </a>
                    <p class="text-sm leading-relaxed text-gray-400 mb-6">
                        Your one-stop shop for premium stationery, office supplies, and art materials. Quality products at the best prices.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center transition text-sm"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center transition text-sm"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 hover:bg-primary rounded-full flex items-center justify-center transition text-sm"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                {{-- Col 2: Useful Links --}}
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-5">Useful Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-primary transition">About Us</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-primary transition">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Delivery Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">FAQs</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Return Policy</a></li>
                    </ul>
                </div>

                {{-- Col 3: Shop --}}
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-5">Shop</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/products') }}" class="text-gray-400 hover:text-primary transition">Shop</a></li>
                        <li><a href="{{ url('/products?filter=new') }}" class="text-gray-400 hover:text-primary transition">New Arrivals</a></li>
                        <li><a href="{{ url('/products?filter=featured') }}" class="text-gray-400 hover:text-primary transition">Best Selling Products</a></li>
                        <li><a href="{{ url('/bulk-inquiry') }}" class="text-gray-400 hover:text-primary transition">Bulk Inquiry</a></li>
                        <li><a href="{{ url('/cart') }}" class="text-gray-400 hover:text-primary transition">Shopping Cart</a></li>
                    </ul>
                </div>

                {{-- Col 4: Need Help --}}
                <div>
                    <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-5">Need Help</h4>
                    <p class="text-primary text-2xl font-bold mb-3">{{ $settings['phone'] ?? '(+94) 11 234 5678' }}</p>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="far fa-clock mr-2 text-primary"></i> Mon - Sat: 9:00 AM - 6:00 PM</li>
                        <li><i class="far fa-envelope mr-2 text-primary"></i> {{ $settings['email'] ?? 'info@mars.lk' }}</li>
                        <li class="flex items-start gap-2 mt-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                            <span>{{ $settings['address'] ?? '123 Main Street, Colombo 03, Sri Lanka' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-5 flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Mars Stationery' }}. All rights reserved.</p>
                <div class="flex items-center gap-3">
                    <span class="bg-white text-navy px-3 py-1 rounded text-xs font-bold">VISA</span>
                    <span class="bg-white text-navy px-3 py-1 rounded text-xs font-bold">MC</span>
                    <span class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold">COD</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
