<div class="product">

    <div class="product-title">
        <h3>{{isset($product->seo->title) ? $product->seo->title : ""}}</h3>
    </div>
    
    <div class="product-description">
        <div class="product-description-text">
            {!!isset($product->locale['description']) ? $product->locale['description'] : "" !!}
        </div>

        @isset($product->image_featured_desktop->path)
            <div class="product-description-image">
                <img src="{{Storage::url($product->image_featured_desktop->path)}}" alt="{{$product->image_featured_desktop->alt}}" title="{{$product->image_featured_desktop->title}}" />
            </div>
        @endif
    </div>

</div>
