<?php
class Conexion
{
  public function conectar()
  {
    require_once "conf.php";
    $usuario = $bd_user;
    $contrasena = $bd_clave;
    try
    {
      $link = mysqli_connect($bd_host, $usuario, $contrasena) or die('No se pudo conectar: ' . mysqli_error());
      mysqli_select_db($link, $bd_name) or die('No se pudo seleccionar la base de datos');

    	#echo "Conexion Exitosa";
    	return $link;
    }
    catch (Exception $e)
    {
      #echo "Fallo la conexion en la BD"; // . $e->getMessage();
      return False;
    }
  }
}
?>
