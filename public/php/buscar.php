<?php
include '../../config/Database.php';

if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];

    // Consulta SQL para buscar canciones por nombre (cancion_nombre) que contienen el término de búsqueda
    $sql = "SELECT * FROM cancion WHERE cancion_nombre LIKE ?";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Bind parameters y ejecutar la consulta
    $likeParam = "%$searchTerm%";
    $stmt->bind_param("s", $likeParam);
    $stmt->execute();
    $result = $stmt->get_result();

    $songs = array();
    while ($row = $result->fetch_assoc()) {
        $songs[] = array(
            'cancion_nombre' => $row['cancion_nombre'],
            'artista_autor' => $row['artista_autor'],
            'cover' => $row['cover']
            // Agrega más campos aquí si es necesario
        );
    }

    // Devolver resultados como JSON
    echo json_encode($songs);

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
}
