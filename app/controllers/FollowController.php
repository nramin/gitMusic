<?php

class FollowController extends BaseController {


	public function postFollow()
	{
		$new = Input::all();
        $follow = new Follow();

        if ($validator = $follow->validate($new)->passes())
        {
            $follow = Follow::create($new);
        }
        else
        {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
	}

	public function delete($id) {
        if($follow = Follow::find($id)) {
            $follow->delete();
        }
    }

}
