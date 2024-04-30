<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

// Check if data is valid
if (!empty($data->lista_nombre) && !empty($data->usuario_id) && !empty($data->fecha_creacion)) {
    // Set ListaReproduccion properties from data
    $listaReproduccion->lista_nombre = $data->lista_nombre;
    $listaReproduccion->usuario_id = $data->usuario_id;
    $listaReproduccion->fecha_creacion = $data->fecha_creacion;

    // Create ListaReproduccion
    if ($listaReproduccion->create()) {
        echo json_encode(
            array('message' => 'Lista de reproducción creada')
        );
    } else {
        echo json_encode(
            array('message' => 'No se pudo crear la lista de reproducción')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Datos incompletos. Asegúrate de proporcionar lista_nombre, usuario_id y fecha_creacion.')
    );
}
?>
