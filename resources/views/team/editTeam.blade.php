@extends('layouts.html')

@section('judul')
    Edit Team
@endsection

@section('content')
    <div class="container mt-5">
        <nav class="navbar navbar-expand-lg fixed-top text-light navbar-dark bg-danger shadow-sm">
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
                        <li><a class="nav-link" href="{{route('motogp.index')}}">Home</a></li>
                        <li><a class="nav-link" href="{{route('rider.index')}}">Rider List</a></li>
                        <li><a class="nav-link active" href="{{route('team.index')}}">Teams List</a></li>
                        <li><a class="nav-link" href="{{route('constructor.index')}}">Constructor List</a></li>
                        @auth
                            @if(\illuminate\Support\Facades\Auth::user()->isAdmin())
                                <li><a class="nav-link" href={{route('admin.user.index')}}>Users List</a></li>
                            @endif
                        @endauth
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
        <br><br><br>
        <h2 class="text-light graduate">Edit Team</h2>
        <form action="{{route('team.update', $team)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
                <label for="name" class="text-light">Team's Name :</label>
                <input type="text" value="{{$team->name}}" class="form-control" id="name" name="name" required>
            </div>
            <label for="engine" class="text-light">Constructor :</label>
            <div class="form-group">
                <select name="engine" class="custom-select">
                    @foreach ($constructors as $constructor)
                        <option value="{{$constructor->id}}">{{$constructor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="principal" class="text-light">principal :</label>
                <input type="text" value="{{$team->principal}}" class="form-control" id="principal" name="principal" required>
            </div>
            <div class="form-group">
                <label for="entry" class="text-light">Entry :</label>
                <input type="text" value="{{$team->entry}}" class="form-control" id="entry" name="entry" required>
            </div>
            <div class="form-group">
                <label form="logo" class="text-light">Upload Logo</label>
                <input type="file" class="form-control-file text-light" id="logo" name="logo">
            </div>
            <div class="form-group">
                <label form="bg_image" class="text-light">Upload Background</label>
                <input type="file" class="form-control-file text-light" id="bg_image" name="bg_image">
            </div>
            <input type="hidden" name="updated_by" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
            <input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit">
        </form>
    </div>
@endsection
