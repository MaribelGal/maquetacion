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

                @isset($product->image_featured_desktop->path)
                    <div class="product-description-image">
                        <img src="{{Storage::url($product->image_featured_mobile->path)}}" alt="{{$product->image_featured_mobile->alt}}"  title="{{$product->image_featured_mobile->title}}"/>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    
</div>
