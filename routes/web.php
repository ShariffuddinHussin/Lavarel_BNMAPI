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


Route::get('/main', function () {
    return view('main');
});

Route::get('/mail', function () {
  return view('mail');
});

Route::get('/edit', function () {
    return view('edit');
});

Auth::routes(['verify' => true]);

Route::get ('register','AuthController@create')->name('register.create');
Route::post ('register','AuthController@store')->name('register.create');

Route::get ('login','AuthController@loginView')->name('login.loginView');
Route::post ('login','AuthController@login')->name('login.login');
