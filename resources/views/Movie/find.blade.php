@extends ('welcome')

@section('title', 'Movies')

<body>
    
<form method="POST" action="">
    
@section ('content')  
 
<h3>Movies: </h3>
<br>

    @foreach ($movie->sortby('title') as $m)
     
    <div class='content' id="{{ $m->id }}">
            
        <img src="{{ asset ('/public/image/'.$m->pic) }}" width="150" height="200"><br>
        <i>{{ $m->title }}, {{ $m->year }}</i><br>
        <i>Length: {{ $m->length }}</i><br><br>
        </div>

    @endforeach
    <h4>Haven't found what you're looking for?
    <a href="/movie/create">Add movie!</a>
    Or go <a href="/movie"> back </a></h4>
    @endsection   
</form>
</body>
</html>