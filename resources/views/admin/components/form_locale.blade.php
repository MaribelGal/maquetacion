<div class="panel-tab-locale">
    <div class="tab-locale">
        @foreach ($localizations as $localization)
            <div class="tab-locale-item {{ $loop->first ? 'active': ''}}" data-locale="{{$localization->alias}}">
                    <p>{{$localization->name}}</p>
            </div>
        @endforeach

    </div>
</div>

{{$slot}}