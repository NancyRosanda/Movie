@extends ('welcome')

@if (Session::has('error'))
<div class="alert alert-error">{{ Session::get('error') }}</div>
@endif

@if (Session::has('warning'))
<div class="alert alert-error">{{ Session::get('warning') }}</div>
@endif

@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@section ('title','Add Movie')

<h3>Add movie: </h3><br>

@section('content')

<form method="POST" action="/movie" enctype="multipart/form-data">
    
    @csrf
    Title:
    <input type="text" maxlength="150" required="true" value="{{ old('title') }}" name="title"><br>
    Genre:
    <select name="genre_id" value="{{ old('genre_id') }}">
        @foreach ($genre as $g)
        <option value="{{ $g->id }}">{{ $g->name }}</option>
        @endforeach
    </select>
    <br>
    Year:
    @component ('/components.year')
    @endcomponent
    <br>
    Length:
    <input type="text" maxlength="50" required="true" value="{{ old('length') }}" name="length"><br>
    Pic:
    <input type="file" required="true" value="{{ old('pic') }}" name="pic"><br>
    <input type="submit" name="dodaj" value="Add Movie">
</form>

<br><a href='/movie'>Go back</a><br>

<table border="1" width="800">
    
    <th>Picture</th>
    <th>Title</th>
    <th>Year</th>
    <th>Length</th>
    <th>Action</th>


    @foreach ($movie->sortby('title') as $m)
    <tr>

        <td><img src="{{ asset ('/public/image/'.$m->pic) }}" width="150" height="200"></td>
        <td>{{ $m->title }}</td>
        <td>({{ $m->year }})</td>
        <td>{{ $m->length }}</td>
        <td>
            <form method="POST" style="display: inline" action="{{url("/movie/{$m->id}")}}">
                @csrf
                <input type='hidden' name='_method' value='DELETE'>
                <button type='submit' name='delete' value="delete" >Delete</button>
            </form>
        </td>
    </tr> 
    @endforeach 

</table>

<br><br>

<h5><a href='/movie'>Go back </a><br>  Or <a href="#"> go up</a></h5>

@endsection

