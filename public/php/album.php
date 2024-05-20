<?php
session_start();
$user_id = $_SESSION['usuario_id'];
$username = $_SESSION['usuario_nombre'];
$usermail = $_SESSION['correo_electronico'];
$user_date = $_SESSION['fecha_registro'];

// Verifica si el botón de "Cerrar sesión" fue presionado
if (isset($_POST['logout'])) {
    // Destruye todas las variables de sesión
    session_unset();
    // Destruye la sesión
    session_destroy();
    header('Location: ../html/index.php');
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

                        <form method="post" action="logout.php">
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
                <img src="../assets/icons/flow-music.png" alt="flow-music.png" width="100"
                    style="display: block; margin: 0 auto; margin-top:20px;">
                <div class="mx-2 my-2"
                    style="background-color: rgb(116, 114, 114); color: white; padding: 15px; border-radius: 7.5%;">
                    <h4>Mis Albumes favoritos:</h4>
                    <ul>

                    </ul>
                </div>

            </aside>

            <main id="main-content" class="col-md-9">
                <h1>Albumes disponibles: </h1>
                <div class="row">

                    <?php
                    require_once '../../config/Database.php';
                    $database = new Database();
                    $conn = $database->connect();

                    // Consulta SQL para obtener las canciones
                    $sql = "SELECT a.album_id, a.album_nom, a.cover, a.año_lanzamiento, ar.artista_nombre, g.genero_nom
                FROM album a
                JOIN artista ar ON a.id_autor = ar.artista_id
                JOIN genero g ON a.id_genero = g.genero_id;";
                    $stmt = $conn->query($sql);

                    // Mostrar las canciones en los elementos HTML
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="col-md-3">';
                            echo '<div class="music-card">';
                            echo '<img class="cover" src="' . $row['cover'] . '">';
                            echo '<div class="music-card-description">';
                            echo '<p class="songName">' . $row['album_nom'] . '</p>';
                            echo '<p class="songAuthor">' . $row['artista_nombre'] . '</p>';
                            echo '<p class="songAuthor">' . $row['año_lanzamiento'] . '</p>';
                            echo '<p class="songAuthor">' . $row['genero_nom'] . '</p>';
                            echo '</div>';
                            echo '<button class="btn btn-primary">Añadir album</button>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No se encontraron Albumes.</p>';
                    }


                    ?>
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
    </script>
</body>

</html>