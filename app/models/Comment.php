<?php

class Comment extends Eloquent {

    protected $table = 'comments';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

    private $rules = array(
        'user_id' => 'required',
        'song_id' => 'required', 
        'content' => 'required'
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

    public function song()
    {
        return $this->belongsTo('Song');
    }

    public function getId()
    {
        return $this->id;
    }

}