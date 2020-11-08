<?php


// include database and object files
include_once '../conexion.php';
include_once 'persona.php';
include_once 'poliza.php';

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
	if(!empty($data->tipoConsulta))
	{
		$tipoConsulta = $data->tipoConsulta;
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

if($tipoConsulta == "persona")
{
	getAllPersonas($db);
}
elseif($tipoConsulta == "poliza")
{
	getAllPolizas($db);
}

/*
* funcion que obtiene todas las polizas
*/
function getAllPolizas($db)
{
	$poliza = new Poliza($db);
	$resultPolizas = $poliza->read();
	$numPolizas = count($resultPolizas);

	// persona array
    $poliza_arr=array();
    $poliza_arr["data"]=array();

    do
    {
    	/* store first result set */
        if ($result = mysqli_store_result($db)) {
            while ($row = mysqli_fetch_row($result)) {
                $poliza_item=array(
		        	"cedula" => $row[0],
		        	"nombres" => $row[1],
		        	"lugar_domicilio" => $row[2],
		        	"domicilio" => $row[3],
		        	"tipo_poliza" => $row[4],
		        	"ip_poliza" => $row[5],
		        	"monto" => $row[6],
		        	"fecha_emision" => $row[7],
		        	"fecha_caducidad" => $row[8],
		        	"estado" => $row[9],
		        	"nombre_agencia" => $row[10],
		        	"agencia_ciudad" => $row[11]
		        );

		        array_push($poliza_arr["data"], $poliza_item);
            }
            mysqli_free_result($result);
        }
        /* print divider */
        if (mysqli_more_results($db)) {
            printf("-----------------\n");
        }
    } while(mysqli_next_result($db));

  	// set response code - 200 OK
    http_response_code(200);

    $numPolizas=count($poliza_arr["data"]);

	if ($numPolizas > 0)
	{
		$poliza_arr["cantidad"]=$numPolizas;

	    // show persona data in json format
	    echo json_encode($poliza_arr);
	}
	else
	{
	    // set response code - 404 Not found
	    http_response_code(404);

	    // tell the user no products found
	    echo json_encode(
	        array("message" => "No se encontraron registros de polizas!.")
	    );
	}
}

/*
* funcion que obtiene todas las personas
*/
function getAllPersonas($db)
{
	//consultar las personas
	$persona = new Persona($db);
	$resultPersonas = $persona->read();
	$numPersonas = mysqli_num_rows($resultPersonas);

	if ($numPersonas > 0)
	{
		// persona array
	    $persona_arr=array();
	    $persona_arr["data"]=array();
	    $persona_arr["cantidad"]=$numPersonas;

		// output data of each row
	  	while($row = mysqli_fetch_assoc($resultPersonas))
	  	{
	  		$persona_item=array(
	        	"id" => $row["id"],
	        	"nombres" => $row["nombres"],
	        	"cedula" => $row["cedula"],
	        	"lugar_domicilio" => $row["lugar_domicilio"],
	        	"domicilio" => $row["domicilio"]
	        );

	        array_push($persona_arr["data"], $persona_item);
	  	}

	  	// set response code - 200 OK
	    http_response_code(200);

	    // show persona data in json format
	    echo json_encode($persona_arr);
	}
	else
	{
	    // set response code - 404 Not found
	    http_response_code(404);

	    // tell the user no products found
	    echo json_encode(
	        array("message" => "No se encontraron registros de personas!.")
	    );
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

	//cambiar a False en producción
	return true;
}

?>
