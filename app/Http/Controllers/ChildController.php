<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class ChildController extends Controller
{
    public function index(){
        $parent = Auth::user()->toArray();
       // dd($parent->child);
    }
}
