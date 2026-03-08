<?php

include ('dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    // Get the form data
    $album_name = $_POST['album_name'];
    $artist_name = $_POST['artist_name'];
    $img_path = $_POST['img_path'];
    $rating = $_POST['rating'];
    $release_year = $_POST['release_year'];
    $album_link_page = $_POST['album_link_page'];

    // Prepare the SQL query
    $stmt = $con->prepare("INSERT INTO albums (album_name, artist_name, img_path, rating, release_year, album_link_page) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $album_name, $artist_name, $img_path, $rating, $release_year, $album_link_page);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo '<script type="text/javascript">';
        echo 'alert("Album added successfully!");';
        echo 'window.location.href = "admin_panel.php";'; // Redirect to the manage albums page after success
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error: ' . $stmt->error . '");';
        echo '</script>';
    }

    // Close the statement and the database connection
    $stmt->close();
    $con->close();
}
?>