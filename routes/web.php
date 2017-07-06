<?php

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();
Route::group(['middleware' => 'auth'], function(){
  Route::post('/logout', 'Auth\LoginController@logout');
});


// Auth
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/csrf-token', 'AjaxTokenVerify@VerifyToken');


//lng
Route::get('lang/{locale}/', function ($locale) {
	if (in_array($locale, \Config::get('app.locales'))) {
		Cookie::queue(Cookie::forever('lang', $locale));
	}
	return redirect()->back()->with('status', 'Profile updated!');
});
