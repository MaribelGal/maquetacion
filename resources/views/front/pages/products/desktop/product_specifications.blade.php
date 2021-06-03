@php
    $product_specific_active = $products_specifics[0];
@endphp


@isset($product_specific_active->size)
    <div class="product-size">
        <div class="product-size-item">Talla: {{$product_specific_active->size->locale[0]->value}}</div>
    </div>
@endisset

@isset($product_specific_active->model->tissues)
    <div class="product-tissues">
        @foreach ($product_specific_active->model->tissues as $tissue_item)
            <div class="product-tissue-item">Tejido: {{$tissue_item->tissue->locale[0]->value}}  {{$tissue_item->percentage_tissue}}%</div>
        @endforeach
    </div>
@endisset

@isset($product_specific_active->model->sleeve)
    <div class="product-sleeve">Mangas: {{$product_specific_active->model->sleeve->locale[0]->value}}</div>
@endisset

@isset($product_specific_active->model->neck)
    <div class="product-neck">Cuello: {{$product_specific_active->model->neck->locale[0]->value}}</div>
@endisset

@isset($product_specific_active->color)
    <div class="product-color">Color: {{$product_specific_active->color->locale[0]->value}}</div>
@endisset

@isset($product_specific_active->model->pattern)
    <div class="product-pattern">Estampado: {{$product_specific_active->model->pattern->locale[0]->value}}</div>    
@endisset