@props(['product'])

@php
    $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
    $imageUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://placehold.co/400x400/f5f5f5/999999?text=' . urlencode($product->name);
    $effectivePrice = $product->sale_price && $product->sale_price > 0 ? $product->sale_price : $product->price;
    $onSale = $product->sale_price && $product->sale_price > 0 && $product->sale_price < $product->price;
    $stockClass = $product->stock_quantity > 0 ? 'instock' : 'outofstock';
    $featuredClass = $product->is_featured ? 'featured' : '';
    $saleClass = $onSale ? 'sale' : '';
@endphp

<li class="product type-product status-publish {{ $stockClass }} {{ $featuredClass }} {{ $saleClass }} has-post-thumbnail purchasable product-type-simple">
    <div class="product-block">
        <div class="content-product-imagin"></div>
        <div class="product-transition">
            <div class="product-image">
                <img width="400" height="400" src="{{ $imageUrl }}" class="attachment-shop_catalog size-shop_catalog" alt="{{ $product->name }}" loading="lazy"
                     onerror="this.src='https://placehold.co/400x400/f5f5f5/999999?text=No+Image'">
            </div>
            <div class="group-action">
                <div class="shop-action">
                    <button class="woosq-btn" data-id="{{ $product->id }}" onclick="window.location='{{ url('/products/' . $product->slug) }}'">Quick view</button>
                </div>
            </div>
            <a href="{{ url('/products/' . $product->slug) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
        </div>
        <div class="product-caption">
            <h3 class="woocommerce-loop-product__title">
                <a href="{{ url('/products/' . $product->slug) }}">{{ $product->name }}</a>
            </h3>
            @if($onSale)
                <span class="price">
                    <del aria-hidden="true">
                        <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">LKR </span>{{ number_format($product->price, 2) }}</bdi></span>
                    </del>
                    <ins>
                        <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">LKR </span>{{ number_format($effectivePrice, 2) }}</bdi></span>
                    </ins>
                </span>
            @else
                <span class="price">
                    <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">LKR </span>{{ number_format($effectivePrice, 2) }}</bdi></span>
                </span>
            @endif
        </div>
        <div class="product-caption-bottom">
            @if($product->stock_quantity > 0)
                <form method="POST" action="{{ url('/cart/add') }}" style="display:inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="button product_type_simple add_to_cart_button" aria-label="Add &ldquo;{{ $product->name }}&rdquo; to your cart">Add to cart</button>
                </form>
            @else
                <a href="{{ url('/products/' . $product->slug) }}" class="button product_type_simple" aria-label="Read more about &ldquo;{{ $product->name }}&rdquo;">Read more</a>
            @endif
        </div>
    </div>
</li>
