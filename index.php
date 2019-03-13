<?php 
//Por que tipo de metodo se esta enviando la informacion
$method = $_SERVER['REQUEST_METHOD'];

// Solo si se manda via post
if($method == 'POST'){
  	//Jalamos todo el contenido
	$contenido = file_get_contents('php://input');
  	//Decodificamos via json
	$json = json_decode($contenido);
  	//Guardamos el resultado en la variable text
	$text = $json->queryResult->parameters->echoText;
	//Por cada entrada diferente contestamos una cosa diferente
	switch ($text) {
		case 'hola':
			$speech = "Hola, gracias por estar aqui";
			break;

		case 'adios':
			$speech = "Te vas tan pronto!! a penas nos empezabamosa conocer";
			break;

		case 'lo que sea':
			$speech = "Wow que gran conversacion.";
			break;
		
		default:
			$speech = "Ese silencio incomodo, di algo no muerdo (muy fuerte).";
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "No, no, no El metodo ".$method. " no es permitido (por ahi no)";
}

?>
