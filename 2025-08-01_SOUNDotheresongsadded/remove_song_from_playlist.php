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
$songId = $_POST['song_id'] ?? null;

if (!$playlistId || !$songId) {
    echo json_encode(['success' => false, 'message' => 'Missing playlist ID or song ID.']);
    exit;
}

// Verify ownership of the playlist
$checkPlaylistStmt = $con->prepare("SELECT user_id FROM playlists WHERE playlist_id = ?");
$checkPlaylistStmt->bind_param("i", $playlistId);
$checkPlaylistStmt->execute();
$checkPlaylistResult = $checkPlaylistStmt->get_result();
if ($checkPlaylistResult->num_rows === 0 || $checkPlaylistResult->fetch_assoc()['user_id'] !== $userId) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized playlist access.']);
    $checkPlaylistStmt->close();
    exit;
}
$checkPlaylistStmt->close();

$stmt = $con->prepare("DELETE FROM playlist_songs WHERE playlist_id = ? AND song_id = ?");
$stmt->bind_param("ii", $playlistId, $songId);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Song removed from playlist successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Song not found in this playlist.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error removing song from playlist: ' . $con->error]);
}

$stmt->close();
$con->close();
?>