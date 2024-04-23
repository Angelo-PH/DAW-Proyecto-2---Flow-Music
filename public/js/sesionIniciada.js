// Obtener elementos
var modal = document.getElementById("myModal");
var img = document.getElementById("myImg");
var closeModal = document.getElementsByClassName("close")[0];

// Cuando la imagen es clicada, mostrar el modal
img.onclick = function() {
  modal.style.display = "block";
}

// Cuando el usuario clickea en la 'X', cerrar el modal
closeModal.onclick = function() {
  modal.style.display = "none";
}

// Cuando el usuario clickea fuera del modal, cerrarlo
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
