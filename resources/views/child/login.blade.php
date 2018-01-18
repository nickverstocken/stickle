@extends('layout')

@section('content')
    <div id="childLoginWrap">
        <div class="" id="childLogin">
            <div class="heading">
                <h1>Wie gaat er inloggen?</h1>
            </div>

            <div id="children">
                @foreach ($parentKids as $child)
                    <div id="child{{$child->child_id}}" class="childrenWrap" onclick="selectChild('{{$child->child_id}}')">
                        <div class="image">
                            @if ($child->picturePath)
                                <img class="poster" src="{{ URL::asset( $child->picturePath ) }}" alt="profilePic">
                            @else
                                <img class="poster" src="{{ URL::asset('images/kids/defaultprofile-1.png') }}"
                                     alt="default profile picture">
                            @endif
                        </div>
                        <div class="childName">
                            <span>{{$child->firstName . ' ' . $child->lastName}}</span>
                        </div>
                    </div>
                @endforeach
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