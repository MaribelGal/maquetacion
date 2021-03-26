@extends('admin.tabla_formulario')

@section('header')
<header>
    <p>Encabezado</p>
</header>
@endsection

@section('form')
{{-- <section class="formulario"> --}}
    <div class="formulario-titulo">
        <h1>Añadir FAQs</h1>
    </div>


    <div class="formulario-contenido">
        <form class="admin-formulario" id="formulario-faqs" action="{{route("faqs_store")}}" autocomplete="off">

            {{ csrf_field() }}

            <div class="formulario-contenido-item">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}"> 
                <div class="formulario-contenido-item-titulo">

                    <div class="formulario-contenido-item-titulo-etiqueta">
                        <label for="formulario-contenido-item-titulo-campo">Título</label>
                    </div>

                    <div class="formulario-contenido-item-titulo-campo">
                        <input 
                        type="text" 
                        id="formulario-contenido-item-titulo-campo" 
                        name="titulo"
                        placeholder="Inserta la pregunta"
                        value="{{isset($faq->titulo) ? $faq->titulo : ''}}"
                        />
                         
                    </div>

                </div>
            </div>

            <div class="formulario-contenido-item">
                <div class="formulario-contenido-item-descripcion">
                    <div class="formulario-contenido-item-descripcion-etiqueta">
                        <label for="formulario-contenido-item-descripcion-campo">Descripción</label>
                    </div>

                    <div class="formulario-contenido-item-descripcion-campo">
                        <input type="text" id="formulario-contenido-item-descripcion-campo" 
                        name="description"
                        placeholder="Inserta la respuesta"
                        value="{{isset($faq->description) ? $faq->description : ''}}"/>
                        
                    </div>
                </div>
            </div>

            <div class="formulario-contenido-item">
                <div class="formulario-contenido-item-separador">
                    <div class="formulario-contenido-item-separador">
                        <hr class="formulario-contenido-item-separador-linea">
                        </hr>
                    </div>
                </div>
            </div>

            <div class="formulario-contenido-item">
                <div class="formulario-contenido-item-guardar">
                    <input type="submit" value="Guardar" id="boton-guardar"> </input>
                </div>
            </div>
        </form>

    </div>
    {{--
</section> --}}
@endsection 

@section('table')
{{-- <section class="tabla"> --}}
        <div class="tabla-titulo">
            <h1>FAQs guardados</h1>
        </div>
        <table class="admin-tabla" id="tabla-faqs">
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>

            @foreach($faqs as $faq)
            <tr>
                <td>{{$faq->id}}</td>
                <td>{{$faq->titulo}}</td>
                <td>{{$faq->description}}</td>
                <td>
                    <div class="admin-tabla-acciones">
                        <button type="button" class="boton-eliminar">
                            <svg href="" style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </button>

                        <button type="button" class="boton-editar">
                            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </button>

                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    {{--
</section> --}}
@endsection