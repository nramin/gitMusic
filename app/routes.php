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
	return View::make('homepage/loggedin/homepage');
});

Route::get('/loggedout', function()
{
	return View::make('homepage/loggedout/homepage');
});

Route::get('/signup', function()
{
	return View::make('signup');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/about', function()
{
	return View::make('about');
});

Route::get('/stream/{type}', 'StreamController@showStream');

Route::get('/{username}', 'UserController@showProfile');

Route::get('/{username}/{songname}', 'SongController@showSong');

Route::get('/stream/{type}', 'StreamController@showStream');