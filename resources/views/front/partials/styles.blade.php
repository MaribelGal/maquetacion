@if ($agent->isMobile())
    <link href="{{ mix('/front/mobile/css/app.css') }}" rel="stylesheet">
@else
    <link href="{{ mix('/front/desktop/css/app.css') }}" rel="stylesheet">  
@endif