<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maxima extends Model
{
    public $timestamps=false;
    protected $table="maximas";
    protected $fillable=['id','quiniela','pale','tripleta','tiempoCierre'];
}
