@php
    $settings = \App\Models\SiteSetting::pluck('value', 'key');
    $allCategories = \App\Models\Category::whereNull('parent_id')->where('is_active', true)->with('children')->orderBy('sort_order')->get();
    $cartItems = session('cart', []);
    $cartCount = collect($cartItems)->sum('quantity');
    $cartTotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
@endphp
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $settings['site_name'] ?? 'Mars Stationery')</title>

    {{-- Tailwind CSS (for content pages that still use Tailwind classes) --}}
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
                        rajdhani: ['Rajdhani', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    {{-- Font Awesome CDN (for content pages using fas/far/fab classes) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- WordPress Block Library --}}
    <link rel='stylesheet' href='/template/wp-includes/css/dist/block-library/style.min.css' media='all'>

    {{-- WooCommerce Blocks --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/wc-blocks-vendors-style.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/wc-blocks-style.css' media='all'>

    {{-- Gutenberg Blocks --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/base/gutenberg-blocks.css' media='all'>

    {{-- Contact Form 7 --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/contact-form-7/includes/css/styles.css' media='all'>

    {{-- Header Footer Elementor --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/header-footer-elementor/assets/css/header-footer-elementor.css' media='all'>

    {{-- Elementor Icons --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css' media='all'>

    {{-- Elementor Frontend --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/elementor/assets/css/frontend.min.css' media='all'>

    {{-- Elementor Post CSS --}}
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-6.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/global.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-27.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/header-footer-elementor/inc/widgets-css/frontend.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-2117.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-101.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-3741.css' media='all'>

    {{-- Compare/Quick View/Wishlist --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-compare/assets/libs/hint/hint.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-compare/assets/libs/perfect-scrollbar/css/perfect-scrollbar.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-compare/assets/libs/perfect-scrollbar/css/custom-theme.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-compare/assets/css/frontend.css' media='all'>

    {{-- Slick --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-quick-view/assets/libs/slick/slick.css' media='all'>

    {{-- Magnific Popup --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/libs/magnific-popup.css' media='all'>

    {{-- Quick View --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-quick-view/assets/libs/feather/feather.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-quick-view/assets/css/frontend.css' media='all'>

    {{-- Wishlist --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-wishlist/assets/libs/feather/feather.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-smart-wishlist/assets/css/frontend.css' media='all'>

    {{-- Main Theme Style --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/style.css' media='all'>
    <style>
        body{--primary:#E84F69;--secondary:#01213A;--text:#666666;--accent:#4BC4E0;--lighter:#999999;--dark:#4D4D4D;--border:#E5E5E5;}
        .col-full{max-width:1290px}
        @media(max-width:1024px){
            body.theme-stationero [data-elementor-columns-tablet="1"] .column-item{flex: 0 0 100%; max-width: 100%;}
            .woocommerce.columns-tablet-1 ul.products li.product{flex: 0 0 100%; max-width: 100%;}
            body.theme-stationero [data-elementor-columns-tablet="2"] .column-item{flex: 0 0 50%; max-width: 50%;}
            .woocommerce.columns-tablet-2 ul.products li.product{flex: 0 0 50%; max-width: 50%;}
            body.theme-stationero [data-elementor-columns-tablet="3"] .column-item{flex: 0 0 33.333%; max-width: 33.333%;}
            .woocommerce.columns-tablet-3 ul.products li.product{flex: 0 0 33.333%; max-width: 33.333%;}
        }
        @media(max-width:767px){
            body.theme-stationero [data-elementor-columns-mobile="1"] .column-item{flex: 0 0 100%; max-width: 100%;}
            .woocommerce.columns-mobile-1 ul.products li.product{flex: 0 0 100%; max-width: 100%;}
            body.theme-stationero [data-elementor-columns-mobile="2"] .column-item{flex: 0 0 50%; max-width: 50%;}
            .woocommerce.columns-mobile-2 ul.products li.product{flex: 0 0 50%; max-width: 50%;}
        }
        .woocommerce form .form-row .required { visibility: visible; }
        body, body *, input, select, textarea, button { font-family: 'Rajdhani', sans-serif !important; }
        /* Preserve stationero icon font for icon elements */
        [class*="stationero-icon-"],
        [class*="stationero-icon-"]::before,
        [class*="stationero-icon-"]::after,
        .site-header-cart .cart-contents::before,
        .main-navigation .menu-item-has-children > a::after,
        .main-navigation .page_item_has_children > a::after,
        .main-navigation .has-mega-menu > a::after {
            font-family: "stationero-icon" !important;
        }
        .product-block { display: flex; flex-direction: column; height: 100%; }
        .product-transition { flex: 0 0 auto; }
        .product-image img { width: 100%; height: 250px; object-fit: contain; background: #f5f5f5; }
        .product-caption { flex: 1 0 auto; }
        .product-caption-bottom { margin-top: auto; }
        li.product { display: flex; }

        /* Ensure Font Awesome icons render with their own font */
        .fas, .far, .fab, .fa-solid, .fa-regular, .fa-brands,
        .fas::before, .far::before, .fab::before {
            font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Brands', 'FontAwesome' !important;
        }
        .fas, .fa-solid { font-weight: 900 !important; }

        /* Ensure LOGIN / REGISTER text is visible and clickable */
        .site-header-account a {
            color: var(--secondary, #01213A);
            font-weight: 600;
            font-size: 14px;
        }
        .site-header-account a:hover {
            color: var(--primary, #E84F69);
        }
        .account-content.content-label {
            display: inline !important;
        }
    </style>

    {{-- Slick Theme --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/base/slick.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/base/slick-theme.css' media='all'>

    {{-- Google Fonts - Rajdhani --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Variation Swatches --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-variation-swatches/assets/css/frontend.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-variation-swatches/assets/css/wvs-theme-override.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/woo-variation-swatches/assets/css/frontend-tooltip.min.css' media='all'>

    {{-- Theme Elementor + WooCommerce --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/base/elementor.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/woocommerce/woocommerce.css' media='all'>

    {{-- Tooltipster --}}
    <link rel='stylesheet' href='/template/wp-content/themes/stationero/assets/css/libs/tooltipster.bundle.min.css' media='all'>

    {{-- Child Theme --}}
    <link rel='stylesheet' href='/template/wp-content/themes/demo-child/style.css' media='all'>

    {{-- Font Awesome --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/plugins/elementor/assets/lib/font-awesome/css/regular.min.css' media='all'>

    {{-- Mega Menu Post CSS --}}
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-1021.css' media='all'>
    <link rel='stylesheet' href='/template/wp-content/uploads/elementor/css/post-907.css' media='all'>

    {{-- Revolution Slider --}}
    <link rel='stylesheet' href='/template/wp-content/plugins/revslider/public/assets/css/rs6.css' media='all'>

    {{-- jQuery --}}
    <script src='/template/wp-includes/js/jquery/jquery.min.js'></script>
    <script src='/template/wp-includes/js/jquery/jquery-migrate.min.js'></script>

    {{-- Jarallax --}}
    <script src='/template/wp-content/themes/stationero/assets/js/vendor/jarallax.js'></script>

    {{-- Alpine.js for interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        /* Flash message styling */
        .flash-msg { position: fixed; top: 80px; right: 16px; z-index: 9999; padding: 12px 24px; border-radius: 8px; color: #fff; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .flash-msg.success { background: #22c55e; }
        .flash-msg.error { background: #E84F69; }
    </style>

    @stack('styles')
</head>
<body class="page-template page-template-template-homepage page-template-template-homepage-php page page-id-27 wp-custom-logo theme-stationero woocommerce-js ehf-header ehf-footer ehf-template-stationero ehf-stylesheet-demo-child woo-variation-swatches wvs-theme-demo-child wvs-theme-child-stationero wvs-style-squared wvs-attr-behavior-blur wvs-tooltip wvs-css wvs-show-label woocommerce-active product-style-1 elementor-default elementor-kit-6 elementor-page elementor-page-27">

<div id="page" class="hfeed site">
    {{-- ========== HEADER ========== --}}
    <header id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
        <p class="main-title bhf-hidden" itemprop="headline"><a href="{{ url('/') }}" title="{{ $settings['site_name'] ?? 'Mars Stationery' }}" rel="home">{{ $settings['site_name'] ?? 'Mars Stationery' }}</a></p>

        <div data-elementor-type="wp-post" data-elementor-id="2117" class="elementor elementor-2117">

            {{-- Top Bar --}}
            <section class="elementor-section elementor-top-section elementor-element elementor-element-ecf5a43 elementor-section-stretched elementor-section-content-middle elementor-section-boxed elementor-section-height-default" data-id="ecf5a43" data-element_type="section" data-settings='{"stretch_section":"section-stretched","background_background":"classic"}'>
                <div class="elementor-container elementor-column-gap-no">
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-8409e41 elementor-hidden-tablet elementor-hidden-mobile" data-id="8409e41" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-29480e8 elementor-widget elementor-widget-text-editor" data-id="29480e8" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    Call: {{ $settings['phone'] ?? '(+94) 11 234 5678' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-c20d62d" data-id="c20d62d" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-d055227 elementor-widget elementor-widget-text-editor" data-id="d055227" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    Summer sale discount <span style="color: var( --e-global-color-primary );"> 50% off. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-5571e48 elementor-hidden-tablet elementor-hidden-mobile" data-id="5571e48" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-e07ae1d elementor-widget__width-auto elementor-widget elementor-widget-text-editor" data-id="e07ae1d" data-element_type="widget" data-widget_type="text-editor.default">
                                <div class="elementor-widget-container">
                                    <a href="{{ url('/contact') }}" style="color: inherit; text-decoration: none;">Find a Store</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Main Header: Logo + Nav + Icons --}}
            <section class="elementor-section elementor-top-section elementor-element elementor-element-ff5cc45 elementor-section-content-middle elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="ff5cc45" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
                <div class="elementor-container elementor-column-gap-no">

                    {{-- Logo --}}
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-fb74746" data-id="fb74746" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-d024e1a elementor-widget elementor-widget-site-logo" data-id="d024e1a" data-element_type="widget" data-widget_type="site-logo.default">
                                <div class="elementor-widget-container">
                                    <div class="hfe-site-logo">
                                        <a data-elementor-open-lightbox="" class='elementor-clickable' href="{{ url('/') }}">
                                            <div class="hfe-site-logo-set">
                                                <div class="hfe-site-logo-container">
                                                    <img class="hfe-site-logo-img elementor-animation-" src="/template/wp-content/uploads/2022/03/logo.svg" alt="{{ $settings['site_name'] ?? 'Mars Stationery' }}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-10b6147" data-id="10b6147" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div class="elementor-element elementor-element-d650f42 elementor-hidden-tablet elementor-hidden-mobile elementor-widget elementor-widget-stationero-nav-menu" data-id="d650f42" data-element_type="widget" data-widget_type="stationero-nav-menu.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-nav-menu-wrapper">
                                        <nav class="main-navigation" role="navigation" aria-label="Primary Navigation">
                                            <div class="primary-navigation">
                                                <ul id="menu-1-d650f42" class="menu">
                                                    <li class="menu-item menu-item-has-children {{ request()->is('/') ? 'current-menu-item' : '' }}">
                                                        <a href="{{ url('/') }}"><span class="menu-title">Home</span></a>
                                                    </li>
                                                    <li class="menu-item menu-item-has-children {{ request()->is('products*') || request()->is('category*') ? 'current-menu-item' : '' }}">
                                                        <a href="{{ url('/products') }}"><span class="menu-title">Shop</span></a>
                                                        <ul class="sub-menu">
                                                            @foreach($allCategories as $cat)
                                                                <li class="menu-item"><a href="{{ url('/category/' . $cat->slug) }}"><span class="menu-title">{{ $cat->name }}</span></a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item menu-item-has-children">
                                                        <a href="#"><span class="menu-title">Pages</span></a>
                                                        <ul class="sub-menu">
                                                            <li class="menu-item"><a href="{{ url('/products?filter=featured') }}"><span class="menu-title">Featured</span></a></li>
                                                            <li class="menu-item"><a href="{{ url('/products?filter=new') }}"><span class="menu-title">New Arrivals</span></a></li>
                                                            <li class="menu-item"><a href="{{ url('/bulk-inquiry') }}"><span class="menu-title">Bulk Inquiry</span></a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item {{ request()->is('products*') && request('filter') == 'new' ? 'current-menu-item' : '' }}">
                                                        <a href="{{ url('/products?filter=new') }}"><span class="menu-title">Blog</span></a>
                                                    </li>
                                                    <li class="menu-item {{ request()->is('contact') ? 'current-menu-item' : '' }}">
                                                        <a href="{{ url('/contact') }}"><span class="menu-title">Contact</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                            {{-- Mobile Menu Toggle --}}
                            <div class="elementor-element elementor-element-529faf2 stationero-canvas-menu-layout-2 elementor-widget-tablet__width-auto elementor-hidden-desktop elementor-widget elementor-widget-stationero-menu-canvas" data-id="529faf2" data-element_type="widget" data-widget_type="stationero-menu-canvas.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-canvas-menu-wrapper">
                                        <a href="#" class="menu-mobile-nav-button">
                                            <span class="toggle-text screen-reader-text">Menu</span>
                                            <div class="stationero-icon">
                                                <span class="icon-1"></span>
                                                <span class="icon-2"></span>
                                                <span class="icon-3"></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Icons: Account, Search, Wishlist, Cart --}}
                    <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-c37bbc8 elementor-hidden-tablet elementor-hidden-mobile" data-id="c37bbc8" data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            {{-- Account --}}
                            <div class="elementor-element elementor-element-a0027c6 elementor-show-label-yes elementor-widget__width-auto elementor-widget elementor-widget-stationero-header-group" data-id="a0027c6" data-element_type="widget" data-widget_type="stationero-header-group.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-header-group-wrapper">
                                        <div class="header-group-action">
                                            <div class="site-header-account">
                                                @auth
                                                    <a href="{{ url('/account') }}">
                                                        <i class="stationero-icon-user2"></i>
                                                        <span class="account-content content-label">My Account</span>
                                                    </a>
                                                @else
                                                    <a href="{{ url('/login') }}">
                                                        <i class="stationero-icon-user2"></i>
                                                        <span class="account-content content-label">Login / Register</span>
                                                    </a>
                                                @endauth
                                                <div class="account-dropdown"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Search, Wishlist, Cart --}}
                            <div class="elementor-element elementor-element-6d07221 elementor-widget__width-auto elementor-widget elementor-widget-stationero-header-group" data-id="6d07221" data-element_type="widget" data-widget_type="stationero-header-group.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-header-group-wrapper">
                                        <div class="header-group-action">
                                            <div class="site-header-search">
                                                <a href="#" class="button-search-popup"><i class="stationero-icon-search"></i></a>
                                            </div>

                                            <div class="site-header-wishlist">
                                                <a class="header-wishlist" href="#">
                                                    <i class="stationero-icon-heart"></i>
                                                    <span class="count">0</span>
                                                    <span class="wishlist-content content-label">My Wishlist</span>
                                                </a>
                                            </div>

                                            <div class="site-header-cart menu">
                                                <a class="cart-contents" href="{{ url('/cart') }}" title="View your shopping cart">
                                                    <span class="count">{{ $cartCount }}</span>
                                                    <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">LKR</span> {{ number_format($cartTotal, 2) }}</bdi></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="flash-msg success" x-cloak>
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button @click="show = false" style="margin-left:8px;cursor:pointer;background:none;border:none;color:#fff;">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="flash-msg error" x-cloak>
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button @click="show = false" style="margin-left:8px;cursor:pointer;background:none;border:none;color:#fff;">&times;</button>
        </div>
    @endif

    <div class="breadcrumb-wrap"></div>
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="woocommerce"></div>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    {{-- ========== FOOTER ========== --}}
    <footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
        <div class='footer-width-fixer'>
            <div data-elementor-type="wp-post" data-elementor-id="101" class="elementor elementor-101">

                {{-- Newsletter Section --}}
                <section class="elementor-section elementor-top-section elementor-element elementor-element-ce4efb3 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="ce4efb3" data-element_type="section" data-settings='{"stretch_section":"section-stretched","background_background":"classic"}'>
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-03ef0cd" data-id="03ef0cd" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-5354aab elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="5354aab" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Subscribe and get 20% off your first purchase.</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-f95a8b3 elementor-mailchip-layout-1 elementor-widget elementor-widget-stationero-mailchmip" data-id="f95a8b3" data-element_type="widget" data-widget_type="stationero-mailchmip.default">
                                    <div class="elementor-widget-container">
                                        <div class="form-style">
                                            <form class="mc4wp-form" method="post" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                                                <div class="mc4wp-form-fields">
                                                    <p class="form-input">
                                                        <input type="email" name="EMAIL" placeholder="Enter your email address" autocomplete="off" required="">
                                                    </p>
                                                    <p class="form-button">
                                                        <button type="submit" value="Sign up"><span>Subscribe</span></button>
                                                    </p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Footer Columns --}}
                <section class="elementor-section elementor-top-section elementor-element elementor-element-f7f26c4 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="f7f26c4" data-element_type="section" data-settings='{"stretch_section":"section-stretched","background_background":"classic"}'>
                    <div class="elementor-container elementor-column-gap-no">

                        {{-- Column 1: Logo + Description + Social --}}
                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-8b89c30" data-id="8b89c30" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-353499d elementor-widget-mobile__width-auto elementor-widget elementor-widget-site-logo" data-id="353499d" data-element_type="widget" data-widget_type="site-logo.default">
                                    <div class="elementor-widget-container">
                                        <div class="hfe-site-logo">
                                            <a data-elementor-open-lightbox="" class='elementor-clickable' href="{{ url('/') }}">
                                                <div class="hfe-site-logo-set">
                                                    <div class="hfe-site-logo-container">
                                                        <img class="hfe-site-logo-img elementor-animation-" src="/template/wp-content/uploads/2022/03/logo-2.svg" alt="{{ $settings['site_name'] ?? 'Mars Stationery' }}">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-d331bfb elementor-widget__width-initial elementor-widget-mobile__width-inherit elementor-widget elementor-widget-text-editor" data-id="d331bfb" data-element_type="widget" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        We promise we'll get back to you promptly - your stationery needs are always on our minds!
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-ac9fcc7 e-grid-align-left e-grid-align-mobile-center elementor-shape-rounded elementor-grid-0 elementor-widget elementor-widget-social-icons" data-id="ac9fcc7" data-element_type="widget" data-widget_type="social-icons.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-social-icons-wrapper elementor-grid">
                                            <span class="elementor-grid-item">
                                                <a class="elementor-icon elementor-social-icon elementor-social-icon-facebook-f elementor-repeater-item-9b1a06e" href="#" target="_blank">
                                                    <span class="elementor-screen-only">Facebook-f</span>
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </span>
                                            <span class="elementor-grid-item">
                                                <a class="elementor-icon elementor-social-icon elementor-social-icon-twitter elementor-repeater-item-30b88a0" href="#" target="_blank">
                                                    <span class="elementor-screen-only">Twitter</span>
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </span>
                                            <span class="elementor-grid-item">
                                                <a class="elementor-icon elementor-social-icon elementor-social-icon-instagram elementor-repeater-item-6e74258" href="#" target="_blank">
                                                    <span class="elementor-screen-only">Instagram</span>
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Column 2: Useful Links --}}
                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-8dbc241" data-id="8dbc241" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-81d7fdc elementor-widget elementor-widget-heading" data-id="81d7fdc" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Useful Links</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-4db367e hfe-nav-menu__breakpoint-none hfe-nav-menu__align-left hfe-submenu-icon-arrow hfe-link-redirect-child elementor-widget elementor-widget-navigation-menu" data-id="4db367e" data-element_type="widget" data-widget_type="navigation-menu.default">
                                    <div class="elementor-widget-container">
                                        <div class="hfe-nav-menu hfe-layout-vertical hfe-nav-menu-layout vertical" data-layout="vertical">
                                            <nav class="hfe-nav-menu__layout-vertical hfe-nav-menu__submenu-arrow" data-toggle-icon="" data-close-icon="" data-full-width="">
                                                <ul class="hfe-nav-menu">
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/') }}" class="hfe-menu-item">About us</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/contact') }}" class="hfe-menu-item">Contact us</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="#" class="hfe-menu-item">Delivery Policy</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="#" class="hfe-menu-item">FAQs</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="#" class="hfe-menu-item">Privacy Policy</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="#" class="hfe-menu-item">Return Policy</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Column 3: Shop --}}
                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-cd2db66" data-id="cd2db66" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-3954100 elementor-widget elementor-widget-heading" data-id="3954100" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Shop</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-710be50 hfe-nav-menu__breakpoint-none hfe-nav-menu__align-left hfe-submenu-icon-arrow hfe-link-redirect-child elementor-widget elementor-widget-navigation-menu" data-id="710be50" data-element_type="widget" data-widget_type="navigation-menu.default">
                                    <div class="elementor-widget-container">
                                        <div class="hfe-nav-menu hfe-layout-vertical hfe-nav-menu-layout vertical" data-layout="vertical">
                                            <nav class="hfe-nav-menu__layout-vertical hfe-nav-menu__submenu-arrow" data-toggle-icon="" data-close-icon="" data-full-width="">
                                                <ul class="hfe-nav-menu">
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/products') }}" class="hfe-menu-item">Shop</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/products?filter=new') }}" class="hfe-menu-item">New Arrivals</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/products?filter=featured') }}" class="hfe-menu-item">Best Selling Products</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/bulk-inquiry') }}" class="hfe-menu-item">Bulk Inquiry</a></li>
                                                    <li class="menu-item parent hfe-creative-menu"><a href="{{ url('/cart') }}" class="hfe-menu-item">Shopping Cart</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Column 4: Need Help --}}
                        <div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-7d8f782" data-id="7d8f782" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-5d062a7 elementor-widget elementor-widget-heading" data-id="5d062a7" data-element_type="widget" data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">Need Help</h2>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-d3dfb48 elementor-mobile-align-center elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="d3dfb48" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items">
                                            <li class="elementor-icon-list-item">
                                                <span class="elementor-icon-list-icon"><i aria-hidden="true" class="stationero-icon- stationero-icon-phone"></i></span>
                                                <span class="elementor-icon-list-text">{{ $settings['phone'] ?? '(+94) 11 234 5678' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-a93447b elementor-position-left elementor-mobile-position-left elementor-widget-mobile__width-auto elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="a93447b" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper">
                                            <div class="elementor-icon-box-icon">
                                                <span class="elementor-icon elementor-animation-"><i aria-hidden="true" class="far fa-clock"></i></span>
                                            </div>
                                            <div class="elementor-icon-box-content">
                                                <h3 class="elementor-icon-box-title"><span>Monday - Friday: 9:00-20:00</span></h3>
                                                <p class="elementor-icon-box-description">Saturday: 11:00 - 15:00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-310a287 elementor-mobile-align-center elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="310a287" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items">
                                            <li class="elementor-icon-list-item">
                                                <span class="elementor-icon-list-icon"><i aria-hidden="true" class="stationero-icon- stationero-icon-envelope"></i></span>
                                                <span class="elementor-icon-list-text">{{ $settings['email'] ?? 'info@mars.lk' }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Copyright Bar --}}
                <section class="elementor-section elementor-top-section elementor-element elementor-element-1b60d63 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="1b60d63" data-element_type="section" data-settings='{"stretch_section":"section-stretched","background_background":"classic"}'>
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-58c1478" data-id="58c1478" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-1eb06b3 elementor-widget elementor-widget-text-editor" data-id="1eb06b3" data-element_type="widget" data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container">
                                        Copyright &copy; {{ date('Y') }} <a href="{{ url('/') }}">{{ $settings['site_name'] ?? 'Mars Stationery' }}.</a> All rights reserved.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-d0091a7" data-id="d0091a7" data-element_type="column">
                            <div class="elementor-widget-wrap elementor-element-populated">
                                <div class="elementor-element elementor-element-013ea90 elementor-icon-list--layout-inline elementor-align-right elementor-mobile-align-center elementor-list-item-link-full_width elementor-widget elementor-widget-icon-list" data-id="013ea90" data-element_type="widget" data-widget_type="icon-list.default">
                                    <div class="elementor-widget-container">
                                        <ul class="elementor-icon-list-items elementor-inline-items">
                                            <li class="elementor-icon-list-item elementor-inline-item"><a href="#"><span class="elementor-icon-list-text">VISA</span></a></li>
                                            <li class="elementor-icon-list-item elementor-inline-item"><a href="#"><span class="elementor-icon-list-text">MASTERCARD</span></a></li>
                                            <li class="elementor-icon-list-item elementor-inline-item"><a href="#"><span class="elementor-icon-list-text">COD</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </footer>

</div>{{-- #page --}}

{{-- Mobile Navigation --}}
<div class="stationero-mobile-nav">
    <div class="menu-scroll-mobile">
        <a href="#" class="mobile-nav-close"><i class="stationero-icon-times"></i></a>
        <div class="mobile-nav-tabs">
            <ul>
                <li class="mobile-tab-title mobile-pages-title active" data-menu="pages"><span>Main menu</span></li>
                <li class="mobile-tab-title mobile-categories-title" data-menu="categories"><span>Browse Categories</span></li>
            </ul>
        </div>
        <nav class="mobile-menu-tab mobile-navigation mobile-pages-menu active" aria-label="Mobile Navigation">
            <div class="handheld-navigation">
                <ul class="menu">
                    <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="menu-item"><a href="{{ url('/products') }}">Shop</a></li>
                    <li class="menu-item menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="{{ url('/products?filter=featured') }}">Featured</a></li>
                            <li class="menu-item"><a href="{{ url('/products?filter=new') }}">New Arrivals</a></li>
                            <li class="menu-item"><a href="{{ url('/bulk-inquiry') }}">Bulk Inquiry</a></li>
                        </ul>
                    </li>
                    <li class="menu-item"><a href="{{ url('/contact') }}">Contact</a></li>
                    @auth
                        <li class="menu-item"><a href="{{ url('/account') }}">My Account</a></li>
                        <li class="menu-item">
                            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                @csrf
                                <a href="#" onclick="this.closest('form').submit(); return false;">Logout</a>
                            </form>
                        </li>
                    @else
                        <li class="menu-item"><a href="{{ url('/login') }}">Login</a></li>
                        <li class="menu-item"><a href="{{ url('/register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
        <nav class="mobile-menu-tab mobile-navigation-categories mobile-categories-menu" aria-label="Mobile Navigation">
            <div class="handheld-navigation">
                <ul class="menu">
                    @foreach($allCategories as $cat)
                        <li class="menu-item"><a href="{{ url('/category/' . $cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="stationero-overlay"></div>

{{-- Search Popup --}}
<div class="site-search-popup">
    <div class="site-search-popup-wrap">
        <a href="#" class="site-search-popup-close"><i class="stationero-icon-times-circle"></i></a>
        <div class="site-search ajax-search">
            <div class="widget woocommerce widget_product_search">
                <div class="ajax-search-result d-none"></div>
                <form role="search" method="get" class="woocommerce-product-search" action="{{ url('/products') }}">
                    <label class="screen-reader-text" for="woocommerce-product-search-field-1">Search for:</label>
                    <input type="search" id="woocommerce-product-search-field-1" class="search-field" placeholder="Search products..." autocomplete="off" value="{{ request('q') }}" name="q">
                    <button type="submit" value="Search">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="site-search-popup-overlay"></div>

{{-- Cart Side Panel --}}
<div class="site-header-cart-side">
    <div class="cart-side-heading">
        <span class="cart-side-title">Shopping cart</span>
        <a href="#" class="close-cart-side">close</a>
    </div>
    <div class="widget woocommerce widget_shopping_cart">
        <div class="widget_shopping_cart_content">
            @if($cartCount > 0)
                <ul class="woocommerce-mini-cart cart_list product_list_widget">
                    @foreach($cartItems as $id => $item)
                        <li class="woocommerce-mini-cart-item mini_cart_item">
                            <a href="{{ url('/products/' . ($item['slug'] ?? $id)) }}">{{ $item['name'] ?? 'Product' }}</a>
                            <span class="quantity">{{ $item['quantity'] }} &times; <span class="woocommerce-Price-amount amount"><bdi>LKR {{ number_format($item['price'], 2) }}</bdi></span></span>
                        </li>
                    @endforeach
                </ul>
                <p class="woocommerce-mini-cart__total total">
                    <strong>Subtotal:</strong> <span class="woocommerce-Price-amount amount"><bdi>LKR {{ number_format($cartTotal, 2) }}</bdi></span>
                </p>
                <p class="woocommerce-mini-cart__buttons buttons">
                    <a href="{{ url('/cart') }}" class="button wc-forward">View cart</a>
                    <a href="{{ url('/checkout') }}" class="button checkout wc-forward">Checkout</a>
                </p>
            @else
                <p class="woocommerce-mini-cart__empty-message">No products in the cart.</p>
            @endif
        </div>
    </div>
</div>
<div class="cart-side-overlay"></div>

{{-- Scroll to Top --}}
<a href="#" class="scrollup"><span class="scrollup-icon stationero-icon-angle-up"></span><span class="scrollup-label">Top</span></a>

{{-- JS Files --}}
<script src='/template/wp-content/themes/stationero/assets/js/vendor/slick.min.js'></script>
<script src='/template/wp-content/plugins/woo-smart-quick-view/assets/libs/magnific-popup/jquery.magnific-popup.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/frontend/main.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/skip-link-focus-fix.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/frontend/text-editor.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/frontend/nav-mobile.js'></script>
<script src='/template/wp-content/themes/stationero/inc/megamenu/assets/js/frontend.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/frontend/login.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/woocommerce/header-cart.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/tooltipster.bundle.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/woocommerce/main.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/woocommerce/cart-canvas.min.js'></script>

{{-- Fix: Unbind template JS click handlers that prevent login/cart navigation --}}
<script>
jQuery(function($) {
    // cart-canvas.min.js binds preventDefault on account link and cart link
    // Unbind and allow normal navigation
    $('body .header-group-action .site-header-account a').off('click');
    $('body .header-group-action .site-header-cart .cart-contents').off('click');
});
</script>

{{-- Elementor Frontend --}}
<script src='/template/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js'></script>
<script src='/template/wp-content/plugins/elementor/assets/js/frontend-modules.min.js'></script>
<script src='/template/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js'></script>
<script>
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"Mobile","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"Mobile Extra","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tablet","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tablet Extra","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Widescreen","value":2400,"default_value":2400,"direction":"min","is_enabled":false}}},"version":"3.6.5","is_static":false,"experimentalFeatures":{"e_dom_optimization":true,"e_optimized_assets_loading":true},"urls":{"assets":"/template/wp-content/plugins/elementor/assets/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":27,"title":"Home","excerpt":"","featuredImage":false}};
</script>
<script src='/template/wp-content/plugins/elementor/assets/js/frontend.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/image-carousel.js'></script>
<script src='/template/wp-content/plugins/header-footer-elementor/inc/js/frontend.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/header-group.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/product-tab.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/product-categories.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/products.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/countdown.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/testimonial.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/isotope.pkgd.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/modernizr.custom.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/vendor/jquery.hoverdir.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor/image-gallery.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/frontend/search-popup.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/vendor/jquery.magnific-popup.min.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/elementor-frontend.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/vendor/jquery.sticky.js'></script>
<script src='/template/wp-content/themes/stationero/assets/js/vendor/sticky.min.js'></script>

{{-- Stretch section JS fix --}}
<script>
jQuery(document).ready(function($) {
    function stretchSections() {
        var windowWidth = $(window).width();
        $('[data-settings]').each(function() {
            try {
                var settings = $(this).data('settings');
                if (settings && settings.stretch_section === 'section-stretched') {
                    var $section = $(this);
                    var $colFull = $section.closest('.col-full');
                    if ($colFull.length) {
                        var offset = $colFull.offset().left;
                        $section.css({
                            'margin-left': -offset + 'px',
                            'max-width': windowWidth + 'px',
                            'width': windowWidth + 'px'
                        });
                    } else {
                        $section.css({
                            'width': windowWidth + 'px',
                            'max-width': windowWidth + 'px',
                            'margin-left': 'calc(-50vw + 50%)'
                        });
                    }
                }
            } catch(e) {}
        });
    }
    stretchSections();
    $(window).on('resize', stretchSections);
});
</script>

@stack('scripts')
</body>
</html>
