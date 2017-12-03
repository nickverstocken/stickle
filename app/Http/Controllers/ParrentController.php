<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Child;
use Validator;
use Auth;
use Redirect;

class ParrentController extends Controller
{
    public function openAddANewChild()
    {
        return view('addANewChild');
    }

    //function to add a new Child for the parrent logged in
    public function addANewChild(Request $request){
    	$validator = Validator::make($request, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'required|string|max:25',
            'dateOfBirth' => 'required|date'
        ]);

        if ($validator->passes()) {

        	$child = new Child;
        	$child->firstName = $request->firstname;
        	$child->lastName = $request->lastname;
        	$child->gender = $request->gender;
        	$child->dateOfBirth = $request->dateOfBirth;
        	$child->picturePath = 'Change this with default path';
        	$child->rewardPoints = 0;
        	$child->parent_id = Auth::id();
        	$child->save();

        	return redirect('/');

        } else{

        	return Redirect::back()->withErrors($validator);
        }
    }
}
