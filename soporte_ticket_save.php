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

  //Crear Soporte Ticket
  $datos_create_ticket = Crud_SoporteTicket::insertar($conex_bd, $usuario_creacion, $_REQUEST["ticket_mensaje"]);

  $newURL = '/';
  header('Location: '.$newURL);
}
?>
