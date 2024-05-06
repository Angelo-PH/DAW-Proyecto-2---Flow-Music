<?php
include '../../config/Database.php';
// Obtener el nombre enviado desde la solicitud AJAX
$titol = $_GET['nombre'];

// Consulta a la base de datos
$sql = "SELECT * FROM cancion WHERE cancion_nombre LIKE '%$titol%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar resultados
    while ($row = $result->fetch_assoc()) {
        //echo "ID: " . $row["id_cancion"]. " - Nombre: " . $row["titol"]. " - Edad: " . $row["archivo"]. "<br>";

        echo '
        <div class="col-md-3">
            <div class="music-card">
                <img class="cover" src="' . $row['cover'] . '" alt="Cover de' . $row['cancion_nombre'] . '">
                <div class="music-card-description">
                    <p class="songName"> ' . $row['cancion_nombre'] . '</p>
                    <p class="songAuthor">' . $row['artista_autor'] . '</p>
                </div>
                <button class="btn btn-primary btn-play" data-src="' . $row['file'] . ' onclick="playSong(' . $row['file'] . ')>
                    <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                </button>
            </div>
        </div>
        ';
    }
} else {
    echo "No se encontraron resultados.";
}
$conn->close();
?>