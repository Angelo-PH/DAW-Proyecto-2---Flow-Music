<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
if (isset($_SESSION['usuario_nombre'])) {
    // Si la sesión está iniciada, devuelve "sesion_iniciada"
    echo "sesion_iniciada";
} else {
    // Si la sesión no está iniciada, devuelve "sesion_no_iniciada"
    echo "sesion_no_iniciada";
}
?>
