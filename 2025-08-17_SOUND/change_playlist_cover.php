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
$imagePath = null;

if (!$playlistId) {
    echo json_encode(['success' => false, 'message' => 'Missing playlist ID.']);
    exit;
}
error_log("DEBUG: Playlist ID received by script: " . $playlistId);
// Verify ownership
$checkStmt = $con->prepare("SELECT user_id FROM playlists WHERE playlist_id = ?");
$checkStmt->bind_param("i", $playlistId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

$checkStmt->close();

// Handle image upload
if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'assets/playlist_covers/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $fileName = uniqid() . '_' . basename($_FILES['cover_image']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['cover_image']['tmp_name']);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        exit;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo json_encode(['success' => false, 'message' => 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.']);
        exit;
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetFilePath)) {
        $imagePath = $targetFilePath;
    } else {
        echo json_encode(['success' => false, 'message' => 'Error uploading file.']);
        exit;
    }
} elseif (isset($_POST['cover_image_url']) && !empty($_POST['cover_image_url'])) {
    // Handle image from URL
    $imageUrl = filter_var($_POST['cover_image_url'], FILTER_SANITIZE_URL);
    if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
        // Optional: You could download the image and save it locally,
        // or just store the URL directly. Storing URL is simpler.
        $imagePath = $imageUrl;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid image URL provided.']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No image file or URL provided.']);
    exit;
}

$stmt = $con->prepare("UPDATE playlists SET cover_image_path = ? WHERE playlist_id = ?");
$stmt->bind_param("si", $imagePath, $playlistId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Playlist cover updated successfully!', 'image_path' => $imagePath]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating playlist cover: ' . $con->error]);
}

$stmt->close();
$con->close();
?>