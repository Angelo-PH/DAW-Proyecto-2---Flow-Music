<?php
session_start();

// Comprobar si se ha enviado la solicitud de cierre de sesión
if (isset($_POST['logout'])) {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Finalmente, destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página de inicio de sesión (o a cualquier otra página)
    header("Location: ../html/login.html");
    exit();
}
?>