<?php
    session_start();
    include_once("db_connect.php");
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePhoto'])) {
        echo "post and updatePhoto correct<br>";
        if ($_FILES["profileImage"]["size"] > 0) {
            echo "ya, we have a file to upload!<br>";
            $user_name = $_SESSION["username"];
            $file = $_FILES["profileImage"];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 200000) {
                        echo "leagal up till now, wow!<br>";
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = "../img/avatars/" . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        echo "tmp name:  $fileTmpName <br>";
                        echo "new name:  $fileNameNew <br>";
                        $sql = "UPDATE `users` SET `UserPic`='$fileNameNew' WHERE `UserName`='$user_name'";
                        mysqli_query($conn, $sql);
                        echo "shoudl be inserted ^_^<br>";
                    }
                }
            }
        }
    }

    $user_type = $_SESSION['type'];
    if($user_type == "normal"){
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ../../views/normal/profile.php'); 
    }else if($user_type == "program_publisher"){
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ../../views/program_publisher/profile.php'); 
    }else if($user_type == "game_publisher"){
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ../../views/game_publisher/profile.php'); 
    }

?>