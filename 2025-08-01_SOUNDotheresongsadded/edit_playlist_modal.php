<?php
require 'dbconnection.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $p = $con->query("SELECT * FROM playlists WHERE playlist_id=$id")->fetch_assoc();
  ?>
  <form action="update_playlist.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <label>Playlist Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($p['playlist_name']) ?>" required>
    
    <label>Change Image:</label>
    <input type="file" name="img">
    
    <button type="submit">Update</button>
  </form>
  <?php
}
?>
