<?php
include './connect.php';
$admin = [];
$query_run = mysqli_query($conn, "select * from admin");
while($row = mysqli_fetch_assoc($query_run)){
    array_push($admin, $row);
}
echo json_encode($admin);