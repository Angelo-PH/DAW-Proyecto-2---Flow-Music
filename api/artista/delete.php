<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Check if artista_id is present
if (!empty($data->artista_id)) {
    // Set artista_id to delete
    $artista->artista_id = $data->artista_id;

    // Delete Artista
    if ($artista->delete()) {
        echo json_encode(
            array('message' => 'Artista Eliminado')
        );
    } else {
        echo json_encode(
            array('message' => 'Artista No Eliminado')
        );
    }
} else {
    echo json_encode(
        array('message' => 'ID del artista no proporcionado')
    );
}
?>
