<?php
    include_once("db_connect.php"); 
    if(isset($_GET['PID'])){
        $PID = $_GET['PID'];
        if(is_numeric($PID) && $PID >= 1){
            $sql = "SELECT * from `Program` where PID = '".$PID."'";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            $record = mysqli_fetch_assoc($result_set);
            echo json_encode($record);
        }
    }
?>