<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */
    public function index($username, $songname)
    {
        if($user = User::getUserByName($username))
        {
            if($song = Song::where('songname', '=', $songname)->where('user_id', '=', $user->getId())->first())
            {
        	   return View::make('song.profile')->with('song', $song);
            } else {
                return View::make('errors.songNotFound', array('songname' => $songname));
            }
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }

    public function delete($id) {
        if($song = Song::find($id)) {
            $song->delete();
        }
    }

    public function create()
    {
        return View::make('song.create');
    }

    public function store()
    {
        $new = Input::all();
        $song = new Song();

        if ($validator = $song->validate($new)->passes())
        {
            $song = Song::create($new);
        }
        else
        {
            return Redirect::route('upload')
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    public function edit($id)
    {
        if($song = Song::find($id)) {
            return View::make('song.edit')->with('song', $song);
        } else {
            return View::make('errors.songNotFound');
        }
    }

    public function update($id)
    {
        $post_data = Input::all();
        if($song = Song::getSongByUsername($username)) {

            if ($validator = $song->validate($post_data)->passes())
            {
                $song->update($post_data);
            }
            else
            {
                return Redirect::route('upload')
                        ->withErrors($validator)
                        ->withInput();
            }
        }
    }

    public function sendToS3()
    {
        //echo "debug";
        $file = Input::file('song');    
        var_dump($_POST);
        //$mimeType = $file->getMimeType();
        //$path = Input::file('song')->getRealPath();
        //var_dump($file);
        if (Input::has('songname')) {
            echo Input::get('songname');
        }
        if(Input::hasFile('songfile'))
        {
            //$path = Input::file('song')->getRealPath();
            echo "gothere";
        }
        // echo "end of if";
        //$post_data = Input::all();
        
        //$file = Input::
        //echo "got here";
        //die(var_dump($post_data));
        //echo $post_data['song'];
        // $user = Auth::user() -> getUsername();
        // $s3 = AWS::get('s3');
        // $s3 ->putObject(array(
        //     'Bucket'     => 'gitmusic',
        //     'Key'        => $user .'/song1',
        //     'SourceFile' => $post_data['song'],
        //     'Body'       => $post_data['song'],    
        // ));
    }

}