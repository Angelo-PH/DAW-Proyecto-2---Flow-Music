<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscribirse en FlowMusic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/premiumLogin.css">
    <script src="https://kit.fontawesome.com/4bab62df81.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container-fluid bg-dark py-4">
        <div class="col text-center">
            <a href="../html/index.html" id="linkFlowMusic">Flow Music</a></href>
        </div>
    </header>


    <form id="loginForm">
        <h1>Suscribirse en Flow Music</h1>
        <p>Únete a Prime y disfruta de beneficios exclusivos.</p>
        <form action="/suscripcion" method="POST">
            <label for="tarjeta">Número de tarjeta de crédito:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>

            <label for="nombre">Nombre del titular de la tarjeta:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="fecha">Fecha de expiración:</label>
            <input type="text" id="fecha" name="fecha" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="password" id="cvv" name="cvv" maxlength="3" required>
            <input type="submit" value="Suscribirse">
        </form>
    </form>

    <footer>
        <p>&copy; 2024 Flow Music</p>
        <div class="redes-sociales">
            <a href="https://www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="https://www.tiktok.com"><i class="fab fa-tiktok"></i> TikTok</a>
            <a href="https://www.twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
        </div>
    </footer>
    <script>
        document.getElementById("linkFlowMusic").addEventListener("click", function (event) {
            event.preventDefault(); // Evitar el comportamiento predeterminado del enlace

            // Realizar una solicitud AJAX para verificar la sesión
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "verificar_sesion.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Si la respuesta es "sesion_iniciada", redirigir a indexIniciado.php
                    if (xhr.responseText === "sesion_iniciada") {
                        window.location.href = "indexIniciado.php";
                    } else {
                        // Si la respuesta es "sesion_no_iniciada", redirigir a ../html/index.html
                        window.location.href = "../html/index.html";
                    }
                }
            };
            xhr.send();
        });
    </script>
</body>

</html>

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
    $sql = "UPDATE usuario SET tarjeta_num = '$tarjeta', fecha_caducidad = '$fecha', titular_tarjeta_nom = '$nombre', cvv = '$cvv' WHERE nombre_usuario = '$usuario_nombre'";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página IndexIniciado.php
        header("Location: IndexIniciado.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}
?>