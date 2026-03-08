<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exampledb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];
$searchResults = [];

// Define a list of queries for each table to search
$queries = [
    "SELECT album_name AS name, 'album' AS type, release_year AS year, CONCAT('album.php?id=', album_id) AS link FROM albums WHERE album_name LIKE ?",
    "SELECT artist_name AS name, 'artist' AS type, NULL AS year, CONCAT('artist.php?id=', artist_id) AS link FROM artists WHERE artist_name LIKE ?",
    "SELECT song_title AS name, 'song' AS type, release_year AS year, CONCAT('song.php?id=', song_id) AS link FROM songs WHERE song_title LIKE ?"
];

// Prepare and execute each query
foreach ($queries as $sql) {
    $stmt = $conn->prepare($sql);
    $param = '%' . $query . '%';
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}

$conn->close();
echo json_encode($searchResults);
?>
