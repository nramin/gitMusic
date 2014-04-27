<?php

class StreamController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function showStream($type)
    {
        if($type === 'new')
        {
            $songs = DB::table('songs')->orderBy('created_at', 'desc')->take(10)->get();
            return View::make('stream', array('songs' => $songs, 'type' => $type));
        }
    }
}