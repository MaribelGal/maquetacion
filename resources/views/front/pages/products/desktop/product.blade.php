@php
$product_specific_active = $products_specifics[0];
@endphp


@isset($product_specific_active)
    {{-- <div class="product-categories"></div> --}}

    <div class="product grid">

        <div class="product-images contents" id="product-images">
            @include('front.pages.products.desktop.product_images')
        </div>

        <div class="product-detail">
            @isset($product->seo->title)
                <div class="product-title">
                    <h3>{{ isset($product->seo->title) ? $product->seo->title : '' }}</h3>
                </div>
            @endisset

            <div class="product-description">
                <div class="product-description-text">
                    <p>{!! isset($product->locale['description']) ? $product->locale['description'] : '' !!}</p>
                </div>
            </div>
        </div>

        <div class="product-data contents" id="product-data">
            @include('front.pages.products.desktop.product_data')
        </div>

        <div class="product-variants-area grid-column-3 grid-row-1" id="product-variants-area">
            @include('front.pages.products.desktop.product_variants')
        </div>


        <div class="product-specifications-area grid-column-3" id="product-specifications-area">
            <div class="product-specifications-area-title">Características</div>
            @include('front.pages.products.desktop.product_specifications')
        </div>



    </div>

@endisset
