<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function showSong($username, $songname)
    {
        if($user = User::getUserByName($username))
        {
            if($song = Song::getSongByName($songname))
            {
        	   return View::make('song')->with('song', $song);
            }
        }
        return View::make('songNotFound', array('songname' => $songname));
    }
}