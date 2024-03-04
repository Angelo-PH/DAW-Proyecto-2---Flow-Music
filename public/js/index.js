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

// Lista de canciones
const songs = [
    { title: "El sonido de campanas", author: "Oscar Lee", file: "../assets/media/audio/Oscar Lee - EL SONIDO DE CAMPANAS.mp3", cover: "../assets/media/img/elSonidoDeCampanas.jpg" },
    { title: "A 300", author: "JC Reyes", file: "../assets/media/audio/Mp3juice.blog JC REYES - A 300.mp3", cover: "../assets/media/img/A300.jpg" },
    { title: "Me prefieres a mí", author: "Arcangel", file: "../assets/media/audio/Arcangel - Me Prefieres a Mi [Official Video].mp3", cover: "../assets/media/img/mePrefieresAMi.jpg" },
    { title: "Entramos Disparando", author: "Ñengo Flow", file: "../assets/media/audio/Ñengo Flow - Entramos Disparando [Official Audio].mp3", cover: "../assets/media/img/entramosDisparando.jpg" },
    { title: "Y si la ves", author: "Ñejo", file: "../assets/media/audio/ÑEJO - Y SI LA VES.mp3", cover: "../assets/media/img/ySiLaVes.jpg" },
    { title: "Or Nah", author: "Anuel AA", file: "../assets/media/audio/Or Nah.mp3", cover: "../assets/media/img/orNah.jpg" },
    { title: "Escápate conmigo Remix", author: "Wolfine", file: "../assets/media/audio/Escápate Conmigo (Remix).mp3", cover: "../assets/media/img/escapateConmigoRemix.jpg" },
    { title: "A escondidas", author: "$kyhook", file: "../assets/media/audio/$kyhook - A Escondidas (Audio) ft. Morad.mp3", cover: "../assets/media/img/aEscondidas.jpg" },
    { title: "34 Amor y mafia", author: "JC Reyes", file: "../assets/media/audio/34 AMOR Y MAFIA REMIX FT ECKO, PABLO CHILL-E, EL JINCHO & HARRY NACH [ VIDEOCLIP OFICIAL ] LGL 2.0.mp3", cover: "../assets/media/img/amorYMafia.jpg" },
    { title: "Asalto", author: "Almighty", file: "../assets/media/audio/Almighty - Asalto (Official Music Video).mp3", cover: "../assets/media/img/asalto.jpg" },
    { title: "Flow 2000 Remix", author: "Bad Gyal", file: "../assets/media/audio/Bad Gyal, Beny Jr - Flow 2000 (Remix) (Official Video).mp3", cover: "../assets/media/img/flow2000.jpg" },
    { title: "Fardos", author: "JC Reyes", file: "../assets/media/audio/JC REYES FT DE LA GHETTO - FARDOS.mp3", cover: "../assets/media/img/fardos.jpg" },
    { title: "La paso cabrón", author: "Noriel", file: "../assets/media/audio/La Paso Cabrón (Cover Audio).mp3", cover: "../assets/media/img/laPasoCabron.jpg" },
    { title: "Las Bratz (REMIX)", author: "JC Reyes", file: "../assets/media/audio/LAS BRATZ (remix) - Aissa, Saiko, JC Reyes ft El bobe, Juseph, Nickzzy.mp3", cover: "../assets/media/img/lasBratz.jpg" },
    { title: "DM", author: "Cosculluela", file: "../assets/media/audio/Mueka, Cosculluela - DM (Video Oficial).mp3", cover: "../assets/media/img/DM.jpg" }
    // Agrega más pistas de audio aquí si es necesario
];
document.addEventListener("DOMContentLoaded", function () {
    const musicCardsContainer = document.querySelectorAll('.music-card');

    songs.forEach((song, index) => {
        const musicCard = musicCardsContainer[index];
        const img = musicCard.querySelector('img');
        const songName = musicCard.querySelector('.songName');
        const songAuthor = musicCard.querySelector('.songAuthor');

        img.src = song.cover;
        img.alt = song.title;
        songName.textContent = song.title;
        songAuthor.textContent = song.author;

        // Agregar evento de reproducción
        const playButton = musicCard.querySelector('.btn-play');
        playButton.addEventListener('click', function () {
            playSong(index);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const musicCardsContainer = document.querySelectorAll('.music-card');
    const searchBar = document.querySelector('.form-control');
    const clearButton = document.getElementById('limpiarBuscador');

    // Agregar evento de búsqueda
    searchBar.addEventListener('input', function () {
        const searchTerm = searchBar.value.toLowerCase();
        const filteredSongs = songs.filter(song =>
            song.title.toLowerCase().includes(searchTerm) ||
            song.author.toLowerCase().includes(searchTerm)
        );

        // Ocultar todas las tarjetas de música
        musicCardsContainer.forEach(card => {
            card.style.display = 'none';
        });

        // Mostrar solo las tarjetas de música que coincidan con la búsqueda
        filteredSongs.forEach(song => {
            const index = songs.findIndex(s => s === song);
            musicCardsContainer[index].style.display = 'block';
        });
    });

    // Agregar evento para limpiar el input de búsqueda
    clearButton.addEventListener('click', function () {
        searchBar.value = '';
        searchBar.dispatchEvent(new Event('input')); // Disparar evento de input para actualizar la búsqueda
    });

    // Resto del código...
});


function playSong(index) {
    const audioPlayer = document.getElementById('audioPlayer');
    const song = songs[index];
    const songTitle = document.querySelector('.song-title');
    const songAuthor = document.querySelector('.song-author');

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

// Cargar la primera canción al cargar la página
loadSong(currentSongIndex);

