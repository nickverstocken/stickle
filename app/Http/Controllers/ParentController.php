<?php

namespace App\Http\Controllers;

use App\ChildrenReadingBook;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Child;
use App\User;
use Validator;
use Auth;
use Redirect;
use Carbon\Carbon;
use Response;

class ParentController extends Controller
{
    public function editAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
            'password' => 'nullable|min:6|confirmed'
        ]);

        if ($validator->passes()) {            
            Auth::user()->firstName = $request->firstname;
            Auth::user()->lastName = $request->lastname;
            Auth::user()->email = $request->email;
            Auth::user()->password = bcrypt($request->password);
            Auth::user()->save();

            return redirect('/');
        }
        return Redirect::back()->withErrors($validator);

    }

    public function editPincode(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric'
        ]);
        if($validator->passes()){
            $enteredCode = $request->get('code');
            Auth::user()->parentPincode = $enteredCode;
            Auth::user()->save();
            return response::json([
                    'success' => true,
                ]
                , 200
            );
        }
        $errors = $validation->errors();
        $errors =  json_decode($errors); 

        return response()->json([
            'success' => false,
            'message' => $errors
        ], 422);
          
        

    }

    public function deleteAccount(){

        Auth::user()->delete();
        return redirect('/');
    }

    public function showAllChildrenFromParent(){
        $child = new Child;
        $childrenOfParents = $child->getChildWithParentId(Auth::id());
        $children = Child::where('parent_id', Auth::id())->with(['childrenReadingBook' => function($q) {
            $q->orderBy('currentlyReading', 'desc');
            $q->with('Book');
        }])->get();
     //   dd($children->toArray());
       //dd($children[0]->toArray()['children_reading_book']);
        return view('parent.kids.kids',[
            'childrenOfParents' => $children,
        ]); 
    }

    //temporary function
    public function openNewChild()
    {
        return view('newChild');
    }

    //function to add a new Child for the parent logged in
    public function addNewChild(Request $request){
    	$validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dateOfBirth' => 'required|date|before:'.Carbon::now(),
            'picture' => 'image'
        ]);

        if ($validator->passes()) {

        	$child = new Child;
        	$child->firstName = $request->firstName;
        	$child->lastName = $request->lastName;
        	$child->dateOfBirth = $request->dateOfBirth;
        	$child->picturePath = null;
        	$child->rewardPoints = 0;
        	$child->parent_id = Auth::id();
            $child->save();
            $child_id = $child->child_id;
            
            $file = $request->picture;

            if($file){
                $img = Image::make($file);
                $img = $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $extension = pathinfo(storage_path().$file->getClientOriginalName(), PATHINFO_EXTENSION);
                $img = $img->stream();               
                $filename = 'kids/' . $child_id . '.' .$extension;
                Storage::disk('local')->put($filename, $img);
                $child->picturePath =  Storage::url($filename);
                $child->save();
            }

        	return redirect('/ouders/kinderen');

        } else{

        	return Redirect::back()->withErrors($validator);
        }
    }

    public function openEditChild($child_id)    
    {
        if ($this->isChildFromParent($child_id)){
            $child = Child::find($child_id);
            return view('editChild',[
                'child' => $child
                ]);
        }
        return redirect('/');
    }

    public function editChild($child_id, Request $request){
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'dateOfBirth' => 'required|date|before:'.Carbon::now(),
            'picture' => 'image'
        ]);

        if ($validator->passes()) {

            $child = Child::find($child_id);
            $child->firstName = $request->firstName;
            $child->lastName = $request->lastName;
            $child->dateOfBirth = $request->dateOfBirth;
            $child->save();

            $file = $request->picture;

            if($file){
                $img = Image::make($file);
                $img = $img->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $extension = pathinfo(storage_path().$file->getClientOriginalName(), PATHINFO_EXTENSION);
                $img = $img->stream();               
                $filename = 'kids/' . $child_id . '.' .$extension;
                Storage::disk('local')->put($filename, $img);
                $child->picturePath =  Storage::url($filename);
                $child->save();
            }

            return redirect('/ouders/kinderen');
        }
        return Redirect::back()->withErrors($validator);

    }

    public function deleteChild($child_id){
        //Check if the child is actualy from the logged in parent
        if ($this->isChildFromParent($child_id)){
            $child = Child::find($child_id);    
            $child->delete();
        }
        return redirect('/ouders/kinderen');
    }

    //function to check if the child is from the logged in parant
    public function isChildFromParent($child_id){

        $child = new Child;
        $childrenOfParents = $child->getChildWithParentId(Auth::id());

        foreach ($childrenOfParents as $key => $child) {
            if($child->child_id == $child_id){
                return True;
            }
        }

        return False;
    }
}
