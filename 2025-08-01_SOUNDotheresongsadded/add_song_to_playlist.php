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

// Optional: Verify that the playlist belongs to the user
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

// Get the highest song_order in the playlist to set the new song's order
$maxOrder = 0;
$stmtMaxOrder = $con->prepare("SELECT MAX(song_order) AS max_order FROM playlist_songs WHERE playlist_id = ?");
$stmtMaxOrder->bind_param("i", $playlistId);
$stmtMaxOrder->execute();
$resultMaxOrder = $stmtMaxOrder->get_result();
if ($rowMaxOrder = $resultMaxOrder->fetch_assoc()) {
    $maxOrder = $rowMaxOrder['max_order'] + 1;
}
$stmtMaxOrder->close();

$stmt = $con->prepare("INSERT INTO playlist_songs (playlist_id, song_id, song_order) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $playlistId, $songId, $maxOrder);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Song added to playlist successfully!']);
} else {
    if ($con->errno == 1062) { // Duplicate entry error code
        echo json_encode(['success' => false, 'message' => 'Song is already in this playlist.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding song to playlist: ' . $con->error]);
    }
}

$stmt->close();
$con->close();
?>