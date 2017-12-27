@extends('layout')

@section('content')
    <div class="flex-center full-height main" id="login">
        <div class="mainwrap">
            <div class="intro">
                <h1>Registreer</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form">
                    <form id="frmRegister" method="POST" action="{{ route('register') }}" >
                        {{ csrf_field() }}
                        <input type="text" placeholder="Voornaam" name="firstname" required >
                        <input type="text" placeholder="Achternaam" name="lastname" required >
                        <input type="email" placeholder="Email" name="email" required >
                        <input type="password" placeholder="Wachtwoord" name="password">
                        <input type="password" placeholder="Bevestig wachtwoord" name="password_confirmation">
                    </form>

                </div>
                <div class="buttons">

                    <a href="/login" class="button">Log in</a>
                    <button type="submit" form="frmRegister" class="button orange">Registreer</button>
                </div>
                <img class="animal-bg hagedis" src="{{ URL::asset('images/hagedis.svg') }}" alt="Hagedis">

            </div>
            <div class="bg-animals">
                <img class="animal-bg olifant" src="{{ URL::asset('images/olifant.svg') }}" alt="Olifant">
                <img class="animal-bg krokodil" src="{{ URL::asset('images/krokodil.svg') }}" alt="Olifant">
                <img class="animal-bg giraf" src="{{ URL::asset('images/giraf.svg') }}" alt="Giraf">
            </div>
        </div>
    </div>
@stop