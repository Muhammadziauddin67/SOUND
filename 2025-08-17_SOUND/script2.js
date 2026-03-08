// Define checkElement at the global scope so it's accessible everywhere in this script.
function checkElement(id) {
    const element = document.getElementById(id);
    if (!element) {
        // Optional: console.warn(`Element with ID '${id}' not found. This might indicate a missing HTML element.`);
    }
    return element;
}

// Add these new global variables/functions at the top of script2.js
let playlistSongList = []; // To hold the currently playing playlist's songs
let currentPlaylistIndex = 0; // Current song index in the playlist
let replayPlaylist = false; // Controls playlist replay mode

// Expose functions to the global scope for playlist_details.php to use
window.setMusicBarPlaylist = function(newSongList, startIndex) {
    playlistSongList = newSongList;
    currentPlaylistIndex = startIndex;
    // Potentially update the music bar's display immediately here
    if (newSongList.length > 0) {
        const songData = newSongList[startIndex];
        document.getElementById("audio-source").src = songData.audioUrl;
        document.getElementById("audio-player").load();
        document.getElementById("current-song").innerText = songData.songTitle || "Unknown Title";
        document.getElementById("current-artist").innerText = songData.songArtist || "Unknown Artist";
        document.getElementById("song-image").src = songData.songImg || "assets/default-song.PNG";
        // Do NOT auto-play here, let the caller decide (e.g., playAllBtn)
    }
};

window.setReplayMode = function(mode) {
    replayPlaylist = mode;
};

// Function to fetch and display playlists
function loadUserPlaylists(songId, songTitle) {
    fetch('fetch_playlists.php') // Make sure this path is correct
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const playlistList = document.getElementById('playlistList');
                if (!playlistList) {
                    console.error("Element with ID 'playlistList' not found.");
                    return;
                }
                playlistList.innerHTML = ''; // Clear existing list

                if (data.playlists.length > 0) {
                    data.playlists.forEach(playlist => {
                        const li = document.createElement('li');
                        li.classList.add('dynamic-playlist-item');
                        li.dataset.playlistId = playlist.id; // Store the ID!
                        li.dataset.playlistName = playlist.name; // Store the name for display

                        const playlistLink = document.createElement('a');
                        playlistLink.href = "#"; // Prevent navigation
                        playlistLink.textContent = playlist.name;
                        playlistLink.addEventListener('click', (event) => {
                            event.preventDefault();
                            // Call the function to add the song to the selected playlist
                            addSongToSelectedPlaylist(songId, songTitle, playlist.id, playlist.name);
                            // Hide the playlist selector after selection
                            document.getElementById('dynamicPlaylistSelector').style.display = 'none';
                            // Hide the main options menu
                            const optionsMenu = event.target.closest('.options-menu');
                            if (optionsMenu) {
                                optionsMenu.style.display = 'none';
                            }
                        });
                        li.appendChild(playlistLink);
                        playlistList.appendChild(li);
                    });
                } else {
                    playlistList.innerHTML = '<p>No playlists found. Create one!</p>';
                }
                // Show the playlist selector modal/div
                document.getElementById('dynamicPlaylistSelector').style.display = 'block';

            } else {
                alert('Failed to load playlists: ' + data.message);
                console.error('Failed to load playlists:', data.message);
            }
        })
        .catch(error => {
            console.error('Error fetching playlists:', error);
            alert('An error occurred while fetching playlists.');
        });
}

// Function to handle adding the song to the selected playlist (sends playlist_id)
function addSongToSelectedPlaylist(songId, songTitle, playlistId, playlistName) {
    if (confirm(`Add "${songTitle}" to playlist "${playlistName}"?`)) {
        const formData = new URLSearchParams();
        formData.append('song_id', songId);
        formData.append('playlist_id', playlistId); // Sending the ID!

        fetch('add_to_playlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error adding song to playlist:', error);
            alert('An error occurred while trying to add the song to the playlist.');
        });
    }
}


// Modify playSong in script2.js to handle full playlist context
// This `playSong` is the global one called from `onclick` attributes and `playlist_details.php`
window.playSong = function(id, audioUrl, title, artist, imgPath) {
    const audioPlayer = document.getElementById('audio-player');
    const audioSource = document.getElementById('audio-source');
    const playPauseIcon = document.getElementById("playPauseIcon");
    const songImage = document.getElementById("song-image");
    const currentSong = document.getElementById("current-song");
    const currentArtist = document.getElementById("current-artist");

    if (!audioPlayer || !audioSource) {
        console.warn("Audio player elements not found.");
        return;
    }

    // Update music bar display
    audioSource.src = audioUrl;
    audioPlayer.load();
    currentSong.innerText = title || "Unknown Title";
    currentArtist.innerText = artist || "Unknown Artist";
    songImage.src = imgPath || "assets/default-song.PNG";

    audioPlayer.play().catch(error => {
        if (error.name !== "AbortError") {
            console.error("Audio playback error from global playSong:", error);
        }
    });
    playPauseIcon.classList.replace("fa-play", "fa-pause");
    isPlaying = true; // Global flag in script2.js
    currentButton = null; // No specific button to highlight for global play

    // Log to history
    logSongToHistory(id, title, artist, imgPath);
};


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


