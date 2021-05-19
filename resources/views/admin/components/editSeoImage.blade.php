<div class="{{ $state }}-edit-panel">
    <div class="{{ $state }}-edit-panel-image">
        @isset($image)
            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->alt }}">
        @endisset
    </div>

    
    <div class="{{ $state }}-edit-panel-fields">
        <div class="{{ $state }}-edit-panel-alt">
            <input type="text" {{-- name="imagesInfo-alt" --}} class="{{ $state }}-edit-panel-alt-input"
                placeholder="Inserta el alt" value="{{ isset($image->alt) ? $image->alt : '' }}" />
        </div>
        <div class="{{ $state }}-edit-panel-title">
            <input type="text" {{-- name="imagesInfo-title" --}} class="{{ $state }}-edit-panel-title-input"
                placeholder="Inserta el titulo" value="{{ isset($image->title) ? $image->title : '' }}" />
        </div>
    </div>
    <div class="{{ $state }}-edit-panel-save" data-route={{ route('store_image_seo') }}>
        <svg viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z">
            </path>
        </svg>
    </div>
    <div class="{{ $state }}-edit-panel-close">
        <svg viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
        </svg>
    </div>
</div>
