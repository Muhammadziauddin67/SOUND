<?php
include('dbconnection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_SESSION['username'])) {
        // Update the last login time
        if($_SESSION['Last_time'] > time() - 60)
         {// Check if user is still logged in for 1 minute
            header("location: logout.php");
        }
        else{
            // Update the last login time
            $_SESSION['Last_time'] = time();
            echo "Welcome back, ". $_SESSION['username'];
        }
    }

    else {
        // Redirect to login page if user not logged in
        header("location:login.php");
    }
    ?>
    <a href="logout.php">LOG OUT</a>
    <br>
    <a href="home.php">Go to home</a>
</body>
</html>