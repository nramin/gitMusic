<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		if (Auth::check()) {
    		$current_user = Auth::user();
			return View::make('homepage/loggedin/homepage', array('current_user' => $current_user));
		} else {
			return View::make('homepage/loggedout/homepage');
		}
	}

	public function showAbout()
	{
		return View::make('about');
	}

}
