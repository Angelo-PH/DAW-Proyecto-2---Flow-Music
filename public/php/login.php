<?php
// Incluir el archivo de configuración de la base de datos
include '../../config/Database.php';

session_start();

// Verificar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Instanciar la clase Database para conectarse a la base de datos
        $database = new Database();
        $conn = $database->connect();

        // Consulta para verificar las credenciales
        $sql = "SELECT usuario_nombre, correo_electronico, contrasena FROM usuario WHERE correo_electronico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        if ($row) {
            // Usuario encontrado, verificar la contraseña en texto plano
            $user_id = $row["usuario_id"];
            $username = $row["usuario_nombre"];
            $usermail = $row["correo_electronico"];
            $plain_password = $row["contrasena"];

            // Verificar la contraseña en texto plano
            if ($password === $plain_password) {
                // Autenticación exitosa
                $_SESSION['usuario_id'] = $user_id;
                $_SESSION['usuario_nombre'] = $username;
                $_SESSION['correo_electronico'] = $usermail;
                header("Location: indexSession.php");
                exit(); // Asegúrate de que el script termine aquí después de la redirección
            } else {
                // Contraseña incorrecta
                header("Location: ../html/login.html");
                exit();
            }
        } else {
            // Usuario no encontrado
            header("Location: ../html/login.html");
            exit();
        }
    } else {
        // Datos del formulario incompletos
        echo "Error: Datos del formulario incompletos.";
        exit();
    }
} else {
    // Si no se envió por POST, redirigir a la página de inicio de sesión
    header("Location: ../html/login.html");
    exit();
}
?>