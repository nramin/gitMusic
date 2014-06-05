@extends('layouts.loggedin.master')

@section('sidebar')
    @parent
@stop


@section('content')
    {{ HTML::style('assets/css/loggedin/homepage-player.css') }}
    @if (sizeof($genres) < 1)
        <p>No Genres :(</p>
    @else
            <div id='genreHolder'>
                <ul class="genreExplore">
                    <li>Trending Music</li>
                    <li>New Music</li>
                
                @foreach ($genres as $genre)
                    <li data-GenreId="{{ $genre->id }}"> {{ $genre }} </li>
                @endforeach
                </ul>
            </div>
    @endif

        <div class='exploreContent'> 
            <h1 id='exploreHeader'>Explore</h1>
            <div id='songHolder'>
            @foreach ($songs as $song)
                <div class='song'>
                <div class="songLine">
                    <h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user->pretty_username, $song->pretty_songname)) }}</h2>
                    <p class='songByline'>By<br>{{$user->username}}</p>
                </div>
                <?php  $count = 0; ?>
                @if($count < 2)
                    @if (isset($song->pic_url))
                        <?php $pic_url = $song->pic_url;?>
                        <div class='box' style="background-image: url('{{ $pic_url }}')">
                          <div class='songInfo'>
                            <div id="songpage-player">
                                <div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
                            </div>
                            <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
                          </div>
                        </div>
                    @else
                        <div class='box' style="background-image: url('{{ URL::asset('assets/img/jfk.jpg') }}')">
                          <div class='songInfo'>
                            <div id="songpage-player">
                                <div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
                            </div>
                            <a href="{{ $song->zip_url }}"><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
                          </div>
                        </div>
                    @endif
                    <?php $count++ ?>
                @endif
              </div>
            @endforeach
            </div>
        </div>
@stop