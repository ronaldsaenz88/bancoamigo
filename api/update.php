<?php
// include database and object files
include_once '../conexion.php';
include_once 'persona.php';
include_once 'poliza.php';
include_once 'tipo_poliza.php';
include_once 'agencia.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$conexion = new Conexion();
$db = $conexion->conectar();

// get posted data
$data = json_decode(file_get_contents("php://input"));

//agregar ! antes de subir a producción
if(empty($data->token))
{
	$token = $data->token;	
}
else
{
	// set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "NO TOKEN!")
    );
    die();
}

//validar token
if(validarToken($token))
{
	if(!empty($data->tipoUpdate))
	{
		$tipoUpdate = $data->tipoUpdate;	
	}
	else
	{
		// set response code - 404 Not found
	    http_response_code(404);
	  
	    // tell the user no products found
	    echo json_encode(
	        array("message" => "Por favor indique la consulta que desea realizar")
	    );
	    die();
	}
}
else
{
	// set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Token no válido!")
    );
    die();
}

if($tipoUpdate == "autorizar")
{
	$arrayParametros = array(
								'cedula' => $data->cedula,
								'id_poliza' => $data->id_poliza,
								'usuario_aprobacion' => $data->usuario_aprobacion
							);

	aprobarPoliza($db, $arrayParametros);
}
else if($tipoUpdate == "renovar")
{
	$arrayParametros = array(
								'cedula' => $data->cedula,
								'id_poliza' => $data->id_poliza,
								'usuario_aprobacion' => $data->usuario_aprobacion
							);
}

function aprobarPoliza($db, $arrayParametros)
{
	$persona = new Persona($db);
	$resultPersona = $persona->readByCedula($arrayParametros['cedula']);
	//PERSONA
	do
    {
    	/* store first result set */
        if ($result = mysqli_store_result($db)) {
            while ($row = mysqli_fetch_row($result)) {
            	$idPersona = $row[0];
            }
            mysqli_free_result($result);
        }
        /* print divider */
        if (mysqli_more_results($db)) {
            printf("-----------------\n");
        }
    } while(mysqli_next_result($db));

	if($idPersona == 0)
	{
		echo json_encode(['status' => 'ERROR', 'mensaje' => 'No existe la persona a la que se le desea autorizar la Poliza!']);
		die();
	}
	else
	{
		$poliza = new Poliza($db);
		$flag = $poliza->authorize($arrayParametros);

		if($flag)
		{
			echo json_encode(['status' => 'OK', 'mensaje' => 'Se autorizo la poliza']);
		}
		else
		{
			echo json_encode(['status' => 'ERROR', 'mensaje' => 'No se pudo autorizar a la poliza']);
		}
	}
	
}

/*
* funcion que sirve para validar el token
*/
function validarToken($token)
{
	require_once "api_conf.php";
	if($token == $api_token)
	{
		return true;
	}

	//cambiar a false en producción
	return true;
}

?>