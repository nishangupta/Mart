<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Admin | '.config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/lib/dataTables.bootstrap4.min.css')}}">
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
    <script src="{{asset('js/admin.js')}}"></script>
    {{-- needs to be imported here --}}
    @stack('js')
</body>
</html>
