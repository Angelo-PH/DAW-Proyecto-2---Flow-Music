// Selecciona todos los elementos con la clase "premium-btn"
let premiumBtns = document.querySelectorAll(".premium-btn");
premiumBtns.forEach(function (btn) {
  btn.addEventListener("click", function (event) {
    // Realizar una petición al servidor para verificar la sesión del usuario
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/verificar_sesion.php", true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          // Si la sesión está iniciada, redirigir a formTarjeta.php
          if (xhr.responseText.trim() === "sesion_iniciada") {
            window.location.href = "../html/formTarjeta.html";
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

document.getElementById("linkFlowMusic").addEventListener("click", function (event) {
  event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
  // Realizar una solicitud AJAX para verificar la sesión
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../php/verificar_sesion.php", true);
  xhr.onreadystatechange = function () {
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
