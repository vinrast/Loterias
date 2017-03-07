<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pare extends Model
{
    public $timestamps=false;
    protected $table="pares";
    protected $fillable=['id','valor'];

     public function jugadas()
    {
        return $this->belongsToMany('App\Jugada');
    }
}
