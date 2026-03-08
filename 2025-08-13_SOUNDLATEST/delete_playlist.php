<?php
require 'dbconnection.php';
$id = $_GET['id'];

$con->query("DELETE FROM playlists WHERE playlist_id=$id");
$con->query("DELETE FROM playlist_songs WHERE playlist_id=$id");

header("Location: playlist.php");
