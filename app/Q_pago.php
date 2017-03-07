<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Q_pago extends Model
{
    public $timestamps=false;
    protected $table="q_pagos";
    protected $fillable=['primer_p','segundo_p','tercer_p'];
}
