<?php

include('dbconnection.php'); // Replace with the correct path to your DB connection

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $artist_name = $_POST['artist_name'];
    $img_path = $_POST['img_path'];
    $artist_link_page = $_POST['artist_link_page'];
    $album_link_page = $_POST['album_link_page'];
    $album_release_year = $_POST['album_release_year'];

    // SQL query to insert data into the artists_data table
    $sql = "INSERT INTO artists (artist_name, img_path, artist_link_page, album_link_page, album_release_year)
            VALUES ('$artist_name', '$img_path', '$artist_link_page', '$album_link_page', '$album_release_year')";

    if ($con->query($sql) === TRUE) {
        // If the query is successful, show a success message
        echo "<script>alert('Artist added successfully!');</script>";
        header('location:admin_panel.php');
    } else {
        // If there's an error, show an error message
        echo "<script>alert('Error adding artist: " . $con->error . "');</script>";
    }
}
?>
