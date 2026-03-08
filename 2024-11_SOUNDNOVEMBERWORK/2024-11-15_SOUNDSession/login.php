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
    <form action="" method="POST">
        <label for="">username</label>
        <input type="text" name="username" required>
<br><br>
        <label for="">password</label>
        <input type="password" name="password" required id="showpass">

        <input type="checkbox" onclick="showpassword()">
        <label>Show password</label>
        

        <br><br>
        <input type="submit" name="login" value="login">
    </form>
   <?php
    if(isset($_POST['login'])) {

$username = $_POST['username'];
    $password = $_POST['password'];

     $query = "SELECT * FROM login WHERE username='$username' AND password='$password' ";
     $run = mysqli_query($con, $query);
     $row = mysqli_num_rows($run);

     //echo $row;

if($row == 1){
    // User is authenticated, set session variables and redirect to dashboard.php
    $_SESSION['username'] = $username;
    // Set the last login time
    $_SESSION['Last_time'] = time();
    // Redirect to dashboard.php
    header('location:dashboard.php');
}
else{
    echo "<script>alert('incorrect password')</script>";
}

     }
    
    ?>
    <script>
        var a = document.getElementById("showpass");
        function showpassword() {

            
            if (a.type == "password") {
                a.type = "text";
            } else {
                a.type = "password";
            }
        }
    </script>

</body>
</html>