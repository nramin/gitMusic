<?php

class SearchController extends BaseController {

	public function searchAll($term)
	{
		$user_search_term;
		if(strlen($term) <= 2) {
			$user_search_term = $term;
		} else {
			$user_search_term = substr($term, 0, 2);
		}
		$songs = Song::where('songname', 'LIKE', $user_search_term .'%')->get();
		$users = User::where('username', 'LIKE', $user_search_term .'%')->get();
		$rankings = array();
		$username_to_user = array();
		$songname_to_song = array();
		foreach ($songs as $song) {
			$song_score = DB::select(DB::raw("SELECT jaro_winkler_similarity('" . $song->songname . "','" . $term . "') AS score"));
			$rankings[$song->songname] = $song_score;
			$songname_to_song[$song->songname] = $song;
		}
		foreach ($users as $user) {
			$user_score = DB::select(DB::raw("SELECT jaro_winkler_similarity('" . $user->username . "','" . $term . "') AS score"));
			$rankings[$user->username] = $user_score;
			$username_to_suser[$user->username] = $user;
		}
		arsort($rankings);
		return var_dump($rankings);
	}
	

}