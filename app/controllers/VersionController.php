<?php

class VersionController extends BaseController {

	public function versionUpload()
	{
        
        if(Input::hasFile('songfile'))
        {
            $file = Input::all();
            $zip = $file['projectfile'];
            $mp3 = $file['songfile'];
            $user = Auth::user();
            $song_id = $file['song_id'];
            $song = Song::find($song_id);
            $dest = '/var/www/gitmusic/uploads';
            $existing_versions = Version::where('song_id', '=', $song_id)->count();
            $version_number = $existing_versions + 1;
            $version_string = strval($version_number);
            $pretty_songname = $song->pretty_songname;
            $filename = $pretty_songname . '_' . $version_string . '.mp3';
            $zipname = $pretty_songname . '_' . $version_string . '.zip';
            $file->move($dest, $filename);
            $zip->move($dest, $zipname);
            $destination_filepath_file = $dest . '/' . $filename;
            $destination_filepath_zip = $dest . '/' . $zipname;

            $create_versions = Version::create(array(
                'user_id' => $user_id,
                'song_id' => $song_id,
                'version_number' => $version_number,
            ));

            $create_versions->sendToS3($destination_filepath_file, $user, $filename);
            $create_versions->sendToS3($destination_filepath_zip, $user, $zipname);

            return Redirect::route('songProfile', array($user->pretty_username, $songname_nospaces));
        } else {
            echo 'oops';
        }
        

	}
}