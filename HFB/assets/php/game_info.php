<?php
    include_once("db_connect.php"); 
    if(isset($_GET['GID'])){
        $GID = $_GET['GID'];
        if(is_numeric($GID) && $GID >= 1){
            $sql = "SELECT * from `Game` where GID = '".$GID."'";
            $result_set = mysqli_query($conn, $sql) or die("Database Error: ".mysqli_error($conn));
            $record = mysqli_fetch_assoc($result_set);
            echo json_encode($record);
        }
    }
?>