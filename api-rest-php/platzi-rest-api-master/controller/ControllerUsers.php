<?php


// http://localhost:8888/platzi-rest-api-master/controller/controllerUsers.php?resource_user=users

// // Permite el acceso desde cualquier origen
// header('Access-Control-Allow-Origin: *');

// // Permite que se utilicen los siguientes métodos HTTP
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// // Permite que se utilicen los siguientes encabezados en la solicitud
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

// // Permite que las solicitudes incluyan cookies
// header('Access-Control-Allow-Credentials: true');

include("configBd.php");
include("../model/Users.php");

header( 'Content-Type: application/json' );

$allowedResourceTypes = [
	'users',
];

$resourceUser = $_GET['resource_user'];
if ( !in_array( $resourceUser, $allowedResourceTypes ) ) {
	http_response_code( 400 );
	echo json_encode([ 'error' => "$resourceUser is un unkown",]);
	die;
}

$resourceId = array_key_exists('resource_id', $_GET ) ? $_GET['resource_id'] : '';
$method = $_SERVER['REQUEST_METHOD'];

switch ( strtoupper( $method ) ) {
	case 'GET':
		if ( "users" !== $resourceUser ) {
			http_response_code( 404 );
			echo json_encode( [ 'error' => $resourceUser.' not yet implemented :(', ] );
			die;
		}
		if ( !empty( $resourceId ) ) {
			if ( array_key_exists( $resourceId, $books ) ) {
				echo json_encode(
					$books[ $resourceId ]
				);
			} else {
				http_response_code( 404 );
				echo json_encode(
					['error' => 'Book '.$resourceId.' not found :(']
				);
			}
		} else {
			$user = new User('','','','','','','','','');
			$object_result= $user->consult_users();	
			echo json_encode($object_result);
		}
		die;
		break;


	case 'POST':
		$json = file_get_contents( 'php://input' );
		$newUser = json_decode( $json, true );

        if ($resourceUser !== 'books') {
            http_response_code(400);
            echo json_encode(['error' => "$resourceUser not yet implemented :("]);
            die;
        }

        // Crear un nuevo usuario usando el modelo User
        $user = new User('', $newUser['username'], $newUser['date_birth'], $newUser['middlename'], $newUser['lastname'], $newUser['email'], $newUser['phone'], $newUser['signed_consent'],'' );

        // Insertar el nuevo usuario en la base de datos
        $result = $user->insert_user();
		if ($result) {
			http_response_code(200);
			echo json_encode(['message' => 'User created successfully','user' => $newUser]);
		} else {
			http_response_code(400); // Establecer el código de respuesta HTTP en 400
			echo json_encode(['error' => 'Error creating user']);
		}
        break;

	case 'PUT':
		if ( !empty($resourceId) && array_key_exists( $resourceId, $books ) ) {
			$json = file_get_contents( 'php://input' );
			$books[ $resourceId ] = json_decode( $json, true );
			echo $resourceId;
		}
		break;

	case 'DELETE':
		if ( !empty($resourceId) && array_key_exists( $resourceId, $books ) ) {
			unset( $books[ $resourceId ] );
		}
		break;

	default:
		http_response_code( 404 );
		echo json_encode(['error' => $method.' not yet implemented :(',]);
		break;
}