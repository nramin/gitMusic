@extends('layouts.loggedin.master')

@section('content')
	<div id="upload-dialog">
		<form method="post" action="{{ route('upload') }}">
		    <div id="upload-dialog-title">Upload</div>
		    <input type="text" placeholder="Song Name" id="songname">
		    <div id="file-container">
		        <input type="file" name="song" accept="*" id="file">
		    </div>
		    <input type="submit" value="Upload" id="submit">
		</form>
	</div>
@stop