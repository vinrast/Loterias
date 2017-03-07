<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class max_apuesta extends Model
{
    public $timestamps=false;
    protected $table="max_apuesta";
    protected $fillable=['quiniela','pale','tripleta'];
}
