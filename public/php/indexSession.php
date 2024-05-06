<?php
session_start();

// Verificar si la variable de sesión 'usuario_nombre' está establecida para determinar si el usuario está autenticado
if (isset($_SESSION['usuario_nombre'])) {
    $username = $_SESSION['usuario_nombre'];
    $usermail = $_SESSION['correo_electronico'];
    $user_id = $_SESSION['usuario_id'];
} else {
    // Si no hay sesión activa, redirigir a la página de inicio de sesión
    header("Location: ../html/login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Music</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/sesionIniciada.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>

    <header class="container-fluid bg-dark py-4">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary"><a href="premiumPlans.php"
                        style="color: white; text-decoration: none;">Hazte Premium</a></button>
            </div>
            <div class="col text-center">
                <h1>Flow Music</h1>
            </div>
            <div id="user-options" class="col text-end">
                <img src="../assets/icons/user-solid.svg" id="myImg" alt="Icono SVG" width="35px" height="auto"
                    style="cursor: pointer;">

                <div id="myModal" class="modal">
                    <div class="modal-content" style="width: 600px;">
                        <span class="close">&times;</span>
                        <p>Bienvenido, <?php echo $username; ?></p>
                        <p>Tu correo electrónico es: <?php echo $usermail; ?></p>

                        <form action="logout.php" method="post">
                            <button type="submit" id="buttonLogout" name="logout" class="btn btn-primary">Cerrar
                                sesión</button>
                        </form>
                    </div>
                </div>
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
                        <h4>Tu biblioteca</h4>
                        <h5>Crea tu propia lista de reproducción</h5>
                        <h5>Mis playlist:</h5>
                        <ul id="playlistList">
                            <!-- Aquí se agregarán las playlists dinámicamente -->
                        </ul>
                        <button class="btn btn-primary" id="openModalBtn" style="display: block; margin: 0 auto;">Crear
                            nueva Playlist</button>
                    </div>
                </div>

                <!-- Modal para crear una nueva playlist -->
                <div class="modal fade" id="playlistModal" tabindex="-1" role="dialog"
                    aria-labelledby="playlistModalLabel" aria-hidden="true" style="margin-bottom: 400px;">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Encabezado del modal -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="playlistModalLabel" style="color: black">Crear nueva
                                    Playlist</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- Cuerpo del modal -->
                            <div class="modal-body">
                                <!-- Formulario básico -->
                                <form id="playlistForm" action="solicitud_playlist.php" method="POST">
                                    <div class="form-group">
                                        <label for="playlistName" style="color: black;">Nombre de la Playlist:</label>
                                        <input type="text" class="form-control" id="playlistName" name="playlistName"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="privacy-cookies-links" class="mx-3 my-3">
                    <h5>Información Legal</h5>
                    <ul style="list-style: none; padding: 0;">
                        <li><a href="../informacion_legal/politica_privacidad.html"
                                style="text-decoration: none; color: inherit;">Política de Privacidad</a></li>
                        <li><a href="../informacion_legal/configuracion_cookies.html"
                                style="text-decoration: none; color: inherit;">Configuración de Cookies</a></li>
                        <li><a href="../informacion_legal/seguridad_privacidad.html"
                                style="text-decoration: none; color: inherit;">Seguridad y centro de privacidad</a></li>
                        <li><a href="../informacion_legal/anuncios.html"
                                style="text-decoration: none; color: inherit;">Informacion de anuncios</a></li>
                        <li><a href="../informacion_legal/accesibilidad.html"
                                style="text-decoration: none; color: inherit;">Accesibilidad</a></li>
                    </ul>
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
                    <!-- <input type="text" id="searcher" class="form-control" placeholder="¿Qué quieres escuchar?"> -->
                    <input type="text" id="search-bar" class="form-control" placeholder="Busca una canción">
                    <button id="search-btn" onclick="search()" class="btn btn-outline-secondary">Buscar</button>
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
    <script src="../js/indexSession.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        // Obtener elementos
        var modal = document.getElementById("myModal");
        var img = document.getElementById("myImg");
        var closeModal = document.getElementsByClassName("close")[0];

        // Cuando la imagen es clicada, mostrar el modal
        img.onclick = function () {
            modal.style.display = "block";
        }

        // Cuando el usuario clickea en la 'X', cerrar el modal
        closeModal.onclick = function () {
            modal.style.display = "none";
        }

        // Cuando el usuario clickea fuera del modal, cerrarlo
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        $(document).ready(function () {
            // Función para mostrar el modal cuando se hace clic en el botón
            $('#openModalBtn').click(function () {
                $('#playlistModal').modal('show');
            });

            // Función para enviar el formulario de la playlist
            $('#playlistForm').submit(function (event) {
                event.preventDefault();
                // Obtener el nombre de la playlist del formulario
                var playlistName = $('#playlistName').val();
                // Crear un nuevo elemento de lista con el nombre de la playlist
                var newPlaylistItem = $('<li>').text(playlistName);
                // Agregar el nuevo elemento a la lista de playlists
                $('#playlistList').append(newPlaylistItem);
                // Cerrar el modal
                // $('#playlistModal').modal('hide');
                // Limpiar el campo de nombre de la playlist
                $('#playlistName').val('');
            });
        });

        function search() {
            var nombre = document.getElementById('search-bar').value;
            if (nombre != "") {
                // Hacer la solicitud AJAX a PHP
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Cuando se recibe la respuesta, mostrar en pantalla
                            document.getElementsByClassName('musicsRow').innerHTML = xhr.responseText;

                        } else {
                            alert('Hubo un problema con la solicitud.');
                        }
                    }
                };
                xhr.open('GET', 'buscar.php?nombre=' + nombre, true);
                xhr.send();
            } else {
                location.href = "indexSession.php";
            }

        }

    </script>

    <script src="https://kit.fontawesome.com/326c3c7577.js" crossorigin="anonymous"></script>
    <script src="../js/indexSession.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</body>

</html>