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



// Admin Login Routes
Route::get('admin-login', ['as'=>'admin-login-form', 'uses'=>'Auth\AdminLoginController@showLoginForm']);
Route::post('admin-login', ['as'=>'admin-login','uses'=>'Auth\AdminLoginController@login']);


// Front Controller
Route::group([ 'prefix' =>	'/' ], function(){

	Route::get('/', 'HomeController@index');


	Route::get('/search', 'HomeController@search')->name('search');

	/**
	 * Categories Routes
	 */
	Route::get('categories', 'Website\CategoriesController@categories')->name('categories');

	Route::get('category/{slug}', 'Website\CategoriesController@category')->name('category');

	/**
	 * Clients Routes
	 */
	Route::get('client/{slug}', 'Website\ClientsController@client')->name('client');
	Route::get('client/{id}/edit', 'Website\ClientsController@editClient')->name('editClient');
	Route::post('client/updateClient', 'Website\ClientsController@updateClient')->name('updateClient');
	Route::post('client/{id}/follow-client', 'Website\ClientsController@followClient')->name('followClient');
	Route::post('client/{id}/evaluation', 'Website\ClientsController@evaluation')->name('evaluation')->middleware('auth');
	

});


// Dashboard Routes
Route::group([ 'prefix'	=>	'dashboard', 'middleware'  =>  'admin' ], function(){

	// Dashboard Routes
	Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard');

	// Admin Logout Route
	Route::get('admin-logout', ['as'=>'admin-logout','uses'=>'Auth\AdminLoginController@logout']);
	

	// Categories Routes
	Route::group([ 'prefix'	=>	'categories', ], function(){
		Route::get('/', 'Dashboard\CategoriesController@index')->name('dashboard.categories');
		Route::get('create', 'Dashboard\CategoriesController@create')->name('dashboard.categories.create');
		Route::post('store', 'Dashboard\CategoriesController@store')->name('dashboard.categories.store');
		Route::get('{category}', 'Dashboard\CategoriesController@show')->name('dashboard.categories.show');		
		Route::get('{category}/edit', 'Dashboard\CategoriesController@edit')->name('dashboard.categories.edit');
	    Route::put('update', 'Dashboard\CategoriesController@update')->name('dashboard.categories.update');
	    Route::delete('{category}', 'Dashboard\CategoriesController@destroy')->name('dashboard.categories.destroy');
		Route::get('search', 'Dashboard\CategoriesController@search')->name('dashboard.categories.search');
	});


	// Clients Routes
	Route::group([ 'prefix'	=>	'clients', ], function(){
		Route::get('/', 'Dashboard\ClientsController@index')->name('dashboard.clients');
		Route::get('create', 'Dashboard\ClientsController@create')->name('dashboard.clients.create');
		Route::post('store', 'Dashboard\ClientsController@store')->name('dashboard.clients.store');
		Route::get('{client}', 'Dashboard\ClientsController@show')->name('dashboard.clients.show');
		Route::get('{client}/edit', 'Dashboard\ClientsController@edit')->name('dashboard.clients.edit');
	    Route::put('update', 'Dashboard\ClientsController@update')->name('dashboard.clients.update');
	    Route::delete('{client}', 'Dashboard\ClientsController@destroy')->name('dashboard.clients.destroy');
	});

	// Services Routes
	Route::group([ 'prefix'	=>	'services', ], function(){
		Route::get('{client}',	 'Dashboard\ServicesController@index')->name('dashboard.services');
		Route::get('create/{client}', 'Dashboard\ServicesController@create')->name('dashboard.services.create');
		Route::post('store/{client}', 'Dashboard\ServicesController@store')->name('dashboard.services.store');
		Route::get('{service}/show', 'Dashboard\ServicesController@show')->name('dashboard.services.show');
		Route::get('{service}/edit', 'Dashboard\ServicesController@edit')->name('dashboard.services.edit');
	    Route::put('update', 'Dashboard\ServicesController@update')->name('dashboard.services.update');
	    Route::delete('{service}', 'Dashboard\ServicesController@destroy')->name('dashboard.services.destroy');
	});


	// Branches Routes
	Route::group([ 'prefix'	=>	'branches', ], function(){
		Route::get('{client}',	 'Dashboard\BranchesController@index')->name('dashboard.branches');
		Route::get('create/{client}', 'Dashboard\BranchesController@create')->name('dashboard.branches.create');
		Route::post('store/{client}', 'Dashboard\BranchesController@store')->name('dashboard.branches.store');
		Route::get('{branch}/show', 'Dashboard\BranchesController@show')->name('dashboard.branches.show');
		Route::get('{branch}/edit', 'Dashboard\BranchesController@edit')->name('dashboard.branches.edit');
	    Route::put('update', 'Dashboard\BranchesController@update')->name('dashboard.branches.update');
	    Route::delete('{branch}', 'Dashboard\BranchesController@destroy')->name('dashboard.branches.destroy');
	});


	Route::group([ 'prefix'	=>	'users' ], function(){

		Route::get('/', 'Dashboard\UserController@index')->name('users');
		Route::get('findUser', 'Dashboard\UserController@findUser');
		Route::post('create', 'Dashboard\UserController@create');
		Route::post('update', 'Dashboard\UserController@update');
		Route::delete('delete/{id}', 'Dashboard\UserController@delete');
		Route::post('bulk', 'Dashboard\UserController@bulk');
	});

});
