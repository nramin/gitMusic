<?php

class Song extends Eloquent {

    protected $table = 'songs';

    protected $hidden = array('user_id');

    public function user() 
    {
    	return $this->belongsTo('User');
    }

}