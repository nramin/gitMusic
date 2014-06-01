@extends('layouts.loggedin.master')

@section('content')
	<div id="upload-box">
		<form method="post" action={{ route('upload') }} enctype="multipart/form-data">
			<div id="upload-left">
				<h1>Files</h1>
				<input type="text" class="text-field" name="songname" placeholder="Song Name" id="songname">
				<input type="file" class="file-field" name="projectfile" accept="application/zip" id="fileProject">
				<div id="choose-project">Choose project</div>
				<input type="file" class="file-field" name="songfile" accept="audio/*" id="file">
				<div id="choose-file">mp3/wav</div>
				<input type="file" class="file-field" name="artfile" accept="image/*" id="albumArt">
				<div id="choose-art">Artwork</div>
			</div>
			<div id="upload-right">
				<h1>Genres</h1>        
				<div id="genre-container">
					<div>
						<input type="radio" name="radSize" id="sizeSmall" value="small" checked="checked" /><label for="sizeSmall" class="radio-field">Parisian Lemon Orgy</label>
					</div>
					<div>
						<input type="radio" name="radSize" id="sizeMed" value="medium" /><label for="sizeMed" class="radio-field">Iranian Ass-Rock</label>
					</div>
					<div>
						<input type="radio" name="radSize" id="sizeLarge" value="large" /><label for="sizeLarge" class="radio-field">Belgian Blue Waffles</label>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<input type="submit" value="Upload" class="button" id="submit">
		</form>
	</div>
@stop
