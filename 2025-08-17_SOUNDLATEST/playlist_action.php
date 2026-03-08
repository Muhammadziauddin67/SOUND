<?php
require 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playlist_id = isset($_POST['playlist_id']) ? intval($_POST['playlist_id']) : 0;
    $song_id = isset($_POST['song_id']) ? intval($_POST['song_id']) : 0;

    // Check that both IDs are valid
    if ($playlist_id > 0 && $song_id > 0) {
        // Optional: Check if playlist and song exist
        $check = $con->prepare("SELECT 1 FROM playlists WHERE playlist_id = ?");
        $check->bind_param("i", $playlist_id);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            $sql = "INSERT INTO playlist_songs (playlist_id, song_id) VALUES (?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ii", $playlist_id, $song_id);

            if ($stmt->execute()) {
                header("Location: playlist.php?msg=added");
                exit;
            } else {
                echo "Error inserting song into playlist: " . $stmt->error;
            }
        } else {
            echo "Playlist not found.";
        }
    } else {
        echo "Invalid playlist or song ID.";
    }
} else {
    echo "Invalid request.";
}
?>
