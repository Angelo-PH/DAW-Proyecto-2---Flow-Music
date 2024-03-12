// document.getElementById("loginForm").addEventListener("submit", function(event) {
//     event.preventDefault();

//     var formData = new FormData(this);

//     fetch("/login", {
//         method: "POST",
//         body: formData
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error("Error en la solicitud");
//         }
//         return response.json();
//     })
//     .then(data => {
//         // Verificar si la respuesta contiene un mensaje de error
//         if (data.error) {
//             document.getElementById("errorMessage").style.display = "block";
//         } else {
//             // Redirigir al usuario a la página principal o realizar otras acciones necesarias
//             window.location.href = "/pagina-principal";
//         }
//     })
//     .catch(error => {
//         console.error("Error:", error);
//     });
// });
