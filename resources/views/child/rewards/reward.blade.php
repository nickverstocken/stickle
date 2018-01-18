@extends('dashboard_kids')

@section('dashboardcontent')
    <div class="cardGridWrap">
        <div class="noFlexCard">
            <h1>{{$reward->title}}</h1>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{explode("v=", $reward->link)[1]}}?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    </div>

@stop