<?php 

    session_start();
    include_once("db_connect.php");
    $first_name = '';
    $last_name = '';
    $username = '';
    $email = '';
    $password = '';
    $user_type = '';
    $profile_pic = '';
    $user_address = '';
    $user_country = '';
    $user_city = '';

    function make_check($user, $pass){
        global $conn, $first_name, $last_name, $email, $user_type, $profile_pic;
        $sql = "SELECT * from `Users` where `UserName` = '$user'";
        $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
        if(mysqli_num_rows($result_set)==1){
            $record = mysqli_fetch_assoc($result_set);
            if(password_verify($pass, $record['HashedPassword'])){
                $first_name = $record['FirstName'];
                $last_name = $record['LastName'];
                $email = $record['Email'];
                $user_type = $record['UserType'];
                $profile_pic = $record['UserPic'];
                return 1;
            }else return 0;
        } 
        return 0;
    }

?>