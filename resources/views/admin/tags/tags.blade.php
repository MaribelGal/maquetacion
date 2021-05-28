@php
$route = 'tags';
$columnList = ['grupo' => 'group', 'clave' => 'key'];
$filtros = ['parent' => $groups, 'order' => $columnList];
@endphp

@extends('admin.tabla_formulario')


@section('form')

    @isset($tags)
        @include('admin.components.notifications')
        <form class="admin-formulario" id="formulario-{{ $route }}" action="{{ route($route . '_store') }}"
            autocomplete="off">

            {{ csrf_field() }}

            @isset($locale['group'])
                <input type="hidden" name="group" value="{{ $locale['group'] }}">
            @endisset


            <div class="formulario-contenedor">
                <div class="formulario-tab">
                    <div class="formulario-tab-item">
                        <div class="formulario-tab-item-panelselector active" id="tab-item-contenido" data-tab="contenido">
                            <div>
                                <p class="tab-title">Contenido</p>
                            </div>
                        </div>
                        <div class="formulario-tab-item-panelselector " id="tab-item-contenido" data-tab="importar">
                            <div>
                                <p class="tab-title">Importar</p>
                            </div>
                        </div>

                        <div class="formulario-tab-item">
                            @include('admin.components.form_actions', [
                            'route' => $route,
                            'visible' => 'visible',
                            ])
                        </div>
                    </div>
                </div>

                <div class="formulario-contenido">
                    <div class="formulario-contenido-panel active" data-tab="contenido">
                        <div class="panel-static"></div>
                        @component('admin.components.form_locale', ['locale' => isset($locale) ? $locale : ''])
                            @foreach ($localizations as $localization)
                                @isset($locale['id.' . $localization->alias])
                                    <div class="panel-locale">
                                        <div class="panel-locale-item contents {{ $loop->first ? 'active' : '' }} "
                                            data-locale="{{ $localization->alias }}">
                                            <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-3" id="item-titulo">
                                                <div class="formulario-contenido-panel-item-campo">
                                                    <input type="text" class="formulario-contenido-panel-item-campo"
                                                        name="tag[{{ $localization->alias }}][value]" placeholder="Valor"
                                                        value="{{ isset($locale['value.' . $localization->alias]) ? $locale['value.' . $localization->alias] : '' }}" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <input class="input-id" type="hidden" name="tag[{{ $localization->alias }}][id]"
                                        value="{{ $locale['id.' . $localization->alias] }}">
                                @endisset
                            @endforeach
                        @endcomponent
                    </div>
                    <div class="formulario-contenido-panel " data-tab="importar">
                        <div class="panel-static">
                            <div class="formulario-contenido-panel-item">
                                <div id="import-tags" data-url="{{ route('tags_import') }}"
                                    class="formulario-contenido-panel-item-boton desktop">
                                    Importar traducciones.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @isset($locale['group'])
            <div class="formulario-contenido-panel-item" id="item-guardar">
                <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
                    <input type="button" value="Guardar"> </input>
                </div>
            </div>
            @endisset
        </form>
    @endisset
@endsection


@section('table')
    @isset($tags)
        <div class="tabla-contenedor" id="tabla-tags">
            <div class="tabla-alerta " id="alerta">
                <div class="tabla-alerta-eliminar " id="alerta-eliminar">
                    <div class="tabla-alerta-eliminar-mensaje"> ¿Seguro que quieres eliminar? </div>
                    <div class="tabla-alerta-eliminar-opciones">
                        <div class="opcion" id="opcion-descartar">No</div>
                        <div class="opcion" id="opcion-confirmar">Si</div>
                    </div>
                </div>
            </div>

            <div class="tabla-contenido" id="tabla-tags-filas" data-pagination="{{ $tags->nextPageUrl() }}"
                data-lastpage="{{ $tags->lastPage() }}">
                @yield('tablerows')
            </div>

            @if ($agent->isDesktop())
                @include('admin.components.table_pagination', ['items' => $tags])
            @endif
        </div>
    @endisset
@endsection
