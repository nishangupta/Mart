<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin Login' }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('css')
    
</head>
<body>
    <div id="app">
        <div id="wrapper">
            @yield('content')
        </div>
    </div>
    
    @include('sweetalert::alert')
    
    <script src="{{asset('js/app.js')}}"></script>
    @stack('js')
</body>
</html>
