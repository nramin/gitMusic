<?php

class StreamController extends BaseController {

    /**
     * Show the stream based on parameter
     */
    public function showStream($type)
    {
        if($type === 'new')
        {
            $songs = Song::getNewestSongs(10);
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        } else if($type === 'liked')
        {
            $songs = Song::getLikedSongs(10);
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        }
    }
}