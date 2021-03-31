<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="">

        <title>FAQs</title>

        @if (Agent::isMobile())
            @include("front.partials.mobile.styles")
        @else
            @include("front.partials.desktop.styles")
        @endif
 
    </head>


    <body class="antialiased">
        
        <div class="wrapper">
            <div class="main-content">
                @yield('header')
                @yield('content')
            </div>
        </div>     

    </body>


    @if (Agent::isMobile())
        @include("front.partials.mobile.js")
    @else
        @include("front.partials.desktop.js")
    @endif

</html>