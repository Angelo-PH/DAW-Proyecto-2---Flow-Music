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

$('#search-btn').click(function () {
    var searchTerm = $('#search-bar').val();

    // Realizar la solicitud AJAX al servidor
    $.ajax({
        url: 'buscar_cancion.php', // Archivo PHP para procesar la búsqueda
        method: 'POST',
        data: { searchTerm: searchTerm },
        success: function (response) {
            $('#canciones-default').html(response);

            // Agregar funcionalidad de reproducción a los botones .btn-play en los nuevos resultados
            const playButtons = document.querySelectorAll('.btn-play');

            playButtons.forEach((button) => {
                const song = {
                    id: button.dataset.id,
                    path: button.dataset.songpath,
                    name: button.closest('.music-card').querySelector('.songName').innerText,
                    author: button.closest('.music-card').querySelector('.songAuthor').innerText,
                    cover: button.closest('.music-card').querySelector('.cover').getAttribute('src')
                };
                songs.push(song);
            
                button.addEventListener('click', () => {
                    loadAndPlaySong(song.id);
                });
            }); 
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});


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
const closeButton = document.getElementById('close-btn');
const playerContainer = document.querySelector('.music-player-container');

let currentSongId = null;
let songs = [];

playButtons.forEach((button) => {
    const song = {
        id: button.dataset.id,
        path: button.dataset.songpath,
        name: button.closest('.music-card').querySelector('.songName').innerText,
        author: button.closest('.music-card').querySelector('.songAuthor').innerText,
        cover: button.closest('.music-card').querySelector('.cover').getAttribute('src')
    };
    songs.push(song);

    button.addEventListener('click', () => {
        loadAndPlaySong(song.id);
    });
});

function loadAndPlaySong(id) {
    currentSongId = id;
    const song = songs.find(s => s.id == id);
    document.getElementById('audioCover').setAttribute('src', song.cover);
    document.querySelector('.song-title').innerText = song.name;
    document.querySelector('.song-author').innerText = song.author;
    audioPlayer.setAttribute('src', song.path);
    audioPlayer.play();
    playerContainer.style.display = 'flex';
    playPause.src = '../assets/icons/pause.svg';
}

closeButton.addEventListener('click', function () {
    // Cambiar el estilo del contenedor del reproductor
    playerContainer.style.display = 'none';
    audioPlayer.pause();
});

nextTrack.addEventListener('click', playNextSong);
previousTrack.addEventListener('click', playPreviousSong);
audioPlayer.addEventListener('ended', playNextSong);

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

function playNextSong() {
    const currentIndex = songs.findIndex(s => s.id == currentSongId);
    if (currentIndex < songs.length - 1) {
        loadAndPlaySong(songs[currentIndex + 1].id);
    } else {
        // Opcional: Si está en la última canción, puedes reiniciar al inicio
        // loadAndPlaySong(songs[0].id);
    }
}

function playPreviousSong() {
    const currentIndex = songs.findIndex(s => s.id == currentSongId);
    if (currentIndex > 0) {
        loadAndPlaySong(songs[currentIndex - 1].id);
    }
}


