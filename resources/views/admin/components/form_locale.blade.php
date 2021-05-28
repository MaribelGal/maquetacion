<div class="panel-tab-locale">
    <div class="tab-locale">
        
        @foreach ($localizations as $localization)

            @isset ($locale)
                @isset($locale['id.' . $localization->alias])
                    <div class="tab-locale-item {{ $loop->first ? 'active' : '' }}"
                        data-locale="{{ $localization->alias }}">
                        {{ $localization->name }}
                    </div>
                @endisset
            @else
                <div class="tab-locale-item {{ $loop->first ? 'active' : '' }}"
                    data-locale="{{ $localization->alias }}">
                    {{ $localization->name }}
                </div>
            @endif

        @endforeach

    </div>
</div>

{{ $slot }}
