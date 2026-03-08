<?php
session_start();

// Set session timeout duration
$timeout_duration = 600;

// Initialize response
$response = ['active' => true];

if (isset($_SESSION['last_activity'])) {
    // Calculate the elapsed time since the last activity
    $elapsed_time = time() - $_SESSION['last_activity'];

    // If elapsed time exceeds the timeout, expire the session
    if ($elapsed_time > $timeout_duration) {
        session_unset();
        session_destroy();
        $response['active'] = false;
    } else {
        // Update last activity time if session is still active
        $_SESSION['last_activity'] = time();
    }
} else {
    // If no last activity is set, consider the session inactive
    $response['active'] = false;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
