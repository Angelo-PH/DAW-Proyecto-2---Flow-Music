<?php
// Conexión a la base de datos (cambiar los valores según corresponda)
$servername = "localhost";
$username = "admin";
$password = "123456_aA";
$database = "flowmusic_bd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre de la lista desde la solicitud AJAX
$nombreLista = $_POST['nombreLista'];

// Consulta SQL
$sql = "SELECT c.cancion_id, c.cancion_nombre, c.artista_autor, c.file, c.cover
        FROM lista_reproduccion l
        INNER JOIN cancion_lista cl ON l.lista_id = cl.id_lista
        INNER JOIN cancion c ON cl.cancion_id = c.cancion_id
        WHERE l.lista_nombre = '" . $nombreLista . "'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar el resultado
    $response = array();

    // Iterar sobre el resultado y añadir cada fila al array
    while($row = $result->fetch_assoc()) {
        $response[] = $row;
    }

    // Convertir el array a formato JSON y devolverlo como respuesta
    echo json_encode($response);
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();
?>
