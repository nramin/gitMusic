<html>
    <body>
        <h1>Stream {{ $type }}</h1>
        <h3>Songs:</h3>
        <ul>
  			@foreach ($songs as $song)
    			<li>{{ $song->songname }}</li>
  			@endforeach
		</ul>
    </body>
</html>