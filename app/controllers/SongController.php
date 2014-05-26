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
        if($song = Song::find($id)) {

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

    public function handleUpload()
    {
        $file = Input::all();    
        $song = new Song();

        if($validator = $song->validate($file)->passes())

            $songname = $file['songname'];
            $song_file = $file['songfile'];

            if(Input::hasFile('songfile')){
                $dest = '/var/www/gitMusic/uploads';
                $filename = $songname . '.mp3';
                $song->move($dest, $filename);
                $destination_filepath = $dest . '/' . $filename;    
            }
  
            $user = Auth::user();
            $id = Auth::user()->getId();
            
        } else {
            return false;
        }

    public function like()
    {
        $new = Input::all();
        $song_like = new SongLike();

        if ($validator = $song_like->validate($new)->passes())
        {
            $song_duplicate = SongLike::where('user_id', '=', $new->user_id)->where('song_id', '=', $new->song_id)->get();
            if (! $song_duplicate ) {
                $song_like = SongLikes::create($new);
                $song = Song::find($new->song_id);
                $song->incrementLikes();
                return Redirect::back(); // 200
            } else {
                return false; // 404
            }
        }
        else
        {
            return false;
        
        }
    }

     public function showUpload()
    {
        return View::make('upload');
    }

}