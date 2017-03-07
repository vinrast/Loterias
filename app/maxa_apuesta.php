<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maxa_apuesta extends Model
{
    public $timestamps=false;
    protected $table="maxa_apuesta";
    protected $fillable=['permitido_q','permitido_p','permitido_t'];
}
