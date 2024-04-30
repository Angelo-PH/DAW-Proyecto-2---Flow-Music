<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

// Set album_id to delete
$album->album_id = $data->album_id;

// Delete Album
if ($album->delete()) {
    echo json_encode(
        array('message' => 'Álbum Eliminado')
    );
} else {
    echo json_encode(
        array('message' => 'Álbum No Eliminado')
    );
}
?>
