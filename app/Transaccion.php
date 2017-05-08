<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
   	public $timestamps=false;
    protected $table="transacciones";
    protected $fillable=['id','jugada_id','sorteo_id','apuesta_id','ticket_id'];

    public function ticket()
    {
    	 return $this->belongsTo('App\Ticket');
    }
}
