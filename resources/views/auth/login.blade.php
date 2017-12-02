@extends('layout')

@section('content')
    <div class="flex-center full-height main" id="login">
        <div class="intro">
            <h1>Login</h1>
            <div class="form">
                <input  />
            </div>
            <div class="buttons">
                <button class="button orange">Begin nu</button><button class="button white">Log in</button>
            </div>
            <img class="animal-bg hagedis" src="{{ URL::asset('images/hagedis.svg') }}" alt="Hagedis">
        </div>
        <img class="animal-bg olifant" src="{{ URL::asset('images/olifant.svg') }}" alt="Olifant">
        <img class="animal-bg krokodil" src="{{ URL::asset('images/krokodil.svg') }}" alt="Olifant">
        <img class="animal-bg giraf" src="{{ URL::asset('images/giraf.svg') }}" alt="Giraf">
    </div>

@stop