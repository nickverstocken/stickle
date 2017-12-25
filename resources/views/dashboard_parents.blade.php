@extends('layout')

@section('content')
<div class="navbar-leftfixed">
    <nav>
        <ul>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'parent/dashboard') ? 'selected' : '' }}" href="/parent/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
            </li>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'parent/books') ? 'selected' : '' }}" href="/parent/books"><img src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Boeken"></a>
            </li>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'parent/kids') ? 'selected' : '' }}" href="/parent/kids"><img src="{{ URL::asset('images/icons/user-4.svg') }}" alt="Kinderen"></a>
            </li>
            <li>
                <a class="{{ (\Request::route()->getName() == 'this.route') ? 'active' : '' }}" href="/parent/dashboard"><img src="{{ URL::asset('images/icons/settings.svg') }}" alt="Instellingen"></a>
            </li>
        </ul>
    </nav>
</div>
    <div id="contentParents" class="content">
        @yield('dashboardcontent')
    </div>
@stop