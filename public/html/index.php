<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flow Music</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <a href="index.php" style="text-decoration: none;">
                    <h1>Flow Music</h1>
                </a>
            </div>
            <div id="user-options" class="col text-end">
                <a href="registrate.html" id="linkRegistrate">Registrate</a>
                <button type="button" class="btn btn-primary"><a href="login.html"
                        style="color: white; text-decoration: none;">Iniciar Sesión</a> </button>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <aside class="col-md-3 bg-light" style="background: linear-gradient(to bottom, #000000, #f5f1f1);">
                <img src="../assets/icons/flow-music.png" alt="flow-music.png" width="100"
                    style="display: block; margin: 0 auto; margin-top:20px;">

                <div class="mx-2 my-2"
                    style="background-color: rgb(116, 114, 114); color: white; padding: 15px; border-radius: 7.5%;">
                    <h2>Biblioteca</h2>
                    <h4>Mis listas de reproducción:</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <button class="btn btn-primary" style="display: block; margin: 0 auto;"
                        onclick="window.location.href = 'login.html';">Crea una lista</button>
                    <h4>Mis Albumes favoritos:</h4>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <button class="btn btn-primary" style="display: block; margin: 0 auto;"
                        onclick="window.location.href = 'login.html';">Agrega albumes</button>
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
                    <input type="text" id="search-bar" class="form-control"
                        placeholder="Busca una canción o artista...">
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

    <script src="../js/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/326c3c7577.js"></script>

</body>

</html>