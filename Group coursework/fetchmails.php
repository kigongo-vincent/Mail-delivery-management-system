<?php
include './connect.php';
$query_run = mysqli_query($conn, "select * from mail");
$mails = [];
while($row = mysqli_fetch_assoc($query_run)){
    array_push($mails, $row);
}
echo json_encode($mails);