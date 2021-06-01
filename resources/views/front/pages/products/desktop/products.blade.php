<div class="products">

    <div class="products-title">
        <h3>@lang('front/products.title')</h3>
    </div>
    
    @foreach ($products as $product)
        <div class="product" data-content="{{$loop->iteration}}">
            <div class="product-title-container">
                <div class="product-title">
                    <h3>{{isset($product->seo->title) ? $product->seo->title : ""}}</h3>
                </div>

                <div class="product-plus-button" data-button="{{$loop->iteration}}"></div>
            </div>
            <div class="product-description">
                <div class="product-description-text">
                    {!!isset($product->locale['description']) ? $product->locale['description'] : "" !!}
                </div>

                <div class="product-description-image">
                    @isset($product->image_featured_desktop->path)
                        <div class="product-description-image-featured">
                            <img src="{{Storage::url($product->image_featured_desktop->path)}}" alt="{{$product->image_featured_desktop->alt}}" title="{{$product->image_featured_desktop->title}}" />
                        </div>
                    @endif

                    @isset($product->image_grid_desktop)
                        <div class="product-description-image-grid">
                            @foreach ($product->image_grid_desktop as $image)
                                <div class="product-description-image-grid-item">
                                    <img src="{{Storage::url($image->path)}}" alt="{{$image->alt}}" title="{{$image->title}}" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>                
            </div>
        </div>
    @endforeach
    
</div>
