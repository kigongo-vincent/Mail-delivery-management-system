<?php
include './connect.php';
$query_run  = mysqli_query($conn, 'select * from staff ');
$staff = [];
while($row = mysqli_fetch_assoc($query_run)){
    array_push($staff, $row);
}
echo json_encode($staff);