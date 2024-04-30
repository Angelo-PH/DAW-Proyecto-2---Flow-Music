<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
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

// Set ListaReproduccion properties from data
$listaReproduccion->lista_id = $data->lista_id;
$listaReproduccion->lista_nombre = $data->lista_nombre;
$listaReproduccion->usuario_id = $data->usuario_id;
$listaReproduccion->fecha_creacion = $data->fecha_creacion;

// Update ListaReproduccion
if ($listaReproduccion->update()) {
    echo json_encode(
        array('message' => 'Lista de reproducción actualizada')
    );
} else {
    echo json_encode(
        array('message' => 'No se pudo actualizar la lista de reproducción')
    );
}
?>
