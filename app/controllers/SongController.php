<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function showSong($username, $songname)
    {
        $user = DB::table('users')->where('username', $username)->first();
        if( isset($user) ) 
        {
    		$song = DB::table('songs')->where('user_id', $user->id)->('songname', $songname)->get();
        	return View::make('song', array('user' => $user, 'song' => $song));
        }else{
            return View::make('songNotFound', array('songname' =>$songname));
        }
    }
}