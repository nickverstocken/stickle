@extends('dashboard_parents')

@section('dashboardcontent')
    <div id="kids" class="cardswrap">
        <div class="card">
            <div class="cardHeader">
                <h1>Nick</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Instellingen">
                </div>
            </div>
            <div class="cardInfo">
                <h2>Naam</h2>
                <input value="Nick Verstocken" />
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>Eveline</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/kids/eveline.jpg') }}" alt="Instellingen">
                </div>
            </div>
            <div class="cardInfo">
                <h2>Naam</h2>
                <input value="Eveline Verhoeven" />
            </div>
        </div>

    </div>
    <div class="addButton">
        <a id="addChildBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    <div class="addButton">
        <a id="cameraBtn" class="addBtn" href="/child/login"> <img class="poster" src="{{ URL::asset('images/icons/photo-camera-1.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.newChild')
@stop