<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vista extends Model
{
    public $timestamps=false;
    protected $table="vistas";
    protected $fillable=['id','descripcion','ruta'];
}
