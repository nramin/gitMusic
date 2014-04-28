<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function showSong($username, $songname)
    {
        if($song = Song::where('songname', '=', $songname)->first())
        {
    	   return View::make('song')->with('song', $song);
        }
        return View::make('songNotFound', array('songname' =>$songname));
    }
}