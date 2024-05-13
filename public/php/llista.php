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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/indexSession.css">
    <!-- <script src="../js/indexSession.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/326c3c7577.js" crossorigin="anonymous"></script>


</head>

<body>

    <header class="container-fluid bg-dark py-3">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary"><a href="premiumPlans.php"
                        style="color: white; text-decoration: none;">Hazte Premium</a></button>
            </div>
            <div class="col text-center">
                <a href="indexSession.php" style="text-decoration: none; color: inherit;">
                    <h1 style="text-align: center;">Flow Music</h1>
                </a>
            </div>
            <div class="col text-end">
                <img src="../assets/icons/user-solid.svg" id="user-icon" alt="user-icon" width="35px" height="auto"
                    style="cursor: pointer;">
                <div id="user-modal" class="modal">
                    <div class="modal-content" style="width: 600px;">
                        <button class="close" onclick="closeModal()" style="font-size: smaller;">X</button>
                        <p>Hola! <?php echo $username; ?></p>
                        <p>Correo electrónico: <?php echo $usermail; ?></p>
                        <p>Fecha de registro: <?php echo $user_date; ?></p>

                        <form method="post">
                            <button type="submit" id="logout-btn" name="logout" class="btn btn-primary">Cerrar
                                sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row" style="height:100%">

            <aside class="col-md-3" style="background: linear-gradient(to bottom, #000000, #f5f1f1); ">

                <a href="indexSession.php">
                    <img src="../assets/icons/flow music.png" alt="FlowMusic-img" width="100"
                        style="display: block; margin: 0 auto; margin-top:20px;">
                </a>


                <div id="playlists-div" class="bg-secondary mx-3 my-3" style="color: white;">
                    <h5>Mis listas de reproducción:</h5>
                    <ul id="playlist-ul">
                    <?php
                        // Requiere el archivo de configuración de la base de datos
                        require_once '../../config/Database.php';

                        // Crea una instancia de la clase Database para establecer la conexión
                        $database = new Database();
                        $conn = $database->connect();

                        // Consulta SQL para obtener las listas de reproducción
                        $sql = "SELECT lista_id, lista_nombre FROM lista_reproduccion";
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
                </div>
                <main class="col-md-9">
                <div>
                    <form action="solicitud_playlist.php" method="post" style="text-align: center;">
                        <input type="text" name="playlistName" style="width: 220px;">
                        <button id="playlistForm" class="btn btn-primary" style="color: white; text-decoration: none;">Crear lista de reproducción</button>
                    </form>

                    
                </div>
            </main>

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


    <script>
        // Función para cerrar el modal
        function closeModal() {
            console.log("Botón de cierre clicado");
            var modal = document.getElementById('user-modal');
            modal.style.display = 'none';
        }

        // Obtener elementos
        var modal = document.getElementById("user-modal");
        var img = document.getElementById("user-icon");
        var closeButtons = document.getElementsByClassName("close");

        // Cuando la imagen es clicada, mostrar el modal
        img.onclick = function () {
            modal.style.display = "block";
        }

        // Cuando el usuario clickea fuera del modal, cerrarlo
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        //MUESTRE MENSAJE PLAYLIST SE CREO OK
        <?php if (isset($_SESSION['playlist_created_message']) && !empty($_SESSION['playlist_created_message'])) { ?>
            // Mostramos el mensaje en forma de alerta
            alert("<?php echo $_SESSION['playlist_created_message']; ?>");
            // Limpiamos la variable de sesión
            <?php unset($_SESSION['playlist_created_message']); ?>;
        <?php } ?>
        //------------------------------------------------------------------------------------------------------------------------------------------

        //PLAYLIST NO SE CREO     
        <?php if (isset($_SESSION['playlist_creation_error']) && !empty($_SESSION['playlist_creation_error'])) { ?>
            // Mostramos el mensaje de error en forma de alerta
            alert("<?php echo $_SESSION['playlist_creation_error']; ?>");
            <?php
            // Limpiamos la variable de sesión de error
            unset($_SESSION['playlist_creation_error']);
            ?>
        <?php } ?>




    </script>

</body>

</html>