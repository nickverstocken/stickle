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
    Route::post('/ouders/kinderen/wijzig/{id}','parentController@editChild');    
    Route::post('/ouders/kinderen/toevoegen','parentController@addNewChild');
    Route::get('/ouders/kinderen/verwijder/{id}','parentController@deleteChild');
    //Temporary children routes
    Route::get('/ouders/kinderen/nieuw','parentController@openNewChild');
    Route::get('/ouders/kinderen/open/{id}','parentController@openEditChild');
    
    
    //Book routes
    Route::get('/ouders/boeken', 'BookController@showAllBooks');
    Route::post('/ouders/boeken/toevoegen','BookController@addNewBook');
    Route::post('/ouders/boeken/wijzig/{id}','BookController@editBook');
    Route::get('/ouders/boeken/verwijder/{id}','BookController@deleteBook');
	//Temporary book routes
    Route::get('/ouders/boeken/nieuw','BookController@openNewBook');
    Route::get('/ouders/boeken/open/{id}','BookController@openEditBook');
    //endregion routes
    //region Child Routes
    //Childdashboard routes
    Route::get('/child/login', 'ChildController@index');

    //endregion Child Routes
});
Route::post('/child/login/{stickerBookId}', 'ChildController@scanStickerBook');

Route::get('/child/dashboard', function () {
    return view('child.home.home');
});
Route::get('/child/trophies', function () {
    return view('child.trophies.trophies');
});
Route::get('/child/scan', function () {
    return view('child.scan.scancode');
});
Route::get('/nieuwkind','parrentController@openNewChild');
Route::post('/voegnieuwkindtoe','parrentController@addNewChild');
Route::get('/verwijderkind/{id}','parrentController@deleteChild');
Auth::routes();