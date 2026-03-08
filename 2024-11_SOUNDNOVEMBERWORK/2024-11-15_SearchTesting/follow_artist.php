<?php
session_start();
include('db_connection.php'); // Adjust path as needed

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "not_logged_in";
    exit;
}

// Get the artist ID from the POST request
if (isset($_POST['artist_id'])) {
    $artist_id = $_POST['artist_id'];
    $user_id = $_SESSION['user_id'];

    // Check if already following
    $check_query = "SELECT * FROM followed_artists WHERE user_id = ? AND artist_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Insert into followed_artists table
        $query = "INSERT INTO followed_artists (user_id, artist_id) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $artist_id);

        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "already_following";
    }
    $stmt->close();
} else {
    echo "no_artist_id";
}
$conn->close();
?>
