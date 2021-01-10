<?php

    include_once("check_login.php");
    
    // backend check for program name
    function check_name($name, $pid, $conn){ // -1=invalid and 0=notunique 1=correct
        if(strlen($name) <= 0 || strlen($name) > 20) return -1;
        else if(!preg_match("/^[A-Za-z0-9 ]{1,20}$/", $name)) return -1;
        $sql = "SELECT `PName`, `PID` from `Program` where `PName` = '".$name."'";
        $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
        if(mysqli_num_rows($result_set)){ // that name is already in the database
            $record = mysqli_fetch_assoc($result_set);
            if(intval($record['PID']) == $pid) return 1; // so we need to see if its for the same program or not
            else return 0;
        }
        return 1;
    }

    // backend check for ($name=publisher)
    function check_publisher($name) {
        if(strlen($name) <= 0 || strlen($name) > 80) return 0;
        else if(!preg_match("/^[A-Za-z0-9, ]{1,20}$/", $name)) return 0;
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

    // backend photo check 
    function check_photo($file, $pid, $conn){
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
                        $fileDestination = "../img/programs/" . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return $fileNameNew;
                    } else return 0;
                } else return 0;
            } else return 0;
        }else{
            $sql = "SELECT PPoster FROM Program WHERE PID=$pid";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            $record = mysqli_fetch_assoc($result_set);
            return $record['PPoster'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $pid = $_POST['PID'];
        $pname = $_POST['pname'];
        $preleased_date = $_POST['preleased_date'];
        $ppublisher = $_POST['ppublisher'];
        $file = $_FILES["programImage"];

        $formated_date = check_released_date($preleased_date);
        $filename = check_photo($file, $pid, $conn);

        if(check_name($pname, $pid, $conn) == -1){
            echo "Invalid program name format!";
        }else if(check_name($pname, $pid, $conn) == 0){
            echo "This name belongs to another program";
        }else if(!check_publisher($ppublisher)){
            echo "Invalid Game publisher format!";
        }else if($formated_date == 0){
            echo "Please the entered date. It should be in mm/dd/yyyy format and a date before today!";
        }else if($filename === 0){
            echo "Invalid program poster file. it should be a 2kb (jpg, jpeg, png, gif) file";
        }else{
            $sql = "UPDATE Program SET PName='$pname', PPoster='$filename', PReleasedDate='$formated_date', PPublisher='$ppublisher' WHERE PID=$pid";
            if(mysqli_query($conn, $sql)){
                echo "Program information has been updated successfully!";
            }else{
                echo "Somthing went wrong happened. Please try again later";
            }
        }
    }

?>