<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Usuario.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate usuario object
$usuario = new Usuario($db);

// Get ID
$usuario->usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : die();

// Get usuario
$usuario->read_single();

// Create array
$usuario_arr = array(
    'usuario_id' => $usuario->usuario_id,
    'usuario_nombre' => $usuario->usuario_nombre,
    'correo_electronico' => $usuario->correo_electronico,
    'fecha_registro' => $usuario->fecha_registro,
);

// Make JSON
print_r(json_encode($usuario_arr));
