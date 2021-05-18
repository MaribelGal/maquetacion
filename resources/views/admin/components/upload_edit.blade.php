<div class="upload-edit-panel">
    <div class="upload-edit-panel-image"></div>

    <div class="upload-edit-panel-fields">
        <div class="upload-edit-panel-alt">
            <input type="text" {{-- name="imagesInfo-alt" --}} class="upload-edit-panel-alt-input" placeholder="Inserta el alt"
            value="{{isset($alt)? $alt : ""}}" />
        </div>
        <div class="upload-edit-panel-title">
            <input type="text" {{-- name="imagesInfo-title" --}} class="upload-edit-panel-title-input"
                placeholder="Inserta el titulo" value="{{isset($title)? $title : ""}}" />
        </div>
    </div>
    <div class="upload-edit-panel-save">
        <svg viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z">
            </path>
        </svg>
    </div>
    <div class="upload-edit-panel-close">
        <svg viewBox="0 0 24 24">
            <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
        </svg>
    </div>
</div>
