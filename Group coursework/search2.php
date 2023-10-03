<?php
include './connect.php';
$content = trim(file_get_contents('php://input'));
$array = json_decode($content, true);
$item ="%" . $array['search'] . "%";
$query = mysqli_query($conn, "select * from mail where client_name like '$item' and mail_status = 0");
$result = [];
while($row = mysqli_fetch_assoc($query)){
    array_push($result, $row);
}
echo json_encode($result);