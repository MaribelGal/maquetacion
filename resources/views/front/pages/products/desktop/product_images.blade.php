<div class="product-images-featured grid-column-2 grid-column-span-3 grid-row-1">
    @isset($product_specific->product->image_featured_desktop->path)
        <img src="{{ Storage::url($product_specific->product->image_featured_desktop->path) }}"
            alt="{{ $product_specific->product->image_featured_desktop->alt }}"
            title="{{ $product_specific->product->image_featured_desktop->title }}" />
    @endif
</div>

<div class="product-images-grid grid-column-1 grid-row-1 grid">
    @isset($product_specific->product->image_grid_preview_lang)
        @foreach ($product_specific->product->image_grid_preview_lang as $item)
            <div class="product-images-grid-item grid-column-1 grid-row-{{ $loop->iteration }}">
                <img src="{{ Storage::url($item->path) }}" alt="{{ $item->alt }}" title="{{ $item->title }}" />
            </div>
        @endforeach
    @endisset
</div>
