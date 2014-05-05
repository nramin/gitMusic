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

Route::get('/signup', array('as' => 'signup', 'uses' => 'AccountController@getCreate'));

Route::get('/login', array('as' => 'login', 'uses' => 'AccountController@getLogin'));

Route::get('/about', array('as' => 'about', 'uses' => 'HomeController@showAbout'));


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

	// Homepage, signed in or out
	Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHomepage'));

	// User stream
	Route::get('/stream/{type?}', array('as' => 'stream', 'uses' => 'StreamController@showStream'));

	// Settings
	Route::get('/settings', array('as' => 'settings', 'uses' => 'UserController@showSettings'));

	// Upload
	Route::get('/upload', array('as' => 'upload', 'uses' => 'HomeController@showUpload'));


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

// Other Public Routes

// Show User Profile
Route::get('/{username}', array('as' => 'userProfile', 'uses' => 'UserController@showProfile'));

// Show Song Profile
Route::get('/{username}/{songname}', array('as' => 'songProfile', 'uses' => 'SongController@showSong'));

App::missing(function($exception)
	{

		// shows an error page (app/views/error.blade.php)
		// returns a page not found error
		return Response::view('errors.error', array(), 404);
	});