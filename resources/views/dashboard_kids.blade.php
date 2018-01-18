@extends('layout')

@section('content')
    <div class="navbar-leftfixed" id="kidsnav">
        <nav>
            <ul>
                <li>
                    <a href="/child/dashboard"><img src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Home"></a>
                    <div class="coins"> <img class="coinsImg" src="{{ URL::asset('images/icons/coins.svg') }}" alt="Coins">{{$child->coins}}</div>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/' . $child->child_id .'/dashboard') ? 'selected' : '' }}" href="/kind/{{$child->child_id}}/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/' . $child->child_id .'/prijzen') ? 'selected' : '' }}" href="/kind/{{$child->child_id}}/prijzen"><img src="{{ URL::asset('images/icons/trophy.svg') }}" alt="Boeken"></a>
                </li>
                <li>
                    <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'kind/' . $child->child_id .'/scan') ? 'selected' : '' }}" href="/kind/{{$child->child_id}}/scan"><img src="{{ URL::asset('images/icons/photo-camera.svg') }}" alt="Kinderen"></a>
                </li>
            </ul>
        </nav>
    </div>

    <div id="contentKids" class="content">
        <example-component></example-component>
        @yield('dashboardcontent')
    </div>
@stop