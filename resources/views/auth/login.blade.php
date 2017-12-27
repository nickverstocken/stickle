@extends('layout')

@section('content')
    <div class="flex-center full-height main" id="login">
        <div class="mainwrap">
            <div class="intro">
                <h1>Login</h1>
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
                    <form id="frmLogin" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <input type="email" placeholder="Email" name="email" required >
                        <input type="password" placeholder="Wachtwoords" name="password" required autocomplete="off">
                    </form>

                </div>
                <div class="buttons">
                    <a href="/registreer" class="button white">Registreer</a>
                    <button type="submit" form="frmLogin" class="button orange">Log in</button>
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