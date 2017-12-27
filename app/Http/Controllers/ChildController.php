<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Response;
use App\StickerBook;
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
        $stickerBook = StickerBook::find($stickerBookId);
        if(!$stickerBook){
            return 'sticker boek bestaat niet';
        }
        if(!$stickerBook->child){
            $stickerBook->child_id = $request->get('childId');
            $stickerbook = $stickerBook->save();
            return redirect('/child/' . $stickerBook->child->child_id . '/dashboard');
        }else{
            if($stickerBook->child_id == $request->get('childId')){
                return redirect('/child/' . $stickerBook->child->child_id . '/dashboard');
            }
        }
    }
}
