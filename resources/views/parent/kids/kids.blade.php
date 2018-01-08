@extends('dashboard_parents')

@section('dashboardcontent')
    <div id="kids" class="cardswrap">
        @foreach($childrenOfParents as $child)
            <div class="card">
                <div class="cardHeader">
                    <h1>{{ $child->firstName }}</h1>
                </div>
                <div class="cardImage">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset( $child->picturePath ) }}" alt="Instellingen">
                    </div>
                </div>
                <div class="cardInfo">
                    <h2>Naam</h2>
                    <input value="{{ $child->firstName }} {{ $child->lastName }}" />
                </div>
            </div>
        @endforeach
    </div>
    <div class="addButton">
        <a id="addChildBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    <div class="addButton">
        <a id="cameraBtn" class="addBtn" href="/kind/login"> <img class="poster" src="{{ URL::asset('images/icons/photo-camera-1.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.newChild')
@stop