<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // o la dirección IP de tu servidor si no estás trabajando localmente
$username = "admin"; // Nombre de usuario de la base de datos
$password = "123456_aA"; // Contraseña de la base de datos
$dbname = "flowmusic_bd"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la BD: " . $conn->connect_error);
    }
//  else {
//     echo "La conexion a la BD se realizó con éxito.";
// }
?>