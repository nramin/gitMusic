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
		foreach ($songs as $song) {
			return DB::select(DB::raw('jaro_winkler_similarity($song->songname, $term) AS score'));
		}
	}
	

}