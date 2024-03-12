<?php
include 'config.php';
// Obté les dades enviades des del formulari
$name = $_POST['name'];
$correo_electronico = $_POST['correo_electronico'];
$password = $_POST['password'];

// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "flowmusic_bd";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Escapa les dades per prevenir injeccions SQL
$name = mysqli_real_escape_string($conn, $name);
$correo_electronico = mysqli_real_escape_string($conn, $correo_electronico);
$password = mysqli_real_escape_string($conn, $password);

// Comprova si l'usuari ja existeix amb el mateix nom d'usuari o correo_electronico
$check_query = "SELECT * FROM usuario WHERE usuario_nombre='$username' OR correo_electronico='$correo_electronico'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // L'usuari ja existeix, envia una resposta d'error
    echo "ERROR_USER_EXISTS";
} else {
    // L'usuari no existeix, procedeix amb el registre
    $insert_query = "INSERT INTO usuario (contraseña, usuario_nombre, correo_electronico, Foto, Premium) VALUES ('$password', '$name', '$correo_electronico', NULL, 0)";

    if ($conn->query($insert_query) === TRUE) {

        echo "OK";
        header("Location: index.html");
    } else {
        // Hi ha hagut un error en el registre
        echo "ERROR_REGISTRATION";
    }
}

// Tanca la connexió amb la base de dades
$conn->close();
?>