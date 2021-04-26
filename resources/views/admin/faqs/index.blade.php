@php
$route = 'faqs';

$columnList = Schema::getColumnListing($faq->getTable());
$activePosition = array_search('active', $columnList, true);
unset($columnList[$activePosition]);

Debugbar::info($faqs_categories_in_faqs);

$filtros = ['category' => $faqs_categories_in_faqs, 'search' => true, 'date_start' => true, 'date_end' => true, 'order' => $columnList];

@endphp

@extends('admin.tabla_formulario')

{{-- @section('header')
    @include('admin.partials.header')
@endsection --}}


@section('form')

    @isset($faq)
        <form class="admin-formulario" id="formulario-faqs" action="{{ route('faqs_store') }}" autocomplete="off">

            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ isset($faq->id) ? $faq->id : '' }}">
          

            <div class="formulario-contenedor">

                    <div class="formulario-tab">

                        <div class="formulario-tab-item" id= "crear">
                            <div 
                                class="formulario-tab-item-boton" 
                                id="boton-crear"
                                data-url="{{route('faqs_create')}}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M13 11H16V13H13V16H11V13H8V11H11V8H13V11M22 5.5V16L16 22H5.5C3.6 22 2 20.4 2 18.5V5.5C2 3.6 3.6 2 5.5 2H18.5C20.4 2 22 3.6 22 5.5M20 5.8C20 4.8 19.2 4 18.2 4H5.8C4.8 4 4 4.8 4 5.8V18.3C4 19.3 4.8 20.1 5.8 20.1H15V18.6C15 16.7 16.6 15.1 18.5 15.1H20V5.8Z" />
                                </svg>
                            </div>
                        </div>

                        <div class="formulario-tab-item visible-checkbox">
                            <div class="formulario-tab-item-switch" >
                                <input 
                                type="checkbox" 
                                name="visible" 
                                value="{{ isset($faq->visible) ? $faq->visible : '1' }}" 
                                id="checkbox-visible" 
                                checked>
                                <label for="checkbox-visible" class="label-hidden"></label>
                            </div>
                        </div>
                    </div>
                <div class="formulario-contenido">

                    <div class="formulario-contenido-panel active">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-1" id="item-titulo">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="text" class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-titulos" name="titulo"
                                    placeholder="Inserta la pregunta" value="{{ isset($faq->titulo) ? $faq->titulo : '' }}" />
                            </div>

                        </div>

                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-2" id="item-descripcion">
                            <div class="formulario-contenido-panel-item-error">
                                <span id="error-descripcion"></span>
                            </div>
                            <div class="formulario-contenido-panel-item-campo">
                                <textarea type="text" name="description"
                                    class="formulario-contenido-panel-item-campo-descripcion ckeditor"
                                    placeholder="Inserta la respuesta"> {{ isset($faq->description) ? $faq->description : '' }}
                                </textarea>
                            </div>
                        </div>

                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-1" id="item-categoria">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="category_id" id="category_id">
                                    <option hidden selected>-- Categoria --</option>
                                    @foreach ($faqs_categories as $faq_category)
                                        <option value="{{ $faq_category->id }}"
                                            {{ $faq->category_id == $faq_category->id ? 'selected' : '' }}>

                                            {{ $faq_category->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="error-panel" id="item-error">

            </div>

            <div class="formulario-contenido-panel-item" id="item-guardar">
                <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
                    <input type="button" value="Guardar"> </input>
                </div>

                <div class="formulario-contenido-panel-item-boton mobile" id=boton-guardar-mobile>
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                    </svg>
                </div>
            </div>
        </form>
    @endisset
@endsection


@section('table')
@isset($faqs)
    

    <div class="tabla-contenedor" id="tabla-faqs">
        <div class="tabla-alerta " id="alerta">
            <div class="tabla-alerta-eliminar " id="alerta-eliminar">
                <div class="tabla-alerta-eliminar-mensaje"> ¿Seguro que quieres eliminar? </div>
                <div class="tabla-alerta-eliminar-opciones">
                    <div class="opcion" id="opcion-descartar">No</div>
                    <div class="opcion" id="opcion-confirmar">Si</div>
                </div>
            </div>
        </div>

        <div class="tabla-contenido" id="tabla-faqs-filas">
            @foreach ($faqs as $faq)
                <div class="tabla-contenido-fila contents swipe-element " >
                    <div class="tabla-contenido-fila-campos contents swipe-front promote-layer grid-column-1">
                        <div class="tabla-celda grid-column-1 ">{{ $faq->id }}</div>
                        <div class="tabla-celda grid-column-2 ">{{ $faq->titulo }}</div>
                        <div class="tabla-celda grid-column-3 ">{{ $faq->category->nombre }}</div>
                        <div class="tabla-celda grid-column-4 ">{{ $faq->created_at }}</div>
                    </div>

                    <div class="tabla-contenido-fila-iconos contents">
                        <div class=" tabla-celda swipe-back swipe-delete boton-eliminar grid-column-5" id="swipe-delete"
                            data-url="{{ route('faqs_destroy', ['faq' => $faq->id]) }}">

                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </div>

                        <div class=" tabla-celda swipe-back swipe-edit boton-editar grid-column-6" id="swipe-edit"
                            data-url="{{ route('faqs_show', ['faq' => $faq->id]) }}">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($agent->isDesktop())
            @include('admin.components.table_pagination', ['items' => $faqs])
        @endif
        
    </div>
    @endisset
@endsection
