@extends('dashboard_kids')

@section('dashboardcontent')
    <div id="profileDash" class="cardGridWrap">
        <div class="profileinfo">
            <div class="leftProfile">
                <div class="profileWrap">
                    <img class="profilepic" src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Instellingen">
                </div>
                <h1>Nick Verstocken</h1>
                <div class="helpDescription">
                    <p>
                        Welkom terug Nick!
                    </p>
                </div>
                <div class="statistics">
                    <div class="statisticItem">
                        <img class="statisticIcon" src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Instellingen">
                        <p>8</p>
                        <p>Boeken gelezen</p>
                    </div>
                    <div class="statisticItem">
                        <img class="statisticIcon" src="{{ URL::asset('images/icons/trophy.svg') }}" alt="Instellingen">
                        <p>150</p>
                        <p>Beloningen gekregen</p>
                    </div>
                    <div class="statisticItem">
                        <img class="statisticIcon" src="{{ URL::asset('images/icons/coins.svg') }}" alt="Instellingen">
                        <p>250</p>
                        <p>Muntjes</p>
                    </div>
                </div>
            </div>
            <div class="rightProfile">
                <h2>Huidig boek</h2>
                <div class="bookProfile">
                    <img class="bookImage" src="{{ URL::asset('images/books/polly.jpg') }}" alt="Book">
                </div>
            </div>
        </div>
        <div class="profileBookLog">
<h2>Gelezen boeken</h2>
            <div class="booklogCarousel">
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/polly.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
                <div class="bookitem">
                    <img class="bookImage" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Book">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>
@stop