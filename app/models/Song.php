<?php

class Song extends Eloquent {

    protected $table = 'songs';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

    public function user() 
    {
    	return $this->belongsTo('User');
    }

}