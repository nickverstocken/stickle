
@extends('layout')

@section('content')
    <div class="flex-center full-height main" id="start">
        <div class="mainwrap">
            <div class="intro">
                <h1>Stickle</h1>
                <p>Lees. Ontdek. Speel!</p>
                <div class="buttons">
                    <a href="/registreer" class="button orange">Begin nu</a>
                    <a href="/login" class="button white">Log in</a>
                </div>
                <img class="animal-bg hagedis" src="{{ URL::asset('images/hagedis.svg') }}" alt="Hagedis">
            </div>
            <div class="bg-animals">
                <img class="animal-bg olifant" src="{{ URL::asset('images/olifant.svg') }}" alt="Olifant">
                <img class="animal-bg krokodil" src="{{ URL::asset('images/krokodil.svg') }}" alt="Olifant">
                <img class="animal-bg giraf" src="{{ URL::asset('images/giraf.svg') }}" alt="Giraf">
            </div>
        </div>
    </div>

@stop
