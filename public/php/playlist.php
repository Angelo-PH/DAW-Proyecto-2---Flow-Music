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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

                        <form method="post" action="logout.php">
    <button type="submit" id="logout-btn" name="logout" class="btn btn-primary">Cerrar sesión</button>
</form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row" style="height:100%">

            <aside class="col-md-3" style="background: linear-gradient(to bottom, #000000, #f5f1f1); ">
            <img src="../assets/icons/flow-music.png" alt="flow-music.png" width="100"
                    style="display: block; margin: 0 auto; margin-top:20px;">
                    <div class="mx-2 my-2"
                    style="background-color: rgb(116, 114, 114); color: white; padding: 15px; border-radius: 7.5%;">
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
                                $nombre_lista = htmlspecialchars($row["lista_nombre"]);
                                echo "<li class='lista-elemento'>" . $nombre_lista . "</li>";
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
                            <button id="playlistForm" class="btn btn-primary"
                                style="color: white; text-decoration: none;">Crear lista de reproducción</button>
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
                    
                        <!-- Aquí colocaremos el código PHP para cargar las canciones -->
                        <?php
                        // Consulta SQL para obtener las canciones de la lista seleccionada
                        $sql = "SELECT c.cancion_nombre, c.artista_autor, c.cover FROM lista_reproduccion l
                         INNER JOIN cancion_lista cl ON l.lista_id = cl.id_lista
                         INNER JOIN cancion c ON cl.cancion_id = c.cancion_id
                         WHERE l.lista_nombre = :nombreLista LIMIT 12";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':nombreLista', $nombreLista);
                        $stmt->execute();

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
                                // Aquí se agrega el botón con la función de JavaScript para añadir la canción
                                echo '<button class="btn btn-primary btn-add" data-cancion="' . $row['cancion_nombre'] . '">Añadir a la playlist</button>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No se encontraron canciones.</p>';
                        }
                        ?>

                        <!-- Fin del código PHP para cargar las canciones -->
                </div>

                <div id="canciones-results" class="row">



                </div>
            </main>

        </div>
    </div>


    <script>
        //afegim un eventlistener a cada element de la llista
        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona todos los elementos de la lista
            var listaElementos = document.querySelectorAll('.lista-elemento');

            // Itera sobre cada elemento y agrega un event listener
            listaElementos.forEach(function (elemento) {
                //console.log(elemento.innerText);
                elemento.addEventListener('click', function () {
                    var nombreLista = this.innerText;
                    enviarNombreLista(nombreLista); // Llama a la función y pasa el nombre de la lista
                });
            });



            // Función para enviar el nombre de la lista
            function enviarNombreLista(nombreLista) {
                // AJAX request
                $.ajax({
                    type: 'POST', // o 'GET' dependiendo de cómo prefieras hacer la solicitud
                    url: 'mostrar_canciones_playlist.php', // URL donde se encuentra tu script PHP u otro backend que maneje la consulta SQL
                    data: { nombreLista: nombreLista }, // Datos que se enviarán al servidor
                    success: function (response) {
                        console.log('Resultado de la consulta:', response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', status, error);
                    }
                });
            }

        });



        $(document).ready(function () {
            $('.playlist').click(function () {
                var nombreLista = $(this).text(); // Obtener el nombre de la lista desde el texto del elemento clicado
                $.ajax({
                    type: 'POST',
                    url: 'mostrar_canciones_playlist.php',  // Reemplazar con la ruta correcta a tu script PHP
                    data: { nombreLista: nombreLista },
                    success: function (response) {
                        $('#canciones-default').html(response); // Actualizar el contenido del div con el resultado de la consulta
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', status, error);
                    }
                });
            });
        });


//----------------------------------------------------------------------------------------------------------------------------------------------------------------

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