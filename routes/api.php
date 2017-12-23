<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Book route
Route::get('/ouders/boeken/get/{id}','BookController@getBookData');

//Children route
Route::get('/ouders/kinderen/get/{id}','ParentController@getChildData');