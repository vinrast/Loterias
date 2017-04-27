<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $timestamps=false;
    protected $table="Usuarios";
    protected $fillable=['id','username','password'];

    public function vistas()
    {
    	 return $this->belongsToMany('App\Vista');
    }
}
