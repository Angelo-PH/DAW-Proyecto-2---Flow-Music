<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Database and Cancion model files
include_once '../../config/Database.php';
include_once '../../models/Cancion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate Cancion object
$cancion = new Cancion($db);

// Cancion query
$result = $cancion->read();

// Get row count
$num = $result->rowCount();

// Check if any Cancion
if ($num > 0) {
    // Cancion array
    $canciones_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $cancion_item = array(
            'cancion_id' => $cancion_id,
            'cancion_nombre' => $cancion_nombre,
            'src' => $src,
            'id_album' => $id_album
        );

        // Push to "data"
        array_push($canciones_arr, $cancion_item);
    }

    // Turn to JSON & output
    echo json_encode($canciones_arr);
} else {
    // No Cancion found
    echo json_encode(
        array('message' => 'No se han encontrado canciones.')
    );
}
