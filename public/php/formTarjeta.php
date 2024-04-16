<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscribirse en FlowMusic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/premiumLogin.css">
    <script src="https://kit.fontawesome.com/4bab62df81.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container-fluid bg-dark py-4">
        <div class="col text-center">
            <a href="../html/index.html">Flow Music</a></href>
        </div>
    </header>


    <form id="loginForm">
        <h1>Suscribirse en Flow Music</h1>
        <p>Únete a Prime y disfruta de beneficios exclusivos.</p>
        <form action="/suscripcion" method="POST">

            <label for="tarjeta">Número de tarjeta de crédito:</label>
            <input type="text" id="tarjeta" name="tarjeta" required>

            <label for="nombre">Nombre del titular de la tarjeta:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="fecha">Fecha de expiración:</label>
            <input type="text" id="fecha" name="fecha" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="password" id="cvv" name="cvv" maxlength="3" required>
            <input type="submit" value="Suscribirse">
        </form>

        <footer>
            <p>&copy; 2024 Flow Music</p>
            <div class="redes-sociales">
                <a href="https://www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="https://www.tiktok.com"><i class="fab fa-tiktok"></i> TikTok</a>
                <a href="https://www.twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
            </div>
        </footer>

</body>

</html>
