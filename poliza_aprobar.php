<?php

require_once "conexion.php";
require_once "conexion_queries.php";
$conex_bd = Conexion::conectar();

if($_REQUEST)
{
  $usuario_creacion = "admin";
  if(session_id()=="")
  {
      session_start();
      $usuario_creacion = $_SESSION["login"];
  }

  $id_poliza = $_REQUEST["id_poliza"];
  if($id_poliza){
    //Actualizar Poliza
    $datos_actualizar = Crud_Poliza::aprobar($conex_bd, $usuario_creacion, $id_poliza);
  }

  $newURL = '/';
  header('Location: '.$newURL);
}
?>
