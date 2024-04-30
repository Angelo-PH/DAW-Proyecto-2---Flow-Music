<?php
// Incluir la clase Database y cualquier otra configuración necesaria
include '../../config/Database.php';
session_start();

// Verificar si la variable de sesión 'usuario_nombre' está establecida para determinar si el usuario está autenticado
if (isset($_SESSION['usuario_nombre'])) {
    $username = $_SESSION['usuario_nombre'];
    $usermail = $_SESSION['correo_electronico'];
    $user_id = $_SESSION['usuario_id'];
} else {
    // Si no hay sesión activa, redirigir a la página de inicio de sesión
    header("Location: ../html/login.html");
    exit();
}

// Verificar si se recibió una solicitud POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $playlistName = $_POST['playlistName'];

    // Instanciar la clase Database
    $database = new Database();
    $conn = $database->connect();

    try {
        // Preparar la consulta SQL para la inserción de la playlist
        $query = "INSERT INTO lista_reproduccion (lista_nombre, usuario_id, fecha_creacion) VALUES (:playlistName, $user_id, CURDATE())";
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