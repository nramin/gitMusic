<?php

class StreamController extends BaseController {

    /**
     * Show the stream based on parameter
     */
    public function showStream($type)
    {
        if($type === 'new') {
            $songs = Song::newest()->take(10)->get();
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        } else if($type === 'hot') {
            $songs = Song::newest()->take(10)->get();
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        }
    }
}