<?php
include('dbconnection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>
<style>
    body {
        background-image: linear-gradient(-225deg, #7100b3 0%, #333 100%);
        background-image: linear-gradient(to top, #333  0%,  #7100b3 100%);
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
</style>
<body>
<div class="login-container">
    <h2>Login</h2>
    <form action="" method="POST">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Username" required autocomplete="username">
    <br><br>
    
    <label for="password">Password</label>
    <div class="password-container">
        <input type="password" name="password" placeholder="Password" required id="showpass">
            <span class="password-toggle">
                <i class="fa fa-eye" id="eye-icon"></i>
            </span>
        </div>
    <br><br>
    
    <input type="submit" name="login" value="Login">
</form>

    <a href="signup.php" class="signuplink">Don't Have An Account?</a>
</div>
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
<script src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>
