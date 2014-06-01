@extends('layouts.loggedin.master')

@section('sidebar')
    @if (sizeof($genres) < 1)
        <p>No Genres :(</p>
    @else
        <div class="sidebar-menu-title"></div>
            <div class="sidebar-menu-item">
                <p>Trending Music</p>
                <p>New Music</p>
            </div>
            @foreach ($genres as $genre)
            <div class="sidebar-menu-item">
                <p> {{ $genre }} </p>
            </div>
            @endforeach
    @endif
@overwrite

@section('content')
    <h1>Explore</h1>
    <ul>
            @foreach ($songs as $song)
            <li>{{ HTML::linkRoute('songProfile', $song->songname , array($song->user->username, $song->songname)) }}</li>
            @endforeach
    </ul>
@stop