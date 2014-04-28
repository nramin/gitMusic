<html>
    <body>
        <h1></h1>
        <p>{{ $user->username }}</p>
        <ul>
  			@foreach ($user->songs as $song)
    			<li>{{ $song->songname }}</li>
  			@endforeach
		</ul>
    </body>
</html>