<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function showSong($username, $songname)
    {
        if($user = DB::table('users')->where('username', $username)->first()) 
        {
            if($song = DB::table('songs')->where('user_id', $user->id)->where('songname', $songname)->get())
            {
        	   return View::make('song', array('user' => $user, 'song' => $song));
            }
        }
        return View::make('songNotFound', array('songname' =>$songname));
        
    }
}