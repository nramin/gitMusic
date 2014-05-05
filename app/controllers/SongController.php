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
        	   return View::make('song.profile')->with('song', $song);
            }
        }
        return View::make('errors.songNotFound', array('songname' => $songname));
    }

    public function deleteSong($id) {
        if($song = Song::find($id)) {
            $song->delete();
        }
    }
}