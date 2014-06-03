@extends('layouts.loggedin.master')

@section('sidebar')
    @parent
@stop


@section('content')
    <h1>Explore</h1>
    @if (sizeof($genres) < 1)
        <p>No Genres :(</p>
    @else
        <div class="sidebar-menu-title"></div>
            <div id='genreHolder'>
                <ul class="genreExplore">
                    <li>Trending Music</li>
                    <li>New Music</li>
                
                @foreach ($genres as $genre)
                    <li> {{ $genre }} </li>
                @endforeach
                </ul>
            </div>
    @endif

            
            <div id='songHolder'>
            @foreach ($songs as $song)
                <div class='song'>
                <div class="songLine">
                    <h2 class='songHeader'>{{ HTML::linkRoute('songProfile', $song, array($song->user->pretty_username, $song->pretty_songname)) }}</h2>
                    <p class='songByline'>By<br>Lady the Beard</p>
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
                            <img class='download' src='download.png' alt='chill' />
                          </div>
                        </div>
                    @else
                        <div class='box' style="background-image: url('{{ URL::asset('assets/img/jfk.jpg') }}')">
                          <div class='songInfo'>
                            <div id="songpage-player">
                                <div class="ui360 ui360-vis"><a href="<?php echo $song->url ?>"></a></div>
                            </div>
                            <img class='download' src='download.png' alt='chill' />
                          </div>
                        </div>
                    @endif
                    <?php $count++ ?>
                @endif
              </div>
            @endforeach
            </div>
@stop