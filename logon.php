<?php

require_once "conexion.php";
require_once "conexion_queries.php";
$conex_bd = Conexion::conectar();

if($_REQUEST)
{
  $usuario = isset($_REQUEST["usuario"]) ? $_REQUEST["usuario"] : '';
  $clave = isset($_REQUEST["clave"]) ? $_REQUEST["clave"] : '';
  if($usuario and $clave)
  {
    $clave_hash = md5($clave);
    $datos_usuario = Crud_Usuario::login_query($conex_bd, $usuario, $clave_hash);
    if($datos_usuario)
    {
      if(session_id()=="")
      {
        session_start();
        $_SESSION['time']   = time();
        $_SESSION['login'] = $datos_usuario["login"];
        $_SESSION['nombres'] = $datos_usuario["nombres"];

      }

      $newURL = '/index.php';
      header('Location: '.$newURL);
    }
    else{
      $newURL = '/login.php';
      //header('Location: '.$newURL);
    }
  }
  else {
    $newURL = '/login.php';
    header('Location: '.$newURL);
  }
}
