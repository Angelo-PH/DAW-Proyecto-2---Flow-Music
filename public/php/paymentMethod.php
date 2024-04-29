<?php
// Incluir el archivo de configuración
include 'config.php';
// Inicia la sesión
session_start();
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $tarjeta = $_POST["tarjeta"];
    $nombre = $_POST["nombre"];
    $fecha = $_POST["fecha"];
    $cvv = $_POST["cvv"];

    $usuario_nombre = $_SESSION['usuario_nombre'];

    // Preparar la consulta SQL para actualizar el registro de usuario
    $sql = "UPDATE usuario SET tarjeta_num = '$tarjeta', fecha_caducidad = '$fecha', titular_tarjeta_nom = '$nombre', cvv = '$cvv', suscripcion = 'mensual' WHERE usuario_nombre = '$usuario_nombre'";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página IndexIniciado.php
        echo "Felicidades, usted se ha suscrito.";
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}
?>