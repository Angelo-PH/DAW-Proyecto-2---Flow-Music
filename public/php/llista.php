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
                <h1>Flow Music</h1>
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

                <img src="../assets/icons/flow music.png" alt="FlowMusic-img" width="100"
                    style="display: block; margin: 0 auto; margin-top:20px;">

                <div id="playlists-div" class="bg-secondary mx-3 my-3" style="color: white;">
                    <h5>Mis listas de reproducción:</h5>
                    <ul id="playlist-ul">

                    </ul>
                </div>

            </aside>

            <main class="col-md-9">
                <div>
                    <form action="solicitud_playlist.php" method="post">
                        <input type="text" name="playlistName">
                        <button>Crear lista de reproducción</button>
                    </form>
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



        $(document).ready(function () {
            // Función para enviar el formulario de la playlist
            $('#playlistForm').submit(function (event) {
                event.preventDefault();
                // Obtener el nombre de la playlist del formulario
                var playlistName = $('#playlistName').val();

                // Realizar la solicitud AJAX para crear la playlist
                $.ajax({
                    url: 'solicitud_playlist.php',
                    type: 'POST',
                    data: { playlistName: playlistName },
                    success: function (response) {
                        // Verificar si la respuesta indica éxito
                        if (response === "success") {
                            // Agregar la nueva playlist al <ul>
                            var newPlaylistItem = $('<li>').text(playlistName);
                            $('#playlist-ul').append(newPlaylistItem);
                            // Limpiar el campo de nombre de la playlist
                            $('#playlistName').val('');
                            // Mostrar el mensaje de éxito
                            alert("Playlist creada correctamente.");
                        } else {
                            // Si la respuesta indica un error, mostrar un mensaje de error
                            alert("Error al crear la playlist.");
                        }
                    },
                    error: function () {
                        // En caso de error en la solicitud AJAX, mostrar un mensaje de error
                        alert("Error en la solicitud AJAX.");
                    }
                });
            });
        });




    </script>

</body>

</html>