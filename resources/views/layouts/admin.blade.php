<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name')?? 'Admin | Bus reservation' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/lib/dataTables.bootstrap4.min.css')}}">
    <style>
        .content-container{
            min-height:80vh;
        }
    </style>
    @stack('css')
    
</head>
<body>
    <div id="app">
        <div id="wrapper">
            @include('inc.admin.sidebar')

             <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    @include('inc.admin.topbar')

                    <div class="content-container">
                        @yield('content')
                    </div>

                    @include('inc.admin.footer')
                </div>
            </div>
        </div>
      
        @include('inc.logout-modal')
    </div>
    
    @include('sweetalert::alert')
    
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/lib/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    {{-- needs to be imported here --}}
    <script src="{{asset('js/lib/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('js/lib/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/lib/Chart.min.js')}}"></script>
    @stack('js')
</body>
</html>
