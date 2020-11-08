<?php

require_once "conexion.php";
require_once "conexion_queries.php";
$conex_bd = Conexion::conectar();

if($_REQUEST)
{
  $usuario_creacion = $_REQUEST["poliza_usuario"];
  if(session_id()=="")
  {
      session_start();
      $usuario_creacion = $_SESSION["login"];
  }

  $cedula = $_REQUEST["persona_cedula"];
  $datos_persona = Crud_Persona::getByCedula($conex_bd, $cedula);
  if($datos_persona){
    //Crear Poliza
    $datos_create_poliza = Crud_Poliza::insertar($conex_bd, $_REQUEST["poliza_usuario"], $_REQUEST["poliza_tipo"], $_REQUEST["poliza_agencia"], $datos_persona["id"], $_REQUEST["poliza_monto"], $_REQUEST["poliza_fecha_caducidad"]);
  }
  else {
    //Crear Persona
    $datos_create_persona = Crud_Persona::insertar($conex_bd, $_REQUEST["poliza_usuario"], $_REQUEST["persona_tipo"], $_REQUEST["persona_nombres"], $cedula, $_REQUEST["persona_fecha_nacimiento"], $_REQUEST["persona_lugar_nacimiento"], $_REQUEST["persona_direccion_ciudad"], $_REQUEST["persona_direccion"], $_REQUEST["persona_telefono"]);
    if($datos_create_persona){
      $datos_persona = Crud_Persona::getByCedula($conex_bd, $cedula);
      if($datos_persona){
        //Crear Poliza
        $datos_create_poliza = Crud_Poliza::insertar($conex_bd, $_REQUEST["poliza_usuario"], $_REQUEST["poliza_tipo"], $_REQUEST["poliza_agencia"], $datos_persona["id"], $_REQUEST["poliza_monto"], $_REQUEST["poliza_fecha_caducidad"]);

      }
    }
  }


  $newURL = '/';
  header('Location: '.$newURL);
}
?>
