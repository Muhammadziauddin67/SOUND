<?php
session_start();
include('dbconnection.php');

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

$userId = $_SESSION['user_id'];
$playlistId = $data['playlist_id'] ?? null;
$songIdsInOrder = $data['song_ids'] ?? [];

if (!$playlistId || empty($songIdsInOrder)) {
    echo json_encode(['success' => false, 'message' => 'Missing playlist ID or song order data.']);
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

$con->begin_transaction();
$success = true;

try {
    foreach ($songIdsInOrder as $order => $songId) {
        $stmt = $con->prepare("UPDATE playlist_songs SET song_order = ? WHERE playlist_id = ? AND song_id = ?");
        $newOrder = $order + 1; // Start order from 1
        $stmt->bind_param("iii", $newOrder, $playlistId, $songId);
        $stmt->execute();
        if ($stmt->affected_rows === 0 && $stmt->errno !== 0) {
            // If 0 affected rows but no error, means order didn't change (still success)
            // If there's an error, set success to false
            $success = false;
            break;
        }
        $stmt->close();
    }

    if ($success) {
        $con->commit();
        echo json_encode(['success' => true, 'message' => 'Song order updated successfully.']);
    } else {
        $con->rollback();
        echo json_encode(['success' => false, 'message' => 'Failed to update song order for all songs.']);
    }
} catch (Exception $e) {
    $con->rollback();
    echo json_encode(['success' => false, 'message' => 'Transaction failed: ' . $e->getMessage()]);
}

$con->close();
?>