<!DOCTYPE html>
<html lang="{{ app()->getLocale() }} ">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @if( ! empty($title))| {{ $title }} @endif </title>
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <style>
        @font-face {
            font-family: "Carrois Gothic";
            src: url('/fonts/CarroisGothic-Regular.ttf');
        }
        @font-face {
            font-family: "Work Sans";
            src: url('/fonts/WorkSans-Regular.ttf');
        }
    </style>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('css')

</head>
<body>
    @if (!Auth::guest())
        @include('layouts.header')
    @endif

    @yield('content')

        <script src="{{ asset('js/app.js') }}"></script>

    @if (!Auth::guest())
        @include('layouts.footer')
    @endif
<!-- Scripts -->
</body>
</html>
