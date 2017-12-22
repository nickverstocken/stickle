<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index');
Route::get('/registreer', function () {
    return view('auth.register');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout','HomeController@logout');
    Route::get('/parent/dashboard', 'HomeController@dashboard');
    
    //account routes
	Route::get('/accountwijzigen','parentController@openEditAccount');
    Route::get('/verwijderaccount','parentController@deleteAccount');

    //Children routes
    Route::get('/wijzigkind/{id}','parentController@openEditChild');
    Route::post('/wijzigkind/{id}','parentController@editChild');
    Route::get('/nieuwkind','parentController@openNewChild');
    Route::post('/voegnieuwkindtoe','parentController@addNewChild');
    Route::get('/verwijderkind/{id}','parentController@deleteChild');
    Route::get('/ouders/kinderen', function () {
        return view('parent.kids.kids');
    });
    
    //Book routes
    Route::get('/ouders/boeken', 'bookController@showAllBooks');
    Route::post('/ouders/boeken/toevoegen','bookController@addNewBook');    
    Route::get('/nieuwkind','parrentController@openNewChild');
    Route::post('/voegnieuwkindtoe','parrentController@addNewChild');
    Route::get('/verwijderkind/{id}','parrentController@deleteChild');
	
});



Auth::routes();