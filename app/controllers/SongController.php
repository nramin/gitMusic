<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function showSong($username, $songname)
    {
        if($user = User::where('username', '=', $username)->first())
        {
            if($song = Song::where('songname', '=', $songname)->first())
            {
        	   return View::make('song')->with('song', $song);
            }
        }
        return View::make('songNotFound', array('songname' => $songname));
    }
}