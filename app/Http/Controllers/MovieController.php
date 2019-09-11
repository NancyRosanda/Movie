<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        $movie = Movie::all();
        $genre = Genre::all(); 
        $letters = Movie::selectRaw('substr(title,1,1) as first')->pluck('first')->all();
        $letters  = array_map('strtoupper', $letters );
        $letters=array_values(array_unique($letters, SORT_LOCALE_STRING));
        
        return view('movie.index', compact('movie', 'genre', 'letters'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $movie = Movie::all();
        $genre = Genre::all();
        
        return view ('movie.create', compact('movie', 'genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->genre_id = $request->input('genre_id');
        $movie->year = $request->input('year');
        $movie->length = $request->input('length');
        try {
            $imageExtension = $request->pic->getClientOriginalExtension();
            $imageName = $movie->title . '.' . $imageExtension;
            $movie->pic = $imageName;
            $request->pic->move('public/image/', $imageName);
        } catch (Exception $e) {
            
        }
        $movie->save();
        Session::flash('message', 'Movie successfully added!');
        return redirect('movie/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  Movie  $movie
     * @return Response
     */
    
    public function find($letter){
        $movie= Movie::where('title', 'LIKE', $letter.'%')->get();
        return view ("movie.find", ['movie' => $movie]);
    }

    public function edit(Movie $movie) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Movie  $movie
     * @return Response
     */
    public function update(Request $request, Movie $movie) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Movie  $movie
     * @return Response
     */
    public function destroy(Movie $movie) {
        $movie->delete();
        Session::flash('warning', 'Movie deleted!');
        return redirect('movie/create');
    }

}
