<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class min_apuesta extends Model
{
    public $timestamps=false;
    protected $table="min_apuesta";
    protected $fillable=['quiniela','pale','tripleta'];
}
