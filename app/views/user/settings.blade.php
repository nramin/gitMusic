@extends('layouts.loggedin.master')

@section('content')
	{{ HTML::script('assets/js/settings.js') }}
	<div id="settings">
	    <h1>Settings</h1>
	    <div class="avatar-upload-container">
	    	<h2>Upload an avatar</h2>
			<div class='artistHeaderHolder'>
			<?php if ($user->hasAvatar()) {
				$avatar = 'avatars/' . $user->pretty_username . '_avatar_small.jpg';
			} else {
				$avatar = 'assets/img/default_small.png';
			} ?>
	    	<div class="avatar-upload-photo"><img src="{{ asset($avatar) }}" /></div>
	    	<div class="avatar-upload-file">
			    <form method="post" action={{ route('settings') }} enctype="multipart/form-data">
			    	<input type="file" class="avatar-image" name="avatar-image" accept="image/*" id="avatar-image">
			    	<div id="avatar-image-button">Choose photo</div>
					{{ Form::token() }}
					<input type="submit" value="Upload" class="button" id="submit">
			    </form>
			</div>
	    </div>
	</div>
@stop