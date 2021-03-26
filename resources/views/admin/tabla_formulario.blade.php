@extends('admin.master')

@section('content')

<div class="header">
    @yield('header') 

<div class="main">
    <div class='formulario'>
        @yield('form') 
    </div>

    <div class='tabla' id="tabla">
        @yield('table') 
    </div>
</div>

@endsection 