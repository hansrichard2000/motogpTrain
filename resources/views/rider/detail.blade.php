@extends('layouts.html')

@section('judul')
    Rider Details
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
                <li><a class="nav-link active" href="{{route('rider.index')}}">Rider List</a></li>
                <li><a class="nav-link" href="{{route('team.index')}}">Teams List</a></li>
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
            <h1 class="graduate">Rider Detail</h1>
        </div>
    </div>
    @auth
        <form method="GET" action="{{route('rider.edit', $ridershow, $teams, $constructors)}}">
            <button class="btn btn-primary float-right mt-n4 mr-lg-5" href="{{route('rider.edit', $ridershow, $teams, $constructors)}}">
                    Edit
            </button>
        </form>
    @endauth
    <div class="row">
        <div class="col">
            <hr class="linered">
        </div>
    </div>
    <div class="row">
        <div class="col text-light">
            <div class="card mb-3 kartuDetail" style="max-width: 540px;">
                <div class="row no-gutters">
                  <div class="col-md-4">
                    <img src="/images/rider/{{$ridershow->picture}}" class="card-img riderImg mt-3" alt="RiderPic">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body ml-5">
                        <img class="flag" src="/images/flag/{{$ridershow->flag}}" alt=""> {{$ridershow->nation}}<br>
                        <h4><strong>{{$ridershow->name}}</strong></h4>
                        <h6>{{$ridershow->group->name}}</h6>
                        <ul class="ml-n4" type="none">
                            <li>Race Number : {{$ridershow->number}}</li>
                            <li>Bike : {{$ridershow->creatorEngine->name}}</li>
                            <li>Date Of Birth : {{$ridershow->date}}</li>
                            <li>Place of Birth : {{$ridershow->place}}</li>
                            <li>Height : {{$ridershow->height}} cm | Weight : {{$ridershow->weight}} kg</li>
                        </ul>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card text-white mt-5 back-result">
                <div class="card-header text-center">Podiums</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$ridershow->podiums}}</h5>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card text-white mt-5 back-result">
                <div class="card-header text-center">Wins</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$ridershow->wins}}</h5>
                </div>
              </div>
        </div>
        <div class="col">
            <div class="card text-white mt-5 back-result">
                <div class="card-header text-center">World Champion</div>
                <div class="card-body">
                    <h5 class="card-title text-center">{{$ridershow->title}}</h5>
                </div>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="jumbotron jumbotron-fluid bg-light pl-4 pr-4">
                <p class="text-justify mt-n5 mb-n4">{{$ridershow->description}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
