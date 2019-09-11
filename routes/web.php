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
Route::post ('/search',function(){
	$q = Input::get ('q');
	if ($q !=""){
			$name = name::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'reg_num', 'LIKE', '%' . $q . '%' )->get ();
		}
		if (count($name)> 0)
				return view ('search')->withDetails($name)->withQuery($q);
			
		else 
			return view (search)->withMessage('No Details found. Try to search again !');
});

Route::get('/check', 'checkCompany@check');
Route::get('/search', 'checkCompany@search');
