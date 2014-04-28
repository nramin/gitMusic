<?php

class StreamController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showStream($type)
    {
        if($type === 'new')
        {
            $songs = Song::where('id', '>', 0)->orderBy('created_at', 'desc')->get()->take(10);
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        }
    }
}