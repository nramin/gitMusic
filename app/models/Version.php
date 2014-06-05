<?php

class Version extends Eloquent {

    protected $table = 'versions';

    protected $guarded = array('id');

    public function getId()
    {
        return $this->id;
    }

    public function song()
    {
        return $this->belongsTo('song');
    }

}