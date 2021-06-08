@php
    $route = 'shirts';
    // $filters = ['category' => $products_categories, 'search' => true, 'created_at' => true ]; 
    // $order = ['fecha de creación' => 'created_at', 'nombre' => 'name', 'categoría' => 'category_id'];
@endphp

@extends('admin.layout.table_form')

@section('tablerows')
    @isset($shirts)
        @foreach ($shirts as $shirt_element)
            <div class="tabla-contenido-fila contents swipe-element " >
                <div class="tabla-contenido-fila-campos contents swipe-front promote-layer grid-column-1">
                    <div class="tabla-celda grid-column-1 ">{{ $shirt_element->id }}</div>
                    <div class="tabla-celda grid-column-2 ">{{ $shirt_element->name }}</div>
                    {{-- <div class="tabla-celda grid-column-3 ">{{ $shirt_element->category->nombre }}</div> --}}
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


@section('form')

    @isset($shirt)

        <div class="form-container">
            <form class="admin-form" id="faqs-form" action="{{route("shirts_store")}}" autocomplete="off">
                
                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">

                <input type="hidden" name="id" value="{{isset($shirt->id) ? $shirt->id : ''}}">
                <input type="hidden" name="product[product_group_id]" value="{{isset($product->id) ? $product->id : ''}}"/>

                <div class="tabs-container">
                    <div class="tabs-container-menu">
                        <ul>
                            <li class="tab-item tab-active" data-tab="text">
                                Texto
                            </li>      
                            <li class="tab-item" data-tab="images">
                                Imágenes
                            </li>
                            <li class="tab-item" data-tab="seo">
                                Seo
                            </li>
                        </ul>
                    </div>
                    
                    <div class="tabs-container-buttons">
                        
                        @include('admin.components.form_buttons', ['route' => $route, 'visible' => $shirt->visible, 'create' => 'create'])
                        
                    </div>
                </div>
                
                <div class="tab-panel tab-active" data-tab="text">
                    <div class="two-columns">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">
                                    Categoría 
                                </label>
                            </div>
                            <div class="form-input">
                                <select  name="product[category_id]" id="category_id" class="input-highlight">
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
            
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Nombre</label>
                            </div>
                            <div class="form-input">
                                <input 
                                type="text" 
                                name="name" 
                                value="{{isset($shirt->name) ? $shirt->name : ''}}"  
                                class="input-highlight"  />
                            </div>
                        </div>
                    </div>

                    @component('admin.components.locale', ['tab' => 'content'])

                        @foreach ($localizations as $localization)

                            <div class="locale-tab-panel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="text" data-localetab="{{$localization->alias}}">

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="name" class="label-highlight">Título</label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[title.{{$localization->alias}}]" value="{{isset($seo["title.$localization->alias"]) ? $seo["title.$localization->alias"] : ''}}" class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="description" class="label-highlight">Descripción</label>
                                        </div>
                                        <div class="form-input">
                                            <textarea class="ckeditor input-highlight" name="locale[description.{{$localization->alias}}]">{{isset($locale["description.$localization->alias"]) ? $locale["description.$localization->alias"] : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                
                    @endcomponent
                </div>

                <div class="tab-panel" data-tab="images">

                    @component('admin.components.locale', ['tab' => 'images'])

                        @foreach ($localizations as $localization)

                        <div class="locale-tab-panel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="images" data-localetab="{{$localization->alias}}">

                            <div class="two-columns">
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Foto destacada</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload_image', [
                                            'entity' => 'products',
                                            'type' => 'single', 
                                            'content' => 'featured', 
                                            'alias' => $localization->alias,
                                            'files' => isset($product->image_featured_preview) ? $product->image_featured_preview : null
                                        ])
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label">
                                        <label for="name" class="label-highlight">Fotos grid</label>
                                    </div>
                                    <div class="form-input">
                                        @include('admin.components.upload_image', [
                                            'entity' => 'products',
                                            'type' => 'collection', 
                                            'content' => 'grid', 
                                            'alias' => $localization->alias,
                                            'files' => isset($product->image_featured_preview) ? $product->image_featured_preview : null
                                        ])
                                    </div>
                                </div>
                            </div>

                        </div>

                        @endforeach
                
                    @endcomponent

                </div>

                <div class="tab-panel" data-tab="seo">

                    @component('admin.components.locale', ['tab' => 'seo'])

                        @foreach ($localizations as $localization)

                            <div class="locale-tab-panel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="seo" data-localetab="{{$localization->alias}}">

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="keywords" class="label-highlight">
                                                Keywords 
                                            </label>
                                        </div>
                                        <div class="form-input">
                                            <input type="text" name="seo[keywords.{{$localization->alias}}]" value='{{isset($seo["keywords.$localization->alias"]) ? $seo["keywords.$localization->alias"] : ''}}' class="input-highlight">
                                        </div>
                                    </div>
                                </div>

                                <div class="one-column">
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="description" class="label-highlight">
                                                Descripción. 
                                            </label>
                                        </div>

                                        <div class="form-input">
                                            <textarea maxlength='160' class="input-highlight input-counter" name="seo[description.{{$localization->alias}}]">{{isset($seo["description.$localization->alias"]) ? $seo["description.$localization->alias"] : '' }}</textarea>
                                            <p>Has escrito <span>0</span> caracteres de los 160 recomendados.</p>
                                        </div>
                                    </div>
                                </div>
                                                               
                            </div>

                        @endforeach
                
                    @endcomponent

                </div>

            </form>

        </div>

    @endif  

@endsection