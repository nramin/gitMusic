<?php

class CommentController extends BaseController {


	public function postComment()
	{
		$new = Input::all();
        $comment = new Comment();

        if ($validator = $comment->validate($new)->passes())
        {
            $comment = Comment::create($new);
        }
        else
        {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
	}

	public function delete($id) {
        if($comment = Comment::find($id)) {
            $comment->delete();
        }
    }

}
