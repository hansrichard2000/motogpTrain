<html>
    <head>
        <title>@yield('judul')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{!! asset('/css/main.css?v=').time() !!}">
        <link rel="icon" sizes="16x16"type="image/png" href="https://static.motogp.com/riders-front/icons/favicon-16x16.png">
        <link rel="icon" sizes="32x32"type="image/png" href="https://static.motogp.com/riders-front/icons/favicon-32x32.png">
        <link href="https://fonts.googleapis.com/css2?family=Graduate&display=swap" rel="stylesheet">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    </head>
    <body class="background">
        @yield('content')
        <footer class="bg-danger">
            <div class="container mt-5 pt-2 pb-2">
                <h6 class="text-light text-center">Copyright&copy; 2020 Hans Richard Alim Natadjaja</h6>
            </div>
        </footer>
    </body>
</html>
