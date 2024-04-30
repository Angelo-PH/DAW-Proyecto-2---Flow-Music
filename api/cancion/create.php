<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
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

// Check if data is present and valid
if (!empty($data->cancion_nombre) && !empty($data->src) && !empty($data->id_album)) {
    // Set Cancion properties from data
    $cancion->cancion_nombre = $data->cancion_nombre;
    $cancion->src = $data->src;
    $cancion->id_album = $data->id_album;

    // Create Cancion
    if ($cancion->create()) {
        echo json_encode(
            array('message' => 'Cancion Creada')
        );
    } else {
        echo json_encode(
            array('message' => 'No se pudo crear la Cancion')
        );
    }
} else {
    echo json_encode(
        array('message' => 'Datos incompletos. Asegúrate de proporcionar cancion_nombre, src y id_album.')
    );
}
?>
