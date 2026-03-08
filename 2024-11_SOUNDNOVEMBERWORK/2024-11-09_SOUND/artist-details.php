<?php
include('dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['artist_name'] ?? null;
    $img_path = $_POST['img_path'] ?? null;

    if ($name && $img_path) {
        // Check if the artist is already followed
        $check_sql = "SELECT * FROM followed_artist WHERE followed_artist_name = ?";
        $check_stmt = $con->prepare($check_sql);

        if ($check_stmt) {
            $check_stmt->bind_param("s", $name);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows > 0) {
                // Artist already followed, show alert
                echo "<script>alert('You are already following " . htmlspecialchars($name) . "'); window.location.href='artist.php';</script>";
            } else {
                // Insert the artist as a followed artist
                $insert_sql = "INSERT INTO followed_artist (followed_artist_name, img_path) VALUES (?, ?)";
                $insert_stmt = $con->prepare($insert_sql);
                
                if ($insert_stmt) {
                    $insert_stmt->bind_param("ss", $name, $img_path);
                    $success = $insert_stmt->execute();
                    $insert_stmt->close();
                    
                    if ($success) {
                        echo "<script>alert('You are now following " . htmlspecialchars($name) . "!'); window.location.href='artist.php';</script>";
                    } else {
                        echo "<script>alert('Error: Could not follow the artist.'); window.location.href='artist.php';</script>";
                    }
                } else {
                    echo "<script>alert('Error preparing the SQL statement.'); window.location.href='artist.php';</script>";
                }
            }
            $check_stmt->close();
        } else {
            echo "<script>alert('Error preparing the SQL statement.'); window.location.href='artist.php';</script>";
        }
    } else {
        echo "<script>alert('Artist name or image path is missing.'); window.location.href='artist.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='artist.php';</script>";
}
?>
