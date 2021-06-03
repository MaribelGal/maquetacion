@php
$product_specific_active = $products_specifics[0];
@endphp

@isset($product_specific_active->model->brand->name)
    <div class="product-brand grid-row-4 grid-column-2">
        <h4>{{ $product_specific_active->model->brand->name }}</h4>
    </div>
@endisset



<div class="product-purchase-area grid-column-3 grid-row-2 grid">

    @isset($product_specific->product->stock->quantity)
        <div class="product-purchase-item">
            <div class="product-stock grid-column-span-2 grid-row-1">
                @if ($product_specific->product->stock->quantity <= 5)
                    <p> ¡¡Solo quedan <span>{{ $product_specific->product->stock->quantity }}</span>!! </p>
                @endif
            </div>
        </div>
    @endisset
    <div class="product-purchase-item">
        <div class="product-buy grid-column-1 grid-row-2"> 
            <p>Comprar</p>
        </div>
    </div>
    <div class="product-purchase-item">

        <div class="product-cart grid-column-2 grid-row-2">
            <svg viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M10,0V4H8L12,8L16,4H14V0M1,2V4H3L6.6,11.59L5.25,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42C7.29,15 7.17,14.89 7.17,14.75L7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.59 17.3,11.97L21.16,4.96L19.42,4H19.41L18.31,6L15.55,11H8.53L8.4,10.73L6.16,6L5.21,4L4.27,2M7,18A2,2 0 0,0 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20A2,2 0 0,0 7,18M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18Z" />
            </svg>
        </div>
    </div>
    <div class="product-purchase-item">

        <div class="product-wishlist grid-column-span-2 grid-row-3">
           <p>Añadir a la lista de deseos</p> 
        </div>
    </div>
</div>


@isset($price)
    <div class="product-price grid-column-2 grid-row-3">
        @isset($price['discount'])
            <div class="product-price-item">
                <div class="product-price-discount">
                    <p>{{ $price['discount'] }}% </p>
                </div>
            </div>
            <div class="product-price-item">

                <div class="product-price-original">
                    <p>{{ $price['original'] }}€ </p>
                </div>
            </div>
            <div class="product-price-item">

                <div class="product-price-final">
                    <p>{{ $price['final'] }}€</p>
                </div>
            </div>
        @else
            <div class="product-price-item">

                <div class="product-price-final">
                    <p> {{ $price['final'] }}€</p>
                </div>
            </div>
        @endisset
    </div>
@endisset
