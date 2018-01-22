@extends('dashboard_kids')

@section('dashboardcontent')
    <div id="profileDash" class="cardGridWrap">
        <div class="profileinfo">
            <div class="leftProfile">
                <div class="profileWrap">
                    @if ($child->picturePath)
                        <img class="profilepic" src="{{ URL::asset( $child->picturePath ) }}" alt="profilePic">
                    @else
                        <img class="profilepic" src="{{ URL::asset('images/kids/defaultprofile-1.png') }}"
                             alt="default profile picture">
                    @endif
                </div>
                <h1>{{ $child->firstName }} {{ $child->lastName }}</h1>
                <div class="helpDescription">
                    <p>
                        Hallo {{ $child->firstName }}!
                    </p>
                </div>
                <div class="statistics">
                    <div class="statisticItem">
                        <img class="statisticIcon" src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Instellingen">
                        <p>{{$booksRead}}</p>
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
                    @if ($currentBook)
                        @if ($currentBook->book->coverPath)
                            <img class="bookImage" src="{{ URL::asset( $currentBook->book->coverPath ) }}" alt="{{$currentBook->book->title }}">
                        @else
                            <img class="bookImage" src="{{ URL::asset('images/books/nocover.png') }}"
                                 alt="{{$currentBook->book->title}}">
                        @endif
                        <div class="progress-bar">
                            <div style="width:{{$currentBook->lastPageRead / $currentBook->book->numberOfPages * 100}}%" class="progress"></div>
                        </div>
                    @else
                        <img class="bookImage" src="{{ URL::asset('images/books/default.png') }}" alt="Book">
                    @endif
                </div>
            </div>
        </div>
        <div class="profileBookLog">
<h2>Jouw boeken</h2>
            <div id="childBooks" class="booklogCarousel scrollcontainer">
                @if ($child->toArray()['children_reading_book'] )
                    @foreach ($child->childrenReadingBook as $book)
                        {{--         <div>{{$book->toArray()['children_reading_book']['lastPageRead']}} / {{$book->numberOfPages}}</div>--}}
                        <div  class="bookitem {{$book->currentlyReading == 1 ? 'currentlyReading' : ''}} {{$book->isFinished == 1 ? 'finished' : ''}}">
                            @if ($book->book->coverPath)
                                <img onclick="window.location = '/kind/{{$child->child_id}}/boek/{{$book->childrenReadingBook_id}}/zetalshuidig'" class="bookImage" src="{{ URL::asset( $book->book->coverPath ) }}" alt="{{$book->book->title}}">
                            @else
                                <img onclick="window.location = '/kind/{{$child->child_id}}/boek/{{$book->childrenReadingBook_id}}/zetalshuidig'" class="bookImage" src="{{ URL::asset('images/books/nocover.png') }}"
                                     alt="{{$book->book->title}}">
                            @endif
                            <h3>{{$book->book->title}}</h3>
                            <div class="progress-bar">
                                <div style="width:{{$book->lastPageRead / $book->book->numberOfPages * 100}}%" class="progress"></div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <div class="profileBookLog">
            <h2>Jouw prijzen</h2>
            <div class="booklogCarousel">
                @if ($child->toArray()['child_rewards'] )
                    @foreach ($child->childRewards as $reward)
                        <div onclick="window.location = '/kind/{{$child->child_id}}/prijs/{{$reward->reward_id}}'" class="card">
                            <div class="cardHeader">
                                <h3 title="{{$reward->reward->title}}">{{$reward->reward->title}}</h3>
                            </div>
                            <div class="cardtumb">
                                <div class="image">
                                    @if($reward->reward->kind == 'youtube')
                                    <img class="poster" src="https://img.youtube.com/vi/{{explode("v=", $reward->reward->link)[1]}}/0.jpg"alt="{{$reward->reward->title}}">
                                    @else
                                        <img class="poster" src="{{$reward->reward->picturePath}}" alt="{{$reward->reward->title}}">
                                    @endif
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div style="width:{{($reward->updated_at->diffInSeconds(\Carbon\Carbon::now())) / 172800 * 100 }}%" class="progress"></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @include('layouts.modals.error')
    <script src="{{ URL::asset('js/instascan/instascan.min.js') }}" type="text/javascript"></script>
@stop