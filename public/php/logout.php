<?php
// Iniciar sesión si no está iniciada
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a donde desees
header("Location: ../html/index.php");
exit();
?>