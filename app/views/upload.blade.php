@extends('layouts.loggedin.master')

@section('content')
	<div id="upload-dialog">
		<form method="post" action="{{ route('upload') }}" enctype="multipart/form-data">
		    <div id="upload-dialog-title">Upload</div>
		    <input type="text" class='uploadField' name="songname" placeholder="Song Name" id="songname">
		    <div id="file-container" class='uploadField'>
		        <input type="file" name="songfile" accept="audio/*" id="file">
		        <input type="file" name="projectfile" accept="application/zip">
		    </div>
		    {{ Form::token() }}
		    <input type="submit" value="Upload" id="submit">
		</form>
	</div>
@stop
