<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
<!-- CArds -->
<div class="col-md-4 featured-songs">
    <?php
    $sql = "SELECT * from featuredsongs";
    $result = $conn->query($sql);
    ?>

    <div class="featured-container">
        <h3 class="featured-heading">Featured Songs</h3>
        <div class="featured-songs">
            <div class="song-list">
                <?php
                if ($result->num_rows > 0) {
                    // Output data for each song
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="song-bar">
    <img src="<?php echo $row["img_path"]; ?>" alt="Song Image" class="song-image">
    <div class="song-details">
        <span class="song-name"><?php echo $row["title"]; ?></span>
        <span class="artist-name"><?php echo $row["artist"]; ?></span>
    </div>
    <button class="play-icon" 
            data-audio="<?php echo $row['audio_url']; ?>" 
            data-title="<?php echo $row['title']; ?>" 
            data-artist="<?php echo $row['artist']; ?>" 
            data-image="<?php echo $row['img_path']; ?>"
            data-video="<?php echo $row['video_url']; ?>">
            
        <i class="fas fa-play"></i>
    </button>
</div>


                <?php
                    }
                } else {
                    echo "No songs found.";
                }
                ?>


            </div>
        </div>
    </div>
  
</div>
<!-- ///card end -->


<!-- music bar and modal -->
<div class="music-bar">
<audio id="audio-player" src=<?php echo $row['audio_url']; ?>></audio>
        <input type="range" id="progress-bar" value="0" min="0" step="0.1">
        <div class="music-controls">
            <img id="song-image" src="assets/default-song.PNG" alt="Song Image" class="song-image">
            <span id="current-song">No Song Playing</span>
            <span id="current-artist" class="artist-name"></span>
            <button id="prev" class="control-btn"><i class="fas fa-backward"></i></button>
            <button id="playPause" class="control-btn"><i id="playPauseIcon" class="fas fa-play"></i></button>
            <button id="next" class="control-btn"><i class="fas fa-forward"></i></button>
            <button id="rewind" class="control-btn"><i class="fas fa-undo"></i></button>
            <div class="music-links">
                <button id="switchToVideo" class="control-btn" title="Switch to video"><i class="fas fa-video"></i></button>
                <button id="switchToAudio" class="control-btn" title="Switch to audio"><i class="fas fa-music"></i></button>
            </div>
            <div class="volume-control">
                <i id="volume-icon" class="fas fa-volume-up"></i>
                <input type="range" id="volume-bar" value="100" min="0" max="100" step="1">
            </div>
        </div>
    </div>
   <!-- YouTube Video Modal -->
<div id="youtubeModal" class="modal">
  <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <iframe id="youtubePlayer"   frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>


<script>
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
        if (!songData) return;

        // Check if the same song is clicked to toggle play/pause
        if (currentSongIndex === index && isPlaying) {
            togglePlayPause();
            return;
        }

        // Update song details and play new song
        audioPlayer.src = songData.audioUrl;
        currentSong.innerText = songData.songTitle;
        currentArtist.innerText = songData.songArtist;
        songImage.src = songData.songImg;
        currentSongIndex = index;

        // Play new song and update play button icons
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
            currentButton.innerHTML = '<i class="fas fa-play"></i>';
        } else {
            audioPlayer.play();
            playPauseIcon.classList.replace("fa-play", "fa-pause");
            currentButton.innerHTML = '<i class="fas fa-pause"></i>';
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
        currentSong.innerText = songData.songTitle;
        currentArtist.innerText = songData.songArtist;
        songImage.src = songData.songImg;
        
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
</script>


</body>
</html>