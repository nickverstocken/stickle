@extends('layout')

@section('content')
    <div class="" id="childLogin">
        <div class="heading">
            <h1>Wie gaat er inloggen?</h1>
        </div>

        <div id="children">
            <div id="child1" class="childrenWrap" onclick="doSomethin('child1')">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Nick">
                </div>
                <div class="childName">
                    <span>Nick Verstocken</span>
                </div>
            </div>
            <div id="child2" class="childrenWrap" onclick="doSomethin('child2')">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/kids/eveline.jpg') }}" alt="Eveline">
                </div>
                <div class="childName">
                    <span>Eveline Verhoeven</span>
                </div>
            </div>

        </div>
        <div class="QRscan">
            <video id="preview"></video>
        </div>

    </div>
    <script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>

@stop