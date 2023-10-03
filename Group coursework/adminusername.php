<?php
include './connect.php';
$query_run = mysqli_query($conn, "select * from admin");
$username = "";
while($row = mysqli_fetch_assoc($query_run)){
    $username = $row['username'];
}
echo json_encode($username);