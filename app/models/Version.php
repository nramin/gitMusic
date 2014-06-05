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

    public function scopeNewest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function sendToS3($destination_filepath, $user, $filename) {
        $user = $user . "\/versions/";
        $s3 = AWS::get('s3');
        $result = $s3 ->putObject(array(
            'ACL'        => 'public-read',
            'Bucket'     => 'gitmusic',
            'Key'        => $user . $filename,
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


    public function setURL($url)
    {
        if(isset($url) and $version = Version::find($this->getId()))
        {
            $version = Version::find($this->getId());
            if(strpos($url, '.mp3') == true){
                $user->url = $url;
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


}