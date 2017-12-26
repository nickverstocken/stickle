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
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'child/dashboard') ? 'selected' : '' }}" href="/child/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'child/trophies') ? 'selected' : '' }}" href="/child/trophies"><img src="{{ URL::asset('images/icons/trophy.svg') }}" alt="Boeken"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'child/scan') ? 'selected' : '' }}" href="/child/scan"><img src="{{ URL::asset('images/icons/photo-camera.svg') }}" alt="Kinderen"></a>
                </li>
            </ul>
        </nav>
    </div>
    <div id="contentKids" class="content">
        @yield('dashboardcontent')
    </div>
@stop