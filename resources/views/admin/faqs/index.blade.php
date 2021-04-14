@php
     $route = 'faqs';
@endphp

@extends('admin.tabla_formulario')

@section('header')
    @include('admin.partials.header')
@endsection


@section('form')

{{-- <section class="formulario"> --}}
    {{-- <div class="formulario-contenido"> --}}
        <form class="admin-formulario" id="formulario-faqs" action="{{route("faqs_store")}}" autocomplete="off">

            {{ csrf_field() }}

            {{-- <div class="formulario-contenido-titulo" id="contenido-titulo">
                <h1>Añadir FAQs</h1>
            </div> --}}

            <div class="formulario-contenido-item" id="item-titulo">
                <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}"> 

                {{-- <div class="formulario-contenido-item-etiqueta">
                    <label for="formulario-contenido-item-campo">Título</label>
                </div> --}}
                
                <div class="formulario-contenido-item-error">
                    <span id="error-titulo"></span>
                </div>

                <div class="formulario-contenido-item-campo">
                
                        <input 
                        type="text"
                        class="formulario-contenido-item-campo-titulo"
                        id="formulario-contenido-item-campo" 
                        name="titulo"
                        placeholder="Inserta la pregunta"
                        value="{{isset($faq->titulo) ? $faq->titulo : ''}}"/>
                </div>

            </div>

            <div class="formulario-contenido-item" id="item-descripcion">

                {{-- <div class="formulario-contenido-item-etiqueta">
                    <label for="formulario-contenido-item-descripcion-campo">Descripción</label>
                </div> --}}

                <div class="formulario-contenido-item-error">
                    <span id="error-descripcion"></span>
                </div>

                <div class="formulario-contenido-item-campo">
                    <textarea 
                    type="text" 
                    name="description"
                    class="formulario-contenido-item-campo-descripcion ckeditor"
                    placeholder="Inserta la respuesta"
                    >{{isset($faq->description) ? $faq->description : ''}}
                
                    </textarea>
                    
                </div>
                
            </div>
{{--  --}}
           

            <div class="formulario-contenido-item" id="item-categoria">

                {{-- <div class="formulario-contenido-item-etiqueta">
                    <label for="category_id">Elige la categoria:</label>
                </div> --}}
                
                <div class="formulario-contenido-item-campo">
                    <select name="category_id" id="category_id" class="formulario-contenido-item-campo-categoria">
                        <option hidden selected>-- Categoria --</option>

                        @foreach ($faqs_categories as $faq_category)
                            <option 
                            value="{{$faq_category->id}}"
                            {{$faq->category_id == $faq_category->id ? 'selected':''}}>
                                
                                {{$faq_category->nombre}}
                            
                            </option>
                        @endforeach
                        
                    </select>
                </div>
            </div>


            <div class="formulario-contenido-item" id="item-guardar">
                <div class="formulario-contenido-item-boton desktop"  id="boton-guardar-desktop">
                    <input type="button" value="Guardar" > </input>  
                </div>
                
                <div class="formulario-contenido-item-boton mobile" id=boton-guardar-mobile>
                    <svg viewBox="0 0 24 24" >
                        <path fill="currentColor" d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z" />
                    </svg>
                </div>
                
            </div>

            
        </form>

    {{-- </div> --}}
    {{--
</section> --}}

@endsection 

@section('table')

{{-- <section class="tabla"> --}}
        {{-- <div class="tabla-titulo">
            <h1>FAQs guardados</h1>
        </div> --}}
        {{-- <p>{{
            $faq->table('t_faqs')->join('t_faq_categories', 't_faqs.category_id', '=', 't_faq_categories.id')
            // $faq->join('contacts', 'users.id', '=', 'contacts.user_id')
            }}
        </p> --}}
        <div class="tabla-contenedor">
        <table class="admin-tabla" id="tabla-faqs">
            <tr>
                <th class="admin-tabla-idcolumna">Id</th>
                <th class="admin-tabla-titulocolumna">Título</th>
                {{-- <th class="admin-tabla-descripcioncolumna">Descripción</th> --}}
                <th class="admin-tabla-categoriacolumna">Categoria</th>
                <th class="admin-tabla-accionescolumna"></th>
            </tr>



            @foreach($faqs as $faq)
            <tr>
                <td class="admin-tabla-idcolumna">{{$faq->id}}</td>
                <td class="admin-tabla-titulocolumna">{{$faq->titulo}}</td>
                {{-- <td class="admin-tabla-descripcioncolumna">{{$faq->description}}</td> --}}
                <td class="admin-tabla-categoriacolumna">
                    
                    {{$faq->category->nombre}}
                    {{-- @foreach ($faqs_categories as $faq_category)
                            {{($faq->category_id == $faq_category->id) ?  $faq_category->nombre : ''}}
                                      
                    @endforeach --}}
                
                </td>


                <td class="admin-tabla-accionescolumna">
                    <div class="admin-tabla-acciones">
                        <button type="button" class="boton-eliminar" data-url="{{route('faqs_destroy', ['faq' => $faq->id])}}">
                            <svg href="" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </button>

                        <button type="button" class="boton boton-editar"  data-url="{{route('faqs_show', ['faq' => $faq->id])}}">
                            <svg  viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        <div>
    {{-- </section> --}}
@endsection