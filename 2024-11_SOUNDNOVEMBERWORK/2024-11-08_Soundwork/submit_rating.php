<?php
include ('dbconnection.php');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if POST data is set
if (isset($_POST['album_id']) && isset($_POST['rating'])) {
    $albumId = (int) $_POST['album_id'];
    $rating = (int) $_POST['rating'];

    // Update rating in the database
    $sql = "UPDATE albums SET rating = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $rating, $albumId);
    if ($stmt->execute()) {
        echo "Rating updated successfully.";
    } else {
        echo "Error: " . $con->error;
    }
    $stmt->close();
} else {
    echo "Invalid data.";
}

?>


