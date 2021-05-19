@if ($type == 'image')
    <div class="upload">
        @foreach ($files as $image)
            @if ($image->language == $alias)
                <div class="upload-thumb" data-label="{{ $image->filename }}"
                    style="background-image: url({{ Storage::url($image->path) }})"></div>
            @endif
        @endforeach

        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" name="images[{{ $content }}.{{ $alias }}]">
    </div>

    {{-- <div class="drop-zone">
        <span class="drop-zone__prompt">@lang('admin/upload.image')</span>
        <input type="file" name="images[{{$content}}.{{$alias}}]" class="drop-zone__input">
    </div> --}}

@endif


@if ($type == 'images')
    <div class="upload">
        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" data-content="{{ $content }}" data-alias="{{ $alias }}"
            multiple>
    </div>


    <div class="preview" id="preview_images">
        {{-- <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]" multiple > --}}
        
        <div class="upload-thumb-prototype" data-content="{{ $content }}" data-alias="{{ $alias }}">
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

        @if ($files->count() == 0)
            <div>No hay imagenes cargadas</div>
        @else
            @foreach ($files as $image)
                @if ($image->language == $alias)
                    <div class="uploaded-thumb" data-imageid="{{$image->id}}"
                        style="background-image:url({{Storage::url($image->path)}})"
                        >
                        {{-- <img 
                            class="uploaded-thumb-img" 
                            data-label="{{ $image->filename }}"
                            src="{{ Storage::url($image->path) }}"/>

                            {{isset($image) ? 'style=background-image: url('Storage::url($image->path)")" : ''}} --}}


                        <div class="uploaded-thumb-actions">
                            <div class="uploaded-thumb-delete">
                                <svg viewBox="0 0 24 24" 
                                class="uploaded-thumb-delete-button" 
                                data-route="{{route('delete_image')}}">

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
