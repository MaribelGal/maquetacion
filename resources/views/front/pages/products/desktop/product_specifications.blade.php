{{-- @php
    use Debugbar;
    // Debugbar::info($products_specific);
    // foreach ($products_specific as $product_specific) {
        Debugbar::info($product_specific->model->products);
    // }
    // Debugbar::info($product);
@endphp --}}


@isset($product_specific->size)
    <div class="product-size">
        <div class="product-size-item">Talla: {{$product_specific->size->locale[0]->value}}</div>
    </div>
@endisset

@isset($product_specific->model->tissues)
    <div class="product-tissues">
        @foreach ($product_specific->model->tissues as $tissue_item)
            <div class="product-tissue-item">Tejido: {{$tissue_item->tissue->locale[0]->value}}  {{$tissue_item->percentage_tissue}}%</div>
        @endforeach
    </div>
@endisset

@isset($product_specific->model->sleeve)
    <div class="product-sleeve">Mangas: {{$product_specific->model->sleeve->locale[0]->value}}</div>
@endisset

@isset($product_specific->model->neck)
    <div class="product-neck">Cuello: {{$product_specific->model->neck->locale[0]->value}}</div>
@endisset

@isset($product_specific->color)
    <div class="product-color">Color: {{$product_specific->color->locale[0]->value}}</div>
@endisset

@isset($product_specific->model->pattern)
    <div class="product-pattern">Estampado: {{$product_specific->model->pattern->locale[0]->value}}</div>    
@endisset