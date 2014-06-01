<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('email', 'username', 'password', 'password_temp', 'temp_code', 'is_active');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	protected $guarded = array('id');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function songs()
	{
		return $this->hasMany('Song');
	}

	public function comments()
	{
		return $this->hasMany('Comments');
	}

	public function getFollowers($user_id)
	{
		return Follow::getUserFollowers($user_id);
	}

	public function getFollowing($user_id)
	{
		return Follow::getUserFollowing($user_id);
	}

	public function incrementFollowers() 
	{
		return $this->increment('followers');
	}

	public static function getUserByName($username)
	{
		if($user = User::where('username', '=', $username)->first())
		{
			return $user;
		} 
		else 
		{
			return false;
		}
	}

	public function getHomeStream()
	{
		$followings = $this->getFollowing($this->getId());
		$followings_ids = array();
		if($followings) {
			foreach ($followings as $follower) {
				array_push($followings_ids, $follower->getId());
			}
			$songs = Song::whereIn('user_id', $followings_ids)->newest()->take(10)->get();
			return $songs;
		}
		return false;
	}

	public function __toString()
	{
		return $this->username;
	}

	public function likes_song($song_id)
	{
		$song_like = DB::table('song_likes')->where('user_id', '=', $this->id)->where('song_id', '=', $song_id)->get();
		if( $song_like ) {
			return true;
		}
		return false;
	}

	public function following_user($following_id)
	{
		if(count(Follow::where('user_id', '=', $following_id)->where('follower_id', '=', $this->id)->get()) > 0 ) {
			return true;
		}
		return false;
	}

	public function getLikedSongs()
	{
		$liked_songs_ids = SongLike::where('user_id', '=', $this->id)->get();
		$liked_ids = array();
		foreach ($liked_songs_ids as $liked) {
				array_push($liked_ids, $liked->song_id);
			}
		$liked_songs = Song::whereIn('id', $liked_ids)->newest()->take(10)->get();
		return $liked_songs;
	}

}
