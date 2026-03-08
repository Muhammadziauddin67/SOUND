<?php
include('dbconnection.php');


$check_sql = "SELECT song_id FROM songs_data WHERE song_id = ?";
$check_stmt = $con->prepare($check_sql);
$check_stmt->bind_param("i", $song_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    // Song exists, insert into history
    $insert_sql = "INSERT INTO history (song_id, song_title, artist_name, image_path) VALUES (?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    $insert_stmt->bind_param("isss", $song_id, $song_title, $artist_name, $image_path);

    if ($insert_stmt->execute()) {
        echo "Play logged successfully.";
    } else {
        echo "Error logging to history: " . $insert_stmt->error;
    }

    $insert_stmt->close();
} else {
    echo "Error: Song ID $song_id does not exist in songs_data.";
}

$check_stmt->close();

var_dump($_POST);


// // Check if song details are received
// if (isset($_POST['song_id']) && isset($_POST['song_title']) && isset($_POST['artist_name']) && isset($_POST['image_path'])) {
//     $song_id = $_POST['song_id'];
//     $song_title = $_POST['song_title'];
//     $artist_name = $_POST['artist_name'];
//     $image_path = $_POST['image_path'];

//     // Insert the song play into the history table
//     $insert_sql = "INSERT INTO history (song_id, song_title, artist_name, image_path) VALUES (?, ?, ?, ?)";
//     $insert_stmt = $con->prepare($insert_sql);
//     $insert_stmt->bind_param("isss", $song_id, $song_title, $artist_name, $image_path);

//     if ($insert_stmt->execute()) {
//         echo "Play logged successfully.";
//     } else {
//         echo "Error logging to history: " . $insert_stmt->error;
//     }

//     $insert_stmt->close();
// } else {
//     echo "Invalid song data.";
// }

// $con->close();
?>


