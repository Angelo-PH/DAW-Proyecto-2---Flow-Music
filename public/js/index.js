const playButtons = document.querySelectorAll('.btn-play');
playButtons.forEach(button => {
    button.addEventListener('click', () => {
        window.location.href = '../html/login.html';
    });
});

$('#search-btn').click(function () {
    var searchTerm = $('#search-bar').val();

    // Realizar la solicitud AJAX al servidor
    $.ajax({
        url: '../php/buscar_cancion.php', // Archivo PHP para procesar la búsqueda
        method: 'POST',
        data: { searchTerm: searchTerm },
        success: function (response) {
            $('#canciones-default').html(response);

            // Agregar funcionalidad de reproducción a los botones .btn-play en los nuevos resultados
            const playButtons = document.querySelectorAll('.btn-play');

            playButtons.forEach(button => {
                button.addEventListener('click', () => {
                    window.location.href = '../html/login.html';
                });
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});