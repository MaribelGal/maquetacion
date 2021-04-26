<div class="paginacion-tabla">
    <div class="paginacion-tabla-info">
        <div class="paginacion-tabla-total">
            <p>{{ $items->total() }} registros</p>
        </div>

        <div class="paginacion-tabla-pages">
            <p>Mostrando la página {{ $items->currentPage() }} de {{ $items->lastPage() }}</p>
        </div>
    </div>

    <div class="paginacion-tabla-botones">
        <p>
            @if ($items->currentPage() != 1)
                <span class="paginacion-tabla-boton" data-page="{{ $items->url(1) }}">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M18.41,16.59L13.82,12L18.41,7.41L17,6L11,12L17,18L18.41,16.59M6,6H8V18H6V6Z" />
                    </svg>
                </span>
                <span class="paginacion-tabla-boton" data-page="{{ $items->previousPageUrl() }}">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                    </svg>
                </span>
            @endif
            @if ($items->currentPage() == 1)
                <span class="paginacion-tabla-boton-disable">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M18.41,16.59L13.82,12L18.41,7.41L17,6L11,12L17,18L18.41,16.59M6,6H8V18H6V6Z" />
                    </svg>
                </span>
                <span class="paginacion-tabla-boton-disable">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                    </svg>
                </span>
            @endif

            @if ($items->currentPage() != $items->lastPage())
                <span class="paginacion-tabla-boton" data-page="{{ $items->nextPageUrl() }}">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                    </svg>
                </span>
                <span class="paginacion-tabla-boton" data-page="{{ $items->url($items->lastPage()) }}">
                    <svg viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M5.59,7.41L10.18,12L5.59,16.59L7,18L13,12L7,6L5.59,7.41M16,6H18V18H16V6Z" />
                    </svg>
                </span>
            @endif

            @if ($items->currentPage() == $items->lastPage())
            <span class="paginacion-tabla-boton-disable">
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                </svg>
            </span>
            <span class="paginacion-tabla-boton-disable">
                <svg viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M5.59,7.41L10.18,12L5.59,16.59L7,18L13,12L7,6L5.59,7.41M16,6H18V18H16V6Z" />
                </svg>
            </span>
        @endif


        </p>
    </div>
</div>
