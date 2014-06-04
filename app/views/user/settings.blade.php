@extends('layouts.loggedin.master')

@section('content')
	{{ HTML::script('assets/js/settings.js') }}
	<div id="settings">
	    <h1>Settings</h1>
	    <div class="avatar-upload-container">
	    	<h2>Upload an avatar</h2>
	    	<div class="avatar-upload-photo"><img width="100px" height="100px" src="{{ asset('avatar/avatar.png') }}" /></div>
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