document.addEventListener('DOMContentLoaded', () => {
    // Selecting elements
    const savedTheme = localStorage.getItem('theme');
    const themeToggle = checkElement('darkLight');
    const toggleThemeButton = checkElement('toggleThemeButton');
    const body = document.querySelector("body");

    const searchToggle = checkElement('search-toggle');
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = checkElement("sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
    const searchInput = checkElement("search");
    const display = checkElement("display");

    // Music bar and play button element selections
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

    let isPlaying = false; // Global flag for music bar
    let currentButton = null; // Stores reference to the currently playing song's button

    // Toggle search bar display
    searchToggle?.addEventListener('click', () => {
        const searchBar = document.querySelector('.search_bar');
        if (searchBar) searchBar.style.display = searchBar.style.display === 'block' ? 'none' : 'block';
    });

    // Ensure searchInput and display exist before adding listeners
    if (searchInput && display) {
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
    }

    if (sidebarOpen) { sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close")); }
    if (sidebarClose) { sidebarClose.addEventListener("click", () => { sidebar.classList.add("close", "hoverable"); }); }
    if (sidebarExpand) { sidebarExpand.addEventListener("click", () => { sidebar.classList.remove("close", "hoverable"); }); }

    if (sidebar) {
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
    }

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

    // Apply the saved theme on page load
    if (body && toggleThemeButton && themeToggle) {
        if (savedTheme === 'dark') {
            body.classList.add('dark-mode');
            toggleThemeButton.classList.replace('bi-grid', 'bi-moon');
            themeToggle.classList.replace('bx-sun', 'bx-moon');
        } else {
            toggleThemeButton.classList.add('bi-grid');
        }

        // Toggle theme and icons on click
        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                toggleThemeButton.classList.replace('bi-grid', 'bi-moon');
                themeToggle.classList.replace('bx-sun', 'bx-moon');
            } else {
                localStorage.setItem('theme', 'light');
                toggleThemeButton.classList.replace('bi-moon', 'bi-grid');
                themeToggle.classList.replace('bx-moon', 'bx-sun');
            }
        });
    }

    // Song options menu
    document.querySelectorAll('.options-icon').forEach(icon => {
        icon.addEventListener('click', function(event) {
            event.stopPropagation();
            const menu = this.nextElementSibling;
            document.querySelectorAll('.options-menu').forEach(m => {
                if (m !== menu) m.style.display = 'none';
            });
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    });

    // Close options menu when clicking outside
    document.addEventListener('click', (event) => {
        document.querySelectorAll('.options-menu').forEach(menu => {
            if (!menu.contains(event.target) && !event.target.classList.contains('options-icon')) {
                menu.style.display = 'none';
            }
        });
    });

    // Handle "Add to Playlist" click
    document.querySelectorAll('.add-to-playlist-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const songId = this.closest('.song-options').querySelector('.options-icon').dataset.songId;
            const songTitle = this.closest('.song-options').querySelector('.options-icon').dataset.songTitle;
            showAddToPlaylistModal(songId, songTitle);
        });
    });

    function showAddToPlaylistModal(songId, songTitle) {
        // This function will fetch user's playlists and display them in a modal
        // along with an option to create a new playlist.
        // For now, a simple alert:
        alert(`Adding "${songTitle}" (ID: ${songId}) to a playlist.`);
        // In a real scenario, you'd show a modal here and fetch playlists via AJAX.
        fetchPlaylistsAndShowModal(songId);
    }

    function fetchPlaylistsAndShowModal(songId) {
        fetch('get_user_playlists.php')
            .then(response => response.json())
            .then(data => {
                // Display a modal here with `data.playlists` and a "Create New Playlist" option.
                // When a playlist is selected or created, make an AJAX call to add_song_to_playlist.php
                console.log("User Playlists:", data.playlists);
                // Example: Open a Bootstrap modal and populate it
                // $('#addToPlaylistModal').modal('show');
                // Populate the modal content with `data.playlists`
            })
            .catch(error => console.error('Error fetching playlists:', error));
    }

    // Re-wire playButtons to use the global playSong and populate playlistSongList
    playButtons.forEach((button, index) => {
        const audioUrl = button.getAttribute("data-audio");
        const songTitle = button.parentElement.querySelector(".song-name").innerText;
        const songArtist = button.parentElement.querySelector(".artist-name").innerText;
        const songImg = button.parentElement.querySelector(".song-image").getAttribute("src");
        const videoUrl = button.getAttribute("data-video");
        const songId = button.getAttribute("data-song-id"); // Ensure song-id is passed from PHP

        // Populate playlistSongList with ALL songs found on the page
        // This makes "Next" and "Previous" buttons work based on whatever songs are currently displayed
        // You might want a more sophisticated way to load queues if playing from different contexts.
        playlistSongList.push({
            songId, // Add songId
            audioUrl,
            songTitle,
            songArtist,
            songImg,
            videoUrl,
            button // Reference to the actual button, for toggling icon
        });

        button.addEventListener("click", function () {
            // Find the index of the clicked song in the global playlistSongList
            const clickedSongIndex = playlistSongList.findIndex(song => song.songId === songId);
            if (clickedSongIndex !== -1) {
                if (currentPlaylistIndex === clickedSongIndex && isPlaying) {
                    togglePlayPause();
                } else {
                    currentPlaylistIndex = clickedSongIndex;
                    playSpecificSongFromPlaylist(currentPlaylistIndex);
                }
            }
        });
    });

    // Modified playSpecificSongFromPlaylist to use the global playlistSongList
    function playSpecificSongFromPlaylist(index) {
        const songData = playlistSongList[index];
        if (!songData) {
            console.warn("Song data not found at index:", index);
            return;
        }

        // Reset the icon for the previous button if it exists
        if (currentButton && currentButton !== songData.button) {
            currentButton.innerHTML = '<i class="fas fa-play"></i>';
        }

        // Update music bar display and play
        audioPlayer.src = songData.audioUrl;
        audioPlayer.play().catch(error => {
            if (error.name !== "AbortError") {
                console.error("Audio playback error in playSpecificSongFromPlaylist:", error);
            }
        });
        currentSong.innerText = songData.songTitle || "Unknown Title";
        currentArtist.innerText = songData.songArtist || "Unknown Artist";
        songImage.src = songData.songImg || "assets/default-song.PNG";
        playPauseIcon.classList.replace("fa-play", "fa-pause");
        isPlaying = true;
        currentButton = songData.button; // Store reference to the currently playing song's button

        logSongToHistory(songData.songId, songData.songTitle, songData.songArtist, songData.songImg);
    }

    // New togglePlayPause function for the music bar
    function togglePlayPause() {
        if (isPlaying) {
            audioPlayer.pause();
            playPauseIcon.classList.replace("fa-pause", "fa-play");
            if (currentButton) {
                currentButton.innerHTML = '<i class="fas fa-play"></i>';
            }
        } else {
            audioPlayer.play().catch(error => {
                if (error.name !== "AbortError") {
                    console.error("Audio playback error in togglePlayPause:", error);
                }
            });
            playPauseIcon.classList.replace("fa-play", "fa-pause");
            if (currentButton) {
                currentButton.innerHTML = '<i class="fas fa-pause"></i>';
            }
        }
        isPlaying = !isPlaying;
    }

    // Modify nextSong and prevSong to use playlistSongList and handle replay
    function nextSong() {
        if (playlistSongList.length === 0) return;

        currentPlaylistIndex++;
        if (currentPlaylistIndex >= playlistSongList.length) {
            if (replayPlaylist) {
                currentPlaylistIndex = 0; // Loop back to the first song
            } else {
                currentPlaylistIndex = playlistSongList.length - 1; // Stay on last song
                isPlaying = false; // Stop playback
                playPauseIcon.classList.replace("fa-pause", "fa-play");
                if (currentButton) currentButton.innerHTML = '<i class="fas fa-play"></i>';
                audioPlayer.pause();
                return;
            }
        }
        playSpecificSongFromPlaylist(currentPlaylistIndex);
    }

    function prevSong() {
        if (playlistSongList.length === 0) return;

        currentPlaylistIndex--;
        if (currentPlaylistIndex < 0) {
            currentPlaylistIndex = 0; // Stay on first song
        }
        playSpecificSongFromPlaylist(currentPlaylistIndex);
    }

    // Attach nextSong to audioPlayer.onended (only one instance needed)
    audioPlayer.onended = function () {
        nextSong(); // Auto-play next song
    };

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

    // Corrected volume bar functionality
    volumeBar.addEventListener('input', () => {
        const newVolume = volumeBar.value / 100; // Get the new volume value
        audioPlayer.volume = newVolume;

        const volumeIcon = checkElement('volume-icon'); // Use checkElement here

        if (volumeIcon) { // Ensure volumeIcon exists before manipulating classes
            if (newVolume === 0) {
                volumeIcon.classList.remove('fa-volume-up', 'fa-volume-down');
                volumeIcon.classList.add('fa-volume-mute');
            } else if (newVolume <= 0.5) {
                volumeIcon.classList.remove('fa-volume-up', 'fa-volume-mute');
                volumeIcon.classList.add('fa-volume-down');
            } else {
                volumeIcon.classList.remove('fa-volume-down', 'fa-volume-mute');
                volumeIcon.classList.add('fa-volume-up');
            }
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
        const songData = playlistSongList[currentPlaylistIndex]; // Use playlistSongList
        if (songData && songData.videoUrl) {
            youtubePlayer.src = songData.videoUrl; // Set the video source
            youtubeModal.style.display = "block"; // Open the modal
        }
        closeAlert();
    });

    switchToAudioBtn.addEventListener("click", function () {
        if (!isPlaying) {
            showAlert("Please play a song first to listen to the music"); // Custom notification
            return; // Prevent video from playing if no song is active
        }
        youtubeModal.style.display = "none"; // Close the modal
        youtubePlayer.src = ""; // Stop the video
        if (isPlaying) {
             audioPlayer.play().catch(error => {
                if (error.name !== "AbortError") {
                    console.error("Audio playback error on switch to audio:", error);
                }
            });
        }
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

    if (closeButton) { closeButton.addEventListener('click', closeAlert); }

    function closeAlert() {
        console.log("Close button clicked");
        const alertBox = document.getElementById("customAlert");
        if (alertBox) {
            alertBox.style.display = "none";
        }
    }

    function showAlert(message) {
        const alertBox = document.getElementById("customAlert");
        if (alertBox) {
            alertBox.querySelector(".custom-alert-message").textContent = message;
            alertBox.style.display = "block";
        }
    }

    // album rating functionality
    // Function to set the rating by changing the star colors
    function setRating(star, albumId) {
        for (let i = 1; i <= 5; i++) {
            const starElement = document.getElementById(`star_${albumId}_${i}`);
            if (starElement) {
                starElement.classList.toggle('selected', i <= star);
            }
        }
        const ratingInput = document.getElementById(`rating_${albumId}`);
        if (ratingInput) {
            ratingInput.value = star;
        }
    }

    // Updated function to submit rating via AJAX
    function submitRating(albumId) {
        const ratingInput = document.getElementById(`rating_${albumId}`);
        if (!ratingInput) {
            alert("Rating element not found for this album.");
            return;
        }

        const rating = ratingInput.value;
        if (rating === "0") {
            alert("Please select a rating before submitting.");
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_rating.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    alert(xhr.responseText);
                } else {
                    alert("An error occurred. Please try again.");
                }
            }
        };
        xhr.send(`album_id=${albumId}&rating=${rating}`);
    }

    // Expose setRating and submitRating to the global scope if they are called from HTML onclick
    window.setRating = setRating;
    window.submitRating = submitRating;


      // Update your options-icon click handler to show the playlist selector
      document.body.addEventListener('click', function(event) {
        if (event.target.classList.contains('options-icon')) {
            event.preventDefault();
            const songId = event.target.dataset.songId;
            const songTitle = event.target.dataset.songTitle;

            // Hide all other options menus first (optional, but good practice)
            document.querySelectorAll('.options-menu').forEach(menu => {
                if (menu !== event.target.nextElementSibling) {
                    menu.style.display = 'none';
                }
            });

            // Toggle the display of the specific options menu
            const optionsMenu = event.target.nextElementSibling;
            if (optionsMenu && optionsMenu.classList.contains('options-menu')) {
                optionsMenu.style.display = optionsMenu.style.display === 'block' ? 'none' : 'block';
            }

            // If the options menu is now shown, or if the "Add to Playlist" button is clicked within it
            // Trigger loading of playlists for the modal
            if (optionsMenu && optionsMenu.style.display === 'block') {
                const addToPlaylistBtn = optionsMenu.querySelector('.add-to-playlist-btn');
                if (addToPlaylistBtn) {
                     // Attach a click listener to the 'Add to Playlist' button inside the options menu
                    addToPlaylistBtn.onclick = (e) => {
                        e.preventDefault();
                        loadUserPlaylists(songId, songTitle);
                    };
                }
            }
        } else if (!event.target.closest('.options-menu')) {
            // Clicked outside any options menu, hide all
            document.querySelectorAll('.options-menu').forEach(menu => {
                menu.style.display = 'none';
            });
            // Also hide the dynamic playlist selector if open
            const dynamicPlaylistSelector = document.getElementById('dynamicPlaylistSelector');
            if (dynamicPlaylistSelector) {
                dynamicPlaylistSelector.style.display = 'none';
            }
        }
      })
        // Add event listener for the close button on the dynamic playlist selector
    const closePlaylistSelectorBtn = document.getElementById('closePlaylistSelector');
    if (closePlaylistSelectorBtn) {
        closePlaylistSelectorBtn.addEventListener('click', () => {
            document.getElementById('dynamicPlaylistSelector').style.display = 'none';
        });
    }

});