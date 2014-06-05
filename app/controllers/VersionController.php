<?php

class VersionController extends BaseController {

	public function versionUpload()
	{
        $file = Input::all();
        $zip = $file['projectfile'];
        $mp3 = $file['songfile'];
        $parent_song = $file['parentfile'];
        $user = Auth::user();
        $song = $file['song_id'];
        
	}
}