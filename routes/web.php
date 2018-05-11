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

Auth::routes();

Route::get('/edit-profile', 'UserController@editProfile')->name('user.edit.view');

Route::get('/home', 'UserController@index')->name('home');

Route::post('/edit-profile', 'UserController@updateProfile')->name('user.edit');
