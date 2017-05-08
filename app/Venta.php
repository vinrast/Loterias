<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public $timestamps=false;
    protected $table="ventas";
    protected $fillable=['id','jugada_id','sorteo_id','apuesta_id','usuario_id']

   

}
