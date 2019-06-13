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
    if (Auth::user()){
		return redirect("/home");
	}else{
		return view('welcome');
	}
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::resource('customers', 'CustomersController'); 
	Route::get('/devis/{customer_id}', 'CustomersController@devis'); 
	Route::post('/devis_add', 'CustomersController@devis_add'); 
});