<div class="products">

    <div class="products-title">
        <h1>@lang('front/products.title')</h1>
    </div>

    <div class="products-grid">
        <div class="product-item">
            <div class="product-item-image-featured">
                <img src="https://www.luanvi.com/2352-xlarge_default/camiseta-mc-huevo.jpg" alt="">
            </div>
            <div class="product-item-title">
                <p>Camiseta huevo frito</p>
            </div>
            <div class="product-item-price">
                <p>30,50€</p>
            </div>
        </div>

        <div class="product-item">
            <div class="product-item-image-featured">
                <img src="https://www.luanvi.com/2352-xlarge_default/camiseta-mc-huevo.jpg" alt="">
            </div>
            <div class="product-item-title">
                <p>Camiseta huevo frito</p>
            </div>
            <div class="product-item-price">
                <p>30,50€</p>
            </div>
        </div>

        

        @foreach ($products as $product)
            <div class="product-item" data-content="{{ $loop->iteration }}">
                <div class="product-title-container">
                    <div class="product-title">
                        <h3>{{ isset($product->seo->title) ? $product->seo->title : '' }}</h3>
                    </div>

                    <div class="product-plus-button" data-button="{{ $loop->iteration }}"></div>
                </div>
                <div class="product-description">
                    <div class="product-description-text">
                        {!! isset($product->locale['description']) ? $product->locale['description'] : '' !!}
                    </div>

                    <div class="product-description-image">
                        @isset($product->image_featured_desktop->path)
                            <div class="product-description-image-featured">
                                <img src="{{ Storage::url($product->image_featured_desktop->path) }}"
                                    alt="{{ $product->image_featured_desktop->alt }}"
                                    title="{{ $product->image_featured_desktop->title }}" />
                            </div>
            @endif

            @isset($product->image_grid_desktop)
                <div class="product-description-image-grid">
                    @foreach ($product->image_grid_desktop as $image)
                        <div class="product-description-image-grid-item">
                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->alt }}" title="{{ $image->title }}" />
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        </div>
        @endforeach
        </div>

        </div>
