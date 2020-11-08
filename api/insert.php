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
	if(!empty($data->tipoInsert))
	{
		$tipoInsert = $data->tipoInsert;	
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

if($tipoInsert == "persona")
{
	$arrayParametros = array(
							 'nombres' => $data->nombres,
							 'cedula' => $data->cedula,
							 'fecha_nacimiento' => $data->fecha_nacimiento,
							 'lugar_nacimiento' => $data->lugar_nacimiento,
							 'lugar_domicilio' => $data->lugar_domicilio,
							 'domicilio' => $data->domicilio,
							 'telefono' => $data->telefono,
							 'usuario_creacion' => $data->usuario_creacion
							);
	createPersona($db, $arrayParametros);
}
elseif($tipoInsert == "poliza")
{
	$arrayParametros = array(
								'cedula' => $data->cedula,
								'ciudad' => $data->ciudad,
								'monto' => $data->monto,
								'poliza' => $data->poliza,
								'estado' => 'PENDIENTE',
								'usuario_creacion' => $data->usuario_creacion
							);

	createPoliza($db, $arrayParametros);
}

function createPoliza($db, $arrayParametros)
{
	$tipoPoliza = new TipoPoliza($db);
	$agencia = new Agencia($db);
	$persona = new Persona($db);
	$poliza = new Poliza($db);

	$idPersona = 0;
	$idTipoPoliza = 0;
	$idAgencia = 0;

	
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
		echo json_encode(['status' => 'ERROR', 'mensaje' => 'No existe la persona a la que se le desea crear una Poliza!']);
		die();
	}
	else
	{
		$resultTipoPoliza = $tipoPoliza->readByNombre($arrayParametros['poliza']);
	  	//TIPO DE POLIZA
	  	do
	    {
	    	/* store first result set */
	        if ($result = mysqli_store_result($db)) {
	            while ($row = mysqli_fetch_row($result)) {
	            	$idTipoPoliza = $row[0];
	            }
	            mysqli_free_result($result);
	        }
	        /* print divider */
	        if (mysqli_more_results($db)) {
	            printf("-----------------\n");
	        }
	    } while(mysqli_next_result($db));
	  	
	  	if($idTipoPoliza == 0)
	  	{
	  		echo json_encode(['status' => 'ERROR', 'mensaje' => 'No existe el tipo de Poliza que desea crear!']);
	  		die();
	  	}

	  	$resultAgencia = $agencia->readByCiudad($arrayParametros['ciudad']);
	  	//AGENCIA
		do
	    {
	    	/* store first result set */
	        if ($result = mysqli_store_result($db)) {
	            while ($row = mysqli_fetch_row($result)) {
	            	$idAgencia = $row[0];
	            }
	            mysqli_free_result($result);
	        }
	        /* print divider */
	        if (mysqli_more_results($db)) {
	            printf("-----------------\n");
	        }
	    } while(mysqli_next_result($db));

	  	if($idAgencia == 0)
	  	{
	  		echo json_encode(['status' => 'ERROR', 'mensaje' => 'No existe la agencia!']);
			die();
	  	}

	  	//CREAR POLIZA
	  	$arrayData = array  (
	  							'persona_id' => $idPersona,
	  							'tipo_poliza_id' => $idTipoPoliza,
	  							'agencia_id' => $idAgencia,
	  							'monto' => $arrayParametros['monto'],
	  							'estado' => $arrayParametros['estado'],
	  							'usuario_creacion' => $arrayParametros['usuario_creacion']
	  						);

	  	$flag = $poliza->create($arrayData);
	  	if($flag)
		{
			echo json_encode(['status' => 'OK', 'mensaje' => 'Se registro la poliza']);
		}
		else
		{
			echo json_encode(['status' => 'ERROR', 'mensaje' => 'No se pudo registrar a la poliza']);
		}
	}
	
}

function createPersona($db, $arrayParametros)
{
	$persona = new Persona($db); 

	//revisar si la persona existe
	$resultPersona = $persona->readByCedula($arrayParametros['cedula']);
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

	if($idPersona > 0)
	{
		echo json_encode(['status' => 'ERROR', 'mensaje' => 'Ya existe la persona!']);
		die();
	}

	$flag = $persona->create($arrayParametros);

	if($flag)
	{
		echo json_encode(['status' => 'OK', 'mensaje' => 'Se registro a la persona']);
	}
	else
	{
		echo json_encode(['status' => 'ERROR', 'mensaje' => 'No se pudo registrar a la persona']);
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