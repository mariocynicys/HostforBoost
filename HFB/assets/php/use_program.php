<?php

    include_once("check_login.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username']) && isset($_POST['pid']) && is_numeric($_POST['pid']) && $_POST['pid'] >= 1){
            $user_name = $_POST['username'];
            $PID = $_POST['pid'];
            
            // first check if the user is currently playing a game
            $sql = "SELECT * FROM ProgramsHistory WHERE UserName='".$user_name."' AND PState=1;";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set) == 0){
                // here means the user isn't playing any games now, so he can start play a game
                $sql = "INSERT INTO ProgramsHistory(`UserName`, `PID`) VALUES('$user_name',$PID);";
                if(mysqli_query($conn, $sql)) echo "Successfully start using a program!";
                else echo "Sorry, we currently have a problem. Please try later";
            }else{
                // that means the user is busy playing another game, so we can tell him to 
                // leave the other game first to from his current activities start play another one
                echo "You're using another program. please leave it first!";
            }
        }else echo "You have done somthing bad!";
    }

?>