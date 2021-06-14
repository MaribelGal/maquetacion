@php
    $route = 'shirts';
    // $filters = ['category' => $products_categories, 'search' => true, 'created_at' => true ];
    // $order = ['fecha de creación' => 'created_at', 'nombre' => 'name', 'categoría' => 'category_id'];
    // Debugbar::info($shirts);

    // foreach ($shirts as $shirt_element) {
    //     Debugbar::info($shirt_element);
    // }

@endphp

@extends('admin.layout.table_form')

@section('table')
    @isset($shirts)
        <div id="table-container">
            @foreach ($shirts as $shirt_element)
                <div class="table-row swipe-element">
                    <div class="table-field-container swipe-front">
                        <div class="table-field"><p><span>Clave:</span> {{$shirt_element->key}}</p></div>
                    </div>
                    <div class="table-icons-container swipe-back">
                        <div class="table-icons edit-button right-swipe" data-url="{{route('shirts_store', ['shirt' => $shirt_element->id])}}">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z" />
                            </svg>
                        </div>
                    </div>

                    <div class="table-icons delete-button left-swipe" data-url="{{route('shirts_destroy', ['shirt' => $shirt_element->id])}}">
                        <svg viewBox="0 0 24 24">
                            <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z" />
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset
@endsection



@section('form')

    {{-- @isset($shirts) --}}
        <div class="form-container">

            <div class="tabs-container">
                <div class="tabs-container-menu">
                    <ul>
                        <li class="tab-item tab-active" data-tab="text">
                            Texto
                        </li>
                        <li class="tab-item" data-tab="model">
                            Modelo
                        </li>

                        <li class="tab-item" data-tab="seo">
                            Seo
                        </li>
                        @isset($shirtModel)
                            <li class="tab-item" data-tab="variaciones">
                                Variaciones
                            </li>
                        @endisset

                    </ul>
                </div>

                <div class="tabs-container-buttons">

                    @include('admin.components.form_buttons', [
                        'route' => $route,
                        'visible' => isset($shirtModel) ? $shirtModel->visible : 1,

                        'create' => 'create'])

                </div>
            </div>

            <form class="admin-form" id="shirtsmodel-form" action="{{route("store_shirt_model")}}" autocomplete="off">

                {{ csrf_field() }}

                <input autocomplete="false" name="hidden" type="text" style="display:none;">

                <input type="hidden" name="product" value="{{isset($shirtModel->id) ? $shirtModel->id : ''}}">
                <input type="hidden" name="productGroup[id]" value="{{isset($productGroup->id) ? $productGroup->id : ''}}"/>

                <div class="tab-panel tab-active" data-tab="text">
                    <div class="two-columns">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="category_id" class="label-highlight">
                                    Categoría
                                </label>
                            </div>
                            <div class="form-input">
                                <select  name="productGroup[category_id]"  class="input-highlight">
                                    <option hidden selected>-- Categoria --</option>
                                    @foreach ($products_categories as $product_category)
                                        <option value="{{ $product_category->id }}"
                                            @isset($productGroup)
                                                {{ $productGroup->category_id == $product_category->id ? 'selected' : '' }}
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
                                value="{{isset($shirtModel->name) ? $shirtModel->name : ''}}"
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

                <div class="tab-panel" data-tab="model">
                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Mangas</label>
                            </div>
                            <div class="form-input">
                                <select name="sleeve" id="sleeve_id">
                                    <option hidden selected>-- Mangas --</option>
                                    @foreach ($shirts_sleeves as $shirt_sleeve)
                                        <option value="{{ $shirt_sleeve->id }}"
                                            @isset($shirtModel)
                                                {{ $shirtModel->shirt_sleeve_id == $shirt_sleeve->id ? 'selected' : '' }}
                                            @endisset
                                            >{{ $shirt_sleeve->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Cuello</label>
                            </div>
                            <div class="form-input">
                                <select name="neck" id="neck_id">
                                    <option hidden selected>-- Cuello --</option>
                                    @foreach ($shirts_necks as $shirt_neck)
                                        <option value="{{ $shirt_neck->id }}"
                                            @isset($shirtModel)
                                            {{ $shirtModel->shirt_neck_id == $shirt_neck->id ? 'selected' : '' }}
                                            @endisset
                                            >{{ $shirt_neck->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Estampado</label>
                            </div>
                            <div class="form-input">
                                <select name="pattern" id="pattern_id">
                                    <option hidden selected>-- Estampado --</option>
                                    @foreach ($shirts_patterns as $shirt_pattern)
                                        <option value="{{ $shirt_pattern->id }}"

                                            @isset($shirtModel)
                                            {{ $shirtModel->shirt_pattern_id == $shirt_pattern->id ? 'selected' : '' }}
                                            @endisset
                                            >{{ $shirt_pattern->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="form-label">
                                <label for="name" class="label-highlight">Marca</label>
                            </div>
                            <div class="form-input">
                                <select name="brand" id="brand_id">
                                    <option hidden selected>-- Marca --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            @isset($shirtModel)
                                            {{ $shirtModel->brand_id == $brand->id ? 'selected' : '' }}
                                            @endisset
                                            >{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

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

            @isset($shirtModel)
                <div class="tab-panel" data-tab="variaciones">
                    <div class="variants-panel">
                        <div class="variant-navigate">
                            <div class="variant-navigate-previus">
                                <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z" />
                                </svg>
                            </div>
                            <div class="variant-navigate-next">
                                <svg  viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                                </svg>
                            </div>
                            <div class="variant-navigate-actual"></div>
                            <div class="variant-navigate-total"></div>
                        </div>

                        @include('admin.components.shirt_variant_template')
                    </div>
                </div>
            @endif
        </div>
    {{-- @endif --}}
@endsection
