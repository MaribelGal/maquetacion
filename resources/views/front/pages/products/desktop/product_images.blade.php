@php
    $product_specific_active = $products_specifics[0];
@endphp

<div class="product-images-featured grid-column-2 grid-row-span-2">
    @isset($product_specific_active->product->image_featured_desktop->path)
        <img src="{{ Storage::url($product_specific_active->product->image_featured_desktop->path) }}"
            alt="{{ $product_specific_active->product->image_featured_desktop->alt }}"
            title="{{ $product_specific_active->product->image_featured_desktop->title }}" />
    @endif
</div>

<div class="product-images-grid ">
    @isset($product_specific_active->product->image_grid_preview_lang)
        @foreach ($product_specific_active->product->image_grid_preview_lang as $item)
            <div class="product-images-grid-item ">
                <img src="{{ Storage::url($item->path) }}" alt="{{ $item->alt }}" title="{{ $item->title }}" />
            </div>
        @endforeach
    @endisset
</div>
