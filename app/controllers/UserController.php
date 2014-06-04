<?php

class UserController extends BaseController {

    /**
     * Show the profile for the given user.
     */
    public function index($username)
    {
        if($user = User::where('pretty_username', '=', $username)->first()) 
        {
            return View::make('user.profile')->with('user', $user);
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }

    public function showSettings()
    {
        return View::make('user.settings');
    }

    public function showUsers()
    {
        $users = User::all();
        return View::make('user.users')->with('users', $users);
    }

    public function getFollowers($username)
    {
        if($user = User::getUserByName($username)) 
        {
            $followers = $user->getFollowers($user->getId());
            return View::make('user.followers', array('followers' => $followers, 'user' => $user));
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }

    public function getFollowing($username)
    {
        if($user = User::getUserByName($username)) 
        {
            $following = $user->getFollowing($user->getId());
            return View::make('user.following', array('following' => $following, 'user' => $user));
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }

    public function getLikedSongs($username)
    {
        if($user = User::getUserByName($username)) 
        {
            $liked = $user->getLikedSongs();
            return View::make('user.likedSongs', array('likedSongs' => $liked, 'user' => $user));
        }
        return View::make('errors.userNotFound', array('username' => $username));
    }

    public function profilePic()
    {
        $user = Auth::user();
        $file = Input::all();
        if(Input::hasFile('avatar-image')){
            $img = $file['avatar-image'];
            $dest = '/var/www/gitmusic/public/avatars';
            $avatar_filename = $user->username . '_avatar' . '.jpg';
            $destpath = $dest . '/' . $avatar_filename;
            $img->move($dest, $avatar_filename);
            $img = Image::make($destpath); //->resize(720, 500)->save($destination_filepath_pic_large);
            $resize_image_small = $user->username . '_avatar_small' . '.jpg';
            $resize_image_large = $user->username . '_avatar_large' . '.jpg';
            $small_filepath = $dest . $resize_image_small;
            $large_filepath = $dest . $resize_image_large; 
            $img->fit(100)->save($small_filepath);
            $img->fit(750)->save($large_filepath);
        }


    }











}