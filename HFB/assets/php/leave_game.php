<?php

    include_once("check_login.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username']) && isset($_POST['gid']) && is_numeric($_POST['gid']) && $_POST['gid'] >= 1){
            $user_name = $_POST['username'];
            $GID = $_POST['gid'];
            
            // first check if the user is currently playing a game
            $sql = "SELECT * FROM GamesHistory WHERE UserName='".$user_name."' AND GID=".$GID." AND GState=1;";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set) == 1){
                // here means the user is playing that game now, so he can leave it if he want
                $date = date("Y-m-d H:i:s");
                $sql = "UPDATE `GamesHistory` SET `GEnded`='".$date."', `GState`=0 WHERE UserName='".$user_name."' AND GID=".$GID." AND GState=1;";
                if(mysqli_query($conn, $sql)) echo "Successfully leaving that game!";
                else echo "Sorry, we currently have a problem. Please try later";
            }else{
                // here means the user isn't playing the game he want to leave or isn't playing any game at all!
                echo "You're not playing that game!";
            }
        }else echo "You have done somthing bad!";
    }

?>