<?php
// Incluir la clase Database y realizar la conexión
require_once '../../config/Database.php';
$database = new Database();
$conn = $database->connect();

// Obtener el término de búsqueda enviado por AJAX
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';

// Consulta SQL para buscar canciones por nombre o autor que coincidan con el término de búsqueda
$sql = "SELECT cancion_nombre, artista_autor, cover FROM cancion 
        WHERE cancion_nombre LIKE :searchTerm OR artista_autor LIKE :searchTerm
        LIMIT 12";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
$stmt->execute();

// Generar HTML con los resultados de la búsqueda
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col-md-3">';
        echo '<div class="music-card">';
        echo '<img class="cover" src="' . $row['cover'] . '" alt="">';
        echo '<div class="music-card-description">';
        echo '<p class="songName">' . $row['cancion_nombre'] . '</p>';
        echo '<p class="songAuthor">' . $row['artista_autor'] . '</p>';
        echo '</div>';
        echo '<button class="btn btn-primary btn-play">';
        echo '<img src="../assets/icons/Play.svg" alt="" class="icon-card">';
        echo '</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No se encontraron resultados para la búsqueda.</p>';
}
?>