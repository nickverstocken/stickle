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

Route::get('','HomeController@index');
Route::get('registreer', function () {
    return view('auth.register');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout','HomeController@logout');
    Route::get('ouders/dashboard', 'HomeController@dashboard');
    
    //account routes
	Route::post('accountwijzigen','ParentController@editAccount');
    Route::get('verwijderaccount','ParentController@deleteAccount');
    Route::post('pincodewijzigen','ParentController@editPincode');
    //region parent Routes
    //Children routes
    Route::get('ouders/kinderen', 'ParentController@showAllChildrenFromParent');
    Route::post('ouders/kinderen/wijzig/{id}','ParentController@editChild');
    Route::post('ouders/kinderen/toevoegen','ParentController@addNewChild');
    Route::get('ouders/kinderen/verwijder/{id}','ParentController@deleteChild');
    Route::get('ouders/zoekboeken', 'BookController@searchBooks');
    
    //Book routes
    Route::get('ouders/boeken', 'BookController@showAllBooks');
    Route::get('ouders/boeken/open/{id}', 'BookController@getBook');
    Route::post('ouders/boeken/toevoegen','BookController@addNewBook');
    Route::post('ouders/boeken/wijzig/{id}','BookController@editBook');
    Route::get('ouders/boeken/verwijder/{id}','BookController@deleteBook');
    Route::post('ouders/boeken/veranderlaatstepagina/','BookController@changeLastPageOfReadingBook');
    Route::post('ouders/boeken/linknaarkind', 'BookController@linkBookToChild');
    Route::post('ouders/boeken/verwijderLink/{childrenReadingBook_id}', 'BookController@removeLinkToChild');
    Route::get('kind/{kindId}/boek/{childReadingBookId}/zetalshuidig', 'BookController@setBookAsCurrent');
    //endregion routes

    //region Child Routes
    //Childdashboard routes
    Route::get('kind/login', 'ChildController@index');
    Route::post('kind/login/{stickerBookId}', 'ChildController@scanStickerBook');
    Route::get('kind/{kindId}/dashboard', 'ChildController@getDashBoard');
    Route::get('kind/{kindId}/prijzen', 'ChildController@getPrices');
    Route::get('kind/{kindId}/scan','ChildController@getScan');
    Route::post('stickerbook/{stickerBookId}/reward/{rewardId}/scan', 'ChildController@scanReward');
    Route::post('kind/koopprijs', 'ChildController@buyPrice');
    Route::get('kind/{kindId}/prijs/{priceId}', 'ChildController@viewPrice');
    Route::get('kind/logout', 'ChildController@logout');
    //checkParentCode
    Route::post('kind/checkouderspincode', 'ChildController@checkParentCode');
    //endregion Child Routes
});

Route::get('nieuwkind','parrentController@openNewChild');
Route::post('voegnieuwkindtoe','parrentController@addNewChild');
Route::get('verwijderkind/{id}','parrentController@deleteChild');
Auth::routes();