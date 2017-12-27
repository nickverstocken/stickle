<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use App\StickerBook;
class ChildController extends Controller
{
    public function index(Request $request){
        $parent = Auth::user();
        $parentKids = $parent->children;
        $request->session()->forget('childLoggedIn');
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
        if($child_id == $childIdSession){
            return view('child.home.home',[

            ]);
        }else{
            $parentKids = $parent->children;
            return view('child.login',[
                'parentKids' => $parentKids,
            ]);
        }
    }
}
