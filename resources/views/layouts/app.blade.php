<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name')}}</title> --}}
    <title>@yield('page-title')</title>

    <link rel="shortcut icon" type="image/png" href="{{asset('logo.png')}}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
    <div class="loader-svg" id="loaderSvg">
        <img src="{{asset('images/loading/loading.svg')}}" alt="">
    </div>

    <div id="app">
        @include('inc.app.navigation-bar')
        @yield('content')
        @include('inc.app.footer')
    </div>
    
     
    @include('sweetalert::alert')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/shop.js') }}"></script>
    @stack('js')
</body>
</html>
