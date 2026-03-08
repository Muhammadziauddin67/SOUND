<?php
session_start();

// Set session timeout duration (10 minutes)
$timeout_duration = 600;

// Check if the session is expired
if (isset($_SESSION['start_time'])) {
    // Calculate the session duration
    $session_duration = time() - $_SESSION['start_time'];

    // If the session has expired
    if ($session_duration > $timeout_duration) {
        session_unset();
        session_destroy();
        $response = ['active' => false];
    } else {
        $response = ['active' => true];
    }
} else {
    // If session start time is not set, set it now
    $_SESSION['start_time'] = time();
    $response = ['active' => true];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
