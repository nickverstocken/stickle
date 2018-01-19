<?php

namespace App\Http\Controllers;

use App\ChildrenReadingBook;
use App\ChildrenReward;
use App\Reward;
use Illuminate\Http\Request;
use Auth;
use Mockery\Exception;
use Response;
use App\StickerBook;
use App\Child;
use DB;
use Illuminate\Support\Carbon;
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
        $child = Child::where('child_id', $childIdSession)->with(['childrenReadingBook' => function($q) {
            $q->orderBy('currentlyReading', 'desc');
            $q->with(['Book'])->get();
        }, 'childRewards' => function($q) {
            $q->with('reward');
            $q->where('updated_at', '>=', Carbon::now()->subDays(2));
        }])->first();
       // dd($child->toArray());
       $currentBook = ChildrenReadingBook::where('child_id', $child_id)->where('currentlyReading', 1)->with('Book')->first();
      // dd($currentBook->currentlyReading);
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
        $rewards = Reward::all();
        if($child_id == $childIdSession){
            return view('child.trophies.trophies',[
                'child' => $child,
                'parent' => $parent,
                'rewards' => $rewards
            ]);
        }else{
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
            return redirect('/kind/login');
        }
    }
    public function scanReward(Request $request, $stickerBookId, $rewardId){
        $child_id = $request->get('childId');
        $stickerBook = StickerBook::find($stickerBookId);
        if(($stickerBook->child_id != $child_id)){
            return response::json([
                    'success' => false,
                    'error' => 'Deze sticker hoort bij een ander stickerboek'
                ]
                , 200
            );
        }
        $stickers = $stickerBook->stickers->where('sticker_id', $rewardId);
        if($stickers->count() <= 0){
            return response::json([
                    'success' => false,
                    'error' => 'Deze sticker bestaat niet'
                ]
                , 200
            );
        }
        $stickers = $stickers->where('isAlreadyScanned', 0)->first();
        if(!$stickers){
            return response::json([
                    'success' => false,
                    'error' => 'Deze sticker is niet meer geldig'
                ]
                , 200
            );
        }
        $child = Child::find($child_id);
        $child->coins += 1;
        $child->rewardPoints +=1;
        $stickers->isAlreadyScanned = 1;
        try{
            DB::beginTransaction();
            $child->save();
            $stickers->save();
            DB::commit();
            return response::json([
                    'success' => true,
                    'url' => '/kind/' . $child_id . '/dashboard'
                ]
                , 200
            );
        }catch(Exception $e){
            DB::rollBack();
            return response::json([
                    'success' => false,
                    'error' => 'Er ging iets mis probeer het later opnieuw'
                ]
                , 200
            );
        }
    }
    public function buyPrice(Request $request){
        $parent = Auth::user();
        $child_id = $request->get('childId');
        $reward_id = $request->get('rewardId');
        $price = $request->get('rewardPrice');
        $child = Child::find($child_id);
        $childrenReward = ChildrenReward::where('child_id', $child_id)->where('reward_id', $reward_id)->first();
        if($childrenReward){
            $now = Carbon::now();
            $daysOld = $childrenReward->updated_at->diffInDays($now);
            if($childrenReward->rewardIsBought == 1 && $daysOld <= 2){
                return response::json([
                        'success' => true,
                        'url' => '/kind/' . $child_id . '/prijs/' . $reward_id
                    ]
                    , 200
                );
            }else{
                if($price > $child->coins){
                    return response::json([
                            'success' => false,
                            'error' => 'Je hebt niet genoeg muntjes om deze prijs te kopen...'
                        ]
                        , 200
                    );
                }
                $childrenReward->touch();
            }
        }else{
            if($price > $child->coins){
                return response::json([
                        'success' => false,
                        'error' => 'Je hebt niet genoeg muntjes om deze prijs te kopen...'
                    ]
                    , 200
                );
            }
            $childrenReward = new ChildrenReward;
            $childrenReward->child_id = $child_id;
            $childrenReward->reward_id = $reward_id;
            $childrenReward->rewardIsBought = true;
            $childrenReward->save();
        }
        $child->coins -= $price;
        $child->save();
        return response::json([
                'success' => true,
                'url' => '/kind/' . $child_id . '/prijs/' . $reward_id
            ]
            , 200
        );
    }
    public function viewPrice($childId, $priceId){
        $child = Child::find($childId);
        $parent = Auth::user();
        $price = ChildrenReward::where('child_id', $childId)->where('reward_id', $priceId)->with('Reward')->first();
        if(!$price){
            return redirect('/kind/' . session('childLoggedIn') . '/dashboard');
        }
        if($price->child_id != session('childLoggedIn')){
            return redirect('/kind/' . session('childLoggedIn') . '/dashboard');
        }
        $now = Carbon::now();
        $daysOld = $price->updated_at->diffInDays($now);
        if($daysOld > 2){
            return redirect('/kind/' . session('childLoggedIn') . '/dashboard');
        }
        return view('child.rewards.reward', [
            'child' => $child,
            'parent' => $parent,
            'reward' => $price->reward
        ]);
    }
}
