<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_pago extends Model
{
  	public $timestamps=false;
    protected $table="t_pagos";
    protected $fillable=['primer_p','segundo_p'];  //
}
