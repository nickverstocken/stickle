@extends('layout')

@section('content')
<div id="navbar-leftfixed">
    <nav>
        <ul>
            <li>
                <a class="selected" href="/parent/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
            </li>
            <li>
                <a href="/parent/dashboard"><img src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Boeken"></a>
            </li>
            <li>
                <a href="/parent/dashboard"><img src="{{ URL::asset('images/icons/user-4.svg') }}" alt="Kinderen"></a>
            </li>
            <li>
                <a href="/parent/dashboard"><img src="{{ URL::asset('images/icons/settings.svg') }}" alt="Instellingen"></a>
            </li>
        </ul>
    </nav>
</div>
    <div id="content">
        @yield('dashboardcontent')
    </div>
@stop