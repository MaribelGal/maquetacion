<div hidden 
class="generate-item-onload variant-item_active variant-template"
data-tag="variant-item"
>
    <form 
    class="form-variant-item admin-form" 
    action="{{route("shirts_store")}}" 
    autocomplete="off">
        {{ csrf_field() }}

        <input autocomplete="false" name="hidden" type="text" style="display:none;">


        <div class="form-group">
            <div class="form-label">
                <label for="name" class="label-highlight">Color</label>
            </div>
            <div class="form-input">
                    <select name="product[specific][col][color_id]" class="rename-variant-item">
                        <option hidden selected>-- Color --</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}"
                                {{ $shirt->color_id == $color->id ? 'selected' : '' }}>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
            </div>
        </div>

        <div class="form-group">
            <div class="form-label">
                <label for="name" class="label-highlight">Talla</label>
            </div>
            <div class="form-input">
                <select name="product[specific][col][size_id]" class="rename-variant-item">
                    <option hidden selected>-- Talla --</option>
                    @foreach ($sizes as $size)
                        <option value="{{ $size->id }}"
                            {{ $shirt->shirt_size_id == $size->id ? 'selected' : '' }}>
                            {{ $size->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @include('admin.components.form_product_info')

        @component('admin.components.locale', ['tab' => 'images'])

        @foreach ($localizations as $localization)

        <div class="locale-tab-panel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="images" data-localetab="{{$localization->alias}}">

            <div class="two-columns">
                <div class="form-group">
                    <div class="form-label">
                        <label for="name" class="label-highlight">Foto destacada</label>
                    </div>
                    <div class="form-input">
                        @include('admin.components.upload_image', [
                            'entity' => 'products',
                            'type' => 'single', 
                            'content' => 'featured', 
                            'alias' => $localization->alias,
                            'files' => isset($product->image_featured_preview) ? $product->image_featured_preview : null
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label">
                        <label for="name" class="label-highlight">Fotos grid</label>
                    </div>
                    <div class="form-input">
                        @include('admin.components.upload_image', [
                            'entity' => 'products',
                            'type' => 'collection', 
                            'content' => 'grid', 
                            'alias' => $localization->alias,
                            'files' => isset($product->image_featured_preview) ? $product->image_featured_preview : null
                        ])
                    </div>
                </div>
            </div>

        </div>

        @endforeach

    @endcomponent
    </form>
</div>