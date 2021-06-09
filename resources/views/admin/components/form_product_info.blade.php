<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">Proveedor</label>
    </div>
    <div class="form-input">
        <select name="product[supplier]" >
            <option hidden selected>-- Proveedor --</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}"
                    class="rename-variant-item"
                    @isset($product)
                        {{ $product->cost->supplier_id == $supplier->id ? 'selected' : ''}}
                    @endisset
                    >{{ $supplier->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">Precio coste</label>
    </div>
    <div class="form-input">
        <input type="number" 
        class="rename-variant-item" 
        name="product[cost]"
        placeholder="Precio coste" 
        value="{{ isset($product) ? $product->cost->cost : '' }}" />
    </div>
</div>

<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">Precio base venta</label>
    </div>
    <div class="form-input">
        <input type="number" 
        class="rename-variant-item" 
        name="product[price][purchase]"
        placeholder="Precio de venta (sin tasas)" 
        value="{{ isset($product) ? $product->price_purchase->price : '' }}" />
    </div>
</div>

<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">
            Precio base alquiler
        </label>
    </div>
    <div class="form-input">
        <input type="number" 
        class="rename-variant-item" 
        name="product[price][rent]"
        placeholder="Precio de alquiler (sin tasas)" 
        value="{{ isset($product) ? $product->price_rent->price_hour : '' }}" />
    </div>
</div>

<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">Stock</label>
    </div>
    <div class="form-input">
        <input type="number" 
        class="rename-variant-item"
        name="product[stock]"
        placeholder="Stock" 
        value="{{ isset($product->stock->quantity) ? $product->stock->quantity : '' }}" />
    </div>
</div>

<p>Selecciona los modificadores de precio a aplicar:</p>

<p>Alquiler: </p>

@foreach ($prices_modifiers as $price_modifier)
<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">{{ $price_modifier->name }}</label>
    </div>
    <div class="form-input">
        <input 
        type="checkbox"
        class="rename-variant-item"
        name="product[modifier][purchase][{{ $price_modifier->id }}]" 
        value="{{ $price_modifier->id }}"
        @isset($product)
            @foreach ($product->price_modifiers_purchase as $modifier_purchase)
                {{ $modifier_purchase->modifier_id == $price_modifier->id ? 'checked' : ''}}
            @endforeach
        @endisset
        > 
    </div>
</div>
@endforeach

<p>Venta: </p>
@foreach ($prices_modifiers as $price_modifier)
<div class="form-group">
    <div class="form-label">
        <label for="name" class="label-highlight">{{ $price_modifier->name }}</label>
    </div>
    <div class="form-input">
        <input 
        type="checkbox" 
        class="rename-variant-item"
        name="product[modifier][rent][{{ $price_modifier->id }}]" 
        value="{{ $price_modifier->id }}"
        @isset($product)
            @foreach ($product->price_modifiers_rent as $modifier_rent)
                {{ $modifier_rent->modifier_id == $price_modifier->id ? 'checked' : ''}}
            @endforeach
        @endisset
        > 
    </div>
</div>
@endforeach