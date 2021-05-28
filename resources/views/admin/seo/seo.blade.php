@php
$route = 'seo';
@endphp

@extends('admin.tabla_formulario')

@section('form')



    @include('admin.components.notifications')

    <form class="admin-formulario" id="formulario-{{ $route }}" action="{{ route('seo_store') }}"
        autocomplete="off">

        {{ csrf_field() }}



        <div class="formulario-contenedor">
            <div class="formulario-tab">
                <div class="formulario-tab-item">
                    <div class="formulario-tab-item-panelselector active" id="tab-item-contenido" data-tab="contenido">
                        <div>
                            <p class="tab-title">Contenido</p>
                        </div>
                    </div>

                    <div class="formulario-tab-item">
                        @include('admin.components.form_actions', [
                        'route' => $route,
                        ])
                    </div>
                </div>
            </div>

            <div class="formulario-contenido">
                <div class="formulario-contenido-panel active" data-tab="contenido">
                    <div class="panel-static"></div>
                    @isset($seo)
                        @component('admin.components.form_locale', ['locale' => isset($locale) ? $locale : ''])
                            @foreach ($localizations as $localization)
                                <input type="hidden" name="seo[key.{{ $localization->alias }}]"
                                    value="{{ $seo["key.$localization->alias"] }}">
                                <input type="hidden" name="seo[group.{{ $localization->alias }}]"
                                    value="{{ $seo["group.$localization->alias"] }}">
                                <input type="hidden" name="seo[old_url.{{ $localization->alias }}]"
                                    value="{{ isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : '' }}"
                                    class="input-highlight block-parameters" data-regex="/\{.*?\}/g">
                                <div class="panel-locale">
                                    <div class="panel-locale-item contents {{ $loop->first ? 'active' : '' }} "
                                        data-locale="{{ $localization->alias }}">
                                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-1" id="item-url">
                                            <div class="formulario-contenido-panel-item-campo">
                                                <input type="text" 
                                                    class="formulario-contenido-panel-item-campo block-parameters" data-regex="/\{.*?\}/g" 
                                                    placeholder="URL"
                                                    name="seo[url.{{ $localization->alias }}]"
                                                    value="{{ isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : '' }}" />
                                            </div>
                                        </div>
                                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-2" id="item-title">
                                            <div class="formulario-contenido-panel-item-campo">
                                                <input type="text" class="formulario-contenido-panel-item-campo"
                                                    placeholder="Titulo" name="seo[title.{{ $localization->alias }}]"
                                                    value="{{ isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : '' }}" />
                                            </div>
                                        </div>
                                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-3"
                                            id="item-description">
                                            <div class="formulario-contenido-panel-item-campo">
                                                <input type="text" class="formulario-contenido-panel-item-campo"
                                                    placeholder="Descripcion" name="seo[description.{{ $localization->alias }}]"
                                                    value="{{ isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : '' }}" />
                                            </div>
                                        </div>
                                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-4"
                                            id="item-keywords">
                                            <div class="formulario-contenido-panel-item-campo">
                                                <input type="text" class="formulario-contenido-panel-item-campo"
                                                    placeholder="Keywords" name="seo[keywords.{{ $localization->alias }}]"
                                                    value="{{ isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : '' }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endcomponent
                    @else
                        <div class="formulario-contenido-panel-item">
                            <div id="import-seo" data-url="{{ route('seo_import') }}"
                                class="formulario-contenido-panel-item-boton desktop">
                                Importar todos los enlaces.
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item">
                            <div id="ping-google" data-url="{{ route('ping_google') }}"
                                class="formulario-contenido-panel-item-boton desktop">
                                Llamar al robot de Google
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item">
                            <div id="create-sitemap" data-url="{{ route('create_sitemap') }}"
                                class="formulario-contenido-panel-item-boton desktop">
                                Generar el sitemap
                            </div>
                            
                        </div>
                        <div class="formulario-contenido-panel-item">
                           <textarea id="sitemap" class="simple"></textarea>
                        </div>
                        
                    @endisset
                </div>
            </div>
        </div>
        @isset($seo)
            <div class="formulario-contenido-panel-item" id="item-guardar">
                <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
                    <input type="button" value="Guardar"> </input>
                </div>
            </div>
        @endisset
    </form>

    {{-- <input type="hidden" name="seo[key.{{$localization->alias}}]" value="{{$seo["key.$localization->alias"]}}">
                            <input type="hidden" name="seo[group.{{$localization->alias}}]" value="{{$seo["group.$localization->alias"]}}">
                            <input type="hidden" name="seo[old_url.{{$localization->alias}}]" value="{{isset($seo["url.$localization->alias"]) ? $seo["url.$localization->alias"] : ''}}" class="input-highlight block-parameters"  data-regex="/\{.*?\}/g" > --}}
    {{-- @else

                <div class="form-container">
                    <div class="tabs-container">
                        <div class="tabs-container-menu">
                            <ul>
                                <li class="tab-item tab-active" data-tab="content">
                                    Contenido
                                </li>
                            </ul>
                        </div>
                    </div>

                </div> --}}

@endsection

@section('table')

    <div class="tabla-contenedor" id="tabla-seos">
        <div class="tabla-alerta " id="alerta">
            <div class="tabla-alerta-eliminar " id="alerta-eliminar">
                <div class="tabla-alerta-eliminar-mensaje"> ¿Seguro que quieres eliminar? </div>
                <div class="tabla-alerta-eliminar-opciones">
                    <div class="opcion" id="opcion-descartar">No</div>
                    <div class="opcion" id="opcion-confirmar">Si</div>
                </div>
            </div>
        </div>

        <div class="tabla-contenido" id="tabla-seos-filas" data-pagination="{{ $seos->nextPageUrl() }}"
            data-lastpage="{{ $seos->lastPage() }}">
            @yield('tablerows')
        </div>

        @if ($agent->isDesktop())
            @include('admin.components.table_pagination', ['items' => $seos])
        @endif
    </div>

@endsection
