// Definición de constantes y variables
const audioPlayer = document.getElementById('audioPlayer');
const playPause = document.getElementById('PlayPause');
const plus10 = document.getElementById('Plus10');
const back10 = document.getElementById('Back10');
const nextTrack = document.getElementById('nextTrack');
const previousTrack = document.getElementById('previousTrack');
const songLength = document.getElementById('SongLength');
const currentTime = document.getElementById('CurrentSongTime');


let currentSongIndex = 0;

function mostrarCanciones() {
    let musicCards = document.querySelectorAll('.music-card');
    musicCards.forEach(function (musicCard, index) {
        let song = songs[index];
        // Encuentra los elementos dentro de musicCard usando querySelector
        let cover = musicCard.querySelector('.cover');
        let songName = musicCard.querySelector('.songName');
        let songAuthor = musicCard.querySelector('.songAuthor');
        let playButton = musicCard.querySelector('.btn-play');

        // Asigna los valores de la canción a los elementos correspondientes
        cover.src = song.cover;
        songName.textContent = song.title;
        songAuthor.textContent = song.author;

        playButton.addEventListener('click', function () {
            // Redirigir a una página HTML
            window.location.href = '../html/login.html';

            // playPause.src = '../assets/icons/pause.svg';
            // playSong(index);
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    mostrarCanciones();
    const musicContainer = document.querySelector('.musicsRow');
    const searchBar = document.getElementById('searcher');
    const clearButton = document.getElementById('limpiarBuscador');
    // Agregar evento de búsqueda
    searchBar.addEventListener('input', function () {
        const searchTerm = searchBar.value.trim().toLowerCase();
        const filteredSongs = songs.filter(song =>
            song.title.toLowerCase().includes(searchTerm) ||
            song.author.toLowerCase().includes(searchTerm)
        );

        // Limpiar el contenedor de música antes de mostrar los resultados filtrados
        musicContainer.innerHTML = '';

        // Mostrar solo las tarjetas de música que coincidan con la búsqueda
        filteredSongs.forEach((song, index) => {
            const musicCardHTML = `
                <div class="col-md-3">
                    <div class="music-card">
                        <img class="cover" src="${song.cover}" alt="">
                        <div class="music-card-description">
                            <p class="songName">${song.title}</p>
                            <p class="songAuthor">${song.author}</p>
                        </div>
                        <button class="btn btn-primary btn-play" data-index="${index}" data-src="${song.file}">
                        <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                    </button>
                    </div>
                </div>
            `;
            // Agregar la tarjeta de música al contenedor
            musicContainer.insertAdjacentHTML('beforeend', musicCardHTML);
        });
        // Obtén todos los botones de reproducción
        const btnPlayList = document.querySelectorAll('.btn-play');

        // Agrega un controlador de eventos click a cada botón de reproducción
        btnPlayList.forEach(btnPlay => {
            btnPlay.addEventListener('click', function () {
                window.location.href = 'https://ejemplo.com/nueva_pagina.html';

                // const index = parseInt(this.getAttribute('data-index'));
                // const song = filteredSongs[index];
                // playPause.src = '../assets/icons/pause.svg';
                // playSong(songs.indexOf(song));
            });
        });

    });
    // Agregar evento para limpiar el input de búsqueda
    clearButton.addEventListener('click', function () {
        searchBar.value = '';
        musicContainer.innerHTML = '';
        for (let i = 0; i < 12; i++) {
            const musicCardHTML = `
                <div class="col-md-3">
                    <div class="music-card">
                        <img class="cover" src="" alt="">
                        <div class="music-card-description">
                            <p class="songName"></p>
                            <p class="songAuthor">$</p>
                        </div>
                        <button class="btn btn-primary btn-play">
                            <img src="../assets/icons/Play.svg" alt="" class="icon-card">
                        </button>
                    </div>
                </div>
            `;
            musicContainer.insertAdjacentHTML('beforeend', musicCardHTML);
        }
        mostrarCanciones();
    });
});

function mostrarNombreUsuario() {
    // Obtener el elemento donde se mostrará el nombre de usuario
    var contenido = document.getElementById("user-option");
    contenido.innerHTML
    // Crear un elemento para mostrar el nombre de usuario
    var spanNombreUsuario = document.createElement("span");
    spanNombreUsuario.textContent = "¡Bienvenido, " + response + "!";
    // Agregar el elemento al DOM
    contenido.appendChild(spanNombreUsuario);
}

function cerrarSesion() {
    // Realizar una solicitud para cerrar la sesión
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "logout.php", true);
    xhr.send();
    // Redirigir a la página de inicio de sesión
    window.location.href = "login.html";
}



function playSong(index) {
    const song = songs[index];
    const songTitle = document.querySelector('.song-title');
    const songAuthor = document.querySelector('.song-author');
    const songCover = document.getElementById('audioCover');

    songCover.src = song.cover;
    songTitle.textContent = song.title;
    songAuthor.textContent = song.author;
    audioPlayer.src = song.file;
    audioPlayer.play();
}

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

const loadSong = (index) => {
    const song = songs[index];
    audioPlayer.src = song.file;
    document.querySelector('.song-title').textContent = song.title;
    document.querySelector('.song-author').textContent = song.author;
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

nextTrack.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    loadSong(currentSongIndex);
    audioPlayer.play();
});

previousTrack.addEventListener('click', () => {
    currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
    loadSong(currentSongIndex);
    audioPlayer.play();
});

// Event listener para pasar a la siguiente canción cuando la actual termine
audioPlayer.addEventListener('ended', () => {
    // Incrementar el índice de la canción actual
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    // Cargar y reproducir la siguiente canción
    loadSong(currentSongIndex);
    audioPlayer.play();
});

// Cargar la primera canción al cargar la página
loadSong(currentSongIndex);

