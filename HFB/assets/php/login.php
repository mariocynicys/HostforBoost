<?php

    include_once("check_login.php");

    function check_username($username, $conn){
        if(strlen($username) <= 0 || strlen($username) > 20) return -1;
        else if(!preg_match("/^[A-Za-z0-9 ]{1,20}$/", $username)) return -1;
        return 1;
    }

    function check_password($password){
        if(strlen($password) <= 0 || strlen($password) > 20) return 0;
        if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) return 0;
        return 1;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
        $user_name = $_POST['user_name'];          // notnull
        $password = $_POST['password'];           // notnull
        
        if(check_username($user_name, $conn) == -1){
            echo "Invalid format for your username!";
        }else if(!check_password($password)){
            echo "Invalid password format!";
        }else{
            if(make_check($user_name, $password)==1){
                global $conn;
                $sql = "UPDATE `users` SET `IsOnline` = '1' WHERE `users`.`UserName` = '$user_name'";
                mysqli_query($conn, $sql);
                
                $sql = "SELECT UserType FROM users WHERE `users`.`UserName` = '$user_name'";
                $result_set = mysqli_query($conn, $sql) or die("Database Error: " . mysqli_error($conn));
                $record = mysqli_fetch_assoc($result_set);

                $_SESSION['username'] = $user_name;
                $_SESSION['password'] = $password;
                $_SESSION['type'] = $record['UserType'];
                
                if($record['UserType'] == "normal"){
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ../../views/normal/profile.php'); 
                }else if($record['UserType'] == "program_publisher"){
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ../../views/program_publisher/profile.php'); 
                }else if($record['UserType'] == "game_publisher"){
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ../../views/game_publisher/profile.php'); 
                }

            }else{
                $_SESSION = array();
                session_destroy();
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: ../../login.php');
            }           
        }

    }

?>