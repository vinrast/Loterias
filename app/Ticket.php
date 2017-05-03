<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps=false;
    protected $table="tickets";
    protected $fillable=['id','numero','fecha','vendedor'];

public function jugadas()
    {
    	 return $this->belongsToMany('App\Jugada);
    }

}

