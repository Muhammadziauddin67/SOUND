<?php
require 'dbconnection.php';

// Create playlist
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_playlist'])) {
  $name = $_POST['name'];
  $img_path = '';
  $uploadDir = "assets/playlist_images/";

  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  if (!empty($_FILES['img']['name'])) {
    $img_name = time() . "_" . basename($_FILES['img']['name']);
    $img_path = $uploadDir . $img_name;
    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
  }

  $stmt = $con->prepare("INSERT INTO playlists (playlist_name, playlist_img) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $img_path);
  $stmt->execute();
  echo "<script>alert('Playlist created successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Playlists</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
  <style>
   
 
  </style>
</head>
<body>

<?php include('Modules/navbar_sidebar.php'); ?>



<br>
<br>
<br>


<button id="openModalBtn"><i class="fa-solid fa-plus"></i> Create New Playlist</button>

<?php
$playlists = $con->query("SELECT * FROM playlists");
while ($p = $playlists->fetch_assoc()) {
  $playlist_id = $p['playlist_id'];
?>
  <div class="playlist-block">
    <div class="playlist-header" onclick="toggleSongs('songs_<?= $playlist_id ?>')">
      <img src="<?= $p['playlist_img'] ?>" alt="Playlist Image">
      <div class="playlist-title-wrapper">
        <h3><?= $p['playlist_name'] ?></h3>
        <button class="btn-play-playlist" onclick="event.stopPropagation(); playFirstSong('songs_<?= $playlist_id ?>')">
  ▶ Play Playlist
</button>

        <div class="playlist-actions">
          <a href="#" class="btn-edit" onclick="openEditModal(<?= $playlist_id ?>); event.stopPropagation();"><i class="fas fa-edit"></i> Edit</a>
          <a href="delete_playlist.php?id=<?= $playlist_id ?>" class="btn-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
        </div>
      </div>
    </div>

   <div class="featured-container">
  <div class="featured-songs">
    <div id="songs_<?= $playlist_id ?>" class="playlist-song-list">
      <?php
      $songs = $con->query("SELECT s.* FROM playlist_songs ps JOIN songs_data s ON ps.song_id = s.song_id WHERE ps.playlist_id = $playlist_id");
      if ($songs->num_rows > 0):
        while ($row = $songs->fetch_assoc()):
      ?>
          <div class="song-bar">
            <img src="<?= $row['img_path'] ?>" alt="Song Image" class="song-image">
            <div class="song-details">
              <span class="song-name"><?= $row['song_title'] ?></span>
              <span class="artist-name"><?= $row['artist_name'] ?></span>
            </div>
            <button class="play-icon"
              data-audio="<?= $row['audio_path'] ?>"
              data-title="<?= $row['song_title'] ?>"
              data-artist="<?= $row['artist_name'] ?>"
              data-image="<?= $row['img_path'] ?>"
              data-video="<?= $row['youtube_url'] ?>"
              data-track-src="<?= $row['audio_path'] ?>"
              onclick="playSong('<?= $row['song_id'] ?>', '<?= $row['audio_path'] ?>', '<?= $row['song_title'] ?>', '<?= $row['artist_name'] ?>', '<?= $row['img_path'] ?>')">
              <i class="fas fa-play"></i>
            </button>
          </div>
      <?php
        endwhile;
      else:
        echo "<p>No songs found in this playlist.</p>";
      endif;
      ?>
    </div>
  </div>
  <audio id="audio-player">
    <source id="audio-source" src="" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
</div>

  </div>
<?php } ?>

<!-- Create Modal -->
<div id="playlistModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Create New Playlist</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <label>Playlist Name:</label>
      <input type="text" name="name" required>

      <label>Playlist Image:</label>
      <input type="file" name="img" accept="image/*">

      <input type="submit" name="create_playlist" value="Create Playlist">
    </form>
  </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeEditModal()">&times;</span>
    <div id="edit-form-container">Loading...</div>
  </div>
</div>
<?php include('Modules/music_bar.php'); ?>
  <script src="script2.js?v=<?php echo time(); ?>"></script>
<!-- JS Scripts -->


</body>
</html>
