<?php

class FollowController extends BaseController {


	public function postFollow()
	{
		$new = Input::all();
        $user_id = Auth::user()->getId();
        $new['follower_id'] = $user_id;
        $follow = new Follow();

        if ($validator = $follow->validate($new)->passes())
        {
            $follow = Follow::create($new);
            $user = User::find($new['user_id']);
            $user->incrementFollowers();
        }
        else
        {
            return 'error';
        }
	}

	public function delete($id) {
        if($follow = Follow::find($id)) {
            $follow->delete();
        }
    }

}
