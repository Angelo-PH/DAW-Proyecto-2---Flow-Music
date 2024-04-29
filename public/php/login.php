<?php
// Incluir el archivo de configuración de la base de datos
include 'config.php';

session_start();
// Verificar si se enviaron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];


        // Consulta para verificar las credenciales
        $sql = "SELECT usuario_nombre, correo_electronico, suscripcion, contrasena FROM usuario WHERE correo_electronico = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Usuario encontrado, verificar la contraseña
            $row = $result->fetch_assoc();
            $username = $row["usuario_nombre"];
            $usermail = $row["correo_electronico"];
            $suscripcion = $row['suscripcion'];
            $hashed_password = $row["contrasena"];

            // Verificar la contraseña hasheada
            if (password_verify($password, $hashed_password)) {
                // Autenticación exitosa
                $_SESSION['usuario_nombre'] = $username;
                $_SESSION['correo_electronico'] = $usermail;
                $_SESSION['suscripcion'] = $suscripcion;
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

        // Cerrar consulta
        $stmt->close();
    } else {
        // Datos del formulario incompletos
        echo "Error: Datos del formulario incompletos.";
        exit();
    }
}

// Cerrar conexión
$conn->close();
?>