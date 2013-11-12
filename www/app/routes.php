<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before' => 'guest'], function ()
{
	Route::get('/auth/login', [
		'as' => 'auth/login',
		'uses' => 'Drakenya\Ctrl\UserController@loginAction',
	]);

	Route::post('/auth/login-process', [
		'as' => 'auth/login-process',
		'uses' => 'UserController@loginProcessAction',
	]);

	Route::any('/auth/request', [
		'as' => 'auth/request',
		'uses' => 'UserController@requestAction',
	]);

	Route::any('/auth/reset', [
		'as' => 'auth/reset',
		'uses' => 'UserController@resetAction',
	]);
});

Route::group(['before' => 'auth'], function ()
{
	Route::get('/', 'user/profile');

	Route::get('/profile', [
		'as' => 'user/profile',
		'uses' => 'UserController@profileAction',
	]);

	Route::get('/auth/logout', [
		'as' => 'auth/logout',
		'uses' => 'UserController@logoutAction',
	]);
});
