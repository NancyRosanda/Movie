<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $timestamps= false;
    
    public function movie(){
        return $this->belongsTo('App\Movie','genre_id');
    }
}
