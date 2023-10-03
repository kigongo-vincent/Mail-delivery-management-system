<?php
include './connect.php';
$clients = [];
$query_run = mysqli_query($conn, "select * from mail");
while($row = mysqli_fetch_assoc($query_run)){
    array_push($clients, $row);
}
echo json_encode($clients);