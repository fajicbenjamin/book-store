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
    return view('welcome');
});

Route::get('/index', 'BookController@index');

Route::get('/book/{id}', 'BookController@show');
Route::get('/book/create', 'BookController@create')->middleware('auth');
Route::post('/book/store', 'BookController@store')->middleware('auth');
Route::get('/book/{id}/edit', 'BookController@edit')->middleware('auth');
Route::post('/book/{id}/update', 'BookController@update');
Route::get('/book/{id}/delete', 'BookController@destroy')->middleware('auth');

Route::get('/user/{id}', 'UserController@showUserBooks');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
