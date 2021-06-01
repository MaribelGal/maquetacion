@php
$route = 'shirts';

$columnList = Schema::getColumnListing($shirt->getTable());
$activePosition = array_search('active', $columnList, true);
$visiblePosition = array_search('visible', $columnList, true);
unset($columnList[$activePosition], $columnList[$visiblePosition]);

$filtros = ['search' => true, 'date_start' => true, 'date_end' => true, 'order' => $columnList];


@endphp

@extends('admin.tabla_formulario')




@section('form')

    {{-- @isset($shirt) --}}
    <form class="admin-formulario" id="formulario-shirts" action="{{ route('shirts_store') }}" autocomplete="off">

        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{isset($shirt->id) ? $shirt->id : ''}}">
        <input type="hidden" name="product[id]" value="{{isset($product->id) ? $product->id : ''}}">


        <div class="formulario-contenedor">

            <div class="formulario-tab">
                <div class="formulario-tab-item tab-item-text">
                    <div class="formulario-tab-item-panelselector tab-active" id="tab-item-texto" data-tab="texto">
                        <div>
                            <p class="tab-title">Texto</p>
                        </div>
                    </div>

                    <div class="formulario-tab-item-panelselector " id="tab-item-precio" data-tab="precio">
                        <div>
                            <p class="tab-title"> Precio-stock </p>
                        </div>
                    </div>
                    <div class="formulario-tab-item-panelselector caracteristicas-composicion" id="tab-item-caracteristicas" data-tab="caracteristicas">
                        <div>
                            <p class="tab-title"> Características </p>
                        </div>
                    </div>
                    <div class="formulario-tab-item-panelselector " id="tab-item-imagenes" data-tab="imagenes">
                        <div>
                            <p class="tab-title"> Imagenes </p>
                        </div>
                    </div>
                    <div class="formulario-tab-item-panelselector " id="tab-item-seo" data-tab="seo">
                        <div>
                            <p class="tab-title"> Seo </p>
                        </div>
                    </div>
                    
                </div>

                <div class="formulario-tab-item tab-item-action">
                    @include('admin.components.form_actions', [
                        'route'=> $route,
                        'create' => 'create',
                        'visible' => 'visible'
                    ])
                </div>
            </div>


            <div class="formulario-contenido">

                <div class="formulario-contenido-panel tab-active" data-tab="texto">
                    <div class="panel-static">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-1" id="item-name">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="text" 
                                    class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-name" 
                                    name="name"
                                    placeholder="Inserta el nombre" 
                                    value="{{ isset($shirt->name) ? $shirt->name : '' }}" />
                            </div>
                        </div>

                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-1" id="item-categoria">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="product[category_id]" id="category_id">
                                    <option hidden selected>-- Categoria --</option>
                                    @foreach ($products_categories as $product_category)
                                        <option value="{{ $product_category->id }}"
                                            @isset($product)
                                                {{ $product->product_category_id == $product_category->id ? 'selected' : '' }}
                                            @endisset
                                            >{{ $product_category->name }}
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
                                            placeholder="Inserta el titulo"
                                            value="{{isset($seo["title.".$localization->alias]) ? $seo["title.".$localization->alias]: ''}}" />
                                    </div>
                                </div>

                                <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-4"
                                    id="item-descripcion">
                                    <div class="formulario-contenido-panel-item-campo" id="ckeditor">
                                        <textarea type="text" name="locale[description.{{$localization->alias}}]"
                                            class="formulario-contenido-panel-item-campo-descripcion ckeditor"
                                            placeholder="Inserta la descripcion"
                                            >{{isset($locale["description.".$localization->alias]) ? $locale["description.".$localization->alias] : '' }}
                                          </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endcomponent
                </div>


                <div class="formulario-contenido-panel" data-tab="precio">
                    <div class="panel-static">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-1" id="item-cost">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" 
                                    class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-cost" 
                                    name="product[cost]"
                                    placeholder="Precio coste" 
                                    value="{{ isset($product) ? $product->cost->cost : '' }}" />
                            </div>
                        </div>

                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-2" id="item-price-pruchase">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" 
                                    class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-price-purchase" 
                                    name="product[price][purchase]"
                                    placeholder="Precio de venta (sin tasas)" 
                                    value="{{ isset($product) ? $product->price_purchase->price : '' }}" />
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-2" id="item-price-rent">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" 
                                    class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-price-rent" 
                                    name="product[price][rent]"
                                    placeholder="Precio de alquiler (sin tasas)" 
                                    value="{{ isset($product) ? $product->price_rent->price_hour : '' }}" />
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-3" id="item-stock">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" 
                                    class="formulario-contenido-panel-item-campo"
                                    id="formulario-contenido-panel-item-campo-stock" 
                                    name="product[stock]"
                                    placeholder="Stock" 
                                    value="{{ isset($product->stock->quantity) ? $product->stock->quantity : '' }}" />
                            </div>
                        </div>

                        <div class="formulario-contenido-panel-item grid-column-span-2 grid-row-4" id="item-modificadores">
                            <div class="formulario-contenido-panel-item-campo">
                                <p>Selecciona los modificadores de precio a aplicar:</p>
                    
                                <p>Alquiler: </p>
                                @foreach ($prices_modifiers as $price_modifier)
                                    <label> {{ $price_modifier->name }}
                                        <input 
                                        type="checkbox"
                                        name="product[modifier][purchase][{{ $price_modifier->id }}]" 
                                        value="{{ $price_modifier->id }}"
                                        @isset($product)
                                            @foreach ($product->price_modifiers_purchase as $modifier_purchase)
                                                {{ $modifier_purchase->modifier_id == $price_modifier->id ? 'checked' : ''}}
                                            @endforeach
                                        @endisset
                                        > 
                                    </label>
                                @endforeach

                                <p>Venta: </p>
                                @foreach ($prices_modifiers as $price_modifier)
                                    <label> {{ $price_modifier->name }}
                                        <input 
                                        type="checkbox" 
                                        name="product[modifier][rent][{{ $price_modifier->id }}]" 
                                        value="{{ $price_modifier->id }}"
                                        @isset($product)
                                            @foreach ($product->price_modifiers_rent as $modifier_rent)
                                                {{ $modifier_rent->modifier_id == $price_modifier->id ? 'checked' : ''}}
                                            @endforeach
                                        @endisset
                                        > 
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-1" id="item-supplier">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="product[supplier]" id="supplier_id">
                                    <option hidden selected>-- Proveedor --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            @isset($product)
                                                {{ $product->cost->supplier_id == $supplier->id ? 'selected' : ''}}
                                            @endisset
                                            >{{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formulario-contenido-panel" data-tab="caracteristicas">
                    <div class="panel-static">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-1" id="item-size">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="size" id="size_id">
                                    <option hidden selected>-- Talla --</option>
                                    @foreach ($shirts_sizes as $shirt_size)
                                        <option value="{{ $shirt_size->id }}"
                                            {{ $shirt->shirt_size_id == $shirt_size->id ? 'selected' : '' }}>
                                            {{ $shirt_size->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-2" id="item-sleeves">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="sleeve" id="sleeve_id">
                                    <option hidden selected>-- Mangas --</option>
                                    @foreach ($shirts_sleeves as $shirt_sleeve)
                                        <option value="{{ $shirt_sleeve->id }}"
                                            {{ $shirt->shirt_sleeve_id == $shirt_sleeve->id ? 'selected' : '' }}>
                                            {{ $shirt_sleeve->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-3" id="item-necks">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="neck" id="neck_id">
                                    <option hidden selected>-- Cuello --</option>
                                    @foreach ($shirts_necks as $shirt_neck)
                                        <option value="{{ $shirt_neck->id }}"
                                            {{ $shirt->shirt_neck_id == $shirt_neck->id ? 'selected' : '' }}>
                                            {{ $shirt_neck->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-1" id="item-patterns">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="pattern" id="pattern_id">
                                    <option hidden selected>-- Estampado --</option>
                                    @foreach ($shirts_patterns as $shirt_pattern)
                                        <option value="{{ $shirt_pattern->id }}"
                                            {{ $shirt->shirt_pattern_id == $shirt_pattern->id ? 'selected' : '' }}>
                                            {{ $shirt_pattern->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-2" id="item-colors">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="color" id="color_id">
                                    <option hidden selected>-- Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}"
                                            {{ $shirt->color_id == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-3" id="item-brands">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="brand" id="brand_id">
                                    <option hidden selected>-- Marca --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $shirt->brand_id == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="formulario-contenido-panel " data-tab="imagenes">
                    @component('admin.components.form_locale')
                        @foreach ($localizations as $localization)
                            <div class="panel-locale">
                                <div class="panel-locale-item contents {{ $loop->first ? 'active':''}}" data-locale="{{$localization->alias}}">
                                    <div class="formulario-contenido-panel-item" >
                                        
                                        @isset($product)
                                            @include('admin.components.upload', [
                                                'type' => 'image', 
                                                'content' => 'featured', 
                                                'alias' => $localization->alias,
                                                'files' =>$product->image_featured_preview
                                            ])
                                        @else
                                            @include('admin.components.upload', [
                                                'type' => 'image', 
                                                'content' => 'featured', 
                                                'alias' => $localization->alias,
                                            ])
                                        @endisset
                                    </div>
                                    <div class="formulario-contenido-panel-item images-container">
                                        @isset($product)
                                            @include('admin.components.upload', [
                                                'type' => 'images', 
                                                'content' => 'grid', 
                                                'alias' => $localization->alias,
                                                'files' => $product->image_grid_preview
                                            ])
                                        @else
                                            @include('admin.components.upload', [
                                                'type' => 'images', 
                                                'content' => 'grid', 
                                                'alias' => $localization->alias,
                                            ])
                                        @endisset

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
        
    </form>

    <form class="admin-formulario-dependiente caracteristicas-composicion" id="formulario-shirts-tissues" action="{{ route('shirtsTissues_store') }}" autocomplete="off" data-tab="caracteristicas">
        {{ csrf_field() }}

        <input type="hidden" name="id" value="">
        <input type="hidden" name="id-parent" value="">

        <div class="formulario-contenedor">
            <div class="formulario-tab">
                <div class="formulario-tab-item">
                    <div class="formulario-tab-item-panelselector active" id="tab-item-composicion" data-tab="caracteristicas">
                        <div>
                            <p class="tab-title">composicion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="formulario-contenido">
            <div class="formulario-contenido-panel active" data-tab="caracteristicas">
                <div class="panel-static" >                            
                    
                    @isset($product)
                        @foreach ($product->tissues as $product_tissue)
                        <div class="item-tissue-composition grid">
                            <div class="formulario-contenido-panel-item item-tissue-composition grid-column-1 grid-row-{{$loop->iteration}}">
                                    <div class="formulario-contenido-panel-item-campo">
                                        <select name="tissue[{{$loop->index}}]" >
                                            <option hidden selected>-- Tejido --</option>
                                            @foreach ($tissues as $tissue)
                                                <option value="{{ $tissue->id }}"
                                                    {{ $product_tissue->id == $tissue->id ? 'selected' : '' }}>
                                                    {{ $tissue->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                            </div>
                            
                            <div class="formulario-contenido-panel-item item-tissue-composition grid-column-2 grid-row-{{$loop->iteration}}">
                                <div class="formulario-contenido-panel-item-campo">
                                    <input type="number" name="percentage[{{$loop->index}}]" value="{{ $product_tissue->percentage_tissue }}"
                                    />
                                </div>
                            </div>
                        </div>
                        @endforeach
                                            
                    @else
                    <div class="item-tissue-composition grid">
                       <div class="formulario-contenido-panel-item grid-column-1 grid-row-1">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="tissue[0]" >
                                    <option hidden selected>-- Tejido --</option>
                                    @foreach ($tissues as $tissue)
                                        <option value="{{ $tissue->id }}"
                                            {{ $shirt->tissue_id == $tissue->id ? 'selected' : '' }}>
                                            {{ $tissue->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div> 
                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-1">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" name="percentage[0]" />
                            </div>
                        </div>
                    </div>
                    <div class="item-tissue-composition grid">
                        <div class="formulario-contenido-panel-item grid-column-1 grid-row-2">
                            <div class="formulario-contenido-panel-item-campo">
                                <select name="tissue[1]" >
                                    <option hidden selected>-- Tejido --</option>
                                    @foreach ($tissues as $tissue)
                                        <option value="{{ $tissue->id }}"
                                            {{ $shirt->tissue_id == $tissue->id ? 'selected' : '' }}>
                                            {{ $tissue->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div> 
                        <div class="formulario-contenido-panel-item grid-column-2 grid-row-2">
                            <div class="formulario-contenido-panel-item-campo">
                                <input type="number" name="percentage[1]" />
                            </div>
                        </div>
                    </div>    
                    @endisset
                </div>
            </div>
        </div>
    </form>


    <div class="formulario-contenido-panel-item" id="item-guardar">
        <div class="formulario-contenido-panel-item-boton desktop" id="boton-guardar-desktop">
            <input type="button" value="Guardar"> </input>
        </div>
    </div>
@endsection


@section('table')
    @isset($shirts)
        <div class="tabla-contenedor" id="tabla-shirts">
            <div class="tabla-alerta " id="alerta">
                <div class="tabla-alerta-eliminar " id="alerta-eliminar">
                    <div class="tabla-alerta-eliminar-mensaje"> ¿Seguro que quieres eliminar? </div>
                    <div class="tabla-alerta-eliminar-opciones">
                        <div class="opcion" id="opcion-descartar">No</div>
                        <div class="opcion" id="opcion-confirmar">Si</div>
                    </div>
                </div>
            </div>

            <div class="tabla-contenido" id="tabla-shirts-filas" data-pagination="{{ $shirts->nextPageUrl() }}"
                data-lastpage="{{ $shirts->lastPage() }}">
                @yield('tablerows')
            </div>

            @if ($agent->isDesktop())
                @include('admin.components.table_pagination', ['items' => $shirts])
            @endif
        </div>
    @endisset
@endsection

