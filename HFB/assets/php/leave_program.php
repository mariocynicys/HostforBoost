<?php

    include_once("check_login.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username']) && isset($_POST['pid']) && is_numeric($_POST['pid']) && $_POST['pid'] >= 1){
            $user_name = $_POST['username'];
            $PID = $_POST['pid'];
            
            // first check if the user is currently playing a game
            $sql = "SELECT * FROM ProgramsHistory WHERE UserName='".$user_name."' AND PID=".$PID." AND PState=1;";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set) == 1){
                // here means the user is playing that game now, so he can leave it if he want
                $date = date("Y-m-d H:i:s");
                $sql = "UPDATE `ProgramsHistory` SET `PEnded`='".$date."', `PState`=0 WHERE UserName='".$user_name."' AND PID=".$PID." AND PState=1;";
                if(mysqli_query($conn, $sql)) echo "Successfully leaving that program!";
                else echo "Sorry, we currently have a problem. Please try later";
            }else{
                // here means the user isn't playing the game he want to leave or isn't playing any game at all!
                echo "You're not using that program!";
            }
        }else echo "You have done somthing bad!";
    }

?>