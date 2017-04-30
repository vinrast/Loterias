<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
   public $timestamps=false;
   protected $table="premios";
   protected $fillable=['id','primerPremio','segundoPremio','tercerPremio'];
}
