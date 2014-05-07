<?php

class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function index($username)
    {
        if($user = User::getUserByName($username)) 
        {
        	return View::make('user.profile')->with('user', $user);
        }else{
            return View::make('errors.userNotFound', array('username' => $username));
        }
    }

    public function showSettings()
    {
        return View::make('user.settings');
    }

    public function showUsers()
    {
        $users = User::all();
        return View::make('user.users')->with('users', $users);
    }
}