document.addEventListener('DOMContentLoaded', () => {
  
    function checkElement(id) {
        const element = document.getElementById(id);
        if (!element) {
            
        }
        return element;
    }

    // Selecting elements
   
    const searchToggle = checkElement('search-toggle');
    const themeToggle = document.getElementById('darkLight');
    const body = document.querySelector("body");
    const darkLight = document.querySelector("#darkLight");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
  
 
    // Password toggle elements
    const passwordInput = document.getElementById("showpass");
    const eyeIcon = document.getElementById("eye-icon");
    const passwordToggle = document.querySelector(".password-toggle");
  

    // Attach the showpassword function to the password toggle span
    if (passwordToggle) {
        passwordToggle.addEventListener('click', showpassword);
    } else {
        console.warn('Password toggle element not found.');
    }
 
    
    
    // Function to show/hide password
    function showpassword() {
        if (passwordInput && eyeIcon) {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        } else {
            console.warn('Password input or eye icon not found.');
        }
    }

    

    searchToggle?.addEventListener('click', () => {
        const searchBar = document.querySelector('.search_bar');
        if (searchBar) searchBar.style.display = searchBar.style.display === 'block' ? 'none' : 'block';
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
       themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        themeToggle.classList.toggle("bx-sun");
        themeToggle.classList.toggle("bx-moon");
        
        // Update the theme based on the current class
        if (body.classList.contains('dark-mode')) {
            // Dark mode styles
            body.style.backgroundColor = '#121212'; // Example dark background
            body.style.color = '#FFFFFF'; // Example light text
            toggleThemeButton.classList.remove('icon-light');
            toggleThemeButton.classList.add('icon-dark');
        } else {
            // Light mode styles
            body.style.backgroundColor = '#FFFFFF'; // Example light background
            body.style.color = '#000000'; // Example dark text
            toggleThemeButton.classList.remove('icon-dark');
            toggleThemeButton.classList.add('icon-light');
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
   
   
   
    
    
darkLight.addEventListener("click", () => {
    body.classList.toggle("dark");
});
});









//music-bar and ply button java script//
document.addEventListener("DOMContentLoaded", function () {
    const audioPlayer = document.getElementById("audio-player");
    const playPauseBtn = document.getElementById("playPause");
    const playPauseIcon = document.getElementById("playPauseIcon");
    const progressBar = document.getElementById("progress-bar");
    const volumeBar = document.getElementById("volume-bar");
    const songImage = document.getElementById("song-image");
    const currentSong = document.getElementById("current-song");
    const currentArtist = document.getElementById("current-artist");
    const nextBtn = document.getElementById("next");
    const prevBtn = document.getElementById("prev");
    const rewindBtn = document.getElementById("rewind");
    const playButtons = document.querySelectorAll(".play-icon");

    const youtubeModal = document.getElementById("youtubeModal");
    const youtubePlayer = document.getElementById("youtubePlayer");
    const switchToVideoBtn = document.getElementById("switchToVideo");
    const switchToAudioBtn = document.getElementById("switchToAudio");
    const closeModal = document.getElementById("closeModal");

    let songList = [];
    let currentSongIndex = 0;
    let isPlaying = false;
    let currentButton = null;

    // Collect song data from each card into the songList array
    playButtons.forEach((button, index) => {
        const audioUrl = button.getAttribute("data-audio");
        const songTitle = button.parentElement.querySelector(".song-name").innerText;
        const songArtist = button.parentElement.querySelector(".artist-name").innerText;
        const songImg = button.parentElement.querySelector(".song-image").getAttribute("src");
        const videoUrl = button.getAttribute("data-video"); // Assuming video URL is stored as a data attribute

        songList.push({
            audioUrl,
            songTitle,
            songArtist,
            songImg,
            videoUrl, // Add video URL to the song object
            button
        });

        button.addEventListener("click", function () {
            playSong(index);
        });
    });

    function playSong(index) {
        const songData = songList[index];
        if (!songData) return; // Exit if songData is not found.

        // Check if the same song is clicked to toggle play/pause
        if (currentSongIndex === index && isPlaying) {
            togglePlayPause();
            return;
        }

        // Set song details
        audioPlayer.src = songData.audioUrl;
        currentSong.innerText = songData.songTitle || "Unknown Title"; // Fallback title
        currentArtist.innerText = songData.songArtist || "Unknown Artist"; // Fallback artist
        songImage.src = songData.songImg || "path/to/default-image.jpg"; // Set a default image
        currentSongIndex = index;

        // Play new song
        playNewSong(songData.button);
    }

    function playNewSong(button) {
        // Reset the icon for the previous button
        if (currentButton) {
            currentButton.innerHTML = '<i class="fas fa-play"></i>';
        }

        // Play the new audio
        audioPlayer.play();
        button.innerHTML = '<i class="fas fa-pause"></i>';
        playPauseIcon.classList.replace("fa-play", "fa-pause");
        isPlaying = true;
        currentButton = button;

        // Event listener for audio ending
        audioPlayer.onended = function () {
            nextSong();
        };
    }

    function togglePlayPause() {
        if (isPlaying) {
            audioPlayer.pause();
            playPauseIcon.classList.replace("fa-pause", "fa-play");
            if (currentButton) {
                currentButton.innerHTML = '<i class="fas fa-play"></i>';
            }
        } else {
            audioPlayer.play();
            playPauseIcon.classList.replace("fa-play", "fa-pause");
            if (currentButton) {
                currentButton.innerHTML = '<i class="fas fa-pause"></i>';
            }
        }
        isPlaying = !isPlaying;
    }

    // Modified Next and Previous song functionality to keep playing without pausing
    function nextSong() {
        currentSongIndex = (currentSongIndex + 1) % songList.length;
        changeSong(currentSongIndex);
    }

    function prevSong() {
        currentSongIndex = (currentSongIndex - 1 + songList.length) % songList.length;
        changeSong(currentSongIndex);
    }

    function changeSong(index) {
        const songData = songList[index];
        audioPlayer.src = songData.audioUrl;
        audioPlayer.play();
        currentSong.innerText = songData.songTitle || "Unknown Title"; // Fallback title
        currentArtist.innerText = songData.songArtist || "Unknown Artist"; // Fallback artist
        songImage.src = songData.songImg || "path/to/default-image.jpg"; // Set a default image
        
        // Update play button icons without pausing
        if (currentButton) {
            currentButton.innerHTML = '<i class="fas fa-play"></i>';
        }
        songData.button.innerHTML = '<i class="fas fa-pause"></i>';
        playPauseIcon.classList.replace("fa-play", "fa-pause");
        isPlaying = true;
        currentButton = songData.button;
    }

    // Attach event listeners to Next and Previous buttons
    nextBtn.addEventListener("click", nextSong);
    prevBtn.addEventListener("click", prevSong);

    // Rewind functionality: rewinds the song by 10 seconds
    rewindBtn.addEventListener("click", () => {
        audioPlayer.currentTime = Math.max(0, audioPlayer.currentTime - 10); // Go back 10 seconds
    });

    // Progress bar functionality
    audioPlayer.addEventListener("timeupdate", () => {
        if (audioPlayer.duration) {
            const progressPercentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressBar.value = progressPercentage;
        }
    });

    progressBar.addEventListener("input", () => {
        if (audioPlayer.duration) {
            audioPlayer.currentTime = (progressBar.value / 100) * audioPlayer.duration;
        }
    });

    // Volume control
    volumeBar.addEventListener("input", () => {
        audioPlayer.volume = volumeBar.value / 100;
    });

    // Play/Pause button in the music bar
    playPauseBtn.addEventListener("click", togglePlayPause);

    // Video and Audio switch functionality
    switchToVideoBtn.addEventListener("click", function () {
        const songData = songList[currentSongIndex];
        if (songData && songData.videoUrl) {
            youtubePlayer.src = songData.videoUrl; // Set the video source
            youtubeModal.style.display = "block"; // Open the modal
        }
    });

    switchToAudioBtn.addEventListener("click", function () {
        youtubeModal.style.display = "none"; // Close the modal
        youtubePlayer.src = ""; // Stop the video
    });

    closeModal.addEventListener("click", function () {
        youtubeModal.style.display = "none"; // Close the modal
        youtubePlayer.src = ""; // Stop the video
    });

    // Close the modal when clicking outside of it
    window.addEventListener("click", function (event) {
        if (event.target === youtubeModal) {
            youtubeModal.style.display = "none"; // Close the modal
            youtubePlayer.src = ""; // Stop the video
        }
    });
});
//music-bar and ply button java script end// 














//history functionality for song-bar

function playSong(id, audioUrl, title, artist, imgPath) {
    // Log the song play to the history table
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'savedata.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Optional: log the response
        }
    };
    xhr.send(`song_id=${id}&song_title=${encodeURIComponent(title)}&artist_name=${encodeURIComponent(artist)}&image_path=${encodeURIComponent(imgPath)}`);

    // Set audio source and play
    var audioPlayer = document.getElementById('audio-player');
    var audioSource = document.getElementById('audio-source');

    audioSource.src = audioUrl;
    audioPlayer.load();
    audioPlayer.play();
}


/* //history functionality for songbar end */









// album rating functionality//


   

// Function to set the rating by changing the star colors
function setRating(star, albumId) {
for (let i = 1; i <= 5; i++) {
  const starElement = document.getElementById(`star_${albumId}_${i}`);
  starElement.classList.toggle('selected', i <= star);
}
document.getElementById(`rating_${albumId}`).value = star;
}

// Updated function to submit rating via AJAX
function submitRating(albumId) {
const rating = document.getElementById(`rating_${albumId}`).value;
if (rating === "0") {
  alert("Please select a rating before submitting.");
  return;
}

// AJAX request to save rating in the database
const xhr = new XMLHttpRequest();
xhr.open("POST", "submit_rating.php", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function () {
  if (xhr.readyState === 4) {
      if (xhr.status === 200) {
          alert(xhr.responseText); // Response from submit_rating.php
      } else {
          alert("An error occurred. Please try again.");
      }
  }
};
xhr.send(`album_id=${albumId}&rating=${rating}`);
}

