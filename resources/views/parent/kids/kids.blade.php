@extends('dashboard_parents')

@section('dashboardcontent')
    <div id="kids" class="cardswrap scrollcontainer">
        @foreach($childrenOfParents as $child)
            <div class="card">
                <div class="cardHeader">
                    <div class="actions">
                        <button onclick="editChild({{ json_encode($child) }})"><img
                                    src="{{ URL::asset('images/icons/edit.svg') }}" alt="Edit"></button>
                    </div>
                    <h1>{{ $child->firstName }}</h1>
                </div>
                <div class="cardImage {{$child->logged_in ? 'online' : ''}} ">
                    <div class="image">
                        @if ($child->picturePath)
                            <img class="poster" src="{{ URL::asset( $child->picturePath ) }}" alt="profilePic">
                        @else
                            <img class="poster" src="{{ URL::asset('images/kids/defaultprofile-1.png') }}"
                                 alt="default profile picture">
                        @endif
                    </div>
                </div>
                <div class="cardInfo">
                    <h2>Naam</h2>
                    <input value="{{ $child->firstName }} {{ $child->lastName }}" readonly/>
                    <h2>Boeken</h2>
                    <div class="searchBooks">
                        <input placeholder="Zoek een boek dat je kind mag lezen"
                               onkeyup="searchBooks(event, {{$child->child_id}})"/>
                        <ul id="bookSearch{{$child->child_id}}" class="searchResults">

                        </ul>
                    </div>
                    {{--        "children_reading_book" => array:7 [▼
          "childrenReadingBook_id" => 1
          "child_id" => 1
          "readingBook_id" => 1
          "currentlyReading" => 0
          "lastPageRead" => 0
          "created_at" => null
          "updated_at" => null--}}
                    <div id="childBooksReading" class="booklogCarousel">
                        @if ($child->childrenReadingBook )
                            @foreach ($child->childrenReadingBook as $book)
                                <div class="bookitem {{$book->currentlyReading == 1 ? 'currentlyReading' : ''}} {{$book->isFinished == 1 ? 'finished' : ''}}">
                                    <button type="button" alt="delete" onclick="removeBookLink(event, {{$book->childrenReadingBook_id}})"><img src="{{URL::asset('images/icons/error.svg')}}"> </button>
                                    @if ($book->book->coverPath)
                                        <img onclick="openLastPageRead({{$book}}, '{{$child->firstName}}')" class="bookImage" src="{{ URL::asset( $book->book->coverPath ) }}" alt="{{$book->book->title}}">
                                    @else
                                        <img onclick="openLastPageRead({{$book}}, '{{$child->firstName}}')" class="bookImage" src="{{ URL::asset('images/books/nocover.png') }}"
                                             alt="{{$book->book->title}}">
                                    @endif
                                    <div class="progress-bar">
                                        <div style="width:{{$book->lastPageRead / $book->book->numberOfPages * 100}}%"
                                             class="progress"></div>
                                    </div>
                                    <div class="bookTitle">
                                        <h3>{{$book->book->title}}</h3>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
            <div class="arrow prev">
                <img src="{{ URL::asset('images/icons/back.svg') }}" alt="scroll backward">
            </div>
            <div class="arrow next">
                <img src="{{ URL::asset('images/icons/next.svg') }}" alt="scroll forward">
            </div>
    </div>
    <div class="addButton">
        <a id="addChildBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}"
                                                 alt="Instellingen"></a>
    </div>
    <div class="addButton">
        <a id="cameraBtn" class="addBtn" href="/kind/login"> <img class="poster"
                                                                  src="{{ URL::asset('images/icons/photo-camera-1.svg') }}"
                                                                  alt="Instellingen"></a>
    </div>
    @include('layouts.modals.error')
    @include('layouts.modals.newChild')
    @include('layouts.modals.editChild')
    @include('layouts.modals.openBook')
    @include('layouts.modals.lastPageRead')
@stop