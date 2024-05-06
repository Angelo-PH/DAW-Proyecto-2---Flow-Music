<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Database and ListaReproduccion model files
include_once '../../config/Database.php';
include_once '../../models/Lista_reproduccion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate ListaReproduccion object
$listaReproduccion = new ListaReproduccion($db);

// ListaReproduccion query
$result = $listaReproduccion->read();

// Get row count
$num = $result->rowCount();

// Check if any ListasReproduccion exist
if ($num > 0) {
    // ListasReproduccion array
    $listas_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $lista_item = array(
            'lista_id' => $lista_id,
            'lista_nombre' => $lista_nombre,
            'usuario_id' => $usuario_id,
            'fecha_creacion' => $fecha_creacion
        );

        // Push to "data"
        array_push($listas_arr, $lista_item);
    }

    // Turn to JSON and output
    echo json_encode($listas_arr);
} else {
    // No ListasReproduccion found
    echo json_encode(
        array('message' => 'No se han encontrado listas de reproducción.')
    );
}
?>
