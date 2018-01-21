<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            return redirect('/ouders/kinderen');
        }else{
            return view('home');
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');        
    }
}
