<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Usuario.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Usuario object
$usuario = new Usuario($db);

// Blog Usuario query
$result = $usuario->read();
// Get row count
$num = $result->rowCount();

// Check if any Usuario
if ($num > 0) {
    // Usuario array
    $usuarios_arr = array();
    // $usuarios_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $usuario_item = array(
            'usuario_id' => $usuario_id,
            'usuario_nombre' => $usuario_nombre,
            'correo_electronico' => $correo_electronico,
            'fecha_registro' => $fecha_registro,
        );

        // Push to "data"
        array_push($usuarios_arr, $usuario_item);
        // array_push($usuarios_arr['data'], $usuarios_item);
    }

    // Turn to JSON & output
    echo json_encode($usuarios_arr);
} else {
    // No User.
    echo json_encode(
        array('message' => 'No se han encontrado usuarios.')
    );
}
