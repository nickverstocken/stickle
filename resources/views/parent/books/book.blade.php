@extends('dashboard_parents')

@section('dashboardcontent')
    <div class="cardswrap">
        @foreach($booksOfUser as $book)
            <div class="card">
                <div class="cardHeader">
                    <div class="actions">
                        <button onclick="editBook({{ json_encode($book) }})"><img src="{{ URL::asset('images/icons/edit.svg') }}" alt="Edit"></button>
                    </div>
                    <h1>{{ $book->title }}</h1>
                </div>
                <div class="cardImage">
                    <div class="image">
                        @if ($book->coverPath)
                            <img class="poster" src="{{ URL::asset( $book->coverPath ) }}" alt="{{$book->title}}">
                        @else
                            <img class="poster" src="{{ URL::asset('images/books/nocover.png') }}"
                                 alt="{{$book->title}}">
                        @endif
                    </div>
                    <div class="page">
                    Aantal bladzijden:  {{ $book->numberOfPages }}
                    </div>
                </div>
                <div class="cardInfo">
                    <h2>Auteur</h2>
                    <input readonly value="{{ $book->author }}" />
                    <h2>Korte beschrijving</h2>
                    <textarea readonly>{{ $book->shortDescription }}</textarea>
                </div>
            </div>
        @endforeach
    </div>
    <div class="addButton">
        <a id="addBookBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.book')
    @include('layouts.modals.editBook')
@stop