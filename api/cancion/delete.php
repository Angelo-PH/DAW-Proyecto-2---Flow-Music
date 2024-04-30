<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// Include Database and Cancion model files
include_once '../../config/Database.php';
include_once '../../models/Cancion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate Cancion object
$cancion = new Cancion($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set cancion_id to delete
$cancion->cancion_id = $data->cancion_id;

// Delete Cancion
if ($cancion->delete()) {
  echo json_encode(
    array('message' => 'Cancion Eliminada')
  );
} else {
  echo json_encode(
    array('message' => 'No se pudo eliminar la Cancion')
  );
}
?>
