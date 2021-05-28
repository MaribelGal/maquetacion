@if ($type == 'image')
    <div class="image-single">
        <div class="upload-single grid">
            @foreach ($files as $image)
                @if ($image->language == $alias)
                    <div class="upload-thumb-single grid-row-1 grid-column-1" data-label="{{ $image->filename }}"
                        data-alias="{{ $image->language }}"
                        style="background-image: url({{ Storage::url($image->path) }})">
                    </div>
                    <div class="upload-thumb-image-single grid-row-1 grid-column-1">
                        <img class="upload-thumb-image-item" src="{{ isset($image->path)? Storage::url($image->path):'' }}" alt="">
                    </div>
                @endif
            @endforeach

            <span class="upload-prompt-single grid-row-1 grid-column-1">@lang('admin/upload.image')</span>
            <input class="upload-input-single grid-row-1 grid-column-1" type="file" data-content="{{ $content }}"
                data-alias="{{ $alias }}">

            <div class="upload-thumb-image-single grid-row-1 grid-column-1">
                <img class="upload-thumb-image-item" >
            </div>
        </div>

        <div class="upload-actions-single grid-row-2 grid-column-1">
            <div class="upload-thumb-delete-single">
                <svg viewBox="0 0 24 24" class="upload-thumb-delete-button">
                    <path fill="currentColor"
                        d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z">
                    </path>
                </svg>
            </div>
            <div class="upload-thumb-edit-single">
                <svg viewBox="0 0 24 24" class="upload-thumb-edit-button">
                    <path fill="currentColor"
                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z">
                    </path>
                </svg>

                @include('admin.components.editSeoImage', [
                'state' => 'upload',
                'content' => $content,
                'alias' => $alias
                ])
            </div>
        </div>

        {{-- <div class="drop-zone">
        <span class="drop-zone__prompt">@lang('admin/upload.image')</span>
        <input type="file" name="images[{{$content}}.{{$alias}}]" class="drop-zone__input">
    </div> --}}

    </div>
@endif


@if ($type == 'images')
    <div class="upload">
        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" data-content="{{ $content }}" data-alias="{{ $alias }}"
            multiple>
    </div>


    <div class="preview" id="preview_images">
        <div class="upload-thumb-prototype" data-content="{{ $content }}" data-alias="{{ $alias }}">
            <div class="upload-thumb-image">
                <img class="upload-thumb-image-item" src="" alt="">
            </div>
            <div class="upload-thumb-actions">
                <div class="upload-thumb-delete">
                    <svg viewBox="0 0 24 24" class="upload-thumb-delete-button">
                        <path fill="currentColor"
                            d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z">
                        </path>
                    </svg>
                </div>
                <div class="upload-thumb-edit">
                    <svg viewBox="0 0 24 24" class="upload-thumb-edit-button">
                        <path fill="currentColor"
                            d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z">
                        </path>
                    </svg>

                    @include('admin.components.editSeoImage', [
                    'state' => 'upload',
                    'content' => 'grid',
                    'alias' => $localization->alias
                    ])
                </div>
            </div>
        </div>

        @if ($files->count() != 0)

            @foreach ($files as $image)
                @if ($image->language == $alias)
                    <div class="uploaded-thumb" data-imageid="{{ $image->id }}">
                        <div class="uploaded-thumb-image">
                            <img src="{{ Storage::url($image->path) }}" class="uploaded-thumb-image-item">
                        </div>

                        <div class="uploaded-thumb-actions">
                            <div class="uploaded-thumb-delete">
                                <svg viewBox="0 0 24 24" class="uploaded-thumb-delete-button"
                                    data-route="{{ route('delete_image') }}">

                                    <path fill="currentColor"
                                        d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="uploaded-thumb-edit">
                                <svg viewBox="0 0 24 24" class="uploaded-thumb-edit-button">
                                    <path fill="currentColor"
                                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z">
                                    </path>
                                </svg>


                                @include('admin.components.editSeoImage', [
                                'state' => 'uploaded',
                                'content' => 'grid',
                                'alias' => $localization->alias,
                                'image' => $image
                                ])
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif


    </div>

@endif
