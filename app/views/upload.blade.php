@extends('layouts.loggedin.master')

@section('content')
	<div id="upload-dialog">
		<form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
		    <div id="upload-dialog-title">Upload</div>
		    <input type="text" name="songname" placeholder="Song Name" id="songname">
		    <div id="file-container">
		        <input type="file" name="songfile" accept="audio/*" id="file">
		    </div>
		    <input type="submit" value="Upload" id="submit">
		</form>
	</div>
@stop