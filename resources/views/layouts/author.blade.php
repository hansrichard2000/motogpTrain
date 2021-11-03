<!DOCTYPE html>
<html>
    <head>
        <title>@yield('judul')</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{!! asset('/css/author.css?v=').time() !!}">
        <link rel="icon" sizes="16x16"type="image/png" href="https://static.motogp.com/riders-front/icons/favicon-16x16.png">
        <link rel="icon" sizes="32x32"type="image/png" href="https://static.motogp.com/riders-front/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" href="{{asset('images/Moto_Gp_logo.svg.png')}}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg fixed-top text-light navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/motogp-white-logo.svg')}}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto text-white">
                        <li><a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a></li>
                        <li><a class="nav-link" href="/rider">Rider List</a></li>
                        <li><a class="nav-link" href="/team">Teams List</a></li>
                        <li><a class="nav-link" href="/constructor">Constructor List</a></li>
                        @auth<li><a class="nav-link" href="/user">Users List</a></li>@endauth
                        <li><a class="nav-link active" href="/author">Website Maker</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
                @yield('isi')
            </div>
          </div>
          @yield('content')
          <footer class="bg-dark text-white">
              <div class="container">
                <div class="row pt-3 pb-3">
                    <div class="col text-center">
                        Copyright &#169; 2020
                    </div>
                </div>
              </div>
          </footer>
    </body>
</html>
