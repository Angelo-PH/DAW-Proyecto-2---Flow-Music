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
                <button type="button" class="btn btn-primary">
                    <a href="../php/premiumPlans.php" style="color: white; text-decoration: none;">Hazte Premium</a>
                </button>
            </div>
            <div class="col text-center">
                <h1>Flow Music</h1>
            </div>
            <div id="user-options" class="col text-end">
                <a href="registrate.html" id="linkRegistrate">Registrarte</a>
                <button type="button" class="btn btn-primary"><a href="login.html"
                        style="color: white; text-decoration: none;">Iniciar Sesión</a> </button>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <aside class="col-md-3 bg-light" style="background: linear-gradient(to bottom right, #f5f1f1, #353434);">
                <div id="botonesInicio" class="bg-secondary mx-3 my-3">
                    <a href="../html/index.html"><img src="../assets/icons/flow music.png" alt="FlowMusic" width="100"
                            style="display: block; margin: 0 auto;"></a>
                    <a style="text-align: center; font-weight: bold;">Inicia sesión para disfrutar del maximo
                        rendimiento de Flow Music.</a>
                </div>

                <div>
                    <div id="playlists" class="bg-secondary mx-3 my-3" style="color: white;">
                        <h3>Tu biblioteca</h3>
                        <h5>Crea tu propia lista de reproducción</h5>
                        <h5>Mis playlist:</h5>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <button class="btn btn-primary" id="openModalBtn" style=" display: block; margin: 0 auto;">Crear
                            nueva
                            Playlist</button>
                    </div>
                </div>

                <!-- Modal para iniciar sesión -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="loginModalLabel">Inicia sesión</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Debes iniciar sesión para crear una playlist.</p>
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

            <main id="main-content" class="col-md-9">
                <div class="input-group my-3">
                    <!-- <input type="text" id="searcher" class="form-control" placeholder="¿Qué quieres escuchar?"> -->
                    <input type="text" id="search-bar" class="form-control" placeholder="Busca una canción">
                    <button id="search-btn" onclick="search()" class="btn btn-outline-secondary">Buscar</button>
                </div>

                <div id="canciones-default">
                    <div class="row musicsRow">

                        <!-- Aquí colocaremos el código PHP para cargar las canciones -->
                        <?php
                        // Incluir la clase Database y realizar la consulta
                        require_once '../../config/Database.php';
                        $database = new Database();
                        $conn = $database->connect();

                        // Consulta SQL para obtener las canciones
                        $sql = "SELECT cancion_nombre, artista_autor, cover FROM cancion LIMIT 12";
                        $stmt = $conn->query($sql);

                        // Mostrar las canciones en los elementos HTML
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
                            echo '<p>No se encontraron canciones.</p>';
                        }
                        ?>
                        <!-- Fin del código PHP para cargar las canciones -->
                    </div>
                </div>

                <div id="canciones-results" class="row">



                </div>
            </main>

        </div>
    </div>

    <script src="../js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            // Función para mostrar el modal de inicio de sesión cuando se hace clic en el botón "Crear nueva Playlist"
            $('#openModalBtn').click(function () {
                // Verificar si el usuario está autenticado (puedes usar una variable global o cualquier otro método de tu aplicación)
                var userAuthenticated = false; // Por ahora, lo establecemos en falso para simular que el usuario no está autenticado

                if (userAuthenticated) {
                    // Si el usuario está autenticado, se muestra el modal para crear una nueva playlist
                    $('#playlistModal').modal('show');
                } else {
                    // Si el usuario no está autenticado, se muestra el modal de inicio de sesión
                    $('#loginModal').modal('show');
                }
            });
        });
    </script>

</body>

</html>