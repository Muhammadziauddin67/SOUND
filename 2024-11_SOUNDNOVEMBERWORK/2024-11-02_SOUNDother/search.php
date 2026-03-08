<?php
include('dbconnection.php');

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $stmt = $pdo->prepare("SELECT * FROM songs WHERE name LIKE ? OR artist LIKE ?");
    $likeQuery = "%$query%";
    $stmt->execute([$likeQuery, $likeQuery]);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return results as JSON
    echo json_encode($results);
}
?>
