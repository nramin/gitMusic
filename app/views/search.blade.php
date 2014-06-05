@extends('layouts.loggedin.master')

@section('sidebar')
    @parent
@stop

@section('content')
{{ HTML::style('assets/css/loggedin/homepage-player.css') }}
<div class="search-results">
	<div class="search-result-artist">
		<div class="artist">Caribou</div>

	</div>
	<div class="search-result-song">
          <div class='song'>
          	<div class="songLine">
            	<h2 class='songHeader'></h2>
            	<p class='songByline'>By<br></p>
            </div>
	            <div class='box' style="">
	              <div class='songInfo'>
	              	<div id="songpage-player">
     					<div class="ui360 ui360-vis"><a href=""></a></div>
    				</div>
	                <a href=""><img class="download" src="{{ asset('assets/img/downloadWhite.png') }}" alt="Download" /></a>
	              </div>
	            </div>
          </div>
	</div>
</div>

{{ print_r($results) }}

@stop