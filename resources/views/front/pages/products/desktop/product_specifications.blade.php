@isset($product_specific->size)
    <div class="product-size">
        <div class="product-size-item">Talla: {{$product_specific->size->locale[0]->value}}</div>
    </div>
@endisset

@isset($product->tissues)
    <div class="product-tissues">
        @foreach ($product->tissues as $tissue_item)
            <div class="product-tissue-item">Tejido: {{$tissue_item->tissue->locale[0]->value}}  {{$tissue_item->percentage_tissue}}%</div>
        @endforeach
    </div>
@endisset

@isset($product_specific->sleeve)
    <div class="product-sleeve">Mangas: {{$product_specific->sleeve->locale[0]->value}}</div>
@endisset

@isset($product_specific->neck)
    <div class="product-neck">Cuello: {{$product_specific->neck->locale[0]->value}}</div>
@endisset

@isset($product_specific->color)
    <div class="product-color">Color: {{$product_specific->color->locale[0]->value}}</div>
@endisset

@isset($product_specific->pattern)
    <div class="product-pattern">Estampado: {{$product_specific->pattern->locale[0]->value}}</div>    
@endisset