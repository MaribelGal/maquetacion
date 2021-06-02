@php
    use Debugbar;

    
    // Debugbar::info($products_specific);

    // foreach ($products_specific as $product_specific) {

        Debugbar::info($product_specific->color_id);


        foreach ($product_specific->model->products as $product) {
            Debugbar::info($product->color_id);
        }
    // }

    // Debugbar::info($product);

@endphp



    @isset($product_specific->color)
    <div class="product-variant-item" data-variant-name="color_id">
        <legend>Elige un color</legend>

        @foreach ($product_specific->model->products as $product)
            <label>
                <input 
                type="radio" 
                name="color" 
                value="{{$product->color->locale[0]->value}}"
                {{($product_specific->color_id == $product->color_id) ? 'checked' : ''}}
                > {{$product->color->locale[0]->value}}
            </label>
        @endforeach
    </div>
    @endisset


    @isset($product_specific->size)

    <div class="product-variant-item" data-variant-name="size_id">
        <select name="select">

            @foreach ($product_specific->model->products as $product)

                <option 
                value="{{$product->size->locale[0]->value}}"
                {{($product_specific->size_id == $product->size_id) ? 'selected' : ''}}
                >
                    {{$product->size->locale[0]->value}}
                </option>

            @endforeach

        </select>
    </div>
    @endisset


