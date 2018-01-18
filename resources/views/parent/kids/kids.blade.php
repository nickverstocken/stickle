@extends('dashboard_parents')

@section('dashboardcontent')
    <div id="kids" class="cardswrap">
        @foreach($childrenOfParents as $child)
            <div class="card">
                <div class="cardHeader">
                    <div class="actions">
                        <button onclick="editChild({{ json_encode($child) }})"><img src="{{ URL::asset('images/icons/edit.svg') }}" alt="Edit"></button>
                    </div>
                    <h1>{{ $child->firstName }}</h1>
                </div>
                <div class="cardImage {{$child->logged_in ? 'online' : ''}} ">
                    <div class="image">
                        <img class="poster" src="{{ URL::asset( $child->picturePath ) }}" alt="Instellingen">
                    </div>
                </div>
                <div class="cardInfo">
                    <h2>Naam</h2>
                    <input value="{{ $child->firstName }} {{ $child->lastName }}" readonly/>
                    <h2>Boeken</h2>
                    <div class="searchBooks">
                        <input placeholder="Zoek Boeken die dit kind kan/mag lezen..." onkeyup="searchBooks(event, {{$child->child_id}})"/>
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
                                <div class="bookitem {{$book->currentlyReading == 1 ? 'currentlyReading' : ''}}">
                                    <img class="bookImage" src="{{ URL::asset( $book->book->coverPath ) }}" alt="Book">

                                    <div class="progress-bar">
                                        <div style="width:{{$book->lastPageRead / $book->book->numberOfPages * 100}}%" class="progress"></div>
                                    </div>
                                </div>
                        @endforeach
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <div class="addButton">
        <a id="addChildBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    <div class="addButton">
        <a id="cameraBtn" class="addBtn" href="/kind/login"> <img class="poster" src="{{ URL::asset('images/icons/photo-camera-1.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.newChild')
    @include('layouts.modals.editChild')
@stop