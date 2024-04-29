<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Usuario.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Usuario object
$usuario = new Usuario($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set usuario_id to update
$usuario->usuario_id = $data->usuario_id;

// Delete Usuario
if ($usuario->delete()) {
  echo json_encode(
    array('message' => 'Usuario Eliminado')
  );
} else {
  echo json_encode(
    array('message' => 'Usuario No Eliminado')
  );
}
