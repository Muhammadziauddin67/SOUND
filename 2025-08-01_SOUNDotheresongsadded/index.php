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
    <style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }
</style>
    <link rel="icon" href="assets/soundlogo.png" type="image/icon type">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
    <section>
<div class="login-box">
    <form action="" method = "POST">
    <center><img src="assets/soundlogo.png" alt="Sound Logo"></center>
        <h2 class="login">Login</h2>
            <div class="input-box">
                <span class="icon">
                <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <br>
            <div class="input-box">
                <span class="icon">
                <i class="fa fa-eye-slash" id="eye-icon"></i>
                </span>
                <input type="password" id="showpass" name="password" required>
                <label>Password</label>
            </div>
            <br>
            <div class="remember">
                <label>
                    <input type="checkbox">Remember me
                </label>
                <a href="#">Forget Password?</a>
            </div>
            <br>
            <button class="login-btn" type="submit" name="login">Login</button>
            <br>
            <div class="register">
                <p>Don't have an account?
                    <a href="signup.php">Register Here</a>
                </p>
            </div>

            <div class="line-flex">
            <div class="line"></div>
            <p>OR | Sign in with</p>
            <div class="line"></div>
            </div>
            
            <div class="login-icons">
            <a href="https://accounts.google.com/v3/signin/identifier?dsh=S1812573153%3A1655944654029516&flowEntry=ServiceLogin&flowName=WebLiteSignIn&ifkv=AX3vH39E0iYVTmn-NoMNM_C35EPrno8LWsRx2Qhr0HApkVLZ-Zc_Vql8ouaSQOiXzEmthrpOPAV5"><i class="fa-brands fa-google"></i></a>

            <a href="https://x.com/"><i class="fa-brands fa-x-twitter"></i></a>

            <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook"></i></a>
         
            <a href="https://account.apple.com/"><i class="fa-brands fa-apple"></i></a>
            </div>

    </form>
</div>
</section>


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

<script>
    // eye function
    const passwordInput = document.getElementById("showpass");
    const eyeIcon = document.getElementById("eye-icon");

    // Add the event listener directly to the eye icon
    eyeIcon.addEventListener('click', function () {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    });
</script>

</body>
</html>