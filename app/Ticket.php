<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps=false;
    protected $table="tickets";
    protected $fillable=['id','numero','fecha','usuario_id'];

    public function transacciones()
    {
    	 return $this->hasMany('App\Transaccion');
    }

    public function usuario()
    {
    	 return $this->belongsTo('App\Usuario');
    }



}

