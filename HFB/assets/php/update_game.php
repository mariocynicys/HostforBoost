<?php

    include_once("check_login.php");
    
    // backend check for game name
    function check_name($name, $gid, $conn){ // -1=invalid and 0=notunique 1=correct
        if(strlen($name) <= 0 || strlen($name) > 20) return -1;
        else if(!preg_match("/^[A-Za-z0-9 ]{1,20}$/", $name)) return -1;
        $sql = "SELECT `GName`, `GID` from `Game` where `GName` = '".$name."'";
        $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
        if(mysqli_num_rows($result_set)){ // that name is already in the database
            $record = mysqli_fetch_assoc($result_set);
            if(intval($record['GID']) == $gid) return 1; // so we need to see if its for the same game or not
            else return 0;
        }
        return 1;
    }

    // backend check for game ($name=genre) or ($name=publisher)
    function check_genre_publisher($name) {
        if(strlen($name) <= 0 || strlen($name) > 80) return 0;
        else if(!preg_match("/^[A-Za-z0-9, ]{1,20}$/", $name)) return 0;
        else return 1;
    }

    // backend check for rate 8, 8.5, 0.5, 5.0
    function check_rate($rate) {
        if(strlen($rate) <= 0 || strlen($rate) > 3) return 0;
        else if(!preg_match("/^[0-9]{0,1}([.][0-9]){0,1}$/", $rate)) return 0;
        else return 1;
    }

    // backend check for date to be in yyyy-mm-dd format and also if that is a valid date
    function check_released_date($released_date) {
        if(strlen($released_date) <= 0 || strlen($released_date) != 10) return 0; // date length
        else if(!preg_match("/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|1\d|2\d|3[01])$/", $released_date)) return 0; // date format mm/dd/yyyy
        $date_numbers = explode("-", $released_date);
        $year = $date_numbers[0];
        $month = $date_numbers[1];
        $day = $date_numbers[2];
        if(!checkdate(intval($month), intval($day), intval($year))) return 0; // invalid date combination
        $prev_day = new DateTime("$year-$month-$day");
        $today = new DateTime('');
        if($prev_day < $today) return $released_date; 
        else return 0; // future game released isn't allowed ^_^
    }

    /*
    backend to check if the url isn't one of the following formats:  
        https://www.youtube.com/watch?v=k-POG1-Cp1k
        www.youtube.com/watch?v=k-POG1-Cp1k
        youtube.com/watch?v=k-POG1-Cp1k
        https://youtube.com/watch?v=k-POG1-Cp1k
    */
    function check_youtube_url($url){
        if(strlen($url) <= 0 || strlen($url) > 43) return 0;
        else if(!preg_match("/^(?:https:\/\/)?(?:www\.)?(?:youtube\.com)(?:\/watch\?v=)([a-zA-Z0-9\_-]{11,11})$/", $url)) return 0;
        $val = explode("=", $url);
        return $val[1];
    }

    // backend photo check 
    function check_photo($file, $gid, $conn){
        if ($file["size"] > 0) {
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
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = "../img/games/" . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return $fileNameNew;
                    } else return 0;
                } else return 0;
            } else return 0;
        }else{
            $sql = "SELECT GPoster FROM Game WHERE GID=$gid";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            $record = mysqli_fetch_assoc($result_set);
            return $record['GPoster'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $gid = $_POST['GID'];
        $gname = $_POST['gname'];
        $ggenre = $_POST['ggenre'];
        $grate = $_POST['grate'];
        $greleased_date = $_POST['greleased_date'];
        $gpublisher = $_POST['gpublisher'];
        $gtrailer = $_POST['gtrailer'];
        $file = $_FILES["gameImage"];

        $formated_date = check_released_date($greleased_date);
        $formated_url = check_youtube_url($gtrailer);
        $filename = check_photo($file, $gid, $conn);

        if(check_name($gname, $gid, $conn) == -1){
            echo "Invalid game name format!";
        }else if(check_name($gname, $gid, $conn) == 0){
            echo "This name belongs to another game";
        }else if(!check_genre_publisher($ggenre)){
            echo "Invalid Game genre format!";
        }else if(!check_genre_publisher($gpublisher)){
            echo "Invalid Game publisher format!";
        }else if(!check_rate($grate)){
            echo "Game rate is a decimal value between 0 and 10";
        }else if($formated_date == 0){
            echo "Please the entered date. It should be in mm/dd/yyyy format and a date before today!";
        }else if($formated_url === 0){
            echo "Invalid game trailer url, please enter a valid youtube video url e.g. https://www.youtube.com/watch?v=ssrNcwxALS4";
        }else if($filename === 0){
            echo "Invalid game poster file. it should be a 2kb (jpg, jpeg, png, gif) file";
        }else{
            $formated_rate = floatval($grate);
            $sql = "UPDATE Game SET GName='$gname', GPoster='$filename', GGenre='$ggenre', GRate=$formated_rate, GReleasedDate='$formated_date', GPublisher='$gpublisher', GTrailer='$formated_url' WHERE GID=$gid";
            if(mysqli_query($conn, $sql)){
                echo "Game information has been updated successfully!";
            }else{
                echo "Somthing went wrong happened. Please try again later";
            }
        }
    }

?>