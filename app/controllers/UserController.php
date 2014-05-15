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
        }
        return View::make('errors.userNotFound', array('username' => $username));
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

    public function getFollowers($username)
    {
        if($user = User::getUserByName($username)) 
        {
            $followers = $user->getFollowers($user->getId());
            return View::make('user.followers', array('followers' => $followers, 'user' => $user));
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }
}