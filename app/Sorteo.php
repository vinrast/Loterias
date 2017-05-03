<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    public $timestamps=false;
    protected $table="sorteos";
    protected $fillable=['id','descripcion','horaSorteo','tiempoCierre'];
}

