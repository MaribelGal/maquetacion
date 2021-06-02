@isset($product_specific->model->brand->name)
            <div class="product-brand">
                <h4>{{$product_specific->model->brand->name}}</h4>
            </div>
        @endisset

@isset($product_specific->product->stock->quantity)
    <div class="product-stock">
        @if ($product_specific->product->stock->quantity <= 5)
            <p> ¡¡Solo quedan <span>{{$product_specific->product->stock->quantity}}</span>!! </p>
        @endif
    </div> 
@endisset

@isset($product_specific['price'])
    <div class="product-price"> 
        @isset($product_specific['price']['discount'])
            <div class="product-price-discount">
            <p> Descuento: {{$product_specific['price']['discount']}}% </p>
            </div>
            <div class="product-price-original">
                <p> Antes: {{$product_specific['price']['original']}} </p>
            </div>
            <div class="product-price-final">
                <p> Ahora: {{$product_specific['price']['final']}} con iva</p>
            </div>
        @else                 
            <div class="product-price-final">
                <p> {{$product_specific['price']['final']}} con iva</p>
            </div>
        @endisset
    </div>
@endisset
