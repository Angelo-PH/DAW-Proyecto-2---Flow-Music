<?php
session_start();

// Verificar si la variable de sesión 'usuario_nombre' está establecida para determinar si el usuario está autenticado
if (isset($_SESSION['usuario_nombre'])) {
  $username = $_SESSION['usuario_nombre'];
  $usermail = $_SESSION['correo_electronico'];
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
  <title>FlowMusic Premium</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/premiumPlans.css">
  <script src="https://kit.fontawesome.com/4bab62df81.js" crossorigin="anonymous"></script>
  <script src="../js/premiumPlans.js"></script>

</head>

<body style="background: linear-gradient(to bottom, #000000, #f5f1f1); height:100%">
  <header class="container-fluid bg-dark py-3">
    <div class="row">
      <div class="col text-center">
        <h1>Flow Music</h1>
      </div>
    </div>
  </header>

  <main>
    <div class="row g-4">
      <div class="col-md-3 mb-3" style="margin-top:10%;">
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
            <a class="w-100 btn btn-lg btn-primary premium-btn" href="formTarjeta.php">Suscribirse a prime</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3" style="margin-top:10%;">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Prime 3 meses</h4>
          </div>
          <div class="card-body text-center">
            <h1 class="card-title pricing-card-title">8,50€<small class="text-body-secondary fw-light">/mes</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Sin anuncios</li>
              <li>Musica ilimitada</li>
              <li>Reproducción en linea</li>
              <li>Acceso a ayuda en linea</li>
            </ul>
            <a class="w-100 btn btn-lg btn-primary premium-btn" href="formTarjeta.php">Suscribirse a prime
              trimestral</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3" style="margin-top:10%;">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Prime 6 meses</h4>
          </div>
          <div class="card-body text-center">
            <h1 class="card-title pricing-card-title">7,50€<small class="text-body-secondary fw-light">/mes</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Sin anuncios</li>
              <li>Musica ilimitada</li>
              <li>Reproducción en linea</li>
              <li>Acceso a ayuda en linea</li>
            </ul>
            <a class="w-100 btn btn-lg btn-primary premium-btn" href="formTarjeta.php">Suscribirse a prime semestral</a>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3" style="margin-top:10%;">
        <div class="card mb-4 rounded-3 shadow-sm">
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
            <a class="w-100 btn btn-lg btn-primary premium-btn" href="formTarjeta.php">Suscribirse a prime anual</a>
          </div>
        </div>
      </div>

    </div>

  </main>



</body>

</html>