<?php
class Agencia
{
	private $conn;
	private $table_name = "agencia";
	private $id;
	private $nombre;
	private $ciudad;
	private $estado;
	private $usr_creacion;
	private $fe_creacion;
	private $ip_creacion;

	//constructor
	public function __construct($db)
	{
		$this->conn = $db;
	}

	function readByCiudad($ciudad)
 	{
 		// select all query
	    $query = "SELECT
	                id
	            FROM
	                " . $this->table_name . " 
	            WHERE estado = 'ACTIVO' and ciudad = '".$ciudad."';";
        
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