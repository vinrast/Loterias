<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps=false;
    protected $table="usuarios";
    protected $fillable=['id','username','password','perfil_id'];

   
}
