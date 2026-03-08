<?php
require 'dbconnection.php';

if (isset($_GET['song_id'])) {
    $song_id = intval($_GET['song_id']);

    // Avoid duplicate entries
    $check = $con->query("SELECT * FROM playlist WHERE song_id = $song_id");
    if ($check->num_rows === 0) {
        $con->query("INSERT INTO playlist (song_id) VALUES ($song_id)");
    }
}

// Redirect to playlist page after adding
header("Location: playlists.php");
exit();
