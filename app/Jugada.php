<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugada extends Model
{
    public $timestamps=false;
    protected $table="jugadas";
    protected $fillable=['id','quiniela','pale','tripleta','apuesta','tipo','ticket_id','sorteo_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }


    public function pares()
    {
        return $this->belongsToMany('App\Pare');
    }

    public function sorteo()
    {
        return $this->belongsTo('App\Sorteo');
    }

}
