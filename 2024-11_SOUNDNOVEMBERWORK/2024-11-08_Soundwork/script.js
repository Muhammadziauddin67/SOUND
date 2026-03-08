document.addEventListener('DOMContentLoaded', () => {
  
    function checkElement(id) {
        const element = document.getElementById(id);
        if (!element) {
            
        }
        return element;
    }

    // Selecting elements
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
    
   

 

  
   
   
    

});

 

//music-bar and ply button java script//
document.addEventListener("DOMContentLoaded", function () {
    const closeButton = document.querySelector(".custom-alert-close");
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

    
    volumeBar.addEventListener('input', () => {
        audioPlayer.volume = volumeBar.value / 100; 
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
    // Play/Pause button in the music bar
    playPauseBtn.addEventListener("click", togglePlayPause);

    // Video and Audio switch functionality
    switchToVideoBtn.addEventListener("click", function () {
        if (!isPlaying) {
            showAlert("Please play a song first to view the music video."); // Notify user
            return; // Prevent video from playing if no song is active
        }
        const songData = songList[currentSongIndex];
        if (songData && songData.videoUrl) {
            youtubePlayer.src = songData.videoUrl; // Set the video source
            youtubeModal.style.display = "block"; // Open the modal
        }
        // Close any alerts if they are open (this will only be meaningful if the alert was shown)
        closeAlert();
    });

    switchToAudioBtn.addEventListener("click", function () {
        if (!isPlaying) {
            showAlert("Please play a song first to listen to the music"); // Custom notification
            return; // Prevent video from playing if no song is active
        }
        youtubeModal.style.display = "none"; // Close the modal
        youtubePlayer.src = ""; // Stop the video
        // Close any alerts if they are open (this will only be meaningful if the alert was shown)
        playSong();  // Resume audio playback
        closeAlert();
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


