<?php
include("configBd.php");
include("../model/Childs.php");

// http://localhost:8888/platzi-rest-api-master/controller/controllerChilds.php?resource_child=childs

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Access-Control-Allow-Credentials: true');
header( 'Content-Type: application/json' );

$allowedResourceTypes = [
	'childs',
];

$resourceChild = $_GET['resource_child'];
if ( !in_array( $resourceChild, $allowedResourceTypes ) ) {
	http_response_code( 400 );
	echo json_encode([ 'error' => "$resourceChild is un unkown",]);
	die;
}

$resourceId = array_key_exists('resource_id', $_GET ) ? $_GET['resource_id'] : '';
$method = $_SERVER['REQUEST_METHOD'];

switch ( strtoupper( $method ) ) {
	case 'GET':
		if ( "childs" !== $resourceChild ) {
			http_response_code( 404 );
			echo json_encode(['error' => $resourceChild.' not yet implemented :(',]);
			die;
		}
		if ( !empty( $resourceId ) ) {
				$child = new child('','','','','','');
				$child->setId($resourceId);
				$object_result= $child->consult_childs_by_id();
			if ( array_key_exists( $resourceId, $object_result ) ) {
				echo json_encode($object_result[$resourceId]);
			} else {
				http_response_code( 404 );
				echo json_encode( ['error' => 'Book '.$resourceId.' not found :('] );
			}
		} else {
			$child = new child('','','','','','');
			$object_result= $child->consult_childs();
			echo json_encode($object_result);
		}
		die;
		break;


	case 'POST':
		$json = file_get_contents( 'php://input' );
		$newChild = json_decode( $json, true );

        if ($resourceChild !== 'childs') {
            http_response_code(400);
            echo json_encode(['error' => "$resourceChild not yet implemented :("]);
            die;
        }

        // Crear un nuevo child usando el modelo User
        $child = new Child('', $newChild['user_id'],  $newChild['child_name'], $newChild['child_middlename'], $newChild['child_lastname'], $newChild['child_date_of_birth'] );

        // Insertar el nuevo child en la base de datos
        $result = $child->insert_child();
		if ($result) {
			http_response_code(200);
			echo json_encode(['message' => 'User created successfully','user' => $newChild]);
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