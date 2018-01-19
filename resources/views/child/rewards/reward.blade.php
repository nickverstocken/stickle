@extends('dashboard_kids')

@section('dashboardcontent')
    <div id="reward" class="cardGridWrap">
        <div class="card">
            <h1>{{$reward->title}}</h1>
            <div class="iframe">
                <iframe src="https://www.youtube.com/embed/{{explode("v=", $reward->link)[1]}}?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>

@stop