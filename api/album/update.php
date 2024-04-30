<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Album.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Album object
$album = new Album($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$album->album_id = $data->album_id;
$album->album_nom = $data->album_nom;
$album->año_lanzamiento = $data->año_lanzamiento;
$album->id_autor = $data->id_autor;
$album->id_genero = $data->id_genero;

// Update Album
if ($album->update()) {
    echo json_encode(
        array('message' => 'Álbum Actualizado')
    );
} else {
    echo json_encode(
        array('message' => 'Álbum No Actualizado')
    );
}
?>
