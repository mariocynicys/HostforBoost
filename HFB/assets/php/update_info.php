<?php

    include_once("check_login.php");

    function check_name($name) {
        if(strlen($name) <= 0 || strlen($name) > 20) return 0;
        else if(!preg_match("/^[A-Za-z ]{1,20}$/", $name)) return 0;
        else return 1;
    }

    function check_username($username){
        if(strlen($username) <= 0 || strlen($username) > 20) return 0;
        else if(!preg_match("/^[A-Za-z0-9 ]{1,20}$/", $username)) return 0;
        return 1;
    }

    function check_email($user_name, $email, $conn){  // -1=invalid and 0=notunique 1=correct
        if(strlen($email) <= 0 || strlen($email) > 20) return -1;
        if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/", $email)) return -1;
        $sql = "SELECT `Email` from `Users` where `Email` = '".$email."' and `UserName` != '$user_name'";
        $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
        if(mysqli_num_rows($result_set)) return 0;
        return 1;
    }

    function check_password($password){
        if(strlen($password) <= 0 || strlen($password) > 20) return 0;
        if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) return 0;
        return 1;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateInfo'])){
        $first_name = $_POST['first_name'];          
        $last_name = $_POST['last_name'];           
        $user_name = $_POST['user_name'];
        $email = $_POST['email'];
        $user_type = $_POST['user_type'];
        $password = $_POST['password'];

        if(!check_name($first_name) || !check_name($last_name)){
            echo "Invalid format for first name or last name!";
        }else if(check_username($user_name, $conn) == 0){
            echo "This Username is invalid :(";
        }else if(check_email($user_name, $email, $conn) == -1){
            echo "Invalid email format, emails would be like example@example.com";
        }else if(check_email($user_name, $email, $conn) == 0){
            echo "This email has already an account :(";
        }else if(!check_password($password)){
            echo "Invalid password format!";
        }else{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "SELECT * from `Users` where `UserName` = '$user_name'";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            if(mysqli_num_rows($result_set)==1){
                $sql = "UPDATE `Users` SET `FirstName`='$first_name', `LastName`='$last_name', `Email`='$email', `HashedPassword`='$hashed_password' WHERE `UserName` = '$user_name'";
                echo $sql;
                if(mysqli_query($conn, $sql)){
                    $_SESSION['username'] = $user_name;
                    $_SESSION['password'] = $password;
                    echo "Successfully Updated :)";
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ../../profile.php');
                }else{
                    echo "We've some problems, Try update later :(";
                    header('HTTP/1.1 301 Moved Permanently');
                    header('Location: ../../profile.php');
                }
            } 
        }          
    }

    

?>