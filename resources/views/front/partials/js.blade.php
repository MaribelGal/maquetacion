@if ($agent->isMobile())
    <script src="/front/mobile/js/app.js"></script>
@else
    <script src="/front/desktop/js/app.js"></script>
@endif