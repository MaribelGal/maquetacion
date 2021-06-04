@php
    $route = 'menus';
@endphp

{{-- @extends('admin.layout.table_form') --}}

@extends('admin.tabla_formulario')

@section('table')

    @isset($menus)

        <div class="tabla-contenedor" id="tabla-menu">
            <div class="tabla-alerta " id="alerta">
                <div class="tabla-alerta-eliminar " id="alerta-eliminar">
                    <div class="tabla-alerta-eliminar-mensaje"> ¿Seguro que quieres eliminar? </div>
                    <div class="tabla-alerta-eliminar-opciones">
                        <div class="opcion" id="opcion-descartar">No</div>
                        <div class="opcion" id="opcion-confirmar">Si</div>
                    </div>
                </div>
            </div>

            <div class="tabla-contenido" id="tabla-menus-filas" data-pagination="{{ $menus->nextPageUrl() }}"
                data-lastpage="{{ $menus->lastPage() }}">
                @yield('tablerows')
            </div>

            @if ($agent->isDesktop())
                @include('admin.components.table_pagination', ['items' => $menus])
            @endif

    @endisset

@endsection

@section('form')

    @isset($menu)

        <div class="form-container">
            <form class="admin-formulario" id="formulario-menus" action="{{route("menus_store")}}" autocomplete="off">
                
                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">
                <input type="hidden" name="id" value="{{isset($menu->id) ? $menu->id : ''}}">


                <div class="formulario-contenedor">

                    <div class="formulario-tab">
                        <div class="formulario-tab-item">
                            <div class="formulario-tab-item-panelselector active" id="tab-item-contenido" data-tab="contenido">
                                <div>
                                    <p class="tab-title">Contenido</p>
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
                                        <input 
                                            type="text"          
                                            class="formulario-contenido-panel-item-campo"
                                            id="formulario-contenido-panel-item-campo-name" name="name"
                                            placeholder="Inserta el nombre" 
                                            value="{{isset($menu->name) ? $menu->name : ''}}"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formulario-contenido-panel-item" id="item-guardar">
                    <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
                        <input type="button" value="Guardar"> </input>
                    </div>
                </div>
            </form>

            @isset($menu->name)
                <div id="menu-item-form-container">
                    @include('admin.menu_items.index', ['menu' => $menu])
                </div>
            @endisset

        </div>

    @endisset

@endsection