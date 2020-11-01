<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{asset('logo.png')}}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    
</head>
<body>

    <div id="app">
        @include('inc.app.navigation-bar')
        @include('inc.app.main-banner')
        @yield('content')
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio dignissimos quod, praesentium adipisci sequi eum ipsam, blanditiis, repudiandae iure qui at voluptates aut nobis eligendi aliquam ut vero reprehenderit tempore.
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos obcaecati ratione rem libero illum quaerat dolores non corporis deleniti dolor, dolorum molestias doloribus officia mollitia atque provident iusto nulla laudantium sapiente. Cumque, iste? Nesciunt rem nisi neque cumque, consequuntur, facere necessitatibus fuga aliquam quidem veniam tenetur alias id asperiores quasi, error ad quas! Nemo ad tempore sed a facere ut veritatis velit exercitationem. Voluptates minima vel deserunt delectus, cum nostrum fugiat animi numquam reprehenderit doloremque modi veniam accusantium placeat beatae, distinctio, molestias sapiente nam iusto sit rem deleniti. Ipsum quia possimus adipisci ab a assumenda obcaecati ratione facilis? Numquam officia voluptatibus quod. Eum veniam quos, perspiciatis, maxime animi, quas expedita totam fugit nisi molestias praesentium maiores accusantium! Numquam qui quae tenetur quaerat sequi consequatur omnis, minima neque dolores, obcaecati porro aspernatur! Porro dolore neque numquam dolores nisi in illo, tempore rem doloremque officia maxime. Nihil cupiditate nulla iure recusandae necessitatibus ratione adipisci ex! Consequuntur eligendi cumque officiis dolores laudantium inventore sint in quia blanditiis, quasi iure obcaecati iusto, ipsam illum id hic tempora. Ex placeat rem numquam sint aliquam libero nisi dolores expedita explicabo quam, nam dicta ducimus laboriosam quae consequatur ipsum dolor, odit corrupti animi laudantium vero doloremque deserunt.
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos obcaecati ratione rem libero illum quaerat dolores non corporis deleniti dolor, dolorum molestias doloribus officia mollitia atque provident iusto nulla laudantium sapiente. Cumque, iste? Nesciunt rem nisi neque cumque, consequuntur, facere necessitatibus fuga aliquam quidem veniam tenetur alias id asperiores quasi, error ad quas! Nemo ad tempore sed a facere ut veritatis velit exercitationem. Voluptates minima vel deserunt delectus, cum nostrum fugiat animi numquam reprehenderit doloremque modi veniam accusantium placeat beatae, distinctio, molestias sapiente nam iusto sit rem deleniti. Ipsum quia possimus adipisci ab a assumenda obcaecati ratione facilis? Numquam officia voluptatibus quod. Eum veniam quos, perspiciatis, maxime animi, quas expedita totam fugit nisi molestias praesentium maiores accusantium! Numquam qui quae tenetur quaerat sequi consequatur omnis, minima neque dolores, obcaecati porro aspernatur! Porro dolore neque numquam dolores nisi in illo, tempore rem doloremque officia maxime. Nihil cupiditate nulla iure recusandae necessitatibus ratione adipisci ex! Consequuntur eligendi cumque officiis dolores laudantium inventore sint in quia blanditiis, quasi iure obcaecati iusto, ipsam illum id hic tempora. Ex placeat rem numquam sint aliquam libero nisi dolores expedita explicabo quam, nam dicta ducimus laboriosam quae consequatur ipsum dolor, odit corrupti animi laudantium vero doloremque deserunt.
        @include('inc.app.footer')
    </div>
    
    @include('sweetalert::alert')
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/shop.js') }}"></script> --}}
    @stack('js')
</body>
</html>
