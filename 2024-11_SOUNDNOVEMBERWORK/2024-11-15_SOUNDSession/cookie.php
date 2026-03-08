<?php
include('dbconnection.php')

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
<label>Name:</label>
<input type="text" name="name" required value="
<?php
if(isset($_COOKIE['name'])) 
{
    echo $_COOKIE['name'];
}?>"
>

<br><br>

<label>Password:</label>
<input type="password" name="password" required value="<?php
if(isset($_COOKIE['name'])) 
{
    echo $_COOKIE['name'];
}?>">
<br><br>
<input type="checkbox" name="cookie">
<label>Accept Cookie</label>
<br><br>
<input type="submit" name="login" value="login">
 </form>
 <?php
 if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    

    $query = "SELECT * FROM cookie WHERE name='$name' AND password='$password' ";
    $run = mysqli_query($con, $query);
    $rows = mysqli_num_rows($run);


    if($rows == 1){
        
        if(isset($_POST['cookie'])) {
            setcookie('name', $name, time()+60*60*24); // 86400 = 1 day
            setcookie('password', $password, time()+60*60*24); // 86400 = 1 day
        }
        else {
            setcookie('name', '', time()-600000000);
            setcookie('password', '', time()-600000000);
        }

        $_SESSION['name'] = $name;
        echo "<script>alert('Login successful');
        window.location.href='index.php';
        </script>";



    }

 }
 ?>    
</body>
</html>