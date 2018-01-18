@extends('dashboard_kids')

@section('dashboardcontent')
<div class="cardGridWrap">
    <h1>Prijzen</h1>
    <div class="cardGrid">
        @foreach ($rewards as $reward)
        <div class="card">
            <div class="cardHeader">
                <h2 title="{{$reward->title}}">{{$reward->title}}</h2>
            </div>
            <div class="cardtumb">
                <div class="image">
                    <img class="poster" src="https://img.youtube.com/vi/{{explode("v=", $reward->link)[1]}}/0.jpg" alt="Instellingen">
                </div>
            </div>
            <div class="cardAction">
                <button>Koop deze prijs<img src="{{ URL::asset('images/icons/coins.svg') }}" alt="Instellingen">{{$reward->price}}</button>
            </div>
        </div>
        @endforeach
    </div>
</div>

@stop