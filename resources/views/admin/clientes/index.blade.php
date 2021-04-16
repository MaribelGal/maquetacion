@php
$route = 'clientes';
@endphp

@extends('admin.tabla_formulario')

@section('form')
    <form class="admin-formulario" id="formulario-clientes" action="{{ route('clientes_store') }}" autocomplete="off">



        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ isset($cliente->id) ? $cliente->id : '' }}" />

        <div class="formulario-contenedor">
            <div class="formulario-tab">
                <div class="formulario-tab-item active" id="tab-item-contacto" data-tab="contacto">
                    <div>
                        Contacto
                    </div>
                </div>

                <div class="formulario-tab-item " id="tab-item-direccion" data-tab="direccion">
                    <div>
                        Direccion
                    </div>
                </div>
            </div>

            <div class="formulario-contenido">
                <div class="formulario-contenido-panel active" data-tab="contacto">
                    <div class="formulario-contenido-panel-item" id="item-nif">

                        <div class="formulario-contenido-panel-item-campo">

                            <input type="text" name="nif" id="formulario-contenido-panel-item-campo-nif" placeholder="Nif"
                                value="{{ isset($cliente->id) ? $cliente->nif : '' }}" />

                        </div>

                    </div>

                    <div class="formulario-contenido-panel-item" id="item-nombre">

                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="nombre" id="formulario-contenido-panel-item-campo-nombre"
                                placeholder="Nombre" value="{{ isset($cliente->id) ? $cliente->nombre : '' }}" />
                        </div>

                    </div>


                    <div class="formulario-contenido-panel-item" id="item-telefono">

                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="telefono" id="formulario-contenido-panel-item-campo-telefono"
                                placeholder="Telefono" value="{{ isset($cliente->id) ? $cliente->telefono : '' }}" />
                            </input>
                        </div>

                    </div>

                    <div class="formulario-contenido-panel-item" id="item-email">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="email" name="correo" id="formulario-contenido-panel-item-campo-email"
                                placeholder="Email" value="{{ isset($cliente->id) ? $cliente->correo : '' }}" />
                        </div>
                    </div>
                </div>

                <div class="formulario-contenido-panel" data-tab="direccion">
                    <div class="formulario-contenido-panel-item" id="item-direccion">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="direccion" id="formulario-contenido-panel-item-campo-direccion"
                                placeholder="Calle, numero, piso, puerta"
                                value="{{ isset($cliente->id) ? $cliente->direccion : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-cp">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="cp" id="formulario-contenido-panel-item-campo-cp"
                                placeholder="Codigo postal" value="{{ isset($cliente->id) ? $cliente->cp : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-poblacion">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="poblacion" id="formulario-contenido-panel-item-campo-poblacion"
                                placeholder="Poblacion" value="{{ isset($cliente->id) ? $cliente->poblacion : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-provincia">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" name="provincia" id="formulario-contenido-panel-item-campo-provincia"
                                placeholder="Provincia" value="{{ isset($cliente->id) ? $cliente->provincia : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-pais">
                        <div class="formulario-contenido-panel-item-campo">
                            <select name="pais">
                                <option></option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $cliente->country_id == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
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

@endsection









@section('table')
    <div class="tabla-contenedor">
        <table class="admin-tabla" id="tabla-clientes">
            <tr>
                <th class="admin-tabla-idcolumna">Id</th>
                <th class="admin-tabla-columna2">Nombre</th>
                <th class="admin-tabla-correocolumna">Email</th>
                <th class="admin-tabla-telefonocolumna">telefono</th>
                <th class="admin-tabla-accionescolumna"></th>
            </tr>

            @foreach ($clientes as $cliente_elemento)
                <tr>
                    <td class="admin-tabla-idcolumna">{{ $cliente_elemento->id }}</td>
                    <td class="admin-tabla-nombrecolumna">{{ $cliente_elemento->nombre }}</td>
                    <td class="admin-tabla-correocolumna"> {{ $cliente_elemento->correo }}</td>
                    <td class="admin-tabla-telefonocolumna">{{ $cliente_elemento->telefono }}</td>

                    <td class="admin-tabla-accionescolumna">
                        <div class="admin-tabla-acciones">
                            <button type="button" class="boton-eliminar"
                                data-url="{{ route('clientes_destroy', ['cliente' => $cliente_elemento->id]) }}">
                                <svg href="" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                                </svg>
                            </button>

                            <button type="button" class="boton boton-editar"
                                data-url="{{ route('clientes_show', ['cliente' => $cliente_elemento->id]) }}">
                                <svg viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
