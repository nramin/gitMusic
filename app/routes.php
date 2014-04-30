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

Route::get('/', function()
{
    if (Auth::check()) {
		return View::make('homepage/loggedin/homepage');
	} else {
		return View::make('homepage/loggedout/homepage');
	}
});

Route::get('/stream/{type}', 'StreamController@showStream');

Route::get('/signup', function()
{
	return View::make('signup');
});

Route::get('/login', array('as' => 'login', function()
{
	return View::make('login');
}));

Route::get('/about', function()
{
	return View::make('about');
});


/*
	Authenticated Group
*/
Route::group(array('before' => 'auth'), function() {



	// Route::get('account', array(
	// 	'as' => 'account', function() {
	// 		return View::make('account.main');
	// 	}
	// ));

	// // Change password (GET)	
	// Route::get('account/password', array(
	// 	'as' => 'account-password',
	// 	'uses' => 'AccountController@getChangePassword'
	// ));

	// Sign out (GET)
	Route::get('logout', array(
		'as' => 'logout-get',
		'uses' => 'AccountController@getLogOut'
	));
});

/*
	Unauthenticated Group
*/
Route::group(array('before' => 'guest'), function() {
	
	// Cross Site Request Forgery Protection Group
	Route::group(array('before' => 'csrf'), function() {
		
		// Sign in (post)
		Route::post('login', array(
			'as' => 'login-post',
			'uses' => 'AccountController@postLogin'
		));
	
		// Create Account (POST)
		Route::post('signup', array(
			'as' => 'signup-post',
			'uses' => 'AccountController@postCreate'
		));
		
	});
	
	// Sign in (GET)
	Route::get('login', array(
		'as' => 'login-get',
		'uses' => 'AccountController@getLogIn'
	));
	
	// Create Account (GET) 
	Route::get('signup', array(
		'as' => 'signup-get',
		'uses' => 'AccountController@getCreate'
	));
});

Route::get('/{username}', 'UserController@showProfile');

Route::get('/{username}/{songname}', 'SongController@showSong');