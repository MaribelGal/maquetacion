@extends('admin.master')

@section('content')

<div class="main">
    
    <div class='formulario disable' id="formulario">
        @yield('form') 
    </div>

   <div class='tabla ' id="tabla">
        @yield('table') 
    </div>
</div>

@endsection 