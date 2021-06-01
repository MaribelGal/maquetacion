@extends('front.layout.master')

@section('title')@lang('front/seo.web-name') | {{$product->seo->title}} @stop
@section('description'){{$product->seo->description != null? $product->seo->description : $product->seo->locale_seo->description}} @stop
@section('keywords'){{$product->seo->keywords != null ? $product->seo->keywords : $product->seo->locale_seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/products/' . $product->seo->slug)}} @stop
@section('facebook-title'){{$product->seo->title}} @stop
@section('facebook-description'){{$product->seo->description != null ? $product->seo->description : $product->seo->locale_seo->description}} @stop

@section("content")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.pages.products.desktop.product")
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.pages.products.mobile.product")
        </div>
    @endif
@endsection
        
        