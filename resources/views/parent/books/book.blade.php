@extends('dashboard_parents')

@section('dashboardcontent')
    <div class="cardswrap">
<div class="card">
    <div class="cardHeader">
        <h1>Polly paints a penis</h1>
    </div>
    <div class="cardImage">
        <div class="image">
        <img class="poster" src="{{ URL::asset('images/books/polly.jpg') }}" alt="Instellingen">
            <div class="progress-bar">
                <div style="width:60%" class="progress"></div>
            </div>
        </div>
        <div class="page">
           Pagina:  7/20
        </div>
    </div>
    <div class="cardInfo">
        <h2>Auteur</h2>
        <input value="Ernest Hamminway" />
        <h2>Korte beschrijving</h2>
        <textarea>Ernest Hamminway</textarea>
    </div>
</div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
        <div class="card">
            <div class="cardHeader">
                <h1>The old man and the sea</h1>
            </div>
            <div class="cardImage">
                <div class="image">
                    <img class="poster" src="{{ URL::asset('images/books/oldmanandthesea.jpg') }}" alt="Instellingen">
                    <div class="progress-bar">
                        <div style="width:10%" class="progress"></div>
                    </div>
                </div>
                <div class="page">
                    Pagina:  7/20
                </div>
            </div>
            <div class="cardInfo">
                <h2>Auteur</h2>
                <input value="Ernest Hamminway" />
                <h2>Korte beschrijving</h2>
                <textarea>Ernest Hamminway</textarea>
            </div>
        </div>
    </div>
    <div class="addButton">
        <a id="addBookBtn" class="addBtn"> <img class="poster" src="{{ URL::asset('images/icons/add.svg') }}" alt="Instellingen"></a>
    </div>
    @include('layouts.modals.book')
@stop