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
		$user_rankings = array();
		$song_rankings = array();
		$username_to_user = array();
		$songname_to_song = array();
		foreach ($songs as $song) {
			$clean_songname = preg_replace("![^a-z0-9]+!i", "", $song->songname);
			$song_score = DB::select(DB::raw("SELECT jaro_winkler_similarity('" . $clean_songname . "','" . $term . "') AS score"));
			$song_rankings[$song->songname] = $song_score;
			$songname_to_song[$song->songname] = $song;
		}
		foreach ($users as $user) {
			$clean_username = preg_replace("![^a-z0-9]+!i", "", $user->username);
			$user_score = DB::select(DB::raw("SELECT jaro_winkler_similarity('" . $user->username . "','" . $term . "') AS score"));
			$user_rankings[$user->username] = $user_score;
			$username_to_suser[$user->username] = $user;
		}
		arsort($song_rankings);
		arsort($user_rankings);
		$keys = array_keys($user_rankings);
		die(var_dump($user_rankings[$keys[0]]));
		$combined_rankings = combineUsersWithSongs($user_rankings, $song_rankings);
		die(intval($user_rankings[0]));
		$results = array();
		foreach ($rankings as $key => $value) {
			# code...
		}
	}

	// private function combineUsersWithSongs($users, $songs)
	// {
	// 	$combined = array();
	//     $i = 0; 
	//     $j = 0; 
	//     $k = 0;
	//     while ($i < count($users) && $j < count($songs))
	//     {
	//         if (intval($users[$i]) > intval($songs[$j]))
	//         {
	//             $combined[$k] = $users[$i];
	//             $i++;
	//         }
	//         else
	//         {
	//             answer[k] = b[j];
	//             j++;
	//         }
	//         k++;
	//     }

	//     while (i < a.length())
	//     {
	//         answer[k] = a[i];
	//         i++;
	//         k++;
	//     }

	//     while (j < b.length())
	//     {
	//         answer[k] = b[j];
	//         j++;
	//         k++;
	//     }

	//     return answer;
	// }
	

}