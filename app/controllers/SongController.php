<?php

class SongController extends BaseController {

    /**
     * Show the profile for the given song.
     */

    public static $FILTER_TYPES = array('hottest', 'newest', 'popular');

    public static $jsonError = array(
                    'status' => 'error',
                    'message' => 'An error occurred!'
                );

    public function index($username, $songname)
    {
        if($user = User::where('pretty_username', '=', $username)->first())
        {
            if($song = Song::where('pretty_songname', '=', $songname)->where('user_id', '=', $user->getId())->first())
            {
                //$versions = $song->getVersions();
        	   //return View::make('song.profile', array('song' => $song, 'versions' => $versions ));
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
                $songname_nospaces = preg_replace("![^a-z0-9]+!i", "-", $songname);
                $song_file = $file['songfile'];
                $project_zip = $file['projectfile'];
                $pic_file = $file['artfile'];
                $genre_id = 1; // Default
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
                if(isset($file['genre'])) {
                    $genre = $file['genre'];
                    $genre_object = Genre::where('display_name', '=', $genre)->firstOrFail();
                    $genre_id = $genre_object->getId();
                }
                $create_song = Song::create(array(
                    'songname' => $songname,
                    'user_id' => $user_id,
                    'genre_id' => $genre_id,
                    'tags' => 'hip hop',
                    'pretty_songname' => $songname_nospaces
                ));

                $create_song->sendToS3($destination_filepath, $user, $filename); //MP3
                $create_song->sendToS3($destination_filepath_zip, $user, $zipname); //Zip
                $create_song->sendToS3($destination_filepath_pic, $user, $picname); //Picture
                return Redirect::route('songProfile', array($user->pretty_username, $songname_nospaces));    
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

    // public function versionUpload()
    // {
    //     $file = Input::all();
    //     $zip = $file['projectfile'];
    //     $mp3 = $file['songfile'];
    //     $parent_song = $file['parentfile'];
    //     $user = Auth::user();
    //     $song = $file['song_id'];


    // }

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
                return Response::json(array('message' => 'Successfully Liked Song'), 200);
            } else {
                return Response::json(self::$jsonError, 500);
            }
        }
        else
        {
            return Response::json(self::$jsonError, 500); 
        }
    }

     public function showUpload()
    {
        $genres = Genre::all();
        return View::make('upload', array('genres' => $genres));
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
            return Response::json(self::$jsonError, 500);
        }
    }

}