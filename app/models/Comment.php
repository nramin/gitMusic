<?php

class Comment extends Eloquent {

    protected $table = 'comments';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

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