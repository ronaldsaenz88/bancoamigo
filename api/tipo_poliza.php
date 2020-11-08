<?php
class TipoPoliza
{
	private $conn;
	private $table_name = "tipo_poliza";
	private $id;
	private $nombre;
	private $estado;
	private $usuario_creacion;
	private $fecha_creacion;
	private $ip_creacion;

	//constructor
	public function __construct($db)
	{
		$this->conn = $db;
	}

	function readByNombre($nombre)
 	{
 		// select all query
	    $query = "SELECT
	                id
	            FROM
	                " . $this->table_name . " 
	            WHERE estado = 'ACTIVO' and nombre = '".$nombre."';";
        
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
}
?>