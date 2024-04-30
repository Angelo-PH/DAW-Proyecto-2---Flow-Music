<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Artista.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Artista object
$artista = new Artista($db);

// Artista query
$result = $artista->read();
// Get row count
$num = $result->rowCount();

// Check if any Artista
if ($num > 0) {
    // Artistas array
    $artistas_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $artista_item = array(
            'artista_id' => $artista_id,
            'artista_nombre' => $artista_nombre
        );

        // Push to "data"
        array_push($artistas_arr, $artista_item);
    }

    // Turn to JSON & output
    echo json_encode($artistas_arr);
} else {
    // No Artista found
    echo json_encode(
        array('message' => 'No se han encontrado artistas.')
    );
}
?>
