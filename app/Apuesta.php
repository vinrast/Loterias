<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apuesta extends Model
{
    public $timestamps=false;
    protected $table="apuestas";
    protected $fillable=['id','cantidad'];
}
