@extends('layouts.loggedin.master')

@section('content')
	<div id="upload-dialog">
		<form method="post" action={{ route('upload') }} enctype="multipart/form-data">
		    <div id="upload-dialog-title">Upload</div>
		    <input type="text" class='uploadField' name="songname" placeholder="Song Name" id="songname" required>
		  
		    <input type="file" class='uploadField file-container fileShaft' name="songfile" accept="audio/*" id="file" required>
		
		    <input type="file" class='fileShaft' name="projectfile" accept="application/zip" id='fileProject' required>

		    <input type="file" class='fileShaft' name="artfile" accept="image/*" id='albumArt' required>
		    
		    {{ Form::token() }}
		    <input class='uploadField' type="submit" value="Upload" id="submit">
		</form>
	</div>
@stop
