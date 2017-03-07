<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps=false;
    protected $table="tickets";
    protected $fillable=['id','hora','fecha','serial'];

    public function jugadas()
    {
        return $this->hasMany('App\Jugada');
    }

}
