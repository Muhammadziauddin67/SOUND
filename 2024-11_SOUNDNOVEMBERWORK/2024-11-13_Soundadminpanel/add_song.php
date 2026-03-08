<?php
include ('dbconnection.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $song_title = $_POST['song_title'];
    $artist_name = $_POST['artist_name'];
    $img_path = $_POST['img_path'];
    $audio_path = $_POST['audio_path'];
    $youtube_url = $_POST['youtube_url'];
    $genre = $_POST['genre'];

    // Prepare SQL query to insert the data into the songs_data table
    $sql = "INSERT INTO songs_data (song_title, artist_name, img_path, audio_path, youtube_url, genre) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $con->prepare($sql)) {
        // Bind the form data to the SQL query
        $stmt->bind_param("ssssss", $song_title, $artist_name, $img_path, $audio_path, $youtube_url, $genre);
        
        // Execute the statement
        if ($stmt->execute()) {
            // JavaScript alert on successful insertion
            echo "<script>
                    alert('Song added successfully!');
                    window.location.href = 'admin_panel.php';  // Redirect back to the manage music page
                  </script>";
            exit();
        } else {
            // Handle errors if execution fails
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>


