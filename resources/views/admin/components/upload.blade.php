@if($type == "image" )
    <div class="upload">      
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
            @endif
        @endforeach

        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]">
    </div>

{{-- 
    <div class="drop-zone">
        <span class="drop-zone__prompt">@lang('admin/upload.image')</span>
        <input type="file" name="images[{{$content}}.{{$alias}}]" class="drop-zone__input">
    </div>  --}}

@endif


@if($type == "images" )
    <div class="upload">      
        @foreach ($files as $image)
            @if($image->language == $alias)
                <div class="upload-thumb" data-label="{{$image->filename}}" style="background-image: url({{Storage::url($image->path)}})"></div>
            @endif
        @endforeach

        <span class="upload-prompt">@lang('admin/upload.image')</span>
        <input class="upload-input" type="file" name="images[{{$content}}.{{$alias}}]" multiple >
    </div>
@endif