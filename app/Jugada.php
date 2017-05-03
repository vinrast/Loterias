<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugada extends Model
{
    public $timestamps=false;
    protected $table="jugadas";
    protected $fillable=['id','numero','tipo','acumulado'];


public function tickets()
    {
    	 return $this->belongsToMany('App\Ticket');
    }


}

