@php
    use Debugbar;
    $product_specific_active = $products_specifics[0];
@endphp

<form class="product-variants-form" id="product-variants-form" action="{{ route('filter_productGroup') }}" autocomplete="off">

    {{ csrf_field() }}

    <input type="hidden" name="productGroup_id" value={{$product->id}}>
    <input type="hidden" name="product_specific_table" value={{$product_specific_table}}>
    <input type="hidden" name="product_specific_model" value={{$product_specific_model}}>
    

    @isset($product_specific_active->color)
        <div class="product-variant-item" data-variant-name="variant[color_id]">
            <legend>Elige un color</legend>
            @foreach ($variants['color_id'] as $variant_color)
                <label>
                    <input  
                    class="product-variant-item-data"
                    data-variant-name="variant[color_id]"
                    type="radio" 
                    name="product_variant" 
                    value="{{$variant_color}}"
                    {{($product_specific_active->color_id == $variant_color) ? 'checked' : ''}}
                    /> {{$product_specific_active->color->locale[0]->value}} {{$variant_color}}
                </label>
            @endforeach
        </div>
    @endisset


    @isset($product_specific_active->size)

        <div class="product-variant-item" data-variant-name="variant[size_id]">
            <select 
            name="product_variant" 
            class="product-variant-item-data"
            data-variant-name="variant[size_id]">
                @foreach ($products_specifics as $product)
                    <option 
                    value="{{$product->size_id}}"
                    {{($product_specific_active->size_id == $product->size_id) ? 'selected' : ''}}
                    >
                        {{$product->size->locale[0]->value}}
                    </option>
                @endforeach

            </select>
        </div>
    @endisset
</form>

