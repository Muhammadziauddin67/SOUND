<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAP</title>
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
  
   <!-- navbar -->
   <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <a href="../home.php">
            <img src="../assets/soundlogo.png" alt="Sound Logo"> <span class="sound-text">SOUND</span>
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
        <a href="../followartist.php"><i class='bx bx-bell' ></i></a>
      
       
      </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <li class="item">
            <a href="../home.php" class="nav_link submenu_item">
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
              <a href="#" class="nav_link sublink">English</a>
              <a href="#" class="nav_link sublink">German</a>
              <a href="#" class="nav_link sublink">Spanish</a>
              <a href="#" class="nav_link sublink">Japanese</a>
              <a href="#" class="nav_link sublink">Urdu</a>
              <a href="#" class="nav_link sublink">Hindi</a>
            </ul>
          </li>
          <li class="item"></li>
            <a href="../genre.php" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-library"></i>
              </span>
              <span class="navlink">Genre</span>
              
          </a>
          </li>
          
          <li class="item">
            <a href="../artist.php" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class="bx bx-grid-alt"></i>
              </span>
              <span class="navlink">Albums</span>
          </a>
          </li>
          <li class="item">
            <a href="../album.php" class="nav_link submenu_item">
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
            <a href="../newsongs.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-music"></i>
              </span>
              <span class="navlink">New Songs</span>
            </a>
          </li>
          <!-- End -->

          <li class="item">
            <a href="../newalbums.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-album"></i>
              </span>
              <span class="navlink">New Albums</span>
            </a>
          </li>
          <li class="item">
            <a href="../albumratings.php" class="nav_link">
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
            <a href="../followartist.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-heart"></i>
              </span>
              <span class="navlink">Followed Artists</span>
            </a>
          </li>
          <li class="item">
            <a href="../history.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-history"></i>
              </span>
              <span class="navlink">History</span>
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
    <!-- YouTube Video Modal -->
 <div id="youtubeModal" class="modal">
  <div class="modal-content">
      <span id="closeModal" class="close">&times;</span>
      <iframe id="youtubePlayer"   frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
</div>
<div class="genre-page-structure">
    <h1 class="genre-title">Rap</h1>
    <h2 class="genre-heading">Songs of this Genre</h2>

    <div class="song-list">
        <div class="song-bar">
            <img src="../assets/default-song.PNG" alt="Song Image" class="song-image">
            <div class="song-details">
                <span class="song-name">Song Name 1</span>
                <span class="artist-name">Artist Name 1</span>
            </div>
            <button class="play-icon"><i class="fas fa-play"></i></button>
        </div>

        <div class="song-bar">
            <img src="../assets/default-song.PNG" alt="Song Image" class="song-image">
            <div class="song-details">
                <span class="song-name">Song Name 2</span>
                <span class="artist-name">Artist Name 2</span>
            </div>
            <button class="play-icon"><i class="fas fa-play"></i></button>
        </div>

        <!-- Add more song bars as needed -->
    </div>
</div>
    <!-- JavaScript -->
    <script src="../script.js"></script>
</body>
</html>