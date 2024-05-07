<?php
// Incluir la clase Database y cualquier otra configuración necesaria
include_once '../../config/Database.php';
session_start();

// Verificar si se recibió una solicitud POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el campo playlistName está vacío
    if (empty($_POST['playlistName'])) {
        $_SESSION['playlist_creation_error'] = "No se puede crear una playlist sin un nombre.";
        echo "error";
        exit;
    }

    // Recoger los datos del formulario
    $playlistName = $_POST['playlistName'];
    $user_id = $_SESSION['usuario_id']; // Obtener el user_id de la sesión

    // Instanciar la clase Database
    $database = new Database();
    $conn = $database->connect();

    try {
        // Preparar la consulta SQL para la inserción de la playlist
        $query = "INSERT INTO lista_reproduccion (lista_nombre, usuario_id, fecha_creacion) VALUES (:playlistName, :user_id, CURDATE())";
        $statement = $conn->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':playlistName', $playlistName);
        $statement->bindParam(':user_id', $user_id);

        // Ejecutar la consulta
        $statement->execute();

        // Si la inserción fue exitosa
        echo "success";
        exit;
    } catch (PDOException $e) {
        // En caso de error durante la inserción
        $_SESSION['playlist_created_message'] = "Error al crear la playlist: " . $e->getMessage();
        echo "error";
        exit;
    }

} else {
    // Si no se recibió una solicitud POST
    echo "Acceso denegado.";
}
?>