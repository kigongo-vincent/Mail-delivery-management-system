<?php
include './connect.php';
$query_run = mysqli_query($conn, "select * from mail where mail_status = 0");
$umails = [];
$dmails = [];
while($row1 = mysqli_fetch_assoc($query_run)){
    array_push($umails, $row1);
}
$query_run = mysqli_query($conn, "select * from mail where mail_status = 1");
while($row2 = mysqli_fetch_assoc($query_run)){
    array_push($dmails, $row2);
}
$umails = sizeof($umails);
$dmails = sizeof($dmails);
$joint = [$dmails, $umails];
echo json_encode($joint);