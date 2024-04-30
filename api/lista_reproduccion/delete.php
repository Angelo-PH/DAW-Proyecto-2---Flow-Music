<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include Database and ListaReproduccion model files
include_once '../../config/Database.php';
include_once '../../models/ListaReproduccion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate ListaReproduccion object
$listaReproduccion = new ListaReproduccion($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set lista_id to delete
$listaReproduccion->lista_id = $data->lista_id;

// Delete ListaReproduccion
if ($listaReproduccion->delete()) {
    echo json_encode(
        array('message' => 'Lista de reproducción eliminada')
    );
} else {
    echo json_encode(
        array('message' => 'No se pudo eliminar la lista de reproducción')
    );
}
?>
