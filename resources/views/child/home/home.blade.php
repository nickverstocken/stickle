@extends('dashboard_kids')

@section('dashboardcontent')
    <div id="profileDash" class="cardGridWrap">
        <div class="profileinfo">
            <div class="leftProfile">
                <div class="profileWrap">
                    <img class="profilepic" src="{{ URL::asset('images/kids/nick.jpg') }}" alt="Instellingen">
                </div>
                <h1>{{ $child->firstName }} {{ $child->lastName }}</h1>
                <div class="helpDescription">
                    <p>
                        Welkom terug {{ $child->firstName }}!
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
                        <p>{{$child->rewardPoints}}</p>
                        <p>Beloningen gekregen</p>
                    </div>
                    <div class="statisticItem">
                        <img class="statisticIcon" src="{{ URL::asset('images/icons/coins.svg') }}" alt="Instellingen">
                        <p>{{$child->coins}}</p>
                        <p>Muntjes</p>
                    </div>
                </div>
            </div>
            <div class="rightProfile">
                <h2>Huidig boek</h2>
                <div class="bookProfile">
                    @if (count($currentBook) === 1)
                    <img class="bookImage" src="{{ URL::asset('images/books/polly.jpg') }}" alt="Book">
                    @else
                        <img class="bookImage" src="{{ URL::asset('images/books/default.png') }}" alt="Book">
                    @endif
                </div>
            </div>
        </div>
        <div class="profileBookLog">
<h2>Jouw boeken</h2>
            <div class="booklogCarousel">
                @if ($child->toArray()['children_reading_book'] )
                    @foreach ($child->toArray()['children_reading_book'] as $book)
                        {{--         <div>{{$book->toArray()['children_reading_book']['lastPageRead']}} / {{$book->numberOfPages}}</div>--}}
                        <div class="bookitem {{$book['currentlyReading'] == 1 ? 'currentlyReading' : ''}}">
                            <img class="bookImage" src="{{ URL::asset( $book['book']['coverPath'] ) }}" alt="Book">

                            <div class="progress-bar">
                                <div style="width:{{$book['lastPageRead'] / $book['book']['numberOfPages'] * 100}}%" class="progress"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>
@stop