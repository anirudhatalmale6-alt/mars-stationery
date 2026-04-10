@extends('layouts.app')

@section('title', ($settings['site_name'] ?? 'Mars Stationery') . ' - Your One-Stop Stationery Shop')

@section('content')

<div data-elementor-type="wp-page" data-elementor-id="27" class="elementor elementor-27">

    {{-- ========== SECTION 1: Hero Banners ========== --}}
    <section class="elementor-section elementor-top-section elementor-element elementor-element-b74b8da elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="b74b8da" data-element_type="section" data-settings='{"stretch_section":"section-stretched","background_background":"classic"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-2667194" data-id="2667194" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">

                    {{-- Banner Row --}}
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-95d3c87 elementor-section-boxed elementor-section-height-default" data-id="95d3c87" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-no">
                            {{-- Left Large Banner --}}
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-a67be9b" data-id="a67be9b" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-cebc1fd elementor-cta--valign-top elementor-bg-transform elementor-bg-transform-move-left-custom box-align-flex-start box-align-left stationero-banner-layout-1 elementor-widget elementor-widget-stationero-banner" data-id="cebc1fd" data-element_type="widget" data-widget_type="stationero-banner.default">
                                        <div class="elementor-widget-container">
                                            <a href="{{ url('/products') }}" class="elementor-cta--skin-cover elementor-cta elementor-stationero-banner">
                                                <div class="elementor-cta__bg-wrapper">
                                                    <div class="elementor-cta__bg elementor-bg" style="background-image: url(/template/wp-content/uploads/2022/04/h5_banner1.jpg);"></div>
                                                    <div class="elementor-cta__bg-overlay"></div>
                                                </div>
                                                <div class="elementor-cta__content">
                                                    <div class="elementor-cta__content_inner">
                                                        <div class="elementor-cta__subtitle elementor-cta__content-item elementor-content-item">
                                                            <span>Mix & match</span>
                                                        </div>
                                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">
                                                            with our 3 for 2 stationery
                                                        </h2>
                                                    </div>
                                                    <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item">
                                                        <span class="elementor-cta__button elementor-button-custom">
                                                            <span>Shop Now</span>
                                                            <i aria-hidden="true" class="stationero-icon- stationero-icon-arrow-right"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right 2 Stacked Banners --}}
                            <div class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-3e841a1 elementor-hidden-tablet" data-id="3e841a1" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    {{-- Top Right --}}
                                    <div class="elementor-element elementor-element-5afcf0e elementor-cta--valign-top elementor-bg-transform elementor-bg-transform-move-left-custom box-align-flex-start box-align-left stationero-banner-layout-1 elementor-widget elementor-widget-stationero-banner" data-id="5afcf0e" data-element_type="widget" data-widget_type="stationero-banner.default">
                                        <div class="elementor-widget-container">
                                            <a href="{{ url('/products') }}" class="elementor-cta--skin-cover elementor-cta elementor-stationero-banner">
                                                <div class="elementor-cta__bg-wrapper">
                                                    <div class="elementor-cta__bg elementor-bg" style="background-image: url(/template/wp-content/uploads/2022/04/h5_banner2.jpg);"></div>
                                                    <div class="elementor-cta__bg-overlay"></div>
                                                </div>
                                                <div class="elementor-cta__content">
                                                    <div class="elementor-cta__content_inner">
                                                        <div class="elementor-cta__subtitle elementor-cta__content-item elementor-content-item"><span>office / home </span></div>
                                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">metal pens</h2>
                                                        <div class="elementor-cta__description elementor-cta__content-item elementor-content-item">15% off</div>
                                                    </div>
                                                    <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item">
                                                        <span class="elementor-cta__button elementor-button-custom">
                                                            <span>Shop Now</span>
                                                            <i aria-hidden="true" class="stationero-icon- stationero-icon-arrow-right"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    {{-- Bottom Right --}}
                                    <div class="elementor-element elementor-element-dd9a7ff elementor-cta--valign-top elementor-bg-transform elementor-bg-transform-move-left-custom box-align-flex-start box-align-left stationero-banner-layout-1 elementor-widget elementor-widget-stationero-banner" data-id="dd9a7ff" data-element_type="widget" data-widget_type="stationero-banner.default">
                                        <div class="elementor-widget-container">
                                            <a href="{{ url('/products') }}" class="elementor-cta--skin-cover elementor-cta elementor-stationero-banner">
                                                <div class="elementor-cta__bg-wrapper">
                                                    <div class="elementor-cta__bg elementor-bg" style="background-image: url(/template/wp-content/uploads/2022/04/h5_banner3.jpg);"></div>
                                                    <div class="elementor-cta__bg-overlay"></div>
                                                </div>
                                                <div class="elementor-cta__content">
                                                    <div class="elementor-cta__content_inner">
                                                        <div class="elementor-cta__subtitle elementor-cta__content-item elementor-content-item"><span>Office Adhesive </span></div>
                                                        <h2 class="elementor-cta__title elementor-cta__content-item elementor-content-item">Tape</h2>
                                                        <div class="elementor-cta__description elementor-cta__content-item elementor-content-item">from $12.99</div>
                                                    </div>
                                                    <div class="elementor-cta__button-wrapper elementor-cta__content-item elementor-content-item">
                                                        <span class="elementor-cta__button elementor-button-custom">
                                                            <span>Shop Now</span>
                                                            <i aria-hidden="true" class="stationero-icon- stationero-icon-arrow-right"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Trust Badges --}}
                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-5dc457b elementor-section-boxed elementor-section-height-default" data-id="5dc457b" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-no">
                            @php
                                $badges = [
                                    ['icon' => 'stationero-icon-shipping', 'title' => 'Fast delivery', 'desc' => 'For all orders over $120'],
                                    ['icon' => 'stationero-icon-temp', 'title' => 'Safe Payments', 'desc' => '100% secure payment'],
                                    ['icon' => 'stationero-icon-gift', 'title' => 'Discount Coupons', 'desc' => 'Enjoy Huge Promotions'],
                                    ['icon' => 'stationero-icon-comment', 'title' => 'Quality Support', 'desc' => 'Dedicated 24/7 support'],
                                ];
                            @endphp
                            @foreach($badges as $badge)
                            <div class="elementor-column elementor-col-25 elementor-inner-column elementor-element" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-mobile-position-top elementor-widget elementor-widget-icon-box" data-element_type="widget" data-widget_type="icon-box.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-icon-box-wrapper">
                                                <div class="elementor-icon-box-icon">
                                                    <span class="elementor-icon elementor-animation-">
                                                        <i aria-hidden="true" class="stationero-icon- {{ $badge['icon'] }}"></i>
                                                    </span>
                                                </div>
                                                <div class="elementor-icon-box-content">
                                                    <h3 class="elementor-icon-box-title"><span>{{ $badge['title'] }}</span></h3>
                                                    <p class="elementor-icon-box-description">{{ $badge['desc'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>

    {{-- ========== SECTION 2: Cute Stationery (Product Tabs) ========== --}}
    @if($featured->count() > 0 || $newArrivals->count() > 0 || $bestSellers->count() > 0)
    <section class="elementor-section elementor-top-section elementor-element elementor-element-8393d41 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="8393d41" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5c518f4" data-id="5c518f4" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-acb14ae elementor-widget elementor-widget-heading" data-id="acb14ae" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">Cute Stationery</h2>
                        </div>
                    </div>

                    <div class="elementor-element elementor-element-15d39fc products-block-carousel-hidden-yes arrow-style-1 dots-style-1 elementor-widget elementor-widget-stationero-products-tabs" data-id="15d39fc" data-element_type="widget" data-widget_type="stationero-products-tabs.default" x-data="{ activeTab: 1 }">
                        <div class="elementor-widget-container">
                            <div class="elementor-tabs" role="tablist">
                                <div class="elementor-tabs-wrapper">
                                    <div id="elementor-tab-title-2281" class="elementor-tab-title elementor-tab-desktop-title elementor-repeater-item-8daeeea" :class="activeTab === 1 ? 'elementor-active' : ''" data-tab="1" role="tab" @click="activeTab = 1" style="cursor:pointer">Deals</div>
                                    @foreach($topCategories->take(4) as $i => $tc)
                                        <div class="elementor-tab-title elementor-tab-desktop-title elementor-repeater-item-3712228" :class="activeTab === {{ $i + 2 }} ? 'elementor-active' : ''" data-tab="{{ $i + 2 }}" role="tab" @click="activeTab = {{ $i + 2 }}" style="cursor:pointer">{{ strtoupper($tc->name) }}</div>
                                    @endforeach
                                </div>

                                {{-- Deals Tab --}}
                                <div class="elementor-tab-content elementor-clearfix elementor-repeater-item-8daeeea" data-tab="1" role="tabpanel" x-show="activeTab === 1" x-transition>
                                    <div class="woocommerce columns-1">
                                        <ul class="products columns-5" data-elementor-columns="5" data-elementor-columns-tablet="3" data-elementor-columns-mobile="2">
                                            @foreach($featured->take(5) as $product)
                                                @include('components.product-card', ['product' => $product])
                                            @endforeach
                                            @if($featured->count() < 5)
                                                @foreach($newArrivals->take(5 - $featured->count()) as $product)
                                                    @include('components.product-card', ['product' => $product])
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                                {{-- Category Tabs --}}
                                @foreach($topCategories->take(4) as $i => $tc)
                                    <div class="elementor-tab-content elementor-clearfix" data-tab="{{ $i + 2 }}" role="tabpanel" x-show="activeTab === {{ $i + 2 }}" x-cloak x-transition>
                                        @php
                                            $catProducts = \App\Models\Product::where('category_id', $tc->id)->where('is_active', true)->with(['images', 'category'])->take(5)->get();
                                        @endphp
                                        <div class="woocommerce columns-1">
                                            <ul class="products columns-5" data-elementor-columns="5" data-elementor-columns-tablet="3" data-elementor-columns-mobile="2">
                                                @foreach($catProducts as $product)
                                                    @include('components.product-card', ['product' => $product])
                                                @endforeach
                                                @if($catProducts->count() === 0)
                                                    <li class="product" style="flex: 0 0 100%; max-width: 100%; text-align: center; padding: 40px;">No products in this category yet.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="elementor-element elementor-widget-divider--view-line elementor-widget elementor-widget-divider">
                        <div class="elementor-widget-container">
                            <div class="elementor-divider"><span class="elementor-divider-separator"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ========== SECTION 3: Shop by Categories ========== --}}
    <section class="elementor-section elementor-top-section elementor-element elementor-element-a7e4403 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="a7e4403" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b033140" data-id="b033140" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-2c5d22a elementor-widget elementor-widget-heading" data-id="2c5d22a" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">Shop by Categories</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-f1d5948 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="f1d5948" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            Essential office supplies in our online stationery shop that keep your office operations smooth and efficient
                        </div>
                    </div>

                    <section class="elementor-section elementor-inner-section elementor-element elementor-element-3bc9817 elementor-section-boxed elementor-section-height-default" data-id="3bc9817" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-no">
                            @php
                                $catImages = [
                                    '/template/wp-content/uploads/2022/04/h5_categories_01.jpg',
                                    '/template/wp-content/uploads/2022/04/h5_categories_02.jpg',
                                    '/template/wp-content/uploads/2022/04/h5_categories_03.jpg',
                                    '/template/wp-content/uploads/2022/04/h5_categories_04.jpg',
                                ];
                                $catLabels = ['books & stationery', 'pens & pencils', 'Paper & Card', 'school supplies'];
                                $displayCats = $categories->take(4);
                            @endphp

                            {{-- Left tall category --}}
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-7e710c8" data-id="7e710c8" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-6a475db vertical-align-flex-end product-cate-position-button arrow-style-2 dots-style-1 elementor-widget elementor-widget-stationero-product-categories" data-id="6a475db" data-element_type="widget" data-widget_type="stationero-product-categories.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-categories-item-wrapper">
                                                <ul class="row position-button" data-elementor-columns="1" data-elementor-columns-tablet="1" data-elementor-columns-mobile="1">
                                                    <li class="column-item elementor-categories-item">
                                                        <div class="product-cat cate_image">
                                                            <a class="link_category_product" href="{{ $displayCats->count() > 0 ? url('/category/' . $displayCats[0]->slug) : url('/products') }}" title="{{ $displayCats->count() > 0 ? $displayCats[0]->name : $catLabels[0] }}">
                                                                @if(isset($displayCats[0]) && $displayCats[0]->image)
                                                                    <img src="{{ asset('storage/' . $displayCats[0]->image) }}" alt="{{ $displayCats[0]->name }}">
                                                                @else
                                                                    <img src="{{ $catImages[0] }}" alt="{{ $catLabels[0] }}">
                                                                @endif
                                                            </a>
                                                            <div class="product-cat-caption">
                                                                <a href="{{ $displayCats->count() > 0 ? url('/category/' . $displayCats[0]->slug) : url('/products') }}">
                                                                    <span class="product-cat-title">{{ $displayCats->count() > 0 ? $displayCats[0]->name : $catLabels[0] }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Middle 2 stacked categories --}}
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-a206f0c" data-id="a206f0c" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    @for($ci = 1; $ci <= 2; $ci++)
                                    <div class="elementor-element vertical-align-flex-end product-cate-position-button arrow-style-2 dots-style-1 elementor-widget elementor-widget-stationero-product-categories" data-element_type="widget" data-widget_type="stationero-product-categories.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-categories-item-wrapper">
                                                <ul class="row position-button" data-elementor-columns="1" data-elementor-columns-tablet="1" data-elementor-columns-mobile="1">
                                                    <li class="column-item elementor-categories-item">
                                                        <div class="product-cat cate_image">
                                                            <a class="link_category_product" href="{{ $displayCats->count() > $ci ? url('/category/' . $displayCats[$ci]->slug) : url('/products') }}">
                                                                @if(isset($displayCats[$ci]) && $displayCats[$ci]->image)
                                                                    <img src="{{ asset('storage/' . $displayCats[$ci]->image) }}" alt="{{ $displayCats[$ci]->name }}">
                                                                @else
                                                                    <img src="{{ $catImages[$ci] }}" alt="{{ $catLabels[$ci] }}">
                                                                @endif
                                                            </a>
                                                            <div class="product-cat-caption">
                                                                <a href="{{ $displayCats->count() > $ci ? url('/category/' . $displayCats[$ci]->slug) : url('/products') }}">
                                                                    <span class="product-cat-title">{{ $displayCats->count() > $ci ? $displayCats[$ci]->name : $catLabels[$ci] }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>

                            {{-- Right tall category --}}
                            <div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-da69392" data-id="da69392" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div class="elementor-element elementor-element-f95d016 vertical-align-flex-end product-cate-position-button arrow-style-2 dots-style-1 elementor-widget elementor-widget-stationero-product-categories" data-id="f95d016" data-element_type="widget" data-widget_type="stationero-product-categories.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-categories-item-wrapper">
                                                <ul class="row position-button" data-elementor-columns="1" data-elementor-columns-tablet="1" data-elementor-columns-mobile="1">
                                                    <li class="column-item elementor-categories-item">
                                                        <div class="product-cat cate_image">
                                                            <a class="link_category_product" href="{{ $displayCats->count() > 3 ? url('/category/' . $displayCats[3]->slug) : url('/products') }}">
                                                                @if(isset($displayCats[3]) && $displayCats[3]->image)
                                                                    <img src="{{ asset('storage/' . $displayCats[3]->image) }}" alt="{{ $displayCats[3]->name }}">
                                                                @else
                                                                    <img src="{{ $catImages[3] }}" alt="{{ $catLabels[3] }}">
                                                                @endif
                                                            </a>
                                                            <div class="product-cat-caption">
                                                                <a href="{{ $displayCats->count() > 3 ? url('/category/' . $displayCats[3]->slug) : url('/products') }}">
                                                                    <span class="product-cat-title">{{ $displayCats->count() > 3 ? $displayCats[3]->name : $catLabels[3] }}</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== SECTION 4: Best Sellers ========== --}}
    @if($bestSellers->count() > 0)
    <section class="elementor-section elementor-top-section elementor-element elementor-element-d716b30 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="d716b30" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-04405ee" data-id="04405ee" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-014981a elementor-widget elementor-widget-heading" data-id="014981a" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">Best Sellers</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-7fc93ef elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="7fc93ef" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            Essential office supplies in our online stationery shop that keep your office operations smooth and efficient
                        </div>
                    </div>

                    <div class="elementor-element elementor-element-b6c42e2 products-block-carousel-hidden-yes arrow-style-1 dots-style-1 elementor-widget elementor-widget-stationero-products" data-id="b6c42e2" data-element_type="widget" data-widget_type="stationero-products.default">
                        <div class="elementor-widget-container">
                            <div class="woocommerce columns-1">
                                <ul class="products columns-5" data-elementor-columns="5" data-elementor-columns-tablet="3" data-elementor-columns-mobile="2">
                                    @foreach($bestSellers->take(6) as $product)
                                        @include('components.product-card', ['product' => $product])
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ========== SECTION 5: Deal Of The Day ========== --}}
    @if($dealProduct)
    <section class="elementor-section elementor-top-section elementor-element elementor-element-09ebf74 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="09ebf74" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-f9b2b3c" data-id="f9b2b3c" data-element_type="column" data-settings='{"background_background":"classic"}'>
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-913b6c9 elementor-widget elementor-widget-heading" data-id="913b6c9" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">Deal Of The Day</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-89691d3 elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-id="89691d3" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>Essential office supplies in our online stationery shop that keep.</p>
                        </div>
                    </div>

                    {{-- Countdown --}}
                    <div class="elementor-element elementor-element-169da94 countdown-style-3 elementor-widget elementor-widget-stationero-countdown" data-id="169da94" data-element_type="widget" data-widget_type="stationero-countdown.default">
                        <div class="elementor-widget-container">
                            @php
                                $endDate = now()->addDays(7)->timestamp;
                            @endphp
                            <div class="elementor-stationero-countdown" data-date="{{ $endDate }}">
                                <div class="elementor-countdown-item days"><span class="elementor-countdown-digits elementor-countdown-days"></span> <span class="elementor-countdown-label">Days</span></div>
                                <div class="elementor-countdown-item hours"><span class="elementor-countdown-digits elementor-countdown-hours"></span> <span class="elementor-countdown-label">Hours</span></div>
                                <div class="elementor-countdown-item minutes"><span class="elementor-countdown-digits elementor-countdown-minutes"></span> <span class="elementor-countdown-label">Minutes</span></div>
                                <div class="elementor-countdown-item seconds"><span class="elementor-countdown-digits elementor-countdown-seconds"></span> <span class="elementor-countdown-label">Seconds</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="elementor-element elementor-element-4b55d45 elementor-align-left elementor-widget elementor-widget-button" data-id="4b55d45" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-button-wrapper">
                                <a href="{{ url('/products/' . $dealProduct->slug) }}" class="elementor-button-link elementor-button elementor-size-md" role="button">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon elementor-align-icon-right">
                                            <i aria-hidden="true" class="stationero-icon- stationero-icon-arrow-right"></i>
                                        </span>
                                        <span class="elementor-button-text">Shop Now  </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ========== SECTION 6: 3-Column Promo Cards ========== --}}
    <section class="elementor-section elementor-top-section elementor-element elementor-element-66279a3 elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="66279a3" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            @php
                $promoCards = [
                    ['id' => 'f371e8b', 'title' => "Notebooks\n& Pens", 'desc' => 'The solution for a perfectly coordinated desk.'],
                    ['id' => '2bd5c54', 'title' => "Back \nto School", 'desc' => 'Stock up for school with our new and improved 3 for 2 offer.'],
                    ['id' => 'c222906', 'title' => "Birthday \nCards", 'desc' => 'Near or far, find the perfect card to celebrate their birthday.'],
                ];
            @endphp
            @foreach($promoCards as $promo)
            <div class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-{{ $promo['id'] }}" data-id="{{ $promo['id'] }}" data-element_type="column" data-settings='{"background_background":"classic"}'>
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-widget__width-initial elementor-widget elementor-widget-heading" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">{!! nl2br(e($promo['title'])) !!}</h2>
                        </div>
                    </div>
                    <div class="elementor-element elementor-widget__width-initial elementor-widget elementor-widget-text-editor" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            {{ $promo['desc'] }}
                        </div>
                    </div>
                    <div class="elementor-element elementor-align-left elementor-widget elementor-widget-button" data-element_type="widget" data-widget_type="button.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-button-wrapper">
                                <a href="{{ url('/products') }}" class="elementor-button-link elementor-button elementor-size-md" role="button">
                                    <span class="elementor-button-content-wrapper">
                                        <span class="elementor-button-icon elementor-align-icon-right">
                                            <i aria-hidden="true" class="stationero-icon- stationero-icon-arrow-right"></i>
                                        </span>
                                        <span class="elementor-button-text">Shop Now  </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ========== SECTION 7: Testimonials + Gallery ========== --}}
    <section class="elementor-section elementor-top-section elementor-element elementor-element-0e2c00c elementor-section-stretched elementor-section-boxed elementor-section-height-default" data-id="0e2c00c" data-element_type="section" data-settings='{"stretch_section":"section-stretched"}'>
        <div class="elementor-container elementor-column-gap-no">
            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5f4f9a5" data-id="5f4f9a5" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">

                    {{-- Divider --}}
                    <div class="elementor-element elementor-widget-divider--view-line elementor-widget elementor-widget-divider">
                        <div class="elementor-widget-container">
                            <div class="elementor-divider"><span class="elementor-divider-separator"></span></div>
                        </div>
                    </div>

                    {{-- Testimonials Heading --}}
                    <div class="elementor-element elementor-element-bf9881d elementor-widget elementor-widget-heading" data-id="bf9881d" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h2 class="elementor-heading-title elementor-size-default">our customers say</h2>
                        </div>
                    </div>

                    {{-- Testimonials Carousel --}}
                    <div class="elementor-element elementor-element-a45df27 testimonials-position-top testimonials-alignment-center arrow-style-1 dots-style-1 elementor-widget elementor-widget-stationero-testimonials" data-id="a45df27" data-element_type="widget" data-widget_type="stationero-testimonials.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-testimonial-item-wrapper">
                                <div class="row stationero-carousel" data-settings='{"navigation":"dots","autoplayHoverPause":true,"autoplay":true,"autoplaySpeed":5000,"items":1,"items_laptop":1,"items_tablet":"1","items_mobile":1,"loop":true,"breakpoint_laptop":1366,"breakpoint_tablet_extra":1200,"breakpoint_tablet":1024,"breakpoint_mobile_extra":880,"breakpoint_mobile":767,"rtl":false}'>
                                    @php
                                        $testimonials = [
                                            ['quote' => 'Amazing quality stationery! I ordered notebooks and pens for my entire office and everyone loved them. The delivery was super fast too.', 'name' => 'Sarah Fernando', 'role' => 'Office Manager'],
                                            ['quote' => 'My go-to shop for all school supplies. The prices are unbeatable and the variety is incredible. Highly recommend!', 'name' => 'Dinesh Perera', 'role' => 'Teacher'],
                                            ['quote' => 'Beautiful packaging, premium products, and excellent customer service. I keep coming back for more art supplies every month.', 'name' => 'Amaya Silva', 'role' => 'Artist'],
                                        ];
                                    @endphp
                                    @foreach($testimonials as $t)
                                    <div class="column-item elementor-testimonial-item">
                                        <div class="inner">
                                            <div class="testimonial-content">
                                                <div class="testimonial-icon"><i class="stationero-icon-quote2"></i></div>
                                                <div class="testimonial_info">
                                                    <div class="content">" {{ $t['quote'] }} "</div>
                                                    <div class="testimonial-caption">
                                                        <div class="testimonial-caption-inner">
                                                            <div class="elementor-testimonial-details">
                                                                <div class="name">{{ $t['name'] }}</div>
                                                                <div class="job">{{ $t['role'] }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Image Gallery --}}
                    <div class="elementor-element elementor-element-790a06f elementor-widget elementor-widget-stationero-image-gallery" data-id="790a06f" data-element_type="widget" data-widget_type="stationero-image-gallery.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-opal-image-gallery">
                                <div class="row grid" data-elementor-columns="5" data-elementor-columns-tablet="3" data-elementor-columns-mobile="2">
                                    @for($g = 1; $g <= 5; $g++)
                                    <div class="column-item grid__item masonry-item__all gallery_group_0">
                                        <a data-elementor-open-lightbox="yes" data-elementor-lightbox-slideshow="790a06f" href="/template/wp-content/uploads/2022/04/h5_image_{{ $g }}.jpg">
                                            <img src="/template/wp-content/uploads/2022/04/h5_image_{{ $g }}.jpg" alt="Gallery image {{ $g }}">
                                            <div class="gallery-item-overlay">
                                                <i class="stationero-icon-search"></i>
                                            </div>
                                        </a>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@push('scripts')
<script>
// Countdown timer fallback if Stationero JS doesn't initialize it
jQuery(document).ready(function($) {
    var $countdown = $('.elementor-stationero-countdown');
    if ($countdown.length && $countdown.find('.elementor-countdown-days').text() === '') {
        var targetDate = parseInt($countdown.data('date')) * 1000;
        function updateCountdown() {
            var now = new Date().getTime();
            var distance = targetDate - now;
            if (distance < 0) distance = 0;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            $countdown.find('.elementor-countdown-days').text(String(days).padStart(2, '0'));
            $countdown.find('.elementor-countdown-hours').text(String(hours).padStart(2, '0'));
            $countdown.find('.elementor-countdown-minutes').text(String(minutes).padStart(2, '0'));
            $countdown.find('.elementor-countdown-seconds').text(String(seconds).padStart(2, '0'));
        }
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }
});
</script>
@endpush
