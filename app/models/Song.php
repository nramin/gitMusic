<?php

class Song extends Eloquent {

    protected $table = 'songs';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

    public function user() 
    {
    	return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public static function getSongbyName($songname)
    {
    	if($song = Song::where('songname', '=', $songname)->first())
    	{
    		return $song;
    	} else {
    		return false;
    	}
    }

    public static function getNewestSongs($amount)
    {
    	if($songs = Song::where('id', '>', 0)->orderBy('created_at', 'desc')->get()->take($amount))
    	{
    		return $songs;
    	} else {
    		return false;
    	}
    }

    public static function getLikedSongs($amount)
    {
    	if($songs = Song::where('id', '>', 0)->orderBy('likes', 'desc')->get()->take($amount))
    	{
    		return $songs;
    	} else {
    		return false;
    	}
    }

    public function incrimentField($id, $field) {
        if($song = Song::find($id) and $field === 'likes' or $field === 'favorites') {
            $song->increment($field);
            return true;
        }
        return false;
    }

}