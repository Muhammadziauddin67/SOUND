// Wait until the DOM is fully loaded before executing scripts
document.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
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
const modal = document.getElementById("videoModal");
const videoBtn = document.getElementById("video-btn");
const closeBtn = document.getElementsByClassName("close")[0];
    const youtubeModal = document.getElementById('youtubeModal');
    const youtubePlayer = document.getElementById('youtubePlayer');
    const closeModal = document.getElementById('closeModal');

    let isPlaying = false;
    let isVideo = false;
    let currentSongIndex = 0; // Initialize song index
    

    



sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

sidebarClose.addEventListener("click", () => {
    sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
    sidebar.classList.remove("close", "hoverable");
});

sidebar.addEventListener("mouseenter", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.remove("close");
    }
});
sidebar.addEventListener("mouseleave", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.add("close");
    }
});

darkLight.addEventListener("click", () => {
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        document.setI
        darkLight.classList.replace("bx-sun", "bx-moon");
    } else {
        darkLight.classList.replace("bx-moon", "bx-sun");
    }
});

submenuItems.forEach((item, index) => {
    item.addEventListener("click", () => {
        item.classList.toggle("show_submenu");
        submenuItems.forEach((item2, index2) => {
            if (index !== index2) {
                item2.classList.remove("show_submenu");
            }
        });
    });
});

if (window.innerWidth < 768) {
    sidebar.classList.add("close");
} else {
    sidebar.classList.remove("close");
}





    const songs = [
        {
            src: 'Jelly Surfing.mp3',
            img: 'jelly-surfing.jpg',
            artist: 'Cloudfooder',
            youtubeId: '5WTs1lGUAL8' // YouTube video ID for this song
        },
        {
            src: 'Careful What You Wish For (the doctor said to).mp3',
            img: '',
            artist: '',
            youtubeId: 'dQw4w9WgXcQ' // Different YouTube video ID
        },
        {
            src: 'song3.mp3',
            img: '',
            artist: '',
            youtubeId: '3JZ_D3ELwOQ' // Another video ID
        }
    ];
  
    function playSong() {
        const song = songs[currentSongIndex];

        // Set the audio source to the song's file
        audioPlayer.src = song.src;

        // Play the song directly after setting the source
        audioPlayer.play();

        // Remove the .mp3 extension from the song name
        const songName = song.src.replace('.mp3', '');
        currentSong.textContent = `${songName}`;

        // Check if the song has an image, otherwise use the default image
        const songImg = song.img ? song.img : 'default-song.png';
        songImage.src = songImg;

        // Check if the artist's name is provided, otherwise use "Unknown"
        const artistName = song.artist ? song.artist : 'Unknown';
        document.getElementById('current-artist').textContent = `by ${artistName}`;

        isPlaying = true;
        playPauseIcon.classList.replace('fa-play', 'fa-pause');

        console.log(`Playing song: ${songs[currentSongIndex].src}`);
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

    // Add event listener for play/pause button
    playPauseBtn.addEventListener('click', togglePlayPause);

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

        // Pause audio and hide the audio player
        audioPlayer.pause();
        audioPlayer.style.display = 'none';

        // Show the YouTube modal and play video
        youtubeModal.style.display = 'flex';
        youtubePlayer.src = `https://www.youtube.com/embed/${song.youtubeId}?autoplay=1`;

        isVideo = true;

        // Update the current song display to reflect video playback
        currentSong.textContent = `${song.artist} - ${song.src.replace('.mp3', '')} (Music Video)`;
        document.getElementById('current-artist').textContent = ''; // Hide artist if showing video
    }

    function switchToAudio() {
        // Hide the YouTube modal and stop the video
        youtubeModal.style.display = 'none';
        youtubePlayer.src = ''; // Clear the YouTube video

        // Show the audio player and resume song
        audioPlayer.style.display = 'block';
        playSong();  // Resume audio playback

        isVideo = false;
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
            alert("Rewind for YouTube videos is not supported in this mode.");
        }
    });

    // Close YouTube modal
    closeModal.addEventListener('click', () => {
        youtubeModal.style.display = 'none';
        youtubePlayer.src = ''; // Stop the video
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', (event) => {
        if (event.target === youtubeModal) {
            youtubeModal.style.display = 'none';
            youtubePlayer.src = ''; // Stop the video
        }
    });

    // Previous and Next button event listeners
    prevBtn.addEventListener('click', prevSong);
    nextBtn.addEventListener('click', nextSong);

    // Switch to video and audio event listeners
    switchToVideoBtn.addEventListener('click', switchToVideo);
    switchToAudioBtn.addEventListener('click', switchToAudio);
});



document.getElementById('search-toggle').addEventListener('click', function() {
    const searchBar = document.querySelector('.search_bar');
    searchBar.style.display = searchBar.style.display === 'block' ? 'none' : 'block';
  });
  
