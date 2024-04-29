<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Usuario.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$usuario = new Usuario($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$usuario->usuario_id = $data->usuario_id;
$usuario->usuario_nombre = $data->usuario_nombre;
$usuario->contrasena = $data->contrasena;
$usuario->fecha_registro = $data->fecha_registro;
$usuario->correo_electronico = $data->correo_electronico;

// Update post
if ($usuario->update()) {
    echo json_encode(
        array('message' => 'Usuario Actualizado')
    );
} else {
    echo json_encode(
        array('message' => 'Usuario No Actualizdo')
    );
}
