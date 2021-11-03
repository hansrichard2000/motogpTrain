@extends('layouts.html')

@section('judul')
    Rider List
@endsection

@section('content')
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
<div class="container mt-5">
    <div class="row">
        <div class="col text-bold text-light text-left">
            <h1 class="graduate">Team List</h1>
        </div>
    </div>
    @auth
        <form method="GET" action="{{route('team.create')}}">
            <button class="btn btn-primary float-right mt-n4 mr-lg-5" href="{{route('team.create')}}">
                    Add
            </button>
        </form>
    @endauth
    <div class="row">
        <div class="col">
            <hr class="linered">
        </div>
    </div>
    @foreach ($teams->Chunk(3) as $teamChunk)
        <div class="row">
            @foreach ($teamChunk as $team)
                <div class="col mt-4">
                    <div class="card kartu">
                        <img class="card-img-top" src="/images/team-back/{{$team->bg_image}}" alt="Card image cap">
                        <div class="row">
                            <div class="col">
                                <ul type="none">
                                    <li><strong>{{$team->name}}</strong></li>
                                    <li>Constructor : {{$team->creator->name}}</li>
                                    <li>Principal : {{$team->principal}}</li>
                                    <li>Entry Year  : {{$team->entry}}</li>
                                </ul>
                            </div>
                            <div class="col-right mr-5">
                                <img class="sideLogo" src="/images/team-logo/{{$team->logo}}" alt="Card image cap">
                            </div>
                        </div>
                        @auth
                            <div class="row">
                                <div class="col ml-5">
                                    <form action="{{route('team.edit', $team, $constructors)}}" method="GET">
                                        @csrf
                                            <input type="hidden" name="_method" value="EDIT">
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                </div>
                                <div class="col ml-n5 mr-5">
                                    <form action="{{route('team.destroy', $team)}}" method="POST">
                                        @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection
