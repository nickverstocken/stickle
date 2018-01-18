<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use App\StickerBook;
use App\Child;
class ChildController extends Controller
{
    public function index(Request $request){
        $parent = Auth::user();
        $parentKids = $parent->children;
            return view('child.login',[
                'parentKids' => $parentKids,
            ]);

    }
    public function scanStickerBook($stickerBookId, Request $request){
        $stickerBook = StickerBook::find($stickerBookId);
        if(!$stickerBook){
            return response::json([
                    'success' => false,
                    'error' => 'Dit stickerboek bestaat niet'
                ]
                , 200
            );
        }
        if(!$stickerBook->child){
            $stickerBook->child_id = $request->get('childId');
            $stickerBook->save();
            session(['childLoggedIn' => $stickerBook->child_id]);
            return response::json([
                    'success' => true,
                    'url' => '/kind/' . $stickerBook->child_id . '/dashboard'
                ]
                , 200
            );
        }else{
            if($stickerBook->child_id == $request->get('childId')){
                session(['childLoggedIn' => $stickerBook->child_id]);
                return response::json([
                    'success' => true,
                   'url' => '/kind/' . $stickerBook->child_id . '/dashboard'
                    ]
                    , 200
                );
            }else{
                return response::json([
                        'success' => false,
                        'error' => 'Dit stickerboek hoort niet bij jou'
                    ]
                    , 200
                );
            }
        }
    }
    public function getDashBoard($child_id){

        $parent = Auth::user();
        $childIdSession = session('childLoggedIn');
        $child = Child::where('child_id', $childIdSession)->first();
        $child = Child::where('child_id', $childIdSession)->with(['childrenReadingBook' => function($q) {
            $q->with(['Book'])->get();
        }])->first();
       $currentBook = $child->currentBook->first();
       //dd($currentBook->childrenReadingBook->first()->toArray());
        if($child_id == $childIdSession){
            return view('child.home.home',[
                'child' => $child,
                'currentBook' => $currentBook,
                'parent' => $parent
            ]);
        }else{
           // $parentKids = $parent->children;
            return redirect('/kind/login');
        }
    }
    public function getPrices($child_id){
        $parent = Auth::user();
        $childIdSession = session('childLoggedIn');
        $child = Child::find($childIdSession);
        if($child_id == $childIdSession){
            return view('child.trophies.trophies',[
                'child' => $child,
                'parent' => $parent
            ]);
        }else{
            // $parentKids = $parent->children;
            return redirect('/kind/login');
        }
    }
    public function getScan($child_id){
        $parent = Auth::user();
        $childIdSession = session('childLoggedIn');
        $child = Child::find($childIdSession);
        if($child_id == $childIdSession){
            return view('child.scan.scancode',[
                'child' => $child,
                'parent' => $parent
            ]);
        }else{
            // $parentKids = $parent->children;
            return redirect('/kind/login');
        }
    }
}
