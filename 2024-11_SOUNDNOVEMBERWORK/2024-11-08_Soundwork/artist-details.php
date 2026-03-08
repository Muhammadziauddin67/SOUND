<?php
include('dbconnection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve artist details from POST
    $name = $_POST['name'] ?? null;  // Use null coalescing operator
    $img_path = $_POST['img_path'] ?? null;  // Same for img_path

    // Check if name and img_path are set
    if ($name && $img_path) {
        // Prepare and execute the SQL query to insert the followed artist
        $sql = "INSERT INTO followed_artist (name, img_path) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("ss", $name, $img_path);
            $success = $stmt->execute();
            $stmt->close();
            
            // Show alert based on success
            if ($success) {
                echo "<script>alert('You are now following " . htmlspecialchars($name) . "!'); window.location.href='artist.php';</script>";
            } else {
                echo "<script>alert('Error: Could not follow the artist.'); window.location.href='artist.php';</script>";
            }
        } else {
            echo "<script>alert('Error preparing the SQL statement.'); window.location.href='artist.php';</script>";
        }
    } else {
        echo "<script>alert('Artist name or image path is missing.'); window.location.href='artist.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='artist.php';</script>";
}
header("Location:artist.php");
?>
