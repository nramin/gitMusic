<?php

class Genre extends Eloquent {

    protected $table = 'genres';

    protected $guarded = array('id');

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->display_name;
    }

}