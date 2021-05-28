@php
$route = 'faqs';
@endphp

@extends('front.master')

@include('front.partials.header')

@section('content')
    <div class="panel-contenedor">
        <div class="panel-titulo">
            <h1>Preguntas frequentes</h1>
        </div>

        <div class="desplegable">

            @foreach ($faqs as $faq)
                <div class="desplegable-item">
                    <div class="desplegable-boton" data-faq_id="{{ $faq->id }}">
                        <div class="desplegable-titulo">
                            <p class="titulo">
                                {{ isset($faq->locale['titulo']) ? $faq->locale['titulo'] : '' }}
                            </p>
                        </div>

                        <div class="desplegable-icono">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M7,10L12,15L17,10H7Z" />
                            </svg>
                        </div>
                    </div>

                    <div class="desplegable-descripcion grid" data-faq_id="{{ $faq->id }}">
                        <div class="desplegable-descripcion-texto grid-column-1">{!! isset($faq->locale['description']) ? $faq->locale['description'] : '' !!}</div>

                        <div class="desplegable-descripcion-imagen  grid-column-2">
                            <div class="imagen-featured ">
                                {{-- <img
                                    src="{{ isset($faq->images['featured']['other'][0]) ? Storage::url($faq->images['featured']['other'][0]) : '' }}" /> --}}

                                @isset($faq->image_featured_desktop->path)
                                    <div class="faq-description-image">
                                        <img src="{{ Storage::url($faq->image_featured_desktop->path) }}"
                                            alt="{{ $faq->image_featured_desktop->alt }}"
                                            title="{{ $faq->image_featured_desktop->title }}" />
                                    </div>
                                @endisset
                            </div>

                            <div class="imagen-preview grid">
                                {{-- @foreach ($faq->images['grid']['preview'] as $images)
                                    <img src="{{ Storage::url($images) }}" />
                                @endforeach --}}

                                @foreach ($faq->image_grid_preview as $image)
                                    <img src="{{ Storage::url($image->path) }}" 
                                    alt="{{ $image->alt }}"
                                    title="{{ $image->title }}" />

                                @endforeach


                            </div>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>
@endsection
