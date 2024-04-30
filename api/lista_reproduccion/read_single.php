<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include Database and ListaReproduccion model files
include_once '../../config/Database.php';
include_once '../../models/ListaReproduccion.php';

// Instantiate Database
$database = new Database();
$db = $database->connect();

// Instantiate ListaReproduccion object
$listaReproduccion = new ListaReproduccion($db);

// Get ID from URL parameter
$listaReproduccion->lista_id = isset($_GET['lista_id']) ? $_GET['lista_id'] : die();

// Get single ListaReproduccion
$listaReproduccion->read_single();

// Create array
$lista_arr = array(
    'lista_id' => $listaReproduccion->lista_id,
    'lista_nombre' => $listaReproduccion->lista_nombre,
    'usuario_id' => $listaReproduccion->usuario_id,
    'fecha_creacion' => $listaReproduccion->fecha_creacion
);

// Make JSON response
echo json_encode($lista_arr);
?>
