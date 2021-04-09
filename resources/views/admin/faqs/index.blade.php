@extends('admin.tabla_formulario')

@section('header')

    <div class="header-logo"> 
        <svg class="icono" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12,8L10.67,8.09C9.81,7.07 7.4,4.5 5,4.5C5,4.5 3.03,7.46 4.96,11.41C4.41,12.24 4.07,12.67 4,13.66L2.07,13.95L2.28,14.93L4.04,14.67L4.18,15.38L2.61,16.32L3.08,17.21L4.53,16.32C5.68,18.76 8.59,20 12,20C15.41,20 18.32,18.76 19.47,16.32L20.92,17.21L21.39,16.32L19.82,15.38L19.96,14.67L21.72,14.93L21.93,13.95L20,13.66C19.93,12.67 19.59,12.24 19.04,11.41C20.97,7.46 19,4.5 19,4.5C16.6,4.5 14.19,7.07 13.33,8.09L12,8M9,11A1,1 0 0,1 10,12A1,1 0 0,1 9,13A1,1 0 0,1 8,12A1,1 0 0,1 9,11M15,11A1,1 0 0,1 16,12A1,1 0 0,1 15,13A1,1 0 0,1 14,12A1,1 0 0,1 15,11M11,14H13L12.3,15.39C12.5,16.03 13.06,16.5 13.75,16.5A1.5,1.5 0 0,0 15.25,15H15.75A2,2 0 0,1 13.75,17C13,17 12.35,16.59 12,16V16H12C11.65,16.59 11,17 10.25,17A2,2 0 0,1 8.25,15H8.75A1.5,1.5 0 0,0 10.25,16.5C10.94,16.5 11.5,16.03 11.7,15.39L11,14Z" />
        </svg>
    </div>

    <div class=header-titulo> 
        <div>Administración FAQ's</div>
    </div>

    <div class="header-menu" id="boton-menu">
        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
            <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" />
        </svg>
    </div>

    <div class="header-boton-selectorpanel mobile" id="boton-selectorpanel">
        <div class="boton-selectorpanel-formulario disable"  id="boton-selectorpanel-formulario">
            <svg class="icono"  viewBox="0 0 24 24">
                <path fill="currentColor" d="M21.04 12.13C21.18 12.13 21.31 12.19 21.42 12.3L22.7 13.58C22.92 13.79 22.92 14.14 22.7 14.35L21.7 15.35L19.65 13.3L20.65 12.3C20.76 12.19 20.9 12.13 21.04 12.13M19.07 13.88L21.12 15.93L15.06 22H13V19.94L19.07 13.88M11 19L9 21H5C3.9 21 3 20.1 3 19V5C3 3.9 3.9 3 5 3H9.18C9.6 1.84 10.7 1 12 1C13.3 1 14.4 1.84 14.82 3H19C20.1 3 21 3.9 21 5V9L19 11V5H17V7H7V5H5V19H11M12 3C11.45 3 11 3.45 11 4C11 4.55 11.45 5 12 5C12.55 5 13 4.55 13 4C13 3.45 12.55 3 12 3Z" />
            </svg>
        </div>
        <div class="header-boton-selectorpanel-tabla" id="boton-selectorpanel-tabla">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="currentColor" d="M3 3H17C18.11 3 19 3.9 19 5V12.08C17.45 11.82 15.92 12.18 14.68 13H11V17H12.08C11.97 17.68 11.97 18.35 12.08 19H3C1.9 19 1 18.11 1 17V5C1 3.9 1.9 3 3 3M3 7V11H9V7H3M11 7V11H17V7H11M3 13V17H9V13H3M22.78 19.32L21.71 18.5C21.73 18.33 21.75 18.17 21.75 18S21.74 17.67 21.71 17.5L22.77 16.68C22.86 16.6 22.89 16.47 22.83 16.36L21.83 14.63C21.77 14.5 21.64 14.5 21.5 14.5L20.28 15C20 14.82 19.74 14.65 19.43 14.53L19.24 13.21C19.23 13.09 19.12 13 19 13H17C16.88 13 16.77 13.09 16.75 13.21L16.56 14.53C16.26 14.66 15.97 14.82 15.71 15L14.47 14.5C14.36 14.5 14.23 14.5 14.16 14.63L13.16 16.36C13.1 16.47 13.12 16.6 13.22 16.68L14.28 17.5C14.26 17.67 14.25 17.83 14.25 18S14.26 18.33 14.28 18.5L13.22 19.32C13.13 19.4 13.1 19.53 13.16 19.64L14.16 21.37C14.22 21.5 14.35 21.5 14.47 21.5L15.71 21C15.97 21.18 16.25 21.35 16.56 21.47L16.75 22.79C16.77 22.91 16.87 23 17 23H19C19.12 23 19.23 22.91 19.25 22.79L19.44 21.47C19.74 21.34 20 21.18 20.28 21L21.5 21.5C21.64 21.5 21.77 21.5 21.84 21.37L22.84 19.64C22.9 19.53 22.87 19.4 22.78 19.32M18 19.5C17.17 19.5 16.5 18.83 16.5 18S17.18 16.5 18 16.5 19.5 17.17 19.5 18 18.84 19.5 18 19.5Z" />
            </svg>
        </div>
    </div>

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
                <div class="formulario-contenido-item-guardar desktop"  >
                    <input type="button" value="Guardar" id="boton-guardar-desktop"> </input>  
                </div>
                
                <div class="formulario-contenido-item-guardar mobile">
                    <svg viewBox="0 0 24 24" id=boton-guardar-mobile>
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