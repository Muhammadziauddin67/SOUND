const audioPlayer = document.getElementById('audio-player');
const videoPlayer = document.getElementById('video-player');
const playPauseBtn = document.getElementById('playPause');
const playPauseIcon = document.getElementById('playPauseIcon');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const switchToVideoBtn = document.getElementById('switchToVideo');
const switchToAudioBtn = document.getElementById('switchToAudio');
const currentSong = document.getElementById('current-song');
const progressBar = document.getElementById('progress-bar');
const songImage = document.getElementById('song-image');
const volumeBar = document.getElementById('volume-bar');
const volumeIcon = document.getElementById('volume-icon');
const rewindBtn = document.getElementById('rewind');

const youtubeModal = document.getElementById('youtubeModal');
const youtubePlayer = document.getElementById('youtubePlayer');
const closeModal = document.getElementById('closeModal');

let isPlaying = false;
let isVideo = false;
let currentSongIndex = 0; // Initialize song index

const songs = [
    { 
        src: 'Jelly Surfing.mp3', 
        img: 'jelly-surfing.jpg', 
        artist: 'Cloudfooder',
        youtubeId: '5WTs1lGUAL8' // YouTube video ID for this song
    },
    { 
        src: 'Careful What You Wish For (the doctor said to).mp3', 
        img: 'careful-what-you-wish-for.jpg', 
        artist: 'Another Artist',
        youtubeId: 'dQw4w9WgXcQ' // Different YouTube video ID
    },
    { 
        src: 'song3.mp3', 
        img: 'song3-image.jpg', 
        artist: 'Artist 3',
        youtubeId: '3JZ_D3ELwOQ' // Another video ID
    }
];

function playSong() {
    const song = songs[currentSongIndex];
    audioPlayer.src = song.src;

    // Ensure the audio is ready before playing
    audioPlayer.addEventListener('canplay', () => {
        audioPlayer.play();
    });

    const songName = song.src.replace('.mp3', ''); // Remove the .mp3 extension
    currentSong.textContent = `${songName}`;
    songImage.src = song.img; // Update song image
    document.getElementById('current-artist').textContent = ` by ${song.artist}`; // Update artist name
    
    isPlaying = true;
    playPauseIcon.classList.replace('fa-play', 'fa-pause');
}

function pauseSong() {
    audioPlayer.pause();
    isPlaying = false;
    playPauseIcon.classList.replace('fa-pause', 'fa-play');
}

function togglePlayPause() {
    if (isPlaying) {
        pauseSong();
    } else {
        playSong();
    }
}

function prevSong() {
    currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
    playSong();
}

function nextSong() {
    currentSongIndex = (currentSongIndex + 1) % songs.length;
    playSong();
}

function switchToVideo() {
    const song = songs[currentSongIndex];
    audioPlayer.pause();
    audioPlayer.style.display = 'none';
    youtubeModal.style.display = 'flex'; // Show the YouTube modal

    // Set the YouTube video URL based on the current song's YouTube ID
    youtubePlayer.src = `https://www.youtube.com/embed/${song.youtubeId}?autoplay=1`; // Load YouTube video with autoplay
    isVideo = true;
    currentSong.textContent = `Playing: music video`;
}

function switchToAudio() {
    youtubeModal.style.display = 'none'; // Hide the YouTube modal
    youtubePlayer.src = ""; // Stop the video

    audioPlayer.style.display = 'block';
    isVideo = false;
    playSong();
}

// Update progress bar as the audio plays
audioPlayer.addEventListener('timeupdate', () => {
    const progressPercent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressBar.value = progressPercent;
});

// Seek to the specific time when the progress bar is changed
progressBar.addEventListener('input', () => {
    const seekTime = (progressBar.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
});

// Volume control
volumeBar.addEventListener('input', () => {
    const volume = volumeBar.value / 100; // Convert to a range of 0-1
    audioPlayer.volume = volume; // Set the audio player volume

    // Change volume icon based on volume level
    if (volume === 0) {
        volumeIcon.classList.remove('fa-volume-up', 'fa-volume-down');
        volumeIcon.classList.add('fa-volume-mute');
    } else if (volume <= 0.5) {
        volumeIcon.classList.remove('fa-volume-up', 'fa-volume-mute');
        volumeIcon.classList.add('fa-volume-down');
    } else {
        volumeIcon.classList.remove('fa-volume-down', 'fa-volume-mute');
        volumeIcon.classList.add('fa-volume-up');
    }
});

// Rewind song by 10 seconds
rewindBtn.addEventListener('click', () => {
    const rewindTime = 10; // Rewind by 10 seconds
    if (!isVideo) {
        audioPlayer.currentTime = Math.max(audioPlayer.currentTime - rewindTime, 0);
    } else {
        videoPlayer.currentTime = Math.max(videoPlayer.currentTime - rewindTime, 0);
    }
});

// Close YouTube modal
closeModal.addEventListener('click', () => {
    youtubeModal.style.display = 'none';
    youtubePlayer.src = ""; // Stop the video
});

window.addEventListener('click', (event) => {
    if (event.target === youtubeModal) {
        youtubeModal.style.display = 'none';
        youtubePlayer.src = ""; // Stop the video
    }
});

// Toggling the sidebar
const toggleButton = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');

toggleButton.addEventListener('click', function() {
  sidebar.classList.toggle('open');
});
