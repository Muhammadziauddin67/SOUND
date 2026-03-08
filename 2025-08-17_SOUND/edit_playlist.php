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
$newPlaylistName = $_POST['playlist_name'] ?? null;

if (!$playlistId || empty($newPlaylistName)) {
    echo json_encode(['success' => false, 'message' => 'Missing playlist ID or new name.']);
    exit;
}

// Verify ownership
$checkStmt = $con->prepare("SELECT user_id FROM playlists WHERE playlist_id = ?");
$checkStmt->bind_param("i", $playlistId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
$checkStmt->close();

// Check for duplicate name for the same user
$duplicateCheckStmt = $con->prepare("SELECT playlist_id FROM playlists WHERE user_id = ? AND playlist_name = ? AND playlist_id != ?");
$duplicateCheckStmt->bind_param("isi", $userId, $newPlaylistName, $playlistId);
$duplicateCheckStmt->execute();
$duplicateCheckResult = $duplicateCheckStmt->get_result();
if ($duplicateCheckResult->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'You already have a playlist with this name.']);
    $duplicateCheckStmt->close();
    exit;
}
$duplicateCheckStmt->close();

$stmt = $con->prepare("UPDATE playlists SET playlist_name = ? WHERE playlist_id = ?");
$stmt->bind_param("si", $newPlaylistName, $playlistId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Playlist name updated successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating playlist name: ' . $con->error]);
}

$stmt->close();
$con->close();
?>