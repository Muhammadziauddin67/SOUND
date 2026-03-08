<?php
include('dbconnection.php');

// Define admin credentials
$name = 'Adminsound';
$password = 'admin123sound'; // Use a strong password
$email = 'ziaazeem2004@gmail.com'; // Provide a valid email

// Hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL query
$query = "INSERT INTO users (name, password_hash, email, role, created_at) 
          VALUES ('$name', '$password_hash', '$email', 'admin', NOW())";

// Execute the query
if (mysqli_query($con, $query)) {
    echo "Admin account created successfully.";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
