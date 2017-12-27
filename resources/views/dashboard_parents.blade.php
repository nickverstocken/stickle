@extends('layout')

@section('content')
<div class="navbar-leftfixed">
    <nav>
        <ul>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'ouders/dashboard') ? 'selected' : '' }}" href="/ouders/dashboard"><img src="{{ URL::asset('images/icons/home-1.svg') }}" alt="Home"></a>
            </li>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'ouders/boeken') ? 'selected' : '' }}" href="/ouders/boeken"><img src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Boeken"></a>
            </li>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'ouders/kinderen') ? 'selected' : '' }}" href="/ouders/kinderen"><img src="{{ URL::asset('images/icons/user-4.svg') }}" alt="Kinderen"></a>
            </li>
            <li>
                <a class="{{ (\Request::route()->getName() == 'this.route') ? 'active' : '' }}" href="/logout"><img src="{{ URL::asset('images/icons/exit-2.svg') }}" alt="Logout"></a>
            </li>
        </ul>
    </nav>
</div>
    <div id="contentParents" class="content">
        @yield('dashboardcontent')
    </div>
@stop