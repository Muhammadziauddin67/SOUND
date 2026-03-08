<?php
include('dbconnection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
<div class="login-box1">
    <form action="" method = "POST">
        <h2 class="login">Sign up
        <img src="assets/soundlogo.png" alt="Sound Logo">
        </h2>
            <div class="input-box">
                <span class="icon">
                <i class="fa-solid fa-user"></i>
                </span>
                <input type="text" name="name" required>
                <label>Name</label>
            </div>
            <br>
            <div class="input-box">
                <span class="icon">
                <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" name="email" required>
                <label>E-mail</label>
            </div>
            <br>
            <div class="input-box">
                <span class="icon">
                <i class="fa-solid fa-mobile"></i>
                </span>
                <input type="text" name="phone" required>
                <label>Phone Number</label>
            </div>
            <br>
            <div class="input-box">
                <span class="icon">
                <i class="fa-solid fa-address-book"></i>
                </span>
                <input type="text" name="address" required>
                <label>Address</label>
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
            </div>
            <br>
            <button class="login-btn" type="submit" name="signup">Sign up</button>
            <br>
            <div class="register">
                <p>Already have an account?
                    <a href="index.php">Login here.</a>
                </p>
            </div>

    </form>
</div>
</section>


<?php
    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if the email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_result) > 0) {
        // Email already exists
        echo "<script>alert('Error: This email is already registered. Please use a different email or log in.');</script>";
    } else {
        // Email does not exist, proceed with registration
        $insert_query = "INSERT INTO users (name, address, phone, email, password_hash) VALUES ('$name', '$address', '$phone', '$email', '$password')";
        $run_insert = mysqli_query($con, $insert_query);

        if ($run_insert) {
            echo "<script>alert('Signup successful. Please log in.'); window.location.href='index.php';</script>";
        } else {
            // This else block would catch other potential database errors, not duplicate email
            echo "<script>alert('Error: Could not register user.');</script>";
        }
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