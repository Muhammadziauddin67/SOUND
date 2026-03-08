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
        <a href="followartist.php"><i class='bx bx-bell'></i></a>
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