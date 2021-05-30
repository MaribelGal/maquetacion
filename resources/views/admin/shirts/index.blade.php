@extends('admin.shirts.shirts')

@section('tablerows')
    @isset($shirts)
        @foreach ($shirts as $shirt_element)
            <div class="tabla-contenido-fila contents swipe-element " >
                <div class="tabla-contenido-fila-campos contents swipe-front promote-layer grid-column-1">
                    <div class="tabla-celda grid-column-1 ">{{ $shirt_element->id }}</div>
                    <div class="tabla-celda grid-column-2 ">{{ $shirt_element->titulo }}</div>
                    <div class="tabla-celda grid-column-3 ">{{ $shirt_element->category->nombre }}</div>
                    <div class="tabla-celda grid-column-4 ">{{ Carbon\Carbon::parse($shirt_element->created_at)->format('d-m-Y') }}</div>
                </div>

                <div class="tabla-contenido-fila-iconos contents">
                    <div class=" tabla-celda swipe-back swipe-delete boton-eliminar grid-column-5" id="swipe-delete"
                        data-url="{{ route('shirts_destroy', ['shirt' => $shirt_element->id]) }}">

                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg>
                    </div>

                    <div class=" tabla-celda swipe-back swipe-edit boton-editar grid-column-6" id="swipe-edit"
                        data-url="{{ route('shirts_show', ['shirt' => $shirt_element->id]) }}">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z" />
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
@endsection