@extends('dashboard_kids')

@section('dashboardcontent')
<div id="prices" class="cardGridWrap">
    <h1>Prijzen</h1>
    <div class="cardGrid">
        @foreach ($rewards as $reward)
        <div class="card">
            <div class="cardHeader">
                <h2 title="{{$reward->title}}">{{$reward->title}}</h2>
            </div>
            <div class="cardtumb">
                <div class="image">
                    @if($reward->kind == 'youtube')
                    <img class="poster" src="https://img.youtube.com/vi/{{explode("v=", $reward->link)[1]}}/0.jpg" alt="{{$reward->title}}">
                        @else
                        <img class="poster" src="{{$reward->picturePath}}" alt="{{$reward->title}}">
                    @endif
                </div>
            </div>
            <div class="cardAction">
                <button onclick="checkCanBuyPrice({{$child->child_id}}, {{$child->coins}},{{$reward->reward_id}}, {{$reward->price}})">Koop deze prijs<img src="{{ URL::asset('images/icons/coins.svg') }}" alt="Instellingen">{{$reward->price}}</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.modals.error')
@stop