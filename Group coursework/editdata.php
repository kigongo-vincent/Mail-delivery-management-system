<?php
session_start();
$staff = $_SESSION['staffID'];
include './connect.php';
/* if(isset(file_get_contents('php://input'))){
    

} */
$contents = trim(file_get_contents('php://input'));
$array = json_decode($contents, true);
$id = $array['id'];
$date_modified = date('y:m:d');
mysqli_query($conn, "update mail set mail_status = 1,staffID = '$staff', date_Delivered = '$date_modified' where mailID = '$id' ");
echo json_encode('mail delivered successfully');