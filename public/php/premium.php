<?php
// Inicia la sesión
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FlowMusic Premium</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/premium.css">
  <script src="https://kit.fontawesome.com/4bab62df81.js" crossorigin="anonymous"></script>
  <style>
    .col1:hover {
      transform: scale(1.05);
      transition: transform 0.3s ease;
    }
  </style>
</head>

<body>
  <header class="container-fluid bg-dark py-4">
    <div class="col text-center">
      <a href="../html/index.html" id="linkFlowMusic">Flow Music</a></href><br>
    </div>
    <main class="text-center text-white">
      <a>Planes de suscripción para FlowMusic</a>
    </main>
  </header>

  <main>
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-md-3 mb-3">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Prime</h4>
            </div>
            <div class="card-body text-center">
              <h1 class="card-title pricing-card-title">10€<small class="text-body-secondary fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Sin anuncios</li>
                <li>Musica ilimitada</li>
                <li>Reproducción en linea</li>
                <li>Acceso a ayuda en linea</li>
              </ul>
              <a class="w-100 btn btn-lg btn-primary premium-btn">Suscribirse a prime</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Prime 3 meses</h4>
            </div>
            <div class="card-body text-center">
              <h1 class="card-title pricing-card-title">8,50€<small class="text-body-secondary fw-light">/mes</small>
              </h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Sin anuncios</li>
                <li>Musica ilimitada</li>
                <li>Reproducción en linea</li>
                <li>Acceso a ayuda en linea</li>
              </ul>
              <a class="w-100 btn btn-lg btn-primary premium-btn">Suscribirse a prime
                trimestral</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Prime 6 meses</h4>
            </div>
            <div class="card-body text-center">
              <h1 class="card-title pricing-card-title">7,50€<small class="text-body-secondary fw-light">/mes</small>
              </h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Sin anuncios</li>
                <li>Musica ilimitada</li>
                <li>Reproducción en linea</li>
                <li>Acceso a ayuda en linea</li>
              </ul>
              <a class="w-100 btn btn-lg btn-primary premium-btn">Suscribirse a prime semestral</a>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card mb-4 rounded-3 shadow-sm border-primary">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal">Prime 12 meses</h4>
            </div>
            <div class="card-body text-center">
              <h1 class="card-title pricing-card-title">6€<small class="text-body-secondary fw-light">/mes</small></h1>
              <ul class="list-unstyled mt-3 mb-4">
                <li>Sin anuncios</li>
                <li>Musica ilimitada</li>
                <li>Reproducción en linea</li>
                <li>Acceso a ayuda en linea</li>
              </ul>
              <a class="w-100 btn btn-lg btn-primary premium-btn">Suscribirse a prime anual</a>
            </div>
          </div>
        </div>
      </div>
  </main>
  <br><br><br>

  <footer>
    <p>&copy; 2024 Flow Music</p>
    <div class="redes-sociales">
      <a href="https://www.instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
      <a href="https://www.tiktok.com"><i class="fab fa-tiktok"></i> TikTok</a>
      <a href="https://www.twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
    </div>
  </footer>

  <script>
    // Selecciona todos los elementos con la clase "premium-btn"
    let premiumBtns = document.querySelectorAll(".premium-btn");
    premiumBtns.forEach(function (btn) {
      btn.addEventListener("click", function (event) {
        // Realizar una petición al servidor para verificar la sesión del usuario
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "verificar_sesion.php", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              // Si la sesión está iniciada, redirigir a formTarjeta.php
              if (xhr.responseText.trim() === "sesion_iniciada") {
                window.location.href = "formTarjeta.php";
              } else {
                // Si la sesión no está iniciada, redirigir a login.html
                window.location.href = "../html/login.html";
              }
            } else {
              console.error("Error al verificar la sesión");
            }
          }
        };
        xhr.send();
        // Evitar que el navegador siga el enlace por defecto
        event.preventDefault();
      });
    });

    document.getElementById("linkFlowMusic").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
    
    // Realizar una solicitud AJAX para verificar la sesión
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "verificar_sesion.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Si la respuesta es "sesion_iniciada", redirigir a indexIniciado.php
            if (xhr.responseText === "sesion_iniciada") {
                window.location.href = "indexIniciado.php";
            } else {
                // Si la respuesta es "sesion_no_iniciada", redirigir a ../html/index.html
                window.location.href = "../html/index.html";
            }
        }
    };
    xhr.send();
});
  </script>

</body>

</html>