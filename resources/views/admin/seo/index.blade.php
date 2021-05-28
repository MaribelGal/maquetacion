@extends('admin.seo.seo')

@section('tablerows')
    @isset($seos)
        @foreach ($seos as $seo_element)
            <div class="tabla-contenido-fila contents swipe-element ">
                <div class="tabla-contenido-fila-campos contents swipe-front promote-layer grid-column-1">
                    <div class="tabla-celda grid-column-1 ">{{ $seo_element->key }}</div>
                </div>

                <div class="tabla-contenido-fila-iconos contents">
                    

                    <div 
                        class="tabla-celda swipe-back swipe-edit boton-editar grid-column-2" id="swipe-edit"
                        
                        data-url="{{ route('seo_edit', ['key' => $seo_element->key]) }}"
                        >
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
