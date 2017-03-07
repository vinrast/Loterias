<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P_pago extends Model
{
    public $timestamps=false;
    protected $table="p_pagos";
    protected $fillable=['primer_p','segundo_p','tercer_p'];
}
