document.addEventListener('DOMContentLoaded', () => {
  
    function checkElement(id) {
        const element = document.getElementById(id);
        if (!element) {
            
        }
        return element;
    }

    // Selecting elements
    const audioPlayer = checkElement('audio-player');
    const closeButton = document.querySelector(".custom-alert-close");
    const playPauseBtn = checkElement('playPause');
    const playPauseIcon = checkElement('playPauseIcon');
    const prevBtn = checkElement('prev');
    const nextBtn = checkElement('next');
    const switchToVideoBtn = checkElement('switchToVideo');
    const switchToAudioBtn = checkElement('switchToAudio');
    const currentSong = checkElement('current-song');
    const progressBar = checkElement('progress-bar');
    const songImage = checkElement('song-image');
    const volumeBar = checkElement('volume-bar');
    const rewindBtn = checkElement('rewind');
    const youtubePlayer = checkElement('youtubePlayer');
    const youtubeModal = checkElement('youtubeModal');
    const closeModal = checkElement('closeModal');
    const currentArtist = checkElement('current-artist');
    const searchToggle = checkElement('search-toggle');
    const themeToggle = checkElement('darkLight');
    const toggleThemeButton = checkElement('toggleThemeButton');  // Ensure this exists in the HTML
    const body = document.querySelector("body");
    const darkLight = checkElement('darkLight');
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");  // sidebar expand class
    const searchInput = document.getElementById("search"); // search element
    const display = document.getElementById("display");    // display search results
   
  

  

    let isPlaying = false, isVideo = false, currentSongIndex = 0;

    const songs = [
        { src: 'Jelly Surfing.mp3', img: 'jelly-surfing.jpg', artist: 'Cloudfooder', youtubeId: '5WTs1lGUAL8' },
        { src: 'Careful What You Wish For.mp3', img: '', artist: '', youtubeId: 'OHpsYd5cvWw' },
    ];

    function playSong() {
        if (!audioPlayer) return;
        const song = songs[currentSongIndex];
        audioPlayer.src = song.src;
        audioPlayer.play().catch(error => console.error("Audio play error:", error));
        currentSong.textContent = song.src.replace('.mp3', '');
        songImage.src = song.img || 'default-song.png';
        currentArtist.textContent = song.artist || 'Unknown';
       
        isPlaying = true;
        playPauseIcon.classList.replace('fa-play', 'fa-pause');

        // Enable the switch to video button only if a video exists
        switchToVideoBtn.style.display = song.youtubeId ? 'block' : 'none';
    }

    function pauseSong() {
        if (!audioPlayer) return;
        audioPlayer.pause();
        isPlaying = false;
        playPauseIcon.classList.replace('fa-pause', 'fa-play');
    }

    function togglePlayPause() {
        isPlaying ? pauseSong() : playSong();
    }

    audioPlayer?.addEventListener('timeupdate', () => {
        if (audioPlayer.duration) {
            progressBar.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        }
    });

    progressBar?.addEventListener('input', () => {
        if (audioPlayer.duration) {
            audioPlayer.currentTime = (progressBar.value / 100) * audioPlayer.duration;
        }
    });

    playPauseBtn?.addEventListener('click', togglePlayPause);
    prevBtn?.addEventListener('click', () => {
        currentSongIndex = (currentSongIndex - 1 + songs.length) % songs.length;
        playSong();
    });
    nextBtn?.addEventListener('click', () => {
        currentSongIndex = (currentSongIndex + 1) % songs.length;
        playSong();
    });
    rewindBtn?.addEventListener('click', () => {
        if (audioPlayer) audioPlayer.currentTime = Math.max(audioPlayer.currentTime - 10, 0);
    });

    function switchToVideo() {
        if (!isPlaying) {
            showAlert("Please play a song first to view the music video."); // Notify user
            return; // Prevent video from playing if no song is active
        }

        const song = songs[currentSongIndex];
        audioPlayer.pause();
        audioPlayer.style.display = 'none';
        youtubeModal.style.display = 'flex'; // Show the YouTube modal
        youtubePlayer.src = `https://www.youtube.com/embed/${song.youtubeId}?autoplay=1`;
        isVideo = true;

        // Update the current song display to reflect video playback
        currentSong.textContent = `${song.artist} - ${song.src.replace('.mp3', '')} (Music Video)`;
        currentArtist.textContent = ''; // Hide artist if showing video
    }
    
    switchToVideoBtn.addEventListener('click', switchToVideo);

    function switchToAudio() {
        if (!isPlaying) {
            showAlert("Please play a song first to listen to the music"); // Custom notification
            return; // Prevent video from playing if no song is active
        }
    
        // Hide the YouTube modal and stop the video
        youtubeModal.style.display = 'none';
        youtubePlayer.src = ''; // Clear the YouTube video
    
        // Show the audio player and resume song
        audioPlayer.style.display = 'block';
        playSong();  // Resume audio playback
    
        // Close any alerts if they are open (this will only be meaningful if the alert was shown)
        closeAlert();
    }
    
    switchToAudioBtn?.addEventListener('click', switchToAudio);

    volumeBar.addEventListener('input', () => {
        const volume = volumeBar.value / 100; 
        audioPlayer.volume = volume; 

        const volumeIcon = checkElement('volume-icon'); // Ensure volumeIcon is defined
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

// Toggle search bar display
searchToggle?.addEventListener('click', () => {
    const searchBar = document.querySelector('.search_bar');
    if (searchBar) searchBar.style.display = searchBar.style.display === 'block' ? 'none' : 'block';
});
searchInput.addEventListener("input", () => {
    const query = searchInput.value.trim();

    // Clear suggestions if query is empty
    if (!query) {
        display.innerHTML = "";
        display.style.display = "none";
        return;
    }

    // Fetch search results from the server
    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            display.innerHTML = "";
            display.style.display = "block";

            if (data.length > 0) {
                data.forEach(item => {
                    const suggestion = document.createElement("div");
                    suggestion.classList.add("suggestion-item");

                    // Set up display text and link based on result type
                    suggestion.innerHTML = `
                        <a href="${item.link}" class="suggestion-link">
                            ${item.name} (${item.type}) - ${item.year || ""}
                        </a>
                    `;

                    display.appendChild(suggestion);
                });
            } else {
                display.innerHTML = `<div class="no-results">No results found</div>`;
            }
        })
        .catch(error => {
            console.error("Error fetching search results:", error);
        });
});

// Hide dropdown when clicking outside
document.addEventListener("click", (event) => {
    if (!searchInput.contains(event.target) && !display.contains(event.target)) {
        display.style.display = "none";
    }
}); 

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
    

     // Theme toggle
darkLight?.addEventListener("click", () => {
    body.classList.toggle("dark");
});
themeToggle?.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    themeToggle.classList.toggle("bx-sun");
    themeToggle.classList.toggle("bx-moon");

    // Update the theme based on the current class
    if (body.classList.contains('dark-mode')) {
        // Dark mode styles
        body.style.backgroundColor = '#121212'; // Example dark background
        body.style.color = '#FFFFFF'; // Example light text
        toggleThemeButton?.classList.remove('icon-light');
        toggleThemeButton?.classList.add('icon-dark');
    } else {
        // Light mode styles
        body.style.backgroundColor = '#FFFFFF'; // Example light background
        body.style.color = '#000000'; // Example dark text
        toggleThemeButton?.classList.remove('icon-dark');
        toggleThemeButton?.classList.add('icon-light');
    }
});
    
   

    closeButton.addEventListener('click', closeAlert); // Add event listener here

    function closeAlert() {
        console.log("Close button clicked"); // Debugging log
        const alertBox = document.getElementById("customAlert");
        if (alertBox) {
            alertBox.style.display = "none"; // Hide the alert
        }
    }

    function showAlert(message) {
        const alertBox = document.getElementById("customAlert");
        alertBox.querySelector(".custom-alert-message").textContent = message;
        alertBox.style.display = "block";
    }
   
   
   
    

});

 