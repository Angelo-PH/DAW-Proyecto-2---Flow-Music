<?php
// Inicia la sesión
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_nombre'])) {
     // Si el usuario no está autenticado, redirige a la página de inicio de sesión
     header("Location: login.php");
     exit(); // Asegura que el script termine después de la redirección
 }

// Obtener el nombre de usuario de la sesión
$usuario_nombre = $_SESSION['usuario_nombre'];
$usuario_email = $_SESSION['correo_electronico'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Music</title>
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <header class="container-fluid bg-dark py-4">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary"><a href="premium.php"
                        style="color: white; text-decoration: none;">Hazte Premium</a></button>
            </div>
            <div class="col text-center">
                <h1>Flow Music</h1>
            </div>
            <div id="user-options" class="col text-end">
                <img src="../assets/icons/user-solid.svg" alt="Icono SVG" width="40px" height="auto">
                <span id="username">
                    <?php echo "Bienvenido! " . $usuario_nombre; ?>
                </span>
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <aside class="col-md-3 bg-light" style="background: linear-gradient(to bottom right, #f5f1f1, #353434);">
                <div id="botonesInicio" class="bg-secondary mx-3 my-3">
                    <a href="indexIniciado.php"><img src="../assets/icons/flow music.png" alt="FlowMusic" width="100"
                            style="display: block; margin: 0 auto;"></a>
                    <a href="#searcher" style="display: block;"><img src="../assets/icons/magnifying-glass-solid.svg"
                            width="20"> Buscar</a>
                </div>

                <div>
                    <div id="playlists" class="bg-secondary mx-3 my-3" style="color: white;">
                        <h2>Tu biblioteca</h2>
                        <h4>Crea tu propia lista de Reproducción</h4>
                        <h4>Mis playlist:</h4>
                        <ul>
                            <li>el ñaño es gay</li>
                            <li>el ñaño la tiene pequeña</li>
                            <li>al ñaño le gustan las menores</li>
                        </ul>
                        <button class="btn btn-primary" style=" display: block; margin: 0 auto;">Crear nueva
                            Playlist</button>

                    </div>
                </div>

                <div id="footer">
                    <p>@2024 Flow Music</p>
                    <img src="../assets/icons/instagram.svg" width="25">
                    <img src="../assets/icons/facebook.svg" width="25">
                    <img src="../assets/icons/twitter.svg" width="25">
                </div>
            </aside>

            <main class="col-md-9">
                <div class="input-group my-3">
                    <input type="text" id="searcher" class="form-control" placeholder="¿Qué quieres escuchar?">
                    <button class="btn btn-outline-secondary" type="button" id="limpiarBuscador">X</button>
                </div>

                <div class="row musicsRow">

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="music-card">
                            <img class="cover" src="" alt="">
                            <div class="music-card-description">
                                <p class="songName"></p>
                                <p class="songAuthor"></p>
                            </div>
                            <button class="btn btn-primary btn-play">
                                <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                            </button>
                        </div>
                    </div>

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
                </div>
            </div>
            <div class="time-container">
                <span class="time-left" id="CurrentSongTime"></span>
                <span class="time-left" id="SongLength"></span>
            </div>
        </div>
        <audio controls preload="metadata" id="audioPlayer"></audio>
        <div class="main-song-controls">
            <img src="../assets/icons/Backward.svg" alt="" class="icon" id="Back10">
            <img src="../assets/icons/backward-step-solid.svg" alt="" class="icon" id="previousTrack">
            <img src="../assets/icons/Play.svg" alt="" class="icon" id="PlayPause">
            <img src="../assets/icons/forward-step-solid.svg" alt="" class="icon" id="nextTrack">
            <img src="../assets/icons/Forward.svg" alt="" class="icon" id="Plus10">
        </div>
    </div>

    <script src="https://kit.fontawesome.com/326c3c7577.js" crossorigin="anonymous"></script>
    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>