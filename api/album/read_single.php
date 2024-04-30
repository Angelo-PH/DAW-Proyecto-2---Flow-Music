<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Album.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate Album object
$album = new Album($db);

// Get ID from URL parameters
$album->album_id = isset($_GET['album_id']) ? $_GET['album_id'] : die();

// Get single album
$album->read_single();

// Create array
$album_arr = array(
    'album_id' => $album->album_id,
    'album_nom' => $album->album_nom,
    'año_lanzamiento' => $album->año_lanzamiento,
    'id_autor' => $album->id_autor,
    'id_genero' => $album->id_genero
);

// Make JSON response
echo json_encode($album_arr);
?>
