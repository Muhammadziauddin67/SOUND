<?php
include ('dbconnection.php');

// Define the directories for file storage
$imageDir = 'assets/songs/image/';
$audioDir = 'assets/songs/audiofiles/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $song_title = $_POST['song_title'];
    $artist_name = $_POST['artist_name'];
    $youtube_url = $_POST['youtube_url'];
    $genre = $_POST['genre'];

    // Initialize file paths
    $img_path = '';
    $audio_path = '';

    // Handle image upload
    if (isset($_FILES['img_file']) && $_FILES['img_file']['error'] == UPLOAD_ERR_OK) {
        $imgFile = $_FILES['img_file'];
        $imgFileName = basename($imgFile['name']);
        $img_path = $imageDir . $imgFileName;

        // Move the image file to the specified directory
        if (!move_uploaded_file($imgFile['tmp_name'], $img_path)) {
            echo "<script>alert('Failed to upload image file.');</script>";
            exit();
        }
    }

    // Handle audio upload
    if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] == UPLOAD_ERR_OK) {
        $audioFile = $_FILES['audio_file'];
        $audioFileName = basename($audioFile['name']);
        $audio_path = $audioDir . $audioFileName;

        // Move the audio file to the specified directory
        if (!move_uploaded_file($audioFile['tmp_name'], $audio_path)) {
            echo "<script>alert('Failed to upload audio file.');</script>";
            exit();
        }
    }

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
