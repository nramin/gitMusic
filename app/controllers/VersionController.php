<?php

class VersionController extends BaseController {

	public function versionUpload()
	{
        //$file = Input::all();
        //die(var_dump($file));
        //if(Input::hasFile('songfile'))
        //{
            $file = Input::all();
            $zip = $file['projectfile'];
            $mp3 = $file['songfile'];
            $user = Auth::user();
            $user_id = $user->getId();
            $song_id = $file['song_id'];
            $song = Song::find($song_id);
            $dest = '/var/www/gitmusic/uploads';
            $existing_versions = Version::where('song_id', '=', $song_id)->count();
            $version_number = $existing_versions + 1;
            $version_string = strval($version_number);
            //die(var_dump($version_string));
            $pretty_songname = $song->pretty_songname;
            //die(var_dump($pretty_songname));
            $filename = $pretty_songname . '_' . $version_string;
            $filename_extension = $filename . '.mp3';
            //die(var_dump($filename_extension));
            $zipname = $pretty_songname . '_' . $version_string; 
            $zipname_extension = $zipname . '.zip';
            //die(var_dump($zipname_extension));
            $mp3->move($dest, $filename_extension);
            $zip->move($dest, $zipname_extension);
            //Input::file('name')->move($destinationPath);
            $destination_filepath_file = $dest . '/' . $filename_extension;
            //die(var_dump($destination_filepath_file));
            $destination_filepath_zip = $dest . '/' . $zipname_extension;
            //die(var_dump($destination_filepath_zip));

            $create_versions = Version::create(array(
                'user_id' => $user_id,
                'song_id' => $song_id,
                'version_number' => $version_number
            ));
            //die(var_dump($create_versions));
            $create_versions->sendToS3($destination_filepath_file, $user, $filename_extension);
            $create_versions->sendToS3($destination_filepath_zip, $user, $zipname_extension);
            return true;
            //return Redirect::route('songProfile', array($user->pretty_username, $songname_nospaces));
        //} else {
            //echo 'oops';
        //}
        

	}
}