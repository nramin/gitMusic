<?php

class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showProfile($username)
    {
        if($user = DB::table('users')->where('username', $username)->first()) 
        {
    		$songs = DB::table('songs')->where('user_id', $user->id)->get();
        	return View::make('user', array('user' => $user, 'songs' => $songs));
        }else{
            return View::make('userNotFound', array('name' =>$username));
        }
    }
}