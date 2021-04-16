<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="">

    <title>FAQs</title>

    @include("admin.partials.styles")

</head>

</header>

<body class="antialiased">

    @include('admin.partials.header')

    <div class="wrapper">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

</body>


@include("admin.partials.js")


</html>
