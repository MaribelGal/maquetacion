@extends('admin.master')

@section('content')

<div class="main">
    
    <div class='formulario disable' id="formulario">
        @yield('form') 
    </div>

   <div class='tabla ' id="tabla">
        @yield('table') 
    </div>

    @if ($agent->isMobile())
        @include('admin.components.formTable_footer_mobile')
    @endif
</div>

@endsection 