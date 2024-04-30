<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Artista.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Artista object
$artista = new Artista($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if data is present
if (!empty($data->artista_nombre)) {
    // Set properties from data
    $artista->artista_nombre = $data->artista_nombre;

    // Create Artista
    if ($artista->create()) {
        echo json_encode(
            array('message' => 'Artista Creado')
        );
    } else {
        echo json_encode(
            array('message' => 'Artista No Creado')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Nombre del artista no proporcionado')
    );
}
