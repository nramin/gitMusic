<?php

class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showProfile($username)
    {
        if($user = User::getUserByName($username)) 
        {
        	return View::make('user')->with('user', $user);
        }else{
            return View::make('userNotFound', array('name' => $username));
        }
    }

}