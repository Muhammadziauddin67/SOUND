<?php
include ('dbconnection.php');




if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // SQL query to insert new user
    $sql = "INSERT INTO users (name, email, password_hash, address, phone, role, created_at) 
            VALUES ('$username', '$email', '$password', '$address', '$phone', '$role', NOW())";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('added successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();

    // Redirect back to the main page or user list page after insertion
    header("Location: admin_panel.php");
    exit;
}
?>
