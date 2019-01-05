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

Route::get('/', 'BookController@welcomePage');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/index', 'BookController@index');
Route::get('/cart', 'UserController@showCart');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/book/create', 'BookController@create');
    Route::post('/book/store', 'BookController@store');
    Route::get('/book/{id}/edit', 'BookController@edit');
    Route::post('/book/{id}/update', 'BookController@update');
    Route::get('/book/{id}/delete', 'BookController@destroy');
});
Route::get('/book/{id}', 'BookController@show');

Route::get('/user/{id}', 'UserController@showUserBooks');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
