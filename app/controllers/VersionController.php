<?php

class VersionController extends BaseController {

	public function versionUpload()
	{
        $file = Input::all();
        $zip = $file['projectfile'];
        $mp3 = $file['songfile'];
        $parent_song_id = $file['parentfile'];
        $user = Auth::user();
        $song_id = $file['song_id'];
        $song = Song::find($song_id);
        $dest = '/var/www/gitmusic/uploads';
        $existing_versions = Version::where('song_id', '=', $song_id)->count();
        $version_number = $existing_versions + 1;
        $version_string = strval($version_number);
        $pretty_songname = $song->pretty_songname;
        $filename = $pretty_songname . '_' . $version_string . '.zip';
        $zipname = $pretty_songname . '_' . $version_string . '.zip';
        $picname = $pretty_songname . '_' . $version_string . '.zip';

        $create_versions = Version::create(array(
                    'user_id' => $user_id,
                    'song_id' => $song_id,
                    'version_number' => $version_number,
                    'url' => 
                ));

	}
}