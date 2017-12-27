<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
class ChildController extends Controller
{
    public function index(){
        $parent = Auth::user();
        $parentKids = $parent->children;
       // dd($parentKids[0]);
        return view('child.login',[
            'parentKids' => $parentKids,
        ]);
    }
    public function scanStickerBook($stickerBookId, Request $request){
        return $stickerBookId;
    }
}
