<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Artista.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Artista object
$artista = new Artista($db);

// Get ID from URL parameter
$artista->artista_id = isset($_GET['artista_id']) ? $_GET['artista_id'] : die();

// Get single Artista
$artista->read_single();

// Create array
$artista_arr = array(
    'artista_id' => $artista->artista_id,
    'artista_nombre' => $artista->artista_nombre
);

// Make JSON response
echo json_encode($artista_arr);
