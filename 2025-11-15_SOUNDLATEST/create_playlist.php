<?php
require 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $img_path = '';

  if (!empty($_FILES['img']['name'])) {
    $img_name = time() . "_" . $_FILES['img']['name'];
    $img_path = "upload/playlist_images/" . $img_name;
    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
  }

  $stmt = $con->prepare("INSERT INTO playlists (playlist_name, playlist_img) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $img_path);
  $stmt->execute();

  header("Location: playlist.php?created=1");
}
?>
