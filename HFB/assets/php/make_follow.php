<?php

    include_once("check_login.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $user_name = $_POST['username'];
        $friend_name = $_POST['friendname'];
        $sql = "SELECT * FROM users WHERE Username='".$user_name."' OR UserName='".$friend_name."';";
        $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
        if(mysqli_num_rows($result_set) == 2){
            // here means the two users are in the database
            $sql = $sql = "SELECT * FROM Friends WHERE UserName='".$user_name."' AND FriendName='".$friend_name."';";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set) == 0){
                // here means the username wasn't following that friendname before
                // so he can follow him now
                $sql = "INSERT INTO `Friends` (`UserName`, `FriendName`) VALUES('$user_name', '$friend_name')";                
                if(mysqli_query($conn, $sql)) echo "Successfully make a follow!";
                else echo $sql;
            }
        }
    }

?>