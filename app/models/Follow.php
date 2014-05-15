<?php

class Follow extends Eloquent {

    protected $table = 'follows';

    protected $hidden = array('user_id');

    protected $guarded = array('id');

    private $rules = array(
        'user_id' => 'required',
        'follower_id' => 'required'
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

    public static function getUserFollowers($user_id)
    {
        if($user = User::find($user_id)) {
        
            $followers = [];
            $followers_id = Follow::where('user_id', '=', $user_id)->get();
            if(sizeof($followers_id)) {
                foreach($followers_id as $follower) {
                    array_push($followers, User::find($follower->follower_id));
                }
            }
            return $followers;
        }
    }
}