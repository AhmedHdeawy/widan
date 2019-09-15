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


// Front Controller
Route::group([ 'prefix' =>	'/' ], function(){

    Auth::routes();
	
    // Home
    Route::get('/', 'HomeController@index')->name('home');

    // About
    Route::get('about', 'HomeController@about')->name('about');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'HomeController@postContactUs')->name('contactusForm');

    // Services
    Route::get('services', 'HomeController@services')->name('services');
    Route::get('services/{title}', 'HomeController@service')->name('service');

    // Blogs
    Route::get('blogs', 'HomeController@blogs')->name('blogs');
    Route::get('blogs/{title}', 'HomeController@blog')->name('blog');

});


// Dashboard Routes
Route::prefix('admin')
->name('admin.')
->group(function() {

	// Admin Login Routes
	Route::get('login', 'Auth\AdminLoginController@showLogin')->name('getLogin');
    Route::post('login', 'Auth\AdminLoginController@login')->name('postLogin');


	Route::middleware(['admin'])->group(function(){

		// Dashboard Routes
		Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.index');

		// Admin Logout Route
    	Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

    	// Services Routes
    	Route::resource('services', 'Dashboard\ServicesController');

        // Blogs Routes
        Route::resource('blogs', 'Dashboard\BlogsController');

        // Sliders Routes
        Route::resource('sliders', 'Dashboard\SlidersController');

       	// Infos Routes
    	Route::resource('infos', 'Dashboard\InfosController');

    	// Settings Routes
    	Route::resource('settings', 'Dashboard\SettingsController')->except('create', 'store', 'delete');

        // ContactUs Routes
        Route::resource('contactus', 'Dashboard\ContactUsController');

    	// Users Routes
    	Route::resource('users', 'Dashboard\UsersController');

        // Admins Routes
        Route::resource('admins', 'Dashboard\AdminsController');
		

	});


});


