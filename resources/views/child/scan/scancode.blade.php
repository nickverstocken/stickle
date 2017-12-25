@extends('dashboard_kids')

@section('dashboardcontent')
<div class="cardGridWrap">
    <h1>Scan beloning!</h1>
    <div class="helpDescription">
        <p>
            Heb je een beloning gekregen? Goed zo! Je kan deze nu inscanner door op de knop : 'Scan nu' te klikken. Vervolgens krijg je direct je beloning en kan
            je kijken welke prijzen je kan kopen! En vooral hoe meer je leest hoe meer je kan scannen joepie!
        </p>
        <button onclick="loadscanner()" class="button">Scan nu</button>
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
</div>
<script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>
    @stop