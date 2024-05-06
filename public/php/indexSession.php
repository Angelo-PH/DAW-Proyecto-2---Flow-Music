    <?php
    session_start();
    $user_id = $_SESSION['usuario_id'];
    $username = $_SESSION['usuario_nombre'];
    $usermail = $_SESSION['correo_electronico'];
    $user_date = $_SESSION['fecha_registro'];
    echo $user_id;
    echo $username;
    echo $usermail;
    echo $user_date;

    // Verifica si el botón de "Cerrar sesión" fue presionado
    if (isset($_POST['logout'])) {
        // Destruye todas las variables de sesión
        session_unset();
        // Destruye la sesión
        session_destroy();

        header('Location: ../html/index.html');
        exit; // Asegura que el script se detenga después de la redirección
    }
    ?>


    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flow Music</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/indexSession.css">

    </head>

    <body>

        <header class="container-fluid bg-dark py-3">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary"><a href="premiumPlans.php" style="color: white; text-decoration: none;">Hazte Premium</a></button>
                </div>
                <div class="col text-center">
                    <h1>Flow Music</h1>
                </div>
                <div class="col text-end">
                    <img src="../assets/icons/user-solid.svg" id="user-icon" alt="user-icon" width="35px" height="auto" style="cursor: pointer;">
                    <div id="user-modal" class="modal">
                        <div class="modal-content" style="width: 600px;">
                            <span class="close">X</span>
                            <p>Hola! <?php echo $username; ?></p>
                            <p>Correo electrónico: <?php echo $usermail; ?></p>
                            <p>Fecha de registro: <?php echo $user_date; ?></p>

                            <form method="post">
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

                    <img src="../assets/icons/flow music.png" alt="FlowMusic-img" width="100" style="display: block; margin: 0 auto; margin-top:20px;">

                    <div id="playlists-div" class="bg-secondary mx-3 my-3" style="color: white;">
                        <h5>Mis listas de reproducción:</h5>
                        <ul id="playlist-ul">
                            <!-- Aquí se agregarán las playlists dinámicamente -->
                        </ul>
                        <button class="btn btn-primary" id="playlist-modal-btn" style="display: block; margin: 0 auto;">Crea tu primera lista</button>
                    </div>

                    <div id="footer">
                        <p>@2024 Flow Music</p>
                        <img src="../assets/icons/instagram.svg" width="25">
                        <img src="../assets/icons/facebook.svg" width="25">
                        <img src="../assets/icons/twitter.svg" width="25">
                    </div>
                </aside>

                <main id="main-content" class="col-md-9">
                    <div class="input-group my-3">
                        <!-- <input type="text" id="searcher" class="form-control" placeholder="¿Qué quieres escuchar?"> -->
                        <input type="text" id="search-bar" class="form-control" placeholder="Busca una canción">
                        <button id="search-btn" onclick="search()" class="btn btn-outline-secondary">Buscar</button>
                    </div>

                    <div class="row musicsRow" id="music-container">

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

        <script>
            // Obtener elementos
            var modal = document.getElementById("user-modal");
            var img = document.getElementById("user-icon");
            var closeModal = document.getElementsByClassName("close");

            // Cuando la imagen es clicada, mostrar el modal
            img.onclick = function() {
                modal.style.display = "block";
            }

            // Cuando el usuario clickea en la 'X', cerrar el modal
            closeModal.onclick = function() {
                modal.style.display = "none";
            }

            // Cuando el usuario clickea fuera del modal, cerrarlo
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            $(document).ready(function() {
                // Función para mostrar el modal cuando se hace clic en el botón
                $('#playlist-modal-btn').click(function() {
                    $('#playlistModal').modal('show');
                });

                // Función para enviar el formulario de la playlist
                $('#playlistForm').submit(function(event) {
                    event.preventDefault();
                    // Obtener el nombre de la playlist del formulario
                    var playlistName = $('#playlistName').val();
                    // Crear un nuevo elemento de lista con el nombre de la playlist
                    var newPlaylistItem = $('<li>').text(playlistName);
                    // Agregar el nuevo elemento a la lista de playlists
                    $('#playlist-ul').append(newPlaylistItem);
                    // Cerrar el modal
                    // $('#playlistModal').modal('hide');
                    // Limpiar el campo de nombre de la playlist
                    $('#playlistName').val('');
                });
            });

            function search() {
                let searchTerm = document.getElementById('search-bar').value.trim();

                if (searchTerm !== "") {
                    let xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Limpiar el contenedor antes de mostrar nuevos resultados
                                document.getElementById('music-container').innerHTML = '';

                                let songs = JSON.parse(xhr.responseText);
                                songs.forEach(function(song) {
                                    let musicCard = `
                            <div class="col-md-3">
                                <div class="music-card">
                                    <img class="cover" src="${song.cover}" alt="${song.cancion_nombre}">
                                    <div class="music-card-description">
                                        <p class="songName">${song.cancion_nombre}</p>
                                        <p class="songAuthor">${song.artista_autor}</p>
                                    </div>
                                    <button class="btn btn-primary btn-play">
                                        <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                                    </button>
                                </div>
                            </div>
                        `;
                                    document.getElementById('music-container').innerHTML += musicCard;
                                });
                            } else {
                                alert('Hubo un problema con la solicitud.');
                            }
                        }
                    };

                    // Enviar solicitud GET al archivo PHP con el término de búsqueda
                    xhr.open('GET', `buscar.php?searchTerm=${encodeURIComponent(searchTerm)}`, true);
                    xhr.send();
                } else {
                    alert('Ingrese un término de búsqueda válido.');
                }
            }
        </script>

        <script src="../js/indexSession.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/326c3c7577.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    </body>

    </html>