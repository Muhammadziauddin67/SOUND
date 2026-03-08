<?php
require 'dbconnection.php';

$name = $_POST['playlist_name'];
$image = $_FILES['playlist_img'];

$img_name = time() . "_" . $image['name'];
$target = "upload/playlist_images/" . $img_name;
move_uploaded_file($image['tmp_name'], $target);

$sql = "INSERT INTO playlists (playlist_name, playlist_img) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $target);
$stmt->execute();

header("Location: playlist.php");


