<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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
if (!empty($data->artista_id) && !empty($data->artista_nombre)) {
    // Set properties from data
    $artista->artista_id = $data->artista_id;
    $artista->artista_nombre = $data->artista_nombre;

    // Update Artista
    if ($artista->update()) {
        echo json_encode(
            array('message' => 'Artista Actualizado')
        );
    } else {
        echo json_encode(
            array('message' => 'Artista No Actualizado')
        );
    }
} else {
    echo json_encode(
        array('message' => 'ID del artista o nombre del artista no proporcionado')
    );
}
?>
