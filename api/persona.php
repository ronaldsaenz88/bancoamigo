<?php

class Persona
{
	private $conn;
	private $table_name = "persona";

	public $id;
	public $tipo_persona_id;
	public $nombres;
	public $cedula;
	public $fecha_nacimiento;
	public $lugar_nacimiento;
	public $lugar_domicilio;
	public $domicilio;
	public $telefono;
	public $estado;
	public $usuario_creacion;
	public $fecha_creacion;
	public $ip_creacion;

	//constructor
	public function __construct($db)
	{
		$this->conn = $db;
	}

 	function read()
 	{
 		// select all query
	    $query = "SELECT
	                id, nombres, cedula, lugar_domicilio, domicilio
	            FROM
	                " . $this->table_name . " p
	            WHERE estado = 'ACTIVO'
	            ORDER BY
	                p.fecha_creacion DESC;";
        
        try
        {
        	$result = mysqli_query($this->conn, $query);
        }
        catch(Exception $e)
        {
        	echo ("Error:".$e->getMessage());
        }

	    return $result;
 	}

 	function readByCedula($cedula)
 	{
 		// select all query
	    $query = "SELECT
	                id, nombres, cedula, lugar_domicilio, domicilio
	            FROM
	                " . $this->table_name . " p
	            WHERE estado = 'ACTIVO' and cedula = '".$cedula."'
	            ORDER BY
	                p.fecha_creacion DESC;";
        
        try
        {
        	$result = mysqli_multi_query($this->conn, $query);
        }
        catch(Exception $e)
        {
        	echo ("Error:".$e->getMessage());
        }

	    return $result;
 	}

 	function create($arrayParametros)
 	{
		$fecha = new \DateTime('now');
		$ipaddress = $_SERVER["REMOTE_ADDR"];

 		$query = "INSERT INTO persona (tipo_persona_id, nombres, cedula, fecha_nacimiento, lugar_nacimiento, lugar_domicilio, domicilio, telefono, estado, usuario_creacion, fecha_creacion, ip_creacion) 
 		VALUES (2,'".$arrayParametros['nombres']."','".$arrayParametros['cedula']."','".$arrayParametros['fecha_nacimiento']."','".$arrayParametros['lugar_nacimiento']."','".$arrayParametros['lugar_domicilio']."','".$arrayParametros['domicilio']."','".$arrayParametros['telefono']."','ACTIVO','".$arrayParametros['usuario_creacion']."','".$fecha->format( 'Y-m-d H:m:s' )."','".$ipaddress."')";

 		if (mysqli_query($this->conn, $query)) 
 		{
	  		return true;
		} 
		else 
		{
		  	echo "Error: " . $query . "<br>" . mysqli_error($this->conn);
		  	return false;
		}

 	}
}

?>