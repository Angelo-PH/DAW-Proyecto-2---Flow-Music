<?php
include 'config.php';

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    // Escapar caracteres especiales para evitar inyección de SQL
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $correo_electronico = mysqli_real_escape_string($conn, $correo_electronico);
    $password = mysqli_real_escape_string($conn, $password);

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar un nuevo usuario
    $insert_query = "INSERT INTO usuario (usuario_nombre, correo_electronico, contrasena) VALUES ('$nombre', '$correo_electronico', '$hashed_password')";

    // Ejecutar la consulta
    if ($conn->query($insert_query) === TRUE) {
        // Redirigir al usuario a la página de registro
        header("Location: ../html/index.html");
        exit; // Asegúrate de detener la ejecución del script después de la redirección
    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
