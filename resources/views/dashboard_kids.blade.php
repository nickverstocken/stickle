@extends('layout')

@section('content')
    <div class="navbar-leftfixed" id="kidsnav">
        <nav>
            <ul>
                <li>
                    <a href="/child/dashboard"><img src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Home"></a>
                    <div class="coins"> <img class="coinsImg" src="{{ URL::asset('images/icons/coins.svg') }}" alt="Coins">250</div>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/dashboard') ? 'selected' : '' }}" href="/kind/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/prijzen') ? 'selected' : '' }}" href="/kind/prijzen"><img src="{{ URL::asset('images/icons/trophy.svg') }}" alt="Boeken"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/scan') ? 'selected' : '' }}" href="/kind/scan"><img src="{{ URL::asset('images/icons/photo-camera.svg') }}" alt="Kinderen"></a>
                </li>
            </ul>
        </nav>
    </div>
    <div id="contentKids" class="content">
        @yield('dashboardcontent')
    </div>
@stop