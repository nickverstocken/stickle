<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Child;
use App\User;
use Validator;
use Auth;
use Redirect;

class ParentController extends Controller
{
    public function openEditAccount(){
        $user = User::find(Auth::id());
        return view('auth.editAccount',[
            'user' => $user
            ]);
    }

    public function deleteAccount(){

        $user = User::find(Auth::id());    
        $user->delete();
        return redirect('/');
    }

    public function showAllChildrenFromParent(){
        $child = new Child;
        $childrenOfParents = $child->getChildWithParentId(Auth::id());

        return view('parent.kids.kids',[
            'childrenOfParents' => $childrenOfParents,
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
            'gender' => 'required|string|max:25',
            'dateOfBirth' => 'required|date',
            'picture' => 'image'
        ]);

        if ($validator->passes()) {

        	$child = new Child;
        	$child->firstName = $request->firstName;
        	$child->lastName = $request->lastName;
        	$child->gender = $request->gender;
        	$child->dateOfBirth = $request->dateOfBirth;
        	$child->picturePath = 'no picture';
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
                $filename = 'storage/children/' . $child_id . '.' .$extension;
                Storage::disk('local')->put($filename, $img);
                $child->picturePath = $filename;
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

    public function getChildData($child_id)    
    {
        //If doesn't work for a reason
        //if ($this->isChildFromParent($child_id)){
            $child = Child::find($child_id);
            return response()->json($child);
       /*  }
        else{
            //return "Child does not belong to user";
            return $child_id;
        } */
    }

    public function editChild($child_id, Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:25',
            'dateOfBirth' => 'required|date',
        ]);

        if ($validator->passes()) {

            $child = Child::find($child_id);
            $child->firstName = $request->firstname;
            $child->lastName = $request->lastname;
            $child->gender = $request->gender;
            $child->dateOfBirth = $request->dateOfBirth;
            $child->picturePath = 'Change this with edited path';
            $child->save();

            return redirect('/');
        }

    }

    public function deleteChild($child_id){
        //Check if the child is actualy from the logged in parent
        if ($this->isChildFromParent($child_id)){
            $child = Child::find($child_id);    
            $child->delete();
        }
        return redirect('/');
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
