<?php
// Incluir la clase Database y cualquier otra configuración necesaria
include_once '../../config/Database.php';
session_start();

// Verificar si se recibió una solicitud POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $playlistName = $_POST['playlistName'];

    // Instanciar la clase Database
    $database = new Database();
    $conn = $database->connect();

    try {
        // Preparar la consulta SQL para la inserción de la playlist
        $query = "INSERT INTO lista_reproduccion (lista_nombre, usuario_id, fecha_creacion) VALUES (:playlistName, $user_id , DATE())";
        $statement = $conn->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':playlistName', $playlistName);

        // Ejecutar la consulta
        $statement->execute();

        // Si la inserción fue exitosa
        echo "Playlist creada correctamente.";
    } catch (PDOException $e) {
        // En caso de error durante la inserción
        echo "Error al crear la playlist: " . $e->getMessage();
    }
} else {
    // Si no se recibió una solicitud POST
    echo "Acceso denegado.";
}
?>
