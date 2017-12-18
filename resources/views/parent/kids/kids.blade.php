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

            </div>
        </div>

    </div>
    <div class="addButton">
        <a id="addBookBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.book')
@stop