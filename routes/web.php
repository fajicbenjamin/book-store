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

Route::post('/book/create', 'BookController@create');
Route::post('/book/store', 'BookController@store');
Route::get('/book/{id}', 'BookController@show');
Route::put('/book/{id}/edit', 'BookController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
