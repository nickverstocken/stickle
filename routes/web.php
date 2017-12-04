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

Route::get('/nieuwkind','parrentController@openNewChild');
Route::post('/voegnieuwkindtoe','parrentController@addNewChild');
Route::get('/verwijderkind/{id}','parrentController@deleteChild')
Auth::routes();