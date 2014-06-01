<?php

class Song extends Eloquent {

    protected $table = 'songs';

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

    public function genre()
    {
        return $this->belongsTo('Genre');
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

    public function scopeHottest($query)
    {
        return $query->orderBy(DB::raw('LOG10( ABS( likes ) + 1 ) * 
            SIGN( likes ) + 
            ( UNIX_TIMESTAMP( created_at ) /300000 )'), 'desc');
    }

    public function likes()
    {
        //return SongLike::where('song_id', '=', $this->getId())->count(); 
        return $this->likes;
    }

    public function incrementLikes()
    {
        return $this->increment('likes');
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->songname;
    }

    public function sendToS3($destination_filepath, $user, $filename) {
        $s3 = AWS::get('s3');
        $result = $s3 ->putObject(array(
            'ACL'        => 'public-read',
            'Bucket'     => 'gitmusic',
            'Key'        => $user .'/' . $filename,
            'SourceFile' => $destination_filepath    
        ));
        if(isset($result))
        {
            File::delete($destination_filepath);
            if($this->setURL($result['ObjectURL'])) {
                return true;
            } else {
                return false;
            }
            return true;
        }
        return false;
    }

    public function hasParent()
    {
        return $this->parent_id != 0;
    }

    public function getParent()
    {
        $song = Song::find($this->parent_id);
    }

    // return all 'child' songs
    public function getVersions()
    {
        $this_song_id = $this->getId();
        $versions = Song::where('parent_id', '=', $this_song_id)->newest()->get();
        return $versions;
    }

    //Only to be used AFTER a song has been uploaded to S3, otherwise it won't exist
    public function setURL($url)
    {
        if(isset($url) and $song = Song::find($this->getId()))
        {
            
            $user = Song::find($this->getId());
            if(strpos($url, '.mp3') == true){
                $user->url = $url;
                $user->save();
                return true;
            } elseif (strpos($url, '.jpg')) {
                $user->pic_url = $url;
                $user->save();
                return true;
            } else {
                $user->zip_url = $url;
                $user->save();
                return true;
            }

        } else {
            return false;
        }
    }

    public static function getSongsByGenre($type, $genre_id)
    {
        if($type == 'newest') {
            $songs = Song::where('genre_id', '=', $genre_id)->newest()->take(10)->get();
        } else if ($type == 'hottest') {
            $songs = Song::where('genre_id', '=', $genre_id)->hottest()->take(10)->get();
        } else if ($type == 'popular') {
            $songs = Song::where('genre_id', '=', $genre_id)->popular()->take(10)->get();
        } else {
            return 'Type does not exist';
        }
        return $songs;
    }

}