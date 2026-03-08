<?php
include ('dbconnection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SOUND</title>
  <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    crossorigin="anonymous" />
</head>
<style>

</style>

<body>
  <div id="customAlert" class="custom-alert">
    <span class="custom-alert-message">Please play a song first to listen to the music.</span>
    <button class="custom-alert-close" onclick="closeAlert()">X</button>
  </div>

<?php include('Modules/navbar_sidebar.php'); ?>
  <?php include('Chatbot/chat.php'); ?>
  <div class="music-bar">
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
      <iframe id="youtubePlayer" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  </div>
  <h1 class="text-album-rating">Rate Artist Albums</h1>
  <div class="album-ratings-container">

    <!-- Example album card with overlay for ratings -->
 

    <?php 
    $sql = "SELECT * FROM albums";
    $result = $con->query($sql);
    ?>
    
    <?php while ($row = $result->fetch_assoc()): ?>
    <div class="album-card">
        <img src="<?php echo $row['img_path']; ?>" alt="<?php echo $row['album_name']; ?>" class="album-image">
       
        <div class="overlay">
            <h5><?php echo $row['album_name']; ?></h5>
            <p><?php echo $row['artist_name']; ?></p>

            <!-- Star Rating System -->
            <div class="rating-container">
                <div class="star-rating" data-album-id="<?php echo $row['album_id']; ?>">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" id="star_<?php echo $row['album_id'] . '_' . $i; ?>" onclick="setRating(<?php echo $i; ?>, <?php echo $row['album_id']; ?>)">★</span>
                    <?php endfor; ?>
                </div>
                
                <!-- Hidden input to store the selected rating -->
                <input type="hidden" id="rating_<?php echo $row['album_id']; ?>" value="0">

                <!-- Submit button for each album -->
                <button onclick="submitRating(<?php echo $row['album_id']; ?>)" class="submit-btn">Submit Rating</button>
            </div>
        </div>
    </div>
<?php endwhile; ?>

    </div>
      </div>

   </div>

      <!-- JavaScript -->

      
  
    

      <script src="script.js?v=<?php echo time(); ?>"></script>
</body>

</html>