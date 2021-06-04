@extends('admin.layout.master')

@section('content')

    <div class="tabla active" id="tabla">
        @yield('table')
    </div>

    <div class="formulario" id="formulario">
        @yield('form')
    </div>

@endsection