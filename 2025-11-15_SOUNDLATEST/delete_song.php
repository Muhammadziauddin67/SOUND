<?php
include('dbconnection.php');

if (isset($_GET['id'])) {
    $song_id = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM songs_data WHERE song_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $song_id);
    
    if ($stmt->execute()) {
        echo "Song deleted successfully";
    } else {
        echo "Error deleting song";
    }

    $stmt->close();
    $con->close();

    // Redirect back to the manage songs page
    header("Location: admin_panel.php"); // Update with your dashboard file name
}
?>
