<?php
session_start();
include('dbconnection.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$playlists = [];

$stmt = $con->prepare("SELECT playlist_id, playlist_name FROM playlists WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $playlists[] = $row;
}

echo json_encode(['playlists' => $playlists]);
$stmt->close();
$con->close();
?>