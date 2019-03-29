<?php

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| USER 		=>	auth()->user()
|
| ADMIN		=>	auth()->guard('admin')->user()
\
*/

Auth::routes();

// Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->name('home');


// Admin Login Routes
Route::get('admin-login', ['as'=>'admin-login-form', 'uses'=>'Auth\AdminLoginController@showLoginForm']);
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Auth\AdminLoginController@login']);
Route::post('admin-logout', ['as'=>'admin-logout','uses'=>'Auth\AdminLoginController@logout']);



// Dashboard Routes
Route::group([ 'prefix'	=>	'dashboard', 'middleware'  =>  'admin' ], function(){

	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

	Route::group([ 'prefix'	=>	'categories' ], function(){

		Route::get('/', 'Dashboard\CategoryController@index');
		Route::get('findCategory', 'Dashboard\CategoryController@findCategory');
		Route::post('create', 'Dashboard\CategoryController@create');
    Route::post('update', 'Dashboard\CategoryController@update');
    Route::delete('delete/{id}', 'Dashboard\CategoryController@delete');
    Route::post('bulk', 'Dashboard\CategoryController@bulk');
	});

	Route::group([ 'prefix'	=>	'clients' ], function(){

		Route::get('/', 'Dashboard\ClientController@index');
		Route::get('userclients', 'Dashboard\ClientController@userclients');
		Route::get('findClient', 'Dashboard\ClientController@findClient');
		Route::post('image', 'Dashboard\ClientController@image');
		Route::post('savePictures', 'Dashboard\ClientController@savePictures');
		Route::post('deletePicture', 'Dashboard\ClientController@deletePicture');
		Route::post('create', 'Dashboard\ClientController@create');
    Route::post('update', 'Dashboard\ClientController@update');
    Route::delete('delete/{id}', 'Dashboard\ClientController@delete');
    Route::post('bulk', 'Dashboard\ClientController@bulk');
		Route::get('categories', 'Dashboard\ClientController@categories');
		Route::get('users', 'Dashboard\ClientController@users');

	});

	Route::group([ 'prefix'	=>	'services' ], function(){

		Route::get('/', 'Dashboard\ServiceController@index');
		Route::get('findService', 'Dashboard\ServiceController@findService');
		Route::post('image', 'Dashboard\ServiceController@image');
		Route::post('savePictures', 'Dashboard\ServiceController@savePictures');
		Route::post('deletePicture', 'Dashboard\ServiceController@deletePicture');
		Route::post('create', 'Dashboard\ServiceController@create');
    Route::post('update', 'Dashboard\ServiceController@update');
    Route::delete('delete/{id}', 'Dashboard\ServiceController@delete');
    Route::post('bulk', 'Dashboard\ServiceController@bulk');
		Route::get('categories', 'Dashboard\ServiceController@categories');

	});


	Route::group([ 'prefix'	=>	'users' ], function(){

		Route::get('/', 'Dashboard\UserController@index');
		Route::get('findUser', 'Dashboard\UserController@findUser');
		Route::post('create', 'Dashboard\UserController@create');
		Route::post('update', 'Dashboard\UserController@update');
		Route::delete('delete/{id}', 'Dashboard\UserController@delete');
		Route::post('bulk', 'Dashboard\UserController@bulk');
	});

});
