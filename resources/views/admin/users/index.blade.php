@php
$route = 'users';
@endphp

@extends('admin.tabla_formulario')

@section('header')
    @include('admin.partials.header')
@endsection

@section('form')

    <form class="admin-formulario" id="formulario-faqs" action="{{ route('users_store') }}" autocomplete="off">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : '' }}">

        <div class="formulario-contenedor">
            <div class="formulario-contenido">
                <div class="formulario-contenido-panel active">
                    <div class="formulario-contenido-panel-item" id="item-name">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" id="formulario-contenido-item-campo-name" name="name"
                                placeholder="Inserta el nombre" value="{{ isset($user->name) ? $user->name : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-email">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="text" id="formulario-contenido-item-campo-email" name="email"
                                placeholder="Inserta el correo" value="{{ isset($user->email) ? $user->email : '' }}" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-password">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="password" id="formulario-contenido-item-campo-password" name="password"
                                placeholder="Inserta la contraseña" value="" />
                        </div>
                    </div>

                    <div class="formulario-contenido-panel-item" id="item-password-confirmation">
                        <div class="formulario-contenido-panel-item-campo">
                            <input type="password" id="formulario-contenido-item-campo-password-confirmation"
                                name="password_confirmation" placeholder="Repite la contraseña" value="" />
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

        <div class="tabla-contenido">
            @foreach ($users as $user)

                <div class="tabla-contenido-fila contents swipe-element ">
                    <div class="tabla-contenido-fila-campos contents swipe-front promote-layer grid-column-1">
                        <div class="tabla-celda grid-column-1 ">{{ $user->id }}</div>
                        <div class="tabla-celda grid-column-2 ">{{ $user->name }}</div>
                        <div class="tabla-celda grid-column-3 ">{{ $user->email }}</div>
                    </div>

                    <div class="tabla-contenido-fila-iconos contents">
                        <div class=" tabla-celda swipe-back swipe-delete boton-eliminar grid-column-5" id="swipe-delete"
                            data-url="{{ route('users_destroy', ['user' => $user->id]) }}">

                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                            </svg>
                        </div>

                        <div class=" tabla-celda swipe-back swipe-edit boton-editar grid-column-6" id="swipe-edit"
                            data-url="{{ route('users_show', ['user' => $user->id]) }}">
                            <svg viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
