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
    Route::get('/ouders/dashboard', 'HomeController@dashboard');
    
    //account routes
	Route::get('/accountwijzigen','parentController@openEditAccount');
    Route::get('/verwijderaccount','parentController@deleteAccount');
    //region parent Routes
    //Children routes
    Route::get('/ouders/kinderen', 'ParentController@showAllChildrenFromParent');
    Route::get('/ouders/kinderen/get/{id}','ParentController@getChildData');
    Route::post('/ouders/kinderen/wijzig/{id}','parentController@editChild');    
    Route::post('/ouders/kinderen/toevoegen','parentController@addNewChild');
    Route::get('/ouders/kinderen/verwijder/{id}','parentController@deleteChild');
    //Temporary children routes
    Route::get('/ouders/kinderen/nieuw','parentController@openNewChild');
    Route::get('/ouders/kinderen/open/{id}','parentController@openEditChild');
    
    
    //Book routes
    Route::get('/ouders/boeken', 'BookController@showAllBooks');
    Route::post('/ouders/boeken/toevoegen','BookController@addNewBook');
    Route::get('/ouders/boeken/get/{id}','BookController@getBookData');
    Route::post('/ouders/boeken/wijzig/{id}','BookController@editBook');
    Route::get('/ouders/boeken/verwijder/{id}','BookController@deleteBook');
    //endregion routes

    //region Child Routes
    //Childdashboard routes
    Route::get('/kind/login', 'ChildController@index');
    Route::post('/kind/login/{stickerBookId}', 'ChildController@scanStickerBook');
    Route::get('/kind/{kindId}/dashboard', 'ChildController@getDashBoard');
    Route::get('/kind/prijzen', function () {
        return view('child.trophies.trophies');
    });
    Route::get('/kind/scan', function () {
        return view('child.scan.scancode');
    });
    //endregion Child Routes
});

Route::get('/nieuwkind','parrentController@openNewChild');
Route::post('/voegnieuwkindtoe','parrentController@addNewChild');
Route::get('/verwijderkind/{id}','parrentController@deleteChild');
Auth::routes();