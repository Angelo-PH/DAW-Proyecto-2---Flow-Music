<?php
include 'config.php';

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para verificar el usuario y la contraseña
    $sql = "SELECT * FROM usuario WHERE usuario_nombre='$email' AND contraseña='$password'";
    $result = $conn->query($sql);

    // Verificar si hay algún resultado
    if ($result->num_rows > 0) {
        // Usuario y contraseña son correctos
        echo "Inicio de sesión exitoso";
    } else {
        // Usuario o contraseña son incorrectos
        echo "Inicio de sesión fallido";
    }
}
?>
