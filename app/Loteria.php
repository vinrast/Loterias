<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loteria extends Model
{
    public $timestamps=false;
    protected $table="loterias";
    protected $fillable=['id','descripcion'];

     public function sorteos()
    {
        return $this->hasMany('App\Sorteo');
    }
}
