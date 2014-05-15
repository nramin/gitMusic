<?php

class Song extends Eloquent {

    protected $table = 'songs';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

    private $rules = array(
        'songname' => 'required',
        'user_id'  => 'required', 
    );

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        return $v;
    }

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

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('likes', 'desc');
    }

    public function incrimentField($id, $field) 
    {
        if($song = Song::find($id) and $field === 'likes' or $field === 'favorites') {
            $song->increment($field);
            return true;
        }
        return false;
    }

    public function __toString()
    {
        return $this->songname;
    }

}