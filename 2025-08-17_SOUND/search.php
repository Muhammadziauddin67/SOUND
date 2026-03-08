<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

include('dbconnection.php');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}



$query = isset($_GET['query']) ? $_GET['query'] : '';
if (empty($query)) {
    echo json_encode(["error" => "Query parameter is missing"]);
    exit;
}

$query = $_GET['query'] ?? '';
$searchResults = [];

if ($query !== '') {
    $queries = [
      "SELECT album_name AS name, 'album' AS type, release_year AS year, album_link_page AS link FROM albums WHERE album_name LIKE ?",
        "SELECT artist_name AS name, 'artist' AS type, NULL AS year, artist_link_page AS link FROM artists WHERE artist_name LIKE ?",
        "SELECT song_title AS name, 'song' AS type, NULL AS year, CONCAT('newsongs.php?id=', song_id) AS link FROM songs_data WHERE song_title LIKE ?"
    ];

    foreach ($queries as $sql) {
        $stmt = $con->prepare($sql);
        $param = '%' . $query . '%';
        $stmt->bind_param("s", $param);
    
        if (!$stmt->execute()) {
            echo json_encode(["error" => "Query execution failed: " . $stmt->error]);
            exit;
        }
    
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
}

$con->close();

// For debugging
if (empty($searchResults)) {
    echo json_encode(['error' => 'No results found']);
} else {
    echo json_encode($searchResults);
}
exit;



?>