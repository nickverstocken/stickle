<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParrentController extends Controller
{
    public function openAddANewChild()
    {
        return view('addANewChild');
    }
}
