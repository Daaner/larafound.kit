<?php

Route::get('/', function () {
    return view('welcome');
})->name('site');

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();
Route::group(['middleware' => 'auth'], function(){
  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});


// Auth
Route::get('/csrf-token', 'AjaxTokenVerify@VerifyToken')->name('token');

Route::group(['middleware' => 'throttle:50'], function () {
	Route::post('/register', 'Auth\RegisterController@register')->name('register');
	Route::get('/register', 'Auth\RegisterController@register')->name('regtoken');
	Route::post('/login', 'Auth\LoginController@login')->name('login');

	Route::post('/forgot', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');
});


//lng
Route::get('lang/{locale}/', function ($locale) {
	if (in_array($locale, \Config::get('app.locales'))) {
		Cookie::queue(Cookie::forever('lang', $locale));
	}
	return redirect()->back()->with('status', 'Profile updated!');
});
