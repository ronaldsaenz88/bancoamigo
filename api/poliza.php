<?php
class Poliza
{
	private $conn;
	private $table_name = "poliza";

	public $id;
	public $persona_id;
	public $tipo_poliza_id;
	public $agencia_id;
	public $monto;
	public $fecha_emision;
	public $fecha_aprobacion;
	public $fecha_caducidad;
	public $usuario_aprobacion;
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
					    persona.cedula,
					    persona.nombres,
					    persona.lugar_domicilio,
					    persona.domicilio,
					    tipo.nombre tipo_poliza,
					    poliza.id id_poliza,
					    poliza.monto,
					    poliza.fecha_emision,
					    poliza.fecha_caducidad,
					    poliza.estado,
					    agencia.nombre agencia,
					    agencia.ciudad agencia_ciudad
					FROM
					    " . $this->table_name . ",
					    persona,
					    agencia,
					    tipo_poliza tipo
					WHERE
					    poliza.persona_id = persona.id
					        AND poliza.agencia_id = agencia.id
					        AND poliza.tipo_poliza_id = tipo.id
					        AND persona.estado = 'ACTIVO'
					ORDER BY poliza.fecha_caducidad DESC";
        
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

 		$query = "INSERT INTO poliza (persona_id, tipo_poliza_id, agencia_id, monto, fecha_emision, estado, usuario_creacion, fecha_creacion, ip_creacion) VALUES ('".$arrayParametros['persona_id']."','".$arrayParametros['tipo_poliza_id']."','".$arrayParametros['agencia_id']."','".$arrayParametros['monto']."','".$fecha->format( 'Y-m-d H:m:s' )."','".$arrayParametros['estado']."','".$arrayParametros['usuario_creacion']."','".$fecha->format( 'Y-m-d H:m:s' )."','".$ipaddress."');";

 		if (mysqli_query($this->conn, $query)) 
 		{
	  		return true;
		} 
		else 
		{
		  	echo "Error: " . $query . "\n" . mysqli_error($this->conn);
		  	return false;
		}
 	}

 	function authorize($arrayParametros)
 	{
 		$fecha = new \DateTime('now');
 		$clone = $fecha;        //this doesnot clone so:
  		$clone->modify( '+1 year' );

 		$query = "update poliza set estado ='ACTIVO', fecha_aprobacion='".$fecha->format( 'Y-m-d H:m:s' )."', usuario_aprobacion='".$arrayParametros['usuario_aprobacion']."', fecha_caducidad='".$clone->format( 'Y-m-d H:m:s' )."' where id = '".$arrayParametros['id_poliza']."'";

 		if (mysqli_query($this->conn, $query)) 
 		{
	  		return true;
		} 
		else 
		{
		  	echo "Error: " . $query . "\n" . mysqli_error($this->conn);
		  	return false;
		}
 	}
}

?>