<?php
    
    include_once("check_login.php");
    
    if(isset($_SESSION['username']) and isset($_SESSION['password'])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        if(make_check($username, $password) == 1){
            global $conn;
            $sql = "UPDATE `users` SET `IsOnline` = '0' WHERE `users`.`UserName` = '$username'";
            mysqli_query($conn, $sql);
            $_SESSION = array();
            session_destroy();
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ../../index.php'); 
        }
    }

    

    
    

?>