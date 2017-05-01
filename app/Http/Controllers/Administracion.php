<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Pare;
use App\Usuario;
use DB;


class Administracion extends Controller{
  public function listar_usuarios(){
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $usuarios=DB::table('usuarios')->get();
    return view('administracion.usuarios',['modulos'=>$modulos,'submodulos'=>$submodulos,'usuarios'=>$usuarios]);
  }

  public function insertarUsuarios()
  {
    $user=strtoupper((string)Request::get('userAgr_'));
    $password=strtoupper((string)Request::get('passwordAgr_'));
    $perfil=Request::get('perfilAgr_');
    $consulta=Usuario::where('username',$user)->first();
    $resultado=[0,null,null];//existe,username,id
    
    if (count($consulta)!=0) //si existe
    {
        $resultado[1]=$consulta->username;
        $resultado[2]=$consulta->id;

    }     
    else//si no existe
    {
      
      $usuario_id=DB::table('usuarios')->insertGetId
          (

            ['username'=>$user,'password'=>$password,'perfil_id'=>$perfil]
          );

        $resultado[0]=1;
        $resultado[1]=$user;
        $resultado[2]=$usuario_id;

    }

    return($resultado);




  }


  public function listar_loterias()
  {
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $sorteos=DB::table('sorteos')->get();
    $maximas=DB::table('maximas')->first();
    return view('administracion.loterias',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos,'maximas'=>$maximas]);
  }
  public function config_premio(){
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $quiniela=DB::table('premios')->where('id',1)->first();
    $pale=DB::table('premios')->where('id',2)->first();
    $tripleta=DB::table('premios')->where('id',3)->first();
    return view('administracion.configpremios',['modulos'=>$modulos,'submodulos'=>$submodulos,'quiniela'=>$quiniela,'pale'=>$pale,'tripleta'=>$tripleta]);
  }

  public function registro_actual(){
    $id=Request::get('datos');
    $consulta=DB::table('usuarios')->where('id','=',$id)->first();
    if (count($consulta)==1) {
      $respuesta =  array(  $consulta->username,
                            $consulta->password,
                            $consulta->perfil_id,
                            1
                    );
    }
    else{
      $respuesta = 0; 
    }     
      return $respuesta; 
    }
}
