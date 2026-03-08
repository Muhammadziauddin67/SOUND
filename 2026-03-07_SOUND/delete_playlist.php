<?php
session_start();
include('dbconnection.php');

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$playlistId = $_POST['playlist_id'] ?? null;

if (!$playlistId) {
    echo json_encode(['success' => false, 'message' => 'Missing playlist ID.']);
    exit;
}

// Verify ownership and delete
$stmt = $con->prepare("DELETE FROM playlists WHERE playlist_id = ? AND user_id = ?");
$stmt->bind_param("ii", $playlistId, $userId);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Playlist deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Playlist not found or you do not have permission to delete it.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting playlist: ' . $con->error]);
}

$stmt->close();
$con->close();
?>