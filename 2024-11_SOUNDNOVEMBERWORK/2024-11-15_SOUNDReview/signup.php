<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
<div class="signup-container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
        <!-- Name Field -->
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name" required pattern="^[a-zA-Z\s]+$" title="Please enter a valid name with only letters and spaces">
        <br><br>

        <!-- Address Field -->
        <label for="address">Address</label>
        <input type="text" name="address" placeholder="Address" required minlength="5" title="Please enter a valid address">
        <br><br>

        <!-- Phone Number Field -->
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" placeholder="Phone Number" required pattern="^\d{10}$" title="Please enter a 10-digit phone number">
        <br><br>

        <!-- Email Field -->
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" required>
        <br><br>

        <!-- Password Field -->
        <label for="password">Password</label>
        <div class="password-container">
            <input type="password" name="password" placeholder="Password" required id="showpass" minlength="8" title="Password must be at least 8 characters">
            <span class="password-toggle">
                <i class="fa fa-eye" id="eye-icon"></i>
            </span>
        </div>
        <br><br>

        <input type="submit" name="signup" value="Sign Up">
    </form>
    <a href="login.php" class="loginlink">Already Have An Account?</a>
</div>



<script src="script.js"></script>
</body>
</html>
