<?php
session_start();
include('dbconnection.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$playlistName = $_POST['playlist_name'] ?? null;

if (empty($playlistName)) {
    echo json_encode(['success' => false, 'message' => 'Playlist name cannot be empty.']);
    exit;
}

// Check if playlist with the same name already exists for the user
$checkStmt = $con->prepare("SELECT playlist_id FROM playlists WHERE user_id = ? AND playlist_name = ?");
$checkStmt->bind_param("is", $userId, $playlistName);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
if ($checkResult->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'A playlist with this name already exists.']);
    $checkStmt->close();
    exit;
}
$checkStmt->close();

$stmt = $con->prepare("INSERT INTO playlists (user_id, playlist_name) VALUES (?, ?)");
$stmt->bind_param("is", $userId, $playlistName);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Playlist created successfully!', 'playlist_id' => $stmt->insert_id, 'playlist_name' => $playlistName]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error creating playlist: ' . $con->error]);
}

$stmt->close();
$con->close();
?>