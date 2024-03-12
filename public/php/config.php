<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Puede que necesites cambiarlo si tu servidor de MySQL no está en localhost
$username = "admin";
$password = "123456_aA";
$database = "flowmusic_bd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "exito";
}

?>