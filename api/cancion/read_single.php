<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Database and Cancion model files
include_once '../../config/Database.php';
include_once '../../models/Cancion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate Cancion object
$cancion = new Cancion($db);

// Get ID from URL parameter
$cancion->cancion_id = isset($_GET['cancion_id']) ? $_GET['cancion_id'] : die();

// Get single Cancion
$cancion->read_single();

// Create array
$cancion_arr = array(
    'cancion_id' => $cancion->cancion_id,
    'cancion_nombre' => $cancion->cancion_nombre,
    'src' => $cancion->src,
    'id_album' => $cancion->id_album
);

// Make JSON response
echo json_encode($cancion_arr);
?>
