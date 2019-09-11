<?php


//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('movie', 'MovieController');
Route::get("movie/find/{letter}", "MovieController@find");