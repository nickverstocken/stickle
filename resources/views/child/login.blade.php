@extends('layout')

@section('content')
    <div id="childLoginWrap">
        <div class="" id="childLogin">
            <div class="heading">
                <h1>Wie gaat er inloggen?</h1>
            </div>

            <div id="children">
                <div id="child1" class="childrenWrap" onclick="selectChild('child1')">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Nick">
                    </div>
                    <div class="childName">
                        <span>Nick Verstocken</span>
                    </div>
                </div>
                <div id="child2" class="childrenWrap" onclick="selectChild('child2')">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset('images/kids/eveline.jpg') }}" alt="Eveline">
                    </div>
                    <div class="childName">
                        <span>Eveline Verhoeven</span>
                    </div>
                </div>
                <div id="child3" class="childrenWrap" onclick="selectChild('child3')">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset('images/kids/eveline.jpg') }}" alt="Eveline">
                    </div>
                    <div class="childName">
                        <span>Nick Verhoeven</span>
                    </div>
                </div>
                <div id="child4" class="childrenWrap" onclick="selectChild('child4')">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset('images/kids/eveline.jpg') }}" alt="Eveline">
                    </div>
                    <div class="childName">
                        <span>Nick Haha</span>
                    </div>
                </div>
                <div class="QRscan">
                    <span></span>
                    <span></span>
                    <div class="previewWrap">
                        <video id="preview"></video>
                    </div>
                    <span></span>
                    <span></span>
                </div>
                <img class="animal-bg leeuw" src="{{ URL::asset('images/leeuw.svg') }}" alt="Olifant">
                <img class="animal-bg zebra" src="{{ URL::asset('images/zebra.svg') }}" alt="Olifant">
            </div>
        </div>
        <div onclick="backChildLogin()" class="backbtn">
            <a class="back"><img class="backimg" src="{{ URL::asset('images/icons/back.svg') }}" alt="Terug"></a>
        </div>
    </div>

    <script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>

@stop