@php
    use Debugbar;

    $table = $product->product_specific_table;
    $id = $product->product_specific_id;
    Debugbar::info($product->product_specific_table);
    Debugbar::info($product->product_specific_id);
    Debugbar::info($product->tissues);
    Debugbar::info($product_specific->neck->locale);
@endphp
<div class="product grid">

    <div class="product-categories grid-column-span-2 grid-row-1">
        Categoria/categoria/categoria
    </div>
    <div class="product-images grid-column-1 grid-row-2 grid">
        <div class="product-images-featured grid-column-2 grid-column-span-3 grid-row-1">
            @isset($product->image_featured_desktop->path)
                <img 
                src="{{Storage::url($product->image_featured_desktop->path)}}" 
                alt="{{$product->image_featured_desktop->alt}}" 
                title="{{$product->image_featured_desktop->title}}" />
            @endif
        </div>
        <div class="product-images-grid grid-column-1 grid-row-1 grid">

            @foreach ($product->image_grid_preview_lang as $item)
                <div class="product-images-grid-item grid-column-1 grid-row-{{$loop->iteration}}">
                    <img 
                    src="{{Storage::url($item->path)}}" 
                    alt="{{$item->alt}}" 
                    title="{{$item->title}}" />
                </div>
            @endforeach
            
        </div>
    </div>

    <div class="product-description grid-column-1 grid-row-3">
        <div class="product-description-text">
            <span>Descripcion: @lang('front.products.title_description')</span>
            {!!isset($product->locale['description']) ? $product->locale['description'] : "" !!}
        </div>
    </div>

    <div class="product-detail grid-column-2 grid-row-2 grid-row-span-2">
        <div class="product-brand">
            <h4>{{$product_specific->brand->name}}</h4>
        </div>
        <div class="product-title">
            <h3>{{isset($product->seo->title) ? $product->seo->title : ""}}</h3>
        </div>
        <div class="product-stock">
            @if ($product->stock->quantity <= 5)
                <p> ¡¡Solo quedan <span>{{$product->stock->quantity}}</span>!! <p>
            @endif
        </div>
        <div class="product-variants-area">
           
        </div>
        <div class="product-price"> 
            @isset($price['discount'])
                <div class="product-price-discount">
                  <p> Descuento: {{$price['discount']}}% </p>
                </div>
                <div class="product-price-original">
                    <p> Antes: {{$price['original']}} </p>
                </div>
                <div class="product-price-final">
                    <p>Ahora: {{$price['final']}} con iva</p>
                </div>
            @else                 
                <div class="product-price-final">
                    <p> {{$price['final']}} con iva</p>
                </div>
            @endisset


        </div>
        <div class="product-pruchase-area grid">
            <div class="product-buy grid-column-span-2 grid-row-1">
                Comprar
            </div>
            <div class="product-cart grid-column-3 grid-row-1">
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M10,0V4H8L12,8L16,4H14V0M1,2V4H3L6.6,11.59L5.25,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42C7.29,15 7.17,14.89 7.17,14.75L7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.59 17.3,11.97L21.16,4.96L19.42,4H19.41L18.31,6L15.55,11H8.53L8.4,10.73L6.16,6L5.21,4L4.27,2M7,18A2,2 0 0,0 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20A2,2 0 0,0 7,18M17,18A2,2 0 0,0 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20A2,2 0 0,0 17,18Z" />
                </svg>
            </div>
            <div class="product-whislist grid-column-span-3 grid-row-2">
                Lista de deseos
            </div>
        </div>
        <div class="product-specifications-area">
            <div class="product-specifications-area-title">Características</div>
            @include('front.pages.products.desktop.product_specifications', [
                'product'=> $product,
                'product_specific'=> $product_specific,
            ])
        </div>
    </div>
    
</div>
