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

Route::get('/', function () {
    return view('home');
});
Route::get('/registreer', function () {
    return view('auth.register');
});

Route::get('/accountwijzigen','parentController@openEditAccount');
Route::get('/verwijderaccount','parentController@deleteAccount');
Route::get('/wijzigkind/{id}','parentController@openEditChild');
Route::post('/wijzigkind/{id}','parentController@editChild');
Route::get('/nieuwkind','parentController@openNewChild');
Route::post('/voegnieuwkindtoe','parentController@addNewChild');
Route::get('/verwijderkind/{id}','parentController@deleteChild');
Route::get('/parent/dashboard', function () {
    return view('dashboard_parents');
});
Route::get('/parent/books', function () {
    return view('parent.books.book');
});
Route::get('/parent/kids', function () {
    return view('parent.kids.kids');
});
Route::get('/nieuwkind','parrentController@openNewChild');
Route::post('/voegnieuwkindtoe','parrentController@addNewChild');
Route::get('/verwijderkind/{id}','parrentController@deleteChild');
Auth::routes();