@php
$route = 'faqs';

$columnList = Schema::getColumnListing($faq->getTable());
$activePosition = array_search('active', $columnList, true);
$visiblePosition = array_search('visible', $columnList, true);
unset($columnList[$activePosition], $columnList[$visiblePosition]);

$filtros = ['category' => $faqs_categories, 'search' => true, 'date_start' => true, 'date_end' => true, 'order' => $columnList];

@endphp

@extends('admin.tabla_formulario')




@section('form')

    {{-- @isset($faq) --}}
    <form class="admin-formulario" id="formulario-faqs" action="{{ route('faqs_store') }}" autocomplete="off">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{isset($faq->id) ? $faq->id : ''}}">


        <div class="formulario-contenedor">

            <div class="formulario-tab">
                <div class="formulario-tab-item">
                    <div class="formulario-tab-item-panelselector active" id="tab-item-contenido" data-tab="contenido">
                        <div>
                            <p class="tab-title">Contenido</p>
                        </div>
                    </div>

                    <div class="formulario-tab-item-panelselector " id="tab-item-imagenes" data-tab="imagenes">
                        <div>
                            <p class="tab-title"> Imagenes </p>
                        </div>
                    </div>
                    <div class="formulario-tab-item-panelselector " id="tab-item-imagenes" data-tab="seo">
                        <div>
                            <p class="tab-title"> Seo </p>
                        </div>
                    </div>
                </div>

                <div class="formulario-tab-item">
                    @include('admin.components.form_actions', [
                        'route'=> $route,
                        'create' => 'create',
                        'visible' => 'visible'
                    ])
                </div>
            </div>


            <div class="formulario-contenido">

                <div class="formulario-contenido-panel active" data-tab="contenido">
                    <div class="panel-static">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-1" id="item-name">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="text" class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-name" name="name"
                                    placeholder="Inserta el nombre" value="{{ isset($faq->name) ? $faq->name : '' }}" />
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
                    @component('admin.components.form_locale')
                        @foreach ($localizations as $localization)
                        <div class="panel-locale">
                            <div class="panel-locale-item contents {{ $loop->first ? 'active' : '' }} " data-locale="{{$localization->alias}}">
                                <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-3" id="item-titulo">
                                    <div class="formulario-contenido-panel-item-campo">
                                        <input type="text"  
                                            class="formulario-contenido-panel-item-campo"
                                            name="seo[title.{{$localization->alias}}]" 
                                            placeholder="Inserta la pregunta"
                                            value="{{isset($seo["title.".$localization->alias]) ? $seo["title.".$localization->alias]: ''}}" />
                                    </div>

                                </div>

                                <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-4"
                                    id="item-descripcion">
                                    <div class="formulario-contenido-panel-item-campo" id="ckeditor">
                                        <textarea type="text" name="locale[description.{{$localization->alias}}]"
                                            class="formulario-contenido-panel-item-campo-descripcion ckeditor"
                                            
                                            placeholder="Inserta la respuesta">{{isset($locale["description.".$localization->alias]) ? $locale["description.".$localization->alias] : '' }}
                                          </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endcomponent


                </div>

                <div class="formulario-contenido-panel " data-tab="imagenes">
                    @component('admin.components.form_locale')
                        @foreach ($localizations as $localization)
                            <div class="panel-locale">
                                <div class="panel-locale-item contents {{ $loop->first ? 'active':''}}" data-locale="{{$localization->alias}}">
                                    <div class="formulario-contenido-panel-item" >
                                        @include('admin.components.upload', [
                                            'type' => 'image', 
                                            'content' => 'featured', 
                                            'alias' => $localization->alias,
                                            'files' => $faq->image_featured_preview
                                        ])
                                    </div>
                                    <div class="formulario-contenido-panel-item images-container">
                                        @include('admin.components.upload', [
                                            'type' => 'images', 
                                            'content' => 'grid', 
                                            'alias' => $localization->alias,
                                            'files' => $faq->image_grid_preview
                                        ])
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endcomponent
                </div>

                <div class="formulario-contenido-panel " data-tab="seo">
                    @component('admin.components.form_locale')
                        @foreach ($localizations as $localization)
                        <div class="panel-locale">
                            <div class="panel-locale-item contents {{ $loop->first ? 'active' : '' }} " data-locale="{{$localization->alias}}">

                                <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-3" id="item-keywords">
                                    <div class="formulario-contenido-panel-item-campo">
                                        <input type="text"  
                                            class="formulario-contenido-panel-item-campo"
                                            name="seo[keywords.{{$localization->alias}}]" 
                                            placeholder="Inserta las keywords"
                                            value="{{isset($seo["keywords.".$localization->alias]) ? $seo["keywords.".$localization->alias]: ''}}" />
                                    </div>
                                </div>

                                <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-4"
                                    id="item-descripcion">
                                    <div class="formulario-contenido-panel-item-campo" >
                                        <textarea type="text" name="seo[description.{{$localization->alias}}]"
                                            class="formulario-contenido-panel-item-campo-descripcion "
                                            placeholder="Inserta la descripcion">{{isset($seo["description.".$localization->alias])?$seo["description.".$localization->alias] : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endcomponent
                </div>
            </div>
        </div>
        <div class="formulario-contenido-panel-item" id="item-guardar">
            <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
                <input type="button" value="Guardar"> </input>
            </div>
        </div>
    </form>
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

            <div class="tabla-contenido" id="tabla-faqs-filas" data-pagination="{{ $faqs->nextPageUrl() }}"
                data-lastpage="{{ $faqs->lastPage() }}">
                @yield('tablerows')
            </div>

            @if ($agent->isDesktop())
                @include('admin.components.table_pagination', ['items' => $faqs])
            @endif
        </div>
    @endisset
@endsection

