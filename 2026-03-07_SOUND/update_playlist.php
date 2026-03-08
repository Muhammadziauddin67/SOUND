<?php
require 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $name = $_POST['name'];

  $p = $con->query("SELECT * FROM playlists WHERE playlist_id=$id")->fetch_assoc();
  $img_path = $p['playlist_img'];

  if (!empty($_FILES['img']['name'])) {
    $img_name = time() . "_" . $_FILES['img']['name'];
    $img_path = "upload/playlist_images/" . $img_name;
    move_uploaded_file($_FILES['img']['tmp_name'], $img_path);
  }

  $stmt = $con->prepare("UPDATE playlists SET playlist_name = ?, playlist_img = ? WHERE playlist_id = ?");
  $stmt->bind_param("ssi", $name, $img_path, $id);
  $stmt->execute();

  header("Location: playlist.php");
}
?>
