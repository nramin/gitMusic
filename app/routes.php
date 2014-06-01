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

//Route::get('/signup', array('as' => 'signup', 'uses' => 'AccountController@getCreate'));

//Route::get('/login', array('as' => 'login', 'uses' => 'AccountController@getLogin'));

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::get('test', function() {
	phpinfo();
});

Route::get('about', array('as' => 'about', 'uses' => 'HomeController@showAbout'));


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

	// List Users
	Route::get('people', array('as' => 'people', 'uses' => 'UserController@showUsers'));

	// User stream
	Route::get('/stream/{type?}', array('as' => 'stream', 'uses' => 'StreamController@showStream'));

	// Settings
	Route::get('settings', array('as' => 'settings', 'uses' => 'UserController@showSettings'));

	// Get Upload Form
	Route::get('upload', array('as' => 'upload', 'uses' => 'SongController@showUpload'));

	// Song Upload Post
	Route::post('upload', array('as' => 'upload-post', 'uses' => 'SongController@handleUpload'));

	// Explore Page
	Route::get('explore', array('as' => 'explore', 'uses' => 'SongController@showExplore'));

	// <-------- Json Routes ---------->

	// Song Genre By Type (hottest, newest, popular)
	Route::get('songs/genre/{type}/{genre_id}', array('uses' => 'SongController@getGenreSongs'));

	//CSRF Protected Routes
	Route::group(array('before' => 'csrf'), function() {
		
		// Upload Post
		Route::post('upload', array('as' => 'upload-post', 'uses' => 'SongController@handleUpload'));

		// Comment Post
		Route::post('comment', array('as' => 'comment-post', 'uses' => 'CommentController@postComment'));
	
	});

	// Follow Post
	Route::post('follow', array('as' => 'follow-post', 'uses' => 'FollowController@postFollow'));

	// Song Like post
	Route::post('song-like', array('as' => 'song-like', 'uses' => 'SongController@like'));

	// Sign out (GET)
	Route::get('/logout', array(
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
	
	// // Sign in (GET)
	// Route::get('login', array(
	// 	'as' => 'login-get',
	// 	'uses' => 'AccountController@getLogIn'
	// ));
	
	// // Create Account (GET) 
	// Route::get('signup', array(
	// 	'as' => 'signup-get',
	// 	'uses' => 'AccountController@getCreate'
	// ));
});

// Other Public Routes

// Show User Profile
Route::get('/{username}', array('as' => 'userProfile', 'uses' => 'UserController@index'));

// Show User Followers
Route::get('/{username}/followers', array('as' => 'userFollowers', 'uses' => 'UserController@getFollowers'));

// Show People User is Following
Route::get('/{username}/following', array('as' => 'userFollowing', 'uses' => 'UserController@getFollowing'));

// Show Songs User Has Liked
Route::get('/{username}/liked', array('as' => 'userLikedSongs', 'uses' => 'UserController@getLikedSongs'));

// Show Song Profile
Route::get('/{username}/{songname}', array('as' => 'songProfile', 'uses' => 'SongController@index'));

App::missing(function($exception)
	{
		// shows an error page (app/views/error.blade.php)
		// returns a page not found error
		return Response::view('errors.404', array(), 404);
	});