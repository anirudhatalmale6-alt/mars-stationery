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
                        primary: '#DC2626',
                        dark: '#1a1a1a',
                        light: '#f5f5f5',
                    },
                    fontFamily: {
                        heading: ['Poppins', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        [x-cloak] { display: none !important; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="font-body bg-white text-gray-800" x-data="{ mobileMenu: false }">

    {{-- Top Bar --}}
    <div class="bg-dark text-white text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span><i class="fas fa-phone-alt mr-1"></i> {{ $settings['phone'] ?? '+94 11 234 5678' }}</span>
                <span class="hidden sm:inline"><i class="fas fa-envelope mr-1"></i> {{ $settings['email'] ?? 'info@mars.lk' }}</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ url('/account/orders') }}" class="hover:text-primary transition"><i class="fas fa-map-marker-alt mr-1"></i> Track Order</a>
                <span class="font-semibold">LKR</span>
            </div>
        </div>
    </div>

    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-4">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex-shrink-0">
                    <span class="text-3xl font-heading font-extrabold text-primary tracking-wider">MARS</span>
                </a>

                {{-- Search --}}
                <div class="hidden md:flex flex-1 max-w-2xl mx-8">
                    <form action="{{ url('/products') }}" method="GET" class="flex w-full">
                        <select name="category" class="border border-gray-300 rounded-l-lg px-3 py-2.5 text-sm bg-gray-50 focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="">All Categories</option>
                            @foreach($allCategories as $cat)
                                <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}"
                               class="flex-1 border-t border-b border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-primary">
                        <button type="submit" class="bg-primary text-white px-5 py-2.5 rounded-r-lg hover:bg-red-700 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                {{-- Right Icons --}}
                <div class="flex items-center gap-5">
                    {{-- Account --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex flex-col items-center text-gray-600 hover:text-primary transition">
                            <i class="fas fa-user text-xl"></i>
                            <span class="text-[10px] mt-0.5">Account</span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                            @auth
                                <a href="{{ url('/account') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">My Account</a>
                                <a href="{{ url('/account/orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">My Orders</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-50 text-red-600">Logout</button>
                                </form>
                            @else
                                <a href="{{ url('/login') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Login</a>
                                <a href="{{ url('/register') }}" class="block px-4 py-2 text-sm hover:bg-gray-50">Register</a>
                            @endauth
                        </div>
                    </div>

                    {{-- Wishlist --}}
                    <a href="#" class="flex flex-col items-center text-gray-600 hover:text-primary transition relative">
                        <i class="fas fa-heart text-xl"></i>
                        <span class="text-[10px] mt-0.5">Wishlist</span>
                        <span class="absolute -top-1 -right-2 bg-primary text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ url('/cart') }}" class="flex flex-col items-center text-gray-600 hover:text-primary transition relative">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="text-[10px] mt-0.5">LKR {{ number_format($cartTotal, 2) }}</span>
                        <span class="absolute -top-1 -right-2 bg-primary text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold">{{ $cartCount }}</span>
                    </a>

                    {{-- Mobile Menu Toggle --}}
                    <button @click="mobileMenu = !mobileMenu" class="md:hidden text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            {{-- Mobile Search --}}
            <div class="md:hidden mt-3">
                <form action="{{ url('/products') }}" method="GET" class="flex">
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}"
                           class="flex-1 border border-gray-300 rounded-l-lg px-4 py-2 text-sm focus:outline-none">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="bg-primary">
            <div class="max-w-7xl mx-auto px-4">
                {{-- Desktop Nav --}}
                <ul class="hidden md:flex items-center gap-0 text-white text-sm font-medium">
                    <li><a href="{{ url('/') }}" class="block px-5 py-3 hover:bg-red-700 transition">Home</a></li>
                    <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <a href="{{ url('/products') }}" class="block px-5 py-3 hover:bg-red-700 transition">
                            Categories <i class="fas fa-chevron-down text-[10px] ml-1"></i>
                        </a>
                        <div x-show="open" x-cloak class="absolute left-0 top-full bg-white text-gray-800 shadow-xl rounded-b-lg min-w-[600px] p-6 z-50 grid grid-cols-3 gap-4">
                            @foreach($allCategories as $cat)
                                <div>
                                    <a href="{{ url('/category/' . $cat->slug) }}" class="font-semibold text-primary hover:underline block mb-2">{{ $cat->name }}</a>
                                    @foreach($cat->children as $child)
                                        <a href="{{ url('/category/' . $child->slug) }}" class="block text-sm text-gray-600 hover:text-primary py-0.5">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </li>
                    <li><a href="{{ url('/products?filter=new') }}" class="block px-5 py-3 hover:bg-red-700 transition">New Arrivals</a></li>
                    <li><a href="{{ url('/products?filter=featured') }}" class="block px-5 py-3 hover:bg-red-700 transition">Featured</a></li>
                    <li><a href="{{ url('/bulk-inquiry') }}" class="block px-5 py-3 hover:bg-red-700 transition">Bulk Inquiry</a></li>
                    <li><a href="{{ url('/contact') }}" class="block px-5 py-3 hover:bg-red-700 transition">Contact Us</a></li>
                </ul>

                {{-- Mobile Nav --}}
                <div x-show="mobileMenu" x-cloak class="md:hidden py-4 space-y-1 text-white text-sm">
                    <a href="{{ url('/') }}" class="block py-2 px-2 hover:bg-red-700 rounded">Home</a>
                    <a href="{{ url('/products') }}" class="block py-2 px-2 hover:bg-red-700 rounded">All Products</a>
                    @foreach($allCategories as $cat)
                        <a href="{{ url('/category/' . $cat->slug) }}" class="block py-2 px-2 hover:bg-red-700 rounded pl-4">{{ $cat->name }}</a>
                    @endforeach
                    <a href="{{ url('/products?filter=new') }}" class="block py-2 px-2 hover:bg-red-700 rounded">New Arrivals</a>
                    <a href="{{ url('/products?filter=featured') }}" class="block py-2 px-2 hover:bg-red-700 rounded">Featured</a>
                    <a href="{{ url('/bulk-inquiry') }}" class="block py-2 px-2 hover:bg-red-700 rounded">Bulk Inquiry</a>
                    <a href="{{ url('/contact') }}" class="block py-2 px-2 hover:bg-red-700 rounded">Contact Us</a>
                </div>
            </div>
        </nav>
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
             class="fixed top-20 right-4 z-[100] bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button @click="show = false" class="ml-2"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Newsletter Section --}}
    <section class="bg-primary py-10">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="text-white">
                <h3 class="font-heading text-2xl font-bold">Subscribe to Our Newsletter</h3>
                <p class="text-red-100 mt-1">Get the latest updates on new products and upcoming sales</p>
            </div>
            <form class="flex w-full md:w-auto" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                <input type="email" required placeholder="Enter your email address" class="px-5 py-3 rounded-l-lg w-full md:w-80 focus:outline-none text-sm">
                <button type="submit" class="bg-dark text-white px-6 py-3 rounded-r-lg hover:bg-gray-800 transition font-medium text-sm whitespace-nowrap">
                    Subscribe <i class="fas fa-paper-plane ml-1"></i>
                </button>
            </form>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-dark text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- About --}}
                <div>
                    <h4 class="font-heading text-white text-xl font-bold mb-4">
                        <span class="text-primary">MARS</span> Stationery
                    </h4>
                    <p class="text-sm leading-relaxed text-gray-400">
                        Your one-stop shop for premium stationery, office supplies, and art materials. Quality products at the best prices, delivered right to your doorstep across Sri Lanka.
                    </p>
                    <div class="flex gap-3 mt-5">
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition"><i class="fab fa-facebook-f text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition"><i class="fab fa-instagram text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition"><i class="fab fa-twitter text-sm"></i></a>
                        <a href="#" class="w-9 h-9 bg-gray-700 hover:bg-primary rounded-full flex items-center justify-center transition"><i class="fab fa-youtube text-sm"></i></a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-heading text-white text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-primary transition">Home</a></li>
                        <li><a href="{{ url('/products') }}" class="hover:text-primary transition">Shop</a></li>
                        <li><a href="{{ url('/products?filter=new') }}" class="hover:text-primary transition">New Arrivals</a></li>
                        <li><a href="{{ url('/products?filter=featured') }}" class="hover:text-primary transition">Featured Products</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-primary transition">Contact Us</a></li>
                        <li><a href="{{ url('/account/orders') }}" class="hover:text-primary transition">Track Order</a></li>
                    </ul>
                </div>

                {{-- Customer Service --}}
                <div>
                    <h4 class="font-heading text-white text-lg font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/account') }}" class="hover:text-primary transition">My Account</a></li>
                        <li><a href="{{ url('/account/orders') }}" class="hover:text-primary transition">Order History</a></li>
                        <li><a href="{{ url('/bulk-inquiry') }}" class="hover:text-primary transition">Bulk Inquiry</a></li>
                        <li><a href="{{ url('/cart') }}" class="hover:text-primary transition">Shopping Cart</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-primary transition">Help & FAQ</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h4 class="font-heading text-white text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-primary mt-1"></i>
                            <span>{{ $settings['address'] ?? '123 Main Street, Colombo 03, Sri Lanka' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-primary"></i>
                            <span>{{ $settings['phone'] ?? '+94 11 234 5678' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-primary"></i>
                            <span>{{ $settings['email'] ?? 'info@mars.lk' }}</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-clock text-primary mt-1"></i>
                            <span>Mon - Sat: 9:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Mars Stationery' }}. All rights reserved.</p>
                <div class="flex items-center gap-3">
                    <span class="bg-white text-dark px-3 py-1 rounded text-xs font-bold">VISA</span>
                    <span class="bg-white text-dark px-3 py-1 rounded text-xs font-bold">MC</span>
                    <span class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold">COD</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
