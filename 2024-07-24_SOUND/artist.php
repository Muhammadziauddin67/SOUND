<?php
include ('dbconnection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Artist</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
  </head>
  <body>
  <div id="customAlert" class="custom-alert">
      <span class="custom-alert-message">Please play a song first to listen to the music.</span>
      <button class="custom-alert-close">X</button>
  </div>
  
   <!-- navbar -->
   <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <a href="home.php">
            <img src="assets/soundlogo.png" alt="Sound Logo"> <span class="sound-text">SOUND</span>
        </a>
      </div>

     

      <div class="navbar_content">
          <!-- Toggle icon -->
          <i id="search-toggle" class="fas fa-search"></i>
       <div class="search_bar" style="display:none; position: relative;">
    <input type="text" id="search" placeholder="Search...">
    <!-- Search Suggestions Dropdown -->
    <div id="display"></div>
</div>
      
        
        <i class="bi bi-grid" id="toggleThemeButton"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <a href="followartist.php"><i class='bx bx-bell' ></i></a>
        <a href="index.php"><i class='bx bxs-log-out' ></i></a>
      
       
      </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <li class="item">
        <a href="home.php" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-home-alt"></i>
          </span>
          <span class="navlink">Home</span>
        </a>
      </li>
      <li class="item">
        <a href="#" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-chat"></i>
          </span>
          <span class="navlink">Languages</span>
          <i class="bx bx-chevron-right arrow-left"></i>
        </a>
        <ul class="menu_items submenu">
              <a href="languages/english.php" class="nav_link sublink">English</a>
              <a href="languages/german.php" class="nav_link sublink">German</a>
              <a href="languages/spanish.php" class="nav_link sublink">Spanish</a>
              <a href="languages/japanese.php" class="nav_link sublink">Japanese</a>
              <a href="languages/urdu.php" class="nav_link sublink">Urdu</a>
              <a href="languages/hindi.php" class="nav_link sublink">Hindi</a>
        </ul>
      </li>
      <li class="item">
        <a href="genre.php" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-library"></i>
          </span>
          <span class="navlink">Genre</span>
        </a>
      </li>
      <li class="item">
        <a href="album.php" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-grid-alt"></i>
          </span>
          <span class="navlink">Albums</span>
        </a>
      </li>
      <li class="item">
        <a href="artist.php" class="nav_link submenu_item">
          <span class="navlink_icon">
            <i class="bx bx-microphone"></i>
          </span>
          <span class="navlink">Artists</span>
        </a>
      </li>
          <!-- end -->
        </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- duplicate these li tag if you want to add or remove navlink only -->
          <!-- Start -->
          <li class="item">
            <a href="newsongs.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-music"></i>
              </span>
              <span class="navlink">New Songs</span>
            </a>
          </li>
          <!-- End -->

          <li class="item">
            <a href="newalbums.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-album"></i>
              </span>
              <span class="navlink">New Albums</span>
            </a>
          </li>
          <li class="item">
            <a href="albumratings.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
              <span class="navlink">Album Ratings</span>
            </a>
          </li>
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>
          <li class="item">
            <a href="followartist.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-heart"></i>
              </span>
              <span class="navlink">Followed Artists</span>
            </a>
          </li>
          <li class="item">
            <a href="history.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-history"></i>
              </span>
              <span class="navlink">History</span>
            </a>
          </li>
          <li class="item">
            <a href="playlists.php" class="nav_link">
              <span class="navlink_icon">
              <i class='bx bxs-playlist'></i>
              </span>
              <span class="navlink">Playlists</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
              <span class="navlink"></span>
            </a>
          </li>
        </ul>

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>
    </nav>
    <?php include('Chatbot/chat.php'); ?>
    <div class="music-bar">
    <input type="range" id="progress-bar" value="0" min="0" step="0.1">

    <div class="song-info">
        <img id="song-image" src="assets/default-song.PNG" alt="Song Image" class="song-image">
        <span id="current-song">No Song Playing</span>
        <br>
        <span id="current-artist" class="artist-name"></span>
        </div>

    <div class="music-controls">
        <div class="control-row-1">
            <button id="prev" class="control-btn"><i class="fas fa-backward"></i></button>
            <button id="playPause" class="control-btn"><i id="playPauseIcon" class="fas fa-play"></i></button>
            <button id="next" class="control-btn"><i class="fas fa-forward"></i></button>
        </div>
        <div class="control-row-2">
            <button id="rewind" class="control-btn"><i class="fas fa-undo"></i></button>
            <button id="switchToVideo" class="control-btn" title="Switch to video"><i class="fas fa-video"></i></button>
            <button id="switchToAudio" class="control-btn" title="Switch to audio"><i class="fas fa-music"></i></button>
        </div>
    </div>

    <div class="volume-section">
        <i id="volume-icon" class="fas fa-volume-up"></i>
        <div class="volume-control">
            <input type="range" id="volume-bar" value="100" min="0" max="100" step="1">
        </div>
    </div>
</div>

    <div class="artist-page">
    <div class="container-fluid">
        <h1 class="text-center mt-3">Artists</h1>
        <div class="row d-flex justify-content-center">
            <!-- Repeat this card structure for each artist -->
            <?php


// Fetch artist from the database
$sql = "SELECT * FROM artists";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <form action="artist-details.php" method="POST">
                <input type="hidden" name="artist_id" value="<?php echo $row['artist_id']; ?>">
                <input type="hidden" name="artist_name" value="<?php echo $row['artist_name']; ?>">
                <input type="hidden" name="img_path" value="<?php echo $row['img_path']; ?>">
               <div class="artist-card">
               
                    <a href="<?php echo $row['artist_link_page']; ?>" class="artist-a"><img src="<?php echo $row['img_path']; ?>" class="img-fluid rounded-circle" alt="<?php echo $row['artist_name']; ?>">
                    <div class="overlay">
                        <span class="follow-text">
                           <?php echo $row['artist_name']; ?> 
                        </span>
                        <button type="submit" class="artist-follow-btn"><i class="fas fa-user-plus"></i>Follow</button>
                    </div>
                    </a>
                
               </div>
            </form>
        </div>
        <?php
    }
} else {
    echo "<p>No Artists found.</p>";
}
?>
<!-- End of artist card structure -->


<!-- End of artist card structure -->


  
 <!-- YouTube Video Modal -->
 <div id="youtubeModal" class="modal">
  <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <iframe id="youtubePlayer"   frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>


    <!-- JavaScript -->
    <script src="script2.js"></script>
  </body>
</html>