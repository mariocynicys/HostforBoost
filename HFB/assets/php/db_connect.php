<?php
$servername = "localhost";
$connusername = "root";
$connpassword = "";
$dbname = "hoost_for_boost";
$conn = mysqli_connect($servername, $connusername, $connpassword, $dbname) 
        or die("Connection failed: " . mysqli_connect_error());
?>