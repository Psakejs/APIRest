<?php 


// Auteticacion con http
// $user= array_key_exists('PHP_AUTH_USER', $_SERVER) ? $_SERVER['PHP_AUTH_USER'] : '';

// $password = array_key_exists('PHP_AUTH_PW', $_SERVER) ? $_SERVER['PHP_AUTH_PW'] : '';

// if($user !== 'david' || $password !== '1234') {
//     die;
// }


// Autenticacion con HMAC
// if(!array_key_exists('HTTP_X_HASH', $_SERVER) || !array_key_exists('HTTP_X_TIMESTAMP', $_SERVER) || !array_key_exists('HTTP_X_UID', $_SERVER)) {
//     die;
// }

// list($hash, $uid, $timestamp) = [
//     $_SERVER['HTTP_X_HASH'],
//     $_SERVER['HTTP_X_UID'],
//     $_SERVER['HTTP_X_TIMESTAMP'],
// ];

// $secret = 'Sh!! No se lo digas a nadie!';

// $newHash = sha1($uid.$timestamp.$secret);

// if($newHash !== $hash) {
//     die;
// }

// Definimos los recursos disponibles
$allowedResourceTypes = [
    'books',
    'authors',
    'genres',
];
// Validamos que el recurso este disponible
$resourceType = $_GET['resource_type'];

// Definimos los recursos
$books = [
    1 => [
        'titulo' => 'Lo que el viento se llevo',
        'id_autor' => 2,
        'id_genero' => 2,
    ],
    2 => [
        'titulo' => 'La iliada',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
    3 => [
        'titulo' => 'La odisea',
        'id_autor' => 1,
        'id_genero' => 1,
    ],
];

header('Content-Type: application/json');

$resourceId = array_key_exists('resource_id', $_GET) ? $_GET['resource_id'] : '';
// Generamos la respuesta segun el pedido
if(!in_array($resourceType, $allowedResourceTypes)) {
    http_response_code(400);
    die;
}

switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
    case 'GET':
        
        if(empty($resourceId)) {
            echo json_encode($books);
        } else {
            if(array_key_exists($resourceId, $books)) {
                echo json_encode($books[$resourceId]);
            } else {
                http_response_code(404);
            }
        }

        break;

    case 'POST':
        
        $json = file_get_contents('php://input');

        $books[] = json_decode($json, true);

        echo array_keys($books)[count($books) - 1];

        break;

    case 'PUT':
       
        if(!empty($resourceId) && array_key_exists($resourceId, $books)) {
            $json = file_get_contents('php://input');

            $books[$resourceId] = json_decode($json, true);

            echo "El libro con id $resourceId fue actualizado con exito";
        }

        break;

    case 'DELETE':
        
        if(!empty($resourceId) && array_key_exists($resourceId, $books)) {
            unset($books[$resourceId]);

            echo "El libro con id $resourceId fue eliminado con exito";
        }

        break;
    
    default:
        # code...
        break;
}