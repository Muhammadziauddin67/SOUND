<?php
include('dbconnection.php');
session_start();
?>

<?php
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Fetch user data
        $query = "SELECT * FROM users WHERE name='$username'";
        $run = mysqli_query($con, $query);
        $user = mysqli_fetch_assoc($run);

        if ($user && password_verify($password, $user['password_hash'])) {
            // User authenticated, set session variables
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['Last_time'] = time();

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header('location: admin_panel.php');
            } else {
                header('location: home.php');
            }
            exit();
        } else {
            echo "<script>alert('Incorrect username or password');</script>";
        }
    }
    ?>
