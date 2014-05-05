<?php

class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showProfile($username)
    {
        if($user = User::getUserByName($username)) 
        {
        	return View::make('user.profile')->with('user', $user);
        }else{
            return View::make('errors.userNotFound', array('name' => $username));
        }
    }

    public function showSettings()
    {
        return View::make('user.settings');
    }

}