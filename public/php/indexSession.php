<?php
session_start();

// Comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_nombre']) || !isset($_SESSION['correo_electronico']) || !isset($_SESSION['fecha_registro'])) {
    // Si alguna de las variables de sesión no está definida, redirigir al usuario a la página de inicio de sesión
    header("Location: ../html/login.html");
    exit();
}

// Si el usuario ha iniciado sesión, obtener los datos del usuario
$user_id = $_SESSION['usuario_id'];
$username = $_SESSION['usuario_nombre'];
$usermail = $_SESSION['correo_electronico'];
$user_date = $_SESSION['fecha_registro'];

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Music</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <header class="container-fluid bg-dark py-3">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary"><a href="premiumPlans.php" style="color: white; text-decoration: none;">Hazte Premium</a></button>
            </div>
            <div class="col text-center">
                <a href="indexSession.php" style="text-decoration: none;">
                    <h1>Flow Music</h1>
                </a>
            </div>
            <div class="col text-end">
                <img src="../assets/icons/user-solid.svg" id="user-icon" alt="user-icon" width="40px" height="auto" style="cursor: pointer;">
                <div id="user-modal" class="modal">
                    <div class="modal-content" style="width: 600px;">
                        <button class="close" onclick="closeModal()" style="font-size:small;">X</button>
                        <p>Bienvenido, <?php echo $username;?></p>
                        <p>Correo electrónico: <?php echo $usermail; ?></p>
                        <p>Fecha de registro: <?php echo $user_date; ?></p>
                        <form method="post" action="logout.php">
                            <button type="submit" id="logout-btn" name="logout" class="btn btn-primary">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <aside class="col-md-3" style="background: linear-gradient(to bottom, #000000, #f5f1f1);">
                    <img src="../assets/icons/flow-music.png" alt="flow-music.png" width="100" style="display: block; margin: 0 auto; margin-top:20px;">
                <div class="mx-2 my-2" style="background-color: rgb(116, 114, 114); color: white; padding: 15px; border-radius: 7.5%;">
                    <h2>Biblioteca</h2>
                    <h4>Mis listas de reproducción:</h4>
                    <ul id="playlist-ul">
                        <?php
                        // Requiere el archivo de configuración de la base de datos
                        require_once '../../config/Database.php';
                        // Crea una instancia de la clase Database para establecer la conexión
                        $database = new Database();
                        $conn = $database->connect();
                        // Consulta SQL para obtener las listas de reproducción
                        $sql = "SELECT lista_id, lista_nombre FROM lista_reproduccion WHERE usuario_id = $user_id" ;
                        $stmt = $conn->query($sql);
                        // Comprueba si hay resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y agrega elementos a la lista
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<li>" . htmlspecialchars($row["lista_nombre"]) . "</li>";
                            }
                        } else {
                            echo "<li>No hay listas de reproducción disponibles</li>";
                        }
                        // Liberar la consulta
                        $stmt = null;
                        ?>
                    </ul>
                    <button class="btn btn-primary" style="display: block; margin: 0 auto;" onclick="window.location.href = 'playlist.php';">Crea una lista</button>
                    <h4>Mis Albumes favoritos:</h4>
                    <ul id="album-ul">
                        <?php
                        // Requiere el archivo de configuración de la base de datos
                        require_once '../../config/Database.php';
                        // Crea una instancia de la clase Database para establecer la conexión
                        $database = new Database();
                        $conn = $database->connect();
                        // Consulta SQL para obtener las listas de reproducción
                        $sql = "SELECT 
                        album.album_nom AS Nombre_Album,
                        artista.artista_nombre AS Nombre_Artista
                    FROM 
                        usuario_album
                    JOIN 
                        album ON usuario_album.album_id = album.album_id
                    JOIN 
                        artista ON album.id_autor = artista.artista_id
                    WHERE 
                        usuario_album.usuario_id = $user_id" ;
                        $stmt = $conn->query($sql);
                        // Comprueba si hay resultados
                        if ($stmt->rowCount() > 0) {
                            // Itera sobre los resultados y agrega elementos a la lista
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<li>" . htmlspecialchars($row["Nombre_Album"]) . " - "  . htmlspecialchars($row["Nombre_Artista"]) . "</li>";
                            }
                        } else {
                            echo "<li>No hay albumes favoritos</li>";
                        }
                        // Liberar la consulta
                        $stmt = null;
                        ?>
                    </ul>
                    <button class="btn btn-primary" style="display: block; margin: 0 auto;" onclick="window.location.href = 'album.php';">Agrega albumes</button>
                </div>



                <div id="footer">
                    <p>@2024 Flow Music</p>
                    <a href="https://www.instagram.com/"><img src="../assets/icons/instagram.svg" width="25"></a>
                    <a href="https://www.facebook.com/"><img src="../assets/icons/facebook.svg" width="25"></a>
                    <a href="https://twitter.com/"><img src="../assets/icons/twitter.svg" width="25"></a>
                </div>

            </aside>

            <main id="main-content" class="col-md-9">
                <div class="input-group my-3">
                    <input type="text" id="search-bar" class="form-control" placeholder="Busca una canción o artista...">
                    <button id="search-btn" class="btn btn-outline-secondary">Buscar</button>
                </div>

                <div id="canciones-default">

                    <!-- Aquí colocaremos el código PHP para cargar las canciones -->
                    <?php
                    // Incluir la clase Database y realizar la consulta
                    require_once '../../config/Database.php';
                    $database = new Database();
                    $conn = $database->connect();

                    // Consulta SQL para obtener las canciones
                    $sql = "SELECT * FROM cancion LIMIT 12";
                    $stmt = $conn->query($sql);
                    echo '<div class="row">';
                    // Mostrar las canciones en los elementos HTML
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="col-md-3">';
                            echo '<div class="music-card">';
                            echo '<img class="cover" src="' . $row['cover'] . '">';
                            echo '<div class="music-card-description">';
                            echo '<p class="songName">' . $row['cancion_nombre'] . '</p>';
                            echo '<p class="songAuthor">' . $row['artista_autor'] . '</p>';
                            echo '</div>';
                            echo '<button class="btn btn-primary btn-play" data-songpath="' . $row['file'] . '">';
                            echo '<img src="../assets/icons/Play.svg" class="icon-card">';
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No se encontraron canciones.</p>';
                    }
                    echo '</div>';
                    ?>
                    <!-- Fin del código PHP para cargar las canciones -->
                </div>

            </main>
        </div>
    </div>

    <!-- reproductor de musica -->
    <div class="music-player-container">
        <img src="" alt="song-cover" id="audioCover">
        <div class="title-music-container">
            <h4 class="song-title"></h4>
            <span class="song-author"></span>
        </div>
        <div class="controls-music-container">
            <div class="progress-song-container">
                <div class="progress-bar">
                    <span class="progress"></span>
                    <div class="progress-slider"></div>
                </div>
            </div>
            <div class="time-container">
                <span class="time-left" id="CurrentSongTime"></span>
                <span class="time-left" id="SongLength"></span>
            </div>
        </div>
        <audio controls preload="metadata" id="audioPlayer"></audio>
        <div class="main-song-controls">
            <img src="../assets/icons/Backward.svg" alt="Backward" class="icon" id="Back10">
            <img src="../assets/icons/backward-step-solid.svg" alt="backward-step" class="icon" id="previousTrack">
            <img src="../assets/icons/Play.svg" alt="Play" class="icon" id="PlayPause">
            <img src="../assets/icons/forward-step-solid.svg" alt="forward-step" class="icon" id="nextTrack">
            <img src="../assets/icons/Forward.svg" alt="forward-step" class="icon" id="Plus10">
        </div>
        <button id="close-btn">X</button>
    </div>

    <script src="../js/indexSession.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/326c3c7577.js"></script>


</body>

</html>