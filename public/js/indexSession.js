// Definición de constantes y variables
const audioPlayer = document.getElementById('audioPlayer');
const playPause = document.getElementById('PlayPause');
const plus10 = document.getElementById('Plus10');
const back10 = document.getElementById('Back10');
const nextTrack = document.getElementById('nextTrack');
const previousTrack = document.getElementById('previousTrack');
const songLength = document.getElementById('SongLength');
const currentTime = document.getElementById('CurrentSongTime');
const playButtons = document.querySelectorAll('.btn-play');

const progressSlider = document.querySelector('.progress-slider');
let isDragging = false;

// Función para actualizar el tiempo de reproducción basado en la posición del control deslizante
const updateProgress = (x) => {
    const progressContainer = document.querySelector('.progress-bar');
    const progressWidth = progressContainer.clientWidth;
    const clickPosition = x - progressContainer.getBoundingClientRect().left;
    let percentage = (clickPosition / progressWidth) * 100;
    percentage = Math.max(0, Math.min(100, percentage)); // Limita el porcentaje entre 0 y 100

    const newTime = (percentage / 100) * audioPlayer.duration;
    audioPlayer.currentTime = newTime;

    // Actualiza la posición del control deslizante
    progressSlider.style.left = `${percentage}%`;
};

// Eventos de mouse para el control deslizante
progressSlider.addEventListener('mousedown', (e) => {
    isDragging = true;
    updateProgress(e.clientX);
});

document.addEventListener('mousemove', (e) => {
    if (isDragging) {
        updateProgress(e.clientX);
    }
});

document.addEventListener('mouseup', () => {
    if (isDragging) {
        isDragging = false;
    }
});

// Actualiza la posición del control deslizante cuando cambia el tamaño de la ventana
window.addEventListener('resize', () => {
    const progressPercentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressSlider.style.left = `${progressPercentage}%`;
});

playButtons.forEach(button => {
    button.addEventListener('click', () => {
        const songpath = button.dataset.songpath;
        const songName = button.closest('.music-card').querySelector('.songName').innerText;
        const songAuthor = button.closest('.music-card').querySelector('.songAuthor').innerText;
        const songCover = button.closest('.music-card').querySelector('.cover').getAttribute('src');
        // Update music player information
        document.getElementById('audioCover').setAttribute('src', songCover);
        document.querySelector('.song-title').innerText = songName;
        document.querySelector('.song-author').innerText = songAuthor;
        // Load song into audio player
        audioPlayer.setAttribute('src', `${songpath}`);
        // Play the loaded song
        audioPlayer.play();
        playPause.src = '../assets/icons/pause.svg';
    });
});

function cerrarSesion() {
    // Realizar una solicitud para cerrar la sesión
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/logout.php", true);
    xhr.send();
}

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

$(document).ready(function () {
    $('#search-btn').click(function () {
        var searchTerm = $('#search-bar').val();

        // Realizar la solicitud AJAX al servidor
        $.ajax({
            url: 'buscar_cancion.php', // Archivo PHP para procesar la búsqueda
            method: 'POST',
            data: { searchTerm: searchTerm },
            success: function (response) {
                $('#canciones-default').html('');
                $('#canciones-results').html(response); // Mostrar los resultados en el contenedor
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});




// Funciones de utilidad
const calculateTime = (secs) => {
    const minutes = Math.floor(secs / 60);
    const seconds = Math.floor(secs % 60);
    const returnedSeconds = seconds < 10 ? `0${seconds}` : `${seconds}`;
    return `${minutes}:${returnedSeconds}`;
}

const displayDuration = () => {
    songLength.innerHTML = calculateTime(audioPlayer.duration);
}

const setProgress = () => {
    let percentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    document.querySelector('.progress').style.width = percentage + '%';
}

// Event listeners
audioPlayer.addEventListener('loadedmetadata', () => {
    displayDuration();
});

audioPlayer.addEventListener('timeupdate', () => {
    currentTime.innerHTML = calculateTime(audioPlayer.currentTime);
    setProgress();
});

playPause.addEventListener('click', () => {
    if (audioPlayer.paused) {
        playPause.src = '../assets/icons/pause.svg';
        audioPlayer.play();
    } else {
        playPause.src = '../assets/icons/Play.svg';
        audioPlayer.pause();
    }
});

plus10.addEventListener('click', () => {
    audioPlayer.currentTime += 10;
});

back10.addEventListener('click', () => {
    audioPlayer.currentTime -= 10;
});


