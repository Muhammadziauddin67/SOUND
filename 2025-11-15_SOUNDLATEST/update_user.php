<?php
include('dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch POST data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // Optionally hash the password if you want to store it securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update the user data in the database
    $sql = "UPDATE users SET name = '$username', email = '$email', password_hash = '$hashed_password', address = '$address', phone = '$phone', role = '$role' WHERE user_id = $user_id";
    
    if ($con->query($sql) === TRUE) {
        echo "<script>alert('updated successfully')</script>";
        // Redirect to the index page or any other page after successful update
        header("Location: admin_panel.php");
    } else {
        echo "Error updating user: " . $con->error;
    }
}
?>
