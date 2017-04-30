<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public $timestamps=false;
    protected $table="perfiles";
    protected $fillable=['id','descripcion'];

 
  public function vistas()
    {
    	 return $this->belongsToMany('App\Vista');
    }
}
