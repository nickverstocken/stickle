@extends('layout')

@section('content')
    <div class="flex-center full-height main" id="login">
        <div class="mainwrap">
            <div class="intro">
                <h1>Registreer</h1>
                @if ($errors->any())
                            <script>
                                require('app.js');
                                showError('Registreer fout', 'Fouten tijdens registreren');
                            </script>
                        {{--    @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach--}}
                @endif
                <div class="form">
                    <p id="registerError"></p>
                    <form id="frmRegister" method="POST" action="{{ route('register') }}" >
                        {{ csrf_field() }}
                        <input type="text" id="firstname" placeholder="Voornaam" name="firstname" value="{{old('firstname')}}" required  >
                        <input type="text" id="lastname" placeholder="Achternaam" name="lastname" value="{{old('lastname')}}" required >
                        <input type="email" id="email" placeholder="Email" name="email" value="{{old('email')}}" required >
                        <input type="password" id="password" placeholder="Wachtwoord" name="password">
                        <input type="password" id="password_comfirmation" placeholder="Bevestig wachtwoord" name="password_confirmation">
                        <input type="hidden" id="pincode" name="pincode" value="" id="pincode">
                    </form>

                </div>
                <div class="buttons">

                    <a href="/login" class="button">Log in</a>
                    <!--<button  type="submit" form="frmRegister" class="button orange">Registreer</button>-->
                    <button onclick="showRegisterKeyPad()" class="button orange">Registreer</button>
                </div>
                <img class="animal-bg hagedis" src="{{ URL::asset('images/hagedis.svg') }}" alt="Hagedis">

            </div>
            <div class="bg-animals">
                <img class="animal-bg olifant" src="{{ URL::asset('images/olifant.svg') }}" alt="Olifant">
                <img class="animal-bg krokodil" src="{{ URL::asset('images/krokodil.svg') }}" alt="Olifant">
                <img class="animal-bg giraf" src="{{ URL::asset('images/giraf.svg') }}" alt="Giraf">
            </div>
        </div>
        <div id="keycode">
            @include('auth.pincodeRegister')
        </div>
    </div>

@stop