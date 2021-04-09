@extends('front.master')

@section('header')

<header>
    <div class="header-logo">
        <div class="header-logo-icono">
            <svg style="width:42px;height:42px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M22 13C22 14.11 21.11 15 20 15H4C2.9 15 2 14.11 2 13S2.9 11 4 11H13L15.5 13L18 11H20C21.11 11 22 11.9 22 13M12 3C3 3 3 9 3 9H21C21 9 21 3 12 3M3 18C3 19.66 4.34 21 6 21H18C19.66 21 21 19.66 21 18V17H3V18Z" />
            </svg>
        </div>
        <div class="header-logo-titulo">
            <h1>Título</h1>
        </div>
    </div>

    <div class="header-menu">
        <div class="header-menu-item">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
            </svg>
        </div>

    </div>
</header>

@endsection

@section('content')
<div class="panel-contenedor">
    <div class="panel-titulo">
        <h1>Preguntas frequentes</h1>
    </div>
    
    <div class="desplegable">

        @foreach($faqs as $faq)
        <div class="desplegable-item">

            <button class="desplegable-boton" value="{{$faq->id}}">
                <div class="desplegable-titulo">
                    <p class="titulo">¿{{$faq->titulo}}?</p>
                </div>
                
                <div class="desplegable-icono" >
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M7,10L12,15L17,10H7Z" />
                    </svg>
                </div>
            </button>

            <div class="desplegable-descripcion" id="{{$faq->id}}">
                <p>{{$faq->description}}</p>
            </div>

        </div>
        @endforeach

    </div>

</div>
@endsection