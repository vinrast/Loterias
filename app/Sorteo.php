<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    public $timestamps=false;
    protected $table="sorteos";
    protected $fillable=['id','descripcion','loteria_id'];

    public function jugadas()
    {
        return $this->hasMany('App\Jugada');
    }

    public function loteria()
    {
        return $this->belongsTo('App\Loteria');
    }
}
