<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Album.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Album object
$album = new Album($db);

// Album query
$result = $album->read();

// Get row count
$num = $result->rowCount();

// Check if any albums found
if ($num > 0) {
    // Album array
    $albums_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $album_item = array(
            'album_id' => $album_id,
            'album_nom' => $album_nom,
            'año_lanzamiento' => $año_lanzamiento,
            'id_autor' => $id_autor,
            'id_genero' => $id_genero
        );

        // Push to "data"
        array_push($albums_arr, $album_item);
    }

    // Turn to JSON & output
    echo json_encode($albums_arr);
} else {
    // No Albums found
    echo json_encode(
        array('message' => 'No se han encontrado álbumes.')
    );
}
?>
