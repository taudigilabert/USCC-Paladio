<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div id="audio-control">
    <div id="audio-name">MU-TH-UR 6000 Audio</div>
    <div id="audio-buttons">
        <button onclick="prevTrack()" id="prev">
            <i class="fas fa-backward"></i>
        </button>
        <button onclick="togglePlayPause()" id="playPause">
            <i class="fas fa-play"></i>
        </button>
        <button onclick="nextTrack()" id="next">
            <i class="fas fa-forward"></i>
        </button>
    </div>
    <p id="audio-title">Título de la Canción</p>
</div>

<audio id="audio-player" style="display: none;">
    <source id="audio-source" src="../audio/EnteringNostromo.mp3" type="audio/mp3">
    MU-TH-UR 6000 está experimentando serios problemas para reproducir el audio.
</audio>

<script>
// Lista de pistas con los nombres
const tracks = [
    { src: "../audio/EnteringNostromo.mp3", title: "1. Entering Nostromo" },
    { src: "../audio/HesGlitchy.mp3", title: "2. Hes Glitchy" },
    { src: "../audio/PrometheusFire.mp3", title: "3. Prometheus Fire" },
    { src: "../audio/Searching.mp3", title: "4. Searching" },
    { src: "../audio/ThatsOurSun.mp3", title: "5. That's Our Sun" },
    { src: "../audio/TheChrysalis.mp3", title: "6. The Chrysalis" },
    { src: "../audio/WakeUp.mp3", title: "7. Wake Up" },
    { src: "../audio/Water.mp3", title: "8. Water" },
    { src: "../audio/XX121.mp3", title: "9. XX121" },
    { src: "../audio/Weyland.mp3", title: "10. Weyland Yutani"},
    { src: "../audio/Los Ingenieros.mp3", title: "11. Los Ingenieros"},
    { src: "../audio/Synthetic Dawn.mp3", title: "12. Synthetic Dawn"}
];

let currentTrackIndex = localStorage.getItem('currentTrackIndex') ? parseInt(localStorage.getItem('currentTrackIndex')) : 0;
let isPlaying = localStorage.getItem('isPlaying') === 'true';
let currentTime = localStorage.getItem('currentTime') ? parseFloat(localStorage.getItem('currentTime')) : 0; // Posición guardada
const audioPlayer = document.getElementById("audio-player");
const playPauseButton = document.getElementById("playPause").getElementsByTagName('i')[0];
const audioTitle = document.getElementById("audio-title");

audioPlayer.addEventListener('ended',()=>{ //AL ACABAR REPRODUCIR LA SIGUIENTE AUTOMATICAMENTE
    nextTrack();
})

function loadTrack(index) {
    // Si cambiamos de pista, no restablecemos la posición a cero
    if (audioPlayer.src !== tracks[index].src) {
        audioPlayer.src = tracks[index].src;
        audioPlayer.load();
        audioTitle.textContent = tracks[index].title;

        // No reiniciar la canción a 0, sino continuar desde la última posición guardada
        if (isPlaying) {
            audioPlayer.play();
        }

        // Actualizar el icono de play/pause
        playPauseButton.classList.remove("fa-play");
        playPauseButton.classList.add(isPlaying ? "fa-pause" : "fa-play");
    }
    else {
        // Continuar desde la posición guardada sin reiniciar
        audioPlayer.currentTime = currentTime;
    }
}

function togglePlayPause() {
    if (audioPlayer.paused) {
        audioPlayer.play();
        isPlaying = true;
        playPauseButton.classList.remove("fa-play");
        playPauseButton.classList.add("fa-pause");
    } else {
        audioPlayer.pause();
        isPlaying = false;
        playPauseButton.classList.remove("fa-pause");
        playPauseButton.classList.add("fa-play");
    }

    // Guardamos el estado de la canción en localStorage
    localStorage.setItem('isPlaying', isPlaying);
}

// Guardar la posición de la canción cuando se cambia
audioPlayer.ontimeupdate = function() {
    localStorage.setItem('currentTime', audioPlayer.currentTime);
};


function nextTrack() {
    currentTrackIndex = (currentTrackIndex + 1) % tracks.length;
    loadTrack(currentTrackIndex);
    localStorage.setItem('currentTrackIndex', currentTrackIndex);
}

function prevTrack() {
    currentTrackIndex = (currentTrackIndex - 1 + tracks.length) % tracks.length;
    loadTrack(currentTrackIndex);
    localStorage.setItem('currentTrackIndex', currentTrackIndex);
}

window.onload = function() {
    loadTrack(currentTrackIndex);

    // Si la canción estaba reproduciéndose, reiniciamos el estado
    if (isPlaying) {
        audioPlayer.play();
    }

    audioPlayer.currentTime = currentTime; // Restaurar tiempo al cargar
};
</script>

