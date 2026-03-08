<?php
//Database connection.
$con = MySQLi_connect(
  "localhost", //Server host name.
  "root", //Database username.
  "", //Database password.
  "exampledb" //Database name or anything you would like to call it.
) or die ("connection Failed")
?>