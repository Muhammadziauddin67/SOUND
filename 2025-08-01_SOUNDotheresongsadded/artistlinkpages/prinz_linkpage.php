<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SOUND</title>
    <link rel="icon" href="../assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
  </head>
  <body>
    <div id="customAlert" class="custom-alert">
      <span class="custom-alert-message">Please play a song first to listen to the music.</span>
      <button class="custom-alert-close" onclick="closeAlert()">X</button>
  </div>
  <?php include('navbar_sidebar_inside.php'); ?>
    <?php include('../Chatbot/chat.php'); ?>
    <div class="music-bar">
        <input type="range" id="progress-bar" value="0" min="0" step="0.1">
        <div class="music-controls">
            <img id="song-image" src="../assets/default-song.PNG" alt="Song Image" class="song-image">
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


    <div class="albumlink-page">
<div class="container my-5">
  <!-- Album Section -->
  <div class="album-section d-flex justify-content-between align-items-center">
    <div class="album-details">
      <img src="../assets/artists/German/Prinz PI_artist.jpg" alt="Album Image" class="album-img">
      <div>
        <center> 
          <div class="featured-artist">
                    <i class="fas fa-check-circle checkmark-icon"></i>
                    <span class="artist-text"><h3>Featured Artist</h3></span>
                </div></center>
        <p class="mb-1">Artist Prinz PI</p>
       
        <p class="text-muted">Prinz Pi is a German rapper and one of the country's top rap artists,He started his career by releasing mix tapes and EPs between 1998 and 2005.</p>
        <p class="mb-1">Genres</p>
        <p class="text-muted">POP , PUNK , RAP</p>
      </div>
    </div>

    <div class="featured-artist">
    
    </div>


  </div>
        
        
    
      <div class="row">
      <div class="col-md-12 featured-albums">
      <h3>Featured Albums</h3>
      <div class="album-grid">
      <a href="../albumlinkpages/prinz_albumlinkpage.php" class="album-card">

        <div class="album-card">
            <img src="../assets/albums/prinz_pi_kompass_ohne_norden_album_cover.jpg" alt="Album Image" class="album-image">
            <div class="album-info">
                <p class="album-name">Kompass_Ohne_Norden</p>
                <p class="album-artist">Prinz PI</p>
            </div>
        </div>
        </a>

        </div>
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


    <!-- JavaScript -->
    <script src="../script.js"></script>

    <script>
        // heart icon function
        document.addEventListener('DOMContentLoaded', () => {
    const heartIcon = document.getElementById("heartIcon");
    const heartPopup = document.getElementById("heartPopup");

    if (heartIcon && heartPopup) {
        heartIcon.addEventListener("click", () => {
            heartIcon.classList.toggle("filled");
            
            // Show popup
            heartPopup.classList.add("show");
            
            // Hide popup after 2 seconds
            setTimeout(() => {
                heartPopup.classList.remove("show");
            }, 2000);
        });
    } else {
        console.warn("Heart icon or popup element not found.");
    }
});


// for jump the heart icon
document.addEventListener('DOMContentLoaded', () => {
    const heartIcon = document.getElementById("heartIcon");

    if (heartIcon) {
        heartIcon.addEventListener("click", () => {
            heartIcon.classList.add("jump");
            
            // Remove the jump class after the animation ends to allow retriggering
            heartIcon.addEventListener('animationend', () => {
                heartIcon.classList.remove("jump");
            }, { once: true });
        });
    } else {
        console.warn("Heart icon element not found.");
    }
});


    </script>
  </body>
</html>