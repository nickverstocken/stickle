@extends('layout')

@section('content')
<div class="navbar-leftfixed">
    <nav>
        <ul>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'ouders/kinderen') ? 'selected' : '' }}" href="/ouders/kinderen"><img src="{{ URL::asset('images/icons/user-4.svg') }}" alt="Kinderen"></a>
            </li>
            <li>
                <a class="{{ (Route::getFacadeRoot()->current()->uri() == 'ouders/boeken') ? 'selected' : '' }}" href="/ouders/boeken"><img src="{{ URL::asset('images/icons/agenda.svg') }}" alt="Boeken"></a>
            </li>
            
            <li>
                <a id="parentSettingBtn" class="" onclick="openParentSettings()"><img src="{{ URL::asset('images/icons/settings-8.svg') }}" alt="Kinderen"></a>
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
    <div id="keycode">
        @include('parent.pincode.editPincode')
    </div>
    @include('layouts.modals.editParent')
@stop
