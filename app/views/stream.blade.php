@extends('layouts.loggedin.master')

@section('content')
    <h1>Stream {{ $type }}</h1>
    @if ($type === 'new')
    	<h2>{{ HTML::linkRoute('stream', 'hot' , array('hot')) }}</h2>
    @else
    	<h2>{{ HTML::linkRoute('stream', 'new' , array('new')) }}</h2>
    @endif

    <h3>Songs:</h3>
    <ul>
			@foreach ($songs as $song)
			<li>{{ HTML::linkRoute('songProfile', $song->songname , array($song->user->username, $song->songname)) }}</li>
			@endforeach
	</ul>
@stop