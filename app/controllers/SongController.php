<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */

    public static $FILTER_TYPES = array('hottest', 'newest', 'popular');

    public function index($username, $songname)
    {
        if($user = User::getUserByName($username))
        {
            if($song = Song::where('songname', '=', $songname)->where('user_id', '=', $user->getId())->first())
            {
                $versions = $song->getVersions();
        	   return View::make('song.profile', array('song' => $song, 'versions' => $versions ));
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
        $user = Auth::User();
        $user_id = $user->getId();
        $file['user_id'] = $user_id;
        //test code to see what file is
        // var_dump($file);
        // die(); 

        if($validator = $song->validate($file)->passes()) {

            if(Input::hasFile('songfile')){
                $songname = $file['songname'];
                $song_file = $file['songfile'];
                $project_zip = $file['projectfile'];
                $pic_file = $file['artfile'];
                $dest = '/var/www/gitmusic/uploads';
                $filename = $songname . '.mp3';
                $zipname = $songname . '.zip';
                $picname = $songname . '.jpg';
                $song_file->move($dest, $filename);
                $project_zip->move($dest, $zipname);
                $pic_file->move($dest, $picname);
                $destination_filepath = $dest . '/' . $filename;
                $destination_filepath_zip = $dest . '/' . $zipname;
                $destination_filepath_pic = $dest . '/' . $picname;
                $create_song = Song::create(array(
                    'songname' => $songname,
                    'user_id' => $user_id,
                    'genre' => 'shit',
                    'tags' => 'hip hop'
                ));

                $create_song->sendToS3($destination_filepath, $user, $filename);
                $create_song->sendToS3($destination_filepath_zip, $user, $zipname);
                $create_song->sendToS3($destination_filepath_pic, $user, $picname);
                return Redirect::route('songProfile', array($user, $songname));    
            } else {
                return Redirect::route('upload')
                        ->withErrors($validator)
                        ->withInput();
            }          
        } else {
            return Redirect::route('upload')
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    public function like()
    {
        $new = Input::all();
        $song_like = new SongLike();
        $user_id = Auth::user()->getId();
        $new['user_id'] = $user_id;

        if ($validator = $song_like->validate($new)->passes())
        {
            $song_id = $new['song_id'];
            if ($song_duplicate = SongLike::where('user_id', '=', $user_id)->where('song_id', '=', $song_id)->get()) { // User has not already liked the song
                $song_like = SongLike::create($new);
                $song = Song::find($song_id);
                $song->incrementLikes();
                return 'Success'; // 200
            } else {
                return 'error'; // 404
            }
        }
        else
        {
            return 'error'; 
        }
    }

     public function showUpload()
    {
        return View::make('upload');
    }

    public function showExplore()
    {
        $genres = Genre::all();
        $songs = Song::newest()->take(10)->get();
        return View::make('explore', array('genres' => $genres, 'songs' => $songs));
    }

    public function getGenreSongs($type, $genre_id)
    {
        if($genre = Genre::find($genre_id) && in_array($type, self::$FILTER_TYPES)) {
            return Song::getSongsByGenre($type, $genre_id);
        } else {
            App::abort(404);
        }
    }

}