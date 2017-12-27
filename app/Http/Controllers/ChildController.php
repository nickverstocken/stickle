<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class ChildController extends Controller
{
    public function index(){
        if (!Auth::check()){
            return view('login');
        }
        $parent = Auth::user()->toArray();
        dd($parent);
    }
}
