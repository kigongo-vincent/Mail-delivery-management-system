<?php
include './connect.php';
$query_run = mysqli_query($conn, "select * from mail where mail_status = 0");
$mails = [];
while($row = mysqli_fetch_assoc($query_run)){
    array_push($mails, $row);
}
echo json_encode($mails);