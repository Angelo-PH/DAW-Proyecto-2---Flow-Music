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

        playButtons.forEach(button => {
            button.addEventListener('click', () => {
                const songpath = button.dataset.songpath;
                console.log(songpath);
                const songName = button.closest('.music-card').querySelector('.songName').innerText;
                const songAuthor = button.closest('.music-card').querySelector('.songAuthor').innerText;
                const songCover = button.closest('.music-card').querySelector('.cover').getAttribute('src');
                console.log(songName);
                console.log(songAuthor);
                console.log(songCover);

                // Update music player information
                document.getElementById('audioCover').setAttribute('src', songCover);
                document.querySelector('.song-title').innerText = songName;
                document.querySelector('.song-author').innerText = songAuthor;

                // Load song into audio player
                audioPlayer.setAttribute('src', `${songpath}`); 

                // Play the loaded song
                audioPlayer.play();
            });
        });

function cerrarSesion() {
    // Realizar una solicitud para cerrar la sesión
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../php/logout.php", true);
    xhr.send();
    // Redirigir a la página de inicio de sesión
    window.location.href = "login.html";
}



function playSong(index) {
    // Pendiente
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
    // Pendiente
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


