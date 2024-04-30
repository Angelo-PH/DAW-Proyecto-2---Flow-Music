<?php
// Incluir la clase Database
include_once '../../config/Database.php';

// Verificar si se recibió una solicitud POST desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo_electronico'];
    $password = $_POST['password'];

    // Instanciar la clase Database
    $database = new Database();
    $conn = $database->connect();

    try {
        // Preparar la consulta SQL para la inserción
        $query = "INSERT INTO usuario (usuario_nombre, contrasena, fecha_registro, correo_electronico) VALUES (:nombre, :password, CURDATE(), :correo)";
        $statement = $conn->prepare($query);

        // Bind de los parámetros
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':correo', $correo);
        $statement->bindParam(':password', $password);

        // Ejecutar la consulta
        $statement->execute();

         // Redirigir a la página de login después del registro exitoso
         header("Location: login.html");
         exit; // Asegura que el script se detenga después de la redirección
    } catch (PDOException $e) {
        // En caso de error durante la inserción
        echo "Error al registrar usuario: " . $e->getMessage();
    }
} else {
    // Si no se recibió una solicitud POST
    echo "Acceso denegado.";
}
?>
