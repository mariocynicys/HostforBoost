<?php

    include_once("check_login.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username']) && isset($_POST['gid']) && is_numeric($_POST['gid']) && $_POST['gid'] >= 1){
            $user_name = $_POST['username'];
            $GID = $_POST['gid'];
            
            // first check if the user is currently playing a game
            $sql = "SELECT * FROM GamesHistory WHERE UserName='".$user_name."' AND GState=1;";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set) == 0){
                // here means the user isn't playing any games now, so he can start play a game
                $sql = "INSERT INTO GamesHistory(`UserName`, `GID`) VALUES('$user_name',$GID);";
                if(mysqli_query($conn, $sql)) echo "Successfully start playing a game!";
                else echo "Sorry, we currently have a problem. Please try later";
            }else{
                // that means the user is busy playing another game, so we can tell him to 
                // leave the other game first to from his current activities start play another one
                echo "You're playing another game. please leave it first!";
            }
        }else echo "You have done somthing bad!";
    }

?